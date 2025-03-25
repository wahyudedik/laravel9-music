@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Account</div>
                        <h2 class="page-title">Settings</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <!-- Settings Navigation -->
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="list-group list-group-transparent">
                                    <a href="#profile"
                                        class="list-group-item list-group-item-action d-flex align-items-center active">
                                        <i class="ti ti-user me-2"></i>Profile Settings
                                    </a>
                                    <a href="#account"
                                        class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="ti ti-shield-lock me-2"></i>Account Security
                                    </a>
                                    <a href="#notifications"
                                        class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="ti ti-bell me-2"></i>Notifications
                                    </a>
                                    <a href="#payment"
                                        class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="ti ti-credit-card me-2"></i>Payment Methods
                                    </a>
                                    <a href="#privacy"
                                        class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="ti ti-lock me-2"></i>Privacy & Data
                                    </a>
                                    <a href="#appearance"
                                        class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="ti ti-palette me-2"></i>Appearance
                                    </a>
                                    <a href="#language"
                                        class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="ti ti-language me-2"></i>Language
                                    </a>
                                    <a href="#playback"
                                        class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="ti ti-player-play me-2"></i>Playback
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Content -->
                    <div class="col-md-9">
                        <!-- Profile Settings -->
                        <div class="card mb-4" id="profile">
                            <div class="card-header">
                                <h3 class="card-title">Profile Settings</h3>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar avatar-xl"
                                                style="background-image: url(https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=e53935&color=fff)"></span>
                                        </div>
                                        <div class="col">
                                            <div class="btn-list">
                                                <button type="button" class="btn btn-outline-primary">
                                                    <i class="ti ti-upload me-1"></i>Change Avatar
                                                </button>
                                                <button type="button" class="btn btn-ghost-danger">
                                                    <i class="ti ti-trash me-1"></i>Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" value="{{ auth()->user()->name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Username</label>
                                            <div class="input-group">
                                                <span class="input-group-text">@</span>
                                                <input type="text" class="form-control"
                                                    value="{{ strtolower(str_replace(' ', '', auth()->user()->name)) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" value="{{ auth()->user()->email }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control"
                                            value="{{ auth()->user()->phone ?? '' }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Bio</label>
                                        <textarea class="form-control" rows="4">Music enthusiast and passionate about creating amazing content.</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Social Media Links</label>
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-brand-instagram text-pink"></i>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Instagram username">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-brand-twitter text-blue"></i>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Twitter username">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-brand-youtube text-red"></i>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="YouTube channel">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-brand-tiktok"></i>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        placeholder="TikTok username">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" class="btn btn-ghost-secondary me-2">Cancel</button>
                                        <button type="button" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Account Security -->
                        <div class="card mb-4" id="account">
                            <div class="card-header">
                                <h3 class="card-title">Account Security</h3>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" placeholder="Enter current password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" placeholder="Enter new password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm new password">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Two-Factor Authentication</label>
                                        <div class="form-selectgroup-boxes row mb-3">
                                            <div class="col-lg-6">
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="2fa" value="0"
                                                        class="form-selectgroup-input" checked>
                                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span
                                                                class="form-selectgroup-title strong mb-1">Disabled</span>
                                                            <span class="d-block text-muted">No additional security</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="2fa" value="1"
                                                        class="form-selectgroup-input">
                                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span class="form-selectgroup-title strong mb-1">Enabled</span>
                                                            <span class="d-block text-muted">Additional security via
                                                                app</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" class="btn btn-ghost-secondary me-2">Cancel</button>
                                        <button type="button" class="btn btn-primary">Update Security Settings</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Notification Settings -->
                        <div class="card mb-4" id="notifications">
                            <div class="card-header">
                                <h3 class="card-title">Notification Settings</h3>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Email Notifications</label>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <label class="form-check-label">New followers</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <label class="form-check-label">New song covers</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <label class="form-check-label">License purchases</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Marketing emails</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Push Notifications</label>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <label class="form-check-label">New followers</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <label class="form-check-label">New song covers</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <label class="form-check-label">License purchases</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <label class="form-check-label">New messages</label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" class="btn btn-ghost-secondary me-2">Reset to
                                            Default</button>
                                        <button type="button" class="btn btn-primary">Save Notification Settings</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="card mb-4" id="payment">
                            <div class="card-header">
                                <h3 class="card-title">Payment Methods</h3>
                                <div class="card-actions">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="ti ti-plus me-2"></i>Add New Method
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    @for ($i = 1; $i <= 2; $i++)
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="avatar">
                                                        @if ($i == 1)
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                        @else
                                                            <i class="ti ti-brand-paypal text-blue"></i>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        @if ($i == 1)
                                                            Visa ending in 4242
                                                        @else
                                                            PayPal - {{ auth()->user()->email }}
                                                        @endif
                                                    </div>
                                                    <div class="text-muted">
                                                        @if ($i == 1)
                                                            Expires 04/2025
                                                        @else
                                                            Connected on {{ now()->subMonths(3)->format('M d, Y') }}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="dropdown">
                                                        <button class="btn btn-ghost-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" class="dropdown-item">
                                                                <i class="ti ti-pencil me-2"></i>Edit
                                                            </a>
                                                            <a href="#" class="dropdown-item">
                                                                <i class="ti ti-star me-2"></i>Set as default
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="#" class="dropdown-item text-danger">
                                                                <i class="ti ti-trash me-2"></i>Remove
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <div class="mt-4">
                                    <h4 class="mb-3">Billing Information</h4>
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ auth()->user()->name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Company (Optional)</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" placeholder="Street address">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">ZIP / Postal Code</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Country</label>
                                                <select class="form-select">
                                                    <option value="id" selected>Indonesia</option>
                                                    <option value="us">United States</option>
                                                    <option value="sg">Singapore</option>
                                                    <option value="my">Malaysia</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="button" class="btn btn-ghost-secondary me-2">Cancel</button>
                                            <button type="button" class="btn btn-primary">Save Billing
                                                Information</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Privacy & Data -->
                        <div class="card mb-4" id="privacy">
                            <div class="card-header">
                                <h3 class="card-title">Privacy & Data</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h4>Profile Privacy</h4>
                                    <div class="form-selectgroup mb-3">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="profile-privacy" value="public"
                                                class="form-selectgroup-input" checked>
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-world me-2"></i>Public
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="profile-privacy" value="followers"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-users me-2"></i>Followers Only
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="profile-privacy" value="private"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-lock me-2"></i>Private
                                            </span>
                                        </label>
                                    </div>
                                    <p class="text-muted small">Control who can see your profile and music activities.</p>
                                </div>

                                <div class="mb-4">
                                    <h4>Data Sharing</h4>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Share my listening activity</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Share my playlists publicly</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Allow my data to be used for
                                            recommendations</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Allow third-party analytics</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4>Data Management</h4>
                                    <div class="d-flex mb-3">
                                        <button type="button" class="btn btn-outline-primary me-2">
                                            <i class="ti ti-download me-2"></i>Download My Data
                                        </button>
                                        <button type="button" class="btn btn-outline-danger">
                                            <i class="ti ti-trash me-2"></i>Delete My Account
                                        </button>
                                    </div>
                                    <p class="text-muted small">Download all your data or permanently delete your account
                                        and all associated data.</p>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-ghost-secondary me-2">Cancel</button>
                                    <button type="button" class="btn btn-primary">Save Privacy Settings</button>
                                </div>
                            </div>
                        </div>

                        <!-- Appearance -->
                        <div class="card mb-4" id="appearance">
                            <div class="card-header">
                                <h3 class="card-title">Appearance</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h4>Theme</h4>
                                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="theme" value="light"
                                                class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div>
                                                    <span class="avatar bg-white text-dark me-2">
                                                        <i class="ti ti-sun"></i>
                                                    </span>
                                                    Light Mode
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="theme" value="dark"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div>
                                                    <span class="avatar bg-dark text-white me-2">
                                                        <i class="ti ti-moon"></i>
                                                    </span>
                                                    Dark Mode
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="theme" value="system"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div>
                                                    <span class="avatar bg-blue-lt me-2">
                                                        <i class="ti ti-device-laptop"></i>
                                                    </span>
                                                    System Default
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4>Accent Color</h4>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="accent-color" value="red"
                                                class="form-selectgroup-input" checked>
                                            <span class="form-selectgroup-label">
                                                <span class="avatar bg-red"></span>
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="accent-color" value="blue"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <span class="avatar bg-blue"></span>
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="accent-color" value="green"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <span class="avatar bg-green"></span>
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="accent-color" value="purple"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <span class="avatar bg-purple"></span>
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="accent-color" value="orange"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <span class="avatar bg-orange"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4>Font Size</h4>
                                    <div class="mb-3">
                                        <label class="form-label">Text Size</label>
                                        <input type="range" class="form-range" min="1" max="5"
                                            step="1" value="3">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Small</span>
                                            <span class="text-muted">Default</span>
                                            <span class="text-muted">Large</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-ghost-secondary me-2">Reset to Default</button>
                                    <button type="button" class="btn btn-primary">Save Appearance Settings</button>
                                </div>
                            </div>
                        </div>

                        <!-- Language Settings -->
                        <div class="card mb-4" id="language">
                            <div class="card-header">
                                <h3 class="card-title">Language Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h4>Interface Language</h4>
                                    <div class="mb-3">
                                        <select class="form-select">
                                            <option value="en" selected>English</option>
                                            <option value="id">Bahasa Indonesia</option>
                                            <option value="ja">日本語</option>
                                            <option value="ko">한국어</option>
                                            <option value="zh">中文</option>
                                            <option value="es">Español</option>
                                            <option value="fr">Français</option>
                                            <option value="de">Deutsch</option>
                                        </select>
                                        <div class="form-hint">
                                            This will change the language of the user interface.
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4>Content Language Preferences</h4>
                                    <p class="text-muted mb-3">Select languages for music recommendations and content
                                        discovery.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Primary Content Languages</label>
                                        <select class="form-select" multiple>
                                            <option value="en" selected>English</option>
                                            <option value="id" selected>Bahasa Indonesia</option>
                                            <option value="ja">Japanese</option>
                                            <option value="ko">Korean</option>
                                            <option value="zh">Chinese</option>
                                            <option value="es">Spanish</option>
                                            <option value="fr">French</option>
                                            <option value="de">German</option>
                                        </select>
                                        <div class="form-hint">
                                            Hold Ctrl (or Cmd on Mac) to select multiple languages.
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-ghost-secondary me-2">Reset to Default</button>
                                    <button type="button" class="btn btn-primary">Save Language Settings</button>
                                </div>
                            </div>
                        </div>

                        <!-- Playback Settings -->
                        <div class="card mb-4" id="playback">
                            <div class="card-header">
                                <h3 class="card-title">Playback Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h4>Audio Quality</h4>
                                    <div class="form-selectgroup mb-3">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="audio-quality" value="auto"
                                                class="form-selectgroup-input" checked>
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-adjustments-alt me-2"></i>Auto (Recommended)
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="audio-quality" value="low"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-battery-1 me-2"></i>Low (96 kbps)
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="audio-quality" value="normal"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-battery-2 me-2"></i>Normal (160 kbps)
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="audio-quality" value="high"
                                                class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-battery-3 me-2"></i>High (320 kbps)
                                            </span>
                                        </label>
                                    </div>
                                    <p class="text-muted small">Higher quality uses more data. Auto adjusts based on your
                                        connection.</p>
                                </div>

                                <div class="mb-4">
                                    <h4>Download Settings</h4>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Download over Wi-Fi only</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Download in high quality</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4>Playback Controls</h4>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Crossfade tracks</label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Crossfade duration</label>
                                        <input type="range" class="form-range" min="0" max="12"
                                            step="1" value="2">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">0s</span>
                                            <span class="text-muted">6s</span>
                                            <span class="text-muted">12s</span>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">Normalize volume</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Gapless playback</label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-ghost-secondary me-2">Reset to Default</button>
                                    <button type="button" class="btn btn-primary">Save Playback Settings</button>
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
            // Handle tab navigation with smooth scrolling
            const navLinks = document.querySelectorAll('.list-group-item');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all links
                    navLinks.forEach(item => item.classList.remove('active'));

                    // Add active class to clicked link
                    this.classList.add('active');

                    // Get the target section
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);

                    // Scroll to the target section
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 20,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Handle theme changes
            const themeRadios = document.querySelectorAll('input[name="theme"]');
            themeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const theme = this.value;
                    const body = document.querySelector('body');

                    // Remove existing theme classes
                    body.classList.remove('theme-light', 'theme-dark');

                    // Add selected theme class
                    if (theme === 'dark') {
                        body.classList.add('theme-dark');
                    } else if (theme === 'light') {
                        body.classList.add('theme-light');
                    } else if (theme === 'system') {
                        // Check system preference
                        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)')
                            .matches) {
                            body.classList.add('theme-dark');
                        } else {
                            body.classList.add('theme-light');
                        }
                    }

                    // Show toast notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Theme Updated',
                        text: 'Your theme preference has been updated',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            });

            // Example of showing a success message when saving settings
            const saveButtons = document.querySelectorAll('.btn-primary');

            saveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Simulate saving
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Settings Saved',
                            text: 'Your changes have been saved successfully',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }, 500);
                });
            });
        });
    </script>
@endsection
