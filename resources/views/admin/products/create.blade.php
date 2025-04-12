@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Add New Product
                    </h2>
                    <div class="text-muted mt-1">Create a new licensed product</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
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
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Product Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Product Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter product name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Product Number</label>
                                    <input type="text" class="form-control" name="number" placeholder="e.g. MSC-123-4567" required>
                                    <small class="form-hint">Unique product code (e.g. MSC-123-4567)</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="5" placeholder="Enter product description"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Product Type</label>
                                        <select name="type" id="product-type" class="form-select" required>
                                            <option value="">Select Type</option>
                                            <option value="license">License</option>
                                            <option value="physical">Physical</option>
                                            <option value="digital">Digital</option>
                                            <option value="service">Service</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Price (Rp)</label>
                                        <input type="number" class="form-control" name="price" placeholder="Enter price" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- License Details Section - Shown only when type is license -->
                        <div class="card mb-4" id="license-details-card" style="display: none;">
                            <div class="card-header">
                                <h3 class="card-title">License Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">License Type</label>
                                        <select name="license_type" class="form-select">
                                            <option value="">Select License Type</option>
                                            <option value="full">Full</option>
                                            <option value="commercial">Commercial</option>
                                            <option value="royalty">Royalty</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Song</label>
                                        <select name="song_id" class="form-select">
                                            <option value="">Select Song</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="song-{{ $i }}">Song Title {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Digital Product Details - Shown only when type is digital or physical -->
                        <div class="card mb-4" id="digital-details-card" style="display: none;">
                            <div class="card-header">
                                <h3 class="card-title">Digital/Physical Product Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Product File</label>
                                    <input type="file" class="form-control" name="file">
                                    <small class="form-hint">Upload digital product file or physical product image</small>
                                </div>
                            </div>
                        </div>

                        <!-- Service Details - Shown only when type is service -->
                        <div class="card mb-4" id="service-details-card" style="display: none;">
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
                                                <option value="artist-{{ $i }}">Artist Name {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Available From</label>
                                        <input type="datetime-local" class="form-control" name="available_start">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Available Until</label>
                                        <input type="datetime-local" class="form-control" name="available_end">
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
                                    <div class="form-label">Upload Product Image</div>
                                    <input type="file" class="form-control" name="picture">
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Preview</div>
                                    <div class="ratio ratio-1x1 mb-3 bg-light rounded">
                                        <img src="https://via.placeholder.com/400x400?text=Product+Image" id="image-preview" class="rounded object-fit-cover">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-title">Actions</h3>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="publish" checked>
                                        <span class="form-check-label">Publish immediately</span>
                                    </label>
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-2"></i>Save Product
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
            const imageInput = document.querySelector('input[name="picture"]');
            const imagePreview = document.getElementById('image-preview');

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
