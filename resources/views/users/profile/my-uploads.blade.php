@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">My Assets</div>
                        <h2 class="page-title">My Uploads (Composer)</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-upload me-2"></i>Upload New Song
                            </a>
                            <a href="{{ route('profile.my-assets') }}"
                                class="btn btn-outline-primary d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left me-2"></i>Back to Assets
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <!-- Filter and Search -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search uploads...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select">
                                    <option value="all">All Status</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending Review</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select">
                                    <option value="all">All Licenses</option>
                                    <option value="standard">Standard</option>
                                    <option value="premium">Premium</option>
                                    <option value="exclusive">Exclusive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select">
                                    <option value="recent">Recently Uploaded</option>
                                    <option value="oldest">Oldest First</option>
                                    <option value="popular">Most Popular</option>
                                    <option value="revenue">Highest Revenue</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="ti ti-filter"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Uploads Table -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Your Uploaded Songs</h3>
                        <div class="card-actions">
                            <span class="badge bg-blue">{{ rand(10, 50) }} Uploads</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Song</th>
                                    <th>Genre</th>
                                    <th>Uploaded</th>
                                    <th>Status</th>
                                    <th>License</th>
                                    <th>Stats</th>
                                    <th>Revenue</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $genres = ['Pop', 'Rock', 'Hip Hop', 'R&B', 'Jazz', 'Electronic', 'Classical'];
                                    $statuses = ['Published', 'Draft', 'Pending Review'];
                                    $licenses = ['Standard', 'Premium', 'Exclusive'];
                                @endphp

                                @for ($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $i + 210 }})"></span>
                                                <div>
                                                    <div class="font-weight-medium">Composed Song {{ $i }}</div>
                                                    <div class="text-muted">
                                                        {{ rand(1, 5) }}:{{ sprintf('%02d', rand(0, 59)) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $genres[array_rand($genres)] }}</td>
                                        <td>{{ now()->subDays(rand(1, 365))->format('M d, Y') }}</td>
                                        <td>
                                            @php
                                                $status = $statuses[array_rand($statuses)];
                                                $statusClass = [
                                                    'Published' => 'bg-success',
                                                    'Draft' => 'bg-secondary',
                                                    'Pending Review' => 'bg-warning',
                                                ][$status];
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $license = $licenses[array_rand($licenses)];
                                                $licenseClass = [
                                                    'Standard' => 'bg-blue-lt',
                                                    'Premium' => 'bg-purple-lt',
                                                    'Exclusive' => 'bg-gold-lt',
                                                ][$license];
                                            @endphp
                                            <span class="badge {{ $licenseClass }}">{{ $license }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-eye me-1"></i> {{ number_format(rand(100, 50000)) }}
                                                <i class="ti ti-license ms-2 me-1"></i> {{ rand(0, 50) }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-success">Rp {{ number_format(rand(50000, 5000000)) }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <button class="btn btn-icon btn-sm btn-primary" data-bs-toggle="tooltip"
                                                    title="Play">
                                                    <i class="ti ti-player-play"></i>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon btn-sm btn-ghost-secondary"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-edit me-2"></i>Edit
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-license me-2"></i>Manage License
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-chart-bar me-2"></i>View Stats
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-coin me-2"></i>Revenue Details
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" class="dropdown-item text-danger">
                                                            <i class="ti ti-trash me-2"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of
                            <span>{{ rand(10, 50) }}</span> uploads</p>
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

                <!-- License Management -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">License Management</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar bg-blue-lt me-3">
                                                <i class="ti ti-license text-blue"></i>
                                            </span>
                                            <div>
                                                <div class="font-weight-medium">Standard License</div>
                                                <div class="text-muted">{{ rand(5, 30) }} songs</div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="text-muted">Starting from</div>
                                                    <div class="h3">Rp {{ number_format(rand(50000, 200000)) }}</div>
                                                </div>
                                                <div class="ms-auto">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="ti ti-settings me-1"></i>Manage
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar bg-purple-lt me-3">
                                                <i class="ti ti-license text-purple"></i>
                                            </span>
                                            <div>
                                                <div class="font-weight-medium">Premium License</div>
                                                <div class="text-muted">{{ rand(3, 20) }} songs</div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="text-muted">Starting from</div>
                                                    <div class="h3">Rp {{ number_format(rand(200000, 500000)) }}</div>
                                                </div>
                                                <div class="ms-auto">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="ti ti-settings me-1"></i>Manage
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar bg-yellow-lt me-3">
                                                <i class="ti ti-license text-yellow"></i>
                                            </span>
                                            <div>
                                                <div class="font-weight-medium">Exclusive License</div>
                                                <div class="text-muted">{{ rand(1, 10) }} songs</div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="text-muted">Starting from</div>
                                                    <div class="h3">Rp {{ number_format(rand(1000000, 5000000)) }}
                                                    </div>
                                                </div>
                                                <div class="ms-auto">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="ti ti-settings me-1"></i>Manage
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Stats -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Revenue Overview</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-green">
                                            <i class="ti ti-coin"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h3 class="mb-1">Rp {{ number_format(rand(5000000, 50000000)) }}</h3>
                                        <div class="text-muted">
                                            Total revenue from all uploads <span
                                                class="text-success">+{{ rand(10, 30) }}% this month</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Standard</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(5, 15) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(30, 50) }}%" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Premium</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(10, 25) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(20, 40) }}%" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Exclusive</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(15, 40) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(10, 30) }}%" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Top Revenue Generators</h3>
                            </div>
                            <div class="list-group list-group-flush">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar">{{ $i }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $i + 220 }})"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-reset d-block">Top Song
                                                    {{ $i }}</a>
                                                <div class="text-muted text-truncate mt-n1">
                                                    {{ $licenses[array_rand($licenses)] }} License</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="badge bg-green-lt">
                                                    <i class="ti ti-coin me-1"></i>
                                                    Rp {{ number_format(rand(500000, 5000000)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
