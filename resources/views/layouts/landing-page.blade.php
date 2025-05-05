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
    <!-- Compiled CSS from Mix -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS - Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Vite Assets -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{asset('build/assets/css/app.css')}}">
    <script src="{{asset('build/assets/js/app.js')}}"></script>

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
                            <a class="nav-link {{ Request::is('favorite-songs') ? 'active' : '' }}"
                                href="{{ route('favorite-songs') }}">
                                <span class="nav-link-icon"><i class="ti ti-heart"></i></span>
                                <span>Lagu Favorit</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('playlists') ? 'active' : '' }}"
                                href="{{ route('playlists') }}">
                                <span class="nav-link-icon"><i class="ti ti-playlist"></i></span>
                                <span>Playlist Saya</span>
                            </a>
                        </li>
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
    <!-- Compiled JS from Mix -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

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

            // Variables for player functionality - DECLARE ALL VARIABLES FIRST
            let progressInterval;
            let progressValue = 0;
            let isPlaying = false;

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

            // Progress animation function - DEFINE FUNCTIONS BEFORE USING THEM
            function startProgressAnimation(initialProgress = 0) {
                // Use the global progressValue
                progressValue = initialProgress || 0;
                if (progressValue >= 100) {
                    progressValue = 0;
                }
                miniPlayerProgressBar.style.width = progressValue + '%';

                // Clear any existing interval
                clearInterval(progressInterval);

                // Set play button to pause
                miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-pause"></i>';
                isPlaying = true;

                // Start progress animation
                progressInterval = setInterval(() => {
                    progressValue += 0.1;
                    miniPlayerProgressBar.style.width = progressValue + '%';

                    // Update current song data
                    currentSongData.progress = progressValue;
                    currentSongData.currentTime = (progressValue / 100) * currentSongData.duration;
                    sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));

                    if (progressValue >= 100) {
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
