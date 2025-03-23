
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminClaimController;
use App\Http\Controllers\UserVerificationController;
use App\Http\Controllers\AdminVerificationController;
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

// Route dibuat frontend Landing Page atau Home
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

// Route dibuat frontend Dashboard User
// Route dibuat frontend Dashboard admin


// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
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
    Route::get('/verification/status', [UserVerificationController::class, 'checkStatus'])->name('verification.status');


});

// Admin Routes
Route::middleware(['auth', 'role:Super Admin,Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    // Fitur global search di menu SuperAdmin
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

    // Claims Management - Add these lines
    Route::resource('admin/claims', AdminClaimController::class, ['as' => 'admin']);
    Route::post('/admin/claims/{claim}/unclaim', [AdminClaimController::class, 'unclaimSong'])->name('admin.claims.unclaim');

    // Verifikasi Pengguna oleh admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/verifications', [AdminVerificationController::class, 'index'])->name('verifications.index');
        Route::post('/verifications', [AdminVerificationController::class, 'store'])->name('verifications.store');
        Route::get('/verifications/{id}/details', [AdminVerificationController::class, 'getDetails']);
        Route::put('/verifications/{id}', [AdminVerificationController::class, 'update'])->name('verifications.update');
        Route::delete('/verifications/{id}', [AdminVerificationController::class, 'destroy'])->name('verifications.destroy');
        Route::post('/verifications/{id}/approve', [AdminVerificationController::class, 'approve'])->name('verifications.approve');
        Route::post('/verifications/{id}/reject', [AdminVerificationController::class, 'reject'])->name('verifications.reject');
    });

    // User Management Routes
    Route::prefix('admin/users')->group(function () {
        Route::get('/', function () {
            $users = \App\Models\User::with('roles')->paginate(10);
            return view('admin.users.index', compact('users'));
        })->name('admin.users.index');

        Route::get('/create', function () {
            $roles = \Spatie\Permission\Models\Role::all();
            return view('admin.users.create', compact('roles'));
        })->name('admin.users.create');

        Route::get('/{user}/edit', function ($id) {
            $user = \App\Models\User::findOrFail($id);
            $roles = \Spatie\Permission\Models\Role::all();
            return view('admin.users.edit', compact('user', 'roles'));
        })->name('admin.users.edit');

        Route::get('/{user}', function ($id) {
            $user = \App\Models\User::with('roles')->findOrFail($id);
            return view('admin.users.show', compact('user'));
        })->name('admin.users.show');
    });

    // Roles & Permissions Routes
    Route::prefix('admin/roles')->group(function () {
        Route::get('/', function () {
            $roles = \Spatie\Permission\Models\Role::with('permissions')->paginate(10);
            return view('admin.roles.index', compact('roles'));
        })->name('admin.roles.index');

        Route::get('/create', function () {
            $permissions = \Spatie\Permission\Models\Permission::all();
            return view('admin.roles.create', compact('permissions'));
        })->name('admin.roles.create');

        Route::get('/{role}/edit', function ($id) {
            $role = \Spatie\Permission\Models\Role::with('permissions')->findOrFail($id);
            $permissions = \Spatie\Permission\Models\Permission::all();
            return view('admin.roles.edit', compact('role', 'permissions'));
        })->name('admin.roles.edit');

        Route::get('/permissions', function () {
            $permissions = \Spatie\Permission\Models\Permission::paginate(15);
            return view('admin.roles.permissions', compact('permissions'));
        })->name('admin.permissions.index');
    });

    // Song Management Routes
    Route::prefix('admin/songs')->group(function () {
        Route::get('/', function () {
            return view('admin.songs.index');
        })->name('admin.songs.index');

        Route::get('/create', function () {
            return view('admin.songs.create');
        })->name('admin.songs.create');

        Route::get('/{id}/edit', function ($id) {
            return view('admin.songs.edit', compact('id'));
        })->name('admin.songs.edit');

        Route::get('/{id}', function ($id) {
            return view('admin.songs.show', compact('id'));
        })->name('admin.songs.show');
    });

    // Album and Genre routes
    Route::get('/admin/albums', function () {
        return view('admin.albums.index');
    })->name('admin.albums.index');

    Route::get('/admin/genres', function () {
        return view('admin.genres.index');
    })->name('admin.genres.index');

    // Admin User Profile Management Route
    Route::get('/admin/user-profiles', function () {
        return view('admin.user-profiles.index');
    })->name('admin.user-profiles.index');

    Route::get('/admin/user-profiles/{id}', function ($id) {
        // In a real implementation, you would fetch the user by ID
        return view('admin.user-profiles.show', compact('id'));
    })->name('admin.user-profiles.show');

    // Withdraw Verification Routes
    Route::get('/admin/withdrawals', function () {
        return view('admin.withdrawals.index');
    })->name('admin.withdrawals.index');

    Route::get('/admin/withdrawals/{id}', function ($id) {
        return view('admin.withdrawals.show', compact('id'));
    })->name('admin.withdrawals.show');

    // User Data Listing Routes
    Route::get('/admin/song-list', function () {
        return view('admin.listings.songs');
    })->name('admin.listings.songs');

    Route::get('/admin/cover-list', function () {
        return view('admin.listings.covers');
    })->name('admin.listings.covers');

    Route::get('/admin/published-songs', function () {
        return view('admin.listings.published');
    })->name('admin.listings.published');

    Route::get('/admin/draft-songs', function () {
        return view('admin.listings.drafts');
    })->name('admin.listings.drafts');

    // Add this in the Admin Routes section
    Route::get('/admin/notifications', function () {
        return view('admin.notifications');
    })->name('admin.notifications');

    // Add these in the Admin Routes section
    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');

    Route::get('/admin/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');

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
