@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Shopping</div>
                        <h2 class="page-title">Your Cart</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ url('/') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                                <i class="ti ti-music me-2"></i>Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cart Items (2)</h3>
                            </div>
                            <div class="list-group list-group-flush">
                                @php
                                    $cartItems = [
                                        [
                                            'id' => 1,
                                            'name' => 'Premium Subscription',
                                            'price' => 34000,
                                            'image' => 'https://picsum.photos/80/80?random=1',
                                            'type' => 'subscription',
                                            'description' => 'Monthly premium access to all features',
                                        ],
                                        [
                                            'id' => 2,
                                            'name' => 'Album Download',
                                            'price' => 344000,
                                            'image' => 'https://picsum.photos/80/80?random=2',
                                            'type' => 'album',
                                            'description' => 'Full album download with high quality audio',
                                        ],
                                    ];
                                @endphp

                                @foreach ($cartItems as $item)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <img src="{{ $item['image'] }}" class="rounded" width="80"
                                                    height="80" alt="{{ $item['name'] }}">
                                            </div>
                                            <div class="col">
                                                <h4 class="mb-1">{{ $item['name'] }}</h4>
                                                <div class="text-muted mb-2">{{ $item['description'] }}</div>
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="badge bg-primary-lt me-2">{{ ucfirst($item['type']) }}</div>
                                                    <div class="text-muted">Rp.
                                                        {{ number_format($item['price'], 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="btn-list">
                                                    <button class="btn btn-icon btn-sm btn-ghost-danger"
                                                        data-bs-toggle="tooltip" title="Remove">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <div class="d-flex align-items-center">
                                    <div class="input-group" style="max-width: 200px;">
                                        <input type="text" class="form-control" placeholder="Promo code">
                                        <button class="btn btn-outline-secondary" type="button">Apply</button>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-outline-danger">
                                            <i class="ti ti-trash me-2"></i>Clear Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">You Might Also Like</h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="col-md-4">
                                            <div class="card card-sm">
                                                <a href="#" class="d-block">
                                                    <img src="https://picsum.photos/300/150?random={{ $i + 10 }}"
                                                        class="card-img-top" alt="Recommended item">
                                                </a>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div class="font-weight-medium">Recommended Album
                                                                {{ $i }}</div>
                                                            <div class="text-muted">Rp.
                                                                {{ number_format(rand(50000, 150000), 2, ',', '.') }}</div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <button class="btn btn-icon btn-sm btn-primary"
                                                                data-bs-toggle="tooltip" title="Add to cart">
                                                                <i class="ti ti-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal</span>
                                    <strong>Rp. 378.000,00</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Tax (10%)</span>
                                    <strong>Rp. 37.800,00</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Discount</span>
                                    <strong class="text-green">- Rp. 15.000,00</strong>
                                </div>
                                <div class="hr-text">Total</div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="h3">Total</span>
                                    <span class="h3">Rp. 400.800,00</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <span>Total: <strong>Rp. 400.800,00</strong></span>
                                    <a href="{{ route('user.checkout') }}" class="btn btn-primary">Checkout</a>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h3 class="card-title">Payment Methods</h3>
                                <div class="d-flex gap-2 my-3">
                                    <span class="payment-icon"><i class="ti ti-brand-visa fs-2 text-primary"></i></span>
                                    <span class="payment-icon"><i
                                            class="ti ti-brand-mastercard fs-2 text-primary"></i></span>
                                    <span class="payment-icon"><i class="ti ti-brand-paypal fs-2 text-primary"></i></span>
                                    <span class="payment-icon"><i
                                            class="ti ti-building-bank fs-2 text-primary"></i></span>
                                </div>
                                <div class="text-muted">
                                    We accept various payment methods for your convenience. All transactions are secure and
                                    encrypted.
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h3 class="card-title">Need Help?</h3>
                                <div class="text-muted mb-3">
                                    If you have any questions about your order, please contact our support team.
                                </div>
                                <a href="{{ route('user.chat') }}" class="btn btn-outline-primary w-100">
                                    <i class="ti ti-messages me-2"></i>Contact Support
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
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Example of remove item functionality
            const removeButtons = document.querySelectorAll('.btn-ghost-danger');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const listItem = this.closest('.list-group-item');

                    Swal.fire({
                        title: 'Remove Item?',
                        text: "Are you sure you want to remove this item from your cart?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, remove it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Animate removal
                            listItem.style.transition = 'all 0.3s ease';
                            listItem.style.opacity = '0';
                            listItem.style.height = '0';

                            setTimeout(() => {
                                listItem.remove();

                                // Show success message
                                Swal.fire(
                                    'Removed!',
                                    'The item has been removed from your cart.',
                                    'success'
                                );
                            }, 300);
                        }
                    });
                });
            });
        });
    </script>
@endsection
