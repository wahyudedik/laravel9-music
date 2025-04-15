<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Menambahkan data social media ke tabel social_medias
     * menggunakan firstOrCreate untuk mencegah duplikasi.
     */
    public function run(): void
    {
        $socialMedias = [
            ['name' => 'YouTube', 'slug' => 'youtube'],
            ['name' => 'Vimeo', 'slug' => 'vimeo'],
            ['name' => 'Facebook', 'slug' => 'facebook'],
            ['name' => 'Instagram', 'slug' => 'instagram'],
            ['name' => 'TikTok', 'slug' => 'tiktok'],
            ['name' => 'Twitter', 'slug' => 'twitter'],
            ['name' => 'Spotify', 'slug' => 'spotify'],
            ['name' => 'SoundCloud', 'slug' => 'soundcloud'],
            ['name' => 'Dailymotion', 'slug' => 'dailymotion'],
            ['name' => 'Pinterest', 'slug' => 'pinterest'],
            ['name' => 'LinkedIn', 'slug' => 'linkedin'],
            ['name' => 'Twitch', 'slug' => 'twitch'],
            ['name' => 'Google Maps', 'slug' => 'google-maps'],
            ['name' => 'Mixcloud', 'slug' => 'mixcloud'],
            ['name' => 'Bandcamp', 'slug' => 'bandcamp'],
            ['name' => 'Deezer', 'slug' => 'deezer'],
        ];

        foreach ($socialMedias as $socialMedia) {
            // Insert atau update jika sudah ada slug yang sama
            DB::table('social_medias')->updateOrInsert(
                ['slug' => $socialMedia['slug']], // kondisi pencarian berdasarkan slug
                [
                    'id' => (string) Str::uuid(),
                    'name' => $socialMedia['name'],
                    'slug' => $socialMedia['slug'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
