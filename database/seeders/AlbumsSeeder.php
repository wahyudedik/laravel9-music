<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlbumsSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel albums.
     *
     * @return void
     */
    public function run()
    {
        // Ambil daftar user ID dari tabel users
        $users = DB::table('users')->pluck('id')->toArray();

        // Pastikan ada user yang tersedia
        if (empty($users)) {
            $this->command->warn('Tidak ada data user tersedia. Seeder dihentikan.');
            return;
        }

        // Loop untuk membuat 10 album dummy
        for ($i = 1; $i <= 10; $i++) {
            $title = 'Dummy Album ' . $i;

            DB::table('albums')->updateOrInsert(
                ['title' => $title], // Cek berdasarkan title
                [
                    'id' => DB::table('albums')->where('title', $title)->value('id') ?? Str::uuid(),
                    'artist_id' => $users[array_rand($users)],
                    'cover_image' => 'upload/albums/dummy_cover_' . $i . '.png,upload/albums/dummy_cover_' . $i . '_md.png,upload/albums/dummy_cover_' . $i . '_sm.png',
                    'release_date' => now()->subDays(rand(0, 365)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
