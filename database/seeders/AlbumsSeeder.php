<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlbumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('albums')->insert([
                'id' => Str::uuid(),
                'artist_id' => $users[array_rand($users)],
                'title' => 'Dummy Album ' . ($i + 1),
                'cover_image' => 'upload/albums/dummy_cover_' . ($i + 1) . '.png,upload/albums/dummy_cover_' . ($i + 1) . '_md.png,upload/albums/dummy_cover_' . ($i + 1) . '_sm.png',
                'release_date' => now()->subDays(rand(0, 365)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
