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
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;


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

            $user = Auth::user();

            User::where('id', $user->id)->update(['last_login' => now()]);

            session(['email' => $user->email]);

            $request->session()->regenerate();

            $role = $user->getRoleNames()->first();

            if ($role == 'Admin' || $role == 'Super Admin') {
                return redirect('admin/dashboard')->with('success', 'Login berhasil!');
            }
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
        return view('auth.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
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
        return view('auth.verifikasi-email');
    }

    // Memverifikasi email setelah diklik dari email
    public function verifyEmail(Request $request)
    {

        $user = User::where('email', $request->email)
            ->where('email_verification_token', $request->token)
            ->first();

        if (!$user) {
            abort(403, 'Kode verifikasi tidak valid.');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null
        ]);

        Auth::login($user);

        return redirect('/user/dashboard')->with('status', 'Email Anda berhasil diverifikasi!');
    }

    // Mengirim ulang email verifikasi
    public function resendVerificationEmail(Request $request)
    {

        $user = User::where('email', $request->email)
            ->first();

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
        return view('auth.forgot-password');
    }

    /**
     * Proses Kirim Reset Link ke Email
     */
    public function sendPasswordResetEmail(Request $request)
    {
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
        return view('auth.new-password', ['token' => $token, 'email' => $request->query('email')]);
    }

    /**
     * Proses Kirim Reset Link ke Email
     */
    public function updatePassword(Request $request)
    {

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

        return redirect('/login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }




    public function logout($role, Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
