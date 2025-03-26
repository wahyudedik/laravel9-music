@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1 text-white">Pencipta Lagu</h2>
            <div class="text-white">Temukan semua pencipta lagu terbaik dengan karya-karya mereka</div>
        </div>
        <div class="d-none d-md-block">
            <div class="input-icon">
                <input type="text" class="form-control bg-dark text-white border-dark w-100" style="min-width: 300px;"
                    placeholder="Cari judul lagu...">
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
                        <i class="ti ti-check me-2 text-primary"></i> Terbaru
                    </a>
                    <a class="dropdown-item text-white" href="#">Terpopuler</a>
                    <a class="dropdown-item text-white" href="#">Paling Banyak Disukai</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Composers Section -->
    <div class="card bg-dark border-0 shadow-sm mb-5">
        <div class="card-header border-bottom border-dark">
            <h3 class="card-title text-white">
                <i class="ti ti-award me-2 text-primary"></i>Pencipta Lagu Terbaik
            </h3>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-md-6 col-lg-3">
                        <div class="text-center">
                            <img src="https://picsum.photos/300/300?random={{ $i + 500 }}" class="rounded-circle mb-3"
                                style="width: 120px; height: 120px;" alt="Composer">
                            <h4 class="mb-1 text-white">Pencipta Terbaik #{{ $i }}</h4>
                            <p class="text-white mb-2">{{ rand(50, 200) }} karya • {{ rand(500, 900) }}K Penggemar</p>
                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-blue-lt">
                                    <i class="ti ti-player-play me-1"></i> {{ rand(50, 200) }}M
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

    <!-- Composers Grid -->
    <div class="row g-4 mb-5">
        @for ($i = 1; $i <= 32; $i++)
            <div class="col-md-6 col-lg-3">
                <div class="card bg-dark border-0 h-100 transition-transform hover-shadow">
                    <div class="card-body text-center p-4">
                        <img src="https://picsum.photos/300/300?random={{ $i + 400 }}" class="rounded-circle mb-3"
                            style="width: 120px; height: 120px;" alt="Composer">
                        <h4 class="mb-1 text-white">Pencipta Lagu #{{ $i }}</h4>
                        <p class="text-white mb-2">{{ rand(20, 100) }} karya • {{ rand(100, 900) }}K Penggemar</p>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge bg-blue-lt">
                                <i class="ti ti-music me-1"></i> {{ rand(20, 100) }}
                            </span>
                            <span class="badge bg-green-lt">
                                <i class="ti ti-microphone me-1"></i> {{ rand(5, 50) }} Dicover
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

    <!-- Top Compositions Section -->
    <div class="card bg-dark border-0 shadow-sm mb-5">
        <div class="card-header border-bottom border-dark">
            <h3 class="card-title text-white">
                <i class="ti ti-playlist me-2 text-primary"></i>Karya Terpopuler
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
                            <th>Pencipta</th>
                            <th>Dinyanyikan Oleh</th>
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
                                        <img src="https://picsum.photos/300/300?random={{ $i + 600 }}" class="rounded"
                                            style="width: 40px; height: 40px;" alt="Song">
                                        <button
                                            class="btn btn-icon btn-sm btn-primary rounded-circle position-absolute play-song-btn"
                                            style="bottom: -5px; right: -5px; width: 24px; height: 24px; padding: 0;"
                                            data-song-title="Karya Populer #{{ $i }}"
                                            data-artist-name="Pencipta #{{ rand(1, 20) }}"
                                            data-cover-image="https://picsum.photos/300/300?random={{ $i + 600 }}">
                                            <i class="ti ti-player-play" style="font-size: 14px;"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="text-white">Karya Populer #{{ $i }}</td>
                                <td class="text-white">
                                    Pencipta #{{ rand(1, 20) }}
                                </td>
                                <td class="text-white">
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
