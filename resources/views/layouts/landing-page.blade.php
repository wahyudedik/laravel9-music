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

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --tblr-primary: #e53935; 
            --tblr-primary-rgb: 229, 57, 53;
        }
        .btn-primary {
            background-color: var(--tblr-primary);
            border-color: var(--tblr-primary);
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }
        .btn-outline-primary {
            color: var(--tblr-primary);
            border-color: var(--tblr-primary);
        }
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background-color: var(--tblr-primary);
            border-color: var(--tblr-primary);
        }
        .text-primary {
            color: var(--tblr-primary) !important;
        }
        .bg-primary {
            background-color: var(--tblr-primary) !important;
        }
        .navbar-brand-image {
            height: 2rem;
            width: auto;
        }
        .btn-danger {
            background-color: var(--tblr-primary);
            border-color: var(--tblr-primary);
        }
        .btn-danger:hover {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }
        .page-item.active .page-link {
            background-color: var(--tblr-primary);
            border-color: var(--tblr-primary);
        }
        .nav-link.active {
            color: var(--tblr-primary) !important;
        }
    </style>
</head>

<body>
    <div class="page">
        <!-- Combined Navbar -->
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/') }}" class="d-flex align-items-center">
                        <img src="{{ asset('img/favicon.png') }}" width="32" height="32" alt="Logo"
                            class="navbar-brand-image me-2">
                        <span class="font-weight-bold">Playlist Music</span>
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    @auth
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                aria-label="Open user menu">
                                <span class="avatar avatar-sm bg-primary-lt">{{ substr(Auth::user()->name, 0, 2) }}</span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="mt-1 small text-muted">{{ Auth::user()->getRoleNames()->first() }}</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                @if (Auth::user()->hasRole(['Super Admin', 'Admin']))
                                    <a href="{{ url('admin/dashboard') }}" class="dropdown-item">Admin Dashboard</a>
                                @endif
                                @if (Auth::user()->hasRole(['User', 'Cover Creator', 'Artist', 'Composer']))
                                    <a href="{{ url('user/dashboard') }}" class="dropdown-item">User Dashboard</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                @php
                                    $user = Auth::user();
                                    $userRole = $user->getRoleNames()->first();
                                @endphp
                                <form action="{{ url('logout/' . $userRole) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="d-flex">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                                <i class="ti ti-login me-1"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="ti ti-user-plus me-1"></i> Register
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-home"></i>
                                    </span>
                                    <span class="nav-link-title">Beranda</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('popular-songs') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('popular-songs') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-music"></i>
                                    </span>
                                    <span class="nav-link-title">Lagu Populer</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('artists') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('artists') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-microphone"></i>
                                    </span>
                                    <span class="nav-link-title">Artis</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('covers') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('covers') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-disc"></i>
                                    </span>
                                    <span class="nav-link-title">Cover</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('composers') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('composers') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-note"></i>
                                    </span>
                                    <span class="nav-link-title">Pencipta</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="page-wrapper">
            <!-- Content -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="#" class="link-secondary">Tentang</a>
                                </li>
                                <li class="list-inline-item"><a href="#" class="link-secondary">Dukungan</a>
                                </li>
                                <li class="list-inline-item"><a href="#" class="link-secondary">Privasi</a>
                                </li>
                                <li class="list-inline-item"><a href="#" class="link-secondary">Ketentuan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">
                                        <i class="ti ti-brand-instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">
                                        <i class="ti ti-brand-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">
                                        <i class="ti ti-brand-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">
                                        <i class="ti ti-brand-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <div class="d-flex">
                                <i class="ti ti-copyright me-1"></i> 2025 Playlist Music Indonesia
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Tabler Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <!-- SweetAlert2 JS - Latest Version -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    showConfirmButton: true,
                    confirmButtonColor: '#e53935'
                });
            @endif
        });
    </script>
</body>

</html>
