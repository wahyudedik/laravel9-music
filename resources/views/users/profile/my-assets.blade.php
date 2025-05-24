@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Profile</div>
                        <h2 class="page-title">My Assets</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            @if (auth()->user()->hasRole('Composer'))
                                <a href="{{ route('user.songs.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                                    <i class="ti ti-upload me-2"></i>Upload New Song
                                </a>
                            @endif
                            <a href="#" class="btn btn-outline-primary d-none d-sm-inline-block">
                                <i class="ti ti-playlist me-2"></i>Create Playlist
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <!-- User Profile Card -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 avatar-rounded"
                                    style="background-image: url({{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=e53935&color=fff&size=100' }}); background-size: cover; background-position: center;"></span>
                                <h3 class="m-0 mb-1">{{ auth()->user()->name }}</h3>
                                <div class="text-muted">{{ auth()->user()->email }}</div>
                                <div class="mt-3">
                                    <span class="badge bg-purple-lt">
                                        <i class="ti ti-user me-1"></i> {{ auth()->user()->role }}
                                    </span>
                                    @php
                                        $verification = \App\Models\Verification::where('user_id', auth()->id())
                                            ->where('status', 'approved')
                                            ->latest()
                                            ->first();
                                    @endphp

                                    @if ($verification)
                                        <span class="badge bg-success">
                                            <i class="ti ti-check me-1"></i> {{ ucfirst($verification->type) }} Verified
                                        </span>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <div class="border rounded text-center p-2">
                                                <div class="h3 m-0">42</div>
                                                <div class="text-muted">Songs</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="border rounded text-center p-2">
                                                <div class="h3 m-0">128</div>
                                                <div class="text-muted">Followers</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="border rounded text-center p-2">
                                                <div class="h3 m-0">67</div>
                                                <div class="text-muted">Following</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary w-100">
                                        <i class="ti ti-edit me-2"></i> Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#all" class="nav-link active" data-bs-toggle="tab">
                                            <i class="ti ti-music me-2"></i>All Assets
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#purchased" class="nav-link" data-bs-toggle="tab">
                                            <i class="ti ti-shopping-cart me-2"></i>Purchased
                                        </a>
                                    </li>
                                    @if (auth()->user()->hasRole('Cover Creator') ||
                                            auth()->user()->hasRole('Artist'))
                                        <li class="nav-item">
                                            <a href="#covers" class="nav-link" data-bs-toggle="tab">
                                                <i class="ti ti-microphone-2 me-2"></i>My Covers
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('Artist'))
                                        <li class="nav-item">
                                            <a href="#releases" class="nav-link" data-bs-toggle="tab">
                                                <i class="ti ti-player-play me-2"></i>Released
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#drafts" class="nav-link" data-bs-toggle="tab">
                                                <i class="ti ti-file me-2"></i>Drafts
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('Composer'))
                                        <li class="nav-item">
                                            <a href="#uploads" class="nav-link" data-bs-toggle="tab">
                                                <i class="ti ti-upload me-2"></i>My Uploads
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="all">
                                        <h4 class="mb-3">All My Assets</h4>

                                        <div class="d-flex mb-3">
                                            <div class="ms-auto">
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-search"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Search assets...">
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <select class="form-select form-select-sm">
                                                    <option value="all">All Types</option>
                                                    <option value="purchased">Purchased</option>
                                                    <option value="covers">Covers</option>
                                                    <option value="releases">Released</option>
                                                    <option value="drafts">Drafts</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-vcenter card-table">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Type</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th class="w-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div class="list-group list-group-flush">
                                                        @foreach ($songs as $songContributor)
                                                            @php
                                                                $coverImages = explode(',', $songContributor->song->cover_image ?? '');
                                                                $smallCoverFile = $coverImages[2] ?? null;
                                                                $filename = $smallCoverFile ? basename($smallCoverFile) : null;
                                                                $imageUrl = $filename ? route('user.songs.image', ['filename' => $filename]) : 'https://via.placeholder.com/40';
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="avatar me-2"
                                                                            style="background-image: url('{{ $imageUrl }}')"></span>
                                                                        <div>
                                                                            <div class="font-weight-medium">
                                                                                {{ $songContributor->song->title }}
                                                                            </div>
                                                                            <div class="text-muted">
                                                                                {{ $songContributor->user->name ?? 'Unknown Artist' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                <td>{{ $songContributor->song->license_type ?? 'N/A' }}
                                                                </td>
                                                                <td>{{ $songContributor->created_at->format('M d, Y') }}
                                                                </td>

                                                                <td>
                                                                    @php

                                                                        $status = $songContributor->song->status ?? 'Draft';
                                                                        $statusClass =
                                                                            [
                                                                                'Active' => 'bg-success',
                                                                                'Pending' => 'bg-warning',
                                                                                'Published' => 'bg-primary',
                                                                                'Draft' => 'bg-secondary',
                                                                            ][$status] ?? 'bg-secondary';
                                                                    @endphp
                                                                    <span
                                                                        class="badge {{ $statusClass }}">{{ $status }}</span>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-list flex-nowrap">
                                                                        <button class="btn btn-icon btn-sm btn-primary"
                                                                            data-bs-toggle="tooltip" title="Play">
                                                                            <a href="{{ route('user.songs.show', $songContributor->song->id) }}"
                                                                                style="color: inherit; text-decoration: none; display: block; width: 100%; height: 100%;">
                                                                                <i class="ti ti-player-play"></i>
                                                                            </a>
                                                                        </button>

                                                                        <div class="dropdown">
                                                                            <button
                                                                                class="btn btn-icon btn-sm btn-ghost-secondary"
                                                                                data-bs-toggle="dropdown">
                                                                                <i class="ti ti-dots-vertical"></i>
                                                                            </button>
                                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                                <a href="{{ route('user.songs.edit', $songContributor->song->id) }}"
                                                                                    class="dropdown-item">
                                                                                    <i class="ti ti-edit me-2"></i>Edit
                                                                                </a>
                                                                                <a href="#" class="dropdown-item">
                                                                                    <i class="ti ti-share me-2"></i>Share
                                                                                </a>
                                                                                <a href="#" class="dropdown-item">
                                                                                    <i
                                                                                        class="ti ti-download me-2"></i>Download
                                                                                </a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a href="javascript:void(0)"
                                                                                    class="dropdown-item text-danger delete-song"
                                                                                    onclick="confirmDelete('{{ $songContributor->song->id }}')"
                                                                                    data-id="{{ $songContributor->song->id }}">
                                                                                    <i class="ti ti-trash me-2"></i>Delete
                                                                                </a>
                                                                                <form
                                                                                    id="delete-song-{{ $songContributor->song->id }}"
                                                                                    action="{{ route('user.songs.destroy', $songContributor->song) }}"
                                                                                    method="POST" style="display: none;">
                                                                                    #
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </div>
                                                    @if ($songs->isEmpty())
                                                        <tr>
                                                            <td colspan="5" class="text-center">Tidak ada lagu yang
                                                                ditemukan.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-flex mt-4">
                                            <ul class="pagination ms-auto">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1"
                                                        aria-disabled="true">
                                                        <i class="ti ti-chevron-left"></i>
                                                        prev
                                                    </a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a>
                                                </li>
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

                                    <div class="tab-pane" id="purchased">
                                        <h4 class="mb-3">Purchased Songs</h4>

                                        <div class="d-flex mb-3">
                                            <div class="ms-auto">
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-search"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Search purchased songs...">
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <select class="form-select form-select-sm">
                                                    <option value="recent">Recently Purchased</option>
                                                    <option value="oldest">Oldest First</option>
                                                    <option value="price-high">Price: High to Low</option>
                                                    <option value="price-low">Price: Low to High</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row row-cards">
                                            @for ($i = 1; $i <= 6; $i++)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card card-sm">
                                                        <a href="#" class="d-block">
                                                            <img src="https://picsum.photos/400/200?random={{ $i + 10 }}"
                                                                class="card-img-top" alt="Song Cover">
                                                        </a>
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <div class="font-weight-medium">Purchased Song
                                                                        {{ $i }}</div>
                                                                    <div class="text-muted">Artist Name
                                                                        {{ $i }}</div>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <span class="badge bg-green-lt">
                                                                        <i class="ti ti-check me-1"></i>Licensed
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3 d-flex">
                                                                <button class="btn btn-sm btn-primary">
                                                                    <i class="ti ti-player-play me-1"></i>Play
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary ms-auto">
                                                                    <i class="ti ti-download me-1"></i>Download
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer text-muted">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <i class="ti ti-calendar me-1"></i>Purchased:
                                                                    {{ now()->subDays(rand(1, 60))->format('M d, Y') }}
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <i class="ti ti-license me-1"></i>Cover License
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>

                                        <div class="d-flex mt-4">
                                            <a href="{{ route('profile.purchased') }}"
                                                class="btn btn-outline-primary ms-auto">
                                                View All Purchased Songs
                                            </a>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="covers">
                                        <h4 class="mb-3">My Cover Songs</h4>

                                        <div class="d-flex mb-3">
                                            <div class="btn-group" role="group">
                                                <input type="radio" class="btn-check" name="cover-filter"
                                                    id="all-covers" checked>
                                                <label class="btn btn-outline-primary" for="all-covers">All</label>

                                                <input type="radio" class="btn-check" name="cover-filter"
                                                    id="published-covers">
                                                <label class="btn btn-outline-primary"
                                                    for="published-covers">Published</label>

                                                <input type="radio" class="btn-check" name="cover-filter"
                                                    id="draft-covers">
                                                <label class="btn btn-outline-primary" for="draft-covers">Drafts</label>
                                            </div>

                                            <div class="ms-auto">
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-search"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Search covers...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-vcenter card-table">
                                                <thead>
                                                    <tr>
                                                        <th>Cover Title</th>
                                                        <th>Original Artist</th>
                                                        <th>Date Created</th>
                                                        <th>Status</th>
                                                        <th>Stats</th>
                                                        <th class="w-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $statuses = ['Published', 'Draft', 'Processing'];
                                                    @endphp

                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="avatar me-2"
                                                                        style="background-image: url(https://picsum.photos/40/40?random={{ $i + 20 }})"></span>
                                                                    <div>
                                                                        <div class="font-weight-medium">Cover of Song
                                                                            {{ $i }}</div>
                                                                        <div class="text-muted">
                                                                            {{ rand(1, 5) }}:{{ sprintf('%02d', rand(0, 59)) }}
                                                                        </div>
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
                                                                <span
                                                                    class="badge {{ $statusClass }}">{{ $status }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ti ti-eye me-1"></i> {{ rand(100, 9999) }}
                                                                    <i class="ti ti-heart ms-2 me-1"></i>
                                                                    {{ rand(10, 999) }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="btn-list flex-nowrap">
                                                                    <button class="btn btn-icon btn-sm btn-primary"
                                                                        data-bs-toggle="tooltip" title="Play">
                                                                        <i class="ti ti-player-play"></i>
                                                                    </button>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-icon btn-sm btn-ghost-secondary"
                                                                            data-bs-toggle="dropdown">
                                                                            <i class="ti ti-dots-vertical"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a href="#" class="dropdown-item">
                                                                                <i class="ti ti-edit me-2"></i>Edit
                                                                            </a>
                                                                            <a href="#" class="dropdown-item">
                                                                                <i class="ti ti-share me-2"></i>Share
                                                                            </a>
                                                                            <a href="#" class="dropdown-item">
                                                                                <i class="ti ti-chart-bar me-2"></i>View
                                                                                Stats
                                                                            </a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a href="#"
                                                                                class="dropdown-item text-danger">
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

                                        <div class="d-flex mt-4">
                                            <a href="{{ route('profile.covers') }}"
                                                class="btn btn-outline-primary ms-auto">
                                                View All My Covers
                                            </a>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="releases">
                                        <h4 class="mb-3">Released Songs</h4>

                                        <div class="d-flex mb-3">
                                            <div class="btn-group" role="group">
                                                <input type="radio" class="btn-check" name="release-filter"
                                                    id="all-releases" checked>
                                                <label class="btn btn-outline-primary" for="all-releases">All</label>

                                                <input type="radio" class="btn-check" name="release-filter"
                                                    id="singles">
                                                <label class="btn btn-outline-primary" for="singles">Singles</label>

                                                <input type="radio" class="btn-check" name="release-filter"
                                                    id="albums">
                                                <label class="btn btn-outline-primary" for="albums">Albums</label>
                                            </div>

                                            <div class="ms-auto">
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-search"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Search releases...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row-cards">
                                            @for ($i = 1; $i <= 6; $i++)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card card-sm">
                                                        <div class="ribbon ribbon-top ribbon-start bg-primary">
                                                            <i class="ti ti-music"></i>
                                                        </div>
                                                        <a href="#" class="d-block">
                                                            <img src="https://picsum.photos/400/200?random={{ $i + 30 }}"
                                                                class="card-img-top" alt="Release Cover">
                                                        </a>
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <div class="font-weight-medium">Released Song
                                                                        {{ $i }}</div>
                                                                    <div class="text-muted">Album:
                                                                        {{ rand(0, 1) ? 'Single' : 'Album Name ' . $i }}
                                                                    </div>
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
                                                                        {{ number_format(rand(1000, 1000000)) }} plays
                                                                    </div>
                                                                    <div class="ms-auto"><i class="ti ti-heart me-1"></i>
                                                                        {{ number_format(rand(100, 10000)) }}</div>
                                                                </div>
                                                                <div class="progress progress-sm">
                                                                    <div class="progress-bar bg-primary"
                                                                        style="width: {{ rand(30, 95) }}%"
                                                                        role="progressbar"></div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3 d-flex">
                                                                <button class="btn btn-sm btn-primary">
                                                                    <i class="ti ti-player-play me-1"></i>Play
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary ms-auto">
                                                                    <i class="ti ti-chart-bar me-1"></i>Stats
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>

                                        <div class="d-flex mt-4">
                                            <a href="{{ route('profile.releases') }}"
                                                class="btn btn-outline-primary ms-auto">
                                                View All Releases
                                            </a>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="drafts">
                                        <h4 class="mb-3">Unreleased Songs (Drafts)</h4>

                                        <div class="d-flex mb-3">
                                            <div class="ms-auto">
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-search"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Search drafts...">
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <select class="form-select form-select-sm">
                                                    <option value="recent">Recently Updated</option>
                                                    <option value="oldest">Oldest First</option>
                                                    <option value="name">Name (A-Z)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="list-group list-group-flush mb-3">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span class="avatar avatar-rounded"
                                                                style="background-image: url(https://picsum.photos/40/40?random={{ $i + 40 }})"></span>
                                                        </div>
                                                        <div class="col text-truncate">
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    <div class="font-weight-medium">Draft Song
                                                                        {{ $i }}</div>
                                                                    <div class="text-muted">Last edited:
                                                                        {{ now()->subDays(rand(1, 14))->format('M d, Y') }}
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <span class="badge bg-yellow-lt">{{ rand(30, 95) }}%
                                                                        Complete</span>
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-sm mt-2">
                                                                <div class="progress-bar bg-yellow"
                                                                    style="width: {{ rand(30, 95) }}%"
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
                                                                    <button class="btn btn-sm btn-ghost-secondary"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="ti ti-dots-vertical"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a href="#" class="dropdown-item">
                                                                            <i class="ti ti-rocket me-2"></i>Publish
                                                                        </a>
                                                                        <a href="#" class="dropdown-item">
                                                                            <i class="ti ti-copy me-2"></i>Duplicate
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#"
                                                                            class="dropdown-item text-danger">
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

                                        <div class="card bg-primary-lt">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div>
                                                        <h3 class="mb-0">Ready to release your music?</h3>
                                                        <p class="text-muted">Complete your drafts and share your music
                                                            with the world.</p>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <button class="btn btn-primary">
                                                            <i class="ti ti-rocket me-2"></i>Publish a Draft
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-4">
                                            <a href="{{ route('profile.drafts') }}"
                                                class="btn btn-outline-primary ms-auto">
                                                View All Drafts
                                            </a>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="uploads">
                                        <h4 class="mb-3">My Uploads (Composer)</h4>

                                        <div class="d-flex mb-3">
                                            <button class="btn btn-primary">
                                                <i class="ti ti-upload me-2"></i>Upload New Song
                                            </button>

                                            <div class="ms-auto">
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-search"></i>
                                                    </span>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Search uploads...">
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <select class="form-select form-select-sm">
                                                    <option value="all">All Status</option>
                                                    <option value="published">Published</option>
                                                    <option value="draft">Draft</option>
                                                    <option value="pending">Pending Review</option>
                                                </select>
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
                                                        <th class="w-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $genres = ['Pop', 'Rock', 'Hip Hop', 'R&B', 'Jazz', 'Electronic', 'Classical'];
                                                        $statuses = ['Published', 'Draft', 'Pending Review'];
                                                        $licenses = ['Standard', 'Premium', 'Exclusive'];
                                                    @endphp

                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="avatar me-2"
                                                                        style="background-image: url(https://picsum.photos/40/40?random={{ $i + 50 }})"></span>
                                                                    <div>
                                                                        <div class="font-weight-medium">Composed Song
                                                                            {{ $i }}</div>
                                                                        <div class="text-muted">
                                                                            {{ rand(1, 5) }}:{{ sprintf('%02d', rand(0, 59)) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $genres[array_rand($genres)] }}</td>
                                                            <td>{{ now()->subDays(rand(1, 60))->format('M d, Y') }}</td>
                                                            <td>
                                                                @php
                                                                    $status = $statuses[array_rand($statuses)];
                                                                    $statusClass = [
                                                                        'Published' => 'bg-success',
                                                                        'Draft' => 'bg-secondary',
                                                                        'Pending Review' => 'bg-warning',
                                                                    ][$status];
                                                                @endphp
                                                                <span
                                                                    class="badge {{ $statusClass }}">{{ $status }}</span>
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
                                                                <span
                                                                    class="badge {{ $licenseClass }}">{{ $license }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <i class="ti ti-eye me-1"></i> {{ rand(100, 9999) }}
                                                                    <i class="ti ti-license ms-2 me-1"></i>
                                                                    {{ rand(0, 50) }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="btn-list flex-nowrap">
                                                                    <button class="btn btn-icon btn-sm btn-primary"
                                                                        data-bs-toggle="tooltip" title="Play">
                                                                        <i class="ti ti-player-play"></i>
                                                                    </button>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-icon btn-sm btn-ghost-secondary"
                                                                            data-bs-toggle="dropdown">
                                                                            <i class="ti ti-dots-vertical"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a href="#" class="dropdown-item">
                                                                                <i class="ti ti-edit me-2"></i>Edit
                                                                            </a>
                                                                            <a href="#" class="dropdown-item">
                                                                                <i class="ti ti-license me-2"></i>Manage
                                                                                License
                                                                            </a>
                                                                            <a href="#" class="dropdown-item">
                                                                                <i class="ti ti-chart-bar me-2"></i>View
                                                                                Stats
                                                                            </a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a href="#"
                                                                                class="dropdown-item text-danger">
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

                                        <div class="d-flex mt-4">
                                            <a href="{{ route('profile.uploads') }}"
                                                class="btn btn-outline-primary ms-auto">
                                                View All Uploads
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Total Plays</div>
                                </div>
                                <div class="h1 mb-3">{{ number_format(rand(5000, 50000)) }}</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            {{ rand(5, 15) }}% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 75%" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Total Assets</div>
                                </div>
                                <div class="h1 mb-3">{{ rand(10, 100) }}</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            {{ rand(3, 12) }}% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 60%" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Revenue</div>
                                </div>
                                <div class="h1 mb-3">Rp {{ number_format(rand(100000, 5000000)) }}</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            {{ rand(8, 20) }}% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 80%" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Followers</div>
                                </div>
                                <div class="h1 mb-3">{{ number_format(rand(100, 5000)) }}</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            {{ rand(5, 25) }}% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 65%" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Recent Activity</h3>
                    </div>
                    <div class="list-group list-group-flush">
                        @php
                            $activities = [
                                [
                                    'icon' => 'ti ti-music',
                                    'color' => 'primary',
                                    'text' => 'You uploaded a new song',
                                    'time' => '10 minutes ago',
                                ],
                                [
                                    'icon' => 'ti ti-license',
                                    'color' => 'success',
                                    'text' => 'Your license was purchased by a user',
                                    'time' => '2 hours ago',
                                ],
                                [
                                    'icon' => 'ti ti-heart',
                                    'color' => 'red',
                                    'text' => 'Someone liked your cover song',
                                    'time' => '5 hours ago',
                                ],
                                [
                                    'icon' => 'ti ti-user-plus',
                                    'color' => 'blue',
                                    'text' => 'You have a new follower',
                                    'time' => 'Yesterday',
                                ],
                                [
                                    'icon' => 'ti ti-coin',
                                    'color' => 'yellow',
                                    'text' => 'You received a royalty payment',
                                    'time' => '2 days ago',
                                ],
                            ];
                        @endphp

                        @foreach ($activities as $activity)
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-{{ $activity['color'] }}-lt">
                                            <i class="{{ $activity['icon'] }} text-{{ $activity['color'] }}"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">{{ $activity['text'] }}</div>
                                        <div class="text-muted">{{ $activity['time'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-sm btn-ghost-secondary">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e53935',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-song-' + id).submit();
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Example of using SweetAlert for a welcome message
            // Uncomment to enable
            /*
            Swal.fire({
                title: 'My Assets',
                text: 'Manage all your music assets in one place',
                icon: 'info',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            */
        });
    </script>
@endsection
