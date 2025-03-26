<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserProfileController extends Controller
{
    public function index()
    {
        $users = User::withCount('songs', 'covers', 'albums')->with('roles')->limit(10)->get();
        $users->load('verification');
        return view('admin.user-profiles.index', compact('users'));
    }
}
