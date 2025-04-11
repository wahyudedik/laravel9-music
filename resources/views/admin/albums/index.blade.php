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
                        <button type="button" id="addAlbumBtn" class="btn btn-primary d-none d-sm-inline-block"
                            data-bs-toggle="modal" data-bs-target="#addAlbumModal">
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

                        <form action="{{ route('admin.albums.index') }}" method="GET" class="d-flex">

                            <div class="input-icon me-3">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" id="album-search" name="search" class="form-control"
                                    placeholder="Search albums..." value="{{ request('search') }}">
                            </div>

                        </form>

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


                            @foreach ($albums as $index => $album)
                                @php
                                    // Extract filename from the 3rd image variant (small)
                                    $coverImages = explode(',', $album->cover_image ?? '');
                                    $smallCoverFile = $coverImages[2] ?? null;

                                    // Get just the filename from the path (e.g. "cover_abc_sm.jpeg")
                                    $filename = $smallCoverFile ? basename($smallCoverFile) : null;

                                    // Generate image URL via route
                                    $imageUrl = $filename
                                        ? route('admin.albums.image', ['filename' => $filename])
                                        : 'https://via.placeholder.com/40';
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url('{{ $imageUrl }}')"></span>
                                            <div>{{ $album->title }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $album->artist->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($album->release_date)->format('d M Y') }}</td>
                                    <td>{{ $album->songs()->count() }}</td>
                                    <td>
                                        @if ($album->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($album->status === 'pending')
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
                                                <a href="javascript:void(0)" class="dropdown-item view-album-btn"
                                                    data-album='@json($album)'>
                                                    <i class="ti ti-eye me-2"></i>View
                                                </a>

                                                <a href="javascript:void(0)" class="dropdown-item edit-album-btn"
                                                    data-album='@json($album)'>
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>

                                                <a href="javascript:void(0)" class="dropdown-item show-album-btn"
                                                    data-album='@json($album)'>
                                                    <i class="ti ti-music me-2"></i>View Songs
                                                </a>

                                                <div class="dropdown-divider"></div>


                                                <a href="javascript:void(0)" class="dropdown-item text-danger delete-album"
                                                    onclick="confirmDelete('{{ $album->id }}')"
                                                    data-id="{{ $album->id }}">
                                                    <i class="ti ti-trash me-2"></i>Delete
                                                </a>

                                                <form id="delete-form-{{ $album->id }}"
                                                    action="{{ route('admin.albums.destroy', $album) }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>


                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">

                    {{ $albums->links() }}

                </div>
            </div>
        </div>
    </div>

    <!-- Add Album Modal -->
    <div class="modal modal-blur fade" id="addAlbumModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ route('admin.albums.store') }}" enctype="multipart/form-data">
                @csrf
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
                                    <select name="artist_id" id="artist_id"
                                        class="selectpicker  form-control  @error('artist_id') is-invalid @enderror"
                                        data-live-search="true">
                                        <option value="">Select Artist</option>
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
                            <input type="file" class="form-control" name="cover_image" accept="image/*">
                            <div class="form-hint">Recommended size: 500x500px, max 2MB</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select" name="status">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto" id="saveAlbumBtn">
                            <i class="ti ti-plus me-2"></i>Add Album
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Edit Album Modals (one for each album) -->
    <div class="modal modal-blur fade" id="editAlbumModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="#" id="edit-album-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="album_id" id="edit-album-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Album</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Album Title</label>
                            <input type="text" class="form-control" name="title" id="edit-album-title" required>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Artist</label>
                                    <select name="artist_id" id="edit-album-artist"
                                        class="selectpicker form-control @error('artist_id') is-invalid @enderror"
                                        data-live-search="true" required>
                                        <option value="">Select Artist</option>
                                        {{-- Options are populated dynamically --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Release Date</label>
                                    <input type="date" class="form-control" name="release_date"
                                        id="edit-album-release-date" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit-album-description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Cover Image</label>
                            <div class="d-flex align-items-center mt-2 mb-3">

                                <img id="edit-album-cover-preview" src="https://placehold.co/100" class="rounded"
                                    width="100" height="100" alt="Cover Image">

                                {{-- <div class="ms-3">
                                    <a href="#" class="btn btn-sm btn-outline-danger" id="remove-cover-link">
                                        <i class="ti ti-trash me-1"></i>Remove
                                    </a>
                                </div> --}}

                            </div>
                            <label class="form-label">Upload New Cover Image</label>
                            <input type="file" class="form-control" name="cover_image" id="edit-album-cover-image"
                                accept="image/*">
                            <div class="form-hint">Recommended size: 500x500px, max 2MB</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select" name="status" id="edit-album-status" required>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="ti ti-device-floppy me-2"></i>Update Album
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- View Album Modal -->
    <div class="modal modal-blur fade" id="showAlbumModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Album Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Album Title</label>
                        <div id="show-album-title" class="form-control-plaintext fw-semibold border-bottom pb-2 mb-2">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Artist</label>
                                <div id="show-album-artist"
                                    class="form-control-plaintext fw-semibold border-bottom pb-2 mb-2"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Release Date</label>
                                <div id="show-album-release-date"
                                    class="form-control-plaintext fw-semibold border-bottom pb-2 mb-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <div id="show-album-description" class="form-control-plaintext border-bottom pb-2 mb-2"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cover Image</label>
                        <div class="d-flex align-items-center mt-2 mb-3 border-bottom pb-3">
                            <img id="show-album-cover-preview" src="https://placehold.co/100" class="rounded"
                                width="100" height="100" alt="Cover Image">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div>
                            <span id="show-album-status" class="badge text-capitalize"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- View Song Album Modal -->
    <div class="modal modal-blur fade" id="viewAlbumModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Album Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="https://placehold.co/300" class="rounded mb-3 album-cover-preview" width="200"
                                height="200" alt="Album Cover">
                            <div class="mt-2">
                                <span class="badge album-status mb-2">Pending</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Album Title</div>
                                    <div class="datagrid-content album-title"></div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Artist</div>
                                    <div class="datagrid-content album-artist"></div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Release Date</div>
                                    <div class="datagrid-content album-release"></div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Number of Songs</div>
                                    <div class="datagrid-content album-songs"></div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Total Duration</div>
                                    <div class="datagrid-content">{{ rand(30, 70) }} minutes</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created At</div>
                                    <div class="datagrid-content">{{ now()->subDays(rand(1, 30))->format('Y-m-d') }}</div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h4>Description</h4>
                                <p class="album-description"></p>
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
                                <tbody class="album-songs-list"></tbody>
                            </table>
                            <div class="text-center mt-3 view-all-songs-container" style="display: none;">
                                <a href="#" class="btn btn-sm btn-outline-primary">View All Songs</a>
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
@push('styles')
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

    <style>
        .bootstrap-select>.dropdown-toggle {
            height: 35.6px;
        }

        .card-no-hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: none;
        }

        .card-no-hover:hover {
            transform: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality

            document.getElementById('addAlbumBtn').addEventListener('click', function(e) {

                setTimeout(() => {
                    document.querySelector('#addAlbumModal input[name="title"]').focus();
                }, 300);

            });


            // Add album functionality
            document.getElementById('saveAlbumBtn').addEventListener('click', function(e) {
                e.preventDefault(); // prevent default submit

                // Swal.fire({
                //     title: 'Creating Genre',
                //     text: 'Please wait while we process your request...',
                //     allowOutsideClick: false,
                //     didOpen: () => Swal.showLoading()
                // });

                // Submit form after short delay (for smoother UX)
                setTimeout(() => {
                    this.closest('form').submit();
                }, 500);
            });

            $(document).on('click', '.edit-album-btn', function() {
                const albumData = $(this).data('album');
                if (albumData) {
                    editAlbum(albumData);
                }
            });

            $(document).on('click', '.show-album-btn', function() {
                const albumData = $(this).data('album');
                if (albumData) {
                    showAlbum(albumData);
                }
            });

            $(document).on('click', '.view-album-btn', function() {
                const albumData = $(this).data('album');
                if (albumData) {
                    viewAlbum(albumData);
                }
            });



        });

        // Delete album functionality
        function confirmDelete(id) {
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
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        const baseUrl = "{{ url('') }}";

        // Update album function
        function editAlbum(album) {
            const form = document.getElementById('edit-album-form');
            const modalEl = document.getElementById('editAlbumModal');
            const modal = new bootstrap.Modal(modalEl);

            // Update form action
            form.action = `${baseUrl}/admin/albums/${album.id}`;

            // Set hidden ID
            form.querySelector('input[name="album_id"]').value = album.id;

            // Basic fields
            form.querySelector('input[name="title"]').value = album.title || '';
            form.querySelector('textarea[name="description"]').value = album.description || '';

            // Convert to YYYY-MM-DD format
            const releaseDate = album.release_date ? new Date(album.release_date).toISOString().split('T')[0] : '';
            form.querySelector('input[name="release_date"]').value = releaseDate;

            // Fetch and set artist select
            fetchArtist("#edit-album-artist", album.artist_id);

            // Set status
            form.querySelector('select[name="status"]').value = album.status || 'Active';

            // Cover image preview
            const coverImages = album.cover_image ? album.cover_image.split(',') : [];
            const smallCoverPath = coverImages[2] || '';
            const smallCoverFilename = smallCoverPath ? smallCoverPath.split('/').pop() : null;

            const imageUrl = smallCoverFilename ?
                `${baseUrl}/admin/albums/albums/${smallCoverFilename}` :
                'https://via.placeholder.com/100';

            modalEl.querySelector('#edit-album-cover-preview').src = imageUrl;

            // Set remove cover link
            const removeBtn = modalEl.querySelector('#remove-cover-link');
            if (removeBtn) {
                removeBtn.href = `${baseUrl}/admin/albums/${album.id}/remove-cover`;
            }

            // Show modal
            modal.show();
        }

        function viewAlbum(album) {
            const modalEl = document.getElementById('showAlbumModal');
            const modal = new bootstrap.Modal(modalEl);

            // Set Album Title
            modalEl.querySelector('#show-album-title').textContent = album.title || '-';

            // Set Artist Name
            modalEl.querySelector('#show-album-artist').textContent = album.artist?.name || '-';

            // Set Release Date in DD/MM/YYYY format
            if (album.release_date) {
                const dateObj = new Date(album.release_date);
                const formattedDate = dateObj.toLocaleDateString('id-ID'); // DD/MM/YYYY
                modalEl.querySelector('#show-album-release-date').textContent = formattedDate;
            } else {
                modalEl.querySelector('#show-album-release-date').textContent = '-';
            }

            // Set Description
            modalEl.querySelector('#show-album-description').textContent = album.description || '-';

            // Set status badge
            const statusEl = modalEl.querySelector('#show-album-status');
            const status = (album.status || 'inactive').toLowerCase();

            statusEl.textContent = status;

            // Reset and assign badge classes
            statusEl.className = 'badge text-capitalize';
            if (status === 'active') {
                statusEl.classList.add('bg-success');
            } else if (status === 'pending') {
                statusEl.classList.add('bg-warning', 'text-dark');
            } else {
                statusEl.classList.add('bg-secondary');
            }

            // Set Cover Image
            const coverImages = album.cover_image ? album.cover_image.split(',') : [];
            const smallCoverPath = coverImages[2] || '';
            const smallCoverFilename = smallCoverPath ? smallCoverPath.split('/').pop() : null;

            const imageUrl = smallCoverFilename ?
                `${baseUrl}/admin/albums/albums/${smallCoverFilename}` :
                'https://via.placeholder.com/100';

            modalEl.querySelector('#show-album-cover-preview').src = imageUrl;

            // Show Modal
            modal.show();
        }


        function showAlbum(album) {

            const modal = new bootstrap.Modal(document.getElementById('viewAlbumModal'));
            // Set title
            document.querySelector('#viewAlbumModal .modal-title').textContent = `Album Details: ${album.title}`;

            // Cover image (use third image if available)
            const coverImages = album.cover_image ? album.cover_image.split(',') : [];
            const smallCoverPath = coverImages[2] || '';
            const smallCoverFilename = smallCoverPath ? smallCoverPath.split('/').pop() : null;

            const imageUrl = smallCoverFilename ?
                `${baseUrl}/admin/albums/albums/${smallCoverFilename}` :
                'https://via.placeholder.com/100';

            document.querySelector('#viewAlbumModal img.album-cover-preview').src = imageUrl;

            // Badge status
            const badge = document.querySelector('#viewAlbumModal .album-status');
            badge.textContent = album.status;
            badge.className =
                `badge mb-2 bg-${album.status === 'Active' ? 'success' : (album.status === 'Pending' ? 'warning' : 'danger')}`;

            // Fill basic info
            document.querySelector('#viewAlbumModal .album-title').textContent = album.title;
            document.querySelector('#viewAlbumModal .album-artist').textContent = album.artist?.name || 'Unknown';
            document.querySelector('#viewAlbumModal .album-release').textContent = formatDate(album.release_date);
            document.querySelector('#viewAlbumModal .album-songs').textContent = album.songs ?? '0';
            document.querySelector('#viewAlbumModal .album-description').textContent =
                `${album.title} is a studio album by ${album.artist?.name}, released on ${formatDate(album.release_date)}. The album features ${album.songs ?? 0} tracks and has received critical acclaim for its innovative sound and production.`;

            // Songs list (dummy)
            const tbody = document.querySelector('#viewAlbumModal .album-songs-list');
            tbody.innerHTML = "";
            const total = Math.min(5, album.songs ?? 0);
            for (let i = 1; i <= total; i++) {
                const row = `
                    <tr>
                        <td>${i}</td>
                        <td>Song Title ${i}</td>
                        <td>${getRandomTime()}</td>
                        <td>${Intl.NumberFormat().format(Math.floor(Math.random() * 1000000 + 10000))}</td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            }

            modal.show();
        }

        // Helpers
        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return isNaN(date) ? 'Unknown' : date.toLocaleDateString();
        }

        function getRandomTime() {
            return `${Math.floor(Math.random() * 4 + 2)}:${String(Math.floor(Math.random() * 60)).padStart(2, '0')}`;
        }
    </script>

    <script>
        $(document).ready(function() {

            // Load artist list on Add Modal
            fetchArtist("#artist_id");

            // Add live search to Add Modal artist select
            $("#artist_id").on("shown.bs.select", function() {
                $(".bs-searchbox input").on("keyup", function() {
                    fetchArtist("#artist_id", "", $(this).val());
                });
            });

            // Add live search to Edit Modal artist select
            $("#edit-album-artist").on("shown.bs.select", function() {
                $(".bs-searchbox input").on("keyup", function() {
                    let searchQuery = $(this).val();
                    let selectedArtistId = $("#edit-album-artist").val();
                    fetchArtist("#edit-album-artist", selectedArtistId, searchQuery);
                });
            });

            // Remove cover image (optional)
            $('#remove-cover-link').on('click', function(e) {
                e.preventDefault();
                //$('#edit-album-cover-preview').attr('src', 'https://via.placeholder.com/100');
                // Optional: Add a hidden input to mark the image for deletion
            });

        });

        function fetchArtist(selectId, selectedValue = "", search = "") {
            $.ajax({
                url: "/admin/data/artists",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    var userSelect = $(selectId);
                    userSelect.empty();
                    userSelect.append('<option value="">Select an artist</option>');

                    $.each(data, function(index, user) {
                        const selected = user.id == selectedValue ? 'selected' : '';
                        userSelect.append('<option value="' + user.id + '" ' + selected +
                            '>' + user.name + ' (' + user.roleName + ')</option>');
                    });

                    userSelect.selectpicker("refresh");
                }
            });
        }
    </script>
@endsection
