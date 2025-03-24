@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Finance</div>
                    <h2 class="page-title">My Wallet</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('user.wallet.withdraw') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-cash-banknote me-2"></i>Withdraw
                        </a>
                        <a href="{{ route('user.wallet.withdraw') }}" class="btn btn-primary d-sm-none btn-icon">
                            <i class="ti ti-cash-banknote"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- Balance Card -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar bg-primary-lt me-3">
                                    <i class="ti ti-wallet text-primary"></i>
                                </div>
                                <h3 class="m-0">Available Balance</h3>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <h1 class="display-5 fw-bold mb-0">Rp 2,450,000</h1>
                                <span class="ms-2 text-green d-inline-flex align-items-center lh-1">
                                    <i class="ti ti-trending-up me-1"></i> 12%
                                </span>
                            </div>
                            <div class="text-muted mt-1">Last updated: Today, 10:30 AM</div>
                            
                            <div class="mt-4">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="{{ route('user.wallet.withdraw') }}" class="btn btn-primary w-100">
                                            <i class="ti ti-cash-banknote me-2"></i>Withdraw
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('user.wallet.history') }}" class="btn btn-outline-primary w-100">
                                            <i class="ti ti-history me-2"></i>History
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar bg-green-lt me-3">
                                    <i class="ti ti-chart-bar text-green"></i>
                                </div>
                                <h3 class="m-0">Earnings Summary</h3>
                            </div>
                            
                            <div class="row g-3 mb-1">
                                <div class="col-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-primary-lt me-3">
                                                    <i class="ti ti-music text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-medium">Song Sales</div>
                                                    <div class="text-muted">Rp 1,250,000</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-green-lt me-3">
                                                    <i class="ti ti-license text-green"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-medium">Royalties</div>
                                                    <div class="text-muted">Rp 850,000</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-yellow-lt me-3">
                                                    <i class="ti ti-microphone-2 text-yellow"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-medium">Cover Income</div>
                                                    <div class="text-muted">Rp 350,000</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-azure-lt me-3">
                                                    <i class="ti ti-player-play text-azure"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-medium">Streams</div>
                                                    <div class="text-muted">Rp 450,000</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Transactions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ti ti-history me-2 text-primary"></i>Recent Transactions
                    </h3>
                    <div class="card-actions">
                        <a href="{{ route('user.wallet.history') }}" class="btn btn-link">View All</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $transactionTypes = ['Song Sale', 'Royalty Payment', 'Cover Income', 'Stream Revenue', 'Withdrawal'];
                                $statuses = ['Completed', 'Pending', 'Completed', 'Completed', 'Processing'];
                                $amounts = [125000, 85000, 35000, 45000, -200000];
                                $icons = ['music', 'license', 'microphone-2', 'player-play', 'cash-banknote'];
                                $colors = ['primary', 'green', 'yellow', 'azure', 'red'];
                            @endphp
                            
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
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
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Earnings Chart -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ti ti-chart-line me-2 text-primary"></i>Earnings Overview
                    </h3>
                    <div class="card-actions">
                        <div class="btn-group">
                            <button class="btn btn-outline-primary active">Monthly</button>
                            <button class="btn btn-outline-primary">Yearly</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="earnings-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            series: [{
                name: 'Song Sales',
                data: [150000, 220000, 180000, 250000, 300000, 280000]
            }, {
                name: 'Royalties',
                data: [85000, 100000, 95000, 110000, 120000, 115000]
            }, {
                name: 'Cover Income',
                data: [35000, 40000, 38000, 45000, 50000, 48000]
            }, {
                name: 'Streams',
                data: [45000, 55000, 50000, 60000, 70000, 65000]
            }],
            chart: {
                type: 'bar',
                height: 300,
                stacked: true,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 2
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return 'Rp ' + (value / 1000) + 'K';
                    }
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return 'Rp ' + val.toLocaleString('id-ID')
                    }
                }
            },
            colors: ['#206bc4', '#4299e1', '#fab005', '#5eba00']
        };

        var chart = new ApexCharts(document.querySelector("#earnings-chart"), options);
        chart.render();
    });
</script>
@endsection
