@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Notifications
                    </h2>
                    <div class="text-muted mt-1">Manage your system notifications</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" id="markAllRead">
                            <i class="ti ti-check me-2"></i>
                            Mark All as Read
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
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#all" class="nav-link active" data-bs-toggle="tab">
                                        <i class="ti ti-bell me-2"></i>
                                        All
                                        <span class="badge bg-red ms-2">12</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#unread" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-mail me-2"></i>
                                        Unread
                                        <span class="badge bg-red ms-2">5</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#verification" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-check me-2"></i>
                                        Verifications
                                        <span class="badge bg-red ms-2">3</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#system" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-settings me-2"></i>
                                        System
                                        <span class="badge bg-red ms-2">4</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="all">
                                    <div class="list-group list-group-flush">
                                        @php
                                            $notificationTypes = ['verification', 'system', 'user', 'song'];
                                            $notificationStatus = ['unread', 'read'];
                                            $timeAgo = [
                                                '5 minutes ago',
                                                '30 minutes ago',
                                                '1 hour ago',
                                                '3 hours ago',
                                                'Yesterday',
                                                '2 days ago',
                                            ];
                                        @endphp

                                        @for ($i = 0; $i < 12; $i++)
                                            @php
                                                $type = $notificationTypes[array_rand($notificationTypes)];
                                                $status = $notificationStatus[array_rand($notificationStatus)];
                                                $time = $timeAgo[array_rand($timeAgo)];

                                                // Set icon based on type
                                                $icon = match ($type) {
                                                    'verification' => 'ti-check',
                                                    'system' => 'ti-settings',
                                                    'user' => 'ti-user',
                                                    'song' => 'ti-music',
                                                    default => 'ti-bell',
                                                };

                                                // Set color based on type
                                                $color = match ($type) {
                                                    'verification' => 'success',
                                                    'system' => 'info',
                                                    'user' => 'primary',
                                                    'song' => 'warning',
                                                    default => 'secondary',
                                                };

                                                // Set message based on type
                                                $message = match ($type) {
                                                    'verification' => 'New verification request from John Doe',
                                                    'system' => 'System update completed successfully',
                                                    'user' => 'New user registered: Jane Smith',
                                                    'song' => 'New song uploaded: "Amazing Grace"',
                                                    default => 'You have a new notification',
                                                };

                                                // Set detail based on type
                                                $detail = match ($type) {
                                                    'verification' => 'User has requested Artist verification status',
                                                    'system'
                                                        => 'All system components were updated to the latest version',
                                                    'user' => 'A new user has joined the platform',
                                                    'song' => 'The Weeknd uploaded a new song to their collection',
                                                    default => 'Click to view more details about this notification',
                                                };
                                            @endphp

                                            <div class="list-group-item p-3 {{ $status === 'unread' ? 'bg-light' : '' }}">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avatar avatar-rounded bg-{{ $color }}-lt">
                                                            <i class="ti {{ $icon }} text-{{ $color }}"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <div
                                                                    class="text-body d-block {{ $status === 'unread' ? 'fw-bold' : '' }}">
                                                                    {{ $message }}</div>
                                                                <div class="d-block text-muted mt-n1">{{ $detail }}
                                                                </div>
                                                            </div>
                                                            <div class="text-muted">{{ $time }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="dropdown">
                                                            <button class="btn btn-icon btn-ghost-secondary"
                                                                data-bs-toggle="dropdown">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item">
                                                                    <i class="ti ti-eye me-2"></i>View Details
                                                                </a>
                                                                @if ($status === 'unread')
                                                                    <a href="#" class="dropdown-item">
                                                                        <i class="ti ti-check me-2"></i>Mark as Read
                                                                    </a>
                                                                @else
                                                                    <a href="#" class="dropdown-item">
                                                                        <i class="ti ti-mail me-2"></i>Mark as Unread
                                                                    </a>
                                                                @endif
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

                                <div class="tab-pane" id="unread">
                                    <div class="list-group list-group-flush">
                                        @for ($i = 0; $i < 5; $i++)
                                            @php
                                                $type = $notificationTypes[array_rand($notificationTypes)];
                                                $time = $timeAgo[array_rand($timeAgo)];

                                                // Set icon based on type
                                                $icon = match ($type) {
                                                    'verification' => 'ti-check',
                                                    'system' => 'ti-settings',
                                                    'user' => 'ti-user',
                                                    'song' => 'ti-music',
                                                    default => 'ti-bell',
                                                };

                                                // Set color based on type
                                                $color = match ($type) {
                                                    'verification' => 'success',
                                                    'system' => 'info',
                                                    'user' => 'primary',
                                                    'song' => 'warning',
                                                    default => 'secondary',
                                                };

                                                // Set message based on type
                                                $message = match ($type) {
                                                    'verification' => 'New verification request from John Doe',
                                                    'system' => 'System update completed successfully',
                                                    'user' => 'New user registered: Jane Smith',
                                                    'song' => 'New song uploaded: "Amazing Grace"',
                                                    default => 'You have a new notification',
                                                };

                                                // Set detail based on type
                                                $detail = match ($type) {
                                                    'verification' => 'User has requested Artist verification status',
                                                    'system'
                                                        => 'All system components were updated to the latest version',
                                                    'user' => 'A new user has joined the platform',
                                                    'song' => 'The Weeknd uploaded a new song to their collection',
                                                    default => 'Click to view more details about this notification',
                                                };
                                            @endphp

                                            <div class="list-group-item p-3 bg-light">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avatar avatar-rounded bg-{{ $color }}-lt">
                                                            <i class="ti {{ $icon }} text-{{ $color }}"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <div class="text-body d-block fw-bold">{{ $message }}
                                                                </div>
                                                                <div class="d-block text-muted mt-n1">{{ $detail }}
                                                                </div>
                                                            </div>
                                                            <div class="text-muted">{{ $time }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="dropdown">
                                                            <button class="btn btn-icon btn-ghost-secondary"
                                                                data-bs-toggle="dropdown">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item">
                                                                    <i class="ti ti-eye me-2"></i>View Details
                                                                </a>
                                                                <a href="#" class="dropdown-item">
                                                                    <i class="ti ti-check me-2"></i>Mark as Read
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

                                <div class="tab-pane" id="verification">
                                    <div class="list-group list-group-flush">
                                        @for ($i = 0; $i < 3; $i++)
                                            @php
                                                $status = $notificationStatus[array_rand($notificationStatus)];
                                                $time = $timeAgo[array_rand($timeAgo)];
                                                $verificationTypes = ['Artist', 'Composer', 'Cover Creator'];
                                                $verType = $verificationTypes[array_rand($verificationTypes)];
                                                $names = [
                                                    'John Doe',
                                                    'Jane Smith',
                                                    'Mike Johnson',
                                                    'Sarah Williams',
                                                    'Robert Brown',
                                                ];
                                                $name = $names[array_rand($names)];
                                            @endphp

                                            <div class="list-group-item p-3 {{ $status === 'unread' ? 'bg-light' : '' }}">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avatar avatar-rounded bg-success-lt">
                                                            <i class="ti ti-check text-success"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <div
                                                                    class="text-body d-block {{ $status === 'unread' ? 'fw-bold' : '' }}">
                                                                    New {{ $verType }} verification request</div>
                                                                <div class="d-block text-muted mt-n1">{{ $name }}
                                                                    has requested {{ $verType }} verification status
                                                                </div>
                                                            </div>
                                                            <div class="text-muted">{{ $time }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="{{ route('admin.verifications.index') }}"
                                                            class="btn btn-primary btn-sm">
                                                            Review
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="tab-pane" id="system">
                                    <div class="list-group list-group-flush">
                                        @for ($i = 0; $i < 4; $i++)
                                            @php
                                                $status = $notificationStatus[array_rand($notificationStatus)];
                                                $time = $timeAgo[array_rand($timeAgo)];

                                                $systemMessages = [
                                                    'System update completed successfully',
                                                    'Database backup completed',
                                                    'Security alert: Multiple failed login attempts',
                                                    'Storage space is running low (85% used)',
                                                    'New version available: v1.2.0',
                                                ];

                                                $systemDetails = [
                                                    'All system components were updated to the latest version',
                                                    'Automatic database backup has been created and stored',
                                                    'Multiple failed login attempts detected from IP 192.168.1.1',
                                                    'Please consider cleaning up unused files to free up space',
                                                    'A new version is available with bug fixes and new features',
                                                ];

                                                $index = array_rand($systemMessages);
                                                $message = $systemMessages[$index];
                                                $detail = $systemDetails[$index];
                                            @endphp

                                            <div class="list-group-item p-3 {{ $status === 'unread' ? 'bg-light' : '' }}">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avatar avatar-rounded bg-info-lt">
                                                            <i class="ti ti-settings text-info"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <div
                                                                    class="text-body d-block {{ $status === 'unread' ? 'fw-bold' : '' }}">
                                                                    {{ $message }}</div>
                                                                <div class="d-block text-muted mt-n1">{{ $detail }}
                                                                </div>
                                                            </div>
                                                            <div class="text-muted">{{ $time }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="dropdown">
                                                            <button class="btn btn-icon btn-ghost-secondary"
                                                                data-bs-toggle="dropdown">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="#" class="dropdown-item">
                                                                    <i class="ti ti-eye me-2"></i>View Details
                                                                </a>
                                                                @if ($status === 'unread')
                                                                    <a href="#" class="dropdown-item">
                                                                        <i class="ti ti-check me-2"></i>Mark as Read
                                                                    </a>
                                                                @else
                                                                    <a href="#" class="dropdown-item">
                                                                        <i class="ti ti-mail me-2"></i>Mark as Unread
                                                                    </a>
                                                                @endif
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
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Showing <span>1</span> to <span>12</span> of <span>36</span>
                                notifications</p>
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

                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Notification Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h4 class="mb-3">Email Notifications</h4>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="checkbox" name="email-verification" value="1"
                                            class="form-selectgroup-input" checked>
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-medium">Verification Requests</div>
                                                    <div class="text-muted">Receive email notifications for new
                                                        verification requests</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="checkbox" name="email-system" value="1"
                                            class="form-selectgroup-input" checked>
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-medium">System Notifications</div>
                                                    <div class="text-muted">Receive email notifications for system updates
                                                        and alerts</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="checkbox" name="email-users" value="1"
                                            class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-medium">User Activities</div>
                                                    <div class="text-muted">Receive email notifications for new user
                                                        registrations and activities</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="checkbox" name="email-songs" value="1"
                                            class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-medium">Song Updates</div>
                                                    <div class="text-muted">Receive email notifications for new songs and
                                                        updates</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h4 class="mb-3">Push Notifications</h4>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="checkbox" name="push-all" value="1"
                                            class="form-selectgroup-input" checked>
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-medium">Enable Push Notifications</div>
                                                    <div class="text-muted">Receive browser push notifications for
                                                        important updates</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="button" class="btn btn-primary">Save Settings</button>
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
            // Handle mark all as read button
            const markAllReadBtn = document.getElementById('markAllRead');
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // In a real app, you would make an AJAX call to mark all as read
                    // For this demo, we'll just show a success message

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'All notifications marked as read',
                        showConfirmButton: false,
                        timer: 2000,
                        toast: true,
                        position: 'top-end'
                    });

                    // Remove all bg-light classes (which indicate unread)
                    document.querySelectorAll('.list-group-item.bg-light').forEach(item => {
                        item.classList.remove('bg-light');
                    });

                    // Remove all fw-bold classes from notification titles
                    document.querySelectorAll('.text-body.fw-bold').forEach(item => {
                        item.classList.remove('fw-bold');
                    });

                    // Update the badge counts to zero
                    document.querySelectorAll('.badge.bg-red').forEach(badge => {
                        badge.textContent = "0";
                    });
                });
            }

            // Handle individual notification actions
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    const action = this.textContent.trim();
                    const notificationItem = this.closest('.list-group-item');

                    if (action.includes('Mark as Read')) {
                        e.preventDefault();
                        notificationItem.classList.remove('bg-light');
                        notificationItem.querySelector('.text-body').classList.remove('fw-bold');

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Notification marked as read',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            position: 'top-end'
                        });
                    } else if (action.includes('Mark as Unread')) {
                        e.preventDefault();
                        notificationItem.classList.add('bg-light');
                        notificationItem.querySelector('.text-body').classList.add('fw-bold');

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Notification marked as unread',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            position: 'top-end'
                        });
                    } else if (action.includes('Delete')) {
                        e.preventDefault();

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
                                notificationItem.remove();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The notification has been deleted.',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    toast: true,
                                    position: 'top-end'
                                });
                            }
                        });
                    }
                });
            });

            // Handle notification settings save button
            const saveSettingsBtn = document.querySelector('.btn-primary');
            if (saveSettingsBtn) {
                saveSettingsBtn.addEventListener('click', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Settings Saved',
                        text: 'Your notification preferences have been updated',
                        confirmButtonColor: '#e53935',
                    });
                });
            }
        });
    </script>
@endsection
