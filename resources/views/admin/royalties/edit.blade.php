@extends('layouts.app-admin')

@section('title', 'Edit Royalty Payment')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Royalties Management
                    </div>
                    <h2 class="page-title">
                        Edit Royalty Payment
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.royalties.index') }}"
                            class="btn btn-outline-secondary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>
                            Back to Royalties
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @php
                // Generate dummy data for the specific royalty
                $royalty = [
                    'id' => 'ROY00123',
                    'user_id' => 5,
                    'user_name' => 'John Doe',
                    'user_email' => 'johndoe@example.com',
                    'user_avatar' => 'https://picsum.photos/seed/user1/200/200',
                    'role' => 'Artist',
                    'content_type' => 'Song',
                    'content_id' => 10,
                    'content_name' => 'Amazing Song Title',
                    'period' => 'Q2 2023',
                    'streams' => 245789,
                    'amount' => 3500000,
                    'status' => 'Processed',
                    'date_created' => now()->subDays(15)->format('Y-m-d'),
                    'date_processed' => now()->subDays(10)->format('Y-m-d'),
                    'date_paid' => null,
                    'payment_method' => 'Bank Transfer',
                    'bank_name' => 'Bank Central Asia',
                    'account_number' => '1234567890',
                    'account_name' => 'John Doe',
                    'notes' => 'Royalty payment for Q2 2023 streaming revenue.',
                    'platform_breakdown' => [
                        ['platform' => 'Spotify', 'streams' => 125000, 'amount' => 1750000],
                        ['platform' => 'Apple Music', 'streams' => 75000, 'amount' => 1050000],
                        ['platform' => 'YouTube Music', 'streams' => 35789, 'amount' => 500000],
                        ['platform' => 'Others', 'streams' => 10000, 'amount' => 200000],
                    ],
                ];
            @endphp

            <form class="card">
                <div class="card-header">
                    <h3 class="card-title">Royalty Payment Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Royalty ID</label>
                            <input type="text" class="form-control" value="{{ $royalty['id'] }}" readonly>
                            <div class="form-hint">Royalty ID cannot be changed</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select">
                                <option value="Pending" {{ $royalty['status'] == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="Processed" {{ $royalty['status'] == 'Processed' ? 'selected' : '' }}>
                                    Processed</option>
                                <option value="Paid" {{ $royalty['status'] == 'Paid' ? 'selected' : '' }}>Paid</option>
                                <option value="Cancelled" {{ $royalty['status'] == 'Cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-text">User Information</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">User</label>
                            <select class="form-select">
                                <option value="{{ $royalty['user_id'] }}" selected>{{ $royalty['user_name'] }}
                                    ({{ $royalty['user_email'] }})</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i != $royalty['user_id'])
                                        <option value="{{ $i }}">User {{ $i }}
                                            (user{{ $i }}@example.com)</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select">
                                <option value="Artist" {{ $royalty['role'] == 'Artist' ? 'selected' : '' }}>Artist</option>
                                <option value="Composer" {{ $royalty['role'] == 'Composer' ? 'selected' : '' }}>Composer
                                </option>
                                <option value="Cover Creator" {{ $royalty['role'] == 'Cover Creator' ? 'selected' : '' }}>
                                    Cover Creator</option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-text">Content Information</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Content Type</label>
                            <select class="form-select">
                                <option value="Song" {{ $royalty['content_type'] == 'Song' ? 'selected' : '' }}>Song
                                </option>
                                <option value="Album" {{ $royalty['content_type'] == 'Album' ? 'selected' : '' }}>Album
                                </option>
                                <option value="Cover" {{ $royalty['content_type'] == 'Cover' ? 'selected' : '' }}>Cover
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Content</label>
                            <select class="form-select">
                                <option value="{{ $royalty['content_id'] }}" selected>{{ $royalty['content_name'] }}
                                </option>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i != $royalty['content_id'])
                                        <option value="{{ $i }}">Content Title {{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required">Period</label>
                            <select class="form-select">
                                <option value="Q1 2023" {{ $royalty['period'] == 'Q1 2023' ? 'selected' : '' }}>Q1 2023
                                </option>
                                <option value="Q2 2023" {{ $royalty['period'] == 'Q2 2023' ? 'selected' : '' }}>Q2 2023
                                </option>
                                <option value="Q3 2023" {{ $royalty['period'] == 'Q3 2023' ? 'selected' : '' }}>Q3 2023
                                </option>
                                <option value="Q4 2023" {{ $royalty['period'] == 'Q4 2023' ? 'selected' : '' }}>Q4 2023
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required">Total Streams</label>
                            <input type="number" class="form-control" value="{{ $royalty['streams'] }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required">Total Amount (Rp)</label>
                            <input type="number" class="form-control" value="{{ $royalty['amount'] }}">
                        </div>
                    </div>

                    <div class="hr-text">Platform Breakdown</div>

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Platform</th>
                                            <th>Streams</th>
                                            <th>Amount (Rp)</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($royalty['platform_breakdown'] as $index => $platform)
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        value="{{ $platform['platform'] }}">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control"
                                                        value="{{ $platform['streams'] }}">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control"
                                                        value="{{ $platform['amount'] }}">
                                                </td>
                                                <td>
                                                    @if ($index > 0)
                                                        <button type="button" class="btn btn-icon btn-outline-danger">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-outline-success mt-2">
                                <i class="ti ti-plus"></i> Add Platform
                            </button>
                        </div>
                    </div>

                    <div class="hr-text">Payment Information</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select">
                                <option value="Bank Transfer"
                                    {{ $royalty['payment_method'] == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer
                                </option>
                                <option value="PayPal" {{ $royalty['payment_method'] == 'PayPal' ? 'selected' : '' }}>
                                    PayPal</option>
                                <option value="E-Wallet" {{ $royalty['payment_method'] == 'E-Wallet' ? 'selected' : '' }}>
                                    E-Wallet</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bank Name</label>
                            <input type="text" class="form-control" value="{{ $royalty['bank_name'] }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" class="form-control" value="{{ $royalty['account_number'] }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Name</label>
                            <input type="text" class="form-control" value="{{ $royalty['account_name'] }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date Created</label>
                            <input type="date" class="form-control" value="{{ $royalty['date_created'] }}" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date Processed</label>
                            <input type="date" class="form-control" value="{{ $royalty['date_processed'] }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date Paid</label>
                            <input type="date" class="form-control" value="{{ $royalty['date_paid'] }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="3">{{ $royalty['notes'] }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="d-flex">
                        <a href="{{ route('admin.royalties.index') }}" class="btn btn-link">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-auto">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Handle adding new platform row
            document.querySelector('.btn-outline-success').addEventListener('click', function() {
                const tbody = document.querySelector('table tbody');
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                <td>
                    <input type="text" class="form-control" placeholder="Platform name">
                </td>
                <td>
                    <input type="number" class="form-control" placeholder="0" min="0">
                </td>
                <td>
                    <input type="number" class="form-control" placeholder="0" min="0">
                </td>
                <td>
                    <button type="button" class="btn btn-icon btn-outline-danger remove-platform">
                        <i class="ti ti-trash"></i>
                    </button>
                </td>
            `;

                tbody.appendChild(newRow);

                // Add event listener to the new remove button
                newRow.querySelector('.remove-platform').addEventListener('click', function() {
                    this.closest('tr').remove();
                    updateTotals();
                });
            });

            // Handle removing platform rows
            document.querySelectorAll('.btn-outline-danger').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('tr').remove();
                    updateTotals();
                });
            });

            // Function to update total streams and amount
            function updateTotals() {
                let totalStreams = 0;
                let totalAmount = 0;

                document.querySelectorAll('table tbody tr').forEach(row => {
                    const streams = parseInt(row.querySelector('td:nth-child(2) input').value) || 0;
                    const amount = parseInt(row.querySelector('td:nth-child(3) input').value) || 0;

                    totalStreams += streams;
                    totalAmount += amount;
                });

                // Update the total fields
                document.querySelector('input[placeholder="Total Streams"]').value = totalStreams;
                document.querySelector('input[placeholder="Total Amount (Rp)"]').value = totalAmount;
            }

            // Add event listeners to update totals when values change
            document.querySelectorAll('table input').forEach(input => {
                input.addEventListener('change', updateTotals);
            });
        });
    </script>
@endsection
