<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

use App\Services\Admin\DashboardServices;

class AdminController extends Controller
{

    public function showLoginFormAdmin(){

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

        return view('admin.dashboard', compact(
            'totalUsers',
            'userGrowthPercentage',
            'totalSongs',
            'songGrowthPercentage',
            'totalRevenue',
            'revenueGrowthPercentage',
            'totalStreams',
            'streamGrowthPercentage',
            'recentSongs',
            'topGenres',
            'recentActivities'
        ));

    }
}
