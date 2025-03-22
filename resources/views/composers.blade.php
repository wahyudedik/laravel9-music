@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Pencipta Lagu</h2>
                <div class="text-muted mt-1">Temukan semua pencipta lagu terbaik dengan karya-karya mereka</div>
            </div>
            <div class="col-auto">
                <div class="input-icon">
                    <input type="text" class="form-control" placeholder="Cari nama pencipta...">
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

    <!-- Composers Grid -->
    <div class="row row-cards">
        @for ($i = 1; $i <= 32; $i++)
            <div class="col-md-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url(https://picsum.photos/300/300?random={{ $i + 400 }})"></span>
                        <h3 class="m-0 mb-1">Pencipta Lagu #{{ $i }}</h3>
                        <div class="text-muted">{{ rand(20, 100) }} karya</div>
                        <div class="mt-3">
                            <span class="badge bg-purple-lt">
                                <i class="ti ti-users me-1"></i> {{ rand(100, 900) }}K
                            </span>
                            <span class="badge bg-blue-lt">
                                <i class="ti ti-music me-1"></i> {{ rand(20, 100) }}
                            </span>
                        </div>
                        <div class="mt-2">
                            <span class="badge bg-green-lt">
                                <i class="ti ti-microphone me-1"></i> {{ rand(5, 50) }} Dicover
                            </span>
                            <span class="badge bg-cyan-lt">
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

    <!-- Featured Composers Section -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ti ti-award me-2 text-primary"></i>Pencipta Lagu Terbaik
            </h3>
        </div>
        <div class="card-body">
            <div class="row row-cards">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url(https://picsum.photos/300/300?random={{ $i + 500 }})"></span>
                                <h3 class="m-0 mb-1">Pencipta Terbaik #{{ $i }}</h3>
                                <div class="text-muted">{{ rand(50, 200) }} karya</div>
                                <div class="mt-3">
                                    <span class="badge bg-purple-lt">
                                        <i class="ti ti-users me-1"></i> {{ rand(500, 900) }}K
                                    </span>
                                    <span class="badge bg-blue-lt">
                                        <i class="ti ti-player-play me-1"></i> {{ rand(50, 200) }}M
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

    <!-- Top Compositions Section -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ti ti-playlist me-2 text-primary"></i>Karya Terpopuler
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
                            <th>Pencipta</th>
                            <th>Dinyanyikan Oleh</th>
                            <th>Stats</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 5; $i++)
                            <tr>
                                <td class="text-muted">{{ $i }}</td>
                                <td>
                                    <div class="position-relative">
                                        <span class="avatar avatar-md" style="background-image: url(https://picsum.photos/300/300?random={{ $i + 600 }})"></span>
                                        <span class="badge bg-primary position-absolute" style="bottom: 0; right: 0;">
                                            <i class="ti ti-player-play"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>Karya Populer #{{ $i }}</td>
                                <td class="text-muted">
                                    Pencipta #{{ rand(1, 20) }}
                                </td>
                                <td class="text-muted">
                                    <small>Artis Populer #{{ rand(1, 10) }}</small>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-blue-lt">
                                            <i class="ti ti-player-play me-1"></i> {{ rand(10, 100) }}M
                                        </span>
                                        <span class="badge bg-red-lt">
                                            <i class="ti ti-heart me-1"></i> {{ rand(100, 999) }}K
                                        </span>
                                        <span class="badge bg-green-lt">
                                            <i class="ti ti-microphone me-1"></i> {{ rand(5, 30) }} cover
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
