@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Song Management
                    </h2>
                    <div class="text-muted mt-1">Manage all songs in the system</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.songs.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-plus me-2"></i>
                            Add New Song
                        </a>
                        <a href="{{ route('admin.songs.create') }}" class="btn btn-primary d-sm-none btn-icon">
                            <i class="ti ti-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Filter Songs</h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Album</label>
                            <select id="album-filter" class="form-select">
                                <option value="">All Albums</option>
                                <option value="After Hours">After Hours</option>
                                <option value="Future Nostalgia">Future Nostalgia</option>
                                <option value="Justice">Justice</option>
                                <option value="MONTERO">MONTERO</option>
                                <option value="Planet Her">Planet Her</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Genre</label>
                            <select id="genre-filter" class="form-select">
                                <option value="">All Genres</option>
                                <option value="Pop">Pop</option>
                                <option value="Hip Hop">Hip Hop</option>
                                <option value="Rock">Rock</option>
                                <option value="Electronic">Electronic</option>
                                <option value="R&B">R&B</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select id="status-filter" class="form-select">
                                <option value="">All Status</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <button id="reset-filters" class="btn btn-link me-2">Reset</button>
                                <button id="apply-filters" class="btn btn-primary">Apply Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Song List</h3>
                    <div class="d-flex">
                        <div class="input-icon me-3">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="text" id="song-search" class="form-control" placeholder="Search songs...">
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                id="bulkActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Bulk Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="bulkActionsDropdown">
                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Activate
                                        Selected</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ti ti-x me-2"></i>Deactivate
                                        Selected</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="#"><i
                                            class="ti ti-trash me-2"></i>Delete Selected</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-hover">
                        <thead>
                            <tr>
                                <th class="w-1">
                                    <input class="form-check-input m-0 align-middle" type="checkbox" id="select-all">
                                </th>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Album</th>
                                <th>Genre</th>
                                <th>Release Date</th>
                                <th>Status</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="songs-table-body">
                            @php
                                $albums = ['After Hours', 'Future Nostalgia', 'Justice', 'MONTERO', 'Planet Her'];
                                $artists = ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Doja Cat'];
                                $genres = ['Pop', 'Hip Hop', 'R&B', 'Electronic', 'Rock'];
                                $statuses = ['Active', 'Pending', 'Inactive'];
                                $songs = [
                                    'Blinding Lights',
                                    'Save Your Tears',
                                    'Levitating',
                                    'Don\'t Start Now',
                                    'Peaches',
                                    'Stay',
                                    'MONTERO (Call Me By Your Name)',
                                    'INDUSTRY BABY',
                                    'Kiss Me More',
                                    'Need To Know',
                                    'Woman',
                                    'Streets',
                                    'Take My Breath',
                                    'Love Again',
                                    'Physical',
                                    'Ghost',
                                    'Yummy',
                                    'SUN GOES DOWN',
                                ];
                            @endphp

                            @for ($i = 0; $i < 15; $i++)
                                @php
                                    $songIndex = $i % count($songs);
                                    $artistIndex = $i % count($artists);
                                    $albumIndex = $i % count($albums);
                                    $genreIndex = $i % count($genres);
                                    $statusIndex = $i % count($statuses);
                                    $releaseDate = date('Y-m-d', strtotime('-' . rand(1, 365) . ' days'));
                                @endphp
                                <tr class="song-row" data-album="{{ $albums[$albumIndex] }}"
                                    data-genre="{{ $genres[$genreIndex] }}" data-status="{{ $statuses[$statusIndex] }}">
                                    <td>
                                        <input class="form-check-input m-0 align-middle song-checkbox" type="checkbox"
                                            value="{{ $i + 1 }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://picsum.photos/40/40?random={{ $i }})"></span>
                                            <div>{{ $songs[$songIndex] }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $artists[$artistIndex] }}</td>
                                    <td>{{ $albums[$albumIndex] }}</td>
                                    <td>{{ $genres[$genreIndex] }}</td>
                                    <td>{{ $releaseDate }}</td>
                                    <td>
                                        @if ($statuses[$statusIndex] == 'Active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($statuses[$statusIndex] == 'Pending')
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
                                                <a href="{{ route('admin.songs.show', $i + 1) }}" class="dropdown-item">
                                                    <i class="ti ti-eye me-2"></i>View
                                                </a>
                                                <a href="{{ route('admin.songs.edit', $i + 1) }}" class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-player-play me-2"></i>Preview
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item text-danger delete-song"
                                                    data-id="{{ $i + 1 }}">
                                                    <i class="ti ti-trash me-2"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>15</span> of <span>50</span> entries</p>
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
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const albumFilter = document.getElementById('album-filter');
            const genreFilter = document.getElementById('genre-filter');
            const statusFilter = document.getElementById('status-filter');
            const applyFiltersBtn = document.getElementById('apply-filters');
            const resetFiltersBtn = document.getElementById('reset-filters');
            const songRows = document.querySelectorAll('.song-row');
            const songSearch = document.getElementById('song-search');
            const selectAll = document.getElementById('select-all');
            const songCheckboxes = document.querySelectorAll('.song-checkbox');
            const deleteButtons = document.querySelectorAll('.delete-song');

            // Apply filters
            applyFiltersBtn.addEventListener('click', function() {
                filterSongs();
            });

            // Reset filters
            resetFiltersBtn.addEventListener('click', function() {
                albumFilter.value = '';
                genreFilter.value = '';
                statusFilter.value = '';
                songSearch.value = '';
                filterSongs();
            });

            // Search functionality
            songSearch.addEventListener('input', function() {
                filterSongs();
            });

            // Select all checkboxes
            selectAll.addEventListener('change', function() {
                songCheckboxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    if (!row.classList.contains('d-none')) {
                        checkbox.checked = selectAll.checked;
                    }
                });
            });

            // Delete song confirmation
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const songId = this.dataset.id;

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
                            Swal.fire(
                                'Deleted!',
                                'The song has been deleted.',
                                'success'
                            );
                            // Here you would normally make an AJAX call to delete the song
                            // For demo purposes, we'll just hide the row
                            this.closest('tr').remove();
                        }
                    });
                });
            });

            // Filter songs function
            function filterSongs() {
                const albumValue = albumFilter.value.toLowerCase();
                const genreValue = genreFilter.value.toLowerCase();
                const statusValue = statusFilter.value.toLowerCase();
                const searchValue = songSearch.value.toLowerCase();

                songRows.forEach(row => {
                    const album = row.dataset.album.toLowerCase();
                    const genre = row.dataset.genre.toLowerCase();
                    const status = row.dataset.status.toLowerCase();
                    const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const artist = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                    const matchesAlbum = !albumValue || album.includes(albumValue);
                    const matchesGenre = !genreValue || genre.includes(genreValue);
                    const matchesStatus = !statusValue || status.includes(statusValue);
                    const matchesSearch = !searchValue ||
                        title.includes(searchValue) ||
                        artist.includes(searchValue);

                    if (matchesAlbum && matchesGenre && matchesStatus && matchesSearch) {
                        row.classList.remove('d-none');
                    } else {
                        row.classList.add('d-none');
                    }
                });

                // Uncheck "select all" if any visible items are unchecked
                updateSelectAllCheckbox();
            }

            // Update "select all" checkbox state
            function updateSelectAllCheckbox() {
                const visibleCheckboxes = Array.from(songCheckboxes).filter(checkbox =>
                    !checkbox.closest('tr').classList.contains('d-none')
                );

                const allChecked = visibleCheckboxes.every(checkbox => checkbox.checked);
                const someChecked = visibleCheckboxes.some(checkbox => checkbox.checked);

                selectAll.checked = allChecked;
                selectAll.indeterminate = someChecked && !allChecked;
            }

            // Update select all checkbox when individual checkboxes change
            songCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectAllCheckbox);
            });
        });
    </script>
@endsection
