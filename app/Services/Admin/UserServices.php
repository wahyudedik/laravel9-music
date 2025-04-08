<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\Song;
use App\Models\Transaction;
use App\Models\Stream;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class UserServices
{

    public function getAllUsers($search = null, $limit = 10)
    {
        $query = User::select('id', 'name')
            ->with('roles:id,name');

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        return $query->limit($limit)->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'roleName' => $user->roles->pluck('name')->implode(', ')
            ];
        });
    }

    public function getAllArtist($search = null, $limit = 10)
    {
        $query = User::select('id', 'name')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'Artist');
            })
            ->with(['roles' => function ($q) {
                $q->where('name', 'Artist');
            }]);

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        return $query->limit($limit)->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'roleName' => 'Artist', // always Artist
            ];
        });
    }
}
