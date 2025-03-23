@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Withdraw Verification
                    </h2>
                    <div class="text-muted mt-1">Manage and verify user withdrawal requests</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to Dashboard
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
                    <h3 class="card-title">Pending Withdrawal Requests</h3>
                    <div class="card-actions">
                        <div class="row">
                            <div class="col-auto">
                                <select class="form-select" id="statusFilter">
                                    <option value="all">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
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
                                <th>ID</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Bank Account</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 10; $i++)
                                <tr>
                                    <td>WD-{{ 1000 + $i }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://ui-avatars.com/api/?name=User+{{ $i }}&background=e53935&color=fff)"></span>
                                            <div>User {{ $i }}</div>
                                        </div>
                                    </td>
                                    <td>Rp. {{ number_format(rand(100000, 5000000), 0, ',', '.') }}</td>
                                    <td>{{ ['BCA', 'Mandiri', 'BNI', 'BRI'][rand(0, 3)] }} -
                                        {{ rand(1000000000, 9999999999) }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime('-' . rand(1, 30) . ' days')) }}</td>
                                    <td>
                                        @php
                                            $statuses = ['pending', 'approved', 'rejected'];
                                            $status = $statuses[rand(0, 2)];
                                            $badgeClass = [
                                                'pending' => 'bg-warning text-dark',
                                                'approved' => 'bg-success',
                                                'rejected' => 'bg-danger',
                                            ][$status];
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('admin.withdrawals.show', $i) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="ti ti-eye me-1"></i>
                                                View
                                            </a>
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

    <!-- Modal for withdrawal details -->
    <div class="modal modal-blur fade" id="modal-withdrawal-details" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Withdrawal Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h4>User Information</h4>
                            <div class="d-flex align-items-center mb-3">
                                <span class="avatar avatar-lg me-3" id="userAvatar"></span>
                                <div>
                                    <h3 id="userName"></h3>
                                    <div class="text-muted" id="userEmail"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Withdrawal Information</h4>
                            <div class="mb-2">
                                <strong>Amount:</strong> <span id="withdrawalAmount"></span>
                            </div>
                            <div class="mb-2">
                                <strong>Bank:</strong> <span id="withdrawalBank"></span>
                            </div>
                            <div class="mb-2">
                                <strong>Account Number:</strong> <span id="withdrawalAccount"></span>
                            </div>
                            <div class="mb-2">
                                <strong>Account Holder:</strong> <span id="withdrawalHolder"></span>
                            </div>
                            <div class="mb-2">
                                <strong>Requested On:</strong> <span id="withdrawalDate"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4>Earnings Details</h4>
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Source</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="earningsTable">
                                        <!-- Earnings data will be inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-danger" id="rejectBtn">
                            <i class="ti ti-x me-2"></i>Reject Withdrawal
                        </button>
                        <div>
                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="approveBtn">
                                <i class="ti ti-check me-2"></i>Approve Withdrawal
                            </button>
                        </div>
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
                const statusValue = statusFilter.value;
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

            // View details button click handler
            document.querySelectorAll('.btn-primary').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const row = this.closest('tr');
                    const id = row.cells[0].textContent;
                    const userName = row.cells[1].textContent.trim();
                    const amount = row.cells[2].textContent;
                    const bank = row.cells[3].textContent;
                    const date = row.cells[4].textContent;
                    const status = row.cells[5].querySelector('.badge').textContent;

                    // Populate modal with data
                    document.getElementById('userName').textContent = userName;
                    document.getElementById('userEmail').textContent =
                        `user${userName.split(' ')[1]}@example.com`;
                    document.getElementById('userAvatar').style.backgroundImage =
                        `url(https://ui-avatars.com/api/?name=${encodeURIComponent(userName)}&background=e53935&color=fff)`;
                    document.getElementById('withdrawalAmount').textContent = amount;
                    document.getElementById('withdrawalBank').textContent = bank.split(' - ')[0];
                    document.getElementById('withdrawalAccount').textContent = bank.split(' - ')[1];
                    document.getElementById('withdrawalHolder').textContent = userName;
                    document.getElementById('withdrawalDate').textContent = date;

                    // Generate random earnings data
                    const earningsTable = document.getElementById('earningsTable');
                    earningsTable.innerHTML = '';

                    const sources = ['Song Sales', 'Cover Royalties', 'Streaming Revenue',
                        'License Fees'
                    ];
                    for (let i = 0; i < 5; i++) {
                        const tr = document.createElement('tr');
                        const source = sources[Math.floor(Math.random() * sources.length)];
                        const description = `Earnings from ${source.toLowerCase()}`;
                        const amount =
                            `Rp. ${(Math.random() * 1000000).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;
                        const date = new Date(Date.now() - Math.random() * 30 * 24 * 60 * 60 * 1000)
                            .toLocaleDateString('id-ID');

                        tr.innerHTML = `
                            <td>${source}</td>
                            <td>${description}</td>
                            <td>${amount}</td>
                            <td>${date}</td>
                        `;
                        earningsTable.appendChild(tr);
                    }

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById(
                        'modal-withdrawal-details'));
                    modal.show();
                });
            });

            // Approve button click handler
            document.getElementById('approveBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Approve Withdrawal?',
                    text: "This will approve the withdrawal request and initiate the payment process.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4caf50',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Approved!',
                            'The withdrawal has been approved.',
                            'success'
                        );
                        // Close the modal
                        bootstrap.Modal.getInstance(document.getElementById(
                            'modal-withdrawal-details')).hide();
                    }
                });
            });

            // Reject button click handler
            document.getElementById('rejectBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Reject Withdrawal?',
                    text: "This will reject the withdrawal request.",
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
                                    'The withdrawal has been rejected.',
                                    'success'
                                );
                                // Close the modal
                                bootstrap.Modal.getInstance(document.getElementById(
                                    'modal-withdrawal-details')).hide();
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
