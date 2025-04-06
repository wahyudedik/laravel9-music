<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DummySongSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel songs.
     *
     * @return void
     */
    public function run()
    {
        // Ambil daftar user ID dan album ID dari database
        $users = DB::table('users')->pluck('id')->toArray();
        $albums = DB::table('albums')->pluck('id')->toArray();
        $genres = ['Pop', 'Rock', 'Jazz', 'Electronic', 'Hip Hop', 'Country', 'Classical', 'Reggae', 'Metal', 'Folk']; // Daftar genre

        // Pastikan ada user dan album tersedia
        if (empty($users)) {
            $this->command->warn('Tidak ada data user tersedia. Seeder dihentikan.');
            return;
        }

        if (empty($albums)) {
            $this->command->warn('Tidak ada data album tersedia. Seeder dihentikan.');
            return;
        }

        // Loop untuk membuat 10 lagu dummy
        for ($i = 1; $i <= 10; $i++) {
            $title = 'Dummy Song ' . $i;

            DB::table('songs')->updateOrInsert(
                ['title' => $title], // Cek berdasarkan title
                [
                    'id' => DB::table('songs')->where('title', $title)->value('id') ?? Str::uuid(),
                    'version' => 'Original',
                    'genre' => $genres[array_rand($genres)], // Pilih genre acak
                    'album_id' => $albums[array_rand($albums)] ?? null,
                    'composer_id' => $users[array_rand($users)],
                    'artist_id' => $users[array_rand($users)] ?? null,
                    'cover_creator_id' => $users[array_rand($users)] ?? null,
                    'cover_version' => 'Original Artist',
                    'license_status' => 'approved',
                    'release_date' => now()->subDays(rand(0, 365)),
                    'play_count' => rand(0, 1000),
                    'like_count' => rand(0, 500),
                    'cover_image' => 'uploads/songs/dummy_cover_' . $i . '.png',
                    'file_path' => 'uploads/songs/dummy_audio_' . $i . '.mp3',
                    'duration' => rand(180, 300),
                    'status' => 'published', // Set status ke published
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
