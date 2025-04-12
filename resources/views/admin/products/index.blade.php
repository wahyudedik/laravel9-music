@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Products Licensed Management
                    </h2>
                    <div class="text-muted mt-1">Manage all licensed products in the system</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-plus me-2"></i>
                            Add New Product
                        </a>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary d-sm-none btn-icon">
                            <i class="ti ti-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card mb-4" style="overflow: auto;">
                <div class="card-header">
                    <h3 class="card-title">Filter Products</h3>
                </div>
                <form id="form-filter" action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Type</label>
                                <select name="ftype" id="ftype" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="license" {{ request('ftype') == 'license' ? 'selected' : '' }}>License
                                    </option>
                                    <option value="physical" {{ request('ftype') == 'physical' ? 'selected' : '' }}>Physical
                                    </option>
                                    <option value="digital" {{ request('ftype') == 'digital' ? 'selected' : '' }}>Digital
                                    </option>
                                    <option value="service" {{ request('ftype') == 'service' ? 'selected' : '' }}>Service
                                    </option>
                                    <option value="others" {{ request('ftype') == 'others' ? 'selected' : '' }}>Others
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price Range</label>
                                <div class="input-group">
                                    <input type="number" name="fmin_price" class="form-control" placeholder="Min"
                                        value="{{ request('fmin_price') }}">
                                    <span class="input-group-text">to</span>
                                    <input type="number" name="fmax_price" class="form-control" placeholder="Max"
                                        value="{{ request('fmax_price') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">License Type</label>
                                <select name="flicense_type" id="flicense_type" class="form-select">
                                    <option value="">All License Types</option>
                                    <option value="full" {{ request('flicense_type') == 'full' ? 'selected' : '' }}>
                                        Full</option>
                                    <option value="commercial"
                                        {{ request('flicense_type') == 'commercial' ? 'selected' : '' }}>Commercial
                                    </option>
                                    <option value="royalty" {{ request('flicense_type') == 'royalty' ? 'selected' : '' }}>
                                        Royalty</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.products.index') }}" id="reset-filters"
                                        class="btn btn-link me-2">Reset</a>
                                    <button type="submit" id="apply-filters" class="btn btn-primary">Apply Filters</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Products List</h3>
                    <div class="d-flex">
                        <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
                            <div class="input-icon me-3">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" name="search" id="product-search" class="form-control"
                                    value="{{ request('search') }}" placeholder="Search products...">
                            </div>
                        </form>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                id="bulkActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Bulk Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="bulkActionsDropdown">
                                <li><a class="dropdown-item bulk-action-btn" href="javascript:void(0)"
                                        data-action="activate"><i class="ti ti-check me-2"></i>Activate Selected</a></li>
                                <li><a class="dropdown-item bulk-action-btn" href="javascript:void(0)"
                                        data-action="deactivate"><i class="ti ti-x me-2"></i>Deactivate Selected</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger bulk-action-btn" href="javascript:void(0)"
                                        data-action="delete"><i class="ti ti-trash me-2"></i>Delete Selected</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-hover">
                        <thead>
                            <tr>
                                <th class="w-1">
                                    <input class="form-check-input m-0 align-middle" type="checkbox" id="select-all">
                                </th>
                                <th>Product</th>
                                <th>Number</th>
                                <th>Type</th>
                                <th>License Type</th>
                                <th>Price</th>
                                <th>Created</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="products-table-body">
                            @php
                                // Generate dummy data
                                $products = [];
                                $types = ['license', 'physical', 'digital', 'service', 'others'];
                                $licenseTypes = ['full', 'commercial', 'royalty'];

                                for ($i = 1; $i <= 15; $i++) {
                                    $type = $types[array_rand($types)];
                                    $licenseType =
                                        $type === 'license' ? $licenseTypes[array_rand($licenseTypes)] : null;

                                    $products[] = [
                                        'id' => 'prod-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                                        'number' => 'MSC-' . rand(100, 999) . '-' . rand(1000, 9999),
                                        'name' =>
                                            'Product ' .
                                            $i .
                                            ' ' .
                                            ucfirst($type) .
                                            ($licenseType ? ' ' . ucfirst($licenseType) : ''),
                                        'description' => 'This is a sample description for product ' . $i,
                                        'type' => $type,
                                        'license_type' => $licenseType,
                                        'price' => rand(5, 500) * 1000,
                                        'picture' => 'https://picsum.photos/id/' . ($i + 10) . '/200/200',
                                        'created_at' => now()->subDays(rand(1, 60))->format('Y-m-d H:i:s'),
                                    ];
                                }
                            @endphp

                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <input class="form-check-input m-0 align-middle product-checkbox" type="checkbox"
                                            value="{{ $product['id'] }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url('{{ $product['picture'] }}')"></span>
                                            <div>
                                                <div>{{ $product['name'] }}</div>
                                                <div class="text-muted">{{ Str::limit($product['description'], 30) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $product['number'] }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $product['type'] === 'license' ? 'blue' : ($product['type'] === 'physical' ? 'green' : ($product['type'] === 'digital' ? 'purple' : ($product['type'] === 'service' ? 'orange' : 'secondary'))) }}">
                                            {{ ucfirst($product['type']) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($product['license_type'])
                                            <span
                                                class="badge bg-{{ $product['license_type'] === 'cover' ? 'teal' : ($product['license_type'] === 'commercial' ? 'indigo' : 'pink') }}">
                                                {{ ucfirst($product['license_type']) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product['created_at'])->format('d M Y') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.products.show', $product['id']) }}"
                                                    class="dropdown-item">
                                                    <i class="ti ti-eye me-2"></i>View
                                                </a>
                                                <a href="{{ route('admin.products.edit', $product['id']) }}"
                                                    class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)"
                                                    class="dropdown-item text-danger delete-product"
                                                    onclick="confirmDelete('{{ $product['id'] }}')"
                                                    data-id="{{ $product['id'] }}">
                                                    <i class="ti ti-trash me-2"></i>Delete
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
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>{{ count($products) }}</span> of
                        <span>{{ count($products) }}</span> entries</p>
                    <ul class="pagination m-0 ms-auto">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <i class="ti ti-chevron-left"></i>
                                prev
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
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
@endsection

@push('styles')
    <style>
        .card-no-hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: none;
        }

        .card-no-hover:hover {
            transform: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all functionality
            $('#select-all').on('change', function() {
                $('.product-checkbox').prop('checked', this.checked);
            });

            // If any individual checkbox is unchecked, uncheck #select-all
            $('.product-checkbox').on('change', function() {
                if (!$(this).is(':checked')) {
                    $('#select-all').prop('checked', false);
                }

                // If all are checked, check #select-all
                if ($('.product-checkbox:checked').length === $('.product-checkbox').length) {
                    $('#select-all').prop('checked', true);
                }
            });

            // Apply filters button
            $('#apply-filters').on('click', function() {
                $('#form-filter').submit();
            });

            // Bulk action buttons
            document.querySelectorAll('.bulk-action-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const action = this.dataset.action;
                    const selectedIds = Array.from(document.querySelectorAll(
                        '.product-checkbox:checked')).map(cb => cb.value);

                    if (selectedIds.length === 0) {
                        return Swal.fire({
                            icon: 'warning',
                            title: 'No Products Selected',
                            text: 'Please select at least one product to proceed.',
                            confirmButtonText: 'OK'
                        });
                    }

                    Swal.fire({
                        title: `Are you sure?`,
                        text: `You are about to ${action} ${selectedIds.length} product(s).`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, proceed!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Here you would normally make an AJAX call to a bulk action endpoint
                            // For now, we'll just show a success message
                            Swal.fire({
                                title: 'Success!',
                                text: `${selectedIds.length} product(s) have been ${action}d.`,
                                icon: 'success'
                            }).then(() => {
                                // Reload the page to reflect changes
                                location.reload();
                            });
                        }
                    });
                });
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e53935',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Here you would normally submit a form to delete the product
                    // For now, we'll just show a success message
                    Swal.fire(
                        'Deleted!',
                        'The product has been deleted.',
                        'success'
                    ).then(() => {
                        // Reload the page to reflect changes
                        location.reload();
                    });
                }
            });
        }
    </script>
@endsection
