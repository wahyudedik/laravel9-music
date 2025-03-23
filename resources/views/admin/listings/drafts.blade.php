@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Draft Songs
                    </h2>
                    <div class="text-muted mt-1">Songs that are not yet published</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.listings.published') }}"
                            class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-check me-2"></i>
                            View Published
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
                    <h3 class="card-title">Draft Songs</h3>
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
                                <th>Created Date</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $songTitles = [
                                    'Unreleased Track 1',
                                    'Coming Soon',
                                    'New Single',
                                    'Next Hit',
                                    'Upcoming Release',
                                    'Studio Session',
                                    'Work in Progress',
                                    'Demo Track',
                                    'Sneak Peek',
                                    'Preview',
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
                                $statuses = ['draft', 'review', 'scheduled'];
                                $statusLabels = [
                                    'draft' => 'Draft',
                                    'review' => 'In Review',
                                    'scheduled' => 'Scheduled',
                                ];
                                $statusClasses = [
                                    'draft' => 'bg-secondary',
                                    'review' => 'bg-info',
                                    'scheduled' => 'bg-primary',
                                ];
                            @endphp

                            @for ($i = 0; $i < 10; $i++)
                                @php
                                    $title = $songTitles[$i % count($songTitles)];
                                    $artist = $artists[rand(0, count($artists) - 1)];
                                    $genre = $genres[rand(0, count($genres) - 1)];
                                    $createdDate = date('Y-m-d', strtotime('-' . rand(1, 30) . ' days'));
                                    $updatedDate = date('Y-m-d', strtotime('-' . rand(0, 7) . ' days'));
                                    $status = $statuses[rand(0, count($statuses) - 1)];
                                    $statusLabel = $statusLabels[$status];
                                    $badgeClass = $statusClasses[$status];
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://picsum.photos/40/40?random={{ $i + 200 }})"></span>
                                            <div>{{ $title }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $artist }}</td>
                                    <td>{{ $genre }}</td>
                                    <td>{{ $createdDate }}</td>
                                    <td>{{ $updatedDate }}</td>
                                    <td><span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#modal-draft-details"
                                                    data-draft-id="{{ $i }}">
                                                    <i class="ti ti-eye me-2"></i>View Details
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-player-play me-2"></i>Preview
                                                </a>
                                                <a href="#" class="dropdown-item text-success publish-song"
                                                    data-draft-id="{{ $i }}">
                                                    <i class="ti ti-check me-2"></i>Publish
                                                </a>
                                                @if ($status === 'scheduled')
                                                    <a href="#" class="dropdown-item text-warning unschedule-song"
                                                        data-draft-id="{{ $i }}">
                                                        <i class="ti ti-calendar-off me-2"></i>Unschedule
                                                    </a>
                                                @endif
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
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of <span>25</span> entries</p>
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

    <!-- Draft Details Modal -->
    <div class="modal modal-blur fade" id="modal-draft-details" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Draft Song Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="https://picsum.photos/400/400?random=201" class="img-fluid rounded"
                                alt="Song Cover" id="draftCover">
                        </div>
                        <div class="col-md-8">
                            <h2 id="draftTitle">Unreleased Track 1</h2>
                            <p class="text-muted" id="draftArtist">The Weeknd</p>

                            <div class="mb-2">
                                <span class="badge bg-primary me-1" id="draftGenre">Pop</span>
                                <span class="badge bg-secondary" id="draftStatus">Draft</span>
                            </div>

                            <div class="mt-3">
                                <div class="mb-2">
                                    <strong>Composer:</strong> <span id="draftComposer">Max Martin</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Created Date:</strong> <span id="draftCreatedDate">2023-05-15</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Last Updated:</strong> <span id="draftUpdatedDate">2023-05-20</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Duration:</strong> <span id="draftDuration">3:15</span>
                                </div>
                                <div class="mb-2" id="scheduledDateContainer" style="display: none;">
                                    <strong>Scheduled Release:</strong> <span id="scheduledDate">2023-06-15</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-primary" id="completionProgress" style="width: 75%"
                                        role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        aria-label="75% Complete">
                                        <span class="visually-hidden">75% Complete</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span class="text-muted fs-6">Completion</span>
                                    <span class="text-muted fs-6" id="completionPercentage">75%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4>Description</h4>
                            <p id="draftDescription">This is a draft song that is currently being worked on. The song
                                features elements of pop and electronic music with catchy hooks and memorable lyrics.</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h4>Checklist</h4>
                            <div class="mb-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <span class="form-check-label">Audio file uploaded</span>
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <span class="form-check-label">Cover art uploaded</span>
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <span class="form-check-label">Metadata completed</span>
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-label">Rights cleared</span>
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-label">Final approval</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3" id="scheduleContainer" style="display: none;">
                        <div class="col-12">
                            <h4>Release Schedule</h4>
                            <div class="mb-3">
                                <label class="form-label">Release Date</label>
                                <input type="date" class="form-control" id="releaseDate">
                            </div>
                            <div class="mb-3">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="notifyArtistSwitch">
                                    <span class="form-check-label">Notify artist upon release</span>
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="promotionSwitch">
                                    <span class="form-check-label">Include in promotional campaigns</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="scheduleBtn">
                        <i class="ti ti-calendar me-2"></i>Schedule Release
                    </button>
                    <button type="button" class="btn btn-success" id="publishNowBtn">
                        <i class="ti ti-check me-2"></i>Publish Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Song Modal (same as in published.blade.php) -->
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
                            <input class="form-check-input" type="checkbox">
                            <span class="form-check-label">Save as draft</span>
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
                    text: 'The song has been added as a draft.',
                    confirmButtonColor: '#e53935',
                }).then(() => {
                    // Close the modal
                    bootstrap.Modal.getInstance(document.getElementById('modal-add-song')).hide();
                });
            });

            // Draft details modal handler
            document.querySelectorAll('[data-bs-target="#modal-draft-details"]').forEach(button => {
                button.addEventListener('click', function() {
                    const draftId = this.getAttribute('data-draft-id');
                    const row = this.closest('tr');
                    const title = row.querySelector('td:nth-child(1) div').textContent.trim();
                    const artist = row.querySelector('td:nth-child(2)').textContent.trim();
                    const genre = row.querySelector('td:nth-child(3)').textContent.trim();
                    const createdDate = row.querySelector('td:nth-child(4)').textContent.trim();
                    const updatedDate = row.querySelector('td:nth-child(5)').textContent.trim();
                    const status = row.querySelector('td:nth-child(6) .badge').textContent.trim()
                        .toLowerCase();

                    // Update modal content
                    document.getElementById('draftTitle').textContent = title;
                    document.getElementById('draftArtist').textContent = artist;
                    document.getElementById('draftGenre').textContent = genre;
                    document.getElementById('draftCreatedDate').textContent = createdDate;
                    document.getElementById('draftUpdatedDate').textContent = updatedDate;
                    document.getElementById('draftCover').src =
                        `https://picsum.photos/400/400?random=${parseInt(draftId) + 200}`;

                    // Update status badge
                    const statusBadge = document.getElementById('draftStatus');
                    statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);

                    const badgeClasses = {
                        'draft': 'bg-secondary',
                        'in review': 'bg-info',
                        'scheduled': 'bg-primary'
                    };

                    statusBadge.className = `badge ${badgeClasses[status] || 'bg-secondary'}`;

                    // Random data for other fields
                    document.getElementById('draftComposer').textContent = ['Max Martin',
                        'Jack Antonoff', 'Louis Bell', 'Andrew Watt', 'Finneas O\'Connell'
                    ][Math.floor(Math.random() * 5)];
                    document.getElementById('draftDuration').textContent =
                        `${Math.floor(Math.random() * 4) + 2}:${Math.floor(Math.random() * 60).toString().padStart(2, '0')}`;

                    // Random completion percentage
                    const completionPercentage = Math.floor(Math.random() * 100);
                    document.getElementById('completionProgress').style.width =
                        `${completionPercentage}%`;
                    document.getElementById('completionProgress').setAttribute('aria-valuenow',
                        completionPercentage);
                    document.getElementById('completionPercentage').textContent =
                        `${completionPercentage}%`;

                    // Show/hide scheduled date container based on status
                    const scheduledDateContainer = document.getElementById(
                    'scheduledDateContainer');
                    scheduledDateContainer.style.display = status === 'scheduled' ? 'block' :
                    'none';

                    if (status === 'scheduled') {
                        // Generate a future date for scheduled release
                        const futureDate = new Date();
                        futureDate.setDate(futureDate.getDate() + Math.floor(Math.random() * 30) +
                            1);
                        document.getElementById('scheduledDate').textContent = futureDate
                            .toISOString().split('T')[0];
                    }

                    // Random description
                    const descriptions = [
                        "This draft song features a catchy melody with modern production elements. The lyrics explore themes of love and personal growth.",
                        "An upbeat track with infectious rhythms and memorable hooks. Currently in the final stages of production.",
                        "A soulful ballad that showcases the artist's vocal range. Some mixing adjustments are still needed before release.",
                        "This energetic song combines elements of pop and electronic music. The bridge section is still being finalized.",
                        "A collaborative track featuring guest vocals. Currently awaiting final approval from all contributing artists."
                    ];
                    document.getElementById('draftDescription').textContent = descriptions[Math
                        .floor(Math.random() * descriptions.length)];

                    // Update buttons based on status
                    const scheduleBtn = document.getElementById('scheduleBtn');
                    const publishNowBtn = document.getElementById('publishNowBtn');

                    if (status === 'scheduled') {
                        scheduleBtn.textContent = 'Update Schedule';
                        scheduleBtn.innerHTML =
                            '<i class="ti ti-calendar-event me-2"></i>Update Schedule';
                    } else {
                        scheduleBtn.textContent = 'Schedule Release';
                        scheduleBtn.innerHTML =
                            '<i class="ti ti-calendar me-2"></i>Schedule Release';
                    }
                });
            });

            // Schedule button click handler
            document.getElementById('scheduleBtn').addEventListener('click', function() {
                const scheduleContainer = document.getElementById('scheduleContainer');

                if (scheduleContainer.style.display === 'none' || scheduleContainer.style.display === '') {
                    scheduleContainer.style.display = 'block';

                    // Set default release date to 2 weeks from now
                    const defaultDate = new Date();
                    defaultDate.setDate(defaultDate.getDate() + 14);
                    document.getElementById('releaseDate').value = defaultDate.toISOString().split('T')[0];

                    // Change button text
                    this.innerHTML = '<i class="ti ti-device-floppy me-2"></i>Save Schedule';
                } else {
                    // Save the schedule
                    const releaseDate = document.getElementById('releaseDate').value;
                    const notifyArtist = document.getElementById('notifyArtistSwitch').checked;
                    const includePromotion = document.getElementById('promotionSwitch').checked;

                    if (!releaseDate) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Please select a release date',
                            confirmButtonColor: '#e53935',
                        });
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Release Scheduled!',
                        html: `The song has been scheduled for release on <strong>${releaseDate}</strong>.`,
                        confirmButtonColor: '#e53935',
                    }).then(() => {
                        // Update the UI
                        document.getElementById('scheduledDateContainer').style.display = 'block';
                        document.getElementById('scheduledDate').textContent = releaseDate;
                        document.getElementById('draftStatus').textContent = 'Scheduled';
                        document.getElementById('draftStatus').className = 'badge bg-primary';

                        // Hide the schedule container
                        scheduleContainer.style.display = 'none';

                        // Reset button text
                        this.innerHTML = '<i class="ti ti-calendar-event me-2"></i>Update Schedule';
                    });
                }
            });

            // Publish now button click handler
            document.getElementById('publishNowBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Publish Song Now?',
                    text: "This will make the song immediately available to the public.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4caf50',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, publish it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Published!',
                            'The song has been published successfully.',
                            'success'
                        ).then(() => {
                            // Close the modal
                            bootstrap.Modal.getInstance(document.getElementById(
                                'modal-draft-details')).hide();
                        });
                    }
                });
            });

            // Publish song handler (from table row)
            document.querySelectorAll('.publish-song').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const draftId = this.getAttribute('data-draft-id');

                    Swal.fire({
                        title: 'Publish Song Now?',
                        text: "This will make the song immediately available to the public.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#4caf50',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, publish it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Published!',
                                'The song has been published successfully.',
                                'success'
                            );
                        }
                    });
                });
            });

            // Unschedule song handler
            document.querySelectorAll('.unschedule-song').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const draftId = this.getAttribute('data-draft-id');

                    Swal.fire({
                        title: 'Unschedule Song?',
                        text: "This will remove the scheduled release date and set the song back to draft status.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ffc107',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, unschedule it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Unscheduled!',
                                'The song has been unscheduled and is now in draft status.',
                                'success'
                            );
                        }
                    });
                });
            });
        });
    </script>
@endsection
