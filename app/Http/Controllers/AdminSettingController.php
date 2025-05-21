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
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

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

        activity('settings')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' visited admin configuration');

        return view('admin.settings', compact('generalSettings','seoSettings','themeSettings'));

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

            $logoFilePaths = url('img/favicon.png');
            $siteConfig = SiteConfig::where('key','logo_url')->first();
            if($siteConfig){
                $logoFilePaths = $siteConfig->value;
            }

            $favIconPaths = url('img/favicon.png');
            $siteConfig = SiteConfig::where('key','favicon_url')->first();
            if($siteConfig){
                $favIconPaths = $siteConfig->value;
            }

            if($request->has('logo_file')){

                $siteConfig = SiteConfig::where('key','logo_file')->first();
                if($siteConfig){
                    $logo_file = $siteConfig->logo_file;
                    if(strpos($logo_file,',')!=false){
                        foreach (explode(',', $logo_file) as $oldPath) {
                            Storage::disk('public')->delete(str_replace('storage/', '', $oldPath));
                        }
                    }
                }

                $uuid = (string) Str::uuid();
                $imageFile = $request->file('logo_file');
                $filename = 'logo_' . $uuid . '.' . $imageFile->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());
                $image = $manager->read($imageFile->getRealPath());

                $lgPath = 'settings/' . $filename;
                $mdPath = 'settings/' . str_replace('.', '_md.', $filename);
                $smPath = 'settings/' . str_replace('.', '_sm.', $filename);

                Storage::disk('public')->put($lgPath, (string) $image->scale(800)->encode());
                Storage::disk('public')->put($mdPath, (string) $image->scale(500)->encode());
                Storage::disk('public')->put($smPath, (string) $image->scale(200)->encode());

                // Simpan path ke array
                $uploadedFiles[] = $lgPath;
                $uploadedFiles[] = $mdPath;
                $uploadedFiles[] = $smPath;

                $logoFilePaths = 'storage/' . $lgPath . ',' . 'storage/' . $mdPath . ',' . 'storage/' . $smPath;
            }

            if($request->has('favicon_file')){

                $siteConfig = SiteConfig::where('key','favicon_file')->first();
                if($siteConfig){
                    $favicon_file = $siteConfig->favicon_file;
                    if(strpos($favicon_file,',')!=false){
                        foreach (explode(',', $favicon_file) as $oldPath) {
                            Storage::disk('public')->delete(str_replace('storage/', '', $oldPath));
                        }
                    }
                }

                $uuid = (string) Str::uuid();
                $imageFile = $request->file('favicon_file');
                $filename = 'favicon_' . $uuid . '.' . $imageFile->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());
                $image = $manager->read($imageFile->getRealPath());
                $imgPath = 'settings/' . $filename;
                Storage::disk('public')->put($imgPath, (string) $image->scale(32)->encode());

                $uploadedFiles[] = $imgPath;

                $favIconPaths = 'storage/' . $imgPath ;
            }

            $showFooter = 'no';
            if($request->has('show_footer')){
                $showFooter = $request->show_footer;
            }



            $data = [
                'theme_mode'         => $request->theme_mode,
                'primary_color'  => $request->primary_color,
                'logo_url'       => $logoFilePaths,
                'favicon_url'     => $favIconPaths,
                'show_footer'  => $showFooter,
            ];

            foreach ($data as $key => $value) {
                SiteConfig::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            activity('settings')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' updated admin configuration');


            return redirect()->back()->with('success', 'Pengaturan Tema berhasil disimpan.');
        }



        return redirect()->back()->with('error', 'Aksi tidak dikenali.');

    }

}
