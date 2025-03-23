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
                <form class="card" action="#" method="POST">
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
                            <div class="form-label">Assign Permissions to Role</div>
                            <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                <div class="row g-3">
                                    @foreach($permissions->groupBy(function($item) {
                                        return explode('-', $item->name)[0];
                                    }) as $group => $items)
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">{{ ucfirst($group) }} Management</h4>
                                                    <div class="card-actions">
                                                        <label class="form-check form-switch">
                                                            <input class="form-check-input permission-group" type="checkbox" data-group="{{ $group }}">
                                                            <span class="form-check-label">Select All</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-2">
                                                        @foreach($items as $permission)
                                                            <div class="col-6">
                                                                <label class="form-check">
                                                                    <input class="form-check-input permission-item" type="checkbox" name="permissions[]" value="{{ $permission->id }}" data-group="{{ $group }}">
                                                                    <span class="form-check-label">{{ ucfirst(str_replace(["{$group}-", '-'], ['', ' '], $permission->name)) }}</span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
        // Handle "Select All" checkboxes
        const groupCheckboxes = document.querySelectorAll('.permission-group');
        groupCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const group = this.dataset.group;
                const items = document.querySelectorAll(`.permission-item[data-group="${group}"]`);
                items.forEach(item => {
                    item.checked = this.checked;
                });
            });
        });
        
        // Update group checkbox when individual permissions change
        const permissionItems = document.querySelectorAll('.permission-item');
        permissionItems.forEach(item => {
            item.addEventListener('change', function() {
                const group = this.dataset.group;
                const groupCheckbox = document.querySelector(`.permission-group[data-group="${group}"]`);
                const groupItems = document.querySelectorAll(`.permission-item[data-group="${group}"]`);
                const allChecked = Array.from(groupItems).every(i => i.checked);
                groupCheckbox.checked = allChecked;
            });
        });
    });
</script>
@endsection
