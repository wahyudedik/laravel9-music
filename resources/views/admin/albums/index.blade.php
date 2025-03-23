@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Album Management
                    </h2>
                    <div class="text-muted mt-1">Manage all albums in the system</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#addAlbumModal">
                            <i class="ti ti-plus me-2"></i>
                            Add New Album
                        </button>
                        <button type="button" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#addAlbumModal">
                            <i class="ti ti-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Albums</h3>
                    <div class="d-flex">
                        <div class="input-icon me-3">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="text" id="album-search" class="form-control" placeholder="Search albums...">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-hover">
                        <thead>
                            <tr>
                                <th>Album</th>
                                <th>Artist</th>
                                <th>Release Date</th>
                                <th>Songs</th>
                                <th>Status</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $albums = [
                                    [
                                        'title' => 'After Hours',
                                        'artist' => 'The Weeknd',
                                        'release' => '2020-03-20',
                                        'songs' => 14,
                                        'status' => 'Active',
                                    ],
                                    [
                                        'title' => 'Future Nostalgia',
                                        'artist' => 'Dua Lipa',
                                        'release' => '2020-03-27',
                                        'songs' => 11,
                                        'status' => 'Active',
                                    ],
                                    [
                                        'title' => 'Justice',
                                        'artist' => 'Justin Bieber',
                                        'release' => '2021-03-19',
                                        'songs' => 16,
                                        'status' => 'Active',
                                    ],
                                    [
                                        'title' => 'MONTERO',
                                        'artist' => 'Lil Nas X',
                                        'release' => '2021-09-17',
                                        'songs' => 15,
                                        'status' => 'Active',
                                    ],
                                    [
                                        'title' => 'Planet Her',
                                        'artist' => 'Doja Cat',
                                        'release' => '2021-06-25',
                                        'songs' => 14,
                                        'status' => 'Active',
                                    ],
                                    [
                                        'title' => 'Happier Than Ever',
                                        'artist' => 'Billie Eilish',
                                        'release' => '2021-07-30',
                                        'songs' => 16,
                                        'status' => 'Active',
                                    ],
                                    [
                                        'title' => '30',
                                        'artist' => 'Adele',
                                        'release' => '2021-11-19',
                                        'songs' => 12,
                                        'status' => 'Active',
                                    ],
                                    [
                                        'title' => 'Sour',
                                        'artist' => 'Olivia Rodrigo',
                                        'release' => '2021-05-21',
                                        'songs' => 11,
                                        'status' => 'Active',
                                    ],
                                    [
                                        'title' => 'Certified Lover Boy',
                                        'artist' => 'Drake',
                                        'release' => '2021-09-03',
                                        'songs' => 21,
                                        'status' => 'Pending',
                                    ],
                                    [
                                        'title' => 'Donda',
                                        'artist' => 'Kanye West',
                                        'release' => '2021-08-29',
                                        'songs' => 27,
                                        'status' => 'Inactive',
                                    ],
                                ];
                            @endphp

                            @foreach ($albums as $index => $album)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://picsum.photos/40/40?random={{ $index }})"></span>
                                            <div>{{ $album['title'] }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $album['artist'] }}</td>
                                    <td>{{ $album['release'] }}</td>
                                    <td>{{ $album['songs'] }}</td>
                                    <td>
                                        @if ($album['status'] == 'Active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($album['status'] == 'Pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#viewAlbumModal{{ $index }}">
                                                    <i class="ti ti-eye me-2"></i>View
                                                </a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editAlbumModal{{ $index }}">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-music me-2"></i>View Songs
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item text-danger delete-album"
                                                    data-id="{{ $index }}">
                                                    <i class="ti ti-trash me-2"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of <span>20</span> entries</p>
                    <ul class="pagination m-0 ms-auto">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <i class="ti ti-chevron-left"></i>
                                prev
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
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
    </div>

    <!-- Add Album Modal -->
    <div class="modal modal-blur fade" id="addAlbumModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Album Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter album title">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Artist</label>
                                <select class="form-select" name="artist_id">
                                    <option value="">Select Artist</option>
                                    <option value="1">The Weeknd</option>
                                    <option value="2">Dua Lipa</option>
                                    <option value="3">Justin Bieber</option>
                                    <option value="4">Lil Nas X</option>
                                    <option value="5">Doja Cat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Release Date</label>
                                <input type="date" class="form-control" name="release_date">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter album description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Cover Image</label>
                        <input type="file" class="form-control" name="cover_image">
                        <div class="form-hint">Recommended size: 500x500px, max 2MB</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Status</label>
                        <select class="form-select" name="status">
                            <option value="Active">Active</option>
                            <option value="Pending">Pending</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary ms-auto" id="saveAlbumBtn">
                        <i class="ti ti-plus me-2"></i>Add Album
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Album Modals (one for each album) -->
    @foreach ($albums as $index => $album)
        <div class="modal modal-blur fade" id="editAlbumModal{{ $index }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Album: {{ $album['title'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Album Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $album['title'] }}">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Artist</label>
                                    <select class="form-select" name="artist_id">
                                        <option value="">Select Artist</option>
                                        <option value="1" {{ $album['artist'] == 'The Weeknd' ? 'selected' : '' }}>
                                            The Weeknd</option>
                                        <option value="2" {{ $album['artist'] == 'Dua Lipa' ? 'selected' : '' }}>Dua
                                            Lipa</option>
                                        <option value="3"
                                            {{ $album['artist'] == 'Justin Bieber' ? 'selected' : '' }}>Justin Bieber
                                        </option>
                                        <option value="4" {{ $album['artist'] == 'Lil Nas X' ? 'selected' : '' }}>Lil
                                            Nas X</option>
                                        <option value="5" {{ $album['artist'] == 'Doja Cat' ? 'selected' : '' }}>Doja
                                            Cat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Release Date</label>
                                    <input type="date" class="form-control" name="release_date"
                                        value="{{ $album['release'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3">Album description here...</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Current Cover Image</label>
                            <div class="d-flex align-items-center mt-2 mb-3">
                                <img src="https://picsum.photos/200/200?random={{ $index }}" class="rounded"
                                    width="100" height="100" alt="Cover Image">
                                <div class="ms-3">
                                    <a href="#" class="btn btn-sm btn-outline-danger">
                                        <i class="ti ti-trash me-1"></i>Remove
                                    </a>
                                </div>
                            </div>
                            <label class="form-label">Upload New Cover Image</label>
                            <input type="file" class="form-control" name="cover_image">
                            <div class="form-hint">Recommended size: 500x500px, max 2MB</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select" name="status">
                                <option value="Active" {{ $album['status'] == 'Active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="Pending" {{ $album['status'] == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="Inactive" {{ $album['status'] == 'Inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary ms-auto" data-id="{{ $index }}"
                            onclick="updateAlbum(this)">
                            <i class="ti ti-device-floppy me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Album Modal -->
        <div class="modal modal-blur fade" id="viewAlbumModal{{ $index }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Album Details: {{ $album['title'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="https://picsum.photos/300/300?random={{ $index }}" class="rounded mb-3"
                                    width="200" height="200" alt="Album Cover">
                                <div class="mt-2">
                                    <span
                                        class="badge bg-{{ $album['status'] == 'Active' ? 'success' : ($album['status'] == 'Pending' ? 'warning' : 'danger') }} mb-2">{{ $album['status'] }}</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="datagrid">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Album Title</div>
                                        <div class="datagrid-content">{{ $album['title'] }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Artist</div>
                                        <div class="datagrid-content">{{ $album['artist'] }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Release Date</div>
                                        <div class="datagrid-content">{{ $album['release'] }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Number of Songs</div>
                                        <div class="datagrid-content">{{ $album['songs'] }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Total Duration</div>
                                        <div class="datagrid-content">{{ rand(30, 70) }} minutes</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Created At</div>
                                        <div class="datagrid-content">
                                            {{ date('Y-m-d', strtotime('-' . rand(1, 30) . ' days')) }}</div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h4>Description</h4>
                                    <p>{{ $album['title'] }} is a studio album by {{ $album['artist'] }}, released on
                                        {{ $album['release'] }}. The album features {{ $album['songs'] }} tracks and has
                                        received critical acclaim for its innovative sound and production.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4>Songs in this Album</h4>
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Duration</th>
                                            <th>Plays</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 1; $i <= min(5, $album['songs']); $i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>Song Title {{ $i }}</td>
                                                <td>{{ rand(2, 5) }}:{{ sprintf('%02d', rand(0, 59)) }}</td>
                                                <td>{{ number_format(rand(10000, 1000000)) }}</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                                @if ($album['songs'] > 5)
                                    <div class="text-center mt-3">
                                        <a href="#" class="btn btn-sm btn-outline-primary">View All
                                            {{ $album['songs'] }} Songs</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <a href="#" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                            data-bs-target="#editAlbumModal{{ $index }}"
                            onclick="$('#viewAlbumModal{{ $index }}').modal('hide')">
                            <i class="ti ti-edit me-2"></i>Edit Album
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('album-search');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const title = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const artist = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                    if (title.includes(searchTerm) || artist.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Add album functionality
            document.getElementById('saveAlbumBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Creating Album',
                    text: 'Please wait while we process your request...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Simulate form submission delay
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Album Created Successfully',
                        text: 'The album has been added to the system.',
                        confirmButtonColor: '#e53935'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#addAlbumModal').modal('hide');
                            location.reload();
                        }
                    });
                }, 1500);
            });

            // Delete album functionality
            document.querySelectorAll('.delete-album').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const albumId = this.dataset.id;

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
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The album has been deleted.',
                                icon: 'success',
                                confirmButtonColor: '#e53935'
                            }).then(() => {
                                // Simulate deletion by hiding the row
                                const row = this.closest('tr');
                                row.style.display = 'none';
                            });
                        }
                    });
                });
            });
        });

        // Update album function
        function updateAlbum(button) {
            const albumId = button.dataset.id;

            Swal.fire({
                title: 'Updating Album',
                text: 'Please wait while we process your request...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simulate form submission delay
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Album Updated Successfully',
                    text: 'The album information has been updated.',
                    confirmButtonColor: '#e53935'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#editAlbumModal${albumId}`).modal('hide');
                    }
                });
            }, 1500);
        }
    </script>
@endsection
