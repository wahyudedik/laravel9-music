<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\SiteConfig;

class AdminSettingController extends Controller
{
    public function index(Request $request)
    {

        $generalSettings = [
            'site_name' => optional(SiteConfig::where('key','site_name')->first())->value ?? 'Playlist Music',
            'site_description' => optional(SiteConfig::where('key','site_description')->first())->value ?? 'Sebuah platform bagi pecinta musik, artis, dan komposer untuk berbagi dan menemukan musik.',
            'admin_email' => optional(SiteConfig::where('key','admin_email')->first())->value ?? 'admin@playlistmusic.com',
            'support_email' => optional(SiteConfig::where('key','support_email')->first())->value ?? 'support@playlistmusic.com',
            'default_language' => optional(SiteConfig::where('key','default_language')->first())->value ?? 'id',
            'default_timezone' => optional(SiteConfig::where('key','default_timezone')->first())->value ?? 'Asia/Jakarta',
        ];

        $seoSettings = [
            'meta_title' => optional(SiteConfig::where('key','meta_title')->first())->value ?? 'Playlist Music - Platform Musik Kreatif',
            'meta_description' => optional(SiteConfig::where('key','meta_description')->first())->value ?? 'Playlist Music adalah platform bagi pecinta musik, artis, dan komposer untuk berbagi dan menemukan musik berkualitas. Temukan musik baru dan dukung karya musisi lokal di Playlist Music.',
            'meta_keywords' => optional(SiteConfig::where('key','meta_keywords')->first())->value ?? 'musik, platform musik, artis, lagu indie, komposer, streaming musik',
            'og_description' => optional(SiteConfig::where('key','meta_description')->first())->value ?? 'Playlist Music adalah platform bagi pecinta musik, artis, dan komposer untuk berbagi dan menemukan musik berkualitas. Temukan musik baru dan dukung karya musisi lokal di Playlist Music.',
            'og_image_url' => optional(SiteConfig::where('key','og_image_url')->first())->value ?? url('img/icon1.png'),
            'canonical_url' => optional(SiteConfig::where('key','og_image_url')->first())->value ?? url('/'),
        ];

        $themeSettings = [
            'theme_mode' => optional(SiteConfig::where('key','theme_mode')->first())->value ?? 'light',
            'primary_color' => optional(SiteConfig::where('key','primary_color')->first())->value ?? 'red',
            'logo_url' => optional(SiteConfig::where('key','logo_url')->first())->value ?? url('img/favicon.png'),
            'favicon_url' => optional(SiteConfig::where('key','favicon_url')->first())->value ?? url('img/favicon.png'),
            'show_footer' => optional(SiteConfig::where('key','show_footer')->first())->value ?? 'yes',
        ];




        return view('admin.settings', compact('generalSettings','seoSettings','themeSettings'));

        // $data = [
        //     'site_name' => SiteConfig::where('key','site_name')->first(),
        //     'site_description' => SiteConfig::where('key','site_description')->first(),
        //     'maintenance_mode' => SiteConfig::where('key','maintenance_mode')->first(),
        //     'contact_phone' => SiteConfig::where('key','contact_phone')->first(),
        //     'contact_email' => SiteConfig::where('key','contact_email')->first(),
        //     'admin_email' => SiteConfig::where('key','admin_email')->first(),
        //     'support_email' => SiteConfig::where('key','support_email')->first(),
        //     'contact_address' => SiteConfig::where('key','contact_address')->first(),
        //     'default_language' => SiteConfig::where('key','default_language')->first(),
        //     'default_timezone' => SiteConfig::where('key','default_timezone')->first(),

        //     'theme_mode' => SiteConfig::where('key','theme_mode')->first(),
        //     'primary_color' => SiteConfig::where('key','primary_color')->first(),
        //     'site_logo' => SiteConfig::where('key','site_logo')->first(),
        //     'favicon' => SiteConfig::where('key','favicon')->first(),
        //     'show_footer' => SiteConfig::where('key','show_footer')->first(),

        //     'notify_user_register' => SiteConfig::where('key','notify_user_register')->first(),
        //     'notify_user_verification' => SiteConfig::where('key','notify_user_verification')->first(),
        //     'notify_new_song' => SiteConfig::where('key','notify_new_song')->first(),
        //     'notify_system' => SiteConfig::where('key','notify_system')->first(),
        //     'email_sender_name' => SiteConfig::where('key','email_sender_name')->first(),
        //     'email_template' => SiteConfig::where('key','email_template')->first(),

        //     'sec_min_password' => SiteConfig::where('key','sec_min_password')->first(),
        //     'sec_upper_password' => SiteConfig::where('key','sec_upper_password')->first(),
        //     'sec_number_password' => SiteConfig::where('key','sec_number_password')->first(),
        //     'sec_special_password' => SiteConfig::where('key','sec_special_password')->first(),
        //     'sec_session_timeout' => SiteConfig::where('key','sec_session_timeout')->first(),
        //     'sec_remember_duration' => SiteConfig::where('key','sec_remember_duration')->first(),
        //     'sec_enable_two_factor' => SiteConfig::where('key','sec_enable_two_factor')->first(),
        //     'sec_log_failed' => SiteConfig::where('key','sec_log_failed')->first(),
        //     'sec_block_ip_failed' => SiteConfig::where('key','sec_block_ip_failed')->first(),

        //     'int_google_analytic' => SiteConfig::where('key','int_google_analytic')->first(),
        //     'int_goole_analytic_trackid' => SiteConfig::where('key','int_goole_analytic_trackid')->first(),
        //     'int_facebook_pixel' => SiteConfig::where('key','int_facebook_pixel')->first(),
        //     'int_facebook_pixel_id' => SiteConfig::where('key','int_facebook_pixel_id')->first(),
        //     'int_youtube_api' => SiteConfig::where('key','int_youtube_api')->first(),
        //     'int_youtube_api_client_id' => SiteConfig::where('key','int_youtube_api_client_id')->first(),
        //     'int_youtube_api_client_secret' => SiteConfig::where('key','int_youtube_api_client_secret')->first(),
        //     'int_spotify_api' => SiteConfig::where('key','int_spotify_api')->first(),
        //     'int_spotify_api_client_id' => SiteConfig::where('key','int_spotify_api_client_id')->first(),
        //     'int_spotify_api_client_secret' => SiteConfig::where('key','int_spotify_api_client_secret')->first(),
        //     'theme_mode' => SiteConfig::where('key','theme_mode')->first(),

        //     'bank_name' => SiteConfig::where('key','bank_name')->first(),
        //     'bank_acc_number' => SiteConfig::where('key','bank_acc_number')->first(),
        //     'bank_acc_name' => SiteConfig::where('key','bank_acc_name')->first(),
        // ];
    }


