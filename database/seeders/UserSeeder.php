<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            'Super Admin',
            'Admin',
            'User',
            'Composer',
            'Artist',
            'Cover Creator'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Data user yang akan dibuat
        $users = [
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@musicx.com',
                'password' => 'superadmin123',
                'phone' => '628575466521',
                'city' => 'Jakarta',
                'region' => 'DKI Jakarta',
                'country' => 'Indonesia',
                'role' => 'Super Admin'
            ],
            // [
            //     'name' => 'Admin',
            //     'username' => 'admin',
            //     'email' => 'admin@musicx.com',
            //     'password' => 'admin123',
            //     'phone' => '6289876543210',
            //     'city' => 'Surabaya',
            //     'region' => 'Jawa Timur',
            //     'country' => 'Indonesia',
            //     'role' => 'Admin'
            // ],
            // [
            //     'name' => 'User Biasa',
            //     'username' => 'user',
            //     'email' => 'user@musicx.com',
            //     'password' => 'user123',
            //     'phone' => '6281234567890',
            //     'city' => 'Bandung',
            //     'region' => 'Jawa Barat',
            //     'country' => 'Indonesia',
            //     'role' => 'User'
            // ],

            // [
            //     'name' => 'Agung Tester',
            //     'username' => 'useragung',
            //     'email' => 'agung.nex.edp@gmail.com',
            //     'password' => 'user123',
            //     'phone' => '6281384010384',
            //     'city' => 'Tangerang',
            //     'region' => 'Banten',
            //     'country' => 'Indonesia',
            //     'role' => 'User'
            // ],
            // [
            //     'name' => 'John Composer',
            //     'username' => 'composerjohn',
            //     'email' => 'composer@musicx.com',
            //     'password' => 'composer123',
            //     'phone' => '6281122334455',
            //     'city' => 'Yogyakarta',
            //     'region' => 'DIY',
            //     'country' => 'Indonesia',
            //     'role' => 'Composer'
            // ],
            // [
            //     'name' => 'Alice Artist',
            //     'username' => 'artistalice',
            //     'email' => 'artist@musicx.com',
            //     'password' => 'artist123',
            //     'phone' => '6282233445566',
            //     'city' => 'Bali',
            //     'region' => 'Bali',
            //     'country' => 'Indonesia',
            //     'role' => 'Artist'
            // ],
            // [
            //     'name' => 'Cover Creator Kevin',
            //     'username' => 'coverkevin',
            //     'email' => 'cover@musicx.com',
            //     'password' => 'cover123',
            //     'phone' => '6283344556677',
            //     'city' => 'Medan',
            //     'region' => 'Sumatera Utara',
            //     'country' => 'Indonesia',
            //     'role' => 'Cover Creator'
            // ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']], // Mencegah duplikasi berdasarkan email
                [
                    'id' => Str::uuid(),
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'password' => Hash::make($data['password']),
                    'phone' => $data['phone'],
                    'city' => $data['city'],
                    'region' => $data['region'],
                    'country' => $data['country'],
                    'profile_picture' => null,
                    'followers' => 0,
                    'following' => 0,
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Assign role ke user
            $user->assignRole($data['role']);
        }

        // User::firstOrCreate(
        //     ['email' => 'guest@musicx.com'],
        //     [
        //         'id' => Str::uuid(),
        //         'name' => 'Guest User',
        //         'username' => 'guest',
        //         'password' => Hash::make('guest123'),
        //         'phone' => '6280000000000', 
        //         'city' => 'Unknown',
        //         'region' => 'Unknown',
        //         'country' => 'Unknown',
        //         'profile_picture' => null,
        //         'followers' => 0,
        //         'following' => 0,
        //         'email_verified_at' => now(),
        //         'remember_token' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // );
    }
}
