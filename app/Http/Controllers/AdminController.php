<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Models\Album;
use App\Models\Claim;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Services\Admin\DashboardServices;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function showLoginFormAdmin()
    {

        if (Auth::check()) {
            if (Auth::user()->hasRole(['Super Admin', 'Admin'])) {
                return redirect()->route('admin.dashboard');
            }
            abort(403, 'Unauthorized Access');
        }

        return view('admin.login');
    }

    public function dashboard(DashboardServices $DashboardServices)
    {
        $totalUsers = number_format($DashboardServices->getTotalUsers());
        $userGrowthPercentage = $DashboardServices->getUserGrowthPercentage();
        $totalSongs = number_format($DashboardServices->getTotalSongs());
        $songGrowthPercentage = $DashboardServices->getSongGrowthPercentage();
        $totalRevenue = number_format($DashboardServices->getTotalRevenue(), 2);
        $revenueGrowthPercentage = $DashboardServices->getRevenueGrowthPercentage();
        $totalStreams = number_format($DashboardServices->getTotalStreams());
        $streamGrowthPercentage = $DashboardServices->getStreamGrowthPercentage();
        $recentSongs = $DashboardServices->getRecentSongs();
        $topGenres = $DashboardServices->getSongGenre();
        $topGenres = collect($topGenres)->sortByDesc(fn($genre) => $genre->percentage)->toArray();
        $recentActivities = $DashboardServices->getRecentActivities();

        $recentClaims = Claim::with(['user', 'song'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'userGrowthPercentage',
            'totalSongs',
            'songGrowthPercentage',
            'totalRevenue',
            'revenueGrowthPercentage',
            'totalStreams',
            'streamGrowthPercentage',
            'recentClaims',
            'recentSongs',
            'topGenres',
            'recentActivities'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $songs = Song::where('title', 'LIKE', "%$query%")->get()->map(function ($song) {
            $song->type = 'song';
            return $song;
        });

        $albums = Album::where('title', 'LIKE', "%$query%")->get()->map(function ($album) {
            $album->type = 'album';
            return $album;
        });

        $users = User::where('name', 'LIKE', "%$query%")->get()->map(function ($user) {
            $user->type = 'user';
            return $user;
        });

        $results = $songs->merge($albums)->merge($users);

        return view('admin.dashboard', compact('results', 'query'));
    }

    public function createClaim()
    {
        $users = User::all();
        $songs = Song::all();
        return view('admin.claims.create', compact('users', 'songs'));
    }

    public function storeClaim(Request $request)
    {
        $request->validate([
            'user_id' => 'required|uuid',
            'song_id' => 'required|uuid',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = Str::uuid() . '.' . $document->getClientOriginalExtension();
            $documentPath = 'storage/' . $document->storeAs('uploads/claims', $documentName, 'public');
        }

        Claim::create([
            'user_id' => $request->user_id,
            'song_id' => $request->song_id,
            'status' => 'pending',
            'document' => $documentPath,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Klaim berhasil ditambahkan.');
    }

    public function editClaim($id)
    {
        $claim = Claim::findOrFail($id);
        $users = User::all();
        $songs = Song::all();
        return view('admin.claims.edit', compact('claim', 'users', 'songs'));
    }

    public function updateClaim(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|uuid',
            'song_id' => 'required|uuid',
            'status' => 'required|in:pending,approved,rejected',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $claim = Claim::findOrFail($id);

        $documentPath = $claim->document;
        if ($request->hasFile('document')) {
            if ($documentPath) {
                \Storage::disk('public')->delete(str_replace('storage/', '', $documentPath));
            }

            $document = $request->file('document');
            $documentName = Str::uuid() . '.' . $document->getClientOriginalExtension();
            $documentPath = 'storage/' . $document->storeAs('uploads/claims', $documentName, 'public');
        }

        $claim->update([
            'user_id' => $request->user_id,
            'song_id' => $request->song_id,
            'status' => $request->status,
            'document' => $documentPath,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Klaim berhasil diperbarui.');
    }

    public function deleteClaim($id)
    {
        $claim = Claim::findOrFail($id);

        if ($claim->document) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $claim->document));
        }

        $claim->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Klaim berhasil dihapus.');
    }
}
