@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Payment</div>
                        <h2 class="page-title">Checkout</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ route('user.cart') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left me-2"></i>Back to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <!-- Order Summary -->
                    <div class="col-lg-4 order-lg-2">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Order Summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush my-n2">
                                    @php
                                        $items = [
                                            [
                                                'name' => 'Premium Subscription',
                                                'price' => 34000,
                                                'image' => 'https://picsum.photos/40/40?random=1',
                                            ],
                                            [
                                                'name' => 'Album Download',
                                                'price' => 344000,
                                                'image' => 'https://picsum.photos/40/40?random=2',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($items as $item)
                                        <div class="list-group-item py-3 px-0">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="avatar"
                                                        style="background-image: url({{ $item['image'] }})"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-body">{{ $item['name'] }}</div>
                                                    <div class="text-muted">Rp.
                                                        {{ number_format($item['price'], 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="hr-text">Summary</div>

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
                                <button type="submit" form="payment-form" class="btn btn-primary w-100">
                                    <i class="ti ti-check me-2"></i>Complete Payment
                                </button>
                            </div>
                        </div>

                        <div class="card">
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

                    <!-- Payment Form -->
                    <div class="col-lg-8 order-lg-1">
                        <form id="payment-form" class="card">
                            <div class="card-header">
                                <h3 class="card-title">Payment Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h4 class="mb-3">Payment Method</h4>
                                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="payment-method" value="credit-card"
                                                class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3 bg-transparent"><i
                                                            class="ti ti-credit-card text-primary"
                                                            style="font-size: 1.5rem;"></i></span>
                                                    <div>
                                                        <div class="font-weight-medium">Credit Card</div>
                                                        <div class="text-muted">Visa, Mastercard, American Express</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="payment-method" value="paypal"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3 bg-transparent"><i
                                                            class="ti ti-brand-paypal text-primary"
                                                            style="font-size: 1.5rem;"></i></span>
                                                    <div>
                                                        <div class="font-weight-medium">PayPal</div>
                                                        <div class="text-muted">Pay with your PayPal account</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="payment-method" value="bank-transfer"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3 bg-transparent"><i
                                                            class="ti ti-building-bank text-primary"
                                                            style="font-size: 1.5rem;"></i></span>
                                                    <div>
                                                        <div class="font-weight-medium">Bank Transfer</div>
                                                        <div class="text-muted">Direct bank transfer</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="mb-3">Card Information</h4>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Card Number</label>
                                            <div class="input-group input-group-flat">
                                                <input type="text" class="form-control"
                                                    placeholder="XXXX XXXX XXXX XXXX">
                                                <span class="input-group-text">
                                                    <div class="d-flex gap-2">
                                                        <i class="ti ti-brand-visa text-primary"></i>
                                                        <i class="ti ti-brand-mastercard text-primary"></i>
                                                        <i class="ti ti-brand-amex text-primary"></i>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Expiration Date</label>
                                            <input type="text" class="form-control" placeholder="MM/YY">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">CVV</label>
                                            <input type="text" class="form-control" placeholder="123">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Cardholder Name</label>
                                            <input type="text" class="form-control" placeholder="Name on card">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="mb-3">Billing Address</h4>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" placeholder="1234 Main St">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Address 2 <span
                                                    class="text-muted">(Optional)</span></label>
                                            <input type="text" class="form-control" placeholder="Apartment or suite">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">Country</label>
                                            <select class="form-select">
                                                <option value="">Choose...</option>
                                                <option selected>Indonesia</option>
                                                <option>United States</option>
                                                <option>Singapore</option>
                                                <option>Malaysia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" placeholder="City">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" placeholder="Postal Code">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="save-info">
                                    <label class="form-check-label" for="save-info">
                                        Save this information for next time
                                    </label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="terms">
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#">Terms and Conditions</a> and <a
                                            href="#">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Example validation script
            const form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Show processing message
                Swal.fire({
                    title: 'Processing Payment',
                    text: 'Please wait while we process your payment...',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Simulate payment processing
                setTimeout(() => {
                    Swal.fire({
                        title: 'Payment Successful!',
                        text: 'Your order has been processed successfully.',
                        icon: 'success',
                        confirmButtonText: 'View My Purchases'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('profile.purchased') }}";
                        }
                    });
                }, 2000);
            });
        });
    </script>
@endsection
