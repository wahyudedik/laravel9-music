@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Daftar Verifikasi
                    </h2>
                    <div class="text-muted mt-1">Manage user verification requests</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-new-verification">
                            <i class="ti ti-plus me-2"></i>
                            New Verification
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- Filters and search -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Filter by Status</label>
                            <select id="status-filter" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Filter by Type</label>
                            <select id="type-filter" class="form-select">
                                <option value="">All Types</option>
                                <option value="artist">Artist</option>
                                <option value="composer">Composer</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" id="search-input" class="form-control"
                                    placeholder="Search by name...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">Verification Requests</h3>
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-new-verification">
                        <i class="ti ti-plus me-1"></i> New Request
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped table-hover" id="verifications-table">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>User</th>
                                <th>Tipe</th>
                                <th>Documents</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($verifications as $verification)
                                <tr data-status="{{ $verification->status }}" data-type="{{ $verification->type }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-sm me-2"
                                                style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($verification->user->name) }}&background=e53935&color=fff)"></span>
                                            <div>
                                                <div class="font-weight-medium">
                                                    <a
                                                        href="{{ route('admin.user-profiles.show', $verification->user->id) }}">{{ $verification->user->name }}</a>
                                                </div>
                                                <div class="text-muted text-nowrap">{{ $verification->type }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-primary-lt text-primary">{{ ucfirst($verification->type) }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ asset('storage/' . $verification->document_ktp) }}" target="_blank"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="View KTP">
                                                <i class="ti ti-id"></i>
                                            </a>
                                            @if ($verification->document_npwp)
                                                <a href="{{ asset('storage/' . $verification->document_npwp) }}"
                                                    target="_blank" class="btn btn-sm btn-icon btn-outline-primary"
                                                    data-bs-toggle="tooltip" title="View NPWP">
                                                    <i class="ti ti-file-text"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($verification->status === 'pending')
                                            <span class="status status-warning">
                                                <span class="status-dot status-dot-animated"></span>
                                                Pending
                                            </span>
                                        @elseif($verification->status === 'approved')
                                            <span class="status status-success">
                                                <span class="status-dot"></span>
                                                Approved
                                            </span>
                                        @elseif($verification->status === 'rejected')
                                            <span class="status status-danger">
                                                <span class="status-dot"></span>
                                                Rejected
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="text-muted">{{ $verification->created_at->format('d M Y') }}</div>
                                        <div class="text-muted text-xs">{{ $verification->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="#" class="btn btn-sm btn-icon btn-ghost-secondary view-details"
                                                data-id="{{ $verification->id }}" data-bs-toggle="tooltip"
                                                title="View Details">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            @if ($verification->status === 'pending')
                                                <form
                                                    action="{{ route('admin.verifications.approve', $verification->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-icon btn-ghost-success"
                                                        data-bs-toggle="tooltip" title="Approve">
                                                        <i class="ti ti-check"></i>
                                                    </button>
                                                </form>

                                                <form
                                                    action="{{ route('admin.verifications.reject', $verification->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-icon btn-ghost-danger"
                                                        data-bs-toggle="tooltip" title="Reject">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="#"
                                                class="btn btn-sm btn-icon btn-ghost-danger delete-verification"
                                                data-id="{{ $verification->id }}" data-bs-toggle="tooltip"
                                                title="Delete">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p class="m-0 text-muted">
                        <span class="text-secondary">Showing</span>
                        <span class="fw-bold">{{ $verifications->firstItem() ?? 0 }}</span>
                        <span class="text-secondary">to</span>
                        <span class="fw-bold">{{ $verifications->lastItem() ?? 0 }}</span>
                        <span class="text-secondary">of</span>
                        <span class="fw-bold">{{ $verifications->total() }}</span>
                        <span class="text-secondary">entries</span>
                    </p>
                    <div class="pagination m-0">
                        {{ $verifications->onEachSide(1)->links('pagination.tabler') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Verification Modal -->
    <div class="modal modal-blur fade" id="modal-new-verification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.verifications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Select User</label>
                            <select name="user_id" class="form-select" required>
                                <option value="">Select a user</option>
                                @foreach ($users ?? [] as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Verification Type</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select type</option>
                                <option value="artist">Artist</option>
                                <option value="composer">Composer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">KTP Document</label>
                            <input type="file" name="document_ktp" class="form-control" required>
                            <small class="form-hint">Upload a clear image of the KTP (JPG, PNG, PDF, max 2MB)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NPWP Document (Optional)</label>
                            <input type="file" name="document_npwp" class="form-control">
                            <small class="form-hint">Upload a clear image of the NPWP (JPG, PNG, PDF, max 2MB)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes about this verification"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="ti ti-plus me-2"></i>Create Verification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Verification Modal -->
    <div class="modal modal-blur fade" id="modal-edit-verification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-verification-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <input type="text" id="edit-user" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Verification Type</label>
                            <select name="type" id="edit-type" class="form-select" required>
                                <option value="artist">Artist</option>
                                <option value="composer">Composer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Update KTP Document</label>
                            <input type="file" name="document_ktp" class="form-control">
                            <small class="form-hint">Leave empty to keep current document</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Update NPWP Document</label>
                            <input type="file" name="document_npwp" class="form-control">
                            <small class="form-hint">Leave empty to keep current document</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="edit-status" class="form-select">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" id="edit-notes" class="form-control" rows="3"
                                placeholder="Additional notes about this verification"></textarea>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="ti ti-device-floppy me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div class="modal modal-blur fade" id="modal-view-details" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verification Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">User</label>
                                <div class="form-control-plaintext" id="detail-user"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="form-control-plaintext" id="detail-email"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Verification Type</label>
                                <div class="form-control-plaintext" id="detail-type"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div id="detail-status"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Created At</label>
                                <div class="form-control-plaintext" id="detail-created"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Updated At</label>
                                <div class="form-control-plaintext" id="detail-updated"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <div class="form-control-plaintext" id="detail-notes"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">KTP Document</h4>
                                </div>
                                <div class="card-body">
                                    <div class="text-center" id="detail-ktp-preview">
                                        <!-- KTP preview will be loaded here -->
                                    </div>
                                    <div class="mt-3 text-center">
                                        <a href="#" class="btn btn-primary" id="detail-ktp-link" target="_blank">
                                            <i class="ti ti-download me-1"></i> Download KTP
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">NPWP Document</h4>
                                </div>
                                <div class="card-body">
                                    <div class="text-center" id="detail-npwp-preview">
                                        <!-- NPWP preview will be loaded here -->
                                    </div>
                                    <div class="mt-3 text-center" id="detail-npwp-actions">
                                        <a href="#" class="btn btn-primary" id="detail-npwp-link" target="_blank">
                                            <i class="ti ti-download me-1"></i> Download NPWP
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <div class="btn-list" id="detail-actions">
                        <!-- Action buttons will be added here based on status -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal modal-blur fade" id="modal-delete-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Are you sure?</div>
                    <div>You are about to delete this verification request. This action cannot be undone.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Cancel</button>
                    <form id="delete-verification-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const statusFilter = document.getElementById('status-filter');
            const typeFilter = document.getElementById('type-filter');
            const searchInput = document.getElementById('search-input');
            const table = document.getElementById('verifications-table');
            const rows = table.querySelectorAll('tbody tr');

            function filterTable() {
                const statusValue = statusFilter.value.toLowerCase();
                const typeValue = typeFilter.value.toLowerCase();
                const searchValue = searchInput.value.toLowerCase();

                rows.forEach(row => {
                    const statusMatch = statusValue === '' || row.dataset.status === statusValue;
                    const typeMatch = typeValue === '' || row.dataset.type === typeValue;
                    const userCell = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const searchMatch = searchValue === '' || userCell.includes(searchValue);

                    if (statusMatch && typeMatch && searchMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            statusFilter.addEventListener('change', filterTable);
            typeFilter.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);

            // Approve verification
            document.querySelectorAll('.approve-verification').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;

                    Swal.fire({
                        title: 'Approve Verification?',
                        text: "This will approve the user's verification request",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#4caf50',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, approve it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/admin/verifications/${id}/approve`;

                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = document.querySelector(
                                'meta[name="csrf-token"]').content;

                            form.appendChild(csrfToken);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

            // Reject verification
            document.querySelectorAll('.reject-verification').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;

                    Swal.fire({
                        title: 'Reject Verification?',
                        text: "This will reject the user's verification request",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, reject it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/admin/verifications/${id}/reject`;

                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = document.querySelector(
                                'meta[name="csrf-token"]').content;

                            form.appendChild(csrfToken);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

            // Edit verification
            document.querySelectorAll('.edit-verification').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const user = this.dataset.user;
                    const type = this.dataset.type;
                    const status = this.dataset.status;

                    document.getElementById('edit-user').value = user;
                    document.getElementById('edit-type').value = type;
                    document.getElementById('edit-status').value = status;

                    const form = document.getElementById('edit-verification-form');
                    form.action = `/admin/verifications/${id}`;

                    const modal = new bootstrap.Modal(document.getElementById(
                        'modal-edit-verification'));
                    modal.show();
                });
            });

            // View verification details
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;

                    // Fetch verification details via AJAX
                    fetch(`/admin/verifications/${id}/details`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the modal with verification details
                            document.getElementById('detail-user').textContent = data.user.name;
                            document.getElementById('detail-email').textContent = data.user
                                .email;
                            document.getElementById('detail-type').textContent = data.type
                                .charAt(0).toUpperCase() + data.type.slice(1);
                            document.getElementById('detail-created').textContent = new Date(
                                data.created_at).toLocaleString();
                            document.getElementById('detail-updated').textContent = new Date(
                                data.updated_at).toLocaleString();
                            document.getElementById('detail-notes').textContent = data.notes ||
                                'No notes available';

                            // Set status badge
                            let statusBadge = '';
                            if (data.status === 'pending') {
                                statusBadge =
                                    '<span class="badge bg-warning text-dark">Pending</span>';
                            } else if (data.status === 'approved') {
                                statusBadge = '<span class="badge bg-success">Approved</span>';
                            } else if (data.status === 'rejected') {
                                statusBadge = '<span class="badge bg-danger">Rejected</span>';
                            }
                            document.getElementById('detail-status').innerHTML = statusBadge;

                            // Set document links
                            const ktpLink = document.getElementById('detail-ktp-link');
                            ktpLink.href = `/storage/${data.document_ktp}`;

                            // Set KTP preview
                            const ktpPreview = document.getElementById('detail-ktp-preview');
                            const ktpExt = data.document_ktp.split('.').pop().toLowerCase();
                            if (['jpg', 'jpeg', 'png', 'gif'].includes(ktpExt)) {
                                ktpPreview.innerHTML =
                                    `<img src="/storage/${data.document_ktp}" class="img-fluid rounded" style="max-height: 200px;">`;
                            } else {
                                ktpPreview.innerHTML =
                                    `<div class="document-icon"><i class="ti ti-file-text fs-1"></i></div><p>Document Preview Not Available</p>`;
                            }

                            // Set NPWP preview and link
                            const npwpPreview = document.getElementById('detail-npwp-preview');
                            const npwpActions = document.getElementById('detail-npwp-actions');

                            if (data.document_npwp) {
                                const npwpLink = document.getElementById('detail-npwp-link');
                                npwpLink.href = `/storage/${data.document_npwp}`;

                                const npwpExt = data.document_npwp.split('.').pop()
                                    .toLowerCase();
                                if (['jpg', 'jpeg', 'png', 'gif'].includes(npwpExt)) {
                                    npwpPreview.innerHTML =
                                        `<img src="/storage/${data.document_npwp}" class="img-fluid rounded" style="max-height: 200px;">`;
                                } else {
                                    npwpPreview.innerHTML =
                                        `<div class="document-icon"><i class="ti ti-file-text fs-1"></i></div><p>Document Preview Not Available</p>`;
                                }
                                npwpActions.style.display = 'block';
                            } else {
                                npwpPreview.innerHTML =
                                    '<p class="text-muted">No NPWP document provided</p>';
                                npwpActions.style.display = 'none';
                            }

                            // Set action buttons based on status
                            const actionContainer = document.getElementById('detail-actions');
                            actionContainer.innerHTML = '';

                            if (data.status === 'pending') {
                                const approveBtn = document.createElement('button');
                                approveBtn.className = 'btn btn-success';
                                approveBtn.innerHTML =
                                    '<i class="ti ti-check me-1"></i> Approve';
                                approveBtn.addEventListener('click', function() {
                                    document.querySelector(
                                            `.approve-verification[data-id="${id}"]`)
                                        .click();
                                });

                                const rejectBtn = document.createElement('button');
                                rejectBtn.className = 'btn btn-danger ms-2';
                                rejectBtn.innerHTML = '<i class="ti ti-x me-1"></i> Reject';
                                rejectBtn.addEventListener('click', function() {
                                    document.querySelector(
                                            `.reject-verification[data-id="${id}"]`)
                                        .click();
                                });

                                actionContainer.appendChild(approveBtn);
                                actionContainer.appendChild(rejectBtn);
                            }

                            // Show the modal
                            const modal = new bootstrap.Modal(document.getElementById(
                                'modal-view-details'));
                            modal.show();
                        })
                        .catch(error => {
                            console.error('Error fetching verification details:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to load verification details',
                            });
                        });
                });
            });

            // Delete verification
            document.querySelectorAll('.delete-verification').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;

                    const form = document.getElementById('delete-verification-form');
                    form.action = `/admin/verifications/${id}`;

                    const modal = new bootstrap.Modal(document.getElementById(
                        'modal-delete-confirmation'));
                    modal.show();
                });
            });
        });
    </script>
@endsection
