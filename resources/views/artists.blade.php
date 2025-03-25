@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1 text-white">Artis Populer</h2>
            <div class="text-white">Temukan semua artis populer dengan karya-karya terbaik mereka</div>
        </div>
        <div class="d-none d-md-block">
            <div class="input-icon">
                <input type="text" class="form-control bg-dark text-white border-dark w-100" style="min-width: 300px;" placeholder="Cari judul lagu...">
            </div>
        </div>
    </div>

    <!-- Filter Chips -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-dark active">Semua Genre</button>
            <button type="button" class="btn btn-sm btn-dark">Pop</button>
            <button type="button" class="btn btn-sm btn-dark">Rock</button>
            <button type="button" class="btn btn-sm btn-dark">Hip Hop</button>
            <button type="button" class="btn btn-sm btn-dark">R&B</button>
            <button type="button" class="btn btn-sm btn-dark">Electronic</button>
        </div>
        
        <div class="ms-auto">
            <div class="dropdown">
                <button class="btn btn-sm btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="ti ti-sort-ascending me-1"></i> Urutkan
                </button>
                <div class="dropdown-menu dropdown-menu-end bg-dark text-white">
                    <a class="dropdown-item text-white active" href="#">
                        <i class="ti ti-check me-2 text-primary"></i> Paling Populer
                    </a>
                    <a class="dropdown-item text-white" href="#">A-Z</a>
                    <a class="dropdown-item text-white" href="#">Z-A</a>
                    <a class="dropdown-item text-white" href="#">Followers Terbanyak</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Artists Section -->
    <div class="card bg-dark border-0 shadow-sm mb-5">
        <div class="card-header border-bottom border-dark">
            <h3 class="card-title text-white">
                <i class="ti ti-crown me-2 text-primary"></i>Artis Teratas
            </h3>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-md-6 col-lg-3">
                        <div class="text-center">
                            <img src="https://picsum.photos/300/300?random={{ $i + 50 }}"
                                class="rounded-circle mb-3" style="width: 150px; height: 150px;" alt="Artist">
                            <h4 class="mb-1 text-white">Top Artist #{{ $i }}</h4>
                            <p class="text-white mb-2">{{ rand(20, 100) }} Lagu • {{ rand(5, 20) }}M Penggemar</p>
                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-purple-lt">
                                    <i class="ti ti-users me-1"></i> {{ rand(5, 20) }}M
                                </span>
                                <span class="badge bg-blue-lt">
                                    <i class="ti ti-player-play me-1"></i> {{ rand(100, 999) }}M
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
    </div>

    <!-- Artists Grid -->
    <div class="row g-4 mb-5">
        @for ($i = 1; $i <= 24; $i++)
            <div class="col-md-6 col-lg-3">
                <div class="card bg-dark border-0 h-100 transition-transform hover-shadow">
                    <div class="card-body text-center p-4">
                        <img src="https://picsum.photos/300/300?random={{ $i + 100 }}"
                            class="rounded-circle mb-3" style="width: 150px; height: 150px;" alt="Artist">
                        <h4 class="mb-1 text-white">Artis Populer #{{ $i }}</h4>
                        <p class="text-white mb-2">{{ rand(5, 30) }} Lagu • {{ rand(1, 10) }}M Penggemar</p>
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
            </div>
        @endfor
    </div>

    <!-- Top Songs by Artists -->
    <div class="card bg-dark border-0 shadow-sm mb-5">
        <div class="card-header border-bottom border-dark">
            <h3 class="card-title text-white">
                <i class="ti ti-chart-bar me-2 text-primary"></i>Lagu Terpopuler dari Artis
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr class="text-white">
                            <th width="40">#</th>
                            <th width="80"></th>
                            <th>Judul</th>
                            <th>Artis</th>
                            <th>Album</th>
                            <th>Stats</th>
                            <th width="40"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 5; $i++)
                            <tr class="align-middle">
                                <td class="text-white">{{ $i }}</td>
                                <td>
                                    <div class="position-relative">
                                        <img src="https://picsum.photos/300/300?random={{ $i + 200 }}" class="rounded"
                                            style="width: 40px; height: 40px;" alt="Song">
                                        <button
                                            class="btn btn-icon btn-sm btn-primary rounded-circle position-absolute play-song-btn"
                                                                                        style="bottom: -5px; right: -5px; width: 24px; height: 24px; padding: 0;"
                                            data-song-title="Lagu Populer #{{ $i }}"
                                            data-artist-name="Artis Populer #{{ rand(1, 5) }}"
                                            data-cover-image="https://picsum.photos/300/300?random={{ $i + 200 }}">
                                            <i class="ti ti-player-play" style="font-size: 14px;"></i>
                                        </button>
                                        @guest
                                            <span class="badge bg-dark position-absolute"
                                                style="top: -5px; right: -5px; font-size: 10px;">
                                                <i class="ti ti-lock"></i>
                                            </span>
                                        @endguest
                                    </div>
                                </td>
                                <td class="text-white">Lagu Populer #{{ $i }}</td>
                                <td class="text-white">
                                    Artis Populer #{{ rand(1, 5) }}
                                </td>
                                <td class="text-white">
                                    <small>Album #{{ rand(1, 10) }}</small>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-blue-lt">
                                            <i class="ti ti-player-play me-1"></i> {{ rand(10, 100) }}M
                                        </span>
                                        <span class="badge bg-red-lt">
                                            <i class="ti ti-heart me-1"></i> {{ rand(100, 999) }}K
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-action text-white" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end bg-dark text-white">
                                            <a class="dropdown-item text-white" href="#" data-bs-toggle="modal"
                                                data-bs-target="#addToPlaylistModal">
                                                <i class="ti ti-plus me-2"></i> Tambah ke Playlist
                                            </a>
                                            <a class="dropdown-item text-white" href="#">
                                                <i class="ti ti-heart me-2"></i> Tambah ke Favorit
                                            </a>
                                            <a class="dropdown-item text-white" href="#">
                                                <i class="ti ti-share me-2"></i> Bagikan
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
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4 mb-5">
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link bg-dark text-white border-dark" href="#" tabindex="-1" aria-disabled="true">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </li>
            <li class="page-item active"><a class="page-link bg-primary border-primary" href="#">1</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-dark" href="#">2</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-dark" href="#">3</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-dark" href="#">4</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-dark" href="#">5</a></li>
            <li class="page-item">
                <a class="page-link bg-dark text-white border-dark" href="#">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>
@endsection

