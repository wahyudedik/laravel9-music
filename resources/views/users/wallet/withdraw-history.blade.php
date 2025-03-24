@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Finance</div>
                    <h2 class="page-title">Withdrawal History</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('user.wallet.withdraw') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-cash-banknote me-2"></i>New Withdrawal
                        </a>
                        <a href="{{ route('user.wallet') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-wallet me-2"></i>Back to Wallet
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
                    <h3 class="card-title">All Withdrawals</h3>
                    <div class="card-actions">
                        <form class="d-flex">
                            <div class="me-2">
                                <select class="form-select">
                                    <option value="all">All Status</option>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Withdrawal ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Processed Date</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $statuses = ['Completed', 'Processing', 'Pending', 'Completed', 'Rejected', 'Completed', 'Completed', 'Processing'];
                                $methods = ['Bank Transfer (BNI)', 'E-Wallet (DANA)', 'Bank Transfer (BCA)', 'Bank Transfer (BNI)', 'E-Wallet (DANA)', 'Bank Transfer (BCA)', 'Bank Transfer (BNI)', 'E-Wallet (DANA)'];
                                $amounts = [200000, 150000, 300000, 250000, 100000, 350000, 400000, 175000];
                                $icons = ['building-bank', 'wallet', 'building-bank', 'building-bank', 'wallet', 'building-bank', 'building-bank', 'wallet'];
                            @endphp
                            
                            @for ($i = 0; $i < 8; $i++)
                                <tr>
                                    <td>WD{{ strtoupper(substr(md5(mt_rand()), 0, 8)) }}</td>
                                    <td>{{ now()->subDays($i * 5)->format('M d, Y') }}</td>
                                    <td class="text-red">
                                        -Rp {{ number_format($amounts[$i], 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2">
                                                <i class="ti ti-{{ $icons[$i] }}"></i>
                                            </span>
                                            <div>{{ $methods[$i] }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $statuses[$i] == 'Completed' ? 'success' : 
                                            ($statuses[$i] == 'Pending' ? 'warning' : 
                                            ($statuses[$i] == 'Processing' ? 'info' : 'danger')) 
                                        }}">
                                            {{ $statuses[$i] }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($statuses[$i] == 'Completed')
                                            {{ now()->subDays($i * 5 - 2)->format('M d, Y') }}
                                        @elseif($statuses[$i] == 'Rejected')
                                            {{ now()->subDays($i * 5 - 1)->format('M d, Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="#" class="btn btn-icon btn-sm btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-withdrawal-details">
                                                    <i class="ti ti-eye me-2"></i>View Details
                                                </a>
                                                @if($statuses[$i] == 'Completed')
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-file-invoice me-2"></i>Download Receipt
                                                </a>
                                                @endif
                                                @if($statuses[$i] == 'Pending')
                                                <a href="#" class="dropdown-item text-danger">
                                                    <i class="ti ti-trash me-2"></i>Cancel Request
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
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
</div>

<!-- Withdrawal Details Modal -->
<div class="modal modal-blur fade" id="modal-withdrawal-details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdrawal Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-label">Withdrawal ID</div>
                    <div class="form-control-plaintext">WD5F7A3B2E</div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Date Requested</div>
                    <div class="form-control-plaintext">{{ now()->subDays(5)->format('M d, Y H:i:s') }}</div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Amount</div>
                    <div class="form-control-plaintext">Rp 200,000</div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Fee</div>
                    <div class="form-control-plaintext">Rp 1,000 (0.5%)</div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Net Amount</div>
                    <div class="form-control-plaintext">Rp 199,000</div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Payment Method</div>
                    <div class="form-control-plaintext">Bank Transfer (BNI)</div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Account Details</div>
                    <div class="form-control-plaintext">
                        <div>Account Number: ****5678</div>
                        <div>Account Name: John Doe</div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Status</div>
                    <div class="form-control-plaintext">
                        <span class="badge bg-success">Completed</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Processed Date</div>
                    <div class="form-control-plaintext">{{ now()->subDays(3)->format('M d, Y H:i:s') }}</div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Notes</div>
                    <div class="form-control-plaintext">Monthly withdrawal for royalties</div>
                </div>
                <div class="mb-3">
                    <div class="form-label">Reference Number</div>
                    <div class="form-control-plaintext">REF123456789</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">
                    <i class="ti ti-file-invoice me-2"></i>Download Receipt
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
