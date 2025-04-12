@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Product Details
                    </h2>
                    <div class="text-muted mt-1">View product information</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.products.edit', $id) }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-edit me-2"></i>
                            Edit Product
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @php
                // Generate dummy product data based on ID
                $productId = $id;
                $productNumber = 'MSC-' . rand(100, 999) . '-' . rand(1000, 9999);
                $types = ['license', 'physical', 'digital', 'service', 'others'];
                $type = $types[array_rand($types)];
                $licenseTypes = ['cover', 'commercial', 'royalty'];
                $licenseType = $type === 'license' ? $licenseTypes[array_rand($licenseTypes)] : null;

                $product = [
                    'id' => $productId,
                    'number' => $productNumber,
                    'name' =>
                        'Product ' .
                        substr($productId, -3) .
                        ' ' .
                        ucfirst($type) .
                        ($licenseType ? ' ' . ucfirst($licenseType) : ''),
                    'description' =>
                        'This is a detailed description for the product. It includes information about what the product offers, its benefits, and any special features. This product is designed to meet the needs of musicians and content creators.',
                    'type' => $type,
                    'license_type' => $licenseType,
                    'price' => rand(5, 500) * 1000,
                    'picture' => 'https://picsum.photos/id/' . (intval(substr($productId, -3)) + 10) . '/800/600',
                    'created_at' => now()->subDays(rand(1, 60))->format('Y-m-d H:i:s'),
                    'updated_at' => now()->subDays(rand(0, 30))->format('Y-m-d H:i:s'),
                    'song_id' => $type === 'license' ? 'song-' . rand(1, 10) : null,
                    'song_title' => $type === 'license' ? 'Song Title ' . rand(1, 10) : null,
                    'artist_id' => $type === 'service' ? 'artist-' . rand(1, 10) : null,
                    'artist_name' => $type === 'service' ? 'Artist Name ' . rand(1, 10) : null,
                    'available_start' =>
                        $type === 'service' ? now()->addDays(rand(1, 30))->format('Y-m-d H:i:s') : null,
                    'available_end' => $type === 'service' ? now()->addDays(rand(31, 60))->format('Y-m-d H:i:s') : null,
                    'file' =>
                        $type === 'digital' || $type === 'physical'
                            ? 'product_file_' . rand(1000, 9999) . '.zip'
                            : null,
                ];
            @endphp

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Product Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Product Number</div>
                                    <div class="datagrid-content">{{ $product['number'] }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Product Name</div>
                                    <div class="datagrid-content">{{ $product['name'] }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Type</div>
                                    <div class="datagrid-content">
                                        <span
                                            class="badge bg-{{ $product['type'] === 'license' ? 'blue' : ($product['type'] === 'physical' ? 'green' : ($product['type'] === 'digital' ? 'purple' : ($product['type'] === 'service' ? 'orange' : 'secondary'))) }}">
                                            {{ ucfirst($product['type']) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Price</div>
                                    <div class="datagrid-content">Rp {{ number_format($product['price'], 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created</div>
                                    <div class="datagrid-content">
                                        {{ \Carbon\Carbon::parse($product['created_at'])->format('d M Y H:i') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Last Updated</div>
                                    <div class="datagrid-content">
                                        {{ \Carbon\Carbon::parse($product['updated_at'])->format('d M Y H:i') }}</div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h4>Description</h4>
                                <p>{{ $product['description'] }}</p>
                            </div>
                        </div>
                    </div>

                    @if ($product['type'] === 'license')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">License Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="datagrid">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">License Type</div>
                                        <div class="datagrid-content">
                                            <span
                                                class="badge bg-{{ $product['license_type'] === 'cover' ? 'teal' : ($product['license_type'] === 'commercial' ? 'indigo' : 'pink') }}">
                                                {{ ucfirst($product['license_type']) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Song</div>
                                        <div class="datagrid-content">{{ $product['song_title'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($product['type'] === 'digital' || $product['type'] === 'physical')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">{{ ucfirst($product['type']) }} Product Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="datagrid">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">File</div>
                                        <div class="datagrid-content">
                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-download me-1"></i> {{ $product['file'] }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($product['type'] === 'service')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Service Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="datagrid">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Artist</div>
                                        <div class="datagrid-content">{{ $product['artist_name'] }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Available From</div>
                                        <div class="datagrid-content">
                                            {{ \Carbon\Carbon::parse($product['available_start'])->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Available Until</div>
                                        <div class="datagrid-content">
                                            {{ \Carbon\Carbon::parse($product['available_end'])->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Product Image</h3>
                        </div>
                        <div class="card-body">
                            <div class="ratio ratio-4x3 mb-3">
                                <img src="{{ $product['picture'] }}" class="rounded object-fit-cover"
                                    alt="{{ $product['name'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Actions</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <a href="{{ route('admin.products.edit', $product['id']) }}" class="btn btn-primary mb-2">
                                    <i class="ti ti-edit me-2"></i>Edit Product
                                </a>
                                <button type="button" class="btn btn-danger mb-2"
                                    onclick="confirmDelete('{{ $product['id'] }}')">
                                    <i class="ti ti-trash me-2"></i>Delete Product
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-2"></i>Back to Products
                                </a>
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
                    // For now, we'll just show a success message and redirect
                    Swal.fire(
                        'Deleted!',
                        'The product has been deleted.',
                        'success'
                    ).then(() => {
                        window.location.href = "{{ route('admin.products.index') }}";
                    });
                }
            });
        }
    </script>
@endsection
