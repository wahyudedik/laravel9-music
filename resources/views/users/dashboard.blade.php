@extends('layouts.app')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">MusicApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-music me-1"></i> Playlist
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user me-1"></i> Profile
                        </a>
                    </li><li class="nav-item">
                 <a class="nav-link" href="{{ route('verification.form') }}">
                     <i class="fas fa-music me-1"></i> Pengajuan Verifikasi
                   </a>
                 </li>
                    

                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=4361ee&color=fff"
                                class="rounded-circle me-2" width="32" height="32" alt="Profile">
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                @php
                                    $user = Auth::user();
                                    $userRole = $user->getRoleNames()->first();
                                @endphp
                                <form action="{{ route('logout', ['role' => $userRole]) }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Your Dashboard</h2>
                <p class="text-muted mb-0">Welcome back, {{ auth()->user()->name }}</p>
            </div>
            <div>
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Create Playlist
                </button>
            </div>
        </div>

        <!-- User Info Card -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=4361ee&color=fff&size=100"
                                class="rounded-circle mb-3" alt="Profile">
                            <h5 class="card-title">{{ auth()->user()->name }}</h5>
                            <p class="card-text text-muted">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Phone:</span>
                            <span>{{ auth()->user()->phone }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Member since:</span>
                            <span>{{ auth()->user()->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-user-edit me-2"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Search Music</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.dashboard') }}" method="GET">
                            <div class="input-group mb-4">
                                <input type="text" name="q" value="{{ $query }}" class="form-control"
                                    placeholder="Search for songs, artists, or albums...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-1"></i> Search
                                </button>
                            </div>
                        </form>

                        @if (count($results) > 0)
                            <h6 class="mb-3">Search Results for "{{ $query }}"</h6>
                            <div class="list-group mb-4">
                                @foreach ($results as $song)
                                    <div class="list-group-item list-group-item-action d-flex align-items-center">
                                        <img src="https://picsum.photos/40/40?random={{ $loop->iteration }}"
                                            class="rounded me-3" alt="Song">
                                        <div>
                                            <h6 class="mb-0">{{ $song->title }}</h6>
                                            <small
                                                class="text-muted">{{ $song->artist ? $song->artist->name : 'Unknown Artist' }}</small>
                                        </div>
                                        <div class="ms-auto">
                                            <button class="btn btn-sm btn-outline-primary rounded-circle"
                                                data-bs-toggle="tooltip" title="Play">
                                                <i class="fas fa-play"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary rounded-circle"
                                                data-bs-toggle="tooltip" title="Add to playlist">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif ($query)
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> No results found for "{{ $query }}".
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Music Categories -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Popular Songs</h5>
                        <a href="#" class="text-decoration-none">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($popularSongs as $song)
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="me-3">{{ $loop->iteration }}</div>
                                    <img src="https://picsum.photos/40/40?random={{ $loop->iteration + 10 }}"
                                        class="rounded me-3" alt="Song">
                                    <div>
                                        <h6 class="mb-0">{{ $song->title }}</h6>
                                        <small
                                            class="text-muted">{{ $song->artist ? $song->artist->name : 'Unknown Artist' }}</small>
                                    </div>
                                    <div class="ms-auto d-flex align-items-center">
                                        <span class="badge bg-light text-dark me-3">
                                            <i class="fas fa-headphones me-1"></i> {{ $song->stream_count }}
                                        </span>
                                        <button class="btn btn-sm btn-outline-primary rounded-circle"
                                            data-bs-toggle="tooltip" title="Play">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Popular Artists</h5>
                        <a href="#" class="text-decoration-none">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($popularArtists as $artist)
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="me-3">{{ $loop->iteration }}</div>
                                    <img src="https://ui-avatars.com/api/?name={{ $artist->name }}&background=4361ee&color=fff"
                                        class="rounded-circle me-3" width="40" height="40" alt="Artist">
                                    <div>
                                        <h6 class="mb-0">{{ $artist->name }}</h6>
                                        <small class="text-muted">Artist</small>
                                    </div>
                                    <div class="ms-auto">
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-headphones me-1"></i> {{ $artist->stream_count }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Popular Composers</h5>
                        <a href="#" class="text-decoration-none">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($popularComposers as $composer)
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="me-3">{{ $loop->iteration }}</div>
                                    <img src="https://ui-avatars.com/api/?name={{ $composer->name }}&background=4361ee&color=fff"
                                        class="rounded-circle me-3" width="40" height="40" alt="Composer">
                                    <div>
                                        <h6 class="mb-0">{{ $composer->name }}</h6>
                                        <small class="text-muted">Composer</small>
                                    </div>
                                    <div class="ms-auto">
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-headphones me-1"></i> {{ $composer->stream_count }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Popular Cover Creators</h5>
                        <a href="#" class="text-decoration-none">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($popularCoverCreators as $coverCreator)
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="me-3">{{ $loop->iteration }}</div>
                                    <img src="https://ui-avatars.com/api/?name={{ $coverCreator->name }}&background=4361ee&color=fff"
                                        class="rounded-circle me-3" width="40" height="40" alt="Cover Creator">
                                    <div>
                                        <h6 class="mb-0">{{ $coverCreator->name }}</h6>
                                        <small class="text-muted">Cover Creator</small>
                                    </div>
                                    <div class="ms-auto">
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-headphones me-1"></i> {{ $coverCreator->stream_count }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Your Playlists</h5>
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-plus me-1"></i> New Playlist
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="card h-100">
                                    <img src="https://picsum.photos/300/150?random=20" class="card-img-top"
                                        alt="Playlist">
                                    <div class="card-body">
                                        <h6 class="card-title">My Favorites</h6>
                                        <p class="card-text text-muted small">15 songs</p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <button class="btn btn-sm btn-primary w-100">
                                            <i class="fas fa-play me-1"></i> Play
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card h-100">
                                    <img src="https://picsum.photos/300/150?random=21" class="card-img-top"
                                        alt="Playlist">
                                    <div class="card-body">
                                        <h6 class="card-title">Workout Mix</h6>
                                        <p class="card-text text-muted small">12 songs</p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <button class="btn btn-sm btn-primary w-100">
                                            <i class="fas fa-play me-1"></i> Play
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card h-100">
                                    <img src="https://picsum.photos/300/150?random=22" class="card-img-top"
                                        alt="Playlist">
                                    <div class="card-body">
                                        <h6 class="card-title">Chill Vibes</h6>
                                        <p class="card-text text-muted small">8 songs</p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <button class="btn btn-sm btn-primary w-100">
                                            <i class="fas fa-play me-1"></i> Play
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card h-100 border-dashed d-flex justify-content-center align-items-center"
                                    style="border-style: dashed; background-color: #f8f9fa;">
                                    <div class="text-center p-4">
                                        <div class="rounded-circle bg-white p-3 d-inline-block mb-3">
                                            <i class="fas fa-plus text-primary fa-lg"></i>
                                        </div>
                                        <h6>Create New Playlist</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recently Played -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Recently Played</h5>
                        <a href="#" class="text-decoration-none">View History</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Artist</th>
                                        <th scope="col">Album</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Played</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allSongs->take(5) as $index => $song)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://picsum.photos/40/40?random={{ $index + 30 }}"
                                                        class="rounded me-3" alt="Song">
                                                    <div>{{ $song->title }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $song->artist ? $song->artist->name : 'Unknown Artist' }}</td>
                                            <td>{{ $song->album ?? 'Single' }}</td>
                                            <td>3:45</td>
                                            <td>{{ now()->subHours(rand(1, 24))->diffForHumans() }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="tooltip" title="Play">
                                                        <i class="fas fa-play"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                                        data-bs-toggle="tooltip" title="Add to playlist">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-info"
                                                        data-bs-toggle="tooltip" title="Download">
                                                        <i class="fas fa-download"></i>
                                                    </button>
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
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-4">
                <div class="mb-3 mb-md-0">
                    <p class="mb-0">&copy; 2023 Music Cool Poll. All rights reserved.</p>
                    <p class="text-muted mb-0 small">The ultimate music streaming platform</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="#" class="text-decoration-none text-muted">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-muted">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-muted">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-muted">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-center gap-4 py-3 border-top">
                <a href="#" class="text-decoration-none text-muted small">Privacy Policy</a>
                <a href="#" class="text-decoration-none text-muted small">Terms of Service</a>
                <a href="#" class="text-decoration-none text-muted small">Contact Us</a>
                <a href="#" class="text-decoration-none text-muted small">Help Center</a>
            </div>
        </div>
    </footer>
@endsection
