@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Settings
                    </h2>
                    <div class="text-muted mt-1">Configure your application settings</div>
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
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <span class="avatar avatar-sm" style="background-image: url({{ asset('img/favicon.png') }})"></span>
                                </div>
                                <div>
                                    <div class="font-weight-medium">Playlist Music</div>
                                    <div class="text-muted">v1.0.0</div>
                                </div>
                            </div>
                            <div class="list-group list-group-transparent">
                                <a href="#general" class="list-group-item list-group-item-action d-flex align-items-center active" data-bs-toggle="scroll">
                                    <i class="ti ti-settings me-2"></i>
                                    General
                                </a>
                                <a href="#appearance" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="scroll">
                                    <i class="ti ti-palette me-2"></i>
                                    Appearance
                                </a>
                                <a href="#notifications" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="scroll">
                                    <i class="ti ti-bell me-2"></i>
                                    Notifications
                                </a>
                                <a href="#security" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="scroll">
                                    <i class="ti ti-shield-lock me-2"></i>
                                    Security
                                </a>
                                <a href="#integrations" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="scroll">
                                    <i class="ti ti-plug me-2"></i>
                                    Integrations
                                </a>
                                <a href="#backup" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="scroll">
                                    <i class="ti ti-cloud-upload me-2"></i>
                                    Backup & Export
                                </a>
                                <a href="#advanced" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="scroll">
                                    <i class="ti ti-adjustments-horizontal me-2"></i>
                                    Advanced
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <div class="card" id="general">
                        <div class="card-header">
                            <h3 class="card-title">General Settings</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Site Name</label>
                                    <input type="text" class="form-control" value="Playlist Music" placeholder="Your site name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Site Description</label>
                                    <textarea class="form-control" rows="2">A platform for music lovers, artists, and composers to share and discover music.</textarea>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Admin Email</label>
                                        <input type="email" class="form-control" value="admin@playlistmusic.com" placeholder="Admin email address">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Support Email</label>
                                        <input type="email" class="form-control" value="support@playlistmusic.com" placeholder="Support email address">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Default Language</label>
                                        <select class="form-select">
                                            <option value="en" selected>English</option>
                                            <option value="id">Indonesian</option>
                                            <option value="es">Spanish</option>
                                            <option value="fr">French</option>
                                        </select>
                                    </div>
                                                                        <div class="col-md-6">
                                        <label class="form-label">Default Timezone</label>
                                        <select class="form-select">
                                            <option value="UTC" selected>UTC</option>
                                            <option value="Asia/Jakarta">Asia/Jakarta (GMT+7)</option>
                                            <option value="America/New_York">America/New_York (GMT-5)</option>
                                            <option value="Europe/London">Europe/London (GMT+0)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <span class="form-check-label">Enable user registration</span>
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <span class="form-check-label">Require email verification</span>
                                    </label>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3" id="appearance">
                        <div class="card-header">
                            <h3 class="card-title">Appearance Settings</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Theme Mode</label>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="theme-mode" value="light" class="form-selectgroup-input" checked>
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-sun me-2"></i>Light
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="theme-mode" value="dark" class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-moon me-2"></i>Dark
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="theme-mode" value="auto" class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                <i class="ti ti-device-desktop me-2"></i>Auto
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Primary Color</label>
                                    <div class="row g-2">
                                        <div class="col-auto">
                                            <label class="form-colorinput">
                                                <input name="primary-color" type="radio" value="red" class="form-colorinput-input" checked>
                                                <span class="form-colorinput-color bg-red"></span>
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="form-colorinput">
                                                <input name="primary-color" type="radio" value="blue" class="form-colorinput-input">
                                                <span class="form-colorinput-color bg-blue"></span>
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="form-colorinput">
                                                <input name="primary-color" type="radio" value="green" class="form-colorinput-input">
                                                <span class="form-colorinput-color bg-green"></span>
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="form-colorinput">
                                                <input name="primary-color" type="radio" value="purple" class="form-colorinput-input">
                                                <span class="form-colorinput-color bg-purple"></span>
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="form-colorinput">
                                                <input name="primary-color" type="radio" value="orange" class="form-colorinput-input">
                                                <span class="form-colorinput-color bg-orange"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Logo</label>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="{{ asset('img/favicon.png') }}" alt="Current Logo" class="avatar avatar-xl">
                                        </div>
                                        <div class="col">
                                            <input type="file" class="form-control" accept="image/*">
                                            <small class="form-hint">Recommended size: 512x512px. Max file size: 2MB.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Favicon</label>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="{{ asset('img/favicon.png') }}" alt="Current Favicon" class="avatar avatar-md">
                                        </div>
                                        <div class="col">
                                            <input type="file" class="form-control" accept="image/png,image/x-icon">
                                            <small class="form-hint">Recommended size: 32x32px or 16x16px. Max file size: 1MB.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <span class="form-check-label">Show footer</span>
                                    </label>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3" id="notifications">
                        <div class="card-header">
                            <h3 class="card-title">Notification Settings</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <h4 class="mb-3">Email Notifications</h4>
                                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="email-new-user" value="1" class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <div>
                                                        <div class="font-weight-medium">New User Registration</div>
                                                        <div class="text-muted">Send email when a new user registers</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="email-verification" value="1" class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <div>
                                                        <div class="font-weight-medium">Verification Requests</div>
                                                        <div class="text-muted">Send email when a new verification request is submitted</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="email-song-upload" value="1" class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <div>
                                                        <div class="font-weight-medium">New Song Uploads</div>
                                                        <div class="text-muted">Send email when a new song is uploaded</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="email-system" value="1" class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <div>
                                                        <div class="font-weight-medium">System Notifications</div>
                                                        <div class="text-muted">Send email for important system events</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Sender Name</label>
                                    <input type="text" class="form-control" value="Playlist Music" placeholder="Sender name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Template</label>
                                    <select class="form-select">
                                        <option value="default" selected>Default</option>
                                        <option value="minimal">Minimal</option>
                                        <option value="modern">Modern</option>
                                    </select>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3" id="security">
                        <div class="card-header">
                            <h3 class="card-title">Security Settings</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Password Requirements</label>
                                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="password-min-length" value="1" class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <div>
                                                        <div class="font-weight-medium">Minimum Length (8 characters)</div>
                                                        <div class="text-muted">Require passwords to be at least 8 characters long</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="password-uppercase" value="1" class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <div>
                                                        <div class="font-weight-medium">Uppercase Letters</div>
                                                        <div class="text-muted">Require at least one uppercase letter</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="password-numbers" value="1" class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <div>
                                                        <div class="font-weight-medium">Numbers</div>
                                                        <div class="text-muted">Require at least one number</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="password-special" value="1" class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <div>
                                                                                                                <div class="font-weight-medium">Special Characters</div>
                                                        <div class="text-muted">Require at least one special character</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Session Settings</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Session Timeout (minutes)</label>
                                            <input type="number" class="form-control" value="120" min="5" max="1440">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Remember Me Duration (days)</label>
                                            <input type="number" class="form-control" value="30" min="1" max="365">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <span class="form-check-label">Enable Two-Factor Authentication</span>
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <span class="form-check-label">Log failed login attempts</span>
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <span class="form-check-label">Block IP after 5 failed attempts</span>
                                    </label>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3" id="integrations">
                        <div class="card-header">
                            <h3 class="card-title">Integrations</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <span class="avatar avatar-sm" style="background-color: #4285F4">
                                            <i class="ti ti-brand-google text-white"></i>
                                        </span>
                                    </div>
                                    <div class="me-auto">
                                        <div class="font-weight-medium">Google Analytics</div>
                                        <div class="text-muted">Track website traffic and user behavior</div>
                                    </div>
                                    <div>
                                        <label class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tracking ID</label>
                                    <input type="text" class="form-control" value="UA-123456789-1" placeholder="UA-XXXXXXXXX-X">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <span class="avatar avatar-sm" style="background-color: #1877F2">
                                            <i class="ti ti-brand-facebook text-white"></i>
                                        </span>
                                    </div>
                                    <div class="me-auto">
                                        <div class="font-weight-medium">Facebook Pixel</div>
                                        <div class="text-muted">Track conversions from Facebook ads</div>
                                    </div>
                                    <div>
                                        <label class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox">
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pixel ID</label>
                                    <input type="text" class="form-control" placeholder="XXXXXXXXXXXXXXXXXX">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <span class="avatar avatar-sm" style="background-color: #FF0000">
                                            <i class="ti ti-brand-youtube text-white"></i>
                                        </span>
                                    </div>
                                    <div class="me-auto">
                                        <div class="font-weight-medium">YouTube API</div>
                                        <div class="text-muted">Integrate YouTube videos and channels</div>
                                    </div>
                                    <div>
                                        <label class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">API Key</label>
                                    <input type="text" class="form-control" value="AIzaSyD1234567890abcdef" placeholder="API Key">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <span class="avatar avatar-sm" style="background-color: #1DB954">
                                            <i class="ti ti-brand-spotify text-white"></i>
                                        </span>
                                    </div>
                                    <div class="me-auto">
                                        <div class="font-weight-medium">Spotify API</div>
                                        <div class="text-muted">Integrate Spotify music and playlists</div>
                                    </div>
                                    <div>
                                        <label class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Client ID</label>
                                        <input type="text" class="form-control" value="1234567890abcdef" placeholder="Client ID">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Client Secret</label>
                                        <input type="password" class="form-control" value="1234567890abcdef" placeholder="Client Secret">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3" id="backup">
                        <div class="card-header">
                            <h3 class="card-title">Backup & Export</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h4 class="mb-3">Database Backup</h4>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="checkbox" name="backup-auto" value="1" class="form-selectgroup-input" checked>
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-medium">Automatic Backups</div>
                                                    <div class="text-muted">Create automatic database backups</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Backup Frequency</label>
                                        <select class="form-select">
                                            <option value="daily" selected>Daily</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Keep Backups For</label>
                                        <select class="form-select">
                                            <option value="7">7 days</option>
                                            <option value="14">14 days</option>
                                            <option value="30" selected>30 days</option>
                                            <option value="90">90 days</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Backup Storage</label>
                                    <select class="form-select">
                                        <option value="local" selected>Local Storage</option>
                                        <option value="s3">Amazon S3</option>
                                        <option value="dropbox">Dropbox</option>
                                        <option value="google">Google Drive</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="ti ti-cloud-download me-2"></i>Create Manual Backup
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h4 class="mb-3">Data Export</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <i class="ti ti-users text-primary" style="font-size: 24px;"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-medium">Export Users</div>
                                                        <div class="text-muted">Export all user data</div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="btn-list">
                                                        <a href="#" class="btn btn-sm btn-outline-primary">CSV</a>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">Excel</a>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">JSON</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <i class="ti ti-music text-primary" style="font-size: 24px;"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-medium">Export Songs</div>
                                                        <div class="text-muted">Export all song data</div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="btn-list">
                                                        <a href="#" class="btn btn-sm btn-outline-primary">CSV</a>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">Excel</a>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">JSON</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3" id="advanced">
                        <div class="card-header">
                            <h3 class="card-title">Advanced Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                                <i class="ti ti-alert-triangle me-2"></i>
                                These settings are for advanced users. Incorrect configuration may cause system issues.
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Cache Settings</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Cache Driver</label>
                                        <select class="form-select">
                                            <option value="file" selected>File</option>
                                            <option value="redis">Redis</option>
                                            <option value="memcached">Memcached</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Cache Lifetime (minutes)</label>
                                        <input type="number" class="form-control" value="60" min="1" max="10080">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="ti ti-trash me-2"></i>Clear Cache
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                                                <label class="form-label">Queue Settings</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Queue Connection</label>
                                        <select class="form-select">
                                            <option value="sync" selected>Sync</option>
                                            <option value="database">Database</option>
                                            <option value="redis">Redis</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Queue Worker Timeout (seconds)</label>
                                        <input type="number" class="form-control" value="60" min="10" max="3600">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Log Settings</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Log Channel</label>
                                        <select class="form-select">
                                            <option value="stack" selected>Stack</option>
                                            <option value="single">Single</option>
                                            <option value="daily">Daily</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Log Level</label>
                                        <select class="form-select">
                                            <option value="debug">Debug</option>
                                            <option value="info" selected>Info</option>
                                            <option value="warning">Warning</option>
                                            <option value="error">Error</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="ti ti-file-x me-2"></i>Clear Logs
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Maintenance Mode</label>
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-check form-switch m-0 me-3">
                                        <input class="form-check-input" type="checkbox" id="maintenance-mode">
                                    </label>
                                    <div>
                                        <div class="font-weight-medium">Enable Maintenance Mode</div>
                                        <div class="text-muted">Put the application into maintenance mode</div>
                                    </div>
                                </div>
                                <div id="maintenance-options" class="d-none">
                                    <div class="mb-3">
                                        <label class="form-label">Maintenance Message</label>
                                        <textarea class="form-control" rows="2">We're currently performing maintenance. Please check back soon.</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Allowed IPs (comma separated)</label>
                                        <input type="text" class="form-control" placeholder="127.0.0.1, 192.168.1.1">
                                        <small class="form-hint">These IPs will still be able to access the site during maintenance</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            // Handle maintenance mode toggle
            const maintenanceToggle = document.getElementById('maintenance-mode');
            const maintenanceOptions = document.getElementById('maintenance-options');
            
            if (maintenanceToggle && maintenanceOptions) {
                maintenanceToggle.addEventListener('change', function() {
                    if (this.checked) {
                        maintenanceOptions.classList.remove('d-none');
                        
                        // Show confirmation dialog
                        Swal.fire({
                            title: 'Enable Maintenance Mode?',
                            text: "This will make your site inaccessible to users. Are you sure?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#e53935',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, enable it!'
                        }).then((result) => {
                            if (!result.isConfirmed) {
                                maintenanceToggle.checked = false;
                                maintenanceOptions.classList.add('d-none');
                            }
                        });
                    } else {
                        maintenanceOptions.classList.add('d-none');
                    }
                });
            }
            
            // Handle form submissions
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Settings Saved',
                        text: 'Your settings have been updated successfully',
                        confirmButtonColor: '#e53935',
                    });
                });
            });
            
            // Handle clear cache button
            const clearCacheBtn = document.querySelector('button:contains("Clear Cache")');
            if (clearCacheBtn) {
                clearCacheBtn.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Clear Cache?',
                        text: "This will clear all cached data. Are you sure?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, clear it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Cache Cleared',
                                text: 'The application cache has been cleared successfully',
                                confirmButtonColor: '#e53935',
                            });
                        }
                    });
                });
            }
            
            // Handle clear logs button
            const clearLogsBtn = document.querySelector('button:contains("Clear Logs")');
            if (clearLogsBtn) {
                clearLogsBtn.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Clear Logs?',
                        text: "This will delete all log files. Are you sure?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, clear them!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Logs Cleared',
                                text: 'All log files have been cleared successfully',
                                confirmButtonColor: '#e53935',
                            });
                        }
                    });
                });
            }
            
            // Handle manual backup button
            const manualBackupBtn = document.querySelector('button:contains("Create Manual Backup")');
            if (manualBackupBtn) {
                manualBackupBtn.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Creating Backup',
                        text: 'Please wait while we create your backup...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Simulate backup process
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Backup Created',
                            text: 'Your backup has been created successfully',
                            confirmButtonColor: '#e53935',
                        });
                    }, 2000);
                });
            }
            
            // Handle scroll to section
            document.querySelectorAll('[data-bs-toggle="scroll"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    document.querySelectorAll('[data-bs-toggle="scroll"]').forEach(el => {
                        el.classList.remove('active');
                    });
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Scroll to section
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 20,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endsection



