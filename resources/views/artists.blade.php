@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Artis Populer</h2>
                <div class="text-muted mt-1">Temukan semua artis populer dengan karya-karya terbaik mereka</div>
            </div>
            <div class="col-auto">
                <div class="input-icon">
                    <input type="text" class="form-control" placeholder="Cari nama artis...">
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
                <i class="ti ti-chart-bar me-1"></i> Popularitas
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Paling Populer</a>
                <a class="dropdown-item" href="#">Trending</a>
                <a class="dropdown-item" href="#">Artis Baru</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="ti ti-sort-ascending me-1"></i> Urutkan
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">A-Z</a>
                <a class="dropdown-item" href="#">Z-A</a>
                <a class="dropdown-item" href="#">Followers Terbanyak</a>
                <a class="dropdown-item" href="#">Stream Terbanyak</a>
            </div>
        </div>
    </div>

    <!-- Artists Grid -->
    <div class="row row-cards">
        @for ($i = 1; $i <= 24; $i++)
            <div class="col-md-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url(https://picsum.photos/300/300?random={{ $i + 100 }})"></span>
                        <h3 class="m-0 mb-1">Artis Populer #{{ $i }}</h3>
                        <div class="mt-3">
                            <span class="badge bg-purple-lt">
                                <i class="ti ti-users me-1"></i> {{ rand(1, 10) }}M
                            </span>
                            <span class="badge bg-blue-lt">
                                <i class="ti ti-music me-1"></i> {{ rand(5, 30) }}
                            </span>
                            <span class="badge bg-green-lt">
                                <i class="ti ti-microphone me-1"></i> {{ rand(2, 15) }}
                            </span>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-cyan-lt">
                                <i class="ti ti-player-play me-1"></i> {{ rand(10, 500) }}M Stream
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
