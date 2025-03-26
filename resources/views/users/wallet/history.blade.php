@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Finance</div>
                    <h2 class="page-title">Transaction History</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
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
                    <h3 class="card-title">All Transactions</h3>
                    <div class="card-actions">
                        <form class="d-flex">
                            <div class="me-2">
                                <select class="form-select">
                                    <option value="all">All Types</option>
                                    <option value="credit">Credit</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>
                            <div class="me-2">
                                <select class="form-select">
                                    <option value="all">All Status</option>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
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
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <div class="text-muted">
                            Show
                            <div class="mx-2 d-inline-block">
                                <select class="form-select form-select-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            entries
                        </div>
                        <div class="ms-auto text-muted">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Select date range">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $transactionTypes = ['Song Sale', 'Royalty Payment', 'Cover Income', 'Stream Revenue', 'Withdrawal', 'Song Sale', 'Royalty Payment', 'Cover Income', 'Stream Revenue', 'Withdrawal'];
                                $statuses = ['Completed', 'Pending', 'Completed', 'Completed', 'Processing', 'Completed', 'Completed', 'Pending', 'Completed', 'Completed'];
                                $amounts = [125000, 85000, 35000, 45000, -200000, 110000, 75000, 40000, 55000, -150000];
                                $icons = ['music', 'license', 'microphone-2', 'player-play', 'cash-banknote', 'music', 'license', 'microphone-2', 'player-play', 'cash-banknote'];
                                $colors = ['primary', 'green', 'yellow', 'azure', 'red', 'primary', 'green', 'yellow', 'azure', 'red'];
                            @endphp
                            
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    <td>TRX{{ strtoupper(substr(md5(mt_rand()), 0, 8)) }}</td>
                                    <td>{{ now()->subDays($i)->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2 bg-{{ $colors[$i] }}-lt">
                                                <i class="ti ti-{{ $icons[$i] }} text-{{ $colors[$i] }}"></i>
                                            </span>
                                            <div>{{ $transactionTypes[$i] }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $amounts[$i] < 0 ? 'Debit' : 'Credit' }}</td>
                                    <td class="{{ $amounts[$i] < 0 ? 'text-red' : 'text-green' }}">
                                        {{ $amounts[$i] < 0 ? '-' : '+' }} Rp {{ number_format(abs($amounts[$i]), 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $statuses[$i] == 'Completed' ? 'success' : ($statuses[$i] == 'Pending' ? 'warning' : 'info') }}">
                                            {{ $statuses[$i] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="#" class="btn btn-icon btn-sm btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-eye me-2"></i>View Details
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-file-invoice me-2"></i>Download Receipt
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
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of <span>45</span> entries</p>
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
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
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
@endsection
