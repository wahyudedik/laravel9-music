<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\Song;
use App\Models\Transaction;
use App\Models\Stream;
use Carbon\Carbon;

class DashboardServices
{
    /**
     * Get total users count.
     *
     * @return int
     */
    public function getTotalUsers()
    {
        return User::count();
    }

    /**
     * Get percentage of users registered this month.
     *
     * @return float
     */
    public function getUserGrowthPercentage()
    {
        $totalUsers = User::count();
        $usersThisMonth = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        if ($totalUsers == 0) {
            return 0;
        }

        return round(($usersThisMonth / $totalUsers) * 100, 2);
    }

    /**
     * Get total songs count.
     */
    public function getTotalSongs()
    {
        return Song::count();
    }

    /**
     * Get percentage of songs added this month.
     */
    public function getSongGrowthPercentage()
    {
        $totalSongs = Song::count();
        $songsThisMonth = Song::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        return $totalSongs ? round(($songsThisMonth / $totalSongs) * 100, 2) : 0;
    }

    /**
     * Get total revenue from completed transactions.
     */
    public function getTotalRevenue()
    {
        return Transaction::where('status', 'completed')->sum('amount');
    }

    /**
     * Get revenue growth percentage for this month.
     */
    public function getRevenueGrowthPercentage()
    {
        $totalRevenue = Transaction::where('status', 'completed')->sum('amount');
        $revenueThisMonth = Transaction::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        return $totalRevenue ? round(($revenueThisMonth / $totalRevenue) * 100, 2) : 0;
    }

    /**
     * Get total streams count.
     */
    public function getTotalStreams()
    {
        return Stream::count();
    }

    /**
     * Get stream growth percentage for this month.
     */
    public function getStreamGrowthPercentage()
    {
        $totalStreams = Stream::count();
        $streamsThisMonth = Stream::whereBetween('played_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        return $totalStreams ? round(($streamsThisMonth / $totalStreams) * 100, 2) : 0;
    }


}
