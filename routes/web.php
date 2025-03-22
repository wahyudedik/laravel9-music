<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
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

// Landing Page atau Home
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/popular-songs', function () {
    return view('popular-songs');
})->name('popular-songs');
Route::get('/artists', function () {
    return view('artists');
})->name('artists');
Route::get('/composers', function () {
    return view('composers');
})->name('composers');
Route::get('/covers', function () {
    return view('covers');
})->name('covers');

// Route Dashboard User


// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Password Reset Routes
Route::get('/password/reset', [AuthController::class, 'showEmailResetForm'])->name('password.reset');
Route::post('/password/email', [AuthController::class, 'sendPasswordResetEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showPasswordUpdateForm'])->name('password.token');
Route::post('/password/reset', [AuthController::class, 'updatePassword'])->name('password.update');

// Email Verification Routes
Route::get('/email/verify', [AuthController::class, 'showVerifyEmail'])->name('verification.notice');
Route::get('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify.email');
Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])
    ->middleware('throttle:6,1')
    ->name('verification.resend');

// Authenticated User Routes
Route::middleware(['auth', 'role:User,Cover Creator,Artist,Composer,Super Admin,Admin'])->group(function () {
    Route::post('/logout/{role}', [AuthController::class, 'logout'])->name('logout');
});

// User Dashboard Routes
Route::middleware(['auth', 'role:User,Cover Creator,Artist,Composer', 'verified'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

// Admin Routes
Route::middleware(['auth', 'role:Super Admin,Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
