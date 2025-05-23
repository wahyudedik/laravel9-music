@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Account Settings</div>
                        <h2 class="page-title">Edit Profile</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left me-2"></i>Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <!-- Profile Navigation -->
                    <div class="col-12 col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Profile Settings</h4>
                                <div class="list-group list-group-flush">
                                    <a href="#basic-info" class="list-group-item list-group-item-action active">
                                        <i class="ti ti-user me-2"></i>Basic Information
                                    </a>
                                    <a href="#account-security" class="list-group-item list-group-item-action">
                                        <i class="ti ti-lock me-2"></i>Account & Security
                                    </a>
                                    <a href="#preferences" class="list-group-item list-group-item-action">
                                        <i class="ti ti-settings me-2"></i>Preferences
                                    </a>
                                    <a href="#social-profiles" class="list-group-item list-group-item-action">
                                        <i class="ti ti-brand-instagram me-2"></i>Social Profiles
                                    </a>
                                    <a href="#notifications" class="list-group-item list-group-item-action">
                                        <i class="ti ti-bell me-2"></i>Notifications
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Edit Form -->
                    <div class="col-12 col-md-9">
                        <!-- Basic Information -->
                        <div class="card mb-4" id="basic-info">
                            <div class="card-header">
                                <h3 class="card-title">Basic Information</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col-12 text-center mb-3">
                                            <div class="avatar avatar-xl mb-3 mx-auto position-relative"
                                                style="background-image: url({{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=e53935&color=fff' }})">
                                                <div class="position-absolute bottom-0 end-0">
                                                    <label for="avatar-upload" class="btn btn-sm btn-primary rounded-circle"
                                                        style="width: 32px; height: 32px; padding: 0; line-height: 32px;">
                                                        <i class="ti ti-pencil"></i>
                                                    </label>
                                                    <input type="file" id="avatar-upload" name="profile_picture"
                                                        class="d-none">
                                                </div>
                                            </div>
                                            <p class="text-muted small">Click the pencil icon to change your profile
                                                picture
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="{{ explode(' ', $user->name)[0] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ isset(explode(' ', $user->name)[1]) ? implode(' ', array_slice(explode(' ', $user->name), 1)) : '' }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email', $user->email) }}" disabled>
                                                <small class="form-hint">Email cannot be changed</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Phone Number</label>
                                                <input type="tel" class="form-control" name="phone"
                                                    value="{{ old('phone', $user->phone) }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Bio</label>

                                                <textarea class="form-control" name="bio" rows="3">{{ $userProfile ? $userProfile->bio : '' }}</textarea>


                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" name="birthdate"
                                                    value="{{ $userProfile ? $userProfile->birthdate : '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select" name="gender">
                                                    <option value="male"
                                                        {{ $userProfile && $userProfile->gender == 'male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="female"
                                                        {{ $userProfile && $userProfile->gender == 'female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input type="text" class="form-control" name="location"
                                                value="{{ old('region', $user->region) }}">
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                </form>
                            </div>
                        </div>

                        <!-- Account & Security -->
                        <div class="card mb-4" id="account-security">
                            <div class="card-header">
                                <h3 class="card-title">Account & Security</h3>
                            </div>
                            <div class="card-body">
                                <form action="#" method="POST">
                                    @csrf
                                    <h4 class="mb-3">Change Password</h4>
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="new_password">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" name="new_password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </form>

                                <hr class="my-4">

                                <h4 class="mb-3">Two-Factor Authentication</h4>
                                <p class="text-muted">Add an extra layer of security to your account by enabling two-factor
                                    authentication.</p>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="enable-2fa">
                                    <label class="form-check-label" for="enable-2fa">Enable Two-Factor
                                        Authentication</label>
                                </div>
                                <button class="btn btn-outline-primary" disabled>Set Up Two-Factor Authentication</button>
                            </div>
                        </div>

                        <!-- Preferences -->
                        <div class="card mb-4" id="preferences">
                            <div class="card-header">
                                <h3 class="card-title">Preferences</h3>
                            </div>
                            <div class="card-body">
                                <form action="#" method="POST">
                                    @csrf
                                    <h4 class="mb-3">Language & Region</h4>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Language</label>
                                            <select class="form-select" name="language">
                                                <option value="en" selected>English</option>
                                                <option value="id">Bahasa Indonesia</option>
                                                <option value="es">Spanish</option>
                                                <option value="fr">French</option>
                                                <option value="de">German</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Time Zone</label>
                                            <select class="form-select" name="timezone">
                                                <option value="Asia/Jakarta" selected>Asia/Jakarta (GMT+7)</option>
                                                <option value="Asia/Singapore">Asia/Singapore (GMT+8)</option>
                                                <option value="America/New_York">America/New_York (GMT-5)</option>
                                                <option value="Europe/London">Europe/London (GMT+0)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <h4 class="mb-3 mt-4">Theme Settings</h4>
                                    <div class="mb-3">
                                        <label class="form-label">Theme Mode</label>
                                        <div class="btn-group w-100" role="group">
                                            <input type="radio" class="btn-check" name="theme_mode" id="light-mode"
                                                value="light" checked>
                                            <label class="btn btn-outline-primary" for="light-mode">
                                                <i class="ti ti-sun me-2"></i>Light
                                            </label>
                                            <input type="radio" class="btn-check" name="theme_mode" id="dark-mode"
                                                value="dark">
                                            <label class="btn btn-outline-primary" for="dark-mode">
                                                <i class="ti ti-moon me-2"></i>Dark
                                            </label>
                                            <input type="radio" class="btn-check" name="theme_mode" id="auto-mode"
                                                value="auto">
                                            <label class="btn btn-outline-primary" for="auto-mode">
                                                <i class="ti ti-device-desktop me-2"></i>Auto
                                            </label>
                                        </div>
                                    </div>

                                    <h4 class="mb-3 mt-4">Music Preferences</h4>
                                    <div class="mb-3">
                                        <label class="form-label">Favorite Genres</label>
                                        <select class="form-select" name="favorite_genres[]" multiple>
                                            @foreach (['Pop', 'Rock', 'Jazz', 'Classical', 'Hip Hop', 'R&B', 'Electronic', 'Country', 'Folk', 'Indie'] as $genre)
                                                <option value="{{ strtolower($genre) }}"
                                                    {{ in_array($genre, ['Pop', 'Rock', 'Electronic']) ? 'selected' : '' }}>
                                                    {{ $genre }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-hint">Hold Ctrl (or Cmd on Mac) to select multiple
                                            genres</small>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">Save Preferences</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Social Profiles -->
                        <div class="card mb-4" id="social-profiles">
                            <div class="card-header">
                                <h3 class="card-title">Social Profiles</h3>
                            </div>
                            <div class="card-body">
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="ti ti-brand-instagram text-pink me-2"></i>Instagram
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">instagram.com/</span>
                                            <input type="text" class="form-control" name="instagram"
                                                value="johndoemusic">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="ti ti-brand-twitter text-blue me-2"></i>Twitter
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">twitter.com/</span>
                                            <input type="text" class="form-control" name="twitter" value="johndoe">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="ti ti-brand-youtube text-red me-2"></i>YouTube
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">youtube.com/</span>
                                            <input type="text" class="form-control" name="youtube"
                                                value="johndoemusic">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="ti ti-brand-soundcloud text-orange me-2"></i>SoundCloud
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">soundcloud.com/</span>
                                            <input type="text" class="form-control" name="soundcloud"
                                                value="johndoemusic">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="ti ti-brand-facebook text-blue me-2"></i>Facebook
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">facebook.com/</span>
                                            <input type="text" class="form-control" name="facebook"
                                                value="johndoemusic">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="ti ti-world me-2"></i>Website
                                        </label>
                                        <input type="url" class="form-control" name="website"
                                            value="https://johndoe-music.com">
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">Save Social Profiles</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="card mb-4" id="notifications">
                            <div class="card-header">
                                <h3 class="card-title">Notification Settings</h3>
                            </div>
                            <div class="card-body">
                                <form action="#" method="POST">
                                    @csrf
                                    <h4 class="mb-3">Email Notifications</h4>

                                    @foreach ([
            'new_follower' => 'Someone follows me',
            'new_comment' => 'Someone comments on my music',
            'new_like' => 'Someone likes my music',
            'new_message' => 'Someone sends me a message',
            'song_featured' => 'My song gets featured',
            'newsletter' => 'Weekly newsletter and updates',
            'special_offers' => 'Special offers and promotions',
        ] as $key => $label)
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="{{ $key }}"
                                                name="email_notifications[]" value="{{ $key }}"
                                                {{ in_array($key, ['new_follower', 'new_comment', 'new_message']) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach

                                    <h4 class="mb-3 mt-4">Push Notifications</h4>

                                    @foreach ([
            'push_new_follower' => 'Someone follows me',
            'push_new_comment' => 'Someone comments on my music',
            'push_new_like' => 'Someone likes my music',
            'push_new_message' => 'Someone sends me a message',
            'push_song_featured' => 'My song gets featured',
        ] as $key => $label)
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="{{ $key }}"
                                                name="push_notifications[]" value="{{ $key }}"
                                                {{ in_array($key, ['push_new_follower', 'push_new_message']) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">Save Notification Settings</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Danger Zone -->
                        <div class="card" id="danger-zone">
                            <div class="card-header bg-danger-subtle">
                                <h3 class="card-title text-danger">Danger Zone</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h4>Deactivate Account</h4>
                                    <p class="text-muted">Temporarily deactivate your account. You can reactivate it
                                        anytime by logging in.</p>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#deactivateModal">
                                        Deactivate Account
                                    </button>
                                </div>
                                <hr>
                                <div>
                                    <h4>Delete Account</h4>
                                    <p class="text-muted">Permanently delete your account and all associated data. This
                                        action cannot be undone.</p>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                        Delete Account
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deactivate Account Modal -->
    <div class="modal modal-blur fade" id="deactivateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deactivate Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p>Are you sure you want to deactivate your account? Your profile will be hidden from other users.
                        </p>
                        <p>You can reactivate your account at any time by logging in again.</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Please enter your password to confirm</label>
                        <input type="password" class="form-control" placeholder="Your password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning">Deactivate Account</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal modal-blur fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="text-center mb-3">
                            <i class="ti ti-alert-triangle text-danger" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="text-center">Warning: This action cannot be undone</h4>
                        <p>Deleting your account will:</p>
                        <ul>
                            <li>Permanently remove all your personal information</li>
                            <li>Delete all your uploaded music and covers</li>
                            <li>Remove your comments and likes</li>
                            <li>Cancel all your subscriptions</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirm-delete">
                            <label class="form-check-label" for="confirm-delete">
                                I understand that this action is permanent and cannot be undone
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Please enter your password to confirm</label>
                        <input type="password" class="form-control" placeholder="Your password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" disabled>Delete Account Permanently</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle smooth scrolling for profile section navigation
            document.querySelectorAll('.list-group-item').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all links
                    document.querySelectorAll('.list-group-item').forEach(item => {
                        item.classList.remove('active');
                    });

                    // Add active class to clicked link
                    this.classList.add('active');

                    // Get the target section
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);

                    // Scroll to the target section
                    if (targetSection) {
                        window.scrollTo({
                            top: targetSection.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Handle avatar upload preview
            const avatarUpload = document.getElementById('avatar-upload');
            if (avatarUpload) {
                avatarUpload.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const avatar = document.querySelector('.avatar-xl');
                            avatar.style.backgroundImage = `url(${e.target.result})`;
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }

            // Handle delete account confirmation checkbox
            const confirmDeleteCheckbox = document.getElementById('confirm-delete');
            const deleteButton = document.querySelector('#deleteModal .btn-danger');

            if (confirmDeleteCheckbox && deleteButton) {
                confirmDeleteCheckbox.addEventListener('change', function() {
                    deleteButton.disabled = !this.checked;
                });
            }
        });
    </script>
@endsection
