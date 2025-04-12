@extends('layouts.app-admin')

@section('title', 'Royalties Management')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Royalties Management
                    </h2>
                    <div class="text-muted mt-1">Manage artist and composer royalties</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                            <i class="ti ti-plus"></i>
                            Add New Royalty Payment
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                            <i class="ti ti-plus"></i>
                        </a>
                        <a href="#" class="btn btn-secondary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-import">
                            <i class="ti ti-upload"></i>
                            Import Data
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
                    <h3 class="card-title">Royalty Payments</h3>
                    <div class="card-actions">
                        <div class="row g-2">
                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Select date range">
                                </div>
                            </div>
                            <div class="col">
                                <select class="form-select">
                                    <option value="all">All Types</option>
                                    <option value="artist">Artist Royalties</option>
                                    <option value="composer">Composer Royalties</option>
                                    <option value="cover">Cover Creator Royalties</option>
                                </select>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <button class="btn btn-icon" type="button">
                                        <i class="ti ti-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Content</th>
                                    <th>Period</th>
                                    <th>Streams</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statuses = ['Pending', 'Processed', 'Paid', 'Cancelled'];
                                    $roles = ['Artist', 'Composer', 'Cover Creator'];
                                    $contentTypes = ['Song', 'Album', 'Cover'];

                                    // Generate dummy data
                                    $royalties = [];
                                    for ($i = 1; $i <= 20; $i++) {
                                        $royalties[] = [
                                            'id' => 'ROY' . str_pad($i, 5, '0', STR_PAD_LEFT),
                                            'user_name' => 'User ' . $i,
                                            'user_avatar' => 'https://picsum.photos/seed/' . $i . '/200/200',
                                            'role' => $roles[array_rand($roles)],
                                            'content_type' => $contentTypes[array_rand($contentTypes)],
                                            'content_name' => 'Content Title ' . $i,
                                            'period' => 'Q' . rand(1, 4) . ' ' . rand(2022, 2023),
                                            'streams' => rand(1000, 500000),
                                            'amount' => rand(10, 5000) * 1000,
                                            'status' => $statuses[array_rand($statuses)],
                                            'date' => now()->subDays(rand(1, 60))->format('Y-m-d'),
                                        ];
                                    }
                                @endphp

                                @foreach ($royalties as $royalty)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('admin.royalties.show', $royalty['id']) }}">{{ $royalty['id'] }}</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar avatar-sm me-2"
                                                    style="background-image: url({{ $royalty['user_avatar'] }})"></span>
                                                <div>{{ $royalty['user_name'] }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $royalty['role'] }}</td>
                                        <td>
                                            <span class="badge bg-azure-lt me-1">{{ $royalty['content_type'] }}</span>
                                            {{ $royalty['content_name'] }}
                                        </td>
                                        <td>{{ $royalty['period'] }}</td>
                                        <td>{{ number_format($royalty['streams']) }}</td>
                                        <td>Rp {{ number_format($royalty['amount']) }}</td>
                                        <td>
                                            @if ($royalty['status'] == 'Pending')
                                                <span class="badge bg-yellow">Pending</span>
                                            @elseif($royalty['status'] == 'Processed')
                                                <span class="badge bg-blue">Processed</span>
                                            @elseif($royalty['status'] == 'Paid')
                                                <span class="badge bg-green">Paid</span>
                                            @else
                                                <span class="badge bg-red">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>{{ $royalty['date'] }}</td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="{{ route('admin.royalties.show', $royalty['id']) }}"
                                                    class="btn btn-sm btn-icon btn-ghost-secondary">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon btn-ghost-secondary"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.royalties.edit', $royalty['id']) }}">
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>20</span> of
                        <span>{{ count($royalties) }}</span> entries
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

    <!-- Add New Royalty Payment Modal -->
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Royalty Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <select class="form-select">
                            <option value="">Select user</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">User {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Content Type</label>
                                <select class="form-select">
                                    <option value="song">Song</option>
                                    <option value="album">Album</option>
                                    <option value="cover">Cover</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <select class="form-select">
                                    <option value="">Select content</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">Content {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Period</label>
                                <select class="form-select">
                                    <option value="Q1 2023">Q1 2023</option>
                                    <option value="Q2 2023">Q2 2023</option>
                                    <option value="Q3 2023">Q3 2023</option>
                                    <option value="Q4 2023">Q4 2023</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Streams</label>
                                <input type="number" class="form-control" placeholder="Number of streams">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Amount (Rp)</label>
                                <input type="number" class="form-control" placeholder="Amount in Rupiah">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option value="pending">Pending</option>
                            <option value="processed">Processed</option>
                            <option value="paid">Paid</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="3" placeholder="Additional notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a href="#" class="btn btn-primary ms-auto">
                        <i class="ti ti-plus"></i>
                        Create new royalty payment
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Data Modal -->
    <div class="modal modal-blur fade" id="modal-import" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Royalty Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-label">Upload CSV or Excel file</div>
                        <input type="file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Period</label>
                        <select class="form-select">
                            <option value="Q1 2023">Q1 2023</option>
                            <option value="Q2 2023">Q2 2023</option>
                            <option value="Q3 2023">Q3 2023</option>
                            <option value="Q4 2023">Q4 2023</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="overwrite-existing">
                        <label class="form-check-label" for="overwrite-existing">
                            Overwrite existing data
                        </label>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm">
                            <i class="ti ti-download"></i> Download Template
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a href="#" class="btn btn-primary ms-auto">
                        <i class="ti ti-upload"></i>
                        Import Data
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
