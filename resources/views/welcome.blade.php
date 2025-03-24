@extends('layouts.landing-page')

@section('content')
    <!-- Hero Section -->
    <div class="card mb-4 bg-primary-lt">
        <div class="card-body py-5">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1 class="display-5 fw-bold mb-3">Temukan Musik Terbaik</h1>
                    <p class="fs-3 text-muted">Platform musik Indonesia untuk mendengarkan, membuat cover, dan berbagi karya
                        musik.</p>

                    <!-- Search Section -->
                    <form action="#" method="GET" class="mt-4">
                        <div class="input-icon mb-3">
                            <input type="text" class="form-control form-control-lg"
                                placeholder="Cari judul lagu, nama artis...">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span> 
                        </div>
                    </form>
                </div>
                <div class="col-md-5 d-none d-md-block">
                    <img src="{{ asset('img/hero.png') }}" class="img-fluid" alt="Music Illustration">
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Songs Section -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="ti ti-music me-2 text-primary"></i>
                    <h3 class="card-title mb-0">Lagu Populer</h3>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('popular-songs') }}" class="btn btn-link text-primary">
                    Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="list-group list-group-flush">
            @for ($i = 1; $i <= 5; $i++)
                <div class="list-group-item">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <span class="avatar avatar-sm bg-primary-lt">{{ $i }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="position-relative">
                                <img src="https://picsum.photos/300/300?random={{ $i + 50 }}"
                                    class="avatar avatar-lg rounded" alt="Song Cover">
                                <span class="badge bg-primary position-absolute" style="bottom: 5px; right: 5px;">
                                    <i class="ti ti-player-play"></i>
                                </span>
                                @guest
                                    <span class="badge bg-dark position-absolute" style="top: 5px; right: 5px;">
                                        <i class="ti ti-lock"></i>
                                    </span>
                                @endguest
                            </div>
                        </div>
                        <div class="col">
                            <h4 class="text-truncate mb-1">Judul Lagu Populer #{{ $i }}</h4>
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
                                <div class="text-muted d-none d-md-block">
                                    <i class="ti ti-calendar me-1"></i> {{ rand(1, 12) }} bulan lalu
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Popular Artists Section -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="ti ti-microphone me-2 text-primary"></i>Artis Populer
                </h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('artists') }}" class="btn btn-link text-primary">
                    Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cards">
                @for ($i = 21; $i <= 28; $i++)
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 avatar-rounded">
                                    <img src="https://picsum.photos/300/300?random={{ $i }}" alt="Artist">
                                </span>
                                <h3 class="m-0 mb-1">Artis Populer #{{ $i - 20 }}</h3>
                                <div class="text-muted">{{ rand(5, 30) }} Lagu</div>
                                <div class="mt-3">
                                    <span class="badge bg-purple-lt">
                                        <i class="ti ti-users me-1"></i> {{ rand(1, 10) }}M
                                    </span>
                                    <span class="badge bg-blue-lt">
                                        <i class="ti ti-player-play me-1"></i> {{ rand(10, 500) }}M
                                    </span>
                                </div>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">
                                        <i class="ti ti-user me-1"></i> Lihat Profil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Popular Covers Section -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="ti ti-disc me-2 text-primary"></i>Cover Populer
                </h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('covers') }}" class="btn btn-link text-primary">
                    Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cards">
                @for ($i = 41; $i <= 48; $i++)
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <img src="https://picsum.photos/300/300?random={{ $i }}" class="card-img-top"
                                alt="Cover Art">
                            <div class="card-body">
                                <h3 class="card-title">Cover Lagu #{{ $i - 40 }}</h3>
                                <div class="text-muted mb-3">Oleh: Cover Artist {{ $i - 40 }}</div>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-icon btn-primary">
                                        <i class="ti ti-player-play"></i>
                                    </a>
                                    @guest
                                        <span class="badge bg-dark">
                                            <i class="ti ti-lock me-1"></i> Login untuk mendengarkan
                                        </span>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Popular Composers Section -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="ti ti-note me-2 text-primary"></i>Pencipta Lagu Teratas
                </h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('composers') }}" class="btn btn-link text-primary">
                    Lihat Semua <i class="ti ti-chevron-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cards">
                @for ($i = 31; $i <= 38; $i++)
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 avatar-rounded">
                                    <img src="https://picsum.photos/300/300?random={{ $i }}" alt="Composer">
                                </span>
                                <h3 class="m-0 mb-1">Pencipta #{{ $i - 30 }}</h3>
                                <div class="text-muted">{{ rand(20, 100) }} Lagu</div>
                                <div class="mt-3">
                                    <span class="badge bg-purple-lt">
                                        <i class="ti ti-users me-1"></i> {{ rand(100, 900) }}K
                                    </span>
                                    <span class="badge bg-blue-lt">
                                        <i class="ti ti-player-play me-1"></i> {{ rand(50, 800) }}M
                                    </span>
                                </div>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">
                                        <i class="ti ti-user me-1"></i> Lihat Profil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="card bg-primary-lt mb-4">
        <div class="card-body text-center py-4">
            <h2 class="mb-3">Bergabunglah dengan Komunitas Musik Kami</h2>
            <p class="text-muted fs-4 mb-4">Dengarkan, buat cover, dan bagikan karya musik Anda dengan dunia.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-lg btn-primary">
                    <i class="ti ti-user-plus me-2"></i> Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-lg btn-outline-primary">
                    <i class="ti ti-login me-2"></i> Login
                </a>
            </div>
        </div>
    </div>
@endsection
