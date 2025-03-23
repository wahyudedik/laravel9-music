<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;


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
});

// Admin Routes
Route::middleware(['auth', 'role:Super Admin,Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //User Management
    Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user.index'); // List User
    Route::get('/admin/user/create', [AdminUserController::class, 'create'])->name('admin.user.create'); // Form Tambah User
    Route::post('/admin/user', [AdminUserController::class, 'store'])->name('admin.user.store'); // Simpan User Baru
    Route::get('/admin/user/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit'); // Form Edit User
    Route::put('/admin/user/{id}', [AdminUserController::class, 'update'])->name('admin.user.update'); // Update User
    Route::delete('/admin/user/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy'); // Hapus User

});

//Utility Route
Route::get('/regions', function () {
    $json = Storage::disk('local')->get('data/regions.json');
    return response()->json(json_decode($json));
});
