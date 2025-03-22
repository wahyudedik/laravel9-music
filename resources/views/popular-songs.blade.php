@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Lagu Populer</h2>
                <div class="text-muted mt-1">Daftar 50 lagu terpopuler saat ini berdasarkan jumlah stream dan likes</div>
            </div>
            <div class="col-auto">
                <div class="input-icon">
                    <input type="text" class="form-control" placeholder="Cari judul lagu...">
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
                <a class="dropdown-item" href="#">Paling Populer</a>
                <a class="dropdown-item" href="#">Terbaru</a>
                <a class="dropdown-item" href="#">Paling Banyak Disukai</a>
            </div>
        </div>
    </div>

    <!-- Popular Songs List -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover">
                <thead>
                    <tr>
                        <th width="40">#</th>
                        <th width="80"></th>
                        <th>Judul</th>
                        <th>Artis</th>
                        <th>Stats</th>
                        <th width="40"></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 50; $i++)
                        <tr>
                            <td class="text-muted">{{ $i }}</td>
                            <td>
                                <div class="position-relative">
                                    <span class="avatar avatar-md"
                                        style="background-image: url(https://picsum.photos/300/300?random={{ $i + 100 }})"></span>
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
                            <td>Judul Lagu Populer #{{ $i }}</td>
                            <td class="text-muted">
                                Artis Populer #{{ rand(1, 20) }}
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-blue-lt">
                                        <i class="ti ti-player-play me-1"></i> {{ rand(1, 50) }}M
                                    </span>
                                    <span class="badge bg-red-lt">
                                        <i class="ti ti-heart me-1"></i> {{ rand(100, 999) }}K
                                    </span>
                                    <span class="badge bg-green-lt">
                                        <i class="ti ti-calendar me-1"></i> {{ rand(1, 12) }} bulan
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-plus me-2"></i> Tambah ke Playlist
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-heart me-2"></i> Tambah ke Favorit
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-share me-2"></i> Bagikan
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-info-circle me-2"></i> Detail Lagu
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
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
            <li class="page-item">
                <a class="page-link" href="#">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>
@endsection
