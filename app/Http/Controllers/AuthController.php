<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('user/dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    /**
     * Proses login Admin
     */
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/adminmusic/dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    /**
     * Menampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric|digits_between:10,15',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'city' => $request->city ?? null,
            'region' => $request->region ?? null,
            'country' => 'Indonesia',
            'profile_picture' => null,
            'followers' => 0,
            'following' => 0,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/adminmusic')->with('success', 'Berhasil logout.');
    }
}
