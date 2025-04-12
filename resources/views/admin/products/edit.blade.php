@extends('layouts.app-admin')

@section('content')
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
                'This is a detailed description for the product. It includes information about what the product offers, its benefits, and any special features.',
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
            'available_start' => $type === 'service' ? now()->addDays(rand(1, 30))->format('Y-m-d H:i:s') : null,
            'available_end' => $type === 'service' ? now()->addDays(rand(31, 60))->format('Y-m-d H:i:s') : null,
            'file' => $type === 'digital' || $type === 'physical' ? 'product_file_' . rand(1000, 9999) . '.zip' : null,
        ];
    @endphp

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Product
                    </h2>
                    <div class="text-muted mt-1">Update product information</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.products.show', $product['id']) }}"
                            class="btn btn-secondary d-none d-sm-inline-block">
                            <i class="ti ti-eye me-2"></i>
                            View Product
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
            <form action="{{ route('admin.products.index') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Product Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Product Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $product['name'] }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Product Number</label>
                                    <input type="text" class="form-control" name="number"
                                        value="{{ $product['number'] }}" required>
                                    <small class="form-hint">Unique product code (e.g. MSC-123-4567)</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="5">{{ $product['description'] }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Product Type</label>
                                        <select name="type" id="product-type" class="form-select" required>
                                            <option value="">Select Type</option>
                                            <option value="license" {{ $product['type'] === 'license' ? 'selected' : '' }}>
                                                License</option>
                                            <option value="physical"
                                                {{ $product['type'] === 'physical' ? 'selected' : '' }}>Physical</option>
                                            <option value="digital" {{ $product['type'] === 'digital' ? 'selected' : '' }}>
                                                Digital</option>
                                            <option value="service" {{ $product['type'] === 'service' ? 'selected' : '' }}>
                                                Service</option>
                                            <option value="others" {{ $product['type'] === 'others' ? 'selected' : '' }}>
                                                Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Price (Rp)</label>
                                        <input type="number" class="form-control" name="price"
                                            value="{{ $product['price'] }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- License Details Section -->
                        <div class="card mb-4" id="license-details-card"
                            style="{{ $product['type'] === 'license' ? 'display: block;' : 'display: none;' }}">
                            <div class="card-header">
                                <h3 class="card-title">License Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">License Type</label>
                                        <select name="license_type" class="form-select">
                                            <option value="">Select License Type</option>
                                            <option value="cover"
                                                {{ $product['license_type'] === 'cover' ? 'selected' : '' }}>Cover</option>
                                            <option value="commercial"
                                                {{ $product['license_type'] === 'commercial' ? 'selected' : '' }}>
                                                Commercial</option>
                                            <option value="royalty"
                                                {{ $product['license_type'] === 'royalty' ? 'selected' : '' }}>Royalty
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Song</label>
                                        <select name="song_id" class="form-select">
                                            <option value="">Select Song</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="song-{{ $i }}"
                                                    {{ $product['song_id'] === 'song-' . $i ? 'selected' : '' }}>Song Title
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Digital Product Details -->
                        <div class="card mb-4" id="digital-details-card"
                            style="{{ $product['type'] === 'digital' || $product['type'] === 'physical' ? 'display: block;' : 'display: none;' }}">
                            <div class="card-header">
                                <h3 class="card-title">Digital/Physical Product Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Current File</label>
                                    <div>
                                        @if ($product['file'])
                                            <span class="badge bg-blue">
                                                <i class="ti ti-file me-1"></i> {{ $product['file'] }}
                                            </span>
                                        @else
                                            <span class="text-muted">No file uploaded</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Replace File</label>
                                    <input type="file" class="form-control" name="file">
                                    <small class="form-hint">Upload new file to replace the current one</small>
                                </div>
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div class="card mb-4" id="service-details-card"
                            style="{{ $product['type'] === 'service' ? 'display: block;' : 'display: none;' }}">
                            <div class="card-header">
                                <h3 class="card-title">Service Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Artist</label>
                                        <select name="artist_id" class="form-select">
                                            <option value="">Select Artist</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="artist-{{ $i }}"
                                                    {{ $product['artist_id'] === 'artist-' . $i ? 'selected' : '' }}>Artist
                                                    Name {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Available From</label>
                                        <input type="datetime-local" class="form-control" name="available_start"
                                            value="{{ $product['available_start'] ? \Carbon\Carbon::parse($product['available_start'])->format('Y-m-d\TH:i') : '' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Available Until</label>
                                        <input type="datetime-local" class="form-control" name="available_end"
                                            value="{{ $product['available_end'] ? \Carbon\Carbon::parse($product['available_end'])->format('Y-m-d\TH:i') : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Product Image</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-label">Current Image</div>
                                    <div class="ratio ratio-1x1 mb-3 bg-light rounded">
                                        <img src="{{ $product['picture'] }}" id="current-image"
                                            class="rounded object-fit-cover">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Replace Image</div>
                                    <input type="file" class="form-control" name="picture" id="image-input">
                                    <small class="form-hint">Upload new image to replace the current one</small>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-title">Actions</h3>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="active" checked>
                                        <span class="form-check-label">Active</span>
                                    </label>
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-2"></i>Update Product
                                    </button>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-link ms-auto">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productTypeSelect = document.getElementById('product-type');
            const licenseDetailsCard = document.getElementById('license-details-card');
            const digitalDetailsCard = document.getElementById('digital-details-card');
            const serviceDetailsCard = document.getElementById('service-details-card');

            // Show/hide appropriate detail cards based on product type
            productTypeSelect.addEventListener('change', function() {
                const selectedType = this.value;

                // Hide all detail cards first
                licenseDetailsCard.style.display = 'none';
                digitalDetailsCard.style.display = 'none';
                serviceDetailsCard.style.display = 'none';

                // Show appropriate card based on selection
                if (selectedType === 'license') {
                    licenseDetailsCard.style.display = 'block';
                } else if (selectedType === 'digital' || selectedType === 'physical') {
                    digitalDetailsCard.style.display = 'block';
                } else if (selectedType === 'service') {
                    serviceDetailsCard.style.display = 'block';
                }
            });

            // Image preview functionality
            const imageInput = document.getElementById('image-input');
            const currentImage = document.getElementById('current-image');

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        currentImage.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
