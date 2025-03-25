@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1 text-white">Lagu Populer</h2>
            <div class="text-white">Daftar 50 lagu terpopuler saat ini berdasarkan jumlah stream dan likes</div>
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
                        <i class="ti ti-check me-2 text-primary"></i> Paling Populer
                    </a>
                    <a class="dropdown-item text-white" href="#">Terbaru</a>
                    <a class="dropdown-item text-white" href="#">Paling Banyak Disukai</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Songs List -->
    <div class="card bg-dark border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-dark table-hover table-vcenter">
                <thead>
                    <tr class="text-white">
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
                        <tr class="align-middle">
                            <td class="text-white">{{ $i }}</td>
                            <td>
                                <div class="position-relative">
                                    <img src="https://picsum.photos/300/300?random={{ $i + 100 }}" class="rounded"
                                        style="width: 40px; height: 40px;" alt="Song Cover">
                                    <button
                                        class="btn btn-icon btn-sm btn-primary rounded-circle position-absolute play-song-btn"
                                        style="bottom: -5px; right: -5px; width: 24px; height: 24px; padding: 0;"
                                        @guest
                                            onclick="window.location.href='{{ route('login') }}'"
                                        @else
                                            onclick="window.location.href='{{ route('play-song', ['id' => $i]) }}'" 
                                        @endguest
                                        data-song-title="Judul Lagu Populer #{{ $i }}"
                                        data-artist-name="Artis Populer #{{ rand(1, 20) }}"
                                        data-cover-image="https://picsum.photos/300/300?random={{ $i + 100 }}">
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
                            <td class="text-white">Judul Lagu Populer #{{ $i }}</td>
                            <td class="text-white">
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
                                    <a href="#" class="btn btn-action text-white" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end bg-dark text-white">
                                        @auth
                                            <a class="dropdown-item text-white" href="#" data-bs-toggle="modal"
                                                data-bs-target="#addToPlaylistModal"
                                                data-song-title="Judul Lagu Populer #{{ $i }}"
                                                data-artist-name="Artis Populer #{{ rand(1, 20) }}"
                                                data-cover-image="https://picsum.photos/300/300?random={{ $i + 100 }}">
                                                <i class="ti ti-plus me-2"></i> Tambah ke Playlist
                                            </a>
                                            <a class="dropdown-item text-white" href="#">
                                                <i class="ti ti-heart me-2"></i> Tambah ke Favorit
                                            </a>

                                            @if (Auth::user()->hasAnyRole(['Cover Creator', 'Artist', 'Composer']))
                                                <a class="dropdown-item text-white" href="#">
                                                    <i class="ti ti-bookmark me-2"></i> Tambah ke Wishlist
                                                </a>
                                            @endif

                                            @if (Auth::user()->hasAnyRole(['Cover Creator', 'Artist', 'Composer']))
                                                <div class="dropdown-divider border-secondary"></div>
                                                <a class="dropdown-item text-white" href="#">
                                                    <i class="ti ti-microphone me-2"></i> Buat Cover
                                                </a>
                                            @endif
                                        @else
                                            <a class="dropdown-item text-white" href="{{ route('login') }}">
                                                <i class="ti ti-login me-2"></i> Login untuk Opsi Lainnya
                                            </a>
                                        @endauth

                                        <div class="dropdown-divider border-secondary"></div>
                                        <a class="dropdown-item text-white" href="#">
                                            <i class="ti ti-share me-2"></i> Bagikan
                                        </a>
                                        <a class="dropdown-item text-white" href="{{ route('play-song', ['id' => $i]) }}">
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
                <a class="page-link bg-dark text-white border-dark" href="#" tabindex="-1" aria-disabled="true">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </li>
            <li class="page-item active"><a class="page-link bg-primary border-primary" href="#">1</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-dark" href="#">2</a></li>
            <li class="page-item"><a class="page-link bg-dark text-white border-dark" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link bg-dark text-white border-dark" href="#">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>
@endsection
