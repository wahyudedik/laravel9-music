<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DummySongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->pluck('id')->toArray();
        $albums = DB::table('albums')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('songs')->insert([
                'id' => Str::uuid(),
                'title' => 'Dummy Song ' . ($i + 1),
                'version' => 'Original',
                'album_id' => $albums[array_rand($albums)] ?? null,
                'composer_id' => $users[array_rand($users)],
                'artist_id' => $users[array_rand($users)] ?? null,
                'cover_creator_id' => $users[array_rand($users)] ?? null,
                'cover_version' => 'Original Artist',
                'license_status' => 'approved',
                'release_date' => now()->subDays(rand(0, 365)),
                'play_count' => rand(0, 1000),
                'like_count' => rand(0, 500),
                'cover_image' => 'upload/songs/dummy_cover_' . ($i + 1) . '.png',
                'file_path' => 'upload/songs/dummy_audio_' . ($i + 1) . '.mp3',
                'duration' => rand(180, 300),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
