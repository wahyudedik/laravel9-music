<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

use App\Models\User;



class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        activity()->withProperties(['ip' => request()->ip()])->log('user visited login form');
        return view('auth.login');
    }


    /**
     * Redirect to Google login
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->scopes(['openid', 'profile', 'email'])->redirect();
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback(Request $request)
    {
        activity()->withProperties(['ip' => request()->ip()])->log('user tries to login via google');

        $googleUser = Socialite::driver('google')->user();

        $username = explode('@', $googleUser->getEmail())[0];

        // Find user or create a new one
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()], // Find by email
            [
                'id' => Str::uuid(),
                'name' => $googleUser->getName(),
                'username' => $username,
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(Str::random(16)), // Random password
                'city' => null,
                'region' => null,
                'country' => 'Indonesia',
                'profile_picture' => $googleUser->getAvatar(),
                'followers' => 0,
                'following' => 0,
                'email_verified_at' => now(), // Automatically verified since it's Google OAuth
                'email_verification_token' => null, // No need for email verification
                'email_verification_sent_at' => null,
                'ip_address' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now(),
                'google_id' => $googleUser->getId(), // Store Google ID for future logins
            ]
        );

        // Check if user has any role
        if ($user->roles->isEmpty()) {
            // Assign 'User' role only if no role exists
            $user->assignRole('User');
        }

        // Log in the user
        Auth::login($user);

        // Update last login time & IP
        $user->update([
            'last_login' => now(),
            'ip_address' => request()->ip(),
        ]);

        // Get user role
        $role = $user->getRoleNames()->first();

        activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' login');

        if ($role == 'Admin' || $role == 'Super Admin') {
            activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' visited admin dashboard');
            return redirect('admin/dashboard')->with('success', 'Login berhasil!');
        }

        activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' visited user dashboard');
        return redirect('user/dashboard')->with('success', 'Login berhasil!');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        activity()->withProperties(['ip' => request()->ip()])->log('user tries to login');

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            User::where('id', $user->id)->update([
                'last_login' => now(),
                'ip_address' => request()->ip()
            ]);

            session(['email' => $user->email]);

            $request->session()->regenerate();

            $role = $user->getRoleNames()->first();

            // activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' login');
            activity()->causedBy($user)->event('login')->withProperties(['ip' => request()->ip()])->log($user->name . ' login'); // Tambahan event 'login'

            if ($role == 'Admin' || $role == 'Super Admin') {
                activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' visited admin dashboard');
                return redirect('admin/dashboard')->with('success', 'Login berhasil!');
            }
            activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' visited user dashboard');
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
            return redirect('/admin/dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    /**
     * Menampilkan halaman register
     */
    public function showRegisterForm()
    {
        activity()->withProperties(['ip' => request()->ip()])->log('user visited register page');
        return view('auth.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {

        activity()->withProperties(['ip' => request()->ip()])->log('user try to register');

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Generate token unik untuk verifikasi
        $verificationToken = Str::random(64);

        $username = strtolower(explode('@', $request->email)[0]);
        $count = User::where('username', $username)->count();
        if ($count > 0) {
            $username = $username . $count; // Tambahkan angka jika username sudah ada
        }

        // Buat pengguna baru
        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city' => $request->city ?? null,
            'region' => $request->region ?? null,
            'country' => 'Indonesia',
            'profile_picture' => null,
            'followers' => 0,
            'following' => 0,
            'email_verified_at' => null, // Email belum diverifikasi
            'email_verification_token' => $verificationToken, // Simpan token di database
            'email_verification_sent_at' => now(),
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->assignRole('User');

        // Buat URL verifikasi
        $verificationUrl = url('/verify-email?token=' . $verificationToken . '&email=' . $user->email);

        try {
            // Kirim email verifikasi
            Mail::to($user->email)->send(new VerifyEmailMail($user, $verificationUrl));

            session(['email' => $user->email]);

            activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' registers');

            // Redirect ke halaman pemberitahuan
            return redirect()->route('verification.notice')
                ->with('status', 'Email verifikasi telah dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }


    // Menampilkan halaman verifikasi email
    public function showVerifyEmail()
    {
        activity()->withProperties(['ip' => request()->ip()])->log('user visited mail verification page');

        return view('auth.verifikasi-email');
    }

    // Memverifikasi email setelah diklik dari email
    public function verifyEmail(Request $request)
    {

        $user = User::where('email', $request->email)
            ->where('email_verification_token', $request->token)
            ->first();

        activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' verifies email');

        if (!$user) {
            abort(403, 'Kode verifikasi tidak valid.');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null
        ]);

        Auth::login($user);

        User::where('id', $user->id)->update([
            'last_login' => now(),
            'ip_address' => request()->ip()
        ]);

        activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' email has been verified');

        return redirect('/user/dashboard')->with('status', 'Email Anda berhasil diverifikasi!');
    }

    // Mengirim ulang email verifikasi
    public function resendVerificationEmail(Request $request)
    {

        $user = User::where('email', $request->email)
            ->first();

        activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' resend email verification');

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        if ($user->hasVerifiedEmail()) {
            Auth::login($user);
            return back()
                ->with('status', 'Email Anda sudah diverifikasi.')
                ->with('dashboard', 'yes')
                ->with('message', '');
        }


        // Periksa apakah email verifikasi baru saja dikirim (kurang dari 5 menit)
        if ($user->email_verification_sent_at && now()->diffInMinutes(Carbon::parse($user->email_verification_sent_at)) < 5) {
            return back()->with('error', 'Silakan tunggu 5 menit sebelum mengirim ulang email verifikasi.');
        }

        $verificationToken = Str::random(64);
        $user->update([
            'email_verification_token' => $verificationToken,
            'email_verification_sent_at' => now(),
        ]);

        $verificationUrl = url('/verify-email?token=' . $verificationToken . '&email=' . $user->email);

        try {
            // Kirim email verifikasi
            Mail::to($user->email)->send(new VerifyEmailMail($user, $verificationUrl));

            session(['email' => $user->email]);

            activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' verification email has been sent');

            return back()
                ->with('status', 'Email verifikasi telah dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }



    /**
     * Menampilkan halaman reset password
     */
    public function showEmailResetForm()
    {
        activity()->withProperties(['ip' => request()->ip()])->log(' user visited forgot password form');

        return view('auth.forgot-password');
    }

    /**
     * Proses Kirim Reset Link ke Email
     */
    public function sendPasswordResetEmail(Request $request)
    {

        activity()->withProperties(['ip' => request()->ip()])->log('user sends password reset email');

        $validator = validator($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak ditemukan.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();
        $token = strtolower(Str::random(13));
        $user->update(['reset_token' => $token]);

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($token, $request->email));

            activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' email password has been sent');

            return back()->with('status', 'Email reset password telah dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman reset password
     */
    public function showPasswordUpdateForm($token, Request $request)
    {

        activity()->withProperties(['ip' => request()->ip()])->log(' user visited update password form');

        return view('auth.new-password', ['token' => $token, 'email' => $request->query('email')]);
    }

    /**
     * Proses Kirim Reset Link ke Email
     */
    public function updatePassword(Request $request)
    {
        activity()->withProperties(['ip' => request()->ip()])->log('user updates password');


        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak ditemukan.',

            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

            'token.required' => 'Token reset password diperlukan.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Periksa token
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->reset_token !== $request->token) {
            return back()->with('error', 'Token tidak valid atau sudah kadaluarsa.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->reset_token = null; // Hapus token setelah digunakan
        $user->save();

        activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' successfully updated password');

        return redirect('/login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }




    public function logout($role, Request $request)
    {
        $user = Auth::user();
        // activity()->withProperties(['ip' => request()->ip()])->log($user->name . ' has logged out');
        activity()->causedBy($user)->event('logout')->withProperties(['ip' => request()->ip()])->log($user->name . ' has logged out');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
