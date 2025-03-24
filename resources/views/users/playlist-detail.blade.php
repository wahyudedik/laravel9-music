@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            <a href="{{ route('playlist.index') }}" class="text-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Back to Playlists
                            </a>
                        </div>
                        <h2 class="page-title">Playlist Details</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="#" class="btn btn-outline-primary d-none d-sm-inline-block">
                                <i class="ti ti-edit me-2"></i>Edit Playlist
                            </a>
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-player-play me-2"></i>Play All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="https://picsum.photos/400/400?random=25" class="img-fluid rounded mb-3"
                                    alt="Playlist Cover">
                                <h3>My Awesome Playlist</h3>
                                <p class="text-muted">Created by You • 15 songs • 54 minutes</p>
                                <div class="mt-3 mb-4">
                                    <span class="badge bg-primary-lt me-1">Pop</span>
                                    <span class="badge bg-primary-lt me-1">Rock</span>
                                    <span class="badge bg-primary-lt">Electronic</span>
                                </div>
                                <p>This is a collection of my favorite songs that I enjoy listening to while working.</p>
                                <div class="d-flex justify-content-center mt-4">
                                    <button class="btn btn-primary me-2">
                                        <i class="ti ti-player-play me-2"></i>Play All
                                    </button>
                                    <button class="btn btn-outline-primary me-2">
                                        <i class="ti ti-shuffle me-2"></i>Shuffle
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#" class="dropdown-item">
                                                <i class="ti ti-edit me-2"></i>Edit
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="ti ti-share me-2"></i>Share
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="ti ti-download me-2"></i>Download
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

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Playlist Stats</h3>
                            </div>
                            <div class="card-body">
                                <div class="datagrid">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Created</div>
                                        <div class="datagrid-content">{{ now()->subDays(rand(1, 30))->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Last Updated</div>
                                        <div class="datagrid-content">{{ now()->subDays(rand(1, 7))->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Total Plays</div>
                                        <div class="datagrid-content">{{ rand(10, 500) }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Followers</div>
                                        <div class="datagrid-content">{{ rand(0, 50) }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Privacy</div>
                                        <div class="datagrid-content">
                                            <span class="badge bg-green">Public</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Songs in this Playlist</h3>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal-add-songs">
                                        <i class="ti ti-plus me-2"></i>Add Songs
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th width="40">#</th>
                                                <th>Title</th>
                                                <th>Artist</th>
                                                <th>Album</th>
                                                <th>Duration</th>
                                                <th width="100"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 1; $i <= 15; $i++)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="avatar me-2"
                                                                style="background-image: url(https://picsum.photos/40/40?random={{ $i + 50 }})"></span>
                                                            <div>Song Title {{ $i }}</div>
                                                        </div>
                                                    </td>
                                                    <td>Artist {{ ($i % 5) + 1 }}</td>
                                                    <td>Album {{ ($i % 3) + 1 }}</td>
                                                    <td>{{ rand(2, 4) }}:{{ sprintf('%02d', rand(0, 59)) }}</td>
                                                    <td>
                                                        <div class="btn-list flex-nowrap">
                                                            <button class="btn btn-icon btn-sm btn-ghost-secondary"
                                                                data-bs-toggle="tooltip" title="Play">
                                                                <i class="ti ti-player-play"></i>
                                                            </button>
                                                            <button class="btn btn-icon btn-sm btn-ghost-secondary"
                                                                data-bs-toggle="tooltip" title="Like">
                                                                <i class="ti ti-heart"></i>
                                                            </button>
                                                            <div class="dropdown">
                                                                <button class="btn btn-icon btn-sm btn-ghost-secondary"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="ti ti-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a href="#" class="dropdown-item">
                                                                        <i class="ti ti-plus me-2"></i>Add to another
                                                                        playlist
                                                                    </a>
                                                                    <a href="#" class="dropdown-item">
                                                                        <i class="ti ti-share me-2"></i>Share
                                                                    </a>
                                                                    <a href="#" class="dropdown-item">
                                                                        <i class="ti ti-download me-2"></i>Download
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a href="#" class="dropdown-item text-danger">
                                                                        <i class="ti ti-trash me-2"></i>Remove from
                                                                        playlist
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

                        <!-- Comments Section -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Comments</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row g-2 align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar"
                                                style="background-image: url(https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=e53935&color=fff)"></span>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Add a comment...">
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-primary">Post</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="divide-y">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="row py-3">
                                            <div class="col-auto">
                                                <span class="avatar"
                                                    style="background-image: url(https://ui-avatars.com/api/?name=User{{ $i }}&background=e53935&color=fff)"></span>
                                            </div>
                                            <div class="col">
                                                <div class="text-truncate">
                                                    <strong>User {{ $i }}</strong>
                                                </div>
                                                <div class="text-muted">Great playlist! I especially love song
                                                    #{{ rand(1, 15) }}.</div>
                                                <div class="mt-1">
                                                    <span
                                                        class="text-muted">{{ now()->subDays(rand(1, 7))->diffForHumans() }}</span>
                                                    <a href="#" class="ms-3 text-muted">Reply</a>
                                                    <a href="#" class="ms-3 text-muted">Like</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Similar Playlists -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Similar Playlists</h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="col-sm-4">
                                            <div class="card card-sm">
                                                <a href="#" class="d-block">
                                                    <img src="https://picsum.photos/300/150?random={{ $i + 100 }}"
                                                        class="card-img-top" alt="Playlist Cover">
                                                </a>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div class="font-weight-medium">Similar Playlist
                                                                {{ $i }}</div>
                                                            <div class="text-muted">{{ rand(5, 25) }} songs</div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <button class="btn btn-icon btn-sm btn-primary"
                                                                data-bs-toggle="tooltip" title="Play">
                                                                <i class="ti ti-player-play"></i>
                                                            </button>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding songs to playlist -->
    <div class="modal modal-blur fade" id="modal-add-songs" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Songs to Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="input-icon mb-3">
                            <input type="text" class="form-control" placeholder="Search for songs...">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th width="40"></th>
                                    <th>Title</th>
                                    <th>Artist</th>
                                    <th>Album</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://picsum.photos/40/40?random={{ $i + 200 }})"></span>
                                                <div>New Song {{ $i }}</div>
                                            </div>
                                        </td>
                                        <td>Artist {{ ($i % 5) + 1 }}</td>
                                        <td>Album {{ ($i % 3) + 1 }}</td>
                                        <td>{{ rand(2, 4) }}:{{ sprintf('%02d', rand(0, 59)) }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <i class="ti ti-plus me-2"></i>Add Selected Songs
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
