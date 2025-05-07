@extends('layouts.app')

@section('content')

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Overview</div>
                        <h2 class="page-title">Dashboard</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="d-flex align-items-center">
                            <div class="btn-list me-2">
                                <a href="{{ route('profile.my-assets') }}" class="btn btn-primary d-none d-sm-inline-block">
                                    <i class="ti ti-music me-2"></i> My Assets
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>

                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                                    <i class="ti ti-plus me-2"></i>Create Playlist
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <!-- User Info & Search -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 avatar-rounded"
                                    style="background-image: url(https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=e53935&color=fff&size=100)"></span>
                                <h3 class="m-0 mb-1">{{ auth()->user()->name }}</h3>
                                <div class="text-muted">{{ auth()->user()->email }}</div>
                                <div class="mt-3">
                                    <span class="badge bg-purple-lt">
                                        <i class="ti ti-phone me-1"></i> {{ auth()->user()->phone ?? 'Not set' }}
                                    </span>
                                    <span class="badge bg-blue-lt">
                                        <i class="ti ti-calendar me-1"></i> Joined
                                        {{ auth()->user()->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <!-- Tambahkan di bagian profil user -->
                                @php
                                    $verification = \App\Models\Verification::where('user_id', auth()->id())
                                        ->where('status', 'approved')
                                        ->latest()
                                        ->first();
                                @endphp

                                @if ($verification)
                                    <span class="badge bg-success">
                                        <i class="ti ti-check me-1"></i> {{ ucfirst($verification->type) }} Terverifikasi
                                    </span>
                                @endif

                                <div class="mt-3">
                                    <a href="{{ route('profile.my-assets') }}" class="btn btn-outline-primary w-100">
                                        <i class="ti ti-music me-2"></i> My Music Assets
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Music</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.dashboard') }}" method="GET">
                                    <div class="input-icon mb-3">
                                        <input type="text" name="q" value="{{ $query ?? '' }}"
                                            class="form-control" placeholder="Search for songs, artists, or albums...">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-search"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-search me-1"></i> Search
                                        </button>
                                    </div>
                                </form>

                                @if (isset($results) && count($results) > 0)
                                    <h4 class="mt-4 mb-3">Search Results for "{{ $query }}"</h4>
                                    <div class="list-group">
                                        @foreach ($results as $song)
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="avatar"
                                                            style="background-image: url(https://picsum.photos/40/40?random={{ $loop->iteration }})"></span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <div class="font-weight-medium">{{ $song->title }}
                                                                </div>
                                                                <div class="text-muted">
                                                                    {{ $song->artist ? $song->artist->name : 'Unknown Artist' }}
                                                                </div>
                                                            </div>
                                                            <div class="btn-list">
                                                                <button class="btn btn-icon btn-sm btn-primary play-song"
                                                                    data-song-id="{{ $song->id }}"
                                                                    data-bs-toggle="tooltip" title="Play">
                                                                    <i class="ti ti-player-play"></i>
                                                                </button>
                                                                <button class="btn btn-icon btn-sm btn-outline-secondary"
                                                                    data-bs-toggle="tooltip" title="Add to playlist">
                                                                    <i class="ti ti-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <audio id="audio-player" controls style="display: none;"></audio>

                                                    </body>

                                                    </html>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif (isset($query))
                                    <div class="empty mt-4">
                                        <div class="empty-icon">
                                            <i class="ti ti-mood-sad text-muted" style="font-size: 3rem"></i>
                                        </div>
                                        <p class="empty-title">No results found</p>
                                        <p class="empty-subtitle text-muted">
                                            No results found for "{{ $query }}". Try using different keywords.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Total Plays</div>
                                    <div class="ms-auto lh-1">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-muted" href="#"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Last 7 days</a>
                                                <a class="dropdown-item" href="#">Last 30 days</a>
                                                <a class="dropdown-item" href="#">Last 3 months</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="h1 mb-3">2,845</div>
                                <div class="d-flex mb-2">
                                    <div>Conversion rate</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            7% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 70%" role="progressbar"
                                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                        aria-label="70% Complete">
                                        <span class="visually-hidden">70% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Playlists</div>
                                </div>
                                <div class="h1 mb-3">8</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            9% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 75%" role="progressbar"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        aria-label="75% Complete">
                                        <span class="visually-hidden">75% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Followers</div>
                                </div>
                                <div class="h1 mb-3">1,253</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            12% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 60%" role="progressbar"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                        aria-label="60% Complete">
                                        <span class="visually-hidden">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Downloads</div>
                                </div>
                                <div class="h1 mb-3">452</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-red d-inline-flex align-items-center lh-1">
                                            -2% <i class="ti ti-trending-down ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 40%" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                        aria-label="40% Complete">
                                        <span class="visually-hidden">40% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Songs & Artists -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-music me-2 text-primary"></i>Popular Songs
                                </h3>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-link">View All</a>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach ($popularSongs ?? [] as $song)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar">{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $loop->iteration + 10 }})"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-reset d-block">{{ $song->title }}</a>
                                                <div class="text-muted text-truncate mt-n1">
                                                    {{ $song->artist ? $song->artist->name : 'Unknown Artist' }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="badge bg-primary-lt">
                                                    <i class="ti ti-headphones me-1"></i>
                                                    {{ $song->stream_count ?? rand(1000, 9999) }}
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <button
                                                    class="btn btn-icon btn-sm btn-primary popular-play-button-{{ $song->id }}"
                                                    data-bs-toggle="tooltip" title="Play">
                                                    <i class="ti ti-player-play "></i>

                                                    @php
                                                        $filename = $song->file_path
                                                            ? basename($song->file_path)
                                                            : null;
                                                        $audioUrl = $filename
                                                            ? route('songs.audio', ['filename' => $filename])
                                                            : null;
                                                    @endphp

                                                    @if ($audioUrl)
                                                        <audio controls
                                                            class="w-100 mb-3 d-none populaar-audio-{{ $song->id }}">
                                                            <source src="{{ $audioUrl }}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                    @endif

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-users me-2 text-primary"></i>Popular Artists
                                </h3>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-link">View All</a>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach ($popularArtists ?? [] as $artist)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar">{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://ui-avatars.com/api/?name={{ $artist->name }}&background=e53935&color=fff)"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-reset d-block">{{ $artist->name }}</a>
                                                <div class="text-muted text-truncate mt-n1">Artist</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="badge bg-primary-lt">
                                                    <i class="ti ti-headphones me-1"></i>
                                                    {{ $artist->stream_count ?? rand(10000, 99999) }}
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn btn-icon btn-sm btn-outline-primary"
                                                    data-bs-toggle="tooltip" title="Follow">
                                                    <i class="ti ti-user-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Composers & Cover Creators -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-pencil me-2 text-primary"></i>Popular Composers
                                </h3>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-link">View All</a>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach ($popularComposers ?? [] as $composer)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar">{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://ui-avatars.com/api/?name={{ $composer->name }}&background=e53935&color=fff)"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-reset d-block">{{ $composer->name }}</a>
                                                <div class="text-muted text-truncate mt-n1">Composer</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="badge bg-primary-lt">
                                                    <i class="ti ti-headphones me-1"></i>
                                                    {{ $composer->stream_count ?? rand(10000, 99999) }}
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn btn-icon btn-sm btn-outline-primary"
                                                    data-bs-toggle="tooltip" title="Follow">
                                                    <i class="ti ti-user-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-microphone-2 me-2 text-primary"></i>Popular Cover Creators
                                </h3>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-link">View All</a>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach ($popularCoverCreators ?? [] as $coverCreator)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar">{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://ui-avatars.com/api/?name={{ $coverCreator->name }}&background=e53935&color=fff)"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#"
                                                    class="text-reset d-block">{{ $coverCreator->name }}</a>
                                                <div class="text-muted text-truncate mt-n1">Cover Creator</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="badge bg-primary-lt">
                                                    <i class="ti ti-headphones me-1"></i>
                                                    {{ $coverCreator->stream_count ?? rand(10000, 99999) }}
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn btn-icon btn-sm btn-outline-primary"
                                                    data-bs-toggle="tooltip" title="Follow">
                                                    <i class="ti ti-user-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Your Playlists -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-playlist me-2 text-primary"></i>Your Playlists
                        </h3>
                        <div class="card-actions">
                            <button class="btn btn-primary">
                                <i class="ti ti-plus me-2"></i>New Playlist
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <a href="#" class="d-block">
                                        <img src="https://picsum.photos/300/150?random=20" class="card-img-top"
                                            alt="Playlist">
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="font-weight-medium">My Favorites</div>
                                                <div class="text-muted">15 songs</div>
                                            </div>
                                            <div class="ms-auto">
                                                <button class="btn btn-icon btn-primary" data-bs-toggle="tooltip"
                                                    title="Play">
                                                    <i class="ti ti-player-play"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <a href="#" class="d-block">
                                        <img src="https://picsum.photos/300/150?random=21" class="card-img-top"
                                            alt="Playlist">
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="font-weight-medium">Workout Mix</div>
                                                <div class="text-muted">12 songs</div>
                                            </div>
                                            <div class="ms-auto">
                                                <button class="btn btn-icon btn-primary" data-bs-toggle="tooltip"
                                                    title="Play">
                                                    <i class="ti ti-player-play"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <a href="#" class="d-block">
                                        <img src="https://picsum.photos/300/150?random=22" class="card-img-top"
                                            alt="Playlist">
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="font-weight-medium">Chill Vibes</div>
                                                <div class="text-muted">8 songs</div>
                                            </div>
                                            <div class="ms-auto">
                                                <button class="btn btn-icon btn-primary" data-bs-toggle="tooltip"
                                                    title="Play">
                                                    <i class="ti ti-player-play"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm card-link border-dashed d-flex flex-column justify-content-center align-items-center"
                                    style="min-height: 100%;">
                                    <div class="text-center p-4">
                                        <span class="avatar avatar-md bg-primary-lt mb-3">
                                            <i class="ti ti-plus text-primary"></i>
                                        </span>
                                        <div class="font-weight-medium">Create New Playlist</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recently Played -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-history me-2 text-primary"></i>Recently Played
                        </h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-link">View History</a>
                        </div>
                    </div>
                    <div class="card-body border-bottom-0 table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Artist</th>
                                    <th>Album</th>
                                    <th>Duration</th>
                                    <th>Played</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allSongs ?? [] as $index => $song)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $index + 30 }})"></span>
                                                <div>{{ $song->title }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $song->artist ? $song->artist->name : 'Unknown Artist' }}</td>
                                        <td>{{ $song->album->title ?? 'Single' }}</td>
                                        <td>3:45</td>
                                        <td>{{ now()->subHours(rand(1, 24))->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-list flex-nowrap">

                                                <button
                                                    class="btn btn-icon btn-sm btn-primary recently-play-btn-{{ $song->id }}"
                                                    data-bs-toggle="tooltip" title="Play">
                                                    <i class="ti ti-player-play"></i>

                                                    @php
                                                        $filename = $song->file_path
                                                            ? basename($song->file_path)
                                                            : null;
                                                        $audioUrl = $filename
                                                            ? route('songs.audio', ['filename' => $filename])
                                                            : null;
                                                    @endphp

                                                    @if ($audioUrl)
                                                        <audio controls
                                                            class="w-100 mb-3 d-none recently-play-audio-{{ $song->id }}">
                                                            <source src="{{ $audioUrl }}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                    @endif

                                                </button>

                                                <div class="dropdown">
                                                    <button class="btn btn-icon btn-sm btn-ghost-secondary"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-plus me-2"></i>Add to playlist
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-download me-2"></i>Download
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-share me-2"></i>Share
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Additional dashboard-specific scripts
        document.addEventListener('DOMContentLoaded', function() {
            // Example of using SweetAlert for a welcome message
            // Uncomment to enable
            /*
            Swal.fire({
                title: 'Welcome back!',
                text: 'Enjoy your music experience today',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            */

            //popular play button
            document.querySelectorAll('[class*="popular-play-button-"]').forEach(button => {
                button.addEventListener('click', function() {
                    const btnClass = Array.from(button.classList).find(c => c.startsWith(
                        'popular-play-button-'));
                    const songId = btnClass?.replace('popular-play-button-', '');
                    const audio = document.querySelector(`.populaar-audio-${songId}`);
                    const icon = button.querySelector('i');

                    if (audio) {
                        // Pause all other audio
                        document.querySelectorAll('audio').forEach(a => {
                            if (a !== audio) {
                                a.pause();
                                a.currentTime = 0;
                                const otherId = a.className.match(/populaar-audio-(.+)/)?.[
                                    1
                                ];
                                const otherBtn = document.querySelector(
                                    `.popular-play-button-${otherId}`);
                                if (otherBtn) {
                                    const otherIcon = otherBtn.querySelector('i');
                                    otherIcon?.classList.remove('ti-player-pause');
                                    otherIcon?.classList.add('ti-player-play');
                                }
                            }
                        });

                        // Toggle play/pause for this audio
                        if (audio.paused) {
                            audio.play();
                            icon.classList.remove('ti-player-play');
                            icon.classList.add('ti-player-pause');
                        } else {
                            audio.pause();
                            icon.classList.remove('ti-player-pause');
                            icon.classList.add('ti-player-play');
                        }

                        // When audio ends
                        audio.addEventListener('ended', () => {
                            icon.classList.remove('ti-player-pause');
                            icon.classList.add('ti-player-play');
                        });
                    }
                });
            });


            //recently play button
            document.querySelectorAll('[class*="recently-play-btn-"]').forEach(button => {
                button.addEventListener('click', function() {
                    const btnClass = Array.from(button.classList).find(c => c.startsWith(
                        'recently-play-btn-'));
                    const songId = btnClass?.replace('recently-play-btn-', '');
                    const audio = document.querySelector(`.recently-play-audio-${songId}`);
                    const icon = button.querySelector('i');

                    if (!audio) return;

                    // Pause other audios
                    document.querySelectorAll('audio').forEach(a => {
                        if (a !== audio) {
                            a.pause();
                            a.currentTime = 0;
                            const otherMatch = a.className.match(
                                /recently-play-audio-(\d+)/);
                            if (otherMatch) {
                                const otherId = otherMatch[1];
                                const otherBtn = document.querySelector(
                                    `.recently-play-btn-${otherId}`);
                                const otherIcon = otherBtn?.querySelector('i');
                                if (otherIcon) {
                                    otherIcon.classList.remove('ti-player-pause');
                                    otherIcon.classList.add('ti-player-play');
                                }
                            }
                        }
                    });

                    // Toggle play/pause
                    if (audio.paused) {
                        audio.play();
                        icon.classList.remove('ti-player-play');
                        icon.classList.add('ti-player-pause');
                    } else {
                        audio.pause();
                        icon.classList.remove('ti-player-pause');
                        icon.classList.add('ti-player-play');
                    }

                    // When audio ends, reset icon
                    audio.addEventListener('ended', () => {
                        icon.classList.remove('ti-player-pause');
                        icon.classList.add('ti-player-play');
                    });
                });
            });


        });

        document.addEventListener('DOMContentLoaded', function() {
            const audioPlayer = document.getElementById('audio-player');
            const playButtons = document.querySelectorAll('.play-song');

            playButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const songId = this.getAttribute('data-song-id');

                    fetch(`/user/dashboard/play/${songId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.url) {
                                audioPlayer.src = data.url;
                                audioPlayer.play();
                            } else {
                                console.error(data.error || 'Gagal memutar lagu.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection
