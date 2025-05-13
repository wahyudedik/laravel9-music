<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist Music</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <!-- Tabler CSS & Icons -->
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
    </style>
    @stack('styles')

</head>

<body class="theme-light">
    <div class="page">
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
                <div class="navbar-nav flex-row order-md-last">
                    <!-- Add Search -->
                    <div class="nav-item me-3">
                        <form action="#" method="GET" class="d-flex">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" class="form-control form-control-sm" placeholder="Search...">
                            </div>
                        </form>
                    </div>

                    <!-- Add Live Chat Icon -->
                    <div class="nav-item me-3">
                        <a href="{{ route('user.chat') }}" class="nav-link px-0" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Live Chat">
                            <i class="ti ti-messages"></i>
                            <span class="badge bg-green badge-pill badge-notification">1</span>
                        </a>
                    </div>

                    <!-- Add Notification Icon -->
                    <div class="nav-item dropdown d-none d-md-flex me-3">
                        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                            aria-label="Show notifications">
                            <i class="ti ti-bell"></i>
                            <span class="badge bg-red badge-pill badge-notification">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Notifications</h3>
                                </div>
                                <div class="list-group list-group-flush list-group-hoverable">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto"><span
                                                    class="status-dot status-dot-animated bg-red d-block"></span></div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-body d-block">New song added to your
                                                    playlist</a>
                                                <div class="d-block text-muted text-truncate mt-n1">2 minutes ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto"><span class="status-dot bg-green d-block"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-body d-block">Your account has been
                                                    verified</a>
                                                <div class="d-block text-muted text-truncate mt-n1">1 hour ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto"><span class="status-dot bg-yellow d-block"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-body d-block">New album release from your
                                                    favorite artist</a>
                                                <div class="d-block text-muted text-truncate mt-n1">Yesterday</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('notifications') }}" class="link-secondary">View all
                                        notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Cart Icon -->
                    <div class="nav-item dropdown d-none d-md-flex me-3">
                        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                            aria-label="Show cart">
                            <i class="ti ti-shopping-cart"></i>
                            <span class="badge bg-red badge-pill badge-notification">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card"
                            style="width: 350px;">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Shopping Cart</h3>
                                </div>
                                <div class="list-group list-group-flush list-group-hoverable">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://picsum.photos/40/40?random=1)"></span>
                                            </div>
                                            <div class="col">
                                                <div class="text-body">Premium Subscription</div>
                                                <div class="text-muted">Rp. 34.000,00</div>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="btn btn-sm btn-ghost-danger">
                                                    <i class="ti ti-x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://picsum.photos/40/40?random=2)"></span>
                                            </div>
                                            <div class="col">
                                                <div class="text-body">Album Download</div>
                                                <div class="text-muted">Rp. 344.000,00</div>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="btn btn-sm btn-ghost-danger">
                                                    <i class="ti ti-x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <span>Total: <strong>$22.98</strong></span>
                                        <a href="{{ route('user.cart') }}" class="btn btn-primary btn-sm">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User dropdown (existing code) -->
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
                            <a href="{{ route('profile.my-assets') }}" class="dropdown-item">
                                <i class="ti ti-user me-2"></i>Profile
                            </a>
                            @if (!auth()->user()->email_verified_at)
                                <a href="{{ route('verification.notice') }}" class="dropdown-item text-warning">
                                    <i class="ti ti-mail-exclamation me-2"></i>Verifikasi Akun
                                </a>
                            @endif
                            @if (auth()->user()->email_verified_at)
                                @php
                                    $verification = \App\Models\Verification::where('user_id', auth()->id())
                                        ->latest()
                                        ->first();
                                @endphp

                                @if (!$verification)
                                    <a href="{{ route('verification.form') }}" class="dropdown-item text-primary">
                                        <i class="ti ti-id me-2"></i>Verifikasi Akun
                                    </a>
                                @elseif($verification->status == 'pending')
                                    <a href="{{ route('verification.status') }}" class="dropdown-item text-warning">
                                        <i class="ti ti-hourglass me-2"></i>Status Verifikasi
                                    </a>
                                @elseif($verification->status == 'approved')
                                    <a href="{{ route('verification.status') }}" class="dropdown-item text-success">
                                        <i class="ti ti-check me-2"></i>Akun Terverifikasi
                                        ({{ ucfirst($verification->type) }})
                                    </a>
                                @elseif($verification->status == 'rejected')
                                    <a href="{{ route('verification.status') }}" class="dropdown-item text-danger">
                                        <i class="ti ti-x me-2"></i>Verifikasi {{ ucfirst($verification->type) }}
                                        Ditolak
                                    </a>
                                @endif
                            @endif
                            <a href="{{ route('user.wallet') }}" class="dropdown-item">
                                <i class="ti ti-wallet me-2"></i>My Wallet
                            </a>
                            <a href="{{ route('ticket.copyright') }}" class="dropdown-item">
                                <i class="ti ti-ticket me-2"></i>Claim Hak Cipta
                            </a>
                            <a href="{{ route('user.settings') }}" class="dropdown-item">
                                <i class="ti ti-settings me-2"></i>Settings
                            </a>
                            <a href="{{ route('help.center') }}" class="dropdown-item">
                                <i class="ti ti-help me-2"></i>Help Center
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout', ['role' => 'User']) }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="ti ti-logout me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <i class="ti ti-home me-1"></i>Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">
                                    <i class="ti ti-dashboard me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('playlist.index') }}">
                                    <i class="ti ti-playlist me-1"></i>Playlist
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wishlist.index') }}">
                                    <i class="ti ti-heart me-1"></i>Wishlist
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('report.index') }}">
                                    <i class="ti ti-flag me-1"></i>Report
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        {{--  Content --}}
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
                            <li class="list-inline-item">
                                <a href="#" class="link-secondary">Help Center</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                © 2025 <a href="." class="link-secondary">Playlist Music</a>.
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

            @if (session('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: "{{ session('info') }}",
                    showConfirmButton: false,
                });
            @endif
        });
    </script>
    @yield('scripts')

</body>

</html>
