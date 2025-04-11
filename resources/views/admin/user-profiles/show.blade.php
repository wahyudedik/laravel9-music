@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-title">
                        User Profile
                    </div>
                    <h2 class="page-pretitle">
                        {{ $user->name }}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.user-profiles.index') }}"
                            class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to List
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="ti ti-settings me-2"></i>
                                Actions
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#editUserModal">
                                    <i class="ti ti-edit me-2"></i>Edit Profile
                                </a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#emailModal"
                                    onclick="setEmailRecipient('{{ $user->name }}', '{{ $user->email }}')">
                                    <i class="ti ti-mail me-2"></i>Send Email
                                </a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#resetPasswordModal">
                                    <i class="ti ti-key me-2"></i>Reset Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                    data-bs-target="#suspendUserModal">
                                    <i class="ti ti-ban me-2"></i>Suspend Account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <!-- User Info Card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body p-4 text-center">

                            <span class="avatar avatar-xl mb-3 rounded"
                                style="background-image: url({{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=e53935&color=fff' }})">
                            </span>

                            <h3 class="m-0 mb-1">{{ $user->name }}</h3>
                            <div class="text-muted mb-2">{{ $user->email }}</div>

                            <div>
                                @foreach ($user->roles as $role)
                                    @if ($role->name == 'Artist')
                                        <span class="badge bg-purple me-1">Artist</span>
                                    @elseif ($role->name == 'Composer')
                                        <span class="badge bg-blue me-1">Composer</span>
                                    @elseif ($role->name == 'Cover Creator')
                                        <span class="badge bg-green me-1">Cover Creator</span>
                                    @else
                                        <span class="badge bg-secondary me-1">Regular User</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="#" class="card-btn" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                <i class="ti ti-edit me-2"></i>Edit
                            </a>
                            <a href="#" class="card-btn">
                                <i class="ti ti-mail me-2"></i>Email
                            </a>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">User Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="text-muted mb-1">Full Name</div>
                                <div>{{ $user->name }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="text-muted mb-1">Email</div>
                                <div>user{{ $user->email }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="text-muted mb-1">Phone</div>
                                <div>{{ $user->phone }}</div>

                            </div>
                            <div class="mb-3">
                                <div class="text-muted mb-1">Location</div>
                                <div>{{ $user->region }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="text-muted mb-1">Member Since</div>
                                <div>{{ $user->created_at }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="text-muted mb-1">Last Login</div>
                                <div>{{ $user->last_login }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Account Statistics</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="border rounded p-3 text-center">
                                        <div class="h3 m-0">{{ rand(10, 50) }}</div>
                                        <div class="text-muted">Songs</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-3 text-center">
                                        <div class="h3 m-0">{{ rand(5, 30) }}</div>
                                        <div class="text-muted">Covers</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-3 text-center">
                                        <div class="h3 m-0">{{ rand(100, 5000) }}</div>
                                        <div class="text-muted">Streams</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-3 text-center">
                                        <div class="h3 m-0">{{ rand(10, 500) }}</div>
                                        <div class="text-muted">Followers</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Verification Status</h3>
                        </div>
                        <div>
                            @if ($user->verification && $user->verification->status == 'pending')
                                <div class="alert alert-warning">
                                    <div class="d-flex">
                                        <div>
                                            <i class="ti ti-clock me-2"></i>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">Pending Verification</h4>
                                            <div class="text-muted">
                                                This user has a pending verification request as a
                                                @if ($user->roles->isNotEmpty())
                                                    {{ $user->roles->first()->name }}.
                                                @else
                                                    User.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-list mt-3">
                                        <a href="#" class="btn btn-success btn-sm">Approve</a>
                                        <a href="#" class="btn btn-danger btn-sm">Reject</a>
                                    </div>
                                </div>
                            @elseif ($user->verification && $user->verification->status == 'suspended')
                                <div class="alert alert-danger">
                                    <div class="d-flex">
                                        <div>
                                            <i class="ti ti-ban me-2"></i>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">Account Suspended</h4>
                                            <div class="text-muted">This account has been suspended due to policy
                                                violations.</div>
                                        </div>
                                    </div>
                                    <div class="btn-list mt-3">
                                        <a href="#" class="btn btn-success btn-sm">Reactivate Account</a>
                                    </div>
                                </div>
                            @elseif ($user->verification && $user->verification->status == 'active')
                                <div class="alert alert-success">
                                    <div class="d-flex">
                                        <div>
                                            <i class="ti ti-check me-2"></i>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">Verified Account</h4>
                                            <div class="text-muted">
                                                This user has been verified as a
                                                @if ($user->roles->isNotEmpty())
                                                    {{ $user->roles->first()->name }}.
                                                @else
                                                    User.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif(!$user->verification)
                                <div class="alert alert-secondary">
                                    <div class="d-flex">
                                        <div>
                                            <i class="ti ti-alert-triangle me-2"></i>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">Not Verified Account</h4>
                                            <div class="text-muted">
                                                This user has not been verified yet.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Content Tabs -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#songs" class="nav-link active" data-bs-toggle="tab">
                                        <i class="ti ti-music me-2"></i>Songs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#covers" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-microphone me-2"></i>Covers
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#published" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-player-play me-2"></i>Published
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#activity" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-history me-2"></i>Activity
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Songs Tab -->
                                <div class="tab-pane active show" id="songs">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h4 class="card-title">User's Songs</h4>
                                        <div class="d-flex gap-2">
                                            <div class="flex-grow-1">
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <i class="ti ti-search"></i>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Search songs...">
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addSongModal">
                                                <i class="ti ti-plus"></i>
                                                Add Song
                                            </a>
                                        </div>
                                    </div>

                                    <table class="table table-vcenter card-table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Genre</th>
                                                <th>Duration</th>
                                                <th>Uploaded</th>
                                                <th>Status</th>
                                                <th class="w-1">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($songs as $song)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="avatar me-2"
                                                                style="background-image: url(https://picsum.photos/40/40?random={{ $song->id }})"></span>
                                                            <div>{{ $song->title }}</div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $song->genre }}</td>
                                                    <td>{{ $song->duration }}</td>
                                                    <td>{{ $song->created_at }}</td>
                                                    <td>{{ $song->status }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-icon btn-ghost-secondary"
                                                                data-bs-toggle="dropdown">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item"
                                                                    data-bs-toggle="modal" data-bs-target="#editSongModal"
                                                                    data-song-id="{{ $song->id }}">
                                                                    <i class="ti ti-edit me-2"></i>Edit
                                                                </a>
                                                                <a href="#" class="dropdown-item">
                                                                    <i class="ti ti-player-play me-2"></i>Preview
                                                                </a>
                                                                @if ($loop->index % 3 != 1)
                                                                    <a href="#" class="dropdown-item text-success">
                                                                        <i class="ti ti-check me-2"></i>Publish
                                                                    </a>
                                                                @endif
                                                                <a href="#" class="dropdown-item text-danger">
                                                                    <i class="ti ti-trash me-2"></i>Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Covers Tab -->
                                <div class="tab-pane" id="covers">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h4 class="card-title">User's Covers</h4>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <select class="form-select">
                                                    <option value="">All Genres</option>
                                                    <option value="pop">Pop</option>
                                                    <option value="rock">Rock</option>
                                                    <option value="hiphop">Hip Hop</option>
                                                    <option value="electronic">Electronic</option>
                                                    <option value="jazz">Jazz</option>
                                                </select>
                                            </div>
                                            <a href="#" class="btn btn-primary">
                                                <i class="ti ti-plus me-2"></i>Add Cover
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row row-cards">
                                        @foreach ($covers as $cover)
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="card card-sm">
                                                    <a href="#" class="d-block">
                                                        <img src="https://picsum.photos/400/300?random={{ $cover->id }}"
                                                            class="card-img-top">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                style="background-image: url(https://ui-avatars.com/api/?name={{ $user->name }}&background=e53935&color=fff)"></span>
                                                            <div>
                                                                <div>Cover of "{{ $cover->title }}"</div>
                                                                <div class="text-muted">Original by
                                                                    {{ $cover->cover_version }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center mt-3">
                                                            <div>
                                                                <div class="text-muted">
                                                                    <i class="ti ti-eye me-1"></i> {{ rand(100, 9999) }}
                                                                    <i class="ti ti-thumb-up ms-2 me-1"></i>
                                                                    {{ rand(10, 999) }}
                                                                </div>
                                                            </div>
                                                            <div class="ms-auto">
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
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Published Tab -->
                                <div class="tab-pane" id="published">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h4 class="card-title">Published Content</h4>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-primary active">All</button>
                                            <button type="button" class="btn btn-outline-primary">Songs</button>
                                            <button type="button" class="btn btn-outline-primary">Covers</button>
                                            <button type="button" class="btn btn-outline-primary">Albums</button>
                                        </div>
                                    </div>


                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Content</th>
                                                    <th>Type</th>
                                                    <th>Published</th>
                                                    <th>Stats</th>
                                                    <th class="w-1">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($publishedSongs as $publish)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <span class="avatar me-2"
                                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $publish->id }})"></span>
                                                                <div>
                                                                    @if ($publish->artist_id == $user->id)
                                                                        {{ $publish->title }}
                                                                    @elseif ($publish->cover_creator_id == $user->id)
                                                                        {{ $publish->cover_version }}
                                                                        <br>
                                                                        Original by {{ $publish->title }}
                                                                    @elseif (in_array($publish->album_id, $albums->pluck('id')->toArray()))
                                                                        {{ $albums->where('id', $publish->album_id)->first()->title }}
                                                                    @else
                                                                        {{ $publish->title }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($publish->artist_id == $user->id)
                                                                <span class="badge bg-blue">Song</span>
                                                            @elseif ($publish->cover_creator_id == $user->id)
                                                                <span class="badge bg-green">Cover</span>
                                                            @elseif (in_array($publish->album_id, $albums->pluck('id')->toArray()))
                                                                <span class="badge bg-purple">Album</span>
                                                            @endif
                                                        </td>

                                                        </td>
                                                        <td>{{ date('M d, Y', strtotime($publish->created_at)) }}</td>
                                                        <td>{{ $publish->status }}</td>

                                                        <td>
                                                            <div class="text-muted">
                                                                <i class="ti ti-eye me-1"></i>
                                                                {{ number_format(rand(100, 50000)) }}
                                                                <i class="ti ti-thumb-up ms-2 me-1"></i>
                                                                {{ number_format(rand(10, 5000)) }}
                                                            </div>
                                                        </td>
                                                        </td>
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
                                                                    <a href="#" class="dropdown-item text-warning">
                                                                        <i class="ti ti-eye-off me-2"></i>Unpublish
                                                                    </a>
                                                                    <a href="#" class="dropdown-item text-danger">
                                                                        <i class="ti ti-trash me-2"></i>Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="activity">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h4 class="card-title">Recent Activity</h4>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-primary active">All</button>
                                            <button type="button" class="btn btn-outline-primary">Content</button>
                                            <button type="button" class="btn btn-outline-primary">Login</button>
                                            <button type="button" class="btn btn-outline-primary">Payments</button>
                                        </div>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        @forelse ($activities as $activity)
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        @php
                                                            $iconMap = [
                                                                'login' => [
                                                                    'icon' => 'ti ti-login',
                                                                    'color' => 'bg-info-lt',
                                                                ],
                                                                'logout' => [
                                                                    'icon' => 'ti ti-logout',
                                                                    'color' => 'bg-warning-lt',
                                                                ],
                                                                'created' => [
                                                                    'icon' => 'ti ti-plus',
                                                                    'color' => 'bg-success-lt',
                                                                ],
                                                                'updated' => [
                                                                    'icon' => 'ti ti-pencil',
                                                                    'color' => 'bg-primary-lt',
                                                                ],
                                                                'update_profile' => [
                                                                    'icon' => 'ti ti-pencil',
                                                                    'color' => 'bg-primary-lt',
                                                                ],
                                                                'update_profile_picture' => [
                                                                    'icon' => 'ti ti-pencil',
                                                                    'color' => 'bg-primary-lt',
                                                                ],
                                                                'deleted' => [
                                                                    'icon' => 'ti ti-trash',
                                                                    'color' => 'bg-danger-lt',
                                                                ],
                                                                'remove_profile_picture' => [
                                                                    'icon' => 'ti ti-trash',
                                                                    'color' => 'bg-danger-lt',
                                                                ],
                                                                'uploaded' => [
                                                                    'icon' => 'ti ti-upload',
                                                                    'color' => 'bg-primary-lt',
                                                                ],
                                                                'payment_processed' => [
                                                                    'icon' => 'ti ti-credit-card',
                                                                    'color' => 'bg-warning-lt',
                                                                ],
                                                                'suspend_user' => [
                                                                    'icon' => 'ti ti-user-x',
                                                                    'color' => 'bg-warning-lt',
                                                                ],
                                                                'suspend_verification' => [
                                                                    'icon' => 'ti ti-user-x',
                                                                    'color' => 'bg-warning-lt',
                                                                ],
                                                                'active_verification' => [
                                                                    'icon' => 'ti ti-user-check',
                                                                    'color' => 'bg-success-lt',
                                                                ],
                                                            ];

                                                            $icon =
                                                                $iconMap[$activity->event]['icon'] ?? 'ti ti-activity';
                                                            $bgColor =
                                                                $iconMap[$activity->event]['color'] ??
                                                                'bg-secondary-lt';
                                                        @endphp

                                                        <div class="avatar avatar-rounded {{ $bgColor }}">
                                                            <i
                                                                class="{{ $icon }} text-{{ str_replace('-lt', '', $bgColor) }}"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-body">
                                                            {{ $activity->description }}
                                                            @if ($activity->subjectUser)
                                                                ({{ $activity->subjectUser->name }})
                                                            @endif
                                                        </div>
                                                        <div class="text-muted">
                                                            {{ $activity->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="dropdown">
                                                            <button class="btn btn-icon btn-ghost-secondary"
                                                                title="Options" aria-label="Options"
                                                                data-bs-toggle="dropdown">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewDetailsModal"
                                                                    onclick="setActivityDetail({{ $activity }})">
                                                                    <i class="ti ti-eye me-2"></i>View Details
                                                                </button>
                                                                {{-- <button class="dropdown-item text-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteActivityModal"
                                                                    onclick="setDeleteData({{ $activity->id }}, '{{ $activity->description }}')">
                                                                    <i class="ti ti-trash me-2"></i>Delete Record
                                                                </button> --}}
                                                                <button class="dropdown-item text-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteActivityModal"
                                                                    data-id="{{ $activity->id }}"
                                                                    data-description="{{ $activity->description }}"
                                                                    onclick="setDeleteData(this)">
                                                                    <i class="ti ti-trash me-2"></i>Delete Record
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="list-group-item">
                                                <div class="text-center text-muted">No activity recorded.</div>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit User Modal -->

                <div class="modal modal-blur fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit User Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('admin.user-profiles.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <div class="col-lg-3 text-center">
                                            <div class="mb-3">

                                                <span class="avatar avatar-xl mb-3 rounded"
                                                    style="background-image: url({{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=e53935&color=fff' }})">
                                                </span>

                                                <div>

                                                    <a href="#" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#changeProfilePictureModal">Change</a>

                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                        onclick="removeProfilePicture(event)">Remove</a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control" name="first_name"
                                                            value="{{ explode(' ', $user->name)[0] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            value="{{ isset(explode(' ', $user->name)[1]) ? implode(' ', array_slice(explode(' ', $user->name), 1)) : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone</label>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ $user->phone }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-text">Account Information</div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username"
                                                    value="{{ $user->username }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Role</label>
                                                <select name="role" class="form-select">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="approved"
                                                        {{ $user->verification && $user->verification->status == 'approved' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="suspended"
                                                        {{ $user->verification && $user->verification->status == 'suspended' ? 'selected' : '' }}>
                                                        Suspended</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Verification</label>
                                                <select name="verification" class="form-select">
                                                    <option value="approved"
                                                        {{ $user->verification && $user->verification->status == 'approved' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="suspended"
                                                        {{ $user->verification && $user->verification->status == 'suspended' ? 'selected' : '' }}>
                                                        Suspended</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-text">Additional Information</div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Location</label>
                                                <input type="text" class="form-control" name="location"
                                                    value="{{ $user->region }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Website</label>
                                                <input type="text" class="form-control" name="website"
                                                    value="{{ $socialMedia->first() ? $socialMedia->first()->url : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Bio</label>
                                                <textarea class="form-control" name="bio" rows="3">{{ $userProfile->first() ? $userProfile->first()->bio : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary ms-auto">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="changeProfilePictureModal" tabindex="-1"
                    aria-labelledby="changeProfilePictureModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changeProfilePictureModalLabel">Change Profile Picture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.user-profiles.update-picture', $user->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="profile_picture" class="form-label">Upload New Picture</label>
                                        <input type="file" class="form-control" id="profile_picture"
                                            name="profile_picture" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suspend User Modal -->
                <div class="modal modal-blur fade" id="suspendUserModal" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-title">Are you sure?</div>
                                <div>You are about to suspend this user account. The user will not be able to log in or use
                                    any features until the account is reactivated.</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary me-auto"
                                    data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.user-profiles.suspend', $user->id) }}" method="POST"
                                    id="suspendForm">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="ti ti-ban me-2"></i>Yes, suspend
                                        account
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Song Modal -->
                <div class="modal modal-blur fade" id="addSongModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Song</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Song Title</label>
                                    <input type="text" class="form-control" placeholder="Enter song title">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Genre</label>
                                            <select class="form-select">
                                                <option value="">Select Genre</option>
                                                <option value="pop">Pop</option>
                                                <option value="rock">Rock</option>
                                                <option value="hiphop">Hip Hop</option>
                                                <option value="electronic">Electronic</option>
                                                <option value="jazz">Jazz</option>
                                                <option value="classical">Classical</option>
                                                <option value="country">Country</option>
                                                <option value="rnb">R&B</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Album (Optional)</label>
                                            <select class="form-select">
                                                <option value="">Select Album</option>
                                                <option value="album1">Album 1</option>
                                                <option value="album2">Album 2</option>
                                                <option value="album3">Album 3</option>
                                                <option value="new">Create New Album...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Song File</label>
                                    <input type="file" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cover Image</label>
                                    <input type="file" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Release Date</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter song description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lyrics (Optional)</label>
                                    <textarea class="form-control" rows="5" placeholder="Enter song lyrics"></textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Status</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" value="draft"
                                                checked>
                                            <span class="form-check-label">Draft</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                value="published">
                                            <span class="form-check-label">Published</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                value="scheduled">
                                            <span class="form-check-label">Schedule Release</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary ms-auto">Add Song</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal View Details --}}
                <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Aktivitas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Deskripsi :</strong> <span id="detailDescription"></span></p>
                                <p><strong>Event :</strong> <span id="detailEvent"></span></p>
                                <p><strong>Dilakukan oleh :</strong> <span id="detailCauser"></span></p>
                                <p><strong>Kepada :</strong> <span id="detailSubject"></span></p>
                                <p><strong>Dibuat pada :</strong> <span id="detailCreatedAt"></span></p>
                                <p><strong>Diperbarui pada :</strong> <span id="detailUpdatedAt"></span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Delete Confirmation --}}
                <div class="modal fade" id="deleteActivityModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this activity record?
                                    <p class="text-muted small" id="deleteDescription"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Email modal --}}
                <div class="modal modal-blur fade" id="emailModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content shadow-lg rounded-4">
                            <div class="modal-header">
                                <h5 class="modal-title">Send Email</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="emailForm" action="{{ route('admin.send.email') }}" method="POST">
                                @csrf
                                <div class="modal-body p-4">
                                    <div id="emailAlert" class="alert alert-success d-none" role="alert"></div>
                                    <input type="hidden" name="recipient" id="recipient_email">

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Recipient</label>
                                        <input type="text" class="form-control" id="email_recipient" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold" for="email_subject">Subject</label>
                                        <input type="text" class="form-control" id="email_subject" name="subject"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold" for="email_body">Message</label>
                                        <textarea class="form-control" id="email_body" name="body" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 px-4 pb-4">
                                    <button type="submit" class="btn btn-primary ms-auto" id="sendEmailBtn">
                                        <i class="ti ti-send me-2"></i>Send Email
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Edit Song Modal -->
                <div class="modal modal-blur fade" id="editSongModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Song</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('profile.songs.update', $song->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Song Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="#">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="genre" class="form-label">Genre</label>
                                                <select class="form-select" id="genre" name="genre" required>
                                                    <option value="">Pilih Genre</option>
                                                    {{-- <option value="pop" {{ $song->genre === 'pop' ? 'selected' : '' }}>
                                                        Pop</option>
                                                    <option value="rock"
                                                        {{ $song->genre === 'rock' ? 'selected' : '' }}>Rock</option>
                                                    <option value="hiphop"
                                                        {{ $song->genre === 'hiphop' ? 'selected' : '' }}>Hip Hop
                                                    </option>
                                                    <option value="electronic"
                                                        {{ $song->genre === 'electronic' ? 'selected' : '' }}>
                                                        Electronic
                                                    </option>
                                                    <option value="jazz"
                                                        {{ $song->genre === 'jazz' ? 'selected' : '' }}>Jazz</option>
                                                    <option value="classical"
                                                        {{ $song->genre === 'classical' ? 'selected' : '' }}>Classical
                                                    </option>
                                                    <option value="country"
                                                        {{ $song->genre === 'country' ? 'selected' : '' }}>Country
                                                    </option>
                                                    <option value="rnb" {{ $song->genre === 'rnb' ? 'selected' : '' }}>
                                                        R&B</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Album (Optional)</label>
                                                <select class="form-select">
                                                    <option value="">Select Album</option>
                                                    <option value="album1" selected>Album 1</option>
                                                    <option value="album2">Album 2</option>
                                                    <option value="album3">Album 3</option>
                                                    <option value="new">Create New Album...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="form-label mb-0 me-auto">Current Song File</label>
                                            <a href="#" class="text-muted">
                                                <i class="ti ti-player-play me-1"></i>Preview
                                            </a>
                                        </div>
                                        <div class="form-control-plaintext">song_file_1.mp3</div>
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" id="replace-song">
                                            <label class="form-check-label" for="replace-song">
                                                Replace song file
                                            </label>
                                        </div>
                                        <input type="file" class="form-control mt-2" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="form-label mb-0 me-auto">Current Cover Image</label>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <img src="https://picsum.photos/100/100?random=1" class="rounded me-3"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="replace-cover">
                                                <label class="form-check-label" for="replace-cover">
                                                    Replace cover image
                                                </label>
                                            </div>
                                        </div>
                                        <input type="file" class="form-control mt-2" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Release Date</label>
                                        <input type="date" class="form-control"
                                            value="{{ date('Y-m-d', strtotime('-5 days')) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="3">This is a sample description for Song Title 1. It was released on {{ date('F d, Y', strtotime('-5 days')) }} and has been gaining popularity since then.</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Lyrics (Optional)</label>
                                        <textarea class="form-control" rows="5">These are sample lyrics for Song Title 1.
Verse 1:
Lorem ipsum dolor sit amet
Consectetur adipiscing elit
Sed do eiusmod tempor incididunt

Chorus:
Ut labore et dolore magna aliqua
Ut enim ad minim veniam
Quis nostrud exercitation ullamco</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-label">Status</div>
                                        <div>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="edit-status"
                                                    value="draft">
                                                <span class="form-check-label">Draft</span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="edit-status"
                                                    value="published" checked>
                                                <span class="form-check-label">Published</span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="edit-status"
                                                    value="scheduled">
                                                <span class="form-check-label">Schedule Release</span>
                                            </label>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary ms-auto">Save Changes</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reset Password Modal -->
                <div class="modal modal-blur fade" id="resetPasswordModal" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content shadow-lg rounded-4">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="#" method="POST">
                                @csrf
                                <div class="modal-body p-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">User</label>
                                        <input type="text" class="form-control"
                                            value="{{ $user->name }} ({{ $user->email }})" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold" for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="password"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold" for="password_confirmation">Confirm
                                            Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="send_notification"
                                            name="send_notification" checked>
                                        <label class="form-check-label" for="send_notification">
                                            Send password reset notification to user
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 px-4 pb-4">
                                    <button type="button" class="btn btn-link link-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        <i class="ti ti-key me-2"></i>Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection

            @section('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Toggle file upload when replace checkbox is checked
                        const replaceCheckboxes = document.querySelectorAll('#replace-song, #replace-cover');
                        replaceCheckboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function() {
                                const fileInput = this.closest('.mb-3').querySelector('input[type="file"]');
                                fileInput.disabled = !this.checked;
                            });
                        });

                        // Confirm delete action
                        window.confirmDelete = function(id) {
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
                                    Swal.fire(
                                        'Deleted!',
                                        'The song has been deleted.',
                                        'success'
                                    );
                                }
                            });
                        };
                    });

                    function removeProfilePicture(event) {
                        event.preventDefault();

                        if (confirm("Apakah Anda yakin ingin menghapus foto profil?")) {
                            fetch("{{ route('admin.user-profiles.remove-picture', ['id' => $user->id]) }}", {
                                    method: "DELETE",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    }
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert("Foto profil berhasil dihapus!");
                                        location.reload();
                                    } else {
                                        alert("Gagal menghapus foto profil.");
                                    }
                                }).catch(error => {
                                    console.error("Error:", error);
                                    alert("Terjadi kesalahan saat menghapus foto profil.");
                                });
                        }
                    }


                    function formatDateIndo(isoString) {
                        if (!isoString) return '-';
                        const date = new Date(isoString);
                        return date.toLocaleString("id-ID", {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            timeZone: 'Asia/Jakarta'
                        });
                    }

                    function setActivityDetail(activity) {
                        document.getElementById('detailDescription').innerText = activity.description || '-';
                        document.getElementById('detailEvent').innerText = activity.event || '-';

                        document.getElementById('detailCauser').innerText = activity.causer_user.name || '-';

                        if (activity.subject_user) {
                            document.getElementById('detailSubject').innerText =
                                `${activity.subject_user.name}`;
                        } else {
                            document.getElementById('detailSubject').innerText = activity.subject_id ?? '-';
                        }

                        document.getElementById('detailCreatedAt').innerText = formatDateIndo(activity.created_at);
                        document.getElementById('detailUpdatedAt').innerText = formatDateIndo(activity.updated_at);
                    }


                    function setDeleteData(button) {
                        const activityId = button.getAttribute('data-id'); // ambil ID dari tombol
                        const description = button.getAttribute('data-description'); // opsional kalau mau tampilkan

                        console.log("Activity ID:", activityId);
                        console.log("Description:", description);

                        if (activityId) {
                            const form = document.getElementById('deleteForm');
                            form.action = `/admin/activities/${activityId}`;
                            console.log("Form action set to:", form.action);
                        }

                        // Jika pakai deskripsi di modal
                        const descElem = document.getElementById('deleteDescription');
                        if (descElem) {
                            descElem.innerText = description || '';
                        }
                    }

                    function setEmailRecipient(name, email) {
                        document.getElementById('email_recipient').value = name + ' <' + email + '>';
                        document.getElementById('recipient_email').value = email;
                    }
                </script>
            @endsection
