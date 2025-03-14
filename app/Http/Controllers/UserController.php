<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Song;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = $request->input('q');
        $results = [];
        $allSongs = Song::with('artist')->get();

        if ($query) {
            $results = Song::where('title', 'like', "%$query%")
                ->orWhereHas('artist', function ($q) use ($query) {
                    $q->where('name', 'like', "%$query%");
                })
                ->with('artist')
                ->get();
        }

        return view('users.dashboard', ['results' => $results, 'query' => $query, 'allSongs' => $allSongs]);
    }
}
