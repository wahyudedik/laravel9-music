@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        User Profiles Management
                    </h2>
                    <div class="text-muted mt-1">Manage user profiles and their content</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <!-- Search form -->
                    <form action="{{ route('admin.user-profiles.index') }}" method="GET" class="d-flex">
                        <div class="me-2">
                            <input type="text" class="form-control" name="search" placeholder="Search users..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="ti ti-filter me-1"></i>Filter
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item {{ request('filter') == '' ? 'active' : '' }}"
                                    href="{{ route('admin.user-profiles.index', array_merge(request()->except('filter'), ['filter' => ''])) }}">All
                                    Users</a>
                                <a class="dropdown-item {{ request('filter') == 'artists' ? 'active' : '' }}"
                                    href="{{ route('admin.user-profiles.index', array_merge(request()->except('filter'), ['filter' => 'artists'])) }}">Artists</a>
                                <a class="dropdown-item {{ request('filter') == 'composers' ? 'active' : '' }}"
                                    href="{{ route('admin.user-profiles.index', array_merge(request()->except('filter'), ['filter' => 'composers'])) }}">Composers</a>
                                <a class="dropdown-item {{ request('filter') == 'cover_creators' ? 'active' : '' }}"
                                    href="{{ route('admin.user-profiles.index', array_merge(request()->except('filter'), ['filter' => 'cover_creators'])) }}">Cover
                                    Creators</a>
                                <a class="dropdown-item {{ request('filter') == 'regular_users' ? 'active' : '' }}"
                                    href="{{ route('admin.user-profiles.index', array_merge(request()->except('filter'), ['filter' => 'regular_users'])) }}">Regular
                                    Users</a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ms-2">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <!-- Per page selector -->
                        <div class="text-muted">
                            Show
                            <div class="mx-2 d-inline-block">
                                <select class="form-select form-select-sm" name="per_page"
                                    onchange="window.location.href='{{ route('admin.user-profiles.index') }}?per_page=' + this.value + '{{ request()->has('search') ? '&search=' . request('search') : '' }}{{ request()->has('filter') ? '&filter=' . request('filter') : '' }}{{ request()->has('sort') ? '&sort=' . request('sort') : '' }}'">
                                    <option value="10"
                                        {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10
                                    </option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                            entries
                        </div>
                        <!-- Sort selector -->
                        <div class="ms-auto text-muted">
                            <div class="ms-2 d-inline-block">
                                <select class="form-select form-select-sm" name="sort"
                                    onchange="window.location.href='{{ route('admin.user-profiles.index') }}?sort=' + this.value + '{{ request()->has('search') ? '&search=' . request('search') : '' }}{{ request()->has('filter') ? '&filter=' . request('filter') : '' }}{{ request()->has('per_page') ? '&per_page=' . request('per_page') : '' }}'">
                                    <option value="latest"
                                        {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Latest
                                        Registered</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest
                                        Registered</option>
                                    <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>Name
                                        (A-Z)</option>
                                    <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>Name
                                        (Z-A)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Registered</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://ui-avatars.com/api/?name={{ $user->name }}&background=e53935&color=fff)"></span>
                                            <div>
                                                <div class="font-weight-medium">{{ $user->name }}</div>
                                                <div class="text-muted">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
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
                                    </td>
                                    <td>
                                        <div class="text-muted">
                                            <span class="badge bg-blue-lt">{{ $user->songs_count }} Songs</span>
                                            <span class="badge bg-green-lt">{{ $user->covers_count }} Covers </span>
                                            <span class="badge bg-purple-lt">{{ $user->albums_count }} Albums</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($user->verification)
                                            @if ($user->verification->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending Verification</span>
                                            @elseif ($user->verification->status == 'suspended')
                                                <span class="badge bg-danger">Suspended</span>
                                            @elseif ($user->verification->status == 'approved')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Rejected</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">Not Verified</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ date('M d, Y', strtotime($user->created_at)) }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('admin.user-profiles.show', $user->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="ti ti-eye me-1"></i>View
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-ghost-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#emailModal"
                                                        onclick="setEmailRecipient('{{ $user->name }}', '{{ $user->email }}')">
                                                        <i class="ti ti-mail me-2"></i>Send Email
                                                    </a>

                                                    <form action="{{ route('admin.user-profiles.active', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-success">
                                                            <i class="ti ti-ban me-2"></i>Active
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('admin.user-profiles.suspend', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="ti ti-ban me-2"></i>Suspend
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer d-flex align-items-center">
                        {{ $users->appends(request()->except('page'))->links('pagination.tabler') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Modal -->
    <div class="modal modal-blur fade" id="emailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="emailForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Recipient</label>
                            <input type="text" class="form-control" id="email_recipient" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email_subject">Subject</label>
                            <input type="text" class="form-control" id="email_subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email_body">Message</label>
                            <textarea class="form-control" id="email_body" name="body" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary ms-auto">
                            <i class="ti ti-send me-2"></i>Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function setEmailRecipient(name, email) {
            document.getElementById('email_recipient').value = name + ' <' + email + '>';
        }
    </script>
@endsection
