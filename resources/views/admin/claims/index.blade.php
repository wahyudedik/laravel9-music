@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Claims
                    </h2>
                    <div class="text-muted mt-1">Manage song ownership claims</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.claims.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-plus me-2"></i>
                            New Claim
                        </a>
                        <a href="{{ route('admin.claims.create') }}" class="btn btn-primary d-sm-none btn-icon">
                            <i class="ti ti-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Claims</h3>
                    <div class="card-actions">
                        <form action="{{ route('admin.claims.index') }}" method="GET" class="d-flex">
                            <select name="status" class="form-select me-2" onchange="this.form.submit()">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search claims..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Song</th>
                                <th>Status</th>
                                <th>Document</th>
                                <th>Created</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($claims as $claim)
                                <tr>
                                    <td>{{ $claim->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($claim->user->name) }}&background=e53935&color=fff)"></span>
                                            <div>{{ $claim->user->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $claim->song->title }}</td>
                                    <td>
                                        @if ($claim->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($claim->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($claim->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($claim->document)
                                            <a href="{{ Storage::url($claim->document) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-file-download me-1"></i> View
                                            </a>
                                        @else
                                            <span class="text-muted">No document</span>
                                        @endif
                                    </td>
                                    <td>{{ $claim->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.claims.show', $claim) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="View">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.claims.edit', $claim) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            @if ($claim->status == 'approved')
                                                <button type="button" class="btn btn-sm btn-icon btn-outline-warning"
                                                    onclick="confirmUnclaim({{ $claim->id }})" data-bs-toggle="tooltip"
                                                    title="Unclaim">
                                                    <i class="ti ti-ban"></i>
                                                </button>
                                                <form id="unclaim-form-{{ $claim->id }}"
                                                    action="{{ route('admin.claims.unclaim', $claim) }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                onclick="confirmDelete({{ $claim->id }})" data-bs-toggle="tooltip"
                                                title="Delete">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $claim->id }}"
                                                action="{{ route('admin.claims.destroy', $claim) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="empty">
                                            <div class="empty-img">
                                                <i class="ti ti-ticket text-muted" style="font-size: 4rem;"></i>
                                            </div>
                                            <p class="empty-title">No claims found</p>
                                            <p class="empty-subtitle text-muted">
                                                Try adjusting your search or filter to find what you're looking for.
                                            </p>
                                            <div class="empty-action">
                                                <a href="{{ route('admin.claims.create') }}" class="btn btn-primary">
                                                    <i class="ti ti-plus me-2"></i>Create new claim
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $claims->links() }}
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
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        function confirmUnclaim(id) {
            Swal.fire({
                title: 'Unclaim this song?',
                text: "This will remove the ownership claim from this song",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, unclaim it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('unclaim-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
