@extends('layouts.app-admin')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Create New Role
                </h2>
                <div class="text-muted mt-1">Define a new role with specific permissions</div>
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
                <form class="card" action="{{route('admin.roles.store')}}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Role Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Role Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter role name" required>
                            <small class="form-hint">Role name should be unique and descriptive (e.g., "Content Editor")</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Guard Name</label>
                            <input type="text" name="guard_name" class="form-control" value="web" readonly>
                            <small class="form-hint">The guard name is set to "web" by default for this application</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter a description of this role and its purpose"></textarea>
                        </div>

                        <div class="hr-text">Permissions</div>

                        <div class="mb-3">
                            {{-- <div class="form-label">Assign Permissions to Role</div> --}}

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Assign Permissions to Role</h4>
                                    <div class="card-actions">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input permission-group" type="checkbox" id="select-all">
                                            <span class="form-check-label">Select All</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        @foreach($permissions->chunk(5) as $permissionGroup)
                                            <div class="col-md-3">
                                                @foreach($permissionGroup as $permission)
                                                    <label class="form-check">
                                                        <input class="form-check-input permission-item" type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}" data-group="permissions">
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
                        <button type="submit" class="btn btn-primary">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('select-all').addEventListener('change', function() {
            document.querySelectorAll('.permission-item').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

    });
</script>
@endsection