    public function store(Request $request)
    {
        if ($request->has('btnSaveGeneralSetting')) {

            $data = [
                'site_name'         => $request->site_name,
                'site_description'  => $request->site_description,
                'admin_email'       => $request->admin_email,
                'support_email'     => $request->support_email,
                'default_language'  => $request->default_language,
                'default_timezone'  => $request->default_timezone,
            ];

            foreach ($data as $key => $value) {
                SiteConfig::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            return redirect()->back()->with('success', 'Pengaturan Umum berhasil disimpan.');
        }

        if ($request->has('btnSaveSeoSetting')) {

            $data = [
                'meta_title'         => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'meta_keywords'       => $request->meta_keywords,
                'canonical_url'     => $request->canonical_url,
                'og_image_url'  => $request->og_image_url,
            ];

            foreach ($data as $key => $value) {
                SiteConfig::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            return redirect()->back()->with('success', 'Pengaturan SEO berhasil disimpan.');
        }

        if ($request->has('btnSaveThemeSetting')) {

            $data = [
                'meta_title'         => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'meta_keywords'       => $request->meta_keywords,
                'canonical_url'     => $request->canonical_url,
                'og_image_url'  => $request->og_image_url,
            ];

            foreach ($data as $key => $value) {
                SiteConfig::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            return redirect()->back()->with('success', 'Pengaturan Tema berhasil disimpan.');
        }

        return redirect()->back()->with('error', 'Aksi tidak dikenali.');


        $site_logo = '';
        $favicon='https://placehold.co/32x32';

        $configurations = [
            [
                'key' => 'site_name',
                'value' => $request->site_name,
                'description' => 'Nama dari situs web.',
            ],
            [
                'key' => 'site_logo',
                'value' => $site_logo,
                'description' => 'Logo dari situs web dalam tiga ukuran: Large (600x400), Medium (300x200), Small (150x100). Upload disimpan dalam folder /storage/upload/images ',
            ],
            [
                'key' => 'favicon',
                'value' => $favicon,
                'description' => 'URL favicon untuk situs web (32x32 px). Upload disimpan dalam folder /storage/upload/images',
            ],
            [
                'key' => 'site_description',
                'value' => $request->site_description,
                'description' => 'Deskripsi singkat dari situs web.',
            ],
            [
                'key' => 'admin_email',
                'value' => $request->admin_email,
                'description' => 'Alamat email kontak dukungan.',
            ],
            [
                'key' => 'support_email',
                'value' => $request->support_email,
                'description' => 'Alamat email kontak dukungan.',
            ],
            [
                'key' => 'default_language',
                'value' => $request->default_language,
                'description' => 'Alamat email kontak dukungan.',
            ],
            [
                'key' => 'default_timezone',
                'value' => $request->default_timezone,
                'description' => 'Alamat email kontak dukungan.',
            ],
            [
                'key' => 'contact_phone',
                'value' => $request->contact_phone,
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

        try {
            DB::beginTransaction(); // Start transaction

            // Validate input
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $id, // Ignore current role's name
                'guard_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'permissions' => 'nullable|array', // Allow null (no permissions selected)
                'permissions.*' => 'exists:permissions,id', // Ensure each permission exists
            ]);

            // Find the role by ID
            $role = Role::findOrFail($id);

            // Update role details
            $role->update([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
                'description' => $request->description ?? null,
            ]);

            // Sync permissions only if permissions are provided
            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]); // Remove all permissions if none selected
            }

            // Log activity
            $authUser = Auth::user();
            activity()->withProperties(['ip' => request()->ip()])
                ->log($authUser->name . ' updated role: ' . $role->name);

            DB::commit(); // Commit transaction

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role successfully updated.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error

            return redirect()->route('admin.roles.index')
                ->with('error', 'An error occurred while updating the role: ' . $e->getMessage());
        }
    }

}
