<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminVerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserVerificationController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;



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

    // Fitur untuk pengajuan verification status user
    Route::get('/verification/form', [UserVerificationController::class, 'showVerificationForm'])->name('verification.form');
    Route::post('/verification/submit', [UserVerificationController::class, 'submitVerification'])->name('verification.submit');
});

// Admin Routes
Route::middleware(['auth', 'role:Super Admin,Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Fitur global search di menu SuperAdmin
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

    // CRUD Claims / Ticketing System
    Route::get('/admin/claims/create', [AdminController::class, 'createClaim'])->name('admin.claims.create');
    Route::post('/admin/claims', [AdminController::class, 'storeClaim'])->name('admin.claims.store');
    Route::get('/admin/claims/{id}/edit', [AdminController::class, 'editClaim'])->name('admin.claims.edit');
    Route::put('/admin/claims/{id}', [AdminController::class, 'updateClaim'])->name('admin.claims.update');
    Route::delete('/admin/claims/{id}', [AdminController::class, 'deleteClaim'])->name('admin.claims.delete');

    // Verifikasi Pengguna oleh admin
    Route::prefix('admin/verifications')->group(function () {
        Route::get('/', [AdminVerificationController::class, 'index'])->name('admin.verifications.index');
        Route::post('/{id}/approve', [AdminVerificationController::class, 'approve'])->name('admin.verifications.approve');
        Route::post('/{id}/reject', [AdminVerificationController::class, 'reject'])->name('admin.verifications.reject');
    });
});
