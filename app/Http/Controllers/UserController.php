<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Stream;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserSocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('q');
        $results = [];


        if ($query) {
            $results = Song::where('title', 'like', "%$query%")
                ->orWhereHas('artist', function ($q) use ($query) {
                    $q->where('name', 'like', "%$query%");
                })
                ->with('artist', 'album')
                ->paginate(5);
            $allSongs = null;
        } else {
            $allSongs = Song::with('artist', 'album')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        $popularSongs = Song::with('artist')
            ->select('songs.id', 'songs.title', DB::raw('COUNT(streams.song_id) as stream_count'))
            ->leftJoin('streams', 'songs.id', '=', 'streams.song_id')
            ->groupBy('songs.id', 'songs.title')
            ->orderByDesc('stream_count')
            ->limit(5)
            ->get();


        // Artis Populer (berdasarkan jumlah stream lagu mereka)
        $popularArtists = User::select('users.name', 'users.id', DB::raw('COUNT(streams.song_id) as stream_count'))
            ->leftJoin('songs', 'users.id', '=', 'songs.artist_id')
            ->leftJoin('streams', 'songs.id', '=', 'streams.song_id')
            ->whereNotNull('songs.artist_id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('stream_count')
            ->limit(5)
            ->get();

        // Pencipta Populer (berdasarkan jumlah stream lagu mereka)
        $popularComposers = User::select('users.name', 'users.id', DB::raw('COUNT(streams.id) as stream_count'))
            ->join('composer_song', 'users.id', '=', 'composer_song.user_id')
            ->join('songs', 'composer_song.song_id', '=', 'songs.id')
            ->leftJoin('streams', 'songs.id', '=', 'streams.song_id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('stream_count')
            ->limit(5)
            ->get();

        // Cover Creator Populer (berdasarkan jumlah stream lagu yang menggunakan cover mereka)
        $popularCoverCreators = User::select('users.name', 'users.id', DB::raw('COUNT(streams.song_id) as stream_count'))
            ->leftJoin('songs', 'users.id', '=', 'songs.cover_creator_id')
            ->leftJoin('streams', 'songs.id', '=', 'streams.song_id')
            ->whereNotNull('songs.cover_creator_id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('stream_count')
            ->limit(5)
            ->get();

        return view('users.dashboard', [
            'user' => $user,
            'results' => $results,
            'query' => $query,
            'allSongs' => $allSongs,
            'popularSongs' => $popularSongs,
            'popularArtists' => $popularArtists,
            'popularComposers' => $popularComposers,
            'popularCoverCreators' => $popularCoverCreators,
        ]);
    }

    public function play($id)
    {
        $song = Song::find($id);

        if (!$song || !$song->file_path) {
            return response()->json(['error' => 'Lagu tidak ditemukan atau file tidak tersedia.'], 404);
        }

        $url = Storage::url($song->file_path);

        return response()->json(['url' => $url]);
    }

    public function EditProfile()
    {
        $user = Auth::user();

        $userSocialMedia = UserSocialMedia::where('user_id', $user->id)->get();
        $socialMedia = [];
        foreach ($userSocialMedia as $social) {
            $socialMedia[$social->platform] = $social->url;
        }
        $userProfile = UserProfile::where('user_id', $user->id)->first();
        return view('users.profile.edit', compact('user', 'userProfile', 'socialMedia'));
    }


    public function myAssets()
    {
        $user = Auth::user();
        return view('users.profile.my-assets', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'location' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update nama user
        $fullName = trim($request->input('first_name') . ' ' . $request->input('last_name'));
        if ($fullName) {
            $user->name = $fullName;
        }
        $user->phone = $request->input('phone');
        $user->region = $request->input('location');
        $user->save();

        // Update atau buat UserProfile
        $userProfile = UserProfile::firstOrNew(['user_id' => $user->id]);
        $userProfile->bio = $request->input('bio');
        $userProfile->birthdate = $request->input('birthdate');
        $userProfile->gender = $request->input('gender');

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $image = $request->file('profile_picture');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/profil/' . $imageName;


            Storage::disk('public')->put($imagePath, file_get_contents($image));

            $user->profile_picture = $imagePath;
            $user->save();
        }

        $userProfile->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini salah.'])->withInput();
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }

    public function updateSocialMedia(Request $request)
    {
        $user = Auth::user();


        $rules = [
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'soundcloud' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->fragment('social-profiles');
        }

        $socialPlatforms = ['instagram', 'twitter', 'youtube', 'soundcloud', 'facebook', 'website'];
        $prefixes = [
            'instagram' => 'https://instagram.com/',
            'twitter' => 'https://twitter.com/',
            'youtube' => 'https://www.youtube.com/',
            'soundcloud' => 'https://soundcloud.com/',
            'facebook' => 'https://facebook.com/',
        ];

        foreach ($socialPlatforms as $platform) {
            $url = $request->input($platform);

            if ($platform !== 'website' && !empty($url) && !Str::startsWith($url, ['http://', 'https://'])) {
                if (isset($prefixes[$platform])) {
                    $url = $prefixes[$platform] . $url;
                }
            }

            if (!empty($url)) {

                UserSocialMedia::updateOrCreate(
                    ['user_id' => $user->id, 'platform' => $platform],
                    ['url' => $url]
                );
            } else {
                UserSocialMedia::where('user_id', $user->id)
                    ->where('platform', $platform)
                    ->delete();
            }
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
