@extends('layouts.app-admin')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    User Profile
                </h2>
                <div class="text-muted mt-1">User details and information</div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                        <i class="ti ti-arrow-left"></i>
                        Back to users
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="ti ti-edit"></i>
                        Edit User
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=e53935&color=fff&size=128)"></span>
                        <h3 class="m-0 mb-1">{{ $user->name }}</h3>
                        <div class="text-muted">{{ $user->email }}</div>
                        <div class="mt-3">
                            @foreach($user->roles as $role)
                                <span class="badge bg-primary-lt">{{ $role->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="card-btn">
                            <i class="ti ti-edit"></i>
                            Edit
                        </a>
                        <a href="#" class="card-btn" onclick="confirmDelete({{ $user->id }})">
                            <i class="ti ti-trash"></i>
                            Delete
                        </a>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">User Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">User ID</div>
                                <div class="datagrid-content">{{ $user->id }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Email Status</div>
                                <div class="datagrid-content">
                                    @if($user->email_verified_at)
                                        <span class="status status-green">
                                            <span class="status-dot"></span>
                                            Verified
                                        </span>
                                    @else
                                        <span class="status status-yellow">
                                            <span class="status-dot"></span>
                                            Unverified
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Joined</div>
                                <div class="datagrid-content">{{ $user->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Last Updated</div>
                                <div class="datagrid-content">{{ $user->updated_at->format('M d, Y') }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Phone</div>
                                <div class="datagrid-content">{{ $user->phone ?? 'Not set' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Activity</h3>
                    </div>
                    <div class="card-body">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>{{ $user->name }}</strong> created account
                                        </div>
                                        <div class="text-muted">{{ $user->created_at->format('M d, Y H:i') }}</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            @if($user->email_verified_at)
                            <div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>{{ $user->name }}</strong> verified email
                                        </div>
                                        <div class="text-muted">{{ $user->email_verified_at->format('M d, Y H:i') }}</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-success"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Permissions</h3>
                    </div>
                    <div class="card-body">
                        <h4>Role Permissions</h4>
                        <div class="mb-3">
                            @foreach($user->roles as $role)
                                <div class="mb-2">
                                    <h5>{{ $role->name }} Role Permissions:</h5>
                                    <div>
                                        @forelse($role->permissions as $permission)
                                            <span class="badge bg-blue-lt me-1 mb-1">{{ $permission->name }}</span>
                                        @empty
                                            <span class="text-muted">No specific permissions for this role</span>
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <h4>Direct Permissions</h4>
                        <div>
                            @forelse($user->getDirectPermissions() as $permission)
                                <span class="badge bg-green-lt me-1 mb-1">{{ $permission->name }}</span>
                            @empty
                                <span class="text-muted">No direct permissions assigned</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e53935',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Here you would submit a form or make an AJAX request
                // For now, we'll just show a success message
                Swal.fire(
                    'Deleted!',
                    'The user has been deleted.',
                    'success'
                );
            }
        });
    }
</script>
@endsection
