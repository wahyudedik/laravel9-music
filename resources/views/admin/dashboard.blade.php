@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                    <div class="text-muted mt-1">Welcome back, {{ Auth::user()->name }}</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-plus me-2"></i>
                            New Song
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon">
                            <i class="ti ti-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- Stats Cards -->
            <div class="row row-deck row-cards mb-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-primary-lt me-3">
                                    <i class="ti ti-users text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Total Users</div>
                                    <div class="h3 m-0">{{ $totalUsers }}</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> {{ $userGrowthPercentage }}%
                                    </span>
                                    <span class="text-muted">this month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-success-lt me-3">
                                    <i class="ti ti-music text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Total Songs</div>
                                    <div class="h3 m-0">{{ $totalSongs }}</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> {{ $songGrowthPercentage }}%
                                    </span>
                                    <span class="text-muted">this month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-warning-lt me-3">
                                    <i class="ti ti-currency-dollar text-warning"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Revenue</div>
                                    <div class="h3 m-0">Rp. {{ $totalRevenue }}</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> {{ $revenueGrowthPercentage }}%
                                    </span>
                                    <span class="text-muted">this month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-danger-lt me-3">
                                    <i class="ti ti-headphones text-danger"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Streams</div>
                                    <div class="h3 m-0">{{ $totalStreams }}</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> {{ $streamGrowthPercentage }}%
                                    </span>
                                    <span class="text-muted">this month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Songs</h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-link">View All</a>
                            </div>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <select class="form-select form-select-sm">
                                            <option value="5">5</option>
                                            <option value="10" selected>10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    entries
                                </div>
                                <div class="ms-auto text-muted">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label="Search songs">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Artist</th>
                                        <th>Genre</th>
                                        <th>Uploaded</th>
                                        <th>Status</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random=1)"></span>
                                                <div>Blinding Lights</div>
                                            </div>
                                        </td>
                                        <td>The Weeknd</td>
                                        <td>Pop</td>
                                        <td>Today</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-edit me-2"></i>Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-player-play me-2"></i>Preview
                                                    </a>
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ti ti-trash me-2"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random=2)"></span>
                                                <div>Save Your Tears</div>
                                            </div>
                                        </td>
                                        <td>The Weeknd</td>
                                        <td>Pop</td>
                                        <td>Yesterday</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-ghost-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-edit me-2"></i>Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-player-play me-2"></i>Preview
                                                    </a>
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ti ti-trash me-2"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random=3)"></span>
                                                <div>Levitating</div>
                                            </div>
                                        </td>
                                        <td>Dua Lipa</td>
                                        <td>Pop</td>
                                        <td>2 days ago</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-ghost-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-edit me-2"></i>Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-player-play me-2"></i>Preview
                                                    </a>
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ti ti-trash me-2"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random=4)"></span>
                                                <div>Stay</div>
                                            </div>
                                        </td>
                                        <td>Justin Bieber</td>
                                        <td>Pop</td>
                                        <td>3 days ago</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-ghost-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-edit me-2"></i>Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-player-play me-2"></i>Preview
                                                    </a>
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ti ti-trash me-2"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random=5)"></span>
                                                <div>Industry Baby</div>
                                            </div>
                                        </td>
                                        <td>Lil Nas X</td>
                                        <td>Hip Hop</td>
                                        <td>5 days ago</td>
                                        <td><span class="badge bg-danger">Inactive</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-ghost-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-edit me-2"></i>Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-player-play me-2"></i>Preview
                                                    </a>
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ti ti-trash me-2"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Showing <span>1</span> to <span>5</span> of <span>25</span> entries
                            </p>
                            <ul class="pagination m-0 ms-auto">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="ti ti-chevron-left"></i>
                                        prev
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        next
                                        <i class="ti ti-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Top Genres</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Pop</span>
                                            <span>45%</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 45%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Hip Hop</span>
                                            <span>30%</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Rock</span>
                                            <span>15%</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Electronic</span>
                                            <span>10%</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 10%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Activities</h3>
                                </div>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded bg-primary-lt">
                                                    <i class="ti ti-upload text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="text-body">New song uploaded</div>
                                                <div class="text-muted">30 minutes ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded bg-success-lt">
                                                    <i class="ti ti-user-plus text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="text-body">New user registered</div>
                                                <div class="text-muted">1 hour ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded bg-warning-lt">
                                                    <i class="ti ti-credit-card text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="text-body">New payment received</div>
                                                <div class="text-muted">3 hours ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded bg-danger-lt">
                                                    <i class="ti ti-alert-triangle text-danger"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="text-body">System alert detected</div>
                                                <div class="text-muted">5 hours ago</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded bg-info-lt">
                                                    <i class="ti ti-settings text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="text-body">System settings updated</div>
                                                <div class="text-muted">1 day ago</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pending Verifications</h3>
                                </div>
                                <div class="list-group list-group-flush">
                                    <a href="{{ route('admin.verifications.index') }}"
                                        class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://ui-avatars.com/api/?name=John+Doe&background=e53935&color=fff)"></span>
                                            </div>
                                            <div class="col">
                                                <div class="text-body d-block">John Doe</div>
                                                <div class="d-block text-muted mt-n1">
                                                    <span class="badge bg-warning text-dark">Artist Verification</span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="ti ti-chevron-right text-muted"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.verifications.index') }}"
                                        class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://ui-avatars.com/api/?name=Jane+Smith&background=e53935&color=fff)"></span>
                                            </div>
                                            <div class="col">
                                                <div class="text-body d-block">Jane Smith</div>
                                                <div class="d-block text-muted mt-n1">
                                                    <span class="badge bg-warning text-dark">Composer Verification</span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="ti ti-chevron-right text-muted"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Claims</h3>
                                    <div class="card-actions">
                                        <a href="{{ route('admin.claims.index') }}" class="btn btn-link">View All</a>
                                    </div>
                                </div>
                                <div class="list-group list-group-flush">
                                    @forelse($recentClaims ?? [] as $claim)
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="avatar"
                                                        style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($claim->user->name) }}&background=e53935&color=fff)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <div class="text-body d-block">{{ $claim->song->title }}</div>
                                                            <div class="d-block text-muted mt-n1">
                                                                Claimed by {{ $claim->user->name }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            @if ($claim->status == 'pending')
                                                                <span class="badge bg-warning text-dark">Pending</span>
                                                            @elseif($claim->status == 'approved')
                                                                <span class="badge bg-success">Approved</span>
                                                            @elseif($claim->status == 'rejected')
                                                                <span class="badge bg-danger">Rejected</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="{{ route('admin.claims.show', $claim) }}"
                                                        class="btn btn-icon btn-ghost-secondary">
                                                        <i class="ti ti-chevron-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="list-group-item">
                                            <div class="text-center py-3">
                                                <span class="text-muted">No recent claims</span>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                @if (isset($recentClaims) && count($recentClaims) > 0)
                                    <div class="card-footer">
                                        <a href="{{ route('admin.claims.create') }}" class="btn btn-primary w-100">
                                            <i class="ti ti-plus me-2"></i>Create New Claim
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Additional dashboard-specific JavaScript can be added here
        document.addEventListener('DOMContentLoaded', function() {
            // Example of using SweetAlert for a dashboard action
            const newSongBtn = document.querySelector('.btn-primary');
            if (newSongBtn) {
                newSongBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Create New Song',
                        html: `
                        <input id="songTitle" class="swal2-input" placeholder="Song Title">
                        <input id="songArtist" class="swal2-input" placeholder="Artist">
                        <select id="songGenre" class="swal2-select">
                            <option value="">Select Genre</option>
                            <option value="pop">Pop</option>
                            <option value="rock">Rock</option>
                            <option value="hiphop">Hip Hop</option>
                            <option value="electronic">Electronic</option>
                        </select>
                    `,
                        showCancelButton: true,
                        confirmButtonText: 'Create',
                        confirmButtonColor: '#e53935',
                        focusConfirm: false,
                        preConfirm: () => {
                            const title = document.getElementById('songTitle').value;
                            const artist = document.getElementById('songArtist').value;
                            const genre = document.getElementById('songGenre').value;

                            if (!title || !artist || !genre) {
                                Swal.showValidationMessage('Please fill all fields');
                            }

                            return {
                                title,
                                artist,
                                genre
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Song Created!',
                                text: `${result.value.title} by ${result.value.artist} has been created.`,
                                confirmButtonColor: '#e53935',
                            });
                        }
                    });
                });
            }
        });
    </script>
@endsection
