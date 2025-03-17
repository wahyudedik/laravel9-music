<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SiteConfigsSeeder extends Seeder
{
    public function run()
    {
        $configurations = [
            [
                'key' => 'site_name',
                'value' => 'Music Cool Poll',
                'description' => 'Nama dari situs web.',
            ],
            [
                'key' => 'site_logo',
                'value' => 'https://placehold.co/400x600,https://placehold.co/200x300,https://placehold.co/100x150',
                'description' => 'Logo dari situs web dalam tiga ukuran: Large (600x400), Medium (300x200), Small (150x100). Upload disimpan dalam folder /storage/upload/images ',
            ],
            [
                'key' => 'favicon',
                'value' => 'https://placehold.co/32x32',
                'description' => 'URL favicon untuk situs web (32x32 px). Upload disimpan dalam folder /storage/upload/images',
            ],
            [
                'key' => 'site_description',
                'value' => 'Platform streaming musik seperti Spotify, YouTube Music, dan Joox.',
                'description' => 'Deskripsi singkat dari situs web.',
            ],
            [
                'key' => 'contact_email',
                'value' => 'support@musicx.com',
                'description' => 'Alamat email kontak dukungan.',
            ],
            [
                'key' => 'contact_phone',
                'value' => '621234567890',
                'description' => 'Nomor telepon kontak dukungan.',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Jl. Contoh No. 123, Jakarta, Indonesia',
                'description' => 'Alamat kantor atau lokasi kontak.',
            ],
            [
                'key' => 'bank_name',
                'value' => 'Bank Central Asia (BCA)',
                'description' => 'Nama bank untuk transaksi.',
            ],
            [
                'key' => 'bank_acc_name',
                'value' => 'Music Cool Poll Company',
                'description' => 'Nama pemilik rekening bank.',
            ],
            [
                'key' => 'bank_acc_number',
                'value' => '1234567890',
                'description' => 'Nomor rekening bank untuk pembayaran.',
            ],
            [
                'key' => 'maintenance_mode',
                'value' => 'off',
                'description' => 'Mengaktifkan atau menonaktifkan mode pemeliharaan (on/off).',
            ],
        ];

        foreach ($configurations as $config) {
            // Cek apakah data sudah ada
            $existingConfig = DB::table('site_configs')->where('key', $config['key'])->first();

            // Gunakan ID yang sudah ada atau buat UUID baru
            $id = $existingConfig ? $existingConfig->id : Str::uuid();

            // Gunakan created_at yang sudah ada atau sekarang
            $createdAt = $existingConfig ? $existingConfig->created_at : Carbon::now();

            // Lakukan update atau insert
            DB::table('site_configs')->updateOrInsert(
                ['key' => $config['key']],
                [
                    'id' => $id,
                    'value' => $config['value'],
                    'description' => $config['description'],
                    'updated_at' => Carbon::now(),
                    'created_at' => $createdAt
                ]
            );
        }


    }
}
