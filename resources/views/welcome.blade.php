@extends('layouts.landing-page')

@section('content')
    <!-- Hero Section with Video Background -->
    <div class="hero-section position-relative mb-5">
        <!-- Video Background with Blur and Opacity -->
        <div class="video-background">
            <video autoplay muted loop class="hero-video">
                <source src="https://assets.mixkit.co/videos/preview/mixkit-dj-playing-music-in-a-disco-club-4430-large.mp4"
                    type="video/mp4">
            </video>
        </div>

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-8 col-xl-6">
                        <h1 class="display-4 fw-bold text-white mb-3">Temukan Musik Terbaik</h1>
                        <p class="fs-3 text-white-50 mb-4">Platform musik Indonesia untuk mendengarkan, membuat cover, dan
                            berbagi karya musik.</p>

                        <!-- Search Section -->
                        <form action="#" method="GET" class="mt-4 mb-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-lg bg-dark border-0 text-white"
                                    placeholder="Cari judul lagu, nama artis...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="ti ti-search"></i>
                                </button>
                            </div>
                        </form>

                        <!-- CTA Buttons -->
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="btn btn-lg btn-primary">
                                <i class="ti ti-user-plus me-2"></i> Daftar Sekarang
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-lg btn-dark">
                                <i class="ti ti-login me-2"></i> Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Songs Section (Spotify Style) -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-white m-0"><i class="ti ti-music me-2 text-primary"></i>Lagu Populer</h3>
            <a href="{{ route('popular-songs') }}" class="btn btn-dark">
                Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
            </a>
        </div>

        <div class="card">
            <div class="list-group list-group-flush">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="list-group-item py-3 bg-dark border-secondary">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <span
                                    class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle"
                                    style="width: 30px; height: 30px;">{{ $i }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="position-relative">
                                    <img src="https://picsum.photos/300/300?random={{ $i + 50 }}" class="rounded"
                                        style="width: 50px; height: 50px;" alt="Song Cover">
                                    <button
                                        class="btn btn-icon btn-sm btn-primary rounded-circle position-absolute play-song-btn"
                                        style="bottom: -5px; right: -5px; width: 24px; height: 24px; padding: 0;"
                                        @guest
onclick="window.location.href='{{ route('login') }}'"
                                        @else
                                            onclick="window.location.href='{{ route('play-song', ['id' => $i]) }}'" @endguest
                                        data-song-title="Judul Lagu Populer #{{ $i }}"
                                        data-artist-name="Artis Populer #{{ $i }}"
                                        data-cover-image="https://picsum.photos/300/300?random={{ $i + 50 }}">
                                        <i class="ti ti-player-play" style="font-size: 14px;"></i>
                                    </button>
                                    @guest
                                        <span class="badge bg-dark position-absolute"
                                            style="top: -5px; right: -5px; font-size: 10px;">
                                            <i class="ti ti-lock"></i>
                                        </span>
                                    @endguest
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="text-truncate mb-1 text-white">Judul Lagu Populer #{{ $i }}</h5>
                                <div class="text-muted text-truncate">Artis Populer #{{ $i }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="text-muted">
                                        <i class="ti ti-player-play me-1"></i> {{ rand(1, 50) }}M
                                    </div>
                                    <div class="text-muted">
                                        <i class="ti ti-heart me-1"></i> {{ rand(100, 999) }}K
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-action text-white" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end bg-dark text-white">
                                            @auth
                                                <a class="dropdown-item text-white" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#addToPlaylistModal"
                                                    data-song-title="Judul Lagu Populer #{{ $i }}"
                                                    data-artist-name="Artis Populer #{{ $i }}"
                                                    data-cover-image="https://picsum.photos/300/300?random={{ $i + 50 }}">
                                                    <i class="ti ti-plus me-2"></i> Tambah ke Playlist
                                                </a>
                                                <a class="dropdown-item text-white" href="#">
                                                    <i class="ti ti-heart me-2"></i> Tambah ke Favorit
                                                </a>

                                                @if (Auth::user()->hasAnyRole(['Cover Creator', 'Artist', 'Composer']))
                                                    <a class="dropdown-item text-white" href="#">
                                                        <i class="ti ti-bookmark me-2"></i> Tambah ke Wishlist
                                                    </a>

                                                    <div class="dropdown-divider border-secondary"></div>
                                                    <a class="dropdown-item text-white" href="#">
                                                        <i class="ti ti-microphone me-2"></i> Buat Cover
                                                    </a>
                                                @endif
                                            @else
                                                <a class="dropdown-item text-white hover-dark" href="{{ route('login') }}">
                                                    <i class="ti ti-login me-2"></i> Login untuk Opsi Lainnya
                                                </a>
                                            @endauth

                                            <div class="dropdown-divider border-secondary"></div>
                                            <a class="dropdown-item text-white hover-dark" href="#">
                                                <i class="ti ti-share me-2"></i> Bagikan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Popular Artists Section (Spotify Style) -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-white m-0"><i class="ti ti-microphone me-2 text-primary"></i>Artis Populer</h3>
            <a href="{{ route('artists') }}" class="btn btn-dark">
                Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @for ($i = 21; $i <= 28; $i++)
                <div class="col-md-6 col-lg-3">
                    <div class="music-card text-center">
                        <img src="https://picsum.photos/300/300?random={{ $i }}" class="rounded-circle mb-3"
                            style="width: 120px; height: 120px;" alt="Artist">
                        <h4 class="mb-1 text-white">Artis Populer #{{ $i - 20 }}</h4>
                        <p class="text-muted mb-2">{{ rand(5, 30) }} Lagu • {{ rand(1, 10) }}M Penggemar</p>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge bg-purple-lt">
                                <i class="ti ti-users me-1"></i> {{ rand(1, 10) }}M
                            </span>
                            <span class="badge bg-blue-lt">
                                <i class="ti ti-player-play me-1"></i> {{ rand(10, 500) }}M
                            </span>
                        </div>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="ti ti-user me-1"></i> Lihat Profil
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Popular Covers Section (Spotify Style) -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-white m-0"><i class="ti ti-disc me-2 text-primary"></i>Cover Populer</h3>
            <a href="{{ route('covers') }}" class="btn btn-dark">
                Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @for ($i = 41; $i <= 48; $i++)
                <div class="col-md-6 col-lg-3">
                    <div class="music-card">
                        <div class="position-relative mb-2">
                            <img src="https://picsum.photos/300/300?random={{ $i }}"
                                class="w-100 rounded music-card-img" alt="Cover Art">
                            <button class="btn btn-icon btn-primary rounded-circle position-absolute play-song-btn"
                                style="bottom: 8px; right: 8px;"
                                @guest
onclick="window.location.href='{{ route('login') }}'"
                                @else
                                    onclick="window.location.href='{{ route('play-song', ['id' => $i]) }}'" @endguest
                                data-song-title="Cover Lagu #{{ $i - 40 }}"
                                data-artist-name="Cover Artist {{ $i - 40 }}"
                                data-cover-image="https://picsum.photos/300/300?random={{ $i }}">
                                <i class="ti ti-player-play"></i>
                            </button>
                            @guest
                                <span class="badge bg-dark position-absolute" style="top: 8px; right: 8px;">
                                    <i class="ti ti-lock"></i>
                                </span>
                            @endguest
                        </div>
                        <h5 class="text-truncate mb-1 text-white">Cover Lagu #{{ $i - 40 }}</h5>
                        <p class="text-muted text-truncate mb-0">Oleh: Cover Artist {{ $i - 40 }}</p>
                        <div class="d-flex align-items-center mt-2">
                            <span class="badge bg-blue-lt me-2">
                                <i class="ti ti-player-play me-1"></i> {{ rand(100, 999) }}K
                            </span>
                            <span class="badge bg-red-lt">
                                <i class="ti ti-heart me-1"></i> {{ rand(10, 99) }}K
                            </span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Popular Composers Section (Spotify Style) -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-white m-0"><i class="ti ti-note me-2 text-primary"></i>Pencipta Lagu Teratas</h3>
            <a href="{{ route('composers') }}" class="btn btn-dark">
                Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @for ($i = 31; $i <= 38; $i++)
                <div class="col-md-6 col-lg-3">
                    <div class="music-card text-center">
                        <img src="https://picsum.photos/300/300?random={{ $i }}" class="rounded-circle mb-3"
                            style="width: 120px; height: 120px;" alt="Composer">
                        <h4 class="mb-1 text-white">Pencipta #{{ $i - 30 }}</h4>
                        <p class="text-muted mb-2">{{ rand(20, 100) }} karya • {{ rand(100, 900) }}K Penggemar</p>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge bg-blue-lt">
                                <i class="ti ti-player-play me-1"></i> {{ rand(50, 800) }}M
                            </span>
                        </div>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="ti ti-user me-1"></i> Lihat Profil
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Call to Action (Spotify Style) -->
    <div class="card bg-gradient-dark mb-4">
        <div class="card-body text-center py-5">
            <h2 class="mb-3 text-white">Bergabunglah dengan Komunitas Musik Kami</h2>
            <p class="fs-4 mb-4 text-white">Dengarkan, buat cover, dan bagikan karya musik Anda dengan dunia.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-lg btn-primary">
                    <i class="ti ti-user-plus me-2"></i> Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-lg btn-outline-light">
                    <i class="ti ti-login me-2"></i> Login
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="ti ti-music fs-2 text-white"></i>
                    </div>
                    <h4 class="text-white mb-3">Dengarkan Musik</h4>
                    <p class="text-white">Akses jutaan lagu dari berbagai genre dan artis favorit Anda. Streaming kualitas
                        tinggi kapan saja dan di mana saja.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="ti ti-microphone fs-2 text-white"></i>
                    </div>
                    <h4 class="text-white mb-3">Buat Cover</h4>
                    <p class="text-white">Tunjukkan bakat Anda dengan membuat cover lagu favorit. Dapatkan pengakuan dan
                        bangun basis penggemar Anda sendiri.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="ti ti-share fs-2 text-white"></i>
                    </div>
                    <h4 class="text-white mb-3">Bagikan Karya</h4>
                    <p class="text-white">Bagikan karya musik Anda dengan dunia. Dapatkan umpan balik, komentar, dan bangun
                        komunitas musik Anda sendiri.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
