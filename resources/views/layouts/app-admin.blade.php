<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music App Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <!-- Tabler Core CSS & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --tblr-primary: #e53935;
            --tblr-primary-rgb: 229, 57, 53;
            --primary-color: #e53935;
            --secondary-color: #f8f9fa;
            --text-color: #212529;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .border-primary {
            border-color: var(--primary-color) !important;
        }

        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 10px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 500;
        }

        .avatar-list-stacked .avatar {
            box-shadow: 0 0 0 2px #fff;
        }

        .bg-primary-lt {
            background-color: rgba(var(--tblr-primary-rgb), 0.1) !important;
            color: var(--primary-color) !important;
        }

        .page-header {
            padding: 2rem 0;
            background: linear-gradient(135deg, #f5f7fb 0%, #f8f9fa 100%);
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
    @stack('styles')
</head>

<body class="theme-light">
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md navbar-light d-print-none sticky-top">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/') }}" class="d-flex align-items-center">
                        <img src="{{ asset('img/favicon.png') }}" class="me-2" alt="Music Icon"
                            style="width: 20px; height: 20px;">
                        <span>Playlist Music</span>
                    </a>
                </h1>

                <!-- Search -->
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <form action="{{ route('admin.search') }}" method="GET">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                </div>

                <div class="navbar-nav flex-row order-md-last">
                    <!-- Home -->
                    <div class="nav-item d-none d-md-flex me-3">
                        <a href="{{ url('/') }}" class="nav-link px-0" data-bs-toggle="tooltip" title="Home">
                            <i class="ti ti-home"></i>
                        </a>
                    </div>

                    <!-- Live Chat -->
                    <div class="nav-item d-none d-md-flex me-3">
                        <a href="#" class="nav-link px-0" data-bs-toggle="tooltip" title="Live Chat">
                            <i class="ti ti-messages"></i>
                            <span class="badge bg-red"></span>
                        </a>
                    </div>

                    <!-- Notifications -->
                    <div class="nav-item dropdown d-none d-md-flex me-3">
                        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                            aria-label="Show notifications">
                            <i class="ti ti-bell"></i>
                            <span class="badge bg-red"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h3 class="card-title">Notifications</h3>
                                    <a href="{{ route('admin.notifications') }}" class="btn btn-link">View All</a>
                                </div>
                                <div class="list-group list-group-flush list-group-hoverable">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="status-dot status-dot-animated bg-red d-block"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-body d-block">New verification request</a>
                                                <div class="d-block text-muted text-truncate mt-n1">
                                                    A user has requested account verification
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="list-group-item-actions">
                                                    <i class="ti ti-chevron-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User menu -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            <span class="avatar avatar-sm"
                                style="background-image: url(https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=e53935&color=fff)"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ auth()->user()->name }}</div>
                                <div class="mt-1 small text-muted">{{ ucfirst(auth()->user()->role) }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                <i class="ti ti-user me-2"></i>Profile
                            </a>
                            <a href="{{ route('admin.settings') }}" class="dropdown-item">
                                <i class="ti ti-settings me-2"></i>Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout', ['role' => auth()->user()->getRoleNames()->first()]) }}"
                                method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="ti ti-logout me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Navbar menu -->
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-dashboard"></i>
                                    </span>
                                    <span class="nav-link-title">Dashboard</span>
                                </a>
                            </li>
                            <li
                                class="nav-item dropdown {{ request()->is('admin/users*', 'admin/roles*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-user" data-bs-toggle="dropdown"
                                    data-bs-auto-close="false" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-users"></i>
                                    </span>
                                    <span class="nav-link-title">Users</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block me-1">
                                            <i class="ti ti-user-plus"></i>
                                        </span>
                                        <span>User Management</span>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block me-1">
                                            <i class="ti ti-shield-lock"></i>
                                        </span>
                                        <span>Roles & Permissions</span>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item {{ request()->is('admin/verifications*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.verifications.index') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-check"></i>
                                    </span>
                                    <span class="nav-link-title">Verifications</span>
                                    {{-- <span class="badge bg-red">3</span> --}}
                                </a>
                            </li>
                            <li class="nav-item dropdown {{ request()->is('admin/claims*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-ticket"></i>
                                    </span>
                                    <span class="nav-link-title">Claims</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.claims.create') }}">
                                        <i class="ti ti-plus me-2"></i>Create Claim
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.claims.index') }}">
                                        <i class="ti ti-list me-2"></i>Manage Claims
                                    </a>
                                </div>
                            </li>
                            <li
                                class="nav-item dropdown {{ request()->is('admin/songs*', 'admin/albums*', 'admin/genres*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-songs" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-music"></i>
                                    </span>
                                    <span class="nav-link-title">Music</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.songs.index') }}">
                                        <i class="ti ti-list me-2"></i>All Songs
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.songs.create') }}">
                                        <i class="ti ti-plus me-2"></i>Add New Song
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.albums.index') }}">
                                        <i class="ti ti-album me-2"></i>Albums
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.genres.index') }}">
                                        <i class="ti ti-category me-2"></i>Genres
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item {{ request()->is('admin/user-profiles*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.user-profiles.index') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-user-circle"></i>
                                    </span>
                                    <span class="nav-link-title">User Profiles</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('admin/withdrawals*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.withdrawals.index') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-cash"></i>
                                    </span>
                                    <span class="nav-link-title">Withdrawals</span>
                                </a>
                            </li>

                            <li
                                class="nav-item dropdown {{ request()->is('admin/song-list*', 'admin/cover-list*', 'admin/published-songs*', 'admin/draft-songs*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-listings" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-list"></i>
                                    </span>
                                    <span class="nav-link-title">Listings</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.listings.songs') }}">
                                        <i class="ti ti-music me-2"></i>All Songs
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.listings.covers') }}">
                                        <i class="ti ti-microphone me-2"></i>Cover Songs
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.listings.published') }}">
                                        <i class="ti ti-check me-2"></i>Published Songs
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.listings.drafts') }}">
                                        <i class="ti ti-file me-2"></i>Draft Songs
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown {{ request()->is('admin/reports*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#navbar-reports" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-report"></i>
                                    </span>
                                    <span class="nav-link-title">Reports</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.reports') }}">
                                        <i class="ti ti-dashboard me-2"></i>Overview
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.reports.users') }}">
                                        <i class="ti ti-users me-2"></i>User Reports
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.reports.revenue') }}">
                                        <i class="ti ti-currency-dollar me-2"></i>Revenue Reports
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.reports.content') }}">
                                        <i class="ti ti-music me-2"></i>Content Reports
                                    </a>
                                </div>
                            </li>
                        </ul>
                        {{-- <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                            <a href="{{ url('/') }}" class="btn btn-outline-primary">
                                <i class="ti ti-home me-2"></i>Back to Site
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="page-wrapper">
            @yield('content')

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">Privacy Policy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">Terms of Service</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    &copy; 2025 <a href="." class="link-secondary fw-bold">Playlist Music</a>.
                                    All rights reserved.
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary" rel="noopener">
                                        v1.0.0
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Tabler Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>

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
                    timer: 3000,
                    toast: true,
                    position: 'top-end',
                    customClass: {
                        popup: 'animated fadeInDown faster'
                    }
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    showConfirmButton: true,
                    customClass: {
                        popup: 'animated fadeInDown faster'
                    }
                });
            @endif
        });
    </script>

    @yield('scripts')
</body>

</html>
