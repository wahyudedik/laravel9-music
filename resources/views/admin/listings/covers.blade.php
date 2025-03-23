@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Cover List
                    </h2>
                    <div class="text-muted mt-1">Manage all cover songs in the system</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.listings.songs') }}"
                            class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-music me-2"></i>
                            View Original Songs
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
                    <h3 class="card-title">All Cover Songs</h3>
                    <div class="card-actions">
                        <div class="row">
                            <div class="col-auto">
                                <select class="form-select" id="statusFilter">
                                    <option value="all">All Status</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
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
                                <th>Cover Title</th>
                                <th>Original Song</th>
                                <th>Cover Artist</th>
                                <th>Original Artist</th>
                                <th>Upload Date</th>
                                <th>Status</th>
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
                                $coverArtists = [
                                    'Cover Artist 1',
                                    'Cover Artist 2',
                                    'Cover Artist 3',
                                    'Cover Artist 4',
                                    'Cover Artist 5',
                                    'Cover Artist 6',
                                    'Cover Artist 7',
                                    'Cover Artist 8',
                                    'Cover Artist 9',
                                    'Cover Artist 10',
                                ];
                                $statuses = ['approved', 'pending', 'rejected'];
                                $statusClasses = [
                                    'approved' => 'bg-success',
                                    'pending' => 'bg-warning text-dark',
                                    'rejected' => 'bg-danger',
                                ];
                            @endphp

                            @for ($i = 0; $i < 15; $i++)
                                @php
                                    $songIndex = $i % count($songTitles);
                                    $title = $songTitles[$songIndex];
                                    $artist = $artists[$songIndex];
                                    $coverArtist = $coverArtists[rand(0, count($coverArtists) - 1)];
                                    $uploadDate = date('Y-m-d', strtotime('-' . rand(1, 90) . ' days'));
                                    $status = $statuses[rand(0, count($statuses) - 1)];
                                    $badgeClass = $statusClasses[$status];
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://picsum.photos/40/40?random={{ $i + 100 }})"></span>
                                            <div>{{ $title }} (Cover)</div>
                                        </div>
                                    </td>
                                    <td>{{ $title }}</td>
                                    <td>{{ $coverArtist }}</td>
                                    <td>{{ $artist }}</td>
                                    <td>{{ $uploadDate }}</td>
                                    <td><span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#modal-cover-details"
                                                    data-cover-id="{{ $i }}">
                                                    <i class="ti ti-eye me-2"></i>View Details
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-player-play me-2"></i>Preview
                                                </a>
                                                @if ($status === 'pending')
                                                    <a href="#" class="dropdown-item text-success approve-cover"
                                                        data-cover-id="{{ $i }}">
                                                        <i class="ti ti-check me-2"></i>Approve
                                                    </a>
                                                    <a href="#" class="dropdown-item text-danger reject-cover"
                                                        data-cover-id="{{ $i }}">
                                                        <i class="ti ti-x me-2"></i>Reject
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

    <!-- Cover Details Modal -->
    <div class="modal modal-blur fade" id="modal-cover-details" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cover Song Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="https://picsum.photos/400/400?random=101" class="img-fluid rounded"
                                alt="Cover Song">
                        </div>
                        <div class="col-md-8">
                            <h2 id="coverTitle">Blinding Lights (Cover)</h2>
                            <p class="text-muted" id="coverArtist">Cover Artist 1</p>

                            <div class="mb-2">
                                <span class="badge bg-primary me-1">Cover</span>
                                <span class="badge bg-success" id="coverStatus">Approved</span>
                            </div>

                            <div class="mt-3">
                                <div class="mb-2">
                                    <strong>Original Song:</strong> <span id="originalSong">Blinding Lights</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Original Artist:</strong> <span id="originalArtist">The Weeknd</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Upload Date:</strong> <span id="uploadDate">2023-05-15</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Duration:</strong> <span id="coverDuration">3:15</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-4">
                                        <div class="text-muted fs-5">Plays</div>
                                        <div class="h3 m-0" id="coverPlays">45.2K</div>
                                    </div>
                                    <div class="me-4">
                                        <div class="text-muted fs-5">Likes</div>
                                        <div class="h3 m-0" id="coverLikes">2.3K</div>
                                    </div>
                                    <div>
                                        <div class="text-muted fs-5">Revenue</div>
                                        <div class="h3 m-0" id="coverRevenue">Rp 1.5M</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4>License Information</h4>
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <tbody>
                                        <tr>
                                            <td class="w-25"><strong>License Type</strong></td>
                                            <td>Standard Cover License</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Purchase Date</strong></td>
                                            <td id="licenseDate">2023-05-10</td>
                                        </tr>
                                        <tr>
                                            <td><strong>License Fee</strong></td>
                                            <td id="licenseFee">Rp 500.000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Royalty Split</strong></td>
                                            <td>70% Original Artist / 30% Cover Artist</td>
                                        </tr>
                                        <tr>
                                            <td><strong>License Status</strong></td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h4>Comments</h4>
                            <div class="list-group list-group-flush mt-2">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar"
                                                style="background-image: url(https://ui-avatars.com/api/?name=User+1&background=e53935&color=fff)"></span>
                                        </div>
                                        <div class="col">
                                            <div class="text-body">Amazing cover! Love the unique twist.</div>
                                            <div class="text-muted">User 1 • 3 days ago</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar"
                                                style="background-image: url(https://ui-avatars.com/api/?name=User+2&background=e53935&color=fff)"></span>
                                        </div>
                                        <div class="col">
                                            <div class="text-body">I think I like this better than the original!</div>
                                            <div class="text-muted">User 2 • 5 days ago</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar"
                                                style="background-image: url(https://ui-avatars.com/api/?name=User+3&background=e53935&color=fff)"></span>
                                        </div>
                                        <div class="col">
                                            <div class="text-body">Great vocals and production quality!</div>
                                            <div class="text-muted">User 3 • 1 week ago</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="coverModalFooter">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <div id="pendingActions" style="display: none;">
                        <button type="button" class="btn btn-danger me-2" id="modalRejectBtn">
                            <i class="ti ti-x me-2"></i>Reject Cover
                        </button>
                        <button type="button" class="btn btn-success" id="modalApproveBtn">
                            <i class="ti ti-check me-2"></i>Approve Cover
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('tbody tr');

            // Filter function
            function filterTable() {
                const statusValue = statusFilter.value.toLowerCase();
                const searchValue = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const status = row.querySelector('td:nth-child(6) .badge').textContent.toLowerCase();
                    const rowText = row.textContent.toLowerCase();

                    const statusMatch = statusValue === 'all' || status === statusValue;
                    const searchMatch = rowText.includes(searchValue);

                    row.style.display = statusMatch && searchMatch ? '' : 'none';
                });
            }

            // Add event listeners
            statusFilter.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);

            // Cover details modal handler
            document.querySelectorAll('[data-bs-target="#modal-cover-details"]').forEach(button => {
                button.addEventListener('click', function() {
                    const coverId = this.getAttribute('data-cover-id');
                    const row = this.closest('tr');
                    const title = row.querySelector('td:nth-child(1) div').textContent.trim();
                    const originalSong = row.querySelector('td:nth-child(2)').textContent.trim();
                    const coverArtist = row.querySelector('td:nth-child(3)').textContent.trim();
                    const originalArtist = row.querySelector('td:nth-child(4)').textContent.trim();
                    const uploadDate = row.querySelector('td:nth-child(5)').textContent.trim();
                    const status = row.querySelector('td:nth-child(6) .badge').textContent.trim()
                        .toLowerCase();

                    // Update modal content
                    document.getElementById('coverTitle').textContent = title;
                    document.getElementById('coverArtist').textContent = coverArtist;
                    document.getElementById('originalSong').textContent = originalSong;
                    document.getElementById('originalArtist').textContent = originalArtist;
                    document.getElementById('uploadDate').textContent = uploadDate;

                    // Update status badge
                    const statusBadge = document.getElementById('coverStatus');
                    statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                    statusBadge.className =
                        `badge ${status === 'approved' ? 'bg-success' : status === 'pending' ? 'bg-warning text-dark' : 'bg-danger'}`;

                    // Random data for other fields
                    document.getElementById('coverDuration').textContent =
                        `${Math.floor(Math.random() * 4) + 2}:${Math.floor(Math.random() * 60).toString().padStart(2, '0')}`;
                    document.getElementById('coverPlays').textContent =
                        `${(Math.random() * 100).toFixed(1)}K`;
                    document.getElementById('coverLikes').textContent =
                        `${(Math.random() * 10).toFixed(1)}K`;
                    document.getElementById('coverRevenue').textContent =
                        `Rp ${(Math.random() * 5).toFixed(1)}M`;
                    document.getElementById('licenseDate').textContent = new Date(new Date(
                            uploadDate) - Math.random() * 5 * 24 * 60 * 60 * 1000).toISOString()
                        .split('T')[0];
                    document.getElementById('licenseFee').textContent =
                        `Rp ${(Math.random() * 1000000).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;

                    // Show/hide pending actions
                    const pendingActions = document.getElementById('pendingActions');
                    pendingActions.style.display = status === 'pending' ? 'block' : 'none';
                });
            });

            // Approve cover handler
            function handleApprove(coverId) {
                Swal.fire({
                    title: 'Approve Cover?',
                    text: "This will approve the cover song and make it publicly available.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4caf50',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Approved!',
                            'The cover song has been approved.',
                            'success'
                        ).then(() => {
                            // In a real app, we would update the database
                            // For now, just close the modal if it's open
                            const modal = document.getElementById('modal-cover-details');
                            if (modal.classList.contains('show')) {
                                bootstrap.Modal.getInstance(modal).hide();
                            }
                        });
                    }
                });
            }

            // Reject cover handler
            function handleReject(coverId) {
                Swal.fire({
                    title: 'Reject Cover?',
                    text: "This will reject the cover song.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, reject it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Provide Rejection Reason',
                            input: 'textarea',
                            inputLabel: 'Reason for rejection',
                            inputPlaceholder: 'Enter your reason here...',
                            inputAttributes: {
                                'aria-label': 'Reason for rejection'
                            },
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'Reject'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Rejected!',
                                    'The cover song has been rejected.',
                                    'success'
                                ).then(() => {
                                    // In a real app, we would update the database
                                    // For now, just close the modal if it's open
                                    const modal = document.getElementById(
                                        'modal-cover-details');
                                    if (modal.classList.contains('show')) {
                                        bootstrap.Modal.getInstance(modal).hide();
                                    }
                                });
                            }
                        });
                    }
                });
            }

            // Add event listeners for approve/reject buttons
            document.querySelectorAll('.approve-cover').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const coverId = this.getAttribute('data-cover-id');
                    handleApprove(coverId);
                });
            });

            document.querySelectorAll('.reject-cover').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const coverId = this.getAttribute('data-cover-id');
                    handleReject(coverId);
                });
            });

            // Modal approve/reject buttons
            document.getElementById('modalApproveBtn').addEventListener('click', function() {
                const coverId = document.querySelector('[data-bs-target="#modal-cover-details"]')
                    .getAttribute('data-cover-id');
                handleApprove(coverId);
            });

            document.getElementById('modalRejectBtn').addEventListener('click', function() {
                const coverId = document.querySelector('[data-bs-target="#modal-cover-details"]')
                    .getAttribute('data-cover-id');
                handleReject(coverId);
            });
        });
    </script>
@endsection
