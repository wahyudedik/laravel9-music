<?php

use App\Http\Controllers\AdminClaimController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminUserProfileController;
use App\Http\Controllers\AdminVerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserVerificationController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;


use App\Services\Admin\SongServices;
use App\Services\Admin\UserServices;

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

    Route::get('/user', function () {
        return redirect()->route('user.dashboard');
    });
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Fitur untuk pengajuan verification status user
    Route::get('/verification/form', [UserVerificationController::class, 'showVerificationForm'])
        ->name('verification.form');
    Route::post('/verification/submit', [UserVerificationController::class, 'submitVerification'])
        ->name('verification.submit');
    Route::post('/verification/submit/artist', [UserVerificationController::class, 'submitArtistVerification'])
        ->name('verification.submit.artist');
    Route::post('/verification/submit/composer', [UserVerificationController::class, 'submitComposerVerification'])
        ->name('verification.submit.composer');
    Route::get('/verification/status', [UserVerificationController::class, 'checkStatus'])
        ->name('verification.status');

    // Untuk memutar lagu di halaman user setelah login dan menu search
    Route::get('/user/dashboard/play/{id}', [UserController::class, 'play'])->name('user.dashboard.play');

    // Profile
    Route::get('/profile/edit', function () {
        return view('users.profile.edit');
    })->name('profile.edit');

    // MyAsset Profile Route
    Route::get('/profile/my-assets', function () {
        return view('users.profile.my-assets');
    })->name('profile.my-assets');

    Route::get('/profile/my-assets/purchased', function () {
        return view('users.profile.purchased-songs');
    })->name('profile.purchased');

    Route::get('/profile/my-assets/covers', function () {
        return view('users.profile.my-covers');
    })->name('profile.covers');

    Route::get('/profile/my-assets/releases', function () {
        return view('users.profile.my-releases');
    })->name('profile.releases');

    Route::get('/profile/my-assets/drafts', function () {
        return view('users.profile.my-drafts');
    })->name('profile.drafts');

    Route::get('/profile/my-assets/uploads', function () {
        return view('users.profile.my-uploads');
    })->name('profile.uploads');

    // playlist route
    Route::get('/playlist', function () {
        return view('users.playlist');
    })->name('playlist.index');

    Route::get('/playlist/{id}', function ($id) {
        return view('users.playlist-detail');
    })->name('playlist.detail');

    // Notifikasi Route
    Route::get('/notifications', function () {
        return view('users.notifications');
    })->name('notifications');

    // live chat route
    Route::get('chat', function () {
        return view('users.chat');
    })->name('user.chat');

    // Shopping Cart Routes
    Route::get('/cart', function () {
        return view('users.cart');
    })->name('user.cart');

    Route::get('/checkout', function () {
        return view('users.checkout');
    })->name('user.checkout');

    // Wishlist Route
    Route::get('/wishlist', function () {
        // Create dummy data for the wishlist
        $wishlistItems = [];

        for ($i = 1; $i <= 9; $i++) {
            $wishlistItems[] = [
                'id' => $i,
                'title' => 'Song Title ' . $i,
                'artist' => 'Artist Name ' . ($i % 3 + 1),
                'album' => 'Album ' . ceil($i / 3),
                'type' => $i % 3 == 0 ? 'Album' : ($i % 2 == 0 ? 'Single' : 'EP'),
                'price' => $i % 4 == 0 ? null : 'Rp. ' . (rand(15, 50) * 1000) . ',00',
                'image' => 'https://picsum.photos/200/200?random=' . $i,
                'added_date' => now()->subDays(rand(1, 30))->diffForHumans()
            ];
        }

        return view('users.wishlist', compact('wishlistItems'));
    })->name('wishlist.index');

    // Report Route
    Route::get('/report', function () {
        return view('users.report');
    })->name('report.index');

    // Settings Route
    Route::get('/settings', function () {
        return view('users.settings');
    })->name('user.settings');

    // Help Center Route
    Route::get('/help-center', function () {
        return view('users.help-center');
    })->name('help.center');

    // Copyright Claim Ticketing Routes
    Route::get('/ticket/copyright', function () {
        return view('users.tickets.copyright');
    })->name('ticket.copyright');

    Route::get('/ticket/my-claims', function () {
        return view('users.tickets.my-claims');
    })->name('ticket.my-claims');

    Route::get('/ticket/claim/{id}', function ($id) {
        return view('users.tickets.claim-detail', compact('id'));
    })->name('ticket.claim.detail');

    // Wallet & Withdraw Routes
    Route::get('/wallet', function () {
        return view('users.wallet.index');
    })->name('user.wallet');

    Route::get('/wallet/history', function () {
        return view('users.wallet.history');
    })->name('user.wallet.history');

    Route::get('/wallet/withdraw', function () {
        return view('users.wallet.withdraw');
    })->name('user.wallet.withdraw');

    Route::get('/wallet/withdraw/history', function () {
        return view('users.wallet.withdraw-history');
    })->name('user.wallet.withdraw.history');
});

