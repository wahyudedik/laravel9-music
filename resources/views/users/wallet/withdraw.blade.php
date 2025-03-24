@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Finance</div>
                    <h2 class="page-title">Withdraw Funds</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('user.wallet') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-wallet me-2"></i>Back to Wallet
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form class="card">
                        <div class="card-header">
                            <h3 class="card-title">Withdrawal Request</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-label">Available Balance</div>
                                <div class="display-6 fw-bold mb-3">Rp 2,450,000</div>
                                <div class="text-muted small">Minimum withdrawal amount: Rp 100,000</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required">Withdrawal Amount</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control" placeholder="Enter amount" value="500000">
                                </div>
                                <div class="text-muted small">Fee: 0.5% (Rp 2,500)</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required">Withdrawal Method</label>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="withdrawal-method" value="bank" class="form-selectgroup-input" checked>
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <span class="avatar me-3" style="background-image: url(https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png)"></span>
                                                <div>
                                                    <div class="font-weight-medium">Bank Transfer (BNI)</div>
                                                    <div class="text-muted small">Account ending in 5678</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="withdrawal-method" value="ewallet" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div class="form-selectgroup-label-content d-flex align-items-center">
                                                <span class="avatar me-3" style="background-image: url(https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/2560px-Logo_dana_blue.svg.png)"></span>
                                                <div>
                                                    <div class="font-weight-medium">E-Wallet (DANA)</div>
                                                    <div class="text-muted small">Account: 081234567890</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Add New Payment Method</label>
                                <div>
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="ti ti-plus me-2"></i>Add Payment Method
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Notes (Optional)</label>
                                <textarea class="form-control" rows="3" placeholder="Additional information"></textarea>
                            </div>
                            
                            <div class="alert alert-info" role="alert">
                                <div class="d-flex">
                                    <div>
                                        <i class="ti ti-info-circle me-2"></i>
                                    </div>
                                    <div>
                                        <h4 class="alert-title">Withdrawal Information</h4>
                                        <div class="text-muted">Withdrawal requests are processed within 1-3 business days. A 0.5% fee applies to all withdrawals.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Submit Withdrawal Request</button>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Withdrawal Summary</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <div class="d-flex justify-content-between mb-1">
                                    <div>Withdrawal Amount</div>
                                    <div>Rp 500,000</div>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <div>Processing Fee (0.5%)</div>
                                    <div>Rp 2,500</div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <div>Total Amount</div>
                                    <div>Rp 497,500</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Recent Withdrawals</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar bg-red-lt">
                                                <i class="ti ti-cash-banknote text-red"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <div class="font-weight-medium">Withdrawal</div>
                                                    <div class="text-muted">{{ now()->subDays($i * 7)->format('M d, Y') }}</div>
                                                </div>
                                                <div class="text-red">
                                                    -Rp {{ number_format(($i + 1) * 100000, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <span class="badge bg-{{ $i == 0 ? 'warning' : 'success' }}">
                                                    {{ $i == 0 ? 'Processing' : 'Completed' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('user.wallet.withdraw.history') }}" class="btn btn-link">View All Withdrawals</a>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Need Help?</h3>
                        </div>
                        <div class="card-body">
                            <p>If you have any questions about withdrawals, please check our FAQ or contact support.</p>
                            <div class="d-flex mt-3">
                                <a href="#" class="btn btn-outline-primary me-2">
                                    <i class="ti ti-help me-2"></i>FAQ
                                </a>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="ti ti-messages me-2"></i>Contact Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection