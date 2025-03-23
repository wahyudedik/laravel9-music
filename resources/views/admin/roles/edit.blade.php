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
                <form class="card" action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h3 class="card-title">Role Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Role Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}" {{ in_array($role->name, ['Super Admin', 'Admin', 'User']) ? 'readonly' : '' }} required>
                            @if(in_array($role->name, ['Super Admin', 'Admin', 'User']))
                                <small class="form-hint text-warning">This is a system role and cannot be renamed</small>
                            @else
                                <small class="form-hint">Role name should be unique and descriptive</small>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Guard Name</label>
                            <input type="text" name="guard_name" class="form-control" value="{{ $role->guard_name }}" readonly>
                            <small class="form-hint">The guard name cannot be changed</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Role Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter a description of this role and its purpose">{{ $role->description ?? '' }}</textarea>
                        </div>
                        
                        <div class="hr-text">Permissions</div>
                        
                        <div class="mb-3">
                            <div class="form-label">Manage Role Permissions</div>
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
                                                                    <input class="form-check-input permission-item" type="checkbox" name="permissions[]" value="{{ $permission->id }}" data-group="{{ $group }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
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
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set initial state of group checkboxes
        const groupCheckboxes = document.querySelectorAll('.permission-group');
        groupCheckboxes.forEach(checkbox => {
            const group = checkbox.dataset.group;
            const items = document.querySelectorAll(`.permission-item[data-group="${group}"]`);
            const allChecked = Array.from(items).every(i => i.checked);
            checkbox.checked = allChecked;
            
            // Handle "Select All" checkboxes
            checkbox.addEventListener('change', function() {
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
