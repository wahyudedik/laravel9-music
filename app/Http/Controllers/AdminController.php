<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function showLoginFormAdmin(){

        if (Auth::check()) {
            if (Auth::user()->hasRole(['Super Admin', 'Admin'])) {
                return redirect()->route('admin.dashboard');
            }
            abort(403, 'Unauthorized Access');
        }

        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
