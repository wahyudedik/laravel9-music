<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Song;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserSocialMedia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminUserProfileController extends Controller
{
    public function index()
    {
        $users = User::withCount('songs', 'covers', 'albums')->with('roles')->limit(10)->get();
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


        return view('admin.user-profiles.show', compact('user', 'songs', 'covers', 'albums', 'publishedSongs', 'roles', 'socialMedia', 'userProfile'));
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'status' => 'required|in:active,suspended',
            'verification' => 'required|in:active,suspended',
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

        return redirect()->route('admin.user-profiles.show', $id)->with('success', 'User profile updated successfully.');
    }
}
