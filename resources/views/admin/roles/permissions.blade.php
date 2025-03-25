@extends('layouts.app-admin')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Permissions Management
                </h2>
                <div class="text-muted mt-1">Manage system permissions</div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                        <i class="ti ti-shield"></i>
                        Manage Roles
                    </a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-permission">
                        <i class="ti ti-plus"></i>
                        Add Permission
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">System Permissions</h3>
                <div class="card-actions">
                    <form action="{{ route('admin.permissions.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search permissions..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                            <form method="GET" action="{{ route('admin.permissions.index') }}">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <select class="form-select form-select-sm" name="perPage" onchange="this.form.submit()">
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100
                                    </option>
                                </select>
                            </form>
                        </div>
                        entries
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Permission Name</th>
                            <th>Guard</th>
                            <th>Category</th>
                            <th>Assigned To</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="avatar me-2 bg-blue-lt">
                                        <i class="ti ti-lock"></i>
                                    </span>
                                    <div>
                                        <div class="font-weight-medium">{{ $permission->name }}</div>
                                        <div class="text-muted">ID: {{ $permission->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>
                                @php
                                    $category = explode('-', $permission->name)[0];
                                @endphp
                                <span class="badge bg-{{ ['primary', 'success', 'danger', 'warning', 'info'][crc32($category) % 5] }}-lt">
                                    {{ ucfirst($category) }}
                                </span>
                            </td>
                            <td>
                                <div class="avatar-list avatar-list-stacked">
                                    @php
                                        $roles = \Spatie\Permission\Models\Role::permission($permission->name)->take(5)->get();
                                        $totalRoles = \Spatie\Permission\Models\Role::permission($permission->name)->count();
                                    @endphp

                                    @foreach($roles as $role)
                                        <span class="avatar avatar-xs rounded bg-{{ ['primary', 'success', 'danger', 'warning', 'info'][crc32($role->name) % 5] }}-lt" title="{{ $role->name }}">
                                            {{ substr($role->name, 0, 1) }}
                                        </span>
                                    @endforeach

                                    @if($totalRoles > 5)
                                        <span class="avatar avatar-xs rounded bg-primary">+{{ $totalRoles - 5 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn btn-sm btn-outline-primary" onclick="editPermission('{{ $permission->id }}', '{{ $permission->name }}', '{{ $permission->description }}')">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $permission->id }}', '{{ $permission->name }}', '{{ $permission->description }}')">
                                        <i class="ti ti-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No permissions found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</div>

<!-- New Permission Modal -->
<div class="modal modal-blur fade" id="modal-new-permission" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.permissions.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Permission Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g., users-create" required>
                        <small class="form-hint">Use format: "resource-action" (e.g., users-create, posts-edit)</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Guard Name</label>
                        <input type="text" name="guard_name" class="form-control" value="web" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Describe what this permission allows"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <i class="ti ti-plus"></i>
                        Create Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Permission Modal -->
<div class="modal modal-blur fade" id="modal-edit-permission" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="# " method="POST" id="edit-permission-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="permission_id" id="edit-permission-id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Permission Name</label>
                        <input type="text" name="name" id="edit-permission-name" class="form-control" required>
                        <small class="form-hint">Use format: "resource-action" (e.g., users-create, posts-edit)</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Guard Name</label>
                        <input type="text" name="guard_name" class="form-control" value="web" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit-permission-description" rows="3" placeholder="Describe what this permission allows"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <i class="ti ti-check"></i>
                        Update Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var baseUrl = "{{ url('/') }}";
    function editPermission(id, name, description) {
        document.getElementById('edit-permission-id').value = id;
        document.getElementById('edit-permission-name').value = name;
        document.getElementById('edit-permission-description').value = description;
        document.getElementById('edit-permission-form').action = `${baseUrl}/admin/roles/permissions/${id}`;
        // Open the modal
        const modal = new bootstrap.Modal(document.getElementById('modal-edit-permission'));
        modal.show();
    }

    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete the permission "${name}". This may affect users with roles that have this permission.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e53935',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Here you would submit a form or make an AJAX request
                // For now, we'll just show a success message

                fetch(`{{ url('/admin/roles/permissions') }}/${id}`, {
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
                            text: `The permission "${name}" has been deleted.`,
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

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    @endif
</script>

@endsection
@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
