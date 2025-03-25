@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        User Reports
                    </h2>
                    <div class="text-muted mt-1">Analyze user growth, engagement, and demographics</div>
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
            <!-- User Stats Cards -->
            <div class="row row-deck row-cards mb-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-primary-lt me-3">
                                    <i class="ti ti-users text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Total Users</div>
                                    <div class="h3 m-0">8,742</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 12.5%
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
                                    <i class="ti ti-user-plus text-success"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">New Users</div>
                                    <div class="h3 m-0">1,853</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 8.2%
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
                                    <i class="ti ti-clock text-warning"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Avg. Session</div>
                                    <div class="h3 m-0">12:45</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-up me-1"></i> 3.8%
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
                                    <i class="ti ti-user-x text-danger"></i>
                                </div>
                                <div>
                                    <div class="text-muted fs-5">Churn Rate</div>
                                    <div class="h3 m-0">2.4%</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <span class="text-success d-inline-flex align-items-center lh-1 me-2">
                                        <i class="ti ti-trending-down me-1"></i> 0.5%
                                    </span>
                                    <span class="text-muted">vs last period</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Growth Chart -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Growth</h3>
                            <div class="card-actions">
                                <div class="btn-group">
                                    <button class="btn btn-sm active">Daily</button>
                                    <button class="btn btn-sm">Weekly</button>
                                    <button class="btn btn-sm">Monthly</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="user-growth-chart" style="height: 300px;">
                                <!-- This would be a chart in a real implementation -->
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="ti ti-chart-line text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                        <p class="text-muted">User growth chart would appear here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Demographics -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Age Distribution</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="age-chart" style="height: 200px;">
                                        <!-- This would be a chart in a real implementation -->
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="ti ti-chart-pie text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                                <p class="text-muted">Age distribution chart would appear here</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        @php
                                            $ageGroups = [
                                                ['name' => '18-24', 'percentage' => 35, 'color' => 'primary'],
                                                ['name' => '25-34', 'percentage' => 42, 'color' => 'success'],
                                                ['name' => '35-44', 'percentage' => 15, 'color' => 'warning'],
                                                ['name' => '45-54', 'percentage' => 5, 'color' => 'danger'],
                                                ['name' => '55+', 'percentage' => 3, 'color' => 'info'],
                                            ];
                                        @endphp

                                        @foreach ($ageGroups as $group)
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>{{ $group['name'] }}</span>
                                                    <span>{{ $group['percentage'] }}%</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-{{ $group['color'] }}" role="progressbar"
                                                        style="width: {{ $group['percentage'] }}%"></div>
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
                            <h3 class="card-title">Gender Distribution</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="gender-chart" style="height: 200px;">
                                        <!-- This would be a chart in a real implementation -->
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="ti ti-chart-donut text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                                <p class="text-muted">Gender distribution chart would appear here</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        @php
                                            $genders = [
                                                ['name' => 'Male', 'percentage' => 58, 'color' => 'primary'],
                                                ['name' => 'Female', 'percentage' => 40, 'color' => 'danger'],
                                                ['name' => 'Other', 'percentage' => 2, 'color' => 'success'],
                                            ];
                                        @endphp

                                        @foreach ($genders as $gender)
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>{{ $gender['name'] }}</span>
                                                    <span>{{ $gender['percentage'] }}%</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-{{ $gender['color'] }}" role="progressbar"
                                                        style="width: {{ $gender['percentage'] }}%"></div>
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

            <!-- User Roles Distribution -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Roles Distribution</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div id="roles-chart" style="height: 300px;">
                                        <!-- This would be a chart in a real implementation -->
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <div class="mb-3">
                                                    <i class="ti ti-chart-bar text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                                <p class="text-muted">User roles distribution chart would appear here</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        @php
                                            $roles = [
                                                [
                                                    'name' => 'Regular Users',
                                                    'count' => 6240,
                                                    'percentage' => 71.4,
                                                    'color' => 'primary',
                                                ],
                                                [
                                                    'name' => 'Cover Creators',
                                                    'count' => 1250,
                                                    'percentage' => 14.3,
                                                    'color' => 'success',
                                                ],
                                                [
                                                    'name' => 'Artists',
                                                    'count' => 850,
                                                    'percentage' => 9.7,
                                                    'color' => 'warning',
                                                ],
                                                [
                                                    'name' => 'Composers',
                                                    'count' => 402,
                                                    'percentage' => 4.6,
                                                    'color' => 'info',
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($roles as $role)
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>{{ $role['name'] }}</span>
                                                    <span>{{ number_format($role['count']) }}
                                                        ({{ $role['percentage'] }}%)</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-{{ $role['color'] }}" role="progressbar"
                                                        style="width: {{ $role['percentage'] }}%"></div>
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

            <!-- Top Active Users -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Active Users</h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-link">View All</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-hover">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                        <th>Activity Score</th>
                                        <th>Last Active</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $users = [
                                            [
                                                'name' => 'John Doe',
                                                'role' => 'Artist',
                                                'joined' => '2023-01-15',
                                                'score' => 98,
                                                'last_active' => '2 minutes ago',
                                            ],
                                            [
                                                'name' => 'Jane Smith',
                                                'role' => 'Composer',
                                                'joined' => '2023-02-22',
                                                'score' => 95,
                                                'last_active' => '10 minutes ago',
                                            ],
                                            [
                                                'name' => 'Robert Johnson',
                                                'role' => 'Cover Creator',
                                                'joined' => '2023-03-10',
                                                'score' => 92,
                                                'last_active' => '25 minutes ago',
                                            ],
                                            [
                                                'name' => 'Emily Davis',
                                                'role' => 'Artist',
                                                'joined' => '2023-01-05',
                                                'score' => 90,
                                                'last_active' => '1 hour ago',
                                            ],
                                            [
                                                'name' => 'Michael Wilson',
                                                'role' => 'Cover Creator',
                                                'joined' => '2023-04-18',
                                                'score' => 88,
                                                'last_active' => '2 hours ago',
                                            ],
                                            [
                                                'name' => 'Sarah Brown',
                                                'role' => 'Regular User',
                                                'joined' => '2023-05-20',
                                                'score' => 85,
                                                'last_active' => '3 hours ago',
                                            ],
                                            [
                                                'name' => 'David Miller',
                                                'role' => 'Composer',
                                                'joined' => '2023-02-12',
                                                'score' => 82,
                                                'last_active' => '5 hours ago',
                                            ],
                                            [
                                                'name' => 'Lisa Anderson',
                                                'role' => 'Regular User',
                                                'joined' => '2023-06-01',
                                                'score' => 80,
                                                'last_active' => '8 hours ago',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=e53935&color=fff)"></span>
                                                    <div>{{ $user['name'] }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $user['role'] }}</td>
                                            <td>{{ $user['joined'] }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-primary"
                                                                style="width: {{ $user['score'] }}%"></div>
                                                        </div>
                                                    </div>
                                                    <span>{{ $user['score'] }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $user['last_active'] }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon btn-ghost-secondary"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-user me-2"></i>View Profile
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-message me-2"></i>Send Message
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-chart me-2"></i>View Activity
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>100</span> entries
                            </p>
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
