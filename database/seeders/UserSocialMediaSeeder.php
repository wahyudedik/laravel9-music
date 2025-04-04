<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserSocialMedia;

class UserSocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id')->toArray();

        if (empty($users)) {
            $this->command->info('Tidak ada pengguna ditemukan. Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        $socialMediaPlatforms = ['Facebook', 'Twitter', 'Instagram', 'LinkedIn', 'GitHub'];

        foreach ($users as $userId) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                UserSocialMedia::create([
                    'user_id' => $userId,
                    'platform' => $socialMediaPlatforms[array_rand($socialMediaPlatforms)],
                    'url' => 'https://' . \Illuminate\Support\Str::random(10) . '.com/' . \Illuminate\Support\Str::random(8),
                ]);
            }
        }
    }
}
