@extends('layouts.app-admin')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Roles Management
                </h2>
                <div class="text-muted mt-1">Manage user roles and their permissions</div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="ti ti-plus"></i>
                        Create new role
                    </a>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                        <i class="ti ti-lock"></i>
                        Manage Permissions
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
                <h3 class="card-title">System Roles</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Guard</th>
                            <th>Permissions</th>
                            <th>Users</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="avatar me-2 bg-{{ ['primary', 'success', 'danger', 'warning', 'info'][array_rand(['primary', 'success', 'danger', 'warning', 'info'])] }}-lt">
                                        <i class="ti ti-shield"></i>
                                    </span>
                                    <div>
                                        <div class="font-weight-medium">{{ $role->name }}</div>
                                        <div class="text-muted">ID: {{ $role->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $role->guard_name }}</td>
                            <td>
                                <div class="d-flex flex-wrap">
                                    @foreach($role->permissions->take(3) as $permission)
                                        <span class="badge bg-blue-lt me-1 mb-1">{{ $permission->name }}</span>
                                    @endforeach
                                    @if($role->permissions->count() > 3)
                                        <span class="badge bg-blue-lt me-1 mb-1">+{{ $role->permissions->count() - 3 }} more</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="avatar-list avatar-list-stacked">
                                    @php
                                        $users = \App\Models\User::role($role->name)->take(5)->get();
                                        $totalUsers = \App\Models\User::role($role->name)->count();
                                    @endphp

                                    @foreach($users as $user)
                                        <span class="avatar avatar-xs rounded" style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=e53935&color=fff)"></span>
                                    @endforeach

                                    @if($totalUsers > 5)
                                        <span class="avatar avatar-xs rounded bg-primary">+{{ $totalUsers - 5 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </a>
                                    @if(!in_array($role->name, ['Super Admin', 'Admin', 'User']))
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $role->id }})">
                                        <i class="ti ti-trash"></i>
                                        Delete
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No roles found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(roleId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone! All users with this role will lose these permissions.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e53935',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Here you would submit a form or make an AJAX request
                // For now, we'll just show a success message

                fetch(`{{ url('/admin/roles') }}/${roleId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content"),
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {

                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: `${data.error}`,
                            showConfirmButton: false,
                        });
                    }
                    if (data.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: `The role "${name}" has been deleted.`,
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    }

                })
                .catch(error => console.error("Error:", error));

            }
        });
    }
</script>

@endsection
@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

