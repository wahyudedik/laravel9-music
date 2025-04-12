@extends('layouts.app-admin')

@section('title', 'Royalty Details')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Royalties Management
                    </div>
                    <h2 class="page-title">
                        Royalty Details: {{ $id }}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.royalties.index') }}"
                            class="btn btn-outline-secondary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" onclick="window.print();">
                            <i class="ti ti-printer"></i>
                            Print
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                                Actions
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">
                                    <i class="ti ti-edit me-2"></i>Edit
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="ti ti-check me-2"></i>Mark as Paid
                                </a>
                                <a class="dropdown-item text-danger" href="#">
                                    <i class="ti ti-trash me-2"></i>Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @php
                $royalty = [
                    'id' => $id,
                    'user_name' => 'John Doe',
                    'user_email' => 'johndoe@example.com',
                    'user_avatar' => 'https://picsum.photos/seed/user1/200/200',
                    'role' => 'Artist',
                    'content_type' => 'Song',
                    'content_name' => 'Amazing Song Title',
                    'content_id' => 'SONG12345',
                    'period' => 'Q2 2023',
                    'streams' => 245789,
                    'amount' => 3500000,
                    'status' => 'Processed',
                    'date_created' => now()->subDays(15)->format('Y-m-d H:i:s'),
                    'date_processed' => now()->subDays(10)->format('Y-m-d H:i:s'),
                    'date_paid' => null,
                    'payment_method' => 'Bank Transfer',
                    'bank_name' => 'Bank Central Asia',
                    'account_number' => '1234567890',
                    'account_name' => 'John Doe',
                    'notes' => 'Royalty payment for Q2 2023 streaming revenue.',
                    'history' => [
                        [
                            'date' => now()->subDays(15)->format('Y-m-d H:i:s'),
                            'action' => 'Created',
                            'user' => 'System',
                            'notes' => 'Royalty payment automatically generated',
                        ],
                        [
                            'date' => now()->subDays(12)->format('Y-m-d H:i:s'),
                            'action' => 'Updated',
                            'user' => 'Admin User',
                            'notes' => 'Adjusted stream count from 240,000 to 245,789',
                        ],
                        [
                            'date' => now()->subDays(10)->format('Y-m-d H:i:s'),
                            'action' => 'Status Changed',
                            'user' => 'Admin User',
                            'notes' => 'Status changed from Pending to Processed',
                        ],
                    ],
                    'platform_breakdown' => [
                        ['platform' => 'Spotify', 'streams' => 125000, 'amount' => 1750000],
                        ['platform' => 'Apple Music', 'streams' => 75000, 'amount' => 1050000],
                        ['platform' => 'YouTube Music', 'streams' => 35789, 'amount' => 500000],
                        ['platform' => 'Others', 'streams' => 10000, 'amount' => 200000],
                    ],
                ];
            @endphp

            <div class="row row-cards">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Royalty Information</h3>
                            <div class="mb-2">
                                <div class="d-flex mb-3">
                                    <span class="avatar avatar-lg me-3"
                                        style="background-image: url({{ $royalty['user_avatar'] }})"></span>
                                    <div>
                                        <div class="font-weight-medium">{{ $royalty['user_name'] }}</div>
                                        <div class="text-muted">{{ $royalty['user_email'] }}</div>
                                        <div class="mt-1">
                                            <span class="badge bg-blue-lt">{{ $royalty['role'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-4">ID:</div>
                                    <div class="col-8 text-muted">{{ $royalty['id'] }}</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">Status:</div>
                                    <div class="col-8">
                                        @if ($royalty['status'] == 'Pending')
                                            <span class="badge bg-yellow">Pending</span>
                                        @elseif($royalty['status'] == 'Processed')
                                            <span class="badge bg-blue">Processed</span>
                                        @elseif($royalty['status'] == 'Paid')
                                            <span class="badge bg-green">Paid</span>
                                        @else
                                            <span class="badge bg-red">Cancelled</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">Period:</div>
                                    <div class="col-8 text-muted">{{ $royalty['period'] }}</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">Created:</div>
                                    <div class="col-8 text-muted">{{ $royalty['date_created'] }}</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">Processed:</div>
                                    <div class="col-8 text-muted">{{ $royalty['date_processed'] }}</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">Paid:</div>
                                    <div class="col-8 text-muted">{{ $royalty['date_paid'] ?? 'Not paid yet' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Payment Information</h3>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-4">Method:</div>
                                    <div class="col-8 text-muted">{{ $royalty['payment_method'] }}</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">Bank:</div>
                                    <div class="col-8 text-muted">{{ $royalty['bank_name'] }}</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">Account:</div>
                                    <div class="col-8 text-muted">{{ $royalty['account_number'] }}</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">Name:</div>
                                    <div class="col-8 text-muted">{{ $royalty['account_name'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Content Information</h3>
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-3">Content Type:</div>
                                            <div class="col-9">
                                                <span class="badge bg-azure-lt">{{ $royalty['content_type'] }}</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-3">Content Name:</div>
                                            <div class="col-9 text-muted">{{ $royalty['content_name'] }}</div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-3">Content ID:</div>
                                            <div class="col-9 text-muted">{{ $royalty['content_id'] }}</div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-3">Total Streams:</div>
                                            <div class="col-9 text-muted">{{ number_format($royalty['streams']) }}</div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-3">Total Amount:</div>
                                            <div class="col-9 text-muted">Rp {{ number_format($royalty['amount']) }}</div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-3">Notes:</div>
                                            <div class="col-9 text-muted">{{ $royalty['notes'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Platform Breakdown</h3>
                                </div>
                                <div class="card-body">
                                    <div id="chart-platform-breakdown"></div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th>Platform</th>
                                                    <th>Streams</th>
                                                    <th>Amount</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($royalty['platform_breakdown'] as $platform)
                                                    <tr>
                                                        <td>{{ $platform['platform'] }}</td>
                                                        <td>{{ number_format($platform['streams']) }}</td>
                                                        <td>Rp {{ number_format($platform['amount']) }}</td>
                                                        <td>{{ round(($platform['amount'] / $royalty['amount']) * 100, 2) }}%
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">History</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="timeline">
                                        @foreach ($royalty['history'] as $history)
                                            <li class="timeline-event">
                                                <div class="timeline-event-icon bg-azure-lt">
                                                    @if ($history['action'] == 'Created')
                                                        <i class="ti ti-plus"></i>
                                                    @elseif($history['action'] == 'Updated')
                                                        <i class="ti ti-pencil"></i>
                                                    @elseif($history['action'] == 'Status Changed')
                                                        <i class="ti ti-arrow-right"></i>
                                                    @else
                                                        <i class="ti ti-info-circle"></i>
                                                    @endif
                                                </div>
                                                <div class="card timeline-event-card">
                                                    <div class="card-body">
                                                        <div class="text-muted float-end">{{ $history['date'] }}</div>
                                                        <h4>{{ $history['action'] }}</h4>
                                                        <p class="text-muted">{{ $history['notes'] }}</p>
                                                        <p class="text-muted">By: {{ $history['user'] }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Platform breakdown chart
            var options = {
                series: [
                    @foreach ($royalty['platform_breakdown'] as $platform)
                        {{ $platform['amount'] }},
                    @endforeach
                ],
                chart: {
                    type: 'donut',
                    height: 300,
                },
                labels: [
                    @foreach ($royalty['platform_breakdown'] as $platform)
                        '{{ $platform['platform'] }}',
                    @endforeach
                ],
                colors: ['#206bc4', '#4299e1', '#6cb6e6', '#a5d7f7'],
                legend: {
                    position: 'bottom',
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart-platform-breakdown"), options);
            chart.render();
        });
    </script>
@endsection
