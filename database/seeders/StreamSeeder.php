<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StreamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->pluck('id')->toArray();
        $songs = DB::table('songs')->pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            DB::table('streams')->insert([
                'id' => Str::uuid(),
                'user_id' => $users[array_rand($users)] ?? null,
                'song_id' => $songs[array_rand($songs)],
                'played_at' => now()->subMinutes(rand(0, 1440)), // Waktu acak dalam 24 jam terakhir
            ]);
        }
    }
}
