<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Song;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserSocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\ActivityLog;

class AdminUserProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('songs', 'covers', 'albums')->with('roles');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('username', 'like', "%{$searchTerm}%");
            });
        }

        // Filter functionality
        if ($request->has('filter') && !empty($request->filter)) {
            switch ($request->filter) {
                case 'artists':
                    $query->whereHas('roles', function ($q) {
                        $q->where('name', 'artist');
                    });
                    break;
                case 'composers':
                    $query->whereHas('roles', function ($q) {
                        $q->where('name', 'composer');
                    });
                    break;
                case 'cover_creators':
                    $query->has('covers');
                    break;
                case 'regular_users':
                    $query->whereDoesntHave('roles', function ($q) {
                        $q->whereIn('name', ['admin', 'artist', 'composer']);
                    });
                    break;
            }
        }

        // Sorting functionality
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $users = $query->paginate($perPage);

        // Load verification data
        $users->load('verification');

        return view('admin.user-profiles.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        $songs = Song::where('artist_id', $id)->get();
        $covers = Song::where('cover_creator_id', $id)->get();
        $albums = Album::where('artist_id', $id)->get();

        $publishedSongs = Song::where('status', 'published')->where(function ($query) use ($id) {
            $query->where('artist_id', $id)
                ->orWhere('cover_creator_id', $id)
                ->orWhereIn('album_id', function ($subquery) use ($id) {
                    $subquery->select('id')
                        ->from('albums')
                        ->where('artist_id', $id);
                });
        })->get();

        $roles = Role::all();
        $socialMedia = UserSocialMedia::where('user_id', $id)->get();
        $userProfile = UserProfile::where('user_id', $id)->get();



        $activities = ActivityLog::with('subjectUser') // eager loading relasi user
            ->select('description', 'causer_id', 'subject_id', 'created_at', 'updated_at')
            ->where('causer_id', $id)
            ->latest()
            ->get();



        return view('admin.user-profiles.show', compact('user', 'songs', 'covers', 'albums', 'publishedSongs', 'roles', 'socialMedia', 'userProfile', 'activities'));
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        $oldAttributes = $user->getAttributes();
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'status' => 'required|in:approved,suspended',
            'verification' => 'required|in:approved,suspended',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'role' => 'required|integer|exists:roles,id',
            'bio' => 'nullable|string',
        ]);

        $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->username = $request->input('username');
        $user->region = $request->input('location');
        $user->save();

        if ($user->verification) {
            $user->verification->status = $request->input('verification');
            $user->verification->save();
        }

        if ($user->verification) {
            $user->verification->status = $request->input('status');
            $user->verification->save();
        }

        $roleId = intval($request->input('role'));
        if (Role::where('id', $roleId)->exists()) {
            $user->syncRoles([$roleId]);
        } else {
            return redirect()->back()->withErrors(['role' => 'Selected role does not exist.']);
        }

        UserProfile::updateOrCreate(
            ['user_id' => $id],
            ['bio' => $request->input('bio')]
        );

        UserSocialMedia::updateOrCreate(
            ['user_id' => $id],
            ['url' => $request->input('website')]
        );

        $newAttributes = $user->getChanges();

        if (!empty($newAttributes)) {
            activity()
                ->performedOn($user)
                ->withProperties(['old' => $oldAttributes, 'attributes' => $newAttributes, 'ip' => request()->ip()])
                ->log(auth()->user()->name . ' updated profile');
        }

        return redirect()->route('admin.user-profiles.show', $id)->with('success', 'User profile updated successfully.');
    }

    public function updatePicture(Request $request, $id)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $oldAttributes = $user->getAttributes();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }

            $image = $request->file('profile_picture');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/profil/' . $imageName;

            Storage::disk('public')->put($imagePath, file_get_contents($image));

            $user->profile_picture = $imagePath;
            $user->save();
        }

        $newAttributes = $user->getChanges();

        if (!empty($newAttributes)) {
            activity()
                ->performedOn($user)
                ->withProperties(['old' => $oldAttributes, 'attributes' => $newAttributes, 'ip' => request()->ip()])
                ->log(auth()->user()->name . ' updated picture profile');
        }

        return redirect()->route('admin.user-profiles.show', $id)->with('success', 'Profile picture updated successfully.');
    }
    public function removePicture($id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
            $user->profile_picture = null;
            $user->save();
        }

        return response()->json(['success' => true]);
    }

    public function suspend($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user-profiles.index')->with('error', 'User not found.');
        }

        if ($user->verification) {
            $user->verification->status = 'suspended';
            $user->verification->save();
            return redirect()->route('admin.user-profiles.index')->with('success', 'User verification suspended.');
        }

        return redirect()->route('admin.user-profiles.index')->with('error', 'User verification not found.');
    }

    public function active($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user-profiles.index')->with('error', 'User not found.');
        }

        if ($user->verification) {
            $user->verification->status = 'approved';
            $user->verification->save();
            return redirect()->route('admin.user-profiles.index')->with('success', 'User verification active.');
        }

        return redirect()->route('admin.user-profiles.index')->with('error', 'User verification not found.');
    }
}
