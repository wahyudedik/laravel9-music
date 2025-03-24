@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        My Profile
                    </h2>
                    <div class="text-muted mt-1">Manage your account information</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body p-4 text-center">
                            <span class="avatar avatar-xl mb-3 avatar-rounded"
                                style="background-image: url(https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=e53935&color=fff&size=128)"></span>
                            <h3 class="m-0 mb-1">{{ auth()->user()->name }}</h3>
                            <div class="text-muted">{{ ucfirst(auth()->user()->role) }}</div>
                            <div class="mt-3">
                                <span class="badge bg-primary-lt">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="#" class="card-btn" id="changeAvatarBtn">
                                <i class="ti ti-photo me-2"></i>Change Avatar
                            </a>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Account Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <div class="d-flex align-items-center mb-1">
                                    <div class="text-muted me-2">
                                        <i class="ti ti-calendar"></i>
                                    </div>
                                    <div>
                                        <span class="text-body d-block">Member Since</span>
                                        <div class="text-muted">January 15, 2023</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex align-items-center mb-1">
                                    <div class="text-muted me-2">
                                        <i class="ti ti-shield-check"></i>
                                    </div>
                                    <div>
                                        <span class="text-body d-block">Account Status</span>
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex align-items-center mb-1">
                                    <div class="text-muted me-2">
                                        <i class="ti ti-id"></i>
                                    </div>
                                    <div>
                                        <span class="text-body d-block">User ID</span>
                                        <div class="text-muted">USR{{ rand(10000, 99999) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex align-items-center mb-1">
                                    <div class="text-muted me-2">
                                        <i class="ti ti-clock"></i>
                                    </div>
                                    <div>
                                        <span class="text-body d-block">Last Login</span>
                                        <div class="text-muted">Today at 10:23 AM</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#personal" class="nav-link active" data-bs-toggle="tab">
                                        <i class="ti ti-user me-2"></i>
                                        Personal Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#password" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-lock me-2"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#notifications" class="nav-link" data-bs-toggle="tab">
                                        <i class="ti ti-bell me-2"></i>
                                        Notification Preferences
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="personal">
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label required">Full Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ auth()->user()->name }}" placeholder="Your full name">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Email Address</label>
                                                <input type="email" class="form-control"
                                                    value="{{ auth()->user()->email }}" placeholder="Your email address">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" value="+62 812 3456 7890"
                                                    placeholder="Your phone number">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Job Title</label>
                                                <input type="text" class="form-control" value="System Administrator"
                                                    placeholder="Your job title">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Bio</label>
                                            <textarea class="form-control" rows="4" placeholder="Tell us about yourself">Experienced administrator with a passion for music and technology.</textarea>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Country</label>
                                                <select class="form-select">
                                                    <option value="id" selected>Indonesia</option>
                                                    <option value="us">United States</option>
                                                    <option value="sg">Singapore</option>
                                                    <option value="my">Malaysia</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Language</label>
                                                <select class="form-select">
                                                    <option value="en" selected>English</option>
                                                    <option value="id">Indonesian</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" rows="2" placeholder="Your address">Jl. Sudirman No. 123, Jakarta Pusat</textarea>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="password">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label required">Current Password</label>
                                            <input type="password" class="form-control"
                                                placeholder="Your current password">
                                            <small class="form-hint">Enter your current password to confirm your
                                                identity</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">New Password</label>
                                            <input type="password" class="form-control" placeholder="New password">
                                            <small class="form-hint">Password must be at least 8 characters and include
                                                letters, numbers, and special characters</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">Confirm New Password</label>
                                            <input type="password" class="form-control"
                                                placeholder="Confirm new password">
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary">Update Password</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="notifications">
                                    <div class="mb-3">
                                        <h4 class="mb-3">Email Notifications</h4>
                                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
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
                                                            <div class="text-muted">Receive email notifications for system
                                                                updates and alerts</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                            <label class="form-selectgroup-item flex-fill">
                                                <input type="checkbox" name="email-account" value="1"
                                                    class="form-selectgroup-input" checked>
                                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                    <div class="me-3">
                                                        <span class="form-selectgroup-check"></span>
                                                    </div>
                                                    <div class="form-selectgroup-label-content d-flex align-items-center">
                                                        <div>
                                                            <div class="font-weight-medium">Account Security</div>
                                                            <div class="text-muted">Receive email notifications about
                                                                security events</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                            <label class="form-selectgroup-item flex-fill">
                                                <input type="checkbox" name="email-marketing" value="1"
                                                    class="form-selectgroup-input">
                                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                    <div class="me-3">
                                                        <span class="form-selectgroup-check"></span>
                                                    </div>
                                                    <div class="form-selectgroup-label-content d-flex align-items-center">
                                                        <div>
                                                            <div class="font-weight-medium">Marketing</div>
                                                            <div class="text-muted">Receive email updates about new
                                                                features and promotions</div>
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

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">Save Preferences</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Connected Accounts</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <span class="avatar avatar-sm" style="background-color: #1877F2">
                                        <i class="ti ti-brand-facebook text-white"></i>
                                    </span>
                                </div>
                                <div class="me-auto">
                                    <div class="font-weight-medium">Facebook</div>
                                    <div class="text-muted">Not connected</div>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        Connect
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <span class="avatar avatar-sm" style="background-color: #1DA1F2">
                                        <i class="ti ti-brand-twitter text-white"></i>
                                    </span>
                                </div>
                                <div class="me-auto">
                                    <div class="font-weight-medium">Twitter</div>
                                    <div class="text-muted">Connected as @musicadmin</div>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-outline-danger btn-sm">
                                        Disconnect
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <span class="avatar avatar-sm" style="background-color: #EA4335">
                                        <i class="ti ti-brand-google text-white"></i>
                                    </span>
                                </div>
                                <div class="me-auto">
                                    <div class="font-weight-medium">Google</div>
                                    <div class="text-muted">Connected</div>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-outline-danger btn-sm">
                                        Disconnect
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="avatar avatar-sm" style="background-color: #000000">
                                        <i class="ti ti-brand-github text-white"></i>
                                    </span>
                                </div>
                                <div class="me-auto">
                                    <div class="font-weight-medium">GitHub</div>
                                    <div class="text-muted">Not connected</div>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        Connect
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-primary-lt">
                                            <i class="ti ti-login text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body d-block">Logged in from 192.168.1.1</div>
                                        <div class="d-block text-muted mt-n1">Today at 10:23 AM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-success-lt">
                                            <i class="ti ti-check text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body d-block">Approved verification request</div>
                                        <div class="d-block text-muted mt-n1">Yesterday at 3:45 PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-info-lt">
                                            <i class="ti ti-settings text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body d-block">Updated profile information</div>
                                        <div class="d-block text-muted mt-n1">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-warning-lt">
                                            <i class="ti ti-user-plus text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body d-block">Created new user account</div>
                                        <div class="d-block text-muted mt-n1">3 days ago</div>
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
            // Handle avatar change button
            const changeAvatarBtn = document.getElementById('changeAvatarBtn');
            if (changeAvatarBtn) {
                changeAvatarBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Change Profile Picture',
                        html: `
                            <div class="mb-3">
                                <label class="form-label">Upload new image</label>
                                <input type="file" class="form-control" id="avatarUpload" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Or choose from avatars</div>
                                <div class="d-flex justify-content-center gap-3 mt-2">
                                    <div class="avatar avatar-md cursor-pointer" style="background-color: #e53935">
                                        <span class="avatar-text">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <div class="avatar avatar-md cursor-pointer" style="background-color: #4CAF50">
                                        <span class="avatar-text">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <div class="avatar avatar-md cursor-pointer" style="background-color: #2196F3">
                                        <span class="avatar-text">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <div class="avatar avatar-md cursor-pointer" style="background-color: #FF9800">
                                        <span class="avatar-text">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                </div>
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#6c757d',
                        focusConfirm: false,
                        preConfirm: () => {
                            return {
                                file: document.getElementById('avatarUpload').files[0]
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Profile Picture Updated',
                                text: 'Your profile picture has been updated successfully',
                                confirmButtonColor: '#e53935',
                            });
                        }
                    });
                });
            }

            // Handle form submissions
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'success',
                        title: 'Changes Saved',
                        text: 'Your profile has been updated successfully',
                        confirmButtonColor: '#e53935',
                    });
                });
            });
        });
    </script>
@endsection
