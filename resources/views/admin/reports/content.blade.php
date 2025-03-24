@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Content Reports
                    </h2>
                    <div class="text-muted mt-1">Analyze song performance, uploads, and engagement</div>
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
            <!-- Content Stats Cards -->
            <div class="row row-deck row-cards mb-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-primary-lt me-3">
                                    <i class="ti ti-music text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Total Songs</div>
                                    <div class="h3 m-0">3,842</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 8.3%
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
                                    <i class="ti ti-player-play text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Total Plays</div>
                                    <div class="h3 m-0">1.2M</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 12.7%
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
                                    <i class="ti ti-download text-warning"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Downloads</div>
                                    <div class="h3 m-0">245K</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 9.2%
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
                                    <i class="ti ti-upload text-danger"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">New Uploads</div>
                                    <div class="h3 m-0">382</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 15.8%
                                    </span>
                                    <span class="text-muted">vs last period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Upload Trends -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Content Upload Trends</h3>
                            <div class="card-actions">
                                <div class="btn-group">
                                    <button class="btn btn-sm active">Daily</button>
                                    <button class="btn btn-sm">Weekly</button>
                                    <button class="btn btn-sm">Monthly</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="upload-trends-chart" style="height: 300px;">
                                <!-- This would be a chart in a real implementation -->
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="ti ti-chart-line text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                        <p class="text-muted">Content upload trends chart would appear here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content by Type & Genre Distribution -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Content by Type</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="content-type-chart" style="height: 200px;">
                                        <!-- This would be a chart in a real implementation -->
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="ti ti-chart-pie text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                                <p class="text-muted">Content type chart would appear here</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        @php
                                            $contentTypes = [
                                                [
                                                    'name' => 'Original Songs',
                                                    'count' => 2450,
                                                    'percentage' => 63.8,
                                                    'color' => 'primary',
                                                ],
                                                [
                                                    'name' => 'Cover Songs',
                                                    'count' => 1250,
                                                    'percentage' => 32.5,
                                                    'color' => 'success',
                                                ],
                                                [
                                                    'name' => 'Instrumentals',
                                                    'count' => 142,
                                                    'percentage' => 3.7,
                                                    'color' => 'warning',
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($contentTypes as $type)
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>{{ $type['name'] }}</span>
                                                    <span>{{ number_format($type['count']) }}
                                                        ({{ $type['percentage'] }}%)</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-{{ $type['color'] }}" role="progressbar"
                                                        style="width: {{ $type['percentage'] }}%"></div>
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
                            <h3 class="card-title">Genre Distribution</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="genre-distribution-chart" style="height: 200px;">
                                        <!-- This would be a chart in a real implementation -->
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="ti ti-chart-donut text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                                <p class="text-muted">Genre distribution chart would appear here</p>
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

            <!-- Top Performing Content -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Performing Songs</h3>
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
                                        <th>Genre</th>
                                        <th>Plays</th>
                                        <th>Downloads</th>
                                        <th>Engagement</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $topSongs = [
                                            [
                                                'title' => 'Blinding Lights',
                                                'artist' => 'The Weeknd',
                                                'genre' => 'Pop',
                                                'plays' => '125,382',
                                                'downloads' => '28,450',
                                                'engagement' => '92%',
                                            ],
                                            [
                                                'title' => 'Save Your Tears',
                                                'artist' => 'The Weeknd',
                                                'genre' => 'Pop',
                                                'plays' => '98,245',
                                                'downloads' => '21,350',
                                                'engagement' => '88%',
                                            ],
                                            [
                                                'title' => 'Levitating',
                                                'artist' => 'Dua Lipa',
                                                'genre' => 'Pop',
                                                'plays' => '87,120',
                                                'downloads' => '18,920',
                                                'engagement' => '85%',
                                            ],
                                            [
                                                'title' => 'Stay',
                                                'artist' => 'Justin Bieber',
                                                'genre' => 'Pop',
                                                'plays' => '76,450',
                                                'downloads' => '15,780',
                                                'engagement' => '83%',
                                            ],
                                            [
                                                'title' => 'Industry Baby',
                                                'artist' => 'Lil Nas X',
                                                'genre' => 'Hip Hop',
                                                'plays' => '68,290',
                                                'downloads' => '14,520',
                                                'engagement' => '80%',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($topSongs as $index => $song)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url(https://picsum.photos/40/40?random={{ $index + 1 }})"></span>
                                                    <div>{{ $song['title'] }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $song['artist'] }}</td>
                                            <td>{{ $song['genre'] }}</td>
                                            <td>{{ $song['plays'] }}</td>
                                            <td>{{ $song['downloads'] }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-primary"
                                                                style="width: {{ intval($song['engagement']) }}%"></div>
                                                        </div>
                                                    </div>
                                                    <span>{{ $song['engagement'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon btn-ghost-secondary"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-chart me-2"></i>View Details
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-player-play me-2"></i>Preview
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-download me-2"></i>Download Report
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Engagement Metrics -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Engagement by Time of Day</h3>
                        </div>
                        <div class="card-body">
                            <div id="time-engagement-chart" style="height: 300px;">
                                <!-- This would be a chart in a real implementation -->
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="ti ti-chart-area text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                        <p class="text-muted">Time-based engagement chart would appear here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Content Engagement Metrics</h3>
                        </div>
                        <div class="card-body">
                            @php
                                $metrics = [
                                    [
                                        'name' => 'Average Play Duration',
                                        'value' => '3:42',
                                        'change' => '+0:15',
                                        'trend' => 'up',
                                    ],
                                    [
                                        'name' => 'Completion Rate',
                                        'value' => '68.5%',
                                        'change' => '+2.3%',
                                        'trend' => 'up',
                                    ],
                                    [
                                        'name' => 'Repeat Play Rate',
                                        'value' => '24.8%',
                                        'change' => '+1.5%',
                                        'trend' => 'up',
                                    ],
                                    [
                                        'name' => 'Play to Download Ratio',
                                        'value' => '5.7%',
                                        'change' => '-0.8%',
                                        'trend' => 'down',
                                    ],
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-grow-1">
                                        <div class="text-muted mb-1">{{ $metric['name'] }}</div>
                                        <div class="d-flex align-items-baseline">
                                            <h3 class="me-2 mb-0">{{ $metric['value'] }}</h3>
                                            <span
                                                class="text-{{ $metric['trend'] == 'up' ? 'success' : 'danger' }} d-inline-flex align-items-center lh-1">
                                                <i class="ti ti-trending-{{ $metric['trend'] }} me-1"></i>
                                                {{ $metric['change'] }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="chart-sparkline chart-sparkline-sm"
                                            style="width: 80px; height: 40px;">
                                            <!-- This would be a sparkline chart in a real implementation -->
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <i class="ti ti-chart-line text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Growth Projections -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Content Growth Projections</h3>
                            <div class="card-actions">
                                <div class="btn-group">
                                    <button class="btn btn-sm active">3 Months</button>
                                    <button class="btn btn-sm">6 Months</button>
                                    <button class="btn btn-sm">1 Year</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="growth-projection-chart" style="height: 300px;">
                                <!-- This would be a chart in a real implementation -->
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="ti ti-chart-line text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                        <p class="text-muted">Content growth projection chart would appear here</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="stat-icon bg-primary-lt me-3">
                                                    <i class="ti ti-music text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="text-muted fs-5">Projected Songs</div>
                                                    <div class="h3 m-0">4,850</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="stat-icon bg-success-lt me-3">
                                                    <i class="ti ti-player-play text-success"></i>
                                                </div>
                                                <div>
                                                    <div class="text-muted fs-5">Projected Plays</div>
                                                    <div class="h3 m-0">2.5M</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="stat-icon bg-warning-lt me-3">
                                                    <i class="ti ti-download text-warning"></i>
                                                </div>
                                                <div>
                                                    <div class="text-muted fs-5">Projected Downloads</div>
                                                    <div class="h3 m-0">450K</div>
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
