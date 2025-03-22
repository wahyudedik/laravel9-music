@extends('layouts.app')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">MusicApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-1"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-music me-1"></i> Songs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog me-1"></i> Settings
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.verifications.index') }}">
                            <i class="fas fa-user me-1"></i> Approve User
                        </a>
                    </li>

                    
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4361ee&color=fff"
                                class="rounded-circle me-2" width="32" height="32" alt="Profile">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                @php
                                    $user = Auth::user();
                                    $userRole = $user->getRoleNames()->first();
                                @endphp
                                <form action="{{ route('logout', ['role' => $userRole]) }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Dashboard</h2>
                <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}</p>
            </div>
            <div>
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> New Song
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-users text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Total Users</h6>
                            <h3 class="mt-2 mb-0">{{ $totalUsers }}</h3>
                            <p class="text-success mb-0 small"><i class="fas fa-arrow-up me-1"></i> {{ $userGrowthPercentage }}% this month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-music text-success fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Total Songs</h6>
                            <h3 class="mt-2 mb-0">{{ $totalSongs }}</h3>
                            <p class="text-success mb-0 small"><i class="fas fa-arrow-up me-1"></i> {{ $songGrowthPercentage }}% this month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="fas fa-dollar-sign text-warning fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Revenue</h6>
                            <h3 class="mt-2 mb-0">Rp. {{ $totalRevenue }}</h3>
                            <p class="text-success mb-0 small"><i class="fas fa-arrow-up me-1"></i> {{ $revenueGrowthPercentage }}% this month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                            <i class="fas fa-headphones text-danger fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Streams</h6>
                            <h3 class="mt-2 mb-0">{{ $totalStreams }}</h3>
                            <p class="text-success mb-0 small"><i class="fas fa-arrow-up me-1"></i> {{ $streamGrowthPercentage }}% this month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row g-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Recent Songs</h5>
                        <a href="#" class="text-decoration-none">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Artist</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">Uploaded</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://picsum.photos/40/40?random=1" class="rounded me-3"
                                                    alt="Song">
                                                <div>Blinding Lights</div>
                                            </div>
                                        </td>
                                        <td>The Weeknd</td>
                                        <td>Pop</td>
                                        <td>Today</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://picsum.photos/40/40?random=2" class="rounded me-3"
                                                    alt="Song">
                                                <div>Save Your Tears</div>
                                            </div>
                                        </td>
                                        <td>The Weeknd</td>
                                        <td>Pop</td>
                                        <td>Yesterday</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://picsum.photos/40/40?random=3" class="rounded me-3"
                                                    alt="Song">
                                                <div>Levitating</div>
                                            </div>
                                        </td>
                                        <td>Dua Lipa</td>
                                        <td>Pop</td>
                                        <td>2 days ago</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://picsum.photos/40/40?random=4" class="rounded me-3"
                                                    alt="Song">
                                                <div>Stay</div>
                                            </div>
                                        </td>
                                        <td>Justin Bieber</td>
                                        <td>Pop</td>
                                        <td>3 days ago</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://picsum.photos/40/40?random=5" class="rounded me-3"
                                                    alt="Song">
                                                <div>Industry Baby</div>
                                            </div>
                                        </td>
                                        <td>Lil Nas X</td>
                                        <td>Hip Hop</td>
                                        <td>5 days ago</td>
                                        <td><span class="badge bg-danger">Inactive</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Top Genres</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Pop</span>
                                <span>45%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 45%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Hip Hop</span>
                                <span>30%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 30%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Rock</span>
                                <span>15%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 15%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Electronic</span>
                                <span>10%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 10%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Recent Activities</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-upload text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0">New song uploaded</p>
                                    <small class="text-muted">30 minutes ago</small>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-user-plus text-success"></i>
                                </div>
                                <div>
                                    <p class="mb-0">New user registered</p>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="rounded-circle bg-warning bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-credit-card text-warning"></i>
                                </div>
                                <div>
                                    <p class="mb-0">New payment received</p>
                                    <small class="text-muted">3 hours ago</small>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="rounded-circle bg-danger bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                </div>
                                <div>
                                    <p class="mb-0">System alert detected</p>
                                    <small class="text-muted">5 hours ago</small>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-cog text-info"></i>
                                </div>
                                <div>
                                    <p class="mb-0">System settings updated</p>
                                    <small class="text-muted">1 day ago</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0">&copy; 2023 Music Cool Poll. All rights reserved.</p>
                <div>
                    <a href="#" class="text-decoration-none text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-decoration-none text-muted">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
@endsection
