@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Role: {{ $role->name }}
                    </h2>
                    <div class="text-muted mt-1">Update role permissions and information</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>
                            Back to roles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <form class="card" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h3 class="card-title">Role Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Role Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $role->name }}"
                                    {{ in_array($role->name, ['Super Admin', 'Admin', 'User']) ? 'readonly' : '' }}
                                    required>
                                @if (in_array($role->name, ['Super Admin', 'Admin', 'User']))
                                    <small class="form-hint text-warning">This is a system role and cannot be
                                        renamed</small>
                                @else
                                    <small class="form-hint">Role name should be unique and descriptive</small>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Guard Name</label>
                                <input type="text" name="guard_name" class="form-control" value="{{ $role->guard_name }}"
                                    readonly>
                                <small class="form-hint">The guard name cannot be changed</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role Description</label>
                                <textarea class="form-control" name="description" rows="3"
                                    placeholder="Enter a description of this role and its purpose">{{ $role->description ?? '' }}</textarea>
                            </div>

                            <div class="hr-text">Permissions</div>

                            <div class="mb-3">

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Assign Permissions to Role</h4>
                                        <div class="card-actions">
                                            <label class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="select-all">
                                                <span class="form-check-label">Select All</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            @foreach ($permissions->chunk(5) as $permissionGroup)
                                                <div class="col-md-3">
                                                    @foreach ($permissionGroup as $permission)
                                                        <label class="form-check">
                                                            <input class="form-check-input permission-item" type="checkbox"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                data-group="permissions"
                                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                            <span class="form-check-label">{{ $permission->name }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Update Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const selectAllCheckbox = document.getElementById('select-all');
            const permissionCheckboxes = document.querySelectorAll('.permission-item');

            selectAllCheckbox.addEventListener('change', function() {
                permissionCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            permissionCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (!this.checked) {
                        selectAllCheckbox.checked = false;
                    }
                });
            });


        });
    </script>
@endsection
