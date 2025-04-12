<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            [
                'name' => 'Pop',
                'description' => 'Musik populer dengan melodi ringan dan mudah diingat.',
                'icon_color' => '#ff6384',
                'status' => 'active',
            ],
            [
                'name' => 'Rock',
                'description' => 'Genre musik dengan dominasi gitar dan drum.',
                'icon_color' => '#36a2eb',
                'status' => 'active',
            ],
            [
                'name' => 'Jazz',
                'description' => 'Musik dengan improvisasi dan harmoni kompleks.',
                'icon_color' => '#9966ff',
                'status' => 'pending',
            ],
            [
                'name' => 'Hip Hop',
                'description' => 'Musik yang berakar dari rap dan beat.',
                'icon_color' => '#ffce56',
                'status' => 'active',
            ],
            [
                'name' => 'Classical',
                'description' => 'Musik orkestra dari era klasik.',
                'icon_color' => '#4bc0c0',
                'status' => 'inactive',
            ],
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'id' => (string) Str::uuid(),
                'name' => $genre['name'],
                'description' => $genre['description'],
                'icon_color' => $genre['icon_color'],
                'status' => $genre['status'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
