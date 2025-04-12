@extends('layouts.app-admin')

@section('title', 'Royalty Reports')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Royalty Reports
                    </h2>
                    <div class="text-muted mt-1">Analytics and reports for royalty payments</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" onclick="window.print();">
                            <i class="ti ti-printer"></i>
                            Print Report
                        </a>
                        <a href="#" class="btn btn-secondary d-none d-sm-inline-block">
                            <i class="ti ti-download"></i>
                            Export Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <i class="ti ti-coin"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Rp {{ number_format(rand(100000000, 500000000)) }}
                                    </div>
                                    <div class="text-muted">
                                        Total Royalties Paid
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar">
                                        <i class="ti ti-music"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ number_format(rand(10000000, 50000000)) }}
                                    </div>
                                    <div class="text-muted">
                                        Total Streams
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-azure text-white avatar">
                                        <i class="ti ti-users"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ number_format(rand(100, 500)) }}
                                    </div>
                                    <div class="text-muted">
                                        Content Creators
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-yellow text-white avatar">
                                        <i class="ti ti-file-invoice"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ number_format(rand(1000, 5000)) }}
                                    </div>
                                    <div class="text-muted">
                                        Royalty Payments
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Royalty Payments Over Time</h3>
                            <div class="ms-auto">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Last 6 months</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Last 6 months</a>
                                        <a class="dropdown-item" href="#">Last 3 months</a>
                                        <a class="dropdown-item" href="#">Last month</a>
                                        <a class="dropdown-item" href="#">This year</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart-royalty-payments"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Royalties by Content Type</h3>
                        </div>
                        <div class="card-body">
                            <div id="chart-content-type"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Earning Artists</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Artist</th>
                                            <th>Streams</th>
                                            <th>Earnings</th>
                                            <th>Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $topArtists = [];
                                            for ($i = 1; $i <= 5; $i++) {
                                                $topArtists[] = [
                                                    'name' => 'Artist ' . $i,
                                                    'avatar' => 'https://picsum.photos/seed/artist' . $i . '/200/200',
                                                    'streams' => rand(100000, 1000000),
                                                    'earnings' => rand(10000000, 50000000),
                                                    'content_count' => rand(5, 20),
                                                ];
                                            }
                                        @endphp

                                        @foreach ($topArtists as $artist)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm me-2"
                                                            style="background-image: url({{ $artist['avatar'] }})"></span>
                                                        <div>{{ $artist['name'] }}</div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($artist['streams']) }}</td>
                                                <td>Rp {{ number_format($artist['earnings']) }}</td>
                                                <td>{{ $artist['content_count'] }} songs</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Earning Composers</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Composer</th>
                                            <th>Streams</th>
                                            <th>Earnings</th>
                                            <th>Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $topComposers = [];
                                            for ($i = 1; $i <= 5; $i++) {
                                                $topComposers[] = [
                                                    'name' => 'Composer ' . $i,
                                                    'avatar' => 'https://picsum.photos/seed/composer' . $i . '/200/200',
                                                    'streams' => rand(100000, 1000000),
                                                    'earnings' => rand(10000000, 50000000),
                                                    'content_count' => rand(5, 20),
                                                ];
                                            }
                                        @endphp

                                        @foreach ($topComposers as $composer)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm me-2"
                                                            style="background-image: url({{ $composer['avatar'] }})"></span>
                                                        <div>{{ $composer['name'] }}</div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($composer['streams']) }}</td>
                                                <td>Rp {{ number_format($composer['earnings']) }}</td>
                                                <td>{{ $composer['content_count'] }} songs</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Performing Content</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Content</th>
                                            <th>Type</th>
                                            <th>Creator</th>
                                            <th>Streams</th>
                                            <th>Royalties</th>
                                            <th>Trend</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $contentTypes = ['Song', 'Album', 'Cover'];
                                            $trends = ['up', 'down', 'stable'];
                                            $topContent = [];
                                            for ($i = 1; $i <= 10; $i++) {
                                                $topContent[] = [
                                                    'title' => 'Content Title ' . $i,
                                                    'type' => $contentTypes[array_rand($contentTypes)],
                                                    'creator' => 'Creator ' . rand(1, 10),
                                                    'streams' => rand(50000, 500000),
                                                    'royalties' => rand(5000000, 25000000),
                                                    'trend' => $trends[array_rand($trends)],
                                                ];
                                            }
                                        @endphp

                                        @foreach ($topContent as $content)
                                            <tr>
                                                <td>{{ $content['title'] }}</td>
                                                <td>
                                                    <span class="badge bg-azure-lt">{{ $content['type'] }}</span>
                                                </td>
                                                <td>{{ $content['creator'] }}</td>
                                                <td>{{ number_format($content['streams']) }}</td>
                                                <td>Rp {{ number_format($content['royalties']) }}</td>
                                                <td>
                                                    @if ($content['trend'] == 'up')
                                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                                            {{ rand(5, 20) }}% <i class="ti ti-trending-up ms-1"></i>
                                                        </span>
                                                    @elseif($content['trend'] == 'down')
                                                        <span class="text-red d-inline-flex align-items-center lh-1">
                                                            {{ rand(5, 20) }}% <i class="ti ti-trending-down ms-1"></i>
                                                        </span>
                                                    @else
                                                        <span class="text-muted d-inline-flex align-items-center lh-1">
                                                            0% <i class="ti ti-minus ms-1"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Royalties by Platform</h3>
                        </div>
                        <div class="card-body">
                            <div id="chart-platforms"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Distribution</h3>
                        </div>
                        <div class="card-body">
                            <div id="chart-monthly-distribution"></div>
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
            // Royalty Payments Over Time Chart
            var options = {
                series: [{
                    name: 'Royalty Payments',
                    data: [
                        {{ rand(10000000, 20000000) }},
                        {{ rand(15000000, 25000000) }},
                        {{ rand(20000000, 30000000) }},
                        {{ rand(25000000, 35000000) }},
                        {{ rand(30000000, 40000000) }},
                        {{ rand(35000000, 45000000) }}
                    ]
                }],
                chart: {
                    type: 'area',
                    height: 300,
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                colors: ['#206bc4'],
                title: {
                    text: 'Royalty Payments Trend',
                    align: 'left'
                },
                subtitle: {
                    text: 'Payment amount in IDR',
                    align: 'left'
                },
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                xaxis: {
                    type: 'category',
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return 'Rp ' + (val / 1000000).toFixed(0) + 'M';
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                },
                fill: {
                    opacity: 0.2,
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "vertical",
                        shadeIntensity: 0.5,
                        opacityFrom: 0.7,
                        opacityTo: 0.2,
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-royalty-payments"), options);
            chart.render();

            // Content Type Chart
            var options2 = {
                series: [{{ rand(40, 60) }}, {{ rand(20, 30) }}, {{ rand(10, 20) }}],
                chart: {
                    type: 'donut',
                    height: 300,
                },
                labels: ['Songs', 'Albums', 'Covers'],
                colors: ['#206bc4', '#4299e1', '#6cb6e6'],
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

            var chart2 = new ApexCharts(document.querySelector("#chart-content-type"), options2);
            chart2.render();

            // Platforms Chart
            var options3 = {
                series: [{
                    name: 'Royalties',
                    data: [
                        {{ rand(10000000, 20000000) }},
                        {{ rand(8000000, 15000000) }},
                        {{ rand(5000000, 10000000) }},
                        {{ rand(3000000, 8000000) }},
                        {{ rand(1000000, 5000000) }}
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 300
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#206bc4'],
                xaxis: {
                    categories: ['Spotify', 'Apple Music', 'YouTube Music', 'Deezer', 'Others'],
                    labels: {
                        formatter: function(val) {
                            return 'Rp ' + (val / 1000000).toFixed(1) + 'M';
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                }
            };

            var chart3 = new ApexCharts(document.querySelector("#chart-platforms"), options3);
            chart3.render();

            // Monthly Distribution Chart
            var options4 = {
                series: [{
                    name: 'Artists',
                    data: [
                        {{ rand(5000000, 10000000) }},
                        {{ rand(6000000, 12000000) }},
                        {{ rand(7000000, 14000000) }},
                        {{ rand(8000000, 16000000) }},
                        {{ rand(9000000, 18000000) }},
                        {{ rand(10000000, 20000000) }}
                    ]
                }, {
                    name: 'Composers',
                    data: [
                        {{ rand(3000000, 8000000) }},
                        {{ rand(4000000, 9000000) }},
                        {{ rand(5000000, 10000000) }},
                        {{ rand(6000000, 12000000) }},
                        {{ rand(7000000, 14000000) }},
                        {{ rand(8000000, 16000000) }}
                    ]
                }, {
                    name: 'Cover Creators',
                    data: [
                        {{ rand(1000000, 3000000) }},
                        {{ rand(1500000, 3500000) }},
                        {{ rand(2000000, 4000000) }},
                        {{ rand(2500000, 4500000) }},
                        {{ rand(3000000, 5000000) }},
                        {{ rand(3500000, 5500000) }}
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 300,
                    stacked: true,
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
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
                colors: ['#206bc4', '#4299e1', '#6cb6e6'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                },
                yaxis: {
                    title: {
                        text: 'IDR'
                    },
                    labels: {
                        formatter: function(val) {
                            return 'Rp ' + (val / 1000000).toFixed(0) + 'M';
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                },
                legend: {
                    position: 'bottom'
                }
            };

            var chart4 = new ApexCharts(document.querySelector("#chart-monthly-distribution"), options4);
            chart4.render();
        });
    </script>
@endsection
