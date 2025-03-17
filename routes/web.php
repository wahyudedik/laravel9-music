<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::get('/password/reset', [AuthController::class, 'showEmailResetForm'])->name('password.reset');
Route::post('/password/email', [AuthController::class, 'sendPasswordResetEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showPasswordUpdateForm'])->name('password.token');
Route::post('/password/reset', [AuthController::class, 'updatePassword'])->name('password.update');


// Rute untuk menampilkan halaman notifikasi verifikasi email
Route::get('/email/verify', [AuthController::class, 'showVerifyEmail'])
    ->name('verification.notice');

// Rute untuk menangani verifikasi email melalui token
Route::get('/verify-email', [AuthController::class, 'verifyEmail'])
    ->name('verify.email');

// Rute untuk mengirim ulang email verifikasi
Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])
    ->middleware(['throttle:6,1'])
    ->name('verification.resend');

Route::middleware('auth','role:User,Cover Creator,Artist,Composer,Super Admin,Admin')->group(function () {
    Route::post('/logout/{role}', [AuthController::class, 'logout'])
            ->name('logout');
});

Route::middleware('auth', 'role:User,Cover Creator,Artist,Composer')->group(function () {
    Route::middleware(['verified'])->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'dashboard'])
            ->name('user.dashboard');
    });
});

Route::get('/adminmusic', [AdminController::class, 'showLoginFormAdmin'])->name('admin.login');
Route::post('/adminmusic/login', [AuthController::class, 'loginAdmin']);
Route::middleware(['auth', 'role:Super Admin,Admin'])->group(function () {
    Route::get('/adminmusic/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
