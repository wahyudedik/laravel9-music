<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Stream;
use App\Models\User;
use App\Models\UserProfile;
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

        $userProfile = UserProfile::where('user_id', $user->id)->first();
        return view('users.profile.edit', compact('user', 'userProfile'));
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
}
