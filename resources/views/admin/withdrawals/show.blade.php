@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Withdrawal Request #WD-{{ 1000 + $id }}
                    </h2>
                    <div class="text-muted mt-1">Detailed information about this withdrawal request</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to Withdrawals
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">User Information</h3>
                            <div class="d-flex align-items-center mb-3">
                                <span class="avatar avatar-xl me-3" style="background-image: url(https://ui-avatars.com/api/?name=User+{{ $id }}&background=e53935&color=fff)"></span>
                                <div>
                                    <h3 class="m-0">User {{ $id }}</h3>
                                    <div class="text-muted">user{{ $id }}@example.com</div>
                                    <div class="mt-2">
                                        <span class="badge bg-blue-lt">{{ ['Artist', 'Composer', 'Cover Creator'][rand(0, 2)] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="mb-2">
                                    <strong>Member Since:</strong> {{ date('F d, Y', strtotime('-' . rand(1, 365) . ' days')) }}
                                </div>
                                <div class="mb-2">
                                    <strong>Total Earnings:</strong> Rp. {{ number_format(rand(1000000, 50000000), 0, ',', '.') }}
                                </div>
                                <div class="mb-2">
                                    <strong>Total Withdrawals:</strong> Rp. {{ number_format(rand(500000, 20000000), 0, ',', '.') }}
                                </div>
                                <div class="mb-2">
                                    <strong>Available Balance:</strong> Rp. {{ number_format(rand(100000, 10000000), 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Bank Account Information</h3>
                            <div class="mb-2">
                                <strong>Bank Name:</strong> {{ ['BCA', 'Mandiri', 'BNI', 'BRI'][rand(0, 3)] }}
                            </div>
                            <div class="mb-2">
                                <strong>Account Number:</strong> {{ rand(1000000000, 9999999999) }}
                            </div>
                            <div class="mb-2">
                                <strong>Account Holder:</strong> User {{ $id }}
                            </div>
                            <div class="mb-2">
                                <strong>Branch:</strong> {{ ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta'][rand(0, 3)] }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Withdrawal Details</h3>
                            @php
                                $statuses = ['pending', 'approved', 'rejected'];
                                $status = $statuses[rand(0, 2)];
                                $badgeClass = [
                                    'pending' => 'bg-warning text-dark',
                                    'approved' => 'bg-success',
                                    'rejected' => 'bg-danger'
                                ][$status];
                            @endphp
                            <div class="card-actions">
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Withdrawal ID</label>
                                        <div class="form-control-plaintext">WD-{{ 1000 + $id }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date Requested</label>
                                        <div class="form-control-plaintext">{{ date('Y-m-d H:i', strtotime('-' . rand(1, 30) . ' days')) }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Amount</label>
                                        <div class="form-control-plaintext">Rp. {{ number_format(rand(100000, 5000000), 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Processing Fee</label>
                                        <div class="form-control-plaintext">Rp. {{ number_format(rand(1000, 10000), 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Net Amount</label>
                                        <div class="form-control-plaintext">Rp. {{ number_format(rand(100000, 5000000), 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Payment Method</label>
                                        <div class="form-control-plaintext">Bank Transfer</div>
                                    </div>
                                </div>
                            </div>
                            
                            @if($status === 'approved')
                            <div class="mt-3">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-title">Withdrawal Approved</h4>
                                    <div class="text-muted">This withdrawal was approved on {{ date('Y-m-d H:i', strtotime('-' . rand(1, 5) . ' days')) }}</div>
                                    <div class="mt-2">
                                        <strong>Transaction ID:</strong> TRX-{{ rand(100000, 999999) }}
                                    </div>
                                </div>
                            </div>
                            @elseif($status === 'rejected')
                            <div class="mt-3">
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-title">Withdrawal Rejected</h4>
                                    <div class="text-muted">This withdrawal was rejected on {{ date('Y-m-d H:i', strtotime('-' . rand(1, 5) . ' days')) }}</div>
                                    <div class="mt-2">
                                        <strong>Reason:</strong> Insufficient balance or verification documents are incomplete.
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="mt-4">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-danger me-2" id="rejectBtn">
                                        <i class="ti ti-x me-2"></i>Reject Withdrawal
                                    </button>
                                    <button class="btn btn-success" id="approveBtn">
                                        <i class="ti ti-check me-2"></i>Approve Withdrawal
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Earnings History</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Source</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sources = ['Song Sales', 'Cover Royalties', 'Streaming Revenue', 'License Fees'];
                                    @endphp
                                    @for ($i = 0; $i < 5; $i++)
                                        @php
                                            $source = $sources[array_rand($sources)];
                                            $description = "Earnings from " . strtolower($source);
                                            $amount = rand(50000, 1000000);
                                            $date = date('Y-m-d', strtotime('-' . rand(1, 60) . ' days'));
                                        @endphp
                                        <tr>
                                            <td>{{ $source }}</td>
                                            <td>{{ $description }}</td>
                                            <td>Rp. {{ number_format($amount, 0, ',', '.') }}</td>
                                            <td>{{ $date }}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
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
            // Approve button click handler
            const approveBtn = document.getElementById('approveBtn');
            if (approveBtn) {
                approveBtn.addEventListener('click', function() {
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
                            ).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                });
            }

            // Reject button click handler
            const rejectBtn = document.getElementById('rejectBtn');
            if (rejectBtn) {
                rejectBtn.addEventListener('click', function() {
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
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                }
                            });
                        }
                    });
                });
            }
        });
    </script>
@endsection
