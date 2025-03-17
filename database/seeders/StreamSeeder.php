<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StreamSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel streams.
     *
     * @return void
     */
    public function run()
    {
        // Ambil daftar user ID dan song ID dari database
        $users = DB::table('users')->pluck('id')->toArray();
        $songs = DB::table('songs')->pluck('id')->toArray();

        // Pastikan ada data user dan lagu
        if (empty($users)) {
            $this->command->warn('Tidak ada data user tersedia. Seeder dihentikan.');
            return;
        }

        if (empty($songs)) {
            $this->command->warn('Tidak ada data lagu tersedia. Seeder dihentikan.');
            return;
        }

        // Loop untuk membuat 100 stream data
        for ($i = 0; $i < 100; $i++) {
            $userId = $users[array_rand($users)];
            $songId = $songs[array_rand($songs)];
            $playedAt = now()->subMinutes(rand(0, 1440)); // Waktu acak dalam 24 jam terakhir

            DB::table('streams')->updateOrInsert(
                ['user_id' => $userId, 'song_id' => $songId], // Cek kombinasi user & song
                [
                    'id' => DB::table('streams')
                        ->where('user_id', $userId)
                        ->where('song_id', $songId)
                        ->value('id') ?? Str::uuid(), // ID tetap sama jika sudah ada
                    'played_at' => $playedAt,
                ]
            );
        }
    }
}
