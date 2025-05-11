<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist Music - Discover and Play Music</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Vite Assets -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --color-primary: #e62117;
            --color-primary-hover: #cc1e12;
            --color-bg-dark: #121212;
            --color-bg-card: #1e1e1e;
            --color-bg-hover: #2a2a2a;
            --color-text: #ffffff;
            --color-text-secondary: #aaaaaa;
            --sidebar-width: 250px;
            --sidebar-width-collapsed: 72px;
            --header-height: 64px;
            --player-height: 72px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-bg-dark);
            color: var(--color-text);
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100vh;
        }

        /* Layout Structure */
        .app-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Custom Scrollbar untuk seluruh website */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #121212;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #303030;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #424242;
        }
        
        ::-webkit-scrollbar-corner {
            background: #121212;
        }
        
        /* Firefox scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: #303030 #121212;
        }

        /* Sidebar Styles */
        .music-sidebar {
            width: var(--sidebar-width);
            background-color: rgba(0, 0, 0, 0.6);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 30;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            backdrop-filter: blur(10px);
            transition: width 0.3s ease;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .music-sidebar.collapsed {
            width: var(--sidebar-width-collapsed);
        }

        .music-sidebar.collapsed .sidebar-toggle-btn i {
            transform: rotate(180deg);
        }

        .music-sidebar.collapsed span:not(.w-8),
        .music-sidebar.collapsed .nav-section-title {
            display: none;
        }

        .music-sidebar.collapsed a img.w-8,
        .music-sidebar.collapsed .flex.items-center.gap-3 img {
            display: none;
        }

        .music-sidebar.collapsed .p-5.mt-4.bg-gray-800\/50.rounded-lg.mx-3 {
            display: none;
        }

        .music-sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 12px 0;
        }

        .music-sidebar.collapsed .nav-item i {
            margin-right: 0;
        }

        .sidebar-toggle-btn {
            color: var(--color-text-secondary);
            background: transparent;
            border: none;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.2s;
        }

        .sidebar-toggle-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--color-text);
        }

        .nav-section {
            padding: 0 16px;
            margin-bottom: 8px;
        }

        .nav-section-title {
            color: var(--color-text-secondary);
            font-size: 14px;
            font-weight: 500;
            margin: 8px 0 12px 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--color-text-secondary);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .nav-item i {
            font-size: 20px;
            margin-right: 16px;
            opacity: 0.9;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--color-text);
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--color-text);
        }

        /* Header Styles */
        .music-header {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--header-height);
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            z-index: 20;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            transition: left 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        body.sidebar-collapsed .music-header {
            left: var(--sidebar-width-collapsed);
        }

        .header-left,
        .header-right {
            display: flex;
            align-items: center;
        }

        .mobile-menu-toggle {
            display: none;
            background: transparent;
            border: none;
            color: var(--color-text);
            font-size: 24px;
            cursor: pointer;
            margin-right: 16px;
        }

        .search-container {
            flex: 1;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-form {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input {
            width: 100%;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 20px;
            padding: 0 16px 0 40px;
            color: var(--color-text);
            font-size: 14px;
            transition: background-color 0.2s;
        }

        .search-input:focus {
            background-color: rgba(255, 255, 255, 0.15);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            color: var(--color-text-secondary);
            font-size: 18px;
        }

        .mic-button {
            position: absolute;
            right: 8px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: transparent;
            border: none;
            color: var(--color-text-secondary);
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .mic-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--color-text);
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: transparent;
            border: none;
            color: var(--color-text-secondary);
            margin-left: 8px;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .icon-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--color-text);
        }

        .login-btn {
            padding: 8px 16px;
            background-color: transparent;
            color: var(--color-text);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 18px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .login-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            margin-bottom: var(--player-height);
            height: calc(100vh - var(--header-height) - var(--player-height));
            overflow-y: auto;
            overflow-x: hidden;
            padding: 24px 32px;
            transition: margin-left 0.3s ease;
            background-color: rgba(0, 0, 0, 0.6);
        }

        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-width-collapsed);
        }

        /* Music Cards Styles */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--color-text);
        }

        .section-link {
            color: var(--color-text-secondary);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .section-link:hover {
            color: var(--color-text);
        }

        .music-card {
            background-color: transparent;
            border-radius: 8px;
            overflow: hidden;
            transition: background-color 0.3s;
        }

        .music-card:hover {
            background-color: var(--color-bg-hover);
        }

        .music-card-img {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1/1;
        }

        .music-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .music-card:hover .music-card-img img {
            transform: scale(1.05);
        }

        .card-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .music-card:hover .card-overlay {
            opacity: 1;
        }

        .play-button {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: var(--color-primary);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transform: translateY(10px);
            opacity: 0;
            transition: all 0.3s;
        }

        .play-button i {
            font-size: 24px;
        }

        .music-card:hover .play-button {
            transform: translateY(0);
            opacity: 1;
        }

        .play-button:hover {
            background-color: var(--color-primary-hover);
            transform: scale(1.05);
        }

        .music-card-content {
            padding: 12px;
        }

        .music-card-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
            color: var(--color-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .music-card-subtitle {
            font-size: 13px;
            color: var(--color-text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Player Bar Styles */
        .player-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: var(--player-height);
            background-color: var(--color-bg-card);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            padding: 0 16px;
            z-index: 100;
        }

        .player-progress {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background-color: rgba(255, 255, 255, 0.1);
            cursor: pointer;
        }

        .player-progress-filled {
            height: 100%;
            background-color: var(--color-primary);
            width: 0%;
            transition: width 0.1s linear;
        }

        .player-left {
            display: flex;
            align-items: center;
            width: 30%;
        }

        .player-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 40%;
        }

        .player-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 30%;
        }

        .player-thumbnail {
            width: 48px;
            height: 48px;
            border-radius: 4px;
            overflow: hidden;
            margin-right: 12px;
        }

        .player-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .player-details {
            min-width: 0;
        }

        .player-song-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .player-artist {
            font-size: 12px;
            color: var(--color-text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .player-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
        }

        .player-button {
            background: transparent;
            border: none;
            color: var(--color-text-secondary);
            margin: 0 8px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .player-button:hover {
            color: var(--color-text);
        }

        .player-button.main {
            color: var(--color-text);
            font-size: 32px;
        }

        .player-time {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 85%;
            max-width: 480px;
            font-size: 12px;
            color: var(--color-text-secondary);
        }

        .volume-control {
            display: flex;
            align-items: center;
        }

        .volume-slider {
            width: 80px;
            -webkit-appearance: none;
            height: 4px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.2);
            outline: none;
            margin: 0 8px;
        }

        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--color-text);
            cursor: pointer;
        }

        /* Modal Styles */
        .modal-content {
            background-color: var(--color-bg-card);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Horizontal scrolling containers for mobile */
        .scroll-container {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            /* Firefox */
            padding-bottom: 8px;
            gap: 16px;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Edge */
        }

        /* Fix card size within scroll containers */
        .scroll-container .music-card {
            flex: 0 0 auto;
            width: 150px;
        }

        .scroll-container .chart-card {
            flex: 0 0 auto;
            width: 100%;
        }

        @media (max-width: 640px) {
            .scroll-container .music-card {
                width: 140px;
            }
        }

        /* Category pills at top */
        .category-nav {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            padding: 8px 0;
            gap: 12px;
        }

        .category-nav::-webkit-scrollbar {
            display: none;
        }

        .category-pill {
            flex: 0 0 auto;
            padding: 6px 16px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
            font-size: 14px;
            white-space: nowrap;
            transition: background-color 0.2s;
        }

        .category-pill.active {
            background-color: white;
            color: black;
        }

        .category-pill:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.15);
        }

        /* Mobile Styles */
        @media (max-width: 992px) {
            .music-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .music-sidebar.show {
                transform: translateX(0);
            }

            .music-header {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            body.sidebar-collapsed .music-header,
            body.sidebar-collapsed .main-content {
                left: 0;
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .player-left {
                width: 40%;
            }

            .player-center {
                width: 60%;
            }

            .player-right {
                display: none;
            }

            .main-content {
                padding: 16px;
            }
        }

        @media (max-width: 576px) {
            .player-time {
                display: none;
            }

            .player-left {
                width: 50%;
            }

            .player-center {
                width: 50%;
            }

            .search-container {
                max-width: none;
                width: 100%;
            }

            .music-header {
                padding: 0 16px;
            }
        }

        /* Enhanced scroll container styling */
        .scroll-container {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            gap: 20px;
            padding: 8px 4px 16px 4px;
            margin-left: -4px;
            margin-right: -4px;
        }

        /* Styling for scroll items */
        .scroll-item {
            flex: 0 0 auto;
            width: 180px;
            transition: transform 0.2s;
        }

        .scroll-item:hover {
            transform: translateY(-5px);
        }

        /* Artist and composer specific cards */
        .artist-card, .composer-card {
            width: 160px;
        }

        /* Card hover effects */
        .music-card-item .play-song-btn,
        .cover-card .play-song-btn,
        .new-release-card .play-song-btn {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .music-card-item:hover .play-song-btn,
        .cover-card:hover .play-song-btn,
        .new-release-card:hover .play-song-btn {
            opacity: 1;
        }

        /* Section header styling */
        .section-header {
            position: relative;
        }

        .section-header .section-title {
            position: relative;
            display: inline-block;
        }

        .section-header .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: #e62117;
            border-radius: 3px;
        }

        /* Improved section link styling */
        .section-link {
            font-weight: 500;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.2s ease;
        }

        .section-link:hover {
            color: #e62117;
        }

        /* Improved animations for cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scroll-item {
            animation: fadeInUp 0.5s ease forwards;
            animation-delay: calc(var(--index) * 0.1s);
            opacity: 0;
        }
    </style>

    {{-- <link rel="stylesheet" href="{{asset('build/assets/css/app.css')}}"> --}}
    {{-- <script src="{{asset('build/assets/js/app.js')}}"></script> --}}


    @yield('styles')
</head>

<body>
    <div class="app-container">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Header -->
        @include('layouts.partials.header')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            @yield('content')
        </main>

        <!-- Player Bar -->
        <div class="player-bar">
            <div class="player-progress">
                <div class="player-progress-filled" id="progressBar"></div>
            </div>

            <div class="player-left">
                <div class="player-thumbnail">
                    <img src="https://via.placeholder.com/48" id="playerCover" alt="Music cover">
                </div>
                <div class="player-details">
                    <div class="player-song-title" id="playerTitle">Select a song</div>
                    <div class="player-artist" id="playerArtist">Artist</div>
                </div>
                <button class="player-button ml-3" id="likeButton">
                    <i class="ti ti-heart"></i>
                </button>
            </div>

            <div class="player-center">
                <div class="player-controls">
                    <button class="player-button" id="shuffleButton">
                        <i class="ti ti-arrows-shuffle"></i>
                    </button>
                    <button class="player-button" id="prevButton">
                        <i class="ti ti-player-skip-back"></i>
                    </button>
                    <button class="player-button main" id="playButton">
                        <i class="ti ti-player-play"></i>
                    </button>
                    <button class="player-button" id="nextButton">
                        <i class="ti ti-player-skip-forward"></i>
                    </button>
                    <button class="player-button" id="repeatButton">
                        <i class="ti ti-repeat"></i>
                    </button>
                </div>
                <div class="player-time">
                    <span id="currentTime">0:00</span>
                    <span id="totalTime">0:00</span>
                </div>
            </div>

            <div class="player-right">
                <button class="player-button" id="lyricsButton">
                    <i class="ti ti-message"></i>
                </button>
                <button class="player-button" id="queueButton">
                    <i class="ti ti-playlist"></i>
                </button>
                <div class="volume-control">
                    <button class="player-button" id="muteButton">
                        <i class="ti ti-volume"></i>
                    </button>
                    <input type="range" min="0" max="100" value="80" class="volume-slider"
                        id="volumeSlider">
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const header = document.querySelector('.music-header');
            const body = document.body;

            // Toggle sidebar collapse
            sidebarCollapseBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                body.classList.toggle('sidebar-collapsed');

                // Update icon
                const icon = this.querySelector('i');
                if (sidebar.classList.contains('collapsed')) {
                    icon.classList.remove('ti-chevron-left');
                    icon.classList.add('ti-chevron-right');
                } else {
                    icon.classList.remove('ti-chevron-right');
                    icon.classList.add('ti-chevron-left');
                }

                // Save state in localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });

            // Mobile menu toggle
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                const isClickInsideSidebar = sidebar.contains(e.target);
                const isClickOnToggle = mobileMenuToggle && mobileMenuToggle.contains(e.target);

                if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 992 && sidebar
                    .classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });

            // Load sidebar state from localStorage
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                body.classList.add('sidebar-collapsed');
                const icon = sidebarCollapseBtn.querySelector('i');
                icon.classList.remove('ti-chevron-left');
                icon.classList.add('ti-chevron-right');
            }

            // Notifications
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
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
                    confirmButtonColor: '#e62117',
                    background: '#2a2a2a',
                    color: '#fff'
                });
            @endif

            // Player functionality
            const progressBar = document.getElementById('progressBar');
            const playButton = document.getElementById('playButton');
            const playerTitle = document.getElementById('playerTitle');
            const playerArtist = document.getElementById('playerArtist');
            const playerCover = document.getElementById('playerCover');
            const currentTimeDisplay = document.getElementById('currentTime');
            const totalTimeDisplay = document.getElementById('totalTime');
            const volumeSlider = document.getElementById('volumeSlider');
            const muteButton = document.getElementById('muteButton');
            const likeButton = document.getElementById('likeButton');
            const repeatButton = document.getElementById('repeatButton');
            const shuffleButton = document.getElementById('shuffleButton');

            let progressInterval;
            let progressValue = 0;
            let isPlaying = false;
            let isMuted = false;
            let isShuffled = false;
            let repeatMode = 'none'; // none, all, one

            // Current song data
            let currentSong = {
                title: '',
                artist: '',
                cover: '',
                songId: null,
                isPlaying: false,
                progress: 0,
                currentTime: 0,
                duration: 300, // Default 5 minutes
                volume: 80
            };

            // Format time (seconds to MM:SS)
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const remainingSeconds = Math.floor(seconds % 60);
                return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
            }

            // Start progress animation
            function startProgress(initialProgress = 0) {
                progressValue = initialProgress || 0;
                progressBar.style.width = progressValue + '%';

                // Clear existing interval
                clearInterval(progressInterval);

                // Update play button icon
                playButton.innerHTML = '<i class="ti ti-player-pause"></i>';
                isPlaying = true;

                // Calculate time displays
                currentTimeDisplay.textContent = formatTime((progressValue / 100) * currentSong.duration);
                totalTimeDisplay.textContent = formatTime(currentSong.duration);

                // Start progress animation
                progressInterval = setInterval(() => {
                    progressValue += 0.1;
                    progressBar.style.width = progressValue + '%';

                    // Update time display
                    currentTimeDisplay.textContent = formatTime((progressValue / 100) * currentSong
                        .duration);

                    // Update current song data
                    currentSong.progress = progressValue;
                    currentSong.currentTime = (progressValue / 100) * currentSong.duration;
                    currentSong.isPlaying = true;
                    saveCurrentSong();

                    if (progressValue >= 100) {
                        clearInterval(progressInterval);
                        playButton.innerHTML = '<i class="ti ti-player-play"></i>';
                        isPlaying = false;

                        // Handle repeat modes
                        if (repeatMode === 'one') {
                            // Repeat current song
                            setTimeout(() => startProgress(0), 500);
                        } else if (repeatMode === 'all') {
                            // Play next song or start from beginning
                            // (This would need a playlist implementation)
                            setTimeout(() => startProgress(0), 500);
                        } else {
                            // Update current song data when finished
                            currentSong.isPlaying = false;
                            currentSong.progress = 100;
                            saveCurrentSong();
                        }
                    }
                }, 300); // Approximately 5 minutes for full song
            }

            // Pause progress animation
            function pauseProgress() {
                clearInterval(progressInterval);
                playButton.innerHTML = '<i class="ti ti-player-play"></i>';
                isPlaying = false;

                // Update current song data
                currentSong.isPlaying = false;
                saveCurrentSong();
            }

            // Save current song to sessionStorage
            function saveCurrentSong() {
                sessionStorage.setItem('currentSong', JSON.stringify(currentSong));
            }

            // Load current song from sessionStorage
            function loadCurrentSong() {
                const saved = sessionStorage.getItem('currentSong');
                if (saved) {
                    currentSong = JSON.parse(saved);

                    // Update player UI
                    playerTitle.textContent = currentSong.title || 'Select a song';
                    playerArtist.textContent = currentSong.artist || 'Artist';

                    if (currentSong.cover) {
                        playerCover.src = currentSong.cover;
                    }

                    // Update progress
                    progressBar.style.width = currentSong.progress + '%';
                    currentTimeDisplay.textContent = formatTime(currentSong.currentTime);
                    totalTimeDisplay.textContent = formatTime(currentSong.duration);

                    // Restore play state
                    if (currentSong.isPlaying) {
                        startProgress(currentSong.progress);
                    } else {
                        playButton.innerHTML = '<i class="ti ti-player-play"></i>';
                    }

                    // Restore volume
                    if (currentSong.volume !== undefined) {
                        volumeSlider.value = currentSong.volume;
                    }
                }
            }

            // Initialize player
            loadCurrentSong();

            // Play button click
            playButton.addEventListener('click', function() {
                if (!currentSong.title) return;

                if (isPlaying) {
                    pauseProgress();
                } else {
                    startProgress(currentSong.progress);
                }
            });

            // Volume slider
            volumeSlider.addEventListener('input', function() {
                const volume = this.value;
                currentSong.volume = volume;
                saveCurrentSong();

                // Update mute button icon based on volume
                if (volume == 0) {
                    muteButton.innerHTML = '<i class="ti ti-volume-off"></i>';
                    isMuted = true;
                } else {
                    muteButton.innerHTML = '<i class="ti ti-volume"></i>';
                    isMuted = false;
                }
            });

            // Mute button
            muteButton.addEventListener('click', function() {
                if (isMuted) {
                    volumeSlider.value = currentSong.volume || 80;
                    this.innerHTML = '<i class="ti ti-volume"></i>';
                    isMuted = false;
                } else {
                    currentSong.volume = volumeSlider.value;
                    volumeSlider.value = 0;
                    this.innerHTML = '<i class="ti ti-volume-off"></i>';
                    isMuted = true;
                }
                saveCurrentSong();
            });

            // Repeat button
            repeatButton.addEventListener('click', function() {
                if (repeatMode === 'none') {
                    repeatMode = 'all';
                    this.innerHTML = '<i class="ti ti-repeat"></i>';
                    this.classList.add('text-red-500');
                } else if (repeatMode === 'all') {
                    repeatMode = 'one';
                    this.innerHTML = '<i class="ti ti-repeat-once"></i>';
                    this.classList.add('text-red-500');
                } else {
                    repeatMode = 'none';
                    this.innerHTML = '<i class="ti ti-repeat"></i>';
                    this.classList.remove('text-red-500');
                }
            });

            // Shuffle button
            shuffleButton.addEventListener('click', function() {
                isShuffled = !isShuffled;
                if (isShuffled) {
                    this.classList.add('text-red-500');
                } else {
                    this.classList.remove('text-red-500');
                }
            });

            // Like button
            likeButton.addEventListener('click', function() {
                this.classList.toggle('text-red-500');
                if (this.classList.contains('text-red-500')) {
                    // Liked
                    this.innerHTML = '<i class="ti ti-heart-filled"></i>';
                    // Here you would send an AJAX request to save the liked song
                } else {
                    // Unliked
                    this.innerHTML = '<i class="ti ti-heart"></i>';
                    // Here you would send an AJAX request to remove the liked song
                }
            });

            // Progress bar click (seek)
            const playerProgressBar = document.querySelector('.player-progress');
            playerProgressBar.addEventListener('click', function(e) {
                if (!currentSong.title) return;

                const rect = this.getBoundingClientRect();
                const clickPosition = e.clientX - rect.left;
                const progressPercent = (clickPosition / rect.width) * 100;

                // Update progress
                progressValue = progressPercent;
                progressBar.style.width = progressValue + '%';

                // Update time display
                currentTimeDisplay.textContent = formatTime((progressValue / 100) * currentSong.duration);

                // Update current song data
                currentSong.progress = progressValue;
                currentSong.currentTime = (progressValue / 100) * currentSong.duration;
                saveCurrentSong();

                // If playing, restart animation from new position
                if (isPlaying) {
                    startProgress(progressValue);
                }
            });

            // Play song click handlers
            const playSongButtons = document.querySelectorAll('.play-song-btn');
            playSongButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Only prevent default if not a login link
                    if (!this.hasAttribute('data-login-required')) {
                        e.preventDefault();

                        // Get song data from attributes
                        const title = this.getAttribute('data-title');
                        const artist = this.getAttribute('data-artist');
                        const cover = this.getAttribute('data-cover');
                        const songId = this.getAttribute('data-id');
                        const duration = parseInt(this.getAttribute('data-duration') || 300);

                        // Update player UI
                        playerTitle.textContent = title;
                        playerArtist.textContent = artist;
                        playerCover.src = cover;

                        // Update current song data
                        currentSong = {
                            title: title,
                            artist: artist,
                            cover: cover,
                            songId: songId,
                            duration: duration,
                            isPlaying: true,
                            progress: 0,
                            currentTime: 0,
                            volume: volumeSlider.value
                        };

                        // Start playing
                        startProgress(0);

                        // Save to session storage
                        saveCurrentSong();
                    }
                });
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
