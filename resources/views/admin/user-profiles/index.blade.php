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
                <div class="d-flex">
                    <div class="me-2">
                        <input type="text" class="form-control" placeholder="Search users...">
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="ti ti-filter me-1"></i>Filter
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">All Users</a>
                            <a class="dropdown-item" href="#">Artists</a>
                            <a class="dropdown-item" href="#">Composers</a>
                            <a class="dropdown-item" href="#">Cover Creators</a>
                            <a class="dropdown-item" href="#">Regular Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                            <select class="form-select form-select-sm">
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        entries
                    </div>
                    <div class="ms-auto text-muted">
                        <div class="ms-2 d-inline-block">
                            <select class="form-select form-select-sm">
                                <option value="latest" selected>Latest Registered</option>
                                <option value="oldest">Oldest Registered</option>
                                <option value="name-asc">Name (A-Z)</option>
                                <option value="name-desc">Name (Z-A)</option>
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
                        @for ($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="avatar me-2" style="background-image: url(https://ui-avatars.com/api/?name=User+{{ $i }}&background=e53935&color=fff)"></span>
                                    <div>
                                        <div class="font-weight-medium">User {{ $i }}</div>
                                        <div class="text-muted">user{{ $i }}@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($i % 4 == 0)
                                    <span class="badge bg-purple">Artist</span>
                                @elseif($i % 4 == 1)
                                    <span class="badge bg-blue">Composer</span>
                                @elseif($i % 4 == 2)
                                    <span class="badge bg-green">Cover Creator</span>
                                @else
                                    <span class="badge bg-secondary">Regular User</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-muted">
                                    <span class="badge bg-blue-lt">{{ rand(0, 30) }} Songs</span>
                                    <span class="badge bg-green-lt">{{ rand(0, 15) }} Covers</span>
                                    <span class="badge bg-purple-lt">{{ rand(0, 10) }} Albums</span>
                                </div>
                            </td>
                            <td>
                                @if($i % 3 == 0)
                                    <span class="badge bg-warning text-dark">Pending Verification</span>
                                @elseif($i % 5 == 0)
                                    <span class="badge bg-danger">Suspended</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ date('M d, Y', strtotime('-' . rand(1, 365) . ' days')) }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('admin.user-profiles.show', $i) }}" class="btn btn-sm btn-primary">
                                        <i class="ti ti-eye me-1"></i>View
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#" class="dropdown-item">
                                                <i class="ti ti-edit me-2"></i>Edit
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="ti ti-mail me-2"></i>Send Email
                                            </a>
                                            @if($i % 5 == 0)
                                                <a href="#" class="dropdown-item text-success">
                                                    <i class="ti ti-check me-2"></i>Activate
                                                </a>
                                            @else
                                                <a href="#" class="dropdown-item text-danger">
                                                    <i class="ti ti-ban me-2"></i>Suspend
                                                </a>
                                            @endif
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
                <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of <span>97</span> entries</p>
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
</div>
@endsection
