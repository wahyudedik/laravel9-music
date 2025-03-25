@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">My Assets</div>
                        <h2 class="page-title">Released Songs</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-rocket me-2"></i>Release New Song
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
                            <div class="col-md-3">
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="release-filter" id="all-releases" checked>
                                    <label class="btn btn-outline-primary" for="all-releases">All</label>

                                    <input type="radio" class="btn-check" name="release-filter" id="singles">
                                    <label class="btn btn-outline-primary" for="singles">Singles</label>

                                    <input type="radio" class="btn-check" name="release-filter" id="albums">
                                    <label class="btn btn-outline-primary" for="albums">Albums</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search releases...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select">
                                    <option value="recent">Recently Released</option>
                                    <option value="oldest">Oldest First</option>
                                    <option value="popular">Most Popular</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="ti ti-filter me-1"></i>Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Albums Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Albums</h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-primary">
                                <i class="ti ti-plus me-2"></i>Create Album
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row row-cards">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card card-sm">
                                        <div class="ribbon ribbon-top ribbon-start bg-primary">
                                            <i class="ti ti-album"></i>
                                        </div>
                                        <a href="#" class="d-block">
                                            <img src="https://picsum.photos/400/400?random={{ $i + 160 }}"
                                                class="card-img-top" alt="Album Cover">
                                        </a>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-medium">Album {{ $i }}</div>
                                                    <div class="text-muted">{{ rand(5, 12) }} songs</div>
                                                </div>
                                                <div class="ms-auto">
                                                    <span class="badge bg-blue-lt">
                                                        <i
                                                            class="ti ti-calendar me-1"></i>{{ now()->subMonths(rand(1, 12))->format('M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div><i class="ti ti-eye me-1"></i>
                                                        {{ number_format(rand(10000, 1000000)) }} plays</div>
                                                    <div class="ms-auto"><i class="ti ti-heart me-1"></i>
                                                        {{ number_format(rand(1000, 50000)) }}</div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: {{ rand(30, 95) }}%"
                                                        role="progressbar"></div>
                                                </div>
                                            </div>
                                            <div class="mt-3 d-flex">
                                                <button class="btn btn-sm btn-primary">
                                                    <i class="ti ti-player-play me-1"></i>Play
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary ms-auto">
                                                    <i class="ti ti-edit me-1"></i>Edit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Singles Section -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Singles</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Release Date</th>
                                    <th>Genre</th>
                                    <th>Stats</th>
                                    <th>Revenue</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $genres = ['Pop', 'Rock', 'Hip Hop', 'R&B', 'Jazz', 'Electronic', 'Classical'];
                                @endphp

                                @for ($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $i + 170 }})"></span>
                                                <div>
                                                    <div class="font-weight-medium">Single {{ $i }}</div>
                                                    <div class="text-muted">
                                                        {{ rand(2, 5) }}:{{ sprintf('%02d', rand(0, 59)) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ now()->subDays(rand(1, 365))->format('M d, Y') }}</td>
                                        <td>{{ $genres[array_rand($genres)] }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-eye me-1"></i> {{ number_format(rand(1000, 100000)) }}
                                                <i class="ti ti-heart ms-2 me-1"></i>
                                                {{ number_format(rand(100, 10000)) }}
                                                <i class="ti ti-message ms-2 me-1"></i> {{ number_format(rand(10, 500)) }}
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
                                                <button class="btn btn-icon btn-sm btn-secondary" data-bs-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon btn-sm btn-ghost-secondary"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-share me-2"></i>Share
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
                        <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of <span>32</span> entries</p>
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

                <!-- Performance Stats -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Release Performance</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-primary">
                                            <i class="ti ti-chart-line"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h3 class="mb-1">{{ number_format(rand(50000, 5000000)) }} Total Plays</h3>
                                        <div class="text-muted">
                                            Your releases are trending! <span class="text-success">+{{ rand(10, 35) }}%
                                                this month</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Plays</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(10, 25) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(70, 95) }}%" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Likes</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(10, 25) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(60, 85) }}%" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Revenue</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(15, 30) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(50, 80) }}%" role="progressbar"></div>
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
                                <h3 class="card-title">Top Performing Releases</h3>
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
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $i + 180 }})"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-reset d-block">Top Release
                                                    {{ $i }}</a>
                                                <div class="text-muted text-truncate mt-n1">
                                                    {{ $genres[array_rand($genres)] }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="badge bg-primary-lt">
                                                    <i class="ti ti-eye me-1"></i>
                                                    {{ number_format(rand(10000, 1000000)) }}
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
