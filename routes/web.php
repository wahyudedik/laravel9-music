<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use App\Http\Middleware\AdminAccessMiddleware;

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

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/adminmusic', [AdminController::class, 'showLoginFormAdmin'])->name('admin.login');
Route::post('/adminmusic/login', [AuthController::class, 'loginAdmin']);

Route::middleware(['auth', 'role:Super Admin,Admin'])->group(function () {
    Route::get('/adminmusic/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/adminmusic/logout', [AuthController::class, 'logoutAdmin'])->name('admin.logout');
});
