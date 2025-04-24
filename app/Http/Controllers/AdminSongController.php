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

class AdminSongController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 15);

        $query = Song::with(['artist', 'album', 'genre', 'composers', 'songContributors']);

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        if ($request->has('fstatus') && $request->fstatus) {
            $query->where('status', $request->fstatus);
        }

        // Filter by search keyword
        if ($request->has('search') && $request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhereHas('artist', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('album', function ($q3) use ($search) {
                        $q3->where('title', 'like', "%$search%");
                    })
                    ->orWhereHas('genre', function ($q4) use ($search) {
                        $q4->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('composers', function ($q5) use ($search) {
                        $q5->where('name', 'like', "%$search%");
                    });
            });
        }

        $album = null;
        if ($request->has('falbum_id') && $request->falbum_id) {
            $query->where('album_id', $request->falbum_id);
            $album = Album::where('id', $request->falbum_id)->first();
        }

        $genre = null;
        if ($request->has('fgenre_id') && $request->fgenre_id) {
            $query->where('genre_id', $request->fgenre_id);
            $genre = Genre::where('id', $request->fgenre_id)->first();
        }

        $songs = $query->latest()->paginate($perPage)->appends($request->only('search', 'status', 'perPage'));

        return view('admin.songs.index', compact('songs', 'genre', 'album'));
    }


    public function create()
    {
        $authUser = Auth::user();
        activity('song')->withProperties(['ip' => request()->ip()])->log($authUser->name . ' visited create songs form');
        $genres = Genre::orderBy('name', 'asc')->get();
        $socialMedias = SocialMedia::get();

        //ambil data local_zones jika pada data terakhir jika sudah pernah entri
        //jika masih kosong cek apakah user auth -> city tersedia pake ini datanya untuk isi default local_zones selectpicker
        $songZone = Song::select('local_zones')->where('created_by', Auth::id())->latest()->first();
        $local_zones = explode(',', $songZone->local_zones);
        $lastZones = [];
        foreach ($local_zones as $zone) {
            $lastZones[] = [
                'name' => trim($zone) // use trim to remove extra spaces
            ];
        }

        return view('admin.songs.create', compact('genres', 'socialMedias', 'lastZones'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'lyrics' => 'nullable|string',
                'genre_id' => 'required|exists:genres,id',
                'album_id' => 'nullable|exists:albums,id',
                'allow_cover_version' => 'required|boolean',
                'allow_commercial_use' => 'required|boolean',
                'release_date' => 'required|date',
                'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'file_path' => 'nullable|file|mimes:mp3,wav,flac|max:10240',
                'duration' => 'nullable|integer',
                'local_zones' => 'required|array|min:1',
                'local_zones.*' => 'required|string',
                'platforms' => 'required|array',
                'platforms.*' => 'required|string',
                'links' => 'required|array',
                'links.*' => 'required|url',
                'license_type' => 'required|array',
                'license_type.*' => 'required|string',
                'licence_file.*' => 'nullable|file|max:2048',
                'status' => 'required|in:Draft,Published,Inactive',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            $composerNames = [];
            if ($request->has('composer_ids')) {
                $composerNames = User::whereIn('id', $request->composer_ids)
                    ->pluck('name', 'id')
                    ->toArray();
            }

            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('composer_names', $composerNames);
        }



        // List path file yang di-upload, untuk nanti dihapus kalau error
        $uploadedFiles = [];

        DB::beginTransaction();

        try {
            $uuid = (string) Str::uuid();
            $coverImagePaths = null;
            $audioFilePath = null;
            $localZones = implode(', ', $request->local_zones);

            // Upload cover image
            if ($request->hasFile('cover_image')) {
                $imageFile = $request->file('cover_image');
                $filename = 'cover_' . $uuid . '.' . $imageFile->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());
                $image = $manager->read($imageFile->getRealPath());

                $lgPath = 'songs/' . $filename;
                $mdPath = 'songs/' . str_replace('.', '_md.', $filename);
                $smPath = 'songs/' . str_replace('.', '_sm.', $filename);

                Storage::disk('public')->put($lgPath, (string) $image->scale(1024)->encode());
                Storage::disk('public')->put($mdPath, (string) $image->scale(600)->encode());
                Storage::disk('public')->put($smPath, (string) $image->scale(300)->encode());

                // Simpan path ke array
                $uploadedFiles[] = $lgPath;
                $uploadedFiles[] = $mdPath;
                $uploadedFiles[] = $smPath;

                $coverImagePaths = 'storage/' . $lgPath . ',' . 'storage/' . $mdPath . ',' . 'storage/' . $smPath;
            }

            // Upload audio file
            if ($request->hasFile('file_path')) {
                $audioFile = $request->file('file_path');
                $audioFilename = 'audio_' . $uuid . '.' . $audioFile->getClientOriginalExtension();
                $audioFilePath = $audioFile->storeAs('songs/audio', $audioFilename, 'public');

                $uploadedFiles[] = $audioFilePath;
            }

            // Create Song
            $song = Song::create([
                'id' => $uuid,
                'title' => $request->title,
                'description' => $request->description,
                'lyrics' => $request->lyrics ?? null,
                'genre_id' => $request->genre_id,
                'album_id' => $request->album_id,
                'allow_cover_version' => $request->allow_cover_version,
                'allow_commercial_use' => $request->allow_commercial_use,
                'release_date' => $request->release_date,
                'cover_image' => $coverImagePaths,
                'file_path' => $audioFilePath ? 'storage/' . $audioFilePath : null,
                'duration' => $request->duration,
                'local_zones' => $localZones,
                'status' => $request->status,
                'created_by' => Auth::id(),
            ]);

            // Song Links
            foreach ($request->platforms as $index => $platform) {
                SongLink::create([
                    'song_id' => $song->id,
                    'platform' => $platform,
                    'link' => $request->links[$index]
                ]);
            }

            // Song Licenses
            foreach ($request->license_type as $index => $license_type) {

                $licenceFilePath = null;

                if ($request->hasFile("licence_file.$index")) {
                    $licenceFile = $request->file('licence_file')[$index];
                    $licenceFilename = 'licence_' . $uuid . '_' . $index . '.' . $licenceFile->getClientOriginalExtension();
                    $licenceFilePath = $licenceFile->storeAs('songs/licence', $licenceFilename, 'public');

                    $uploadedFiles[] = $licenceFilePath;
                }

                SongLicense::create([
                    'song_id' => $song->id,
                    'license_type' => $license_type,
                    'amount_type' => $request->amount_type[$index],
                    'local_amount' => $request->local_amount[$index],
                    'global_amount' => $request->global_amount[$index],
                    'licence_file' => $licenceFilePath,
                ]);
            }

            // Song Contributor (Composer)
            foreach ($request->composer_ids as $index => $composer_id) {
                SongContributor::create([
                    'song_id' => $song->id,
                    'user_id' => $composer_id,
                    'role' => 'Composer',
                    'description' => 'Song Creator',
                ]);
            }

            activity('song')
                ->withProperties(['ip' => request()->ip()])
                ->log(Auth::user()->name . ' created a song');

            DB::commit();

            return redirect()->route('admin.songs.index')->with('success', 'Song successfully added.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Hapus semua file yang sempat di-upload
            foreach ($uploadedFiles as $filePath) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->back()
                ->withErrors(['error' => 'Failed to save data: ' . $e->getMessage()])
                ->withInput();
        }
    }




    public function edit(Request $request, $id)
    {
        $authUser = Auth::user();
        $song = Song::with(['album', 'genre'])->findOrFail($id);

        $genres = Genre::orderBy('name', 'asc')->get();
        $album = null;
        if (isset($song->album->id)) {
            $album = [
                'id' => $song->album->id,
                'title' => $song->album->title,
                'artist' => $song->album->artist->name,
            ];
        }

        $socialMedias = SocialMedia::get();
        $composer_ids = SongContributor::with('user:id,name')->where('song_id', $song->id)->where('role', 'Composer')->get();
        $composers = [];
        foreach ($composer_ids as $composer_id) {
            $composers[] = [
                'id' => $composer_id->user->id,
                'name' => $composer_id->user->name,
            ];
        }

        $songLinks = SongLink::where('song_id', $song->id)->get();
        $songLicences = SongLicense::where('song_id', $song->id)->orderBy('amount_type')->get();

        $localZones = explode(',', $song->local_zones);
        $localZonesJson = [];
        foreach ($localZones as $zone) {
            $localZonesJson[] = ['name' => trim($zone)];
        }


        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log($authUser->name . ' visited edit song form for song: ' . $song->title);

        return view('admin.songs.edit', compact('song', 'socialMedias', 'songLinks', 'songLicences', 'composers', 'composer_ids', 'genres', 'album', 'localZonesJson'));
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'lyrics' => 'nullable|string',
                'genre_id' => 'required|exists:genres,id',
                'album_id' => 'nullable|exists:albums,id',
                'allow_cover_version' => 'required|boolean',
                'allow_commercial_use' => 'required|boolean',
                'release_date' => 'required|date',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'file_path' => 'nullable|file|mimes:mp3,wav,flac|max:10240',
                'duration' => 'nullable|integer',
                'local_zones' => 'required|array|min:1',
                'local_zones.*' => 'required|string',
                'platforms'   => 'required|array',
                'platforms.*' => 'required|string',
                'links'       => 'required|array',
                'links.*'     => 'required|url',
                'license_type' => 'required|array',
                'license_type.*' => 'required|string',
                'licence_file.*' => 'nullable|file|max:2048',
                'status' => 'required|in:Draft,Published,Inactive',
            ]);

            $song = Song::findOrFail($id);

            $coverImagePaths = $song->cover_image;
            $audioFilePath = $song->file_path;

            $localZones = implode(', ', $request->local_zones);
            $uuid = $song->id;

            // Handle new cover image
            if ($request->hasFile('cover_image')) {
                // Hapus file lama
                foreach (explode(',', $song->cover_image) as $oldPath) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $oldPath));
                }

                $imageFile = $request->file('cover_image');
                $filename = 'cover_' . $uuid . '.' . $imageFile->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());
                $image = $manager->read($imageFile->getRealPath());

                $lgPath = 'songs/' . $filename;
                $mdPath = 'songs/' . str_replace('.', '_md.', $filename);
                $smPath = 'songs/' . str_replace('.', '_sm.', $filename);

                Storage::disk('public')->put($lgPath, (string) $image->scale(1024)->encode());
                Storage::disk('public')->put($mdPath, (string) $image->scale(600)->encode());
                Storage::disk('public')->put($smPath, (string) $image->scale(300)->encode());

                $coverImagePaths = 'storage/' . $lgPath . ',' . 'storage/' . $mdPath . ',' . 'storage/' . $smPath;
            }

            // Handle new audio file
            if ($request->hasFile('file_path')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $song->file_path));

                $audioFile = $request->file('file_path');
                $audioFilename = 'audio_' . $uuid . '.' . $audioFile->getClientOriginalExtension();
                $audioFilePath = $audioFile->storeAs('songs/audio', $audioFilename, 'public');
            }

            // Update song data
            $song->update([
                'title' => $request->title,
                'description' => $request->description,
                'lyrics' => $request->lyrics ?? null,
                'genre_id' => $request->genre_id,
                'album_id' => $request->album_id,
                'allow_cover_version' => $request->allow_cover_version,
                'allow_commercial_use' => $request->allow_commercial_use,
                'release_date' => $request->release_date,
                'cover_image' => $coverImagePaths,
                'file_path' => $audioFilePath ? 'storage/' . $audioFilePath : null,
                'duration' => $request->duration,
                'local_zones' => $localZones,
                'status' => $request->status,
                'updated_by' => Auth::id(),
            ]);

            // Update SongLink (hapus & insert ulang)
            SongLink::where('song_id', $song->id)->delete();
            foreach ($request->platforms as $index => $platform) {
                SongLink::create([
                    'song_id' => $song->id,
                    'platform' => $platform,
                    'link' => $request->links[$index]
                ]);
            }

            // Update SongLicense (hapus & insert ulang)
            SongLicense::where('song_id', $song->id)->delete();
            foreach ($request->license_type as $index => $license_type) {
                $licenceFilePath = null;

                if ($request->hasFile("licence_file.$index")) {
                    $licenceFile = $request->file('licence_file')[$index];
                    $licenceFilename = 'licence_' . $uuid . '_' . $index . '.' . $licenceFile->getClientOriginalExtension();
                    $licenceFilePath = $licenceFile->storeAs('songs/licence', $licenceFilename, 'public');
                }

                SongLicense::create([
                    'song_id' => $song->id,
                    'license_type' => $license_type,
                    'amount_type' => $request->amount_type[$index],
                    'local_amount' => $request->local_amount[$index],
                    'global_amount' => $request->global_amount[$index],
                    'licence_file' => $licenceFilePath,
                ]);
            }


            // Ambil contributor lain selain Composer
            $otherContributors = SongContributor::where('song_id', $song->id)
                ->where('role', '!=', 'Composer')
                ->get();

            // Hapus Composer yang lama
            SongContributor::where('song_id', $song->id)
                ->where('role', 'Composer')
                ->delete();

            // Masukkan Composer baru dari request
            foreach ($request->composer_ids as $composer_id) {
                SongContributor::create([
                    'song_id' => $song->id,
                    'user_id' => $composer_id,
                    'role' => 'Composer',
                    'description' => 'Song Creator',
                ]);
            }

            // Masukkan kembali contributor lainnya
            foreach ($otherContributors as $contributor) {
                SongContributor::create([
                    'song_id' => $contributor->song_id,
                    'user_id' => $contributor->user_id,
                    'role' => $contributor->role,
                    'description' => $contributor->description,
                ]);
            }

            activity('song')
                ->withProperties(['ip' => request()->ip()])
                ->log(Auth::user()->name . ' updated a song');

            DB::commit();

            return redirect()->route('admin.songs.index')->with('success', 'Song successfully updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Opsional: hapus file yang sempat diupload di try block
            if (isset($lgPath)) Storage::disk('public')->delete($lgPath);
            if (isset($mdPath)) Storage::disk('public')->delete($mdPath);
            if (isset($smPath)) Storage::disk('public')->delete($smPath);
            if (isset($audioFilePath)) Storage::disk('public')->delete($audioFilePath);
            if (!empty($licenceFilePath)) Storage::disk('public')->delete($licenceFilePath);

            return redirect()->back()->with('error', 'Failed to update song: ' . $e->getMessage());
        }
    }


    public function show(Request $request, $id)
    {
        $authUser = Auth::user();

        // Ambil data lagu lengkap dengan relasinya
        $song = Song::with(['album', 'artist', 'genre', 'coverCreator', 'composers', 'coverVersions..artist'])->findOrFail($id);
        $coverVersions = $song->coverVersions;

        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log($authUser->name . ' visited show song form for song: ' . $song->title);

        return view('admin.songs.show', compact('song', 'coverVersions'));
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'song_ids' => 'required|array',
            'song_ids.*' => 'exists:songs,id',
        ]);

        if ($request->action === 'delete') {
            $songs = Song::whereIn('id', $request->song_ids)->get();

            foreach ($songs as $song) {
                // Delete cover images (lg, md, sm)
                if ($song->cover_image) {
                    $paths = explode(',', $song->cover_image);
                    foreach ($paths as $path) {
                        $relativePath = str_replace('storage/', '', $path);
                        if (Storage::disk('public')->exists($relativePath)) {
                            Storage::disk('public')->delete($relativePath);
                        }
                    }
                }

                // Delete license file
                if ($song->license_file) {
                    $relativePath = str_replace('storage/', '', $song->license_file);
                    if (Storage::disk('public')->exists($relativePath)) {
                        Storage::disk('public')->delete($relativePath);
                    }
                }

                // Delete audio file
                if ($song->file_path) {
                    $relativePath = str_replace('storage/', '', $song->file_path);
                    if (Storage::disk('public')->exists($relativePath)) {
                        Storage::disk('public')->delete($relativePath);
                    }
                }

                // Detach composer relationships
                $song->composers()->detach();

                // Delete song record
                $song->delete();

                // Log activity for each song
                activity('song')
                    ->withProperties(['ip' => request()->ip()])
                    ->log(Auth::user()->name . ' deleted song: ' . $song->title);
            }

            return response()->json([
                'success' => true,
                'message' => 'Selected songs have been deleted.'
            ]);
        }

        // Activate or Deactivate
        $status = $request->action === 'activate' ? 'Active' : 'Inactive';

        Song::whereIn('id', $request->song_ids)->update(['status' => $status]);

        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' performed bulk ' . $request->action . ' on songs: ' . implode(', ', $request->song_ids));

        return response()->json([
            'success' => true,
            'message' => 'Selected songs have been ' . $request->action . 'd.'
        ]);
    }



    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $song = Song::findOrFail($id);

            // Hapus file cover image (kalau ada)
            if ($song->cover_image) {
                $coverPaths = explode(',', $song->cover_image);
                foreach ($coverPaths as $path) {
                    $storagePath = str_replace('storage/', '', $path);
                    if (Storage::disk('public')->exists($storagePath)) {
                        Storage::disk('public')->delete($storagePath);
                    }
                }
            }

            // Hapus file audio (kalau ada)
            if ($song->file_path) {
                $audioPath = str_replace('storage/', '', $song->file_path);
                if (Storage::disk('public')->exists($audioPath)) {
                    Storage::disk('public')->delete($audioPath);
                }
            }

            // Hapus file license (jika ada di SongLicense)
            $licenses = SongLicense::where('song_id', $song->id)->get();
            foreach ($licenses as $license) {
                if ($license->licence_file) {
                    $licensePath = str_replace('storage/', '', $license->licence_file);
                    if (Storage::disk('public')->exists($licensePath)) {
                        Storage::disk('public')->delete($licensePath);
                    }
                }
            }

            // Hapus relasi-relasi terkait
            SongLink::where('song_id', $song->id)->delete();
            SongLicense::where('song_id', $song->id)->delete();
            SongContributor::where('song_id', $song->id)->delete();

            // Hapus datanya
            $song->delete();

            DB::commit();

            activity('song')
                ->withProperties(['ip' => request()->ip()])
                ->log(Auth::user()->name . ' deleted a song');

            return redirect()->route('admin.songs.index')->with('success', 'Song successfully deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while deleting data: ' . $e->getMessage());
        }
    }
}
