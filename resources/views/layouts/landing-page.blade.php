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
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #e51e2f;
            --primary-dark: #c41a29;
            --primary-light: #ff3a4b;
            --dark-bg: #121212;
            --card-bg: #181818;
            --text-color: #ffffff;
            --text-muted: #b3b3b3;
            --hover-bg: #282828;
            --sidebar-bg: #000000;
            --topbar-bg: rgba(0, 0, 0, 0.7);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-color);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Layout */
        .main-container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 240px;
            background-color: var(--sidebar-bg);
            padding: 24px 12px;
            overflow-y: auto;
            flex-shrink: 0;
        }

        .content-area {
            flex-grow: 1;
            overflow-y: auto;
            background: linear-gradient(to bottom, #3a1214, var(--dark-bg) 400px);
        }

        .topbar {
            height: 64px;
            background-color: var(--topbar-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* Navbar */
        .navbar {
            background-color: transparent !important;
            padding: 16px 0;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color) !important;
        }

        .logo-container {
            padding: 0 12px 24px 12px;
        }

        /* Buttons */
        .btn {
            border-radius: 500px;
            padding: 8px 32px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-size: 0.8rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: scale(1.04);
        }

        .btn-outline-light {
            color: var(--text-color);
            border-color: var(--text-color);
        }

        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-color);
            transform: scale(1.04);
        }

        /* Hero Section */
        .hero-section {
            padding: 120px 0;
            text-align: center;
        }

        .hero-title {
            font-size: 60px;
            font-weight: 900;
            margin-bottom: 24px;
        }

        .hero-subtitle {
            font-size: 24px;
            margin-bottom: 32px;
            color: var(--text-muted);
        }

        /* Cards */
        .card {
            background-color: var(--card-bg);
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            overflow: hidden;
            position: relative;
        }

        .card:hover {
            background-color: var(--hover-bg);
            transform: translateY(-5px);
        }

        .card-img-top {
            border-radius: 8px 8px 0 0;
        }

        .card-body {
            padding: 16px;
        }

        .card-title {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-text {
            color: var(--text-muted);
            font-size: 14px;
        }

        .play-button {
            position: absolute;
            bottom: 16px;
            right: 16px;
            background-color: var(--primary-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .card:hover .play-button {
            opacity: 1;
            transform: translateY(0);
        }

        .play-button:hover {
            transform: scale(1.1);
            background-color: var(--primary-light);
        }

        /* Section Titles */
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            padding-left: 16px;
        }

        /* Sidebar Navigation */
        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            color: var(--text-muted);
            font-weight: 600;
            padding: 12px 16px;
            border-radius: 4px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--text-color);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link i {
            margin-right: 16px;
            font-size: 20px;
        }

        /* Category Cards */
        .category-card {
            height: 180px;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            z-index: 1;
        }

        .category-card h5 {
            position: relative;
            z-index: 2;
            font-weight: 700;
            font-size: 24px;
        }

        /* Footer */
        footer {
            background-color: var(--dark-bg);
            padding: 60px 0 20px;
            color: var(--text-muted);
        }

        .footer-links {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .footer-links h5 {
            color: var(--text-color);
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: var(--text-color);
        }

        .social-links a {
            color: var(--text-color);
            margin-right: 15px;
            font-size: 18px;
        }

        .copyright {
            border-top: 1px solid #333;
            padding-top: 20px;
            font-size: 12px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }

            .sidebar .nav-link span {
                display: none;
            }

            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 24px;
            }

            .logo-text {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                padding: 12px;
            }

            .content-area {
                height: calc(100vh - 60px);
            }

            .hero-title {
                font-size: 40px;
            }

            .hero-subtitle {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar d-none d-md-block">
            <div class="logo-container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('img/favicon.png') }}" alt="Logo" width="40" height="40"
                        class="me-2">
                    <span class="logo-text">Playlist Music</span>
                </a>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-search"></i>
                        <span>Cari</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-book"></i>
                        <span>Koleksi Kamu</span>
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="#">
                        <i class="fas fa-plus-square"></i>
                        <span>Buat Playlist</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-heart"></i>
                        <span>Lagu yang Disukai</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content-area">
            <!-- Top Navigation Bar -->
            <div class="topbar">
                <div class="d-flex d-md-none">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('img/favicon.png') }}" alt="Logo" width="30" height="30">
                    </a>
                </div>
                <div class="ms-auto d-flex align-items-center">
                    @auth
                        @if (Auth::user()->hasRole(['Super Admin', 'Admin']))
                            <a href="{{ url('adminmusic/dashboard') }}" class="btn btn-outline-light me-2">Admin
                                Dashboard</a>
                        @endif
                        @if (Auth::user()->hasRole(['User', 'Cover Creator', 'Artist', 'Composer']))
                            <a href="{{ url('user/dashboard') }}" class="btn btn-outline-light me-2">User Dashboard</a>
                        @endif
                        @php
                            $user = Auth::user();
                            $userRole = $user->getRoleNames()->first();
                        @endphp
                        <form action="{{ url('logout/' . $userRole) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-3">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endauth
                </div>
            </div>

            <!-- Content -->
            <div class="container py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Flash messages with SweetAlert
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    showConfirmButton: true
                });
            @endif
        });
    </script>
</body>

</html>
