<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use App\Models\SongLink;
use App\Models\SongLicense;
use App\Models\SongContributor;
use App\Models\SocialMedia;
use App\Models\ComposerSong;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class UserPaymentController extends Controller
{
    public function index(Request $request, $method, $idUser)
    {
        $data = [];
        return view('payment', compact('data'));
    }

    public function done(Request $request)
    {
        $data = [];
        return view('payment-done', compact('data'));
    }
}