// Admin Routes
Route::middleware(['auth', 'role:Super Admin,Admin'])->group(function () {

    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Fitur global search di menu SuperAdmin
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

    // Claims Management - Add these lines
    Route::prefix('admin/claims')->group(function () {
        Route::get('/', [AdminClaimController::class, 'index'])->name('admin.claims.index');
        Route::get('/create', [AdminClaimController::class, 'create'])->name('admin.claims.create');
        Route::post('/store', [AdminClaimController::class, 'store'])->name('admin.claims.store');
        Route::get('/{claim}/edit', [AdminClaimController::class, 'edit'])->name('admin.claims.edit');
        Route::put('/{claim}', [AdminClaimController::class, 'update'])->name('admin.claims.update');
        Route::put('/{claim}/approve', [AdminClaimController::class, 'approve'])->name('admin.claims.approve');
        Route::put('/{claim}/reject', [AdminClaimController::class, 'reject'])->name('admin.claims.reject');
        Route::delete('/{claim}', [AdminClaimController::class, 'destroy'])->name('admin.claims.destroy');
        Route::get('/show/{claim}', function (\App\Models\Claim $claim) {
            return view('admin.claims.show', compact('claim'));
        })->name('admin.claims.show');
    });
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
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/{user}', function ($id) {
            $user = \App\Models\User::with('roles')->findOrFail($id);
            return view('admin.users.show', compact('user'));
        })->name('admin.users.show');
    });

    // Roles & Permissions Routes
    Route::prefix('admin/roles')->group(function () {

        Route::get('/', [AdminRoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/create', [AdminRoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/store', [AdminRoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/{role}/edit', [AdminRoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/{role}', [AdminRoleController::class, 'update'])->name('admin.roles.update');
        Route::delete('/{role}', [AdminRoleController::class, 'destroy'])->name('admin.roles.destroy');

        Route::prefix('permissions')->group(function () {

            Route::get('/', [AdminPermissionController::class, 'index'])->name('admin.permissions.index');
            Route::post('/store', [AdminPermissionController::class, 'store'])->name('admin.permissions.store');
            Route::put('/{permissions}', [AdminPermissionController::class, 'update'])->name('admin.permissions.update');
            Route::delete('/{permissions}', [AdminPermissionController::class, 'destroy'])->name('admin.permissions.destroy');
        });
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

    //user profile route
    Route::get('/admin/user-profiles', [AdminUserProfileController::class, 'index'])->name('admin.user-profiles.index');
    Route::get('/admin/user-profiles/{id}', [AdminUserProfileController::class, 'show'])->name('admin.user-profiles.show');
    Route::put('/admin/user-profiles/{id}', [AdminUserProfileController::class, 'update'])->name('admin.user-profiles.update');
    Route::post('/admin/user-profiles/{id}/update-picture', [AdminUserProfileController::class, 'updatePicture'])->name('admin.user-profiles.update-picture');
    Route::delete(
        '/admin/user-profiles/{id}/remove-picture',
        [AdminUserProfileController::class, 'removePicture']
    )->name('admin.user-profiles.remove-picture');
    Route::post('/admin/user-profiles/{id}/suspend', [AdminUserProfileController::class, 'suspend'])->name('admin.user-profiles.suspend');
    Route::post('/admin/user-profiles/{id}/active', [AdminUserProfileController::class, 'active'])->name('admin.user-profiles.active');
    Route::put('/admin/songs/{id}', [SongController::class, 'update'])->name('admin.songs.update');
    
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

    // Live Chat Route
    Route::get('/admin/chat', function () {
        return view('admin.chat');
    })->name('admin.chat');

    // Reports Routes
    Route::get('/admin/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::get('/admin/reports/users', function () {
        return view('admin.reports.users');
    })->name('admin.reports.users');

    Route::get('/admin/reports/revenue', function () {
        return view('admin.reports.revenue');
    })->name('admin.reports.revenue');

    Route::get('/admin/reports/content', function () {
        return view('admin.reports.content');
    })->name('admin.reports.content');

    // play song
    Route::get('/play-song/{id}', function ($id) {
        return view('play-song', compact('id'));
    })->name('play-song');

    //Utility Route
    Route::get('/admin/data/regions', function () {
        $json = Storage::disk('local')->get('data/regions.json');
        return response()->json(json_decode($json));
    });
    Route::get('/admin/data/songs', function (SongServices $songServices) {
        $search = Request::input('search');
        $limit = Request::input('limit', 10);
        return response()->json($songServices->getAllSongs($search, $limit));
    });
    Route::get('/admin/data/users', function (UserServices $uuserServices) {
        $search = Request::input('search');
        $limit = Request::input('limit', 10);
        return response()->json($uuserServices->getAllUsers($search, $limit));
    });

});




