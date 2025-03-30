<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use Faker\Factory as Faker;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id')->toArray();
        $faker = Faker::create();

        if (empty($users)) {
            $this->command->info('Tidak ada pengguna ditemukan. Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        foreach ($users as $userId) {
            UserProfile::create([
                'user_id' => $userId,
                'gender' => $faker->randomElement(['male', 'female']),
                'birthdate' => $faker->date(),
                'address' => $faker->address,
                'bio' => $faker->sentence,
                'background_image' => $faker->imageUrl(),
            ]);
        }
    }
}
