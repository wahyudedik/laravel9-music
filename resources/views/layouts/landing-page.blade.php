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

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS - Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            "50": "#fef2f2",
                            "100": "#fee2e2",
                            "200": "#fecaca",
                            "300": "#fca5a5",
                            "400": "#f87171",
                            "500": "#ef4444",
                            "600": "#dc2626",
                            "700": "#b91c1c",
                            "800": "#991b1b",
                            "900": "#7f1d1d",
                            "950": "#450a0a"
                        },
                        secondary: {
                            "50": "#f9fafb",
                            "100": "#f3f4f6",
                            "200": "#e5e7eb",
                            "300": "#d1d5db",
                            "400": "#9ca3af",
                            "500": "#6b7280",
                            "600": "#4b5563",
                            "700": "#374151",
                            "800": "#1f2937",
                            "900": "#111827",
                            "950": "#030712"
                        },
                        spotify: {
                            dark: "#121212",
                            darker: "#000000",
                            card: "#181818",
                            highlight: "#1DB954",
                            text: "#FFFFFF",
                            muted: "#B3B3B3",
                            border: "#2A2A2A"
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --primary-color: #1DB954;
            --primary-dark: #1AA34A;
            --primary-light: #1ED760;
            --bg-color: #121212;
            --card-bg: #181818;
            --sidebar-bg: #000000;
            --text-color: #ffffff;
            --text-muted: #B3B3B3;
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
        .btn-spotify {
            background-color: var(--primary-color);
            color: white;
            border: none;
            transition: all 0.2s;
        }

        .btn-spotify:hover {
            background-color: var(--primary-light);
            transform: scale(1.05);
        }

        .btn-outline-spotify {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-outline-spotify:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Card Styles */
        .music-card {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .music-card:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .music-card-img {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .music-card:hover .music-card-img {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
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

        /* Animation Classes */
        .btn-pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(29, 185, 84, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(29, 185, 84, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(29, 185, 84, 0);
            }
        }

        .badge-animated {
            animation: badgePop 0.5s ease-out;
        }

        @keyframes badgePop {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Hover effects */
        .hover-shadow:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .transition-transform {
            transition: transform 0.3s ease;
        }
    </style>

    @yield('styles')
</head>

<body class="bg-spotify-dark text-white">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <a href="{{ url('/') }}" class="sidebar-logo">
                <img src="{{ asset('img/favicon.png') }}" width="32" height="32" alt="Logo" class="me-2">
                <span class="font-bold">Playlist Music</span>
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
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center text-white mr-3">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <div>
                            <div class="text-white">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-400">{{ Auth::user()->getRoleNames()->first() }}</div>
                        </div>
                    </div>
                    <div>
                        @php
                            $user = Auth::user();
                            $userRole = $user->getRoleNames()->first();
                        @endphp
                        <form action="{{ url('logout/' . $userRole) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-700">
                                <i class="ti ti-logout mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="space-y-2">
                        <a href="{{ route('login') }}"
                            class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-700">
                            <i class="ti ti-login mr-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-800">
                            <i class="ti ti-user-plus mr-2"></i> Register
                        </a>
                    </div>
                @endauth
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Mobile Navbar for Sidebar Toggle -->
            <div class="lg:hidden mb-4">
                <button
                    class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5"
                    id="sidebarToggle">
                    <i class="ti ti-menu-2"></i>
                </button>
            </div>

            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            <footer class="mt-10 pt-8 pb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div data-aos="fade-up" data-aos-delay="100">
                        <h5 class="text-xl font-bold text-white mb-4">Playlist Music</h5>
                        <p class="text-gray-300 mb-4">Platform musik Indonesia untuk mendengarkan, membuat cover, dan
                            berbagi karya musik.</p>
                        <div class="flex gap-3 mt-4">
                            <a href="#" class="text-white p-2 bg-gray-800 rounded-full hover:bg-gray-700">
                                <i class="ti ti-brand-instagram"></i>
                            </a>
                            <a href="#" class="text-white p-2 bg-gray-800 rounded-full hover:bg-gray-700">
                                <i class="ti ti-brand-twitter"></i>
                            </a>
                            <a href="#" class="text-white p-2 bg-gray-800 rounded-full hover:bg-gray-700">
                                <i class="ti ti-brand-facebook"></i>
                            </a>
                            <a href="#" class="text-white p-2 bg-gray-800 rounded-full hover:bg-gray-700">
                                <i class="ti ti-brand-youtube"></i>
                            </a>
                        </div>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="200">
                        <h6 class="text-lg font-semibold text-white mb-4">Perusahaan</h6>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white">Tentang</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Karir</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Blog</a></li>
                        </ul>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="300">
                        <h6 class="text-lg font-semibold text-white mb-4">Komunitas</h6>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white">Artis</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Pengembang</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Investor</a></li>
                        </ul>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="400">
                        <h6 class="text-lg font-semibold text-white mb-4">Tautan Berguna</h6>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white">Dukungan</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Aplikasi Mobile</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Privasi</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white">Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-6 text-gray-300">
                    <div class="flex flex-col md:flex-row justify-between">
                        <div>© 2025 Playlist Music Indonesia. All rights reserved.</div>
                        <div class="mt-4 md:mt-0 flex gap-4">
                            <a href="#" class="text-gray-300 hover:text-white">Privasi</a>
                            <a href="#" class="text-gray-300 hover:text-white">Ketentuan</a>
                            <a href="#" class="text-gray-300 hover:text-white">Cookies</a>
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
            <img src="" id="miniPlayerCover" class="rounded mr-3" style="width: 56px; height: 56px;"
                alt="Cover">
            <div>
                <div class="font-bold text-white" id="miniPlayerTitle"></div>
                <div class="text-gray-400 text-sm" id="miniPlayerArtist"></div>
            </div>
        </div>
        <div class="mini-player-controls">
            <button class="p-2 text-white bg-gray-800 rounded-full hover:bg-gray-700" id="miniPrevBtn">
                <i class="ti ti-player-skip-back"></i>
            </button>
            <button class="p-3 text-white bg-primary-600 rounded-full hover:bg-primary-700" id="miniPlayerPlayBtn">
                <i class="ti ti-player-play"></i>
            </button>
            <button class="p-2 text-white bg-gray-800 rounded-full hover:bg-gray-700" id="miniNextBtn">
                <i class="ti ti-player-skip-forward"></i>
            </button>
            <button class="p-2 text-white bg-gray-800 rounded-full hover:bg-gray-700 ml-2" id="miniPlayerExpandBtn"
                title="Expand Player">
                <i class="ti ti-arrows-maximize"></i>
            </button>
            <button class="p-2 text-white bg-gray-800 rounded-full hover:bg-gray-700 ml-2" id="miniPlayerCloseBtn"
                title="Close Player">
                <i class="ti ti-x"></i>
            </button>
        </div>
    </div>

    <!-- Add to Playlist Modal -->
    <div id="addToPlaylistModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-gray-900 rounded-lg shadow">
                <div class="flex items-center justify-between p-4 border-b border-gray-700">
                    <h3 class="text-xl font-semibold text-white">
                        Tambah ke Playlist
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="addToPlaylistModal">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-white">Lagu</label>
                        <div class="flex items-center">
                            <img src="" id="playlistSongCover" class="rounded mr-3"
                                style="width: 48px; height: 48px;" alt="">
                            <div>
                                <div class="font-bold" id="playlistSongTitle"></div>
                                <div class="text-gray-400 text-sm" id="playlistSongArtist"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-white">Pilih Playlist</label>
                        <div class="playlist-list">
                            @auth
                                <div class="space-y-2">
                                    <label
                                        class="flex items-center p-3 bg-gray-800 rounded-lg cursor-pointer hover:bg-gray-700">
                                        <input type="radio" name="playlist" value="liked"
                                            class="w-4 h-4 mr-3 text-primary-600 bg-gray-700 border-gray-600 focus:ring-primary-600 focus:ring-2">
                                        <div class="flex items-center flex-grow">
                                            <span
                                                class="flex items-center justify-center w-10 h-10 mr-3 bg-red-600 rounded-md">
                                                <i class="ti ti-heart"></i>
                                            </span>
                                            <div>
                                                <div class="text-white">Lagu yang Disukai</div>
                                                <div class="text-gray-400 text-sm">{{ rand(10, 100) }} lagu</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center p-3 bg-gray-800 rounded-lg cursor-pointer hover:bg-gray-700">
                                        <input type="radio" name="playlist" value="favorites"
                                            class="w-4 h-4 mr-3 text-primary-600 bg-gray-700 border-gray-600 focus:ring-primary-600 focus:ring-2">
                                        <div class="flex items-center flex-grow">
                                            <span
                                                class="flex items-center justify-center w-10 h-10 mr-3 bg-primary-600 rounded-md">
                                                <i class="ti ti-star"></i>
                                            </span>
                                            <div>
                                                <div class="text-white">Favorit Saya</div>
                                                <div class="text-gray-400 text-sm">{{ rand(5, 50) }} lagu</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center p-3 bg-gray-800 rounded-lg cursor-pointer hover:bg-gray-700">
                                        <input type="radio" name="playlist" value="workout"
                                            class="w-4 h-4 mr-3 text-primary-600 bg-gray-700 border-gray-600 focus:ring-primary-600 focus:ring-2">
                                        <div class="flex items-center flex-grow">
                                            <span
                                                class="flex items-center justify-center w-10 h-10 mr-3 bg-green-600 rounded-md">
                                                <i class="ti ti-playlist"></i>
                                            </span>
                                            <div>
                                                <div class="text-white">Workout Mix</div>
                                                <div class="text-gray-400 text-sm">{{ rand(10, 30) }} lagu</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @else
                                <div class="p-4 text-sm text-blue-400 rounded-lg bg-gray-800">
                                    <div class="flex">
                                        <i class="ti ti-login mr-2"></i> Silakan <a href="{{ route('login') }}"
                                            class="font-medium underline">login</a> untuk menambahkan ke playlist
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-white">Buat Playlist Baru</label>
                        <div class="flex">
                            <input type="text"
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-l-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                placeholder="Nama playlist">
                            <button type="button"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-r-lg hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-800">
                                Buat
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center p-4 border-t border-gray-700">
                    <button type="button"
                        class="text-gray-300 bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-700 rounded-lg border border-gray-600 text-sm font-medium px-5 py-2.5 hover:text-white focus:z-10 mr-2"
                        data-modal-hide="addToPlaylistModal">
                        Batal
                    </button>
                    <button type="button"
                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5"
                        data-modal-hide="addToPlaylistModal">
                        Tambahkan ke Playlist
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <!-- AOS - Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

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
                    confirmButtonColor: '#1DB954',
                    background: '#2a2a2a',
                    color: '#fff'
                });
            @endif

            // Mini Player Functionality - Enhanced
            const miniPlayer = document.querySelector('.mini-player');
            const miniPlayerTitle = document.getElementById('miniPlayerTitle');
            const miniPlayerArtist = document.getElementById('miniPlayerArtist');
            const miniPlayerCover = document.getElementById('miniPlayerCover');
            const miniPlayerPlayBtn = document.getElementById('miniPlayerPlayBtn');
            const miniPlayerProgressBar = document.getElementById('miniPlayerProgressBar');
            const miniPlayerCloseBtn = document.getElementById('miniPlayerCloseBtn');
            const miniPlayerExpandBtn = document.getElementById('miniPlayerExpandBtn');
            const miniPrevBtn = document.getElementById('miniPrevBtn');
            const miniNextBtn = document.getElementById('miniNextBtn');

            // Current song data storage for session persistence
            let currentSongData = {
                title: '',
                artist: '',
                cover: '',
                songId: null,
                isPlaying: false,
                progress: 0,
                currentTime: 0,
                duration: 0
            };

            // Initialize from session storage if available
            const storedSongData = sessionStorage.getItem('currentSongData');
            if (storedSongData) {
                currentSongData = JSON.parse(storedSongData);

                // Update mini player
                miniPlayerTitle.textContent = currentSongData.title;
                miniPlayerArtist.textContent = currentSongData.artist;
                miniPlayerCover.src = currentSongData.cover;

                // Show mini player if there was a song playing
                if (currentSongData.title) {
                    miniPlayer.classList.add('mini-player-visible');

                    // Update play/pause button
                    if (currentSongData.isPlaying) {
                        miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-pause"></i>';
                        startProgressAnimation(currentSongData.progress);
                    } else {
                        miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-play"></i>';
                        miniPlayerProgressBar.style.width = currentSongData.progress + '%';
                    }
                }
            }

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
                        const songId = this.getAttribute('data-song-id');

                        // Update mini player
                        miniPlayerTitle.textContent = songTitle;
                        miniPlayerArtist.textContent = artistName;
                        miniPlayerCover.src = coverImage;

                        // Update current song data
                        currentSongData = {
                            title: songTitle,
                            artist: artistName,
                            cover: coverImage,
                            songId: songId,
                            isPlaying: true,
                            progress: 0,
                            currentTime: 0,
                            duration: 300 // Default duration in seconds
                        };

                        // Store in session storage
                        sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));

                        // Show mini player
                        miniPlayer.classList.add('mini-player-visible');

                        // Start progress animation
                        startProgressAnimation();

                        // Set play button to pause
                        miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-pause"></i>';

                        // Add ripple effect
                        const ripple = document.createElement('div');
                        ripple.classList.add('ripple');
                        this.appendChild(ripple);

                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
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

                    // Update session storage
                    currentSongData.isPlaying = false;
                    sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));
                } else {
                    this.innerHTML = '<i class="ti ti-player-pause"></i>';
                    isPlaying = true;
                    startProgressAnimation();

                    // Update session storage
                    currentSongData.isPlaying = true;
                    sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));
                }

                // Add ripple effect
                const ripple = document.createElement('div');
                ripple.classList.add('ripple');
                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });

            // Close mini player
            if (miniPlayerCloseBtn) {
                miniPlayerCloseBtn.addEventListener('click', function() {
                    // Hide mini player
                    miniPlayer.classList.remove('mini-player-visible');

                    // Stop progress animation
                    pauseProgressAnimation();

                    // Reset progress
                    miniPlayerProgressBar.style.width = '0%';

                    // Clear current song data
                    currentSongData = {
                        title: '',
                        artist: '',
                        cover: '',
                        songId: null,
                        isPlaying: false,
                        progress: 0,
                        currentTime: 0,
                        duration: 0
                    };

                    // Update session storage
                    sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));
                });
            }

            // Expand to full player
            if (miniPlayerExpandBtn) {
                miniPlayerExpandBtn.addEventListener('click', function() {
                    // If we have a song ID, navigate to the play-song page
                    if (currentSongData.songId) {
                        window.location.href = `/play-song/${currentSongData.songId}`;
                    } else {
                        // If no song ID (for demo songs), just show a notification
                        Swal.fire({
                            icon: 'info',
                            title: 'Demo Song',
                            text: 'This is a demo song without a full player view.',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            toast: true,
                            position: 'top-end',
                            background: '#2a2a2a',
                            color: '#fff'
                        });
                    }
                });
            }

            // Progress animation
            let progressInterval;
            let progress = 0;

            function startProgressAnimation(initialProgress = 0) {
                // Reset progress if it's complete or use provided initial progress
                progress = initialProgress || 0;
                if (progress >= 100) {
                    progress = 0;
                }
                miniPlayerProgressBar.style.width = progress + '%';

                // Clear any existing interval
                clearInterval(progressInterval);

                // Set play button to pause
                miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-pause"></i>';
                isPlaying = true;

                // Start progress animation
                progressInterval = setInterval(() => {
                    progress += 0.1;
                    miniPlayerProgressBar.style.width = progress + '%';

                    // Update current song data
                    currentSongData.progress = progress;
                    currentSongData.currentTime = (progress / 100) * currentSongData.duration;
                    sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));

                    if (progress >= 100) {
                        clearInterval(progressInterval);
                        miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-play"></i>';
                        isPlaying = false;

                        // Update current song data
                        currentSongData.isPlaying = false;
                        sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));
                    }
                }, 30); // Approximately 5 minutes for full song
            }

            function pauseProgressAnimation() {
                clearInterval(progressInterval);
            }

            // Add to Playlist Modal
            const addToPlaylistModal = document.getElementById('addToPlaylistModal');
            if (addToPlaylistModal) {
                const modalTriggers = document.querySelectorAll('[data-modal-target="addToPlaylistModal"]');
                modalTriggers.forEach(trigger => {
                    trigger.addEventListener('click', function() {
                        const songTitle = this.getAttribute('data-song-title');
                        const artistName = this.getAttribute('data-artist-name');
                        const coverImage = this.getAttribute('data-cover-image');

                        const playlistSongTitle = document.getElementById('playlistSongTitle');
                        const playlistSongArtist = document.getElementById('playlistSongArtist');
                        const playlistSongCover = document.getElementById('playlistSongCover');

                        playlistSongTitle.textContent = songTitle;
                        playlistSongArtist.textContent = artistName;
                        playlistSongCover.src = coverImage;
                    });
                });
            }

            // Animate badges
            const badges = document.querySelectorAll('.badge');
            badges.forEach((badge, index) => {
                setTimeout(() => {
                    badge.classList.add('badge-animated');
                }, index * 100);
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
