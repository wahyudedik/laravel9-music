@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1 text-white">Cover Populer</h2>
            <div class="text-white">Temukan semua cover lagu terbaik dari berbagai artis cover</div>
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
            <button type="button" class="btn btn-sm btn-dark active">Semua</button>
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

    <!-- Covers Grid -->
    <div class="row g-3 mb-5">
        @for ($i = 1; $i <= 32; $i++)
            <div class="col-sm-6 col-lg-3">
                <div class="card bg-dark border-0 h-100 transition-transform hover-shadow">
                    <div class="position-relative mb-2">
                        <img src="https://picsum.photos/300/300?random={{ $i + 400 }}" class="w-100 rounded-top"
                            alt="Cover Art">
                        <button class="btn btn-icon btn-primary rounded-circle position-absolute play-song-btn"
                            style="bottom: 8px; right: 8px;" data-song-title="Cover Lagu #{{ $i }}"
                            data-artist-name="Cover Artist {{ rand(1, 20) }}"
                            data-cover-image="https://picsum.photos/300/300?random={{ $i + 400 }}">
                            <i class="ti ti-player-play"></i>
                        </button>
                        @guest
                            <span class="badge bg-dark position-absolute" style="top: 8px; right: 8px;">
                                <i class="ti ti-lock"></i>
                            </span>
                        @endguest
                    </div>
                    <div class="card-body">
                        <h5 class="text-truncate mb-1 text-white">Cover Lagu #{{ $i }}</h5>
                        <p class="text-white text-truncate mb-2">Oleh: Cover Artist {{ rand(1, 20) }}</p>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-blue-lt me-2">
                                <i class="ti ti-player-play me-1"></i> {{ rand(100, 999) }}K
                            </span>
                            <span class="badge bg-red-lt">
                                <i class="ti ti-heart me-1"></i> {{ rand(10, 99) }}K
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Featured Cover Artists Section -->
    <div class="card bg-dark border-0 shadow-sm mt-4 mb-5">
        <div class="card-header border-bottom border-dark">
            <h3 class="card-title text-white">
                <i class="ti ti-microphone me-2 text-primary"></i>Artis Cover Terbaik
            </h3>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-md-6 col-lg-3">
                        <div class="text-center">
                                                        <img src="https://picsum.photos/300/300?random={{ $i + 500 }}" class="rounded-circle mb-3"
                                style="width: 120px; height: 120px;" alt="Artist">
                            <h4 class="mb-1 text-white">Cover Artist #{{ $i }}</h4>
                            <p class="text-white mb-2">{{ rand(10, 100) }} cover lagu</p>
                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-purple-lt">
                                    <i class="ti ti-users me-1"></i> {{ rand(100, 500) }}K
                                </span>
                                <span class="badge bg-blue-lt">
                                    <i class="ti ti-player-play me-1"></i> {{ rand(1, 50) }}M
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

    <!-- Trending Covers Section -->
    <div class="card bg-dark border-0 shadow-sm mb-5">
        <div class="card-header border-bottom border-dark">
            <h3 class="card-title text-white">
                <i class="ti ti-trending-up me-2 text-primary"></i>Cover Trending Minggu Ini
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
                            <th>Original</th>
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
                                            style="width: 40px; height: 40px;" alt="Cover">
                                        <button
                                            class="btn btn-icon btn-sm btn-primary rounded-circle position-absolute play-song-btn"
                                            style="bottom: -5px; right: -5px; width: 24px; height: 24px; padding: 0;"
                                            data-song-title="Cover Trending #{{ $i }}"
                                            data-artist-name="Cover Artist {{ rand(1, 20) }}"
                                            data-cover-image="https://picsum.photos/300/300?random={{ $i + 600 }}">
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
                                <td class="text-white">Cover Trending #{{ $i }}</td>
                                <td class="text-white">
                                    Cover Artist {{ rand(1, 20) }}
                                </td>
                                <td class="text-white">
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

