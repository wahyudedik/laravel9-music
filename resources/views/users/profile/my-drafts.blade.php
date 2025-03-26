@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">My Assets</div>
                        <h2 class="page-title">Unreleased Songs (Drafts)</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-plus me-2"></i>Create New Draft
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
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search drafts...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="recent">Recently Updated</option>
                                    <option value="oldest">Oldest First</option>
                                    <option value="name">Name (A-Z)</option>
                                    <option value="completion">Completion %</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="ti ti-filter me-1"></i>Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Draft Songs List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Your Draft Songs</h3>
                        <div class="card-actions">
                            <span class="badge bg-yellow">{{ rand(5, 15) }} Drafts</span>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        @for ($i = 1; $i <= 10; $i++)
                            @php
                                $completion = rand(30, 95);
                                $lastEdited = now()->subDays(rand(1, 30));
                            @endphp
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="avatar avatar-rounded"
                                            style="background-image: url(https://picsum.photos/40/40?random={{ $i + 190 }})"></span>
                                    </div>
                                    <div class="col text-truncate">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="font-weight-medium">Draft Song {{ $i }}</div>
                                                <div class="text-muted">Last edited: {{ $lastEdited->format('M d, Y') }}
                                                </div>
                                            </div>
                                            <div>
                                                <span class="badge bg-yellow-lt">{{ $completion }}% Complete</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-sm mt-2">
                                            <div class="progress-bar bg-yellow" style="width: {{ $completion }}%"
                                                role="progressbar"></div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="btn-list">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="ti ti-edit me-1"></i>Edit
                                            </button>
                                            <button class="btn btn-sm btn-success">
                                                <i class="ti ti-player-play me-1"></i>Preview
                                            </button>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-ghost-secondary" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-rocket me-2"></i>Publish
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-copy me-2"></i>Duplicate
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="ti ti-share me-2"></i>Share for Feedback
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ti ti-trash me-2"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of
                            <span>{{ rand(10, 20) }}</span> drafts
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
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    next
                                    <i class="ti ti-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Publishing Guide -->
                <div class="card mt-4 bg-primary-lt">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="card-stamp">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="ti ti-rocket"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h3 class="mb-1">Ready to release your music?</h3>
                                <div class="text-muted">
                                    Complete your drafts and share your music with the world. Follow these steps to publish
                                    your song:
                                </div>
                                <ol class="mt-3">
                                    <li>Finalize your audio track</li>
                                    <li>Add cover artwork</li>
                                    <li>Complete metadata (title, genre, description)</li>
                                    <li>Select your license type</li>
                                    <li>Click "Publish" to release your song</li>
                                </ol>
                                <div class="mt-3">
                                    <button class="btn btn-primary">
                                        <i class="ti ti-rocket me-2"></i>Publish a Draft
                                    </button>
                                    <button class="btn btn-link ms-2">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Draft Completion Stats -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Draft Completion Status</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-stamp mb-3">
                                            <div class="card-stamp-icon bg-yellow">
                                                <i class="ti ti-hourglass"></i>
                                            </div>
                                        </div>
                                        <h4>{{ rand(5, 15) }} Drafts in Progress</h4>
                                        <div class="text-muted mb-3">Average completion: {{ rand(50, 75) }}%</div>

                                        <div class="mb-3">
                                            <div class="d-flex mb-2">
                                                <div>Almost Ready (80%+)</div>
                                                <div class="ms-auto">{{ rand(2, 5) }}</div>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" style="width: {{ rand(20, 40) }}%"
                                                    role="progressbar"></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex mb-2">
                                                <div>In Progress (40-80%)</div>
                                                <div class="ms-auto">{{ rand(3, 7) }}</div>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-yellow" style="width: {{ rand(40, 60) }}%"
                                                    role="progressbar"></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex mb-2">
                                                <div>Just Started (<40%)< /div>
                                                        <div class="ms-auto">{{ rand(1, 4) }}</div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger"
                                                        style="width: {{ rand(10, 30) }}%" role="progressbar"></div>
                                                </div>
                                            </div>

                                            <div class="card bg-yellow-lt mt-4">
                                                <div class="card-body">
                                                    <h4 class="mb-3">Draft Insights</h4>
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2">
                                                            <i class="ti ti-calendar me-2"></i>Oldest draft:
                                                            {{ now()->subDays(rand(60, 180))->format('M d, Y') }}
                                                        </li>
                                                        <li class="mb-2">
                                                            <i class="ti ti-clock me-2"></i>Most recent edit:
                                                            {{ now()->subHours(rand(1, 48))->format('M d, H:i') }}
                                                        </li>
                                                        <li class="mb-2">
                                                            <i class="ti ti-alert-circle me-2"></i>{{ rand(1, 3) }}
                                                            drafts inactive for 30+ days
                                                        </li>
                                                    </ul>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-yellow">
                                                            <i class="ti ti-refresh me-1"></i>Resume Oldest Draft
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Recently Edited Drafts</h3>
                                        </div>
                                        <div class="list-group list-group-flush">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @php
                                                    $hoursAgo = rand(1, 72);
                                                    $completion = rand(30, 95);
                                                @endphp
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span class="avatar"
                                                                style="background-image: url(https://picsum.photos/40/40?random={{ $i + 200 }})"></span>
                                                        </div>
                                                        <div class="col text-truncate">
                                                            <a href="#" class="text-reset d-block">Draft
                                                                {{ $i }}</a>
                                                            <div class="d-flex text-muted text-truncate mt-n1">
                                                                <div>Edited {{ $hoursAgo }}
                                                                    {{ $hoursAgo == 1 ? 'hour' : 'hours' }} ago</div>
                                                                <div class="ms-auto">{{ $completion }}% complete</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="btn btn-sm btn-primary">
                                                                <i class="ti ti-edit me-1"></i>Continue
                                                            </button>
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
            </div>
        @endsection
