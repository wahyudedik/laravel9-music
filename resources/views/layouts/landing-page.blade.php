<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist Music</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e53935;
            --primary-dark: #c62828;
            --primary-light: #ef5350;
            --bg-color: #121212;
            --card-bg: #181818;
            --sidebar-bg: #000000;
            --text-color: #fff;
            --text-muted: #b3b3b3;
            --border-color: #2a2a2a;
            --sidebar-width: 240px;
            --mini-player-height: 90px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            background-color: var(--sidebar-bg);
            overflow-y: auto;
            transition: all 0.3s;
        }

        .sidebar-logo {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav .nav-link {
            color: var(--text-muted);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
            transition: all 0.2s;
            text-decoration: none;
        }

        .sidebar-nav .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav .nav-link.active {
            color: #fff;
            border-left-color: var(--primary-color);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav .nav-link-icon {
            margin-right: 0.75rem;
        }

        .sidebar-section-title {
            color: var(--text-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1rem 1.5rem 0.5rem;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            padding-bottom: calc(var(--mini-player-height) + 2rem);
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        /* Card Styles */
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }

        .card-header {
            background-color: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid var(--border-color);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 500px;
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
        }

        .hero-video {
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            object-fit: cover;
            opacity: 0.6;
            filter: blur(2px);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            padding: 4rem 2rem;
            height: 100%;
            display: flex;
            align-items: center;
        }

        /* Mini Player */
        .mini-player {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: var(--mini-player-height);
            background-color: #181818;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0 20px;
            display: none;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
        }

        .mini-player-visible {
            display: flex;
        }

        .mini-player-info {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .mini-player-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .mini-player-progress {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #3e3e3e;
        }

        .mini-player-progress-bar {
            height: 100%;
            background-color: var(--primary-color);
            width: 0%;
        }

        /* Music Cards */
        .music-card {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .music-card:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-5px);
        }

        .music-card-img {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .music-card:hover .music-card-img {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Play Button */
        .play-song-btn {
            opacity: 0.9;
            transition: all 0.2s ease;
        }

        .play-song-btn:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Table Styles */
        .table {
            color: var(--text-color);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Form Controls */
        .form-control {
            background-color: #2a2a2a;
            border-color: var(--border-color);
            color: var(--text-color);
        }

        .form-control:focus {
            background-color: #333;
            color: var(--text-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(229, 57, 53, 0.25);
        }

        .dropdown-item.hover-dark:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff !important;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <a href="{{ url('/') }}" class="sidebar-logo">
                <img src="{{ asset('img/favicon.png') }}" width="32" height="32" alt="Logo" class="me-2">
                <span class="font-weight-bold">Playlist Music</span>
            </a>

            <div class="sidebar-nav">
                <div class="sidebar-section-title">Menu</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <span class="nav-link-icon"><i class="ti ti-home"></i></span>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('popular-songs') ? 'active' : '' }}"
                            href="{{ route('popular-songs') }}">
                            <span class="nav-link-icon"><i class="ti ti-music"></i></span>
                            <span>Lagu Populer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('artists') ? 'active' : '' }}"
                            href="{{ route('artists') }}">
                            <span class="nav-link-icon"><i class="ti ti-microphone"></i></span>
                            <span>Artis</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('covers') ? 'active' : '' }}" href="{{ route('covers') }}">
                            <span class="nav-link-icon"><i class="ti ti-disc"></i></span>
                            <span>Cover</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('composers') ? 'active' : '' }}"
                            href="{{ route('composers') }}">
                            <span class="nav-link-icon"><i class="ti ti-note"></i></span>
                            <span>Pencipta</span>
                        </a>
                    </li>
                </ul>

                @auth
                    <div class="sidebar-section-title mt-4">Koleksi Saya</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-icon"><i class="ti ti-heart"></i></span>
                                <span>Lagu Favorit</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-icon"><i class="ti ti-playlist"></i></span>
                                <span>Playlist Saya</span>
                            </a>
                        </li>
                        @if (Auth::user()->hasAnyRole(['Cover Creator', 'Artist', 'Composer']))
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-icon"><i class="ti ti-bookmark"></i></span>
                                    <span>Wishlist</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link-icon"><i class="ti ti-microphone-2"></i></span>
                                    <span>Cover Saya</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                @endauth
            </div>

            <div class="p-3 mt-auto">
                @auth
                    <div class="d-flex align-items-center mb-3">
                        <span class="avatar avatar-sm bg-primary-lt me-2">{{ substr(Auth::user()->name, 0, 2) }}</span>
                        <div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="small text-muted">{{ Auth::user()->getRoleNames()->first() }}</div>
                        </div>
                    </div>
                    <div class="d-grid">
                        @php
                            $user = Auth::user();
                            $userRole = $user->getRoleNames()->first();
                        @endphp
                        <form action="{{ url('logout/' . $userRole) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm w-100">
                                <i class="ti ti-logout me-1"></i> Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="d-grid gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="ti ti-login me-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="ti ti-user-plus me-1"></i> Register
                        </a>
                    </div>
                @endauth
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Mobile Navbar for Sidebar Toggle -->
            <div class="d-lg-none mb-4">
                <button class="btn btn-dark" id="sidebarToggle">
                    <i class="ti ti-menu-2"></i>
                </button>
            </div>

            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            <footer class="mt-5 pt-4 pb-4 text-center text-md-start">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="text-white mb-3">Playlist Music</h5>
                        <p class="text-white">Platform musik Indonesia untuk mendengarkan, membuat cover, dan berbagi
                            karya musik.</p>
                        <div class="d-flex gap-3 mt-3">
                            <a href="#" class="text-white btn btn-outline-light"><i class="ti ti-brand-instagram"></i></a>
                            <a href="#" class="text-white btn btn-outline-light"><i class="ti ti-brand-twitter"></i></a>
                            <a href="#" class="text-white btn btn-outline-light"><i class="ti ti-brand-facebook"></i></a>
                            <a href="#" class="text-white btn btn-outline-light"><i class="ti ti-brand-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-md-2 mb-4 mb-md-0">
                        <h6 class="text-white mb-3">Perusahaan</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Tentang</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Karir</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-4 mb-md-0">
                        <h6 class="text-white mb-3">Komunitas</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Artis</a>
                            </li>
                            <li class="mb-2"><a href="#"
                                    class="text-white text-decoration-none">Pengembang</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Investor</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-white mb-3">Tautan Berguna</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Dukungan</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Aplikasi
                                    Mobile</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Privasi</a>
                            </li>
                            <li class="mb-2"><a href="#"
                                    class="text-white text-decoration-none">Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-top border-dark mt-4 pt-4 text-white">
                    <div class="d-flex justify-content-between flex-column flex-md-row">
                        <div>© 2025 Playlist Music Indonesia. All rights reserved.</div>
                        <div class="mt-3 mt-md-0">
                            <a href="#" class="text-white btn me-3">Privasi</a>
                            <a href="#" class="text-white btn me-3">Ketentuan</a>
                            <a href="#" class="text-white btn">Cookies</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mini Player -->
    <div class="mini-player">
        <div class="mini-player-progress">
            <div class="mini-player-progress-bar" id="miniPlayerProgressBar"></div>
        </div>
        <div class="mini-player-info">
            <img src="" id="miniPlayerCover" class="rounded me-3" style="width: 56px; height: 56px;"
                alt="Cover">
            <div>
                <div class="fw-bold text-white" id="miniPlayerTitle"></div>
                <div class="text-muted small" id="miniPlayerArtist"></div>
            </div>
        </div>
        <div class="mini-player-controls">
            <button class="btn btn-icon btn-sm btn-dark">
                <i class="ti ti-player-skip-back"></i>
            </button>
            <button class="btn btn-icon btn-primary rounded-circle" id="miniPlayerPlayBtn">
                <i class="ti ti-player-play"></i>
            </button>
            <button class="btn btn-icon btn-sm btn-dark">
                <i class="ti ti-player-skip-forward"></i>
            </button>
        </div>
    </div>

    <!-- Add to Playlist Modal -->
    <div class="modal fade" id="addToPlaylistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Tambah ke Playlist</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Lagu</label>
                        <div class="d-flex align-items-center">
                            <img src="" id="playlistSongCover" class="rounded me-3"
                                style="width: 48px; height: 48px;" alt="">
                            <div>
                                <div class="fw-bold" id="playlistSongTitle"></div>
                                <div class="text-muted small" id="playlistSongArtist"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Playlist</label>
                        <div class="playlist-list">
                            @auth
                                <div class="list-group list-group-flush">
                                    <label
                                        class="list-group-item bg-dark text-white border-secondary d-flex align-items-center">
                                        <input type="radio" name="playlist" value="liked"
                                            class="form-check-input me-3">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <span
                                                class="rounded bg-danger d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                <i class="ti ti-heart"></i>
                                            </span>
                                            <div>
                                                <div>Lagu yang Disukai</div>
                                                <div class="text-muted small">{{ rand(10, 100) }} lagu</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label
                                        class="list-group-item bg-dark text-white border-secondary d-flex align-items-center">
                                        <input type="radio" name="playlist" value="favorites"
                                            class="form-check-input me-3">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <span
                                                class="rounded bg-primary d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                <i class="ti ti-star"></i>
                                            </span>
                                            <div>
                                                <div>Favorit Saya</div>
                                                <div class="text-muted small">{{ rand(5, 50) }} lagu</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label
                                        class="list-group-item bg-dark text-white border-secondary d-flex align-items-center">
                                        <input type="radio" name="playlist" value="workout"
                                            class="form-check-input me-3">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <span
                                                class="rounded bg-success d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                <i class="ti ti-playlist"></i>
                                            </span>
                                            <div>
                                                <div>Workout Mix</div>
                                                <div class="text-muted small">{{ rand(10, 30) }} lagu</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @else
                                <div class="alert alert-dark">
                                    <div class="d-flex">
                                        <div>
                                            <i class="ti ti-login me-2"></i> Silakan <a href="{{ route('login') }}"
                                                class="alert-link">login</a> untuk menambahkan ke playlist
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Buat Playlist Baru</label>
                        <div class="input-group">
                            <input type="text" class="form-control bg-dark text-white border-secondary"
                                placeholder="Nama playlist">
                            <button class="btn btn-primary" type="button">Buat</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        Tambahkan ke Playlist
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle for mobile
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle && sidebarToggle.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });

            // SweetAlert notifications
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    background: '#2a2a2a',
                    color: '#fff'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    showConfirmButton: true,
                    confirmButtonColor: '#e53935',
                    background: '#2a2a2a',
                    color: '#fff'
                });
            @endif

            // Mini Player Functionality
            const miniPlayer = document.querySelector('.mini-player');
            const miniPlayerTitle = document.getElementById('miniPlayerTitle');
            const miniPlayerArtist = document.getElementById('miniPlayerArtist');
            const miniPlayerCover = document.getElementById('miniPlayerCover');
            const miniPlayerPlayBtn = document.getElementById('miniPlayerPlayBtn');
            const miniPlayerProgressBar = document.getElementById('miniPlayerProgressBar');

            // Get all play buttons
            const playButtons = document.querySelectorAll('.play-song-btn');

            // Add click event to all play buttons
            playButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Only prevent default if not navigating to login or play-song route
                    if (!this.hasAttribute('onclick')) {
                        e.preventDefault();

                        // Get song data from data attributes
                        const songTitle = this.getAttribute('data-song-title');
                        const artistName = this.getAttribute('data-artist-name');
                        const coverImage = this.getAttribute('data-cover-image');

                        // Update mini player
                        miniPlayerTitle.textContent = songTitle;
                        miniPlayerArtist.textContent = artistName;
                        miniPlayerCover.src = coverImage;

                        // Show mini player
                        miniPlayer.classList.add('mini-player-visible');

                        // Start progress animation
                        startProgressAnimation();
                    }
                });
            });

            // Toggle play/pause
            let isPlaying = false;
            miniPlayerPlayBtn.addEventListener('click', function() {
                if (isPlaying) {
                    this.innerHTML = '<i class="ti ti-player-play"></i>';
                    isPlaying = false;
                    pauseProgressAnimation();
                } else {
                    this.innerHTML = '<i class="ti ti-player-pause"></i>';
                    isPlaying = true;
                    startProgressAnimation();
                }
            });

            // Progress animation
            let progressInterval;
            let progress = 0;

            function startProgressAnimation() {
                // Reset progress if it's complete
                if (progress >= 100) {
                    progress = 0;
                    miniPlayerProgressBar.style.width = '0%';
                }

                // Clear any existing interval
                clearInterval(progressInterval);

                // Set play button to pause
                miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-pause"></i>';
                isPlaying = true;

                // Start progress animation
                progressInterval = setInterval(() => {
                    progress += 0.1;
                    miniPlayerProgressBar.style.width = progress + '%';

                    if (progress >= 100) {
                        clearInterval(progressInterval);
                        miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-play"></i>';
                        isPlaying = false;
                    }
                }, 30); // Approximately 5 minutes for full song
            }

            function pauseProgressAnimation() {
                clearInterval(progressInterval);
            }

            // Add to Playlist Modal
            const addToPlaylistModal = document.getElementById('addToPlaylistModal');
            if (addToPlaylistModal) {
                addToPlaylistModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const songTitle = button.getAttribute('data-song-title');
                    const artistName = button.getAttribute('data-artist-name');
                    const coverImage = button.getAttribute('data-cover-image');

                    const playlistSongTitle = document.getElementById('playlistSongTitle');
                    const playlistSongArtist = document.getElementById('playlistSongArtist');
                    const playlistSongCover = document.getElementById('playlistSongCover');

                    playlistSongTitle.textContent = songTitle;
                    playlistSongArtist.textContent = artistName;
                    playlistSongCover.src = coverImage;
                });
            }
        });
    </script>
</body>

</html>
