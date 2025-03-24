@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Published Songs
                    </h2>
                    <div class="text-muted mt-1">Songs that are currently available to the public</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.listings.drafts') }}"
                            class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-file me-2"></i>
                            View Drafts
                        </a>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-add-song">
                            <i class="ti ti-plus me-2"></i>
                            Add New Song
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Published Songs</h3>
                    <div class="card-actions">
                        <div class="row">
                            <div class="col-auto">
                                <select class="form-select" id="genreFilter">
                                    <option value="all">All Genres</option>
                                    <option value="pop">Pop</option>
                                    <option value="rock">Rock</option>
                                    <option value="hiphop">Hip Hop</option>
                                    <option value="electronic">Electronic</option>
                                    <option value="jazz">Jazz</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <select class="form-select" id="artistFilter">
                                    <option value="all">All Artists</option>
                                    <option value="the weeknd">The Weeknd</option>
                                    <option value="dua lipa">Dua Lipa</option>
                                    <option value="justin bieber">Justin Bieber</option>
                                    <option value="lil nas x">Lil Nas X</option>
                                    <option value="olivia rodrigo">Olivia Rodrigo</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Search..." id="searchInput">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Genre</th>
                                <th>Release Date</th>
                                <th>Plays</th>
                                <th>Revenue</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $songTitles = [
                                    'Blinding Lights',
                                    'Save Your Tears',
                                    'Levitating',
                                    'Stay',
                                    'Industry Baby',
                                    'Good 4 U',
                                    'Montero',
                                    'Peaches',
                                    'Butter',
                                    'Dynamite',
                                    'Drivers License',
                                    'Kiss Me More',
                                    'Bad Habits',
                                    'Shivers',
                                    'Heat Waves',
                                ];
                                $artists = [
                                    'The Weeknd',
                                    'Dua Lipa',
                                    'Justin Bieber',
                                    'Lil Nas X',
                                    'Olivia Rodrigo',
                                    'BTS',
                                    'Ed Sheeran',
                                    'Adele',
                                    'Billie Eilish',
                                    'Glass Animals',
                                ];
                                $genres = ['Pop', 'Rock', 'Hip Hop', 'Electronic', 'Jazz'];
                            @endphp

                            @for ($i = 0; $i < 15; $i++)
                                @php
                                    $title = $songTitles[$i % count($songTitles)];
                                    $artist = $artists[$i % count($artists)];
                                    $genre = $genres[rand(0, count($genres) - 1)];
                                    $releaseDate = date('Y-m-d', strtotime('-' . rand(1, 365) . ' days'));
                                    $plays = rand(10000, 5000000);
                                    $revenue = rand(1000000, 100000000);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://picsum.photos/40/40?random={{ $i }})"></span>
                                            <div>{{ $title }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $artist }}</td>
                                    <td>{{ $genre }}</td>
                                    <td>{{ $releaseDate }}</td>
                                    <td>{{ number_format($plays) }}</td>
                                    <td>Rp {{ number_format($revenue, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#modal-song-details" data-song-id="{{ $i }}">
                                                    <i class="ti ti-eye me-2"></i>View Details
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-player-play me-2"></i>Preview
                                                </a>
                                                <a href="#" class="dropdown-item text-warning unpublish-song"
                                                    data-song-id="{{ $i }}">
                                                    <i class="ti ti-file-off me-2"></i>Unpublish
                                                </a>
                                                <a href="#" class="dropdown-item text-danger">
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

    <!-- Song Details Modal -->
    <div class="modal modal-blur fade" id="modal-song-details" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Song Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="https://picsum.photos/400/400?random=1" class="img-fluid rounded" alt="Song Cover"
                                id="songCover">
                        </div>
                        <div class="col-md-8">
                            <h2 id="songTitle">Blinding Lights</h2>
                            <p class="text-muted" id="songArtist">The Weeknd</p>

                            <div class="mb-2">
                                <span class="badge bg-primary me-1" id="songGenre">Pop</span>
                                <span class="badge bg-success">Published</span>
                            </div>

                            <div class="mt-3">
                                <div class="mb-2">
                                    <strong>Composer:</strong> <span id="songComposer">Max Martin</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Release Date:</strong> <span id="songReleaseDate">2020-11-29</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Duration:</strong> <span id="songDuration">3:20</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Album:</strong> <span id="songAlbum">After Hours</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-4">
                                        <div class="text-muted fs-5">Plays</div>
                                        <div class="h3 m-0" id="songPlays">1.2M</div>
                                    </div>
                                    <div class="me-4">
                                        <div class="text-muted fs-5">Downloads</div>
                                        <div class="h3 m-0" id="songDownloads">45.3K</div>
                                    </div>
                                    <div>
                                        <div class="text-muted fs-5">Revenue</div>
                                        <div class="h3 m-0" id="songRevenue">Rp 25.6M</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4>Performance Analytics</h4>
                            <div class="card">
                                <div class="card-body">
                                    <div id="chart-placeholder"
                                        style="height: 200px; background-color: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                        <span class="text-muted">Chart visualization would appear here</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h4>Cover Versions</h4>
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Artist</th>
                                            <th>Date</th>
                                            <th>Plays</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="coversList">
                                        <!-- Cover versions will be populated dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="unpublishBtn">
                        <i class="ti ti-file-off me-2"></i>Unpublish
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="ti ti-edit me-2"></i>Edit Song
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Song Modal -->
    <div class="modal modal-blur fade" id="modal-add-song" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Song</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Song Title</label>
                        <input type="text" class="form-control" placeholder="Enter song title">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Artist</label>
                                <input type="text" class="form-control" placeholder="Enter artist name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Composer</label>
                                <input type="text" class="form-control" placeholder="Enter composer name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <select class="form-select">
                                    <option value="">Select genre</option>
                                    <option value="pop">Pop</option>
                                    <option value="rock">Rock</option>
                                    <option value="hiphop">Hip Hop</option>
                                    <option value="electronic">Electronic</option>
                                    <option value="jazz">Jazz</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Release Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Album</label>
                        <input type="text" class="form-control" placeholder="Enter album name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" class="form-control" placeholder="e.g. 3:45">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="4" placeholder="Enter song description"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Cover Image</div>
                        <input type="file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Audio File</div>
                        <input type="file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" checked>
                            <span class="form-check-label">Publish immediately</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addSongBtn">Add Song</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const genreFilter = document.getElementById('genreFilter');
            const artistFilter = document.getElementById('artistFilter');
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('tbody tr');

            // Filter function
            function filterTable() {
                const genreValue = genreFilter.value.toLowerCase();
                const artistValue = artistFilter.value.toLowerCase();
                const searchValue = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const genre = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const artist = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const rowText = row.textContent.toLowerCase();

                    const genreMatch = genreValue === 'all' || genre.includes(genreValue);
                    const artistMatch = artistValue === 'all' || artist.includes(artistValue);
                    const searchMatch = rowText.includes(searchValue);

                    row.style.display = genreMatch && artistMatch && searchMatch ? '' : 'none';
                });
            }

            // Add event listeners
            genreFilter.addEventListener('change', filterTable);
            artistFilter.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);

            // Add song button click handler
            document.getElementById('addSongBtn').addEventListener('click', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Song Added!',
                    text: 'The song has been added successfully.',
                    confirmButtonColor: '#e53935',
                }).then(() => {
                    // Close the modal
                    bootstrap.Modal.getInstance(document.getElementById('modal-add-song')).hide();
                });
            });

            // Song details modal handler
            document.querySelectorAll('[data-bs-target="#modal-song-details"]').forEach(button => {
                button.addEventListener('click', function() {
                    const songId = this.getAttribute('data-song-id');
                    const row = this.closest('tr');
                    const title = row.querySelector('td:nth-child(1) div').textContent.trim();
                    const artist = row.querySelector('td:nth-child(2)').textContent.trim();
                    const genre = row.querySelector('td:nth-child(3)').textContent.trim();
                    const releaseDate = row.querySelector('td:nth-child(4)').textContent.trim();
                    const plays = row.querySelector('td:nth-child(5)').textContent.trim();
                    const revenue = row.querySelector('td:nth-child(6)').textContent.trim();

                    // Update modal content
                    document.getElementById('songTitle').textContent = title;
                    document.getElementById('songArtist').textContent = artist;
                    document.getElementById('songGenre').textContent = genre;
                    document.getElementById('songReleaseDate').textContent = releaseDate;
                    document.getElementById('songPlays').textContent = formatNumber(parseInt(plays
                        .replace(/,/g, '')));
                    document.getElementById('songRevenue').textContent = revenue;
                    document.getElementById('songCover').src =
                        `https://picsum.photos/400/400?random=${songId}`;

                    // Random data for other fields
                    document.getElementById('songComposer').textContent = ['Max Martin',
                        'Jack Antonoff', 'Louis Bell', 'Andrew Watt', 'Finneas O\'Connell'
                    ][Math.floor(Math.random() * 5)];
                    document.getElementById('songDuration').textContent =
                        `${Math.floor(Math.random() * 4) + 2}:${Math.floor(Math.random() * 60).toString().padStart(2, '0')}`;
                    document.getElementById('songAlbum').textContent = ['After Hours',
                        'Future Nostalgia', 'Justice', 'Montero', 'Sour'
                    ][Math.floor(Math.random() * 5)];
                    document.getElementById('songDownloads').textContent =
                        `${(Math.random() * 100).toFixed(1)}K`;

                    // Generate random cover versions
                    const coversList = document.getElementById('coversList');
                    coversList.innerHTML = '';

                    const numCovers = Math.floor(Math.random() * 5) + 1;
                    for (let i = 0; i < numCovers; i++) {
                        const coverArtist = `Cover Artist ${i + 1}`;
                        const coverDate = new Date(new Date(releaseDate) - Math.random() * 90 * 24 *
                            60 * 60 * 1000).toISOString().split('T')[0];
                        const coverPlays = Math.floor(Math.random() * 50000) + 1000;
                        const statuses = ['Approved', 'Pending', 'Rejected'];
                        const statusClasses = ['bg-success', 'bg-warning text-dark', 'bg-danger'];
                        const statusIndex = Math.floor(Math.random() * 3);

                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="avatar me-2" style="background-image: url(https://ui-avatars.com/api/?name=${encodeURIComponent(coverArtist)}&background=e53935&color=fff)"></span>
                                    <div>${coverArtist}</div>
                                </div>
                            </td>
                            <td>${coverDate}</td>
                            <td>${coverPlays.toLocaleString()}</td>
                            <td><span class="badge ${statusClasses[statusIndex]}">${statuses[statusIndex]}</span></td>
                        `;

                        coversList.appendChild(row);
                    }
                });
            });

            // Unpublish song handler
            function unpublishSong(songId) {
                Swal.fire({
                    title: 'Unpublish Song?',
                    text: "This will make the song unavailable to the public. You can republish it later.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, unpublish it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Unpublished!',
                            'The song has been unpublished.',
                            'success'
                        ).then(() => {
                            // In a real app, we would update the database
                            // For now, just close the modal if it's open
                            const modal = document.getElementById('modal-song-details');
                            if (modal.classList.contains('show')) {
                                bootstrap.Modal.getInstance(modal).hide();
                            }
                        });
                    }
                });
            }

            // Add event listeners for unpublish buttons
            document.querySelectorAll('.unpublish-song').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const songId = this.getAttribute('data-song-id');
                    unpublishSong(songId);
                });
            });

            // Modal unpublish button
            document.getElementById('unpublishBtn').addEventListener('click', function() {
                const songId = document.querySelector('[data-bs-target="#modal-song-details"]')
                    .getAttribute('data-song-id');
                unpublishSong(songId);
            });

            // Helper function to format numbers
            function formatNumber(num) {
                if (num >= 1000000) {
                    return (num / 1000000).toFixed(1) + 'M';
                }
                if (num >= 1000) {
                    return (num / 1000).toFixed(1) + 'K';
                }
                return num.toString();
            }
        });
    </script>
@endsection
