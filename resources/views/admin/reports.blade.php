@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Analytics & Reports
                    </h2>
                    <div class="text-muted mt-1">Comprehensive data insights and performance metrics</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
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
            <!-- Report Categories -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar bg-primary-lt me-3">
                                    <i class="ti ti-users text-primary"></i>
                                </div>
                                <h3 class="card-title m-0">User Reports</h3>
                            </div>
                            <p class="text-muted">Analyze user growth, engagement, and demographics data to understand your
                                audience better.</p>
                            <div class="mt-4">
                                <a href="{{ route('admin.reports.users') }}" class="btn btn-primary w-100">
                                    View User Reports
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar bg-success-lt me-3">
                                    <i class="ti ti-currency-dollar text-success"></i>
                                </div>
                                <h3 class="card-title m-0">Revenue Reports</h3>
                            </div>
                            <p class="text-muted">Track financial performance, revenue streams, and monetization metrics
                                across the platform.</p>
                            <div class="mt-4">
                                <a href="{{ route('admin.reports.revenue') }}" class="btn btn-success w-100">
                                    View Revenue Reports
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar bg-warning-lt me-3">
                                    <i class="ti ti-music text-warning"></i>
                                </div>
                                <h3 class="card-title m-0">Content Reports</h3>
                            </div>
                            <p class="text-muted">Analyze song performance, uploads, and engagement metrics to optimize your
                                content strategy.</p>
                            <div class="mt-4">
                                <a href="{{ route('admin.reports.content') }}" class="btn btn-warning w-100">
                                    View Content Reports
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Performance Indicators -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Key Performance Indicators</h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="ti ti-download me-2"></i>Export
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="d-flex flex-column mb-4">
                                        <div class="text-muted mb-1">Total Users</div>
                                        <div class="d-flex align-items-baseline">
                                            <h3 class="me-2 mb-0">8,742</h3>
                                            <span class="text-success d-inline-flex align-items-center lh-1">
                                                <i class="ti ti-trending-up me-1"></i> 12.5%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column mb-4">
                                        <div class="text-muted mb-1">Total Revenue</div>
                                        <div class="d-flex align-items-baseline">
                                            <h3 class="me-2 mb-0">Rp. 245.3M</h3>
                                            <span class="text-success d-inline-flex align-items-center lh-1">
                                                <i class="ti ti-trending-up me-1"></i> 15.3%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column mb-4">
                                        <div class="text-muted mb-1">Total Songs</div>
                                        <div class="d-flex align-items-baseline">
                                            <h3 class="me-2 mb-0">3,842</h3>
                                            <span class="text-success d-inline-flex align-items-center lh-1">
                                                <i class="ti ti-trending-up me-1"></i> 8.3%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column mb-4">
                                        <div class="text-muted mb-1">Total Plays</div>
                                        <div class="d-flex align-items-baseline">
                                            <h3 class="me-2 mb-0">1.2M</h3>
                                            <span class="text-success d-inline-flex align-items-center lh-1">
                                                <i class="ti ti-trending-up me-1"></i> 12.7%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="kpi-chart" style="height: 300px;">
                                <!-- This would be a chart in a real implementation -->
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="ti ti-chart-area text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                        <p class="text-muted">KPI trend chart would appear here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Scheduled Reports -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-primary-lt">
                                            <i class="ti ti-user-plus text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">User registration spike detected</div>
                                        <div class="text-muted">150 new users registered in the last 24 hours</div>
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-muted">2 hours ago</span>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-success-lt">
                                            <i class="ti ti-currency-dollar text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">Revenue milestone reached</div>
                                        <div class="text-muted">Monthly revenue target of Rp. 50M has been exceeded</div>
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-muted">5 hours ago</span>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-warning-lt">
                                            <i class="ti ti-music text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">Popular song detected</div>
                                        <div class="text-muted">"Blinding Lights" by The Weeknd has reached 100K plays
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-muted">8 hours ago</span>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-danger-lt">
                                            <i class="ti ti-alert-triangle text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">Unusual activity detected</div>
                                        <div class="text-muted">Multiple login attempts from unrecognized IP addresses
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-muted">12 hours ago</span>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-info-lt">
                                            <i class="ti ti-report text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">Monthly report generated</div>
                                        <div class="text-muted">June 2023 performance report is now available</div>
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-muted">1 day ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Scheduled Reports</h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-link">
                                    <i class="ti ti-plus me-1"></i>Add New
                                </a>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-primary-lt">
                                            <i class="ti ti-users text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">User Growth Report</div>
                                        <div class="text-muted">Weekly • Every Monday</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-mail me-2"></i>Send Now
                                                </a>
                                                <a href="#" class="dropdown-item text-danger">
                                                    <i class="ti ti-trash me-2"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-success-lt">
                                            <i class="ti ti-currency-dollar text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">Revenue Summary</div>
                                        <div class="text-muted">Monthly • 1st of month</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-mail me-2"></i>Send Now
                                                </a>
                                                <a href="#" class="dropdown-item text-danger">
                                                    <i class="ti ti-trash me-2"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-warning-lt">
                                            <i class="ti ti-music text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">Content Performance</div>
                                        <div class="text-muted">Bi-weekly • Every other Friday</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-mail me-2"></i>Send Now
                                                </a>
                                                <a href="#" class="dropdown-item text-danger">
                                                    <i class="ti ti-trash me-2"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar avatar-rounded bg-info-lt">
                                            <i class="ti ti-chart-pie text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-body">Executive Summary</div>
                                        <div class="text-muted">Quarterly • End of quarter</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-mail me-2"></i>Send Now
                                                </a>
                                                <a href="#" class="dropdown-item text-danger">
                                                    <i class="ti ti-trash me-2"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#schedule-report-modal">
                                <i class="ti ti-plus me-2"></i>Schedule New Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Report Modal -->
    <div class="modal modal-blur fade" id="schedule-report-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Schedule New Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Report Name</label>
                        <input type="text" class="form-control" placeholder="Enter report name">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Report Type</label>
                            <select class="form-select">
                                <option value="user">User Report</option>
                                <option value="revenue">Revenue Report</option>
                                <option value="content">Content Report</option>
                                <option value="custom">Custom Report</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Format</label>
                            <select class="form-select">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                                <option value="html">HTML Email</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Frequency</label>
                            <select class="form-select">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="biweekly">Bi-weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Day of Week/Month</label>
                            <select class="form-select">
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="1st">1st of Month</option>
                                <option value="15th">15th of Month</option>
                                <option value="last">Last Day of Month</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Recipients</label>
                        <select class="form-select" multiple>
                            <option value="admin">All Administrators</option>
                            <option value="finance">Finance Team</option>
                            <option value="content">Content Team</option>
                            <option value="marketing">Marketing Team</option>
                            <option value="custom">Custom Recipients</option>
                        </select>
                        <small class="form-hint">Hold Ctrl/Cmd to select multiple options</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Additional Email Addresses</label>
                        <input type="text" class="form-control"
                            placeholder="Enter email addresses separated by commas">
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Report Options</div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="include-charts">
                            <label class="form-check-label" for="include-charts">
                                Include Charts and Visualizations
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="include-raw-data">
                            <label class="form-check-label" for="include-raw-data">
                                Include Raw Data
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="include-summary">
                            <label class="form-check-label" for="include-summary">
                                Include Executive Summary
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary ms-auto">
                        <i class="ti ti-calendar-plus me-2"></i>Schedule Report
                    </button>
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
