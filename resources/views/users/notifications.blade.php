@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">User Account</div>
                    <h2 class="page-title">Notifications</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" id="markAllAsRead">
                            <i class="ti ti-check me-2"></i>Mark All as Read
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" id="markAllAsReadMobile">
                            <i class="ti ti-check"></i>
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
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#all" class="nav-link active" data-bs-toggle="tab">
                                <i class="ti ti-bell me-2"></i>All
                                <span class="badge bg-red ms-2">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#unread" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-mail me-2"></i>Unread
                                <span class="badge bg-red ms-2">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#important" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-star me-2"></i>Important
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="all">
                            <div class="list-group list-group-flush">
                                @php
                                    $notificationTypes = [
                                        ['icon' => 'ti-music', 'color' => 'red', 'animated' => true],
                                        ['icon' => 'ti-user-plus', 'color' => 'green', 'animated' => false],
                                        ['icon' => 'ti-message', 'color' => 'blue', 'animated' => false],
                                        ['icon' => 'ti-heart', 'color' => 'red', 'animated' => false],
                                        ['icon' => 'ti-star', 'color' => 'yellow', 'animated' => false]
                                    ];
                                    
                                    $messages = [
                                        'New song added to your playlist',
                                        'User started following you',
                                        'New comment on your cover',
                                        'Someone liked your song',
                                        'Your song was featured in trending',
                                        'New album release from your favorite artist',
                                        'Your account has been verified',
                                        'License purchase completed',
                                        'Your cover was approved',
                                        'Payment received for your song'
                                    ];
                                    
                                    $times = [
                                        'Just now',
                                        '5 minutes ago',
                                        '10 minutes ago',
                                        '30 minutes ago',
                                        '1 hour ago',
                                        '2 hours ago',
                                        'Yesterday',
                                        '2 days ago',
                                        'Last week',
                                        '2 weeks ago'
                                    ];
                                @endphp
                                
                                @for ($i = 0; $i < 12; $i++)
                                    @php
                                        $type = $notificationTypes[$i % count($notificationTypes)];
                                        $message = $messages[$i % count($messages)];
                                        $time = $times[$i % count($times)];
                                        $isUnread = $i < 5;
                                    @endphp
                                    <div class="list-group-item {{ $isUnread ? 'bg-light-subtle' : '' }}">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="status-dot status-dot-{{ $type['animated'] ? 'animated' : '' }} bg-{{ $type['color'] }} d-block"></span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar bg-{{ $type['color'] }}-lt">
                                                    <i class="ti {{ $type['icon'] }}"></i>
                                                </span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-body d-block {{ $isUnread ? 'fw-bold' : '' }}">{{ $message }}</a>
                                                <div class="d-block text-muted text-truncate mt-n1">{{ $time }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-icon btn-sm btn-ghost-secondary" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-check me-2"></i>Mark as read
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-star me-2"></i>Mark as important
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-archive me-2"></i>Archive
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" class="dropdown-item text-danger">
                                                            <i class="ti ti-trash me-2"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            
                            <div class="d-flex mt-4">
                                <ul class="pagination ms-auto">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            <i class="ti ti-chevron-left"></i>
                                            prev
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            next
                                            <i class="ti ti-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="unread">
                            <div class="list-group list-group-flush">
                                @for ($i = 0; $i < 5; $i++)
                                    @php
                                        $type = $notificationTypes[$i % count($notificationTypes)];
                                        $message = $messages[$i % count($messages)];
                                        $time = $times[$i % count($times)];
                                    @endphp
                                    <div class="list-group-item bg-light-subtle">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="status-dot status-dot-{{ $type['animated'] ? 'animated' : '' }} bg-{{ $type['color'] }} d-block"></span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar bg-{{ $type['color'] }}-lt">
                                                    <i class="ti {{ $type['icon'] }}"></i>
                                                </span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-body d-block fw-bold">{{ $message }}</a>
                                                <div class="d-block text-muted text-truncate mt-n1">{{ $time }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-icon btn-sm btn-ghost-secondary" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-check me-2"></i>Mark as read
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-star me-2"></i>Mark as important
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-archive me-2"></i>Archive
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" class="dropdown-item text-danger">
                                                            <i class="ti ti-trash me-2"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="important">
                            <div class="empty">
                                <div class="empty-img">
                                    <i class="ti ti-star text-yellow" style="font-size: 4rem;"></i>
                                </div>
                                <p class="empty-title">No important notifications</p>
                                <p class="empty-subtitle text-muted">
                                    You haven't marked any notifications as important yet.
                                </p>
                                <div class="empty-action">
                                    <a href="#all" class="btn btn-primary" data-bs-toggle="tab">
                                        <i class="ti ti-arrow-left me-2"></i>Back to all notifications
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle "Mark All as Read" button click
        document.getElementById('markAllAsRead').addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Mark all as read?',
                text: "All unread notifications will be marked as read",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#e53935',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, mark all'
            }).then((result) => {
                if (result.isConfirmed) {
                    // In a real app, you would make an AJAX call here
                    // For demo, we'll just show a success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'All notifications marked as read',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Remove background from all notification items
                    document.querySelectorAll('.list-group-item.bg-light-subtle').forEach(function(item) {
                        item.classList.remove('bg-light-subtle');
                    });
                    
                    // Remove bold from all notification titles
                    document.querySelectorAll('.list-group-item .fw-bold').forEach(function(item) {
                        item.classList.remove('fw-bold');
                    });
                    
                    // Update the badge counts
                    document.querySelectorAll('.badge.bg-red').forEach(function(badge) {
                        if (badge.closest('a').getAttribute('href') === '#unread') {
                            badge.textContent = '0';
                        }
                    });
                }
            });
        });
        
        // Mobile version of the button
        document.getElementById('markAllAsReadMobile').addEventListener('click', function(e) {
            document.getElementById('markAllAsRead').click();
        });
    });
</script>
@endsection
