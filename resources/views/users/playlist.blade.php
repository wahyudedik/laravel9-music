@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Music Collection</div>
                        <h2 class="page-title">My Playlists</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-new-playlist">
                                <i class="ti ti-plus me-2"></i>Create Playlist
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-new-playlist">
                                <i class="ti ti-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <!-- Playlists Grid -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#tabs-home-ex" class="nav-link active" data-bs-toggle="tab">
                                            <i class="ti ti-playlist me-2"></i>My Playlists
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tabs-favorite-ex" class="nav-link" data-bs-toggle="tab">
                                            <i class="ti ti-heart me-2"></i>Favorites
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tabs-shared-ex" class="nav-link" data-bs-toggle="tab">
                                            <i class="ti ti-share me-2"></i>Shared With Me
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="tabs-home-ex">
                                        <h3 class="card-title mb-4">Your Created Playlists</h3>
                                        <div class="row g-3">
                                            @for ($i = 1; $i <= 8; $i++)
                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="card card-sm">
                                                        <a href="{{ route('playlist.index') }}?id={{ $i }}"
                                                            class="d-block">
                                                            <img src="https://picsum.photos/300/150?random={{ $i }}"
                                                                class="card-img-top" alt="Playlist Cover">
                                                        </a>
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <div class="font-weight-medium">Playlist
                                                                        {{ $i }}</div>
                                                                    <div class="text-muted">{{ rand(5, 25) }} songs</div>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <div class="dropdown">
                                                                        <a href="#"
                                                                            class="btn btn-icon btn-ghost-secondary dropdown-toggle"
                                                                            data-bs-toggle="dropdown">
                                                                            <i class="ti ti-dots-vertical"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a href="#" class="dropdown-item">
                                                                                <i class="ti ti-edit me-2"></i>Edit
                                                                            </a>
                                                                            <a href="#" class="dropdown-item">
                                                                                <i class="ti ti-share me-2"></i>Share
                                                                            </a>
                                                                            <a href="#"
                                                                                class="dropdown-item text-danger">
                                                                                <i class="ti ti-trash me-2"></i>Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="d-flex align-items-center">
                                                                <button class="btn btn-icon btn-sm btn-primary me-2"
                                                                    data-bs-toggle="tooltip" title="Play">
                                                                    <i class="ti ti-player-play"></i>
                                                                </button>
                                                                <span class="text-muted">Created {{ rand(1, 30) }} days
                                                                    ago</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor

                                            <!-- Create New Playlist Card -->
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="card card-sm card-link border-dashed d-flex flex-column justify-content-center align-items-center"
                                                    style="min-height: 100%;" data-bs-toggle="modal"
                                                    data-bs-target="#modal-new-playlist">
                                                    <div class="text-center p-4">
                                                        <span class="avatar avatar-md bg-primary-lt mb-3">
                                                            <i class="ti ti-plus text-primary"></i>
                                                        </span>
                                                        <div class="font-weight-medium">Create New Playlist</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tabs-favorite-ex">
                                        <h3 class="card-title mb-4">Your Favorite Playlists</h3>
                                        <div class="row g-3">
                                            @for ($i = 9; $i <= 12; $i++)
                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="card card-sm">
                                                        <a href="{{ route('playlist.index') }}?id={{ $i }}"
                                                            class="d-block">
                                                            <img src="https://picsum.photos/300/150?random={{ $i }}"
                                                                class="card-img-top" alt="Playlist Cover">
                                                        </a>
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <div class="font-weight-medium">Favorite
                                                                        {{ $i - 8 }}</div>
                                                                    <div class="text-muted">{{ rand(5, 25) }} songs
                                                                    </div>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <button class="btn btn-icon btn-sm btn-danger"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Remove from favorites">
                                                                        <i class="ti ti-heart-off"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="d-flex align-items-center">
                                                                <button class="btn btn-icon btn-sm btn-primary me-2"
                                                                    data-bs-toggle="tooltip" title="Play">
                                                                    <i class="ti ti-player-play"></i>
                                                                </button>
                                                                <span class="text-muted">By: User
                                                                    {{ $i }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tabs-shared-ex">
                                        <h3 class="card-title mb-4">Playlists Shared With You</h3>
                                        <div class="row g-3">
                                            @for ($i = 13; $i <= 15; $i++)
                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="card card-sm">
                                                        <a href="{{ route('playlist.index') }}?id={{ $i }}"
                                                            class="d-block">
                                                            <img src="https://picsum.photos/300/150?random={{ $i }}"
                                                                class="card-img-top" alt="Playlist Cover">
                                                        </a>
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <div class="font-weight-medium">Shared Playlist
                                                                        {{ $i - 12 }}</div>
                                                                    <div class="text-muted">{{ rand(5, 25) }} songs
                                                                    </div>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <span class="avatar avatar-xs"
                                                                        style="background-image: url(https://ui-avatars.com/api/?name=User{{ $i }}&background=e53935&color=fff)"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="d-flex align-items-center">
                                                                <button class="btn btn-icon btn-sm btn-primary me-2"
                                                                    data-bs-toggle="tooltip" title="Play">
                                                                    <i class="ti ti-player-play"></i>
                                                                </button>
                                                                <span class="text-muted">Shared {{ rand(1, 10) }} days
                                                                    ago</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recently Added Songs -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-music me-2 text-primary"></i>Recently Added Songs
                        </h3>
                        <div class="card-actions">
                            <a href="#" class="btn btn-link">View All</a>
                        </div>
                    </div>
                    <div class="card-body border-bottom-0 table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Artist</th>
                                    <th>Album</th>
                                    <th>Duration</th>
                                    <th>Added</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $i + 30 }})"></span>
                                                <div>Song Title {{ $i }}</div>
                                            </div>
                                        </td>
                                        <td>Artist {{ ($i % 5) + 1 }}</td>
                                        <td>Album {{ ($i % 3) + 1 }}</td>
                                        <td>{{ rand(2, 4) }}:{{ sprintf('%02d', rand(0, 59)) }}</td>
                                        <td>{{ now()->subDays(rand(1, 14))->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <button class="btn btn-icon btn-sm btn-primary" data-bs-toggle="tooltip"
                                                    title="Play">
                                                    <i class="ti ti-player-play"></i>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon btn-sm btn-ghost-secondary"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-plus me-2"></i>Add to playlist
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-heart me-2"></i>Add to favorites
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-share me-2"></i>Share
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" class="dropdown-item text-danger">
                                                            <i class="ti ti-trash me-2"></i>Remove
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for creating new playlist -->
    <div class="modal modal-blur fade" id="modal-new-playlist" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Playlist Name</label>
                        <input type="text" class="form-control" placeholder="My Awesome Playlist">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (optional)</label>
                        <textarea class="form-control" rows="3" placeholder="Describe your playlist..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Privacy</label>
                        <select class="form-select">
                            <option value="private">Private</option>
                            <option value="public">Public</option>
                            <option value="friends">Friends Only</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cover Image</label>
                        <input type="file" class="form-control">
                        <small class="form-hint">Recommended size: 300x300 pixels</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <i class="ti ti-plus me-2"></i>Create Playlist
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for playlist details -->
    <div class="modal modal-blur fade" id="modal-playlist-details" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Playlist Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="https://picsum.photos/300/300?random=1" class="img-fluid rounded mb-3"
                                alt="Playlist Cover">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="ti ti-player-play me-2"></i>Play All
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="ti ti-shuffle me-2"></i>Shuffle
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3>My Awesome Playlist</h3>
                            <p class="text-muted">Created by You • 15 songs • 54 minutes</p>
                            <p>This is a collection of my favorite songs that I enjoy listening to while working.</p>

                            <div class="d-flex mt-4 mb-3">
                                <button class="btn btn-sm btn-outline-primary me-2">
                                    <i class="ti ti-edit me-1"></i>Edit
                                </button>
                                <button class="btn btn-sm btn-outline-primary me-2">
                                    <i class="ti ti-share me-1"></i>Share
                                </button>
                                <button class="btn btn-sm btn-outline-danger me-2">
                                    <i class="ti ti-trash me-1"></i>Delete
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Artist</th>
                                            <th>Duration</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>Song Title {{ $i }}</td>
                                                <td>Artist {{ $i }}</td>
                                                <td>{{ rand(2, 4) }}:{{ sprintf('%02d', rand(0, 59)) }}</td>
                                                <td class="text-end">
                                                    <button class="btn btn-icon btn-sm btn-ghost-secondary">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if there's an ID in the URL to show the playlist details modal
            const urlParams = new URLSearchParams(window.location.search);
            const playlistId = urlParams.get('id');

            if (playlistId) {
                const modal = new bootstrap.Modal(document.getElementById('modal-playlist-details'));
                modal.show();

                // Update browser history to remove the query parameter
                window.history.replaceState({}, document.title, "{{ route('playlist.index') }}");
            }

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
