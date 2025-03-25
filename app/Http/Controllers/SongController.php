<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SongController extends Controller
{
    public function play($id)
    {
        $song = Song::find($id);

        if (!$song || !$song->file_path) {
            abort(404, 'Lagu tidak ditemukan atau file tidak tersedia.');
        }

        $filePath = public_path($song->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File lagu tidak ditemukan.');
        }

        return response()->file($filePath, ['Content-Type' => 'audio/mpeg']);
    }
}
