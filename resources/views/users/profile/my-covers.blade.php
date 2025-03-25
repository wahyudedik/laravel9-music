@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">My Assets</div>
                        <h2 class="page-title">My Cover Songs</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-plus me-2"></i>Create New Cover
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
                                    <input type="radio" class="btn-check" name="cover-filter" id="all-covers" checked>
                                    <label class="btn btn-outline-primary" for="all-covers">All</label>

                                    <input type="radio" class="btn-check" name="cover-filter" id="published-covers">
                                    <label class="btn btn-outline-primary" for="published-covers">Published</label>

                                    <input type="radio" class="btn-check" name="cover-filter" id="draft-covers">
                                    <label class="btn btn-outline-primary" for="draft-covers">Drafts</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search covers...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select">
                                    <option value="recent">Recently Created</option>
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

                <!-- Cover Songs Table -->
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Cover Title</th>
                                    <th>Original Artist</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Stats</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statuses = ['Published', 'Draft', 'Processing'];
                                @endphp

                                @for ($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $i + 120 }})"></span>
                                                <div>
                                                    <div class="font-weight-medium">Cover of Song {{ $i }}</div>
                                                    <div class="text-muted">
                                                        {{ rand(1, 5) }}:{{ sprintf('%02d', rand(0, 59)) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Original Artist {{ $i }}</td>
                                        <td>{{ now()->subDays(rand(1, 30))->format('M d, Y') }}</td>
                                        <td>
                                            @php
                                                $status = $statuses[array_rand($statuses)];
                                                $statusClass = [
                                                    'Published' => 'bg-success',
                                                    'Draft' => 'bg-secondary',
                                                    'Processing' => 'bg-warning',
                                                ][$status];
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-eye me-1"></i> {{ rand(100, 9999) }}
                                                <i class="ti ti-heart ms-2 me-1"></i> {{ rand(10, 999) }}
                                                <i class="ti ti-message ms-2 me-1"></i> {{ rand(0, 50) }}
                                            </div>
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
                        <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of <span>25</span> entries</p>
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

                <!-- Cover Stats -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cover Performance</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="card-stamp">
                                        <div class="card-stamp-icon bg-primary">
                                            <i class="ti ti-chart-bar"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h3 class="mb-1">{{ number_format(rand(5000, 50000)) }} Total Plays</h3>
                                        <div class="text-muted">
                                            Your covers are performing well! <span
                                                class="text-success">+{{ rand(5, 25) }}% this month</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Likes</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(5, 15) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(60, 90) }}%" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Comments</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(5, 15) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(40, 70) }}%" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <div class="d-flex mb-2">
                                                    <div>Shares</div>
                                                    <div class="ms-auto">
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(5, 15) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ rand(30, 60) }}%" role="progressbar"></div>
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
                                <h3 class="card-title">Top Performing Covers</h3>
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
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $i + 140 }})"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-reset d-block">Top Cover
                                                    {{ $i }}</a>
                                                <div class="text-muted text-truncate mt-n1">Original by Artist
                                                    {{ $i }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="badge bg-primary-lt">
                                                    <i class="ti ti-eye me-1"></i>
                                                    {{ number_format(rand(1000, 10000)) }}
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
