@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Analytics</div>
                    <h2 class="page-title">Reports & Statistics</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#export-report-modal">
                            <i class="ti ti-download me-2"></i>Export Report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#export-report-modal">
                            <i class="ti ti-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- Date Range Filter -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <label class="form-label">Date Range</label>
                            <select class="form-select">
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="last7days" selected>Last 7 Days</option>
                                <option value="last30days">Last 30 Days</option>
                                <option value="thismonth">This Month</option>
                                <option value="lastmonth">Last Month</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">From</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime('-7 days')) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">To</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-md-end">
                            <button class="btn btn-primary w-100">
                                <i class="ti ti-filter me-1"></i>Apply Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @php
                // Simulasi role user (dalam implementasi sebenarnya, gunakan auth()->user()->role)
                $userRole = auth()->user()->role ?? 'User';
            @endphp

            <!-- Stats Cards - Berbeda untuk setiap role -->
            <div class="row mb-4">
                <!-- Semua role memiliki statistik jumlah play -->
                <div class="col-md-{{ $userRole == 'Cover Creator' ? '6' : '3' }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Plays</div>
                                <div class="ms-auto lh-1">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Last 7 days</a>
                                            <a class="dropdown-item" href="#">Last 30 days</a>
                                            <a class="dropdown-item" href="#">Last 3 months</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="h1 mb-3">3,842</div>
                            <div class="d-flex mb-2">
                                <div>Growth</div>
                                <div class="ms-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        12% <i class="ti ti-trending-up ms-1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                                    <span class="visually-hidden">75% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cover Creator hanya memiliki statistik jumlah play -->
                @if($userRole != 'Cover Creator')
                    <!-- Artist dan Composer memiliki statistik jumlah pengcover -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Cover Creators</div>
                                </div>
                                <div class="h1 mb-3">24</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            15% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 60%" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" aria-label="60% Complete">
                                        <span class="visually-hidden">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Artist dan Composer memiliki statistik jumlah play lagu -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Original Song Plays</div>
                                </div>
                                <div class="h1 mb-3">12,568</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            8% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" aria-label="80% Complete">
                                        <span class="visually-hidden">80% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Composer memiliki statistik penjualan -->
                    @if($userRole == 'Composer')
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Revenue</div>
                                    </div>
                                    <div class="h1 mb-3">Rp 2,450,000</div>
                                    <div class="d-flex mb-2">
                                        <div>Growth</div>
                                        <div class="ms-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                                18% <i class="ti ti-trending-up ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: 85%" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" aria-label="85% Complete">
                                            <span class="visually-hidden">85% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Artist memiliki statistik followers -->
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Followers</div>
                                    </div>
                                    <div class="h1 mb-3">1,253</div>
                                    <div class="d-flex mb-2">
                                        <div>Growth</div>
                                        <div class="ms-auto">
                                            <span class="text-green d-inline-flex align-items-center lh-1">
                                                5% <i class="ti ti-trending-up ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: 40%" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" aria-label="40% Complete">
                                            <span class="visually-hidden">40% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Cover Creator memiliki statistik jumlah cover yang dibuat -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Covers Created</div>
                                </div>
                                <div class="h1 mb-3">18</div>
                                <div class="d-flex mb-2">
                                    <div>Growth</div>
                                    <div class="ms-auto">
                                        <span class="text-green d-inline-flex align-items-center lh-1">
                                            20% <i class="ti ti-trending-up ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 60%" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" aria-label="60% Complete">
                                        <span class="visually-hidden">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Performance Chart - Semua role memiliki ini -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Performance Overview</h3>
                    <div class="card-actions">
                        <div class="btn-group">
                            <button class="btn btn-outline-primary active">Plays</button>
                            @if($userRole != 'Cover Creator')
                                <button class="btn btn-outline-primary">Cover Creators</button>
                            @endif
                            @if($userRole == 'Composer')
                                <button class="btn btn-outline-primary">Revenue</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart-performance" style="height: 300px;">
                        <!-- Chart will be rendered here -->
                        <div class="d-flex align-items-center justify-content-center h-100 text-center text-muted">
                            <div>
                                <i class="ti ti-chart-line mb-2" style="font-size: 3rem;"></i>
                                <p>Performance chart will be displayed here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Performing Content -->
            <div class="row mb-4">
                <!-- Top Performing Songs - Semua role memiliki ini -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ti ti-music me-2 text-primary"></i>
                                @if($userRole == 'Cover Creator')
                                    Top Performing Covers
                                @else
                                    Top Performing Songs
                                @endif
                            </h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-link">View All</a>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            @php
                                $songs = [
                                    ['title' => 'Sunset Dreams', 'artist' => 'Luna Park', 'plays' => rand(5000, 15000)],
                                    ['title' => 'Midnight Memories', 'artist' => 'The Echoes', 'plays' => rand(4000, 10000)],
                                    ['title' => 'Ocean Waves', 'artist' => 'Coastal Vibes', 'plays' => rand(3000, 9000)],
                                                                        ['title' => 'Mountain High', 'artist' => 'Alpine Crew', 'plays' => rand(2000, 8000)],
                                    ['title' => 'City Lights', 'artist' => 'Urban Beats', 'plays' => rand(1000, 7000)]
                                ];
                            @endphp
                            
                            @foreach($songs as $index => $song)
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar">{{ $index + 1 }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="avatar" style="background-image: url(https://picsum.photos/40/40?random={{ $index + 10 }})"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-reset d-block">{{ $song['title'] }}</a>
                                            <div class="text-muted text-truncate mt-n1">{{ $song['artist'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-primary-lt">
                                                <i class="ti ti-headphones me-1"></i>
                                                {{ number_format($song['plays']) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    @if($userRole == 'Cover Creator')
                        <!-- Cover Creator: Audience Geography -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-map-pin me-2 text-primary"></i>Audience Geography
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-auto d-flex align-items-center pe-2">
                                        <span class="legend me-2 bg-primary"></span>
                                        <span>Indonesia</span>
                                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">65%</span>
                                    </div>
                                    <div class="col-auto d-flex align-items-center px-2">
                                        <span class="legend me-2 bg-azure"></span>
                                        <span>Malaysia</span>
                                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">15%</span>
                                    </div>
                                    <div class="col-auto d-flex align-items-center px-2">
                                        <span class="legend me-2 bg-green"></span>
                                        <span>Singapore</span>
                                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">10%</span>
                                    </div>
                                    <div class="col-auto d-flex align-items-center ps-2">
                                        <span class="legend me-2 bg-yellow"></span>
                                        <span>Other</span>
                                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">10%</span>
                                    </div>
                                </div>
                                <div id="map-world" style="height: 200px;">
                                    <!-- Map will be rendered here -->
                                    <div class="d-flex align-items-center justify-content-center h-100 text-center text-muted">
                                        <div>
                                            <i class="ti ti-map mb-2" style="font-size: 3rem;"></i>
                                            <p>Geographic map will be displayed here</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($userRole == 'Artist')
                        <!-- Artist: Top Cover Creators -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-microphone-2 me-2 text-primary"></i>Top Cover Creators
                                </h3>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-link">View All</a>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                @php
                                    $coverCreators = [
                                        ['name' => 'John Smith', 'covers' => rand(5, 15), 'plays' => rand(5000, 15000)],
                                        ['name' => 'Maria Garcia', 'covers' => rand(3, 10), 'plays' => rand(4000, 10000)],
                                        ['name' => 'David Lee', 'covers' => rand(2, 8), 'plays' => rand(3000, 9000)],
                                        ['name' => 'Sarah Johnson', 'covers' => rand(1, 5), 'plays' => rand(2000, 8000)],
                                        ['name' => 'Michael Wong', 'covers' => rand(1, 3), 'plays' => rand(1000, 7000)]
                                    ];
                                @endphp
                                
                                @foreach($coverCreators as $index => $creator)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar">{{ $index + 1 }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar" style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($creator['name']) }}&background=e53935&color=fff)"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-reset d-block">{{ $creator['name'] }}</a>
                                                <div class="text-muted text-truncate mt-n1">{{ $creator['covers'] }} covers</div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="badge bg-primary-lt">
                                                    <i class="ti ti-headphones me-1"></i>
                                                    {{ number_format($creator['plays']) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Composer: Revenue Breakdown -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-cash me-2 text-primary"></i>Revenue Breakdown
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div>License Sales</div>
                                        <div class="ms-auto">Rp 1,250,000 (51%)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: 51%" role="progressbar"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div>Streaming Royalties</div>
                                        <div class="ms-auto">Rp 750,000 (31%)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-azure" style="width: 31%" role="progressbar"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div>Cover Royalties</div>
                                        <div class="ms-auto">Rp 350,000 (14%)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" style="width: 14%" role="progressbar"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div>Other</div>
                                        <div class="ms-auto">Rp 100,000 (4%)</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-yellow" style="width: 4%" role="progressbar"></div>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <h4 class="mb-3">Monthly Revenue Trend</h4>
                                    <div id="chart-revenue" style="height: 200px;">
                                        <!-- Chart will be rendered here -->
                                        <div class="d-flex align-items-center justify-content-center h-100 text-center text-muted">
                                            <div>
                                                <i class="ti ti-chart-bar mb-2" style="font-size: 3rem;"></i>
                                                <p>Revenue chart will be displayed here</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($userRole != 'Cover Creator')
                <!-- Artist & Composer: Additional Stats -->
                <div class="row mb-4">
                    @if($userRole == 'Composer')
                        <!-- Composer: License Sales -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="ti ti-license me-2 text-primary"></i>License Sales
                                    </h3>
                                </div>
                                <div class="card-body border-bottom-0 table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Song</th>
                                                <th>License Type</th>
                                                <th>Quantity</th>
                                                <th>Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sunset Dreams</td>
                                                <td>Cover License</td>
                                                <td>12</td>
                                                <td>Rp 600,000</td>
                                            </tr>
                                            <tr>
                                                <td>Ocean Waves</td>
                                                <td>Cover License</td>
                                                <td>8</td>
                                                <td>Rp 400,000</td>
                                            </tr>
                                            <tr>
                                                <td>Mountain High</td>
                                                <td>Commercial Use</td>
                                                <td>2</td>
                                                <td>Rp 1,000,000</td>
                                            </tr>
                                            <tr>
                                                <td>City Lights</td>
                                                <td>Cover License</td>
                                                <td>5</td>
                                                <td>Rp 250,000</td>
                                            </tr>
                                            <tr>
                                                <td>Midnight Memories</td>
                                                <td>Cover License</td>
                                                <td>4</td>
                                                <td>Rp 200,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Composer: Top Cover Creators -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="ti ti-microphone-2 me-2 text-primary"></i>Top Cover Creators
                                    </h3>
                                </div>
                                <div class="list-group list-group-flush">
                                    @php
                                        $coverCreators = [
                                            ['name' => 'John Smith', 'covers' => rand(5, 15), 'plays' => rand(5000, 15000), 'revenue' => rand(200, 600) * 1000],
                                            ['name' => 'Maria Garcia', 'covers' => rand(3, 10), 'plays' => rand(4000, 10000), 'revenue' => rand(150, 500) * 1000],
                                            ['name' => 'David Lee', 'covers' => rand(2, 8), 'plays' => rand(3000, 9000), 'revenue' => rand(100, 400) * 1000],
                                            ['name' => 'Sarah Johnson', 'covers' => rand(1, 5), 'plays' => rand(2000, 8000), 'revenue' => rand(50, 300) * 1000],
                                            ['name' => 'Michael Wong', 'covers' => rand(1, 3), 'plays' => rand(1000, 7000), 'revenue' => rand(25, 200) * 1000]
                                        ];
                                    @endphp
                                    
                                    @foreach($coverCreators as $index => $creator)
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="avatar">{{ $index + 1 }}</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="avatar" style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($creator['name']) }}&background=e53935&color=fff)"></span>
                                                </div>
                                                <div class="col text-truncate">
                                                    <a href="#" class="text-reset d-block">{{ $creator['name'] }}</a>
                                                                                                        <div class="text-muted text-truncate mt-n1">{{ $creator['covers'] }} covers</div>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="badge bg-primary-lt me-2">
                                                        <i class="ti ti-headphones me-1"></i>
                                                        {{ number_format($creator['plays']) }}
                                                    </span>
                                                    <span class="badge bg-green-lt">
                                                        <i class="ti ti-cash me-1"></i>
                                                        Rp {{ number_format($creator['revenue']) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Artist: Song Performance -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="ti ti-chart-bar me-2 text-primary"></i>Song Performance
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div id="chart-song-performance" style="height: 250px;">
                                        <!-- Chart will be rendered here -->
                                        <div class="d-flex align-items-center justify-content-center h-100 text-center text-muted">
                                            <div>
                                                <i class="ti ti-chart-bar mb-2" style="font-size: 3rem;"></i>
                                                <p>Song performance chart will be displayed here</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Artist: Audience Demographics -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="ti ti-users me-2 text-primary"></i>Audience Demographics
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="mb-3">Age Groups</h4>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div>18-24</div>
                                                    <div class="ms-auto">35%</div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 35%" role="progressbar"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div>25-34</div>
                                                    <div class="ms-auto">42%</div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 42%" role="progressbar"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div>35-44</div>
                                                    <div class="ms-auto">15%</div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 15%" role="progressbar"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <div>45+</div>
                                                    <div class="ms-auto">8%</div>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 8%" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="mb-3">Gender</h4>
                                            <div class="chart-sm" id="chart-gender" style="height: 200px;">
                                                <!-- Pie chart will be rendered here -->
                                                <div class="d-flex align-items-center justify-content-center h-100 text-center text-muted">
                                                    <div>
                                                        <div class="mb-3">
                                                            <span class="badge bg-primary-lt p-2 me-2">58%</span>
                                                            <span>Male</span>
                                                        </div>
                                                        <div>
                                                            <span class="badge bg-azure-lt p-2 me-2">42%</span>
                                                            <span>Female</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Recent Activity - Semua role memiliki ini, tapi konten berbeda -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ti ti-activity me-2 text-primary"></i>Recent Activity
                    </h3>
                    <div class="card-actions">
                        <a href="#" class="btn btn-link">View All</a>
                    </div>
                </div>
                <div class="card-body border-bottom-0 table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Song/Album</th>
                                @if($userRole != 'Cover Creator')
                                    <th>User</th>
                                @endif
                                <th>Location</th>
                                <th>Date/Time</th>
                                @if($userRole == 'Composer')
                                    <th>Value</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                if($userRole == 'Cover Creator') {
                                    $activities = [
                                        ['event' => 'Play', 'song' => 'Sunset Dreams (Cover)', 'location' => 'Jakarta, ID', 'time' => '2 minutes ago'],
                                        ['event' => 'Play', 'song' => 'Ocean Waves (Cover)', 'location' => 'Bandung, ID', 'time' => '15 minutes ago'],
                                        ['event' => 'Play', 'song' => 'Mountain High (Cover)', 'location' => 'Surabaya, ID', 'time' => '1 hour ago'],
                                        ['event' => 'Play', 'song' => 'City Lights (Cover)', 'location' => 'Singapore, SG', 'time' => '2 hours ago'],
                                        ['event' => 'Play', 'song' => 'Midnight Memories (Cover)', 'location' => 'Kuala Lumpur, MY', 'time' => '3 hours ago']
                                    ];
                                } elseif($userRole == 'Artist') {
                                    $activities = [
                                        ['event' => 'Play', 'song' => 'Sunset Dreams', 'user' => 'Anonymous', 'location' => 'Jakarta, ID', 'time' => '2 minutes ago'],
                                        ['event' => 'Cover Created', 'song' => 'Ocean Waves', 'user' => 'johndoe', 'location' => 'Bandung, ID', 'time' => '15 minutes ago'],
                                        ['event' => 'Play', 'song' => 'Mountain High', 'user' => 'Anonymous', 'location' => 'Surabaya, ID', 'time' => '1 hour ago'],
                                        ['event' => 'Cover Created', 'song' => 'City Lights', 'user' => 'janesmith', 'location' => 'Singapore, SG', 'time' => '2 hours ago'],
                                        ['event' => 'Play', 'song' => 'Midnight Memories', 'user' => 'Anonymous', 'location' => 'Kuala Lumpur, MY', 'time' => '3 hours ago']
                                    ];
                                } else {
                                    $activities = [
                                        ['event' => 'Play', 'song' => 'Sunset Dreams', 'user' => 'Anonymous', 'location' => 'Jakarta, ID', 'time' => '2 minutes ago', 'value' => 'Rp 500'],
                                        ['event' => 'License Purchase', 'song' => 'Ocean Waves', 'user' => 'johndoe', 'location' => 'Bandung, ID', 'time' => '15 minutes ago', 'value' => 'Rp 50,000'],
                                        ['event' => 'Play', 'song' => 'Mountain High', 'user' => 'Anonymous', 'location' => 'Surabaya, ID', 'time' => '1 hour ago', 'value' => 'Rp 500'],
                                        ['event' => 'Cover License', 'song' => 'City Lights', 'user' => 'janesmith', 'location' => 'Singapore, SG', 'time' => '2 hours ago', 'value' => 'Rp 75,000'],
                                        ['event' => 'Commercial License', 'song' => 'Urban Collection', 'user' => 'musiclover', 'location' => 'Kuala Lumpur, MY', 'time' => '3 hours ago', 'value' => 'Rp 500,000']
                                    ];
                                }
                            @endphp
                            
                            @foreach($activities as $activity)
                                <tr>
                                    <td>
                                        <span class="badge bg-{{ $activity['event'] == 'Play' ? 'blue' : ($activity['event'] == 'Cover Created' ? 'purple' : ($activity['event'] == 'License Purchase' ? 'green' : ($activity['event'] == 'Cover License' ? 'azure' : 'orange'))) }}-lt">
                                            {{ $activity['event'] }}
                                        </span>
                                    </td>
                                    <td>{{ $activity['song'] }}</td>
                                    @if($userRole != 'Cover Creator')
                                        <td>{{ $activity['user'] }}</td>
                                    @endif
                                    <td>{{ $activity['location'] }}</td>
                                    <td>{{ $activity['time'] }}</td>
                                    @if($userRole == 'Composer')
                                        <td>{{ $activity['value'] ?? '-' }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <p class="m-0 text-muted">Showing <span>1</span> to <span>5</span> of <span>25</span> entries</p>
                        <ul class="pagination m-0 ms-auto">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <i class="ti ti-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="ti ti-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Export Report Modal -->
            <div class="modal modal-blur fade" id="export-report-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Export Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Report Type</label>
                                <select class="form-select">
                                    <option value="performance">Performance Overview</option>
                                    @if($userRole != 'Cover Creator')
                                        <option value="covers">Cover Statistics</option>
                                    @endif
                                    @if($userRole == 'Composer')
                                        <option value="revenue">Revenue Analysis</option>
                                        <option value="licenses">License Sales</option>
                                    @endif
                                    <option value="complete">Complete Report</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Format</label>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="format" value="pdf" class="form-selectgroup-input" checked>
                                        <span class="form-selectgroup-label">
                                            <i class="ti ti-file-type-pdf me-1"></i>
                                            PDF
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="format" value="excel" class="form-selectgroup-input">
                                        <span class="form-selectgroup-label">
                                            <i class="ti ti-file-spreadsheet me-1"></i>
                                            Excel
                                        </span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="format" value="csv" class="form-selectgroup-input">
                                        <span class="form-selectgroup-label">
                                                                                        <i class="ti ti-file-csv me-1"></i>
                                            CSV
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date Range</label>
                                <select class="form-select">
                                    <option value="last7days" selected>Last 7 Days</option>
                                    <option value="last30days">Last 30 Days</option>
                                    <option value="thismonth">This Month</option>
                                    <option value="lastmonth">Last Month</option>
                                    <option value="custom">Custom Range</option>
                                </select>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="include-charts" checked>
                                <label class="form-check-label" for="include-charts">
                                    Include charts and visualizations
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="btn btn-primary ms-auto">
                                <i class="ti ti-download me-2"></i>Export Report
                            </button>
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
        // Simulate loading charts with a simple animation
        setTimeout(function() {
            const chartContainers = document.querySelectorAll('#chart-performance, #chart-gender, #map-world, #chart-revenue, #chart-song-performance');
            chartContainers.forEach(container => {
                if (container) {
                    container.innerHTML = `
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <img src="https://via.placeholder.com/800x300?text=Chart+Visualization" 
                                alt="Chart Visualization" 
                                style="max-width: 100%; max-height: 100%;">
                        </div>
                    `;
                }
            });
        }, 1000);
        
        // Initialize date range picker if available
        if (typeof daterangepicker !== 'undefined') {
            $('input[type="date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        }
    });
</script>
@endsection


