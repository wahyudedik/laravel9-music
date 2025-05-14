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

class UserCartController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        return view('cart', compact('data'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }




    public function edit(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {


    }


    public function show(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
