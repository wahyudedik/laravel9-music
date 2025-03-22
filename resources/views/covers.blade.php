@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Cover Populer</h2>
                <div class="text-muted mt-1">Temukan semua cover lagu terbaik dari berbagai artis cover</div>
            </div>
            <div class="col-auto">
                <div class="input-icon">
                    <input type="text" class="form-control" placeholder="Cari judul cover...">
                    <span class="input-icon-addon">
                        <i class="ti ti-search"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Options -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <div class="dropdown">
            <a href="#" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="ti ti-music me-1"></i> Genre
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Semua Genre</a>
                <a class="dropdown-item" href="#">Pop</a>
                <a class="dropdown-item" href="#">Rock</a>
                <a class="dropdown-item" href="#">Hip Hop</a>
                <a class="dropdown-item" href="#">R&B</a>
                <a class="dropdown-item" href="#">Electronic</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="ti ti-calendar me-1"></i> Periode
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Minggu Ini</a>
                <a class="dropdown-item" href="#">Bulan Ini</a>
                <a class="dropdown-item" href="#">6 Bulan Terakhir</a>
                <a class="dropdown-item" href="#">Tahun Ini</a>
                <a class="dropdown-item" href="#">Sepanjang Masa</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="ti ti-sort-ascending me-1"></i> Urutkan
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Terbaru</a>
                <a class="dropdown-item" href="#">Terpopuler</a>
                <a class="dropdown-item" href="#">Paling Banyak Disukai</a>
            </div>
        </div>
    </div>

    <!-- Covers Grid -->
    <div class="row row-cards">
        @for ($i = 1; $i <= 32; $i++)
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <a href="#" class="d-block">
                        <img src="https://picsum.photos/300/300?random={{ $i + 400 }}" class="card-img-top"
                            alt="Cover Art">
                    </a>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div>Cover Lagu #{{ $i }}</div>
                                <div class="text-muted">Oleh: Cover Artist {{ rand(1, 20) }}</div>
                            </div>
                            <div class="ms-auto">
                                <a href="#" class="btn btn-icon btn-primary">
                                    <i class="ti ti-player-play"></i>
                                </a>
                            </div>
                        </div>
                        <div class="mt-3 d-flex">
                            <div class="me-3">
                                <span class="badge bg-blue-lt">
                                    <i class="ti ti-player-play me-1"></i> {{ rand(100, 999) }}K
                                </span>
                            </div>
                            <div>
                                <span class="badge bg-red-lt">
                                    <i class="ti ti-heart me-1"></i> {{ rand(10, 99) }}K
                                </span>
                            </div>
                            @guest
                                <div class="ms-auto">
                                    <span class="badge bg-dark">
                                        <i class="ti ti-lock me-1"></i>
                                    </span>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Featured Cover Artists Section -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ti ti-microphone me-2 text-primary"></i>Artis Cover Terbaik
            </h3>
        </div>
        <div class="card-body">
            <div class="row row-cards">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 avatar-rounded"
                                    style="background-image: url(https://picsum.photos/300/300?random={{ $i + 500 }})"></span>
                                <h3 class="m-0 mb-1">Cover Artist #{{ $i }}</h3>
                                <div class="text-muted">{{ rand(10, 100) }} cover lagu</div>
                                <div class="mt-3">
                                    <span class="badge bg-purple-lt">
                                        <i class="ti ti-users me-1"></i> {{ rand(100, 500) }}K
                                    </span>
                                    <span class="badge bg-blue-lt">
                                        <i class="ti ti-player-play me-1"></i> {{ rand(1, 50) }}M
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

    <!-- Trending Covers Section -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ti ti-trending-up me-2 text-primary"></i>Cover Trending Minggu Ini
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover">
                    <thead>
                        <tr>
                            <th width="40">#</th>
                            <th width="80"></th>
                            <th>Judul</th>
                            <th>Artis</th>
                            <th>Original</th>
                            <th>Stats</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 5; $i++)
                            <tr>
                                <td class="text-muted">{{ $i }}</td>
                                <td>
                                    <div class="position-relative">
                                        <span class="avatar avatar-md"
                                            style="background-image: url(https://picsum.photos/300/300?random={{ $i + 600 }})"></span>
                                        <span class="badge bg-primary position-absolute" style="bottom: 0; right: 0;">
                                            <i class="ti ti-player-play"></i>
                                        </span>
                                        @guest
                                            <span class="badge bg-dark position-absolute" style="top: 0; right: 0;">
                                                <i class="ti ti-lock"></i>
                                            </span>
                                        @endguest
                                    </div>
                                </td>
                                <td>Cover Trending #{{ $i }}</td>
                                <td class="text-muted">
                                    Cover Artist {{ rand(1, 20) }}
                                </td>
                                <td class="text-muted">
                                    <small>Lagu Asli #{{ $i }} - Artis Asli #{{ $i }}</small>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-blue-lt">
                                            <i class="ti ti-player-play me-1"></i> {{ rand(1, 10) }}M
                                        </span>
                                        <span class="badge bg-red-lt">
                                            <i class="ti ti-heart me-1"></i> {{ rand(100, 999) }}K
                                        </span>
                                        <span class="badge bg-green-lt">
                                            <i class="ti ti-calendar me-1"></i> {{ rand(1, 4) }} minggu
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
                <a class="page-link" href="#">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>
@endsection
