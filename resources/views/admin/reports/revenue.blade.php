@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Revenue Reports
                    </h2>
                    <div class="text-muted mt-1">Track financial performance and revenue streams</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.reports') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to Reports
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="ti ti-calendar me-2"></i>Last 30 Days
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                <a class="dropdown-item" href="#">Last 90 Days</a>
                                <a class="dropdown-item" href="#">This Year</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Custom Range</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- Revenue Stats Cards -->
            <div class="row row-deck row-cards mb-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-primary-lt me-3">
                                    <i class="ti ti-currency-dollar text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Total Revenue</div>
                                    <div class="h3 m-0">Rp. 245,382,000</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 15.3%
                                    </span>
                                    <span class="text-muted">vs last period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-success-lt me-3">
                                    <i class="ti ti-shopping-cart text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">License Sales</div>
                                    <div class="h3 m-0">Rp. 125,490,000</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 12.2%
                                    </span>
                                    <span class="text-muted">vs last period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-warning-lt me-3">
                                    <i class="ti ti-music text-warning"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Streaming Revenue</div>
                                    <div class="h3 m-0">Rp. 98,452,000</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 18.5%
                                    </span>
                                    <span class="text-muted">vs last period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-danger-lt me-3">
                                    <i class="ti ti-cash-off text-danger"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Expenses</div>
                                    <div class="h3 m-0">Rp. 45,382,000</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-danger d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 5.2%
                                    </span>
                                    <span class="text-muted">vs last period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Chart -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Revenue Trends</h3>
                            <div class="card-actions">
                                <div class="btn-group">
                                    <button class="btn btn-sm active">Daily</button>
                                    <button class="btn btn-sm">Weekly</button>
                                    <button class="btn btn-sm">Monthly</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="revenue-chart" style="height: 300px;">
                                <!-- This would be a chart in a real implementation -->
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="ti ti-chart-line text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                        <p class="text-muted">Revenue trends chart would appear here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Breakdown -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Revenue by Source</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="revenue-source-chart" style="height: 200px;">
                                        <!-- This would be a chart in a real implementation -->
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="ti ti-chart-pie text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                                <p class="text-muted">Revenue source chart would appear here</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        @php
                                            $sources = [
                                                ['name' => 'License Sales', 'percentage' => 51, 'color' => 'primary'],
                                                ['name' => 'Streaming', 'percentage' => 40, 'color' => 'success'],
                                                ['name' => 'Donations', 'percentage' => 6, 'color' => 'warning'],
                                                ['name' => 'Other', 'percentage' => 3, 'color' => 'info'],
                                            ];
                                        @endphp

                                        @foreach ($sources as $source)
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>{{ $source['name'] }}</span>
                                                    <span>{{ $source['percentage'] }}%</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-{{ $source['color'] }}" role="progressbar"
                                                        style="width: {{ $source['percentage'] }}%"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Revenue by Genre</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="genre-revenue-chart" style="height: 200px;">
                                        <!-- This would be a chart in a real implementation -->
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="ti ti-chart-donut text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                                <p class="text-muted">Genre revenue chart would appear here</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        @php
                                            $genres = [
                                                ['name' => 'Pop', 'percentage' => 45, 'color' => 'primary'],
                                                ['name' => 'Hip Hop', 'percentage' => 30, 'color' => 'success'],
                                                ['name' => 'Rock', 'percentage' => 15, 'color' => 'warning'],
                                                ['name' => 'Electronic', 'percentage' => 10, 'color' => 'info'],
                                            ];
                                        @endphp

                                        @foreach ($genres as $genre)
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>{{ $genre['name'] }}</span>
                                                    <span>{{ $genre['percentage'] }}%</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-{{ $genre['color'] }}" role="progressbar"
                                                        style="width: {{ $genre['percentage'] }}%"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Table -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Revenue Breakdown</h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="ti ti-download me-2"></i>Export
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>License Sales</th>
                                        <th>Streaming</th>
                                        <th>Donations</th>
                                        <th>Total</th>
                                        <th>Growth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $months = [
                                            [
                                                'name' => 'January',
                                                'license' => 'Rp. 18,250,000',
                                                'streaming' => 'Rp. 12,380,000',
                                                'donations' => 'Rp. 1,250,000',
                                                'total' => 'Rp. 31,880,000',
                                                'growth' => 'N/A',
                                            ],
                                            [
                                                'name' => 'February',
                                                'license' => 'Rp. 19,450,000',
                                                'streaming' => 'Rp. 13,520,000',
                                                'donations' => 'Rp. 1,380,000',
                                                'total' => 'Rp. 34,350,000',
                                                'growth' => '+7.7%',
                                            ],
                                            [
                                                'name' => 'March',
                                                'license' => 'Rp. 21,350,000',
                                                'streaming' => 'Rp. 14,780,000',
                                                'donations' => 'Rp. 1,520,000',
                                                'total' => 'Rp. 37,650,000',
                                                'growth' => '+9.6%',
                                            ],
                                            [
                                                'name' => 'April',
                                                'license' => 'Rp. 22,480,000',
                                                'streaming' => 'Rp. 15,920,000',
                                                'donations' => 'Rp. 1,680,000',
                                                'total' => 'Rp. 40,080,000',
                                                'growth' => '+6.5%',
                                            ],
                                            [
                                                'name' => 'May',
                                                'license' => 'Rp. 24,150,000',
                                                'streaming' => 'Rp. 17,250,000',
                                                'donations' => 'Rp. 1,820,000',
                                                'total' => 'Rp. 43,220,000',
                                                'growth' => '+7.8%',
                                            ],
                                            [
                                                'name' => 'June',
                                                'license' => 'Rp. 25,780,000',
                                                'streaming' => 'Rp. 18,450,000',
                                                'donations' => 'Rp. 1,950,000',
                                                'total' => 'Rp. 46,180,000',
                                                'growth' => '+6.8%',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($months as $month)
                                        <tr>
                                            <td>{{ $month['name'] }}</td>
                                            <td>{{ $month['license'] }}</td>
                                            <td>{{ $month['streaming'] }}</td>
                                            <td>{{ $month['donations'] }}</td>
                                            <td><strong>{{ $month['total'] }}</strong></td>
                                            <td>
                                                @if ($month['growth'] != 'N/A')
                                                    <span class="text-success">
                                                        <i class="ti ti-trending-up me-1"></i>{{ $month['growth'] }}
                                                    </span>
                                                @else
                                                    {{ $month['growth'] }}
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

            <!-- Top Revenue Generators -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Revenue Generating Songs</h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-link">View All</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Artist</th>
                                        <th>Revenue</th>
                                        <th>Trend</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $songs = [
                                            [
                                                'title' => 'Blinding Lights',
                                                'artist' => 'The Weeknd',
                                                'revenue' => 'Rp. 4,538,200',
                                                'trend' => 'up',
                                            ],
                                            [
                                                'title' => 'Save Your Tears',
                                                'artist' => 'The Weeknd',
                                                'revenue' => 'Rp. 3,829,100',
                                                'trend' => 'up',
                                            ],
                                            [
                                                'title' => 'Levitating',
                                                'artist' => 'Dua Lipa',
                                                'revenue' => 'Rp. 3,284,500',
                                                'trend' => 'down',
                                            ],
                                            [
                                                'title' => 'Stay',
                                                'artist' => 'Justin Bieber',
                                                'revenue' => 'Rp. 2,847,300',
                                                'trend' => 'up',
                                            ],
                                            [
                                                'title' => 'Industry Baby',
                                                'artist' => 'Lil Nas X',
                                                'revenue' => 'Rp. 2,419,200',
                                                'trend' => 'down',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($songs as $index => $song)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url(https://picsum.photos/40/40?random={{ $index + 1 }})"></span>
                                                    <div>{{ $song['title'] }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $song['artist'] }}</td>
                                            <td>{{ $song['revenue'] }}</td>
                                            <td>
                                                @if ($song['trend'] == 'up')
                                                    <span class="text-success">
                                                        <i class="ti ti-trending-up"></i>
                                                    </span>
                                                @else
                                                    <span class="text-danger">
                                                        <i class="ti ti-trending-down"></i>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Revenue Generating Artists</h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-link">View All</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Artist</th>
                                        <th>Songs</th>
                                        <th>Revenue</th>
                                        <th>Trend</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $artists = [
                                            [
                                                'name' => 'The Weeknd',
                                                'songs' => '12',
                                                'revenue' => 'Rp. 8,367,300',
                                                'trend' => 'up',
                                            ],
                                            [
                                                'name' => 'Dua Lipa',
                                                'songs' => '8',
                                                'revenue' => 'Rp. 6,284,500',
                                                'trend' => 'up',
                                            ],
                                            [
                                                'name' => 'Justin Bieber',
                                                'songs' => '10',
                                                'revenue' => 'Rp. 5,847,300',
                                                'trend' => 'down',
                                            ],
                                            [
                                                'name' => 'Lil Nas X',
                                                'songs' => '5',
                                                'revenue' => 'Rp. 4,419,200',
                                                'trend' => 'up',
                                            ],
                                            [
                                                'name' => 'Olivia Rodrigo',
                                                'songs' => '7',
                                                'revenue' => 'Rp. 3,928,100',
                                                'trend' => 'up',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($artists as $index => $artist)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($artist['name']) }}&background=e53935&color=fff)"></span>
                                                    <div>{{ $artist['name'] }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $artist['songs'] }}</td>
                                            <td>{{ $artist['revenue'] }}</td>
                                            <td>
                                                @if ($artist['trend'] == 'up')
                                                    <span class="text-success">
                                                        <i class="ti ti-trending-up"></i>
                                                    </span>
                                                @else
                                                    <span class="text-danger">
                                                        <i class="ti ti-trending-down"></i>
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
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // In a real implementation, you would initialize charts here
            // For example, using Chart.js, ApexCharts, or other charting libraries
        });
    </script>
@endsection
