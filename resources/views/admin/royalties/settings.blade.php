@extends('layouts.app-admin')

@section('title', 'Royalty Settings')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Royalty Settings
                    </h2>
                    <div class="text-muted mt-1">Configure royalty calculation parameters</div>
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
            <div class="row row-cards">
                <div class="col-lg-8">
                    <form class="card">
                        <div class="card-header">
                            <h3 class="card-title">Royalty Rate Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Royalty Calculation Method</label>
                                <select class="form-select">
                                    <option value="per_stream">Per Stream</option>
                                    <option value="percentage">Percentage of Revenue</option>
                                    <option value="hybrid">Hybrid Model</option>
                                </select>
                                <div class="form-hint">
                                    Select how royalties will be calculated for content creators
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Default Currency</label>
                                <select class="form-select">
                                    <option value="IDR" selected>Indonesian Rupiah (IDR)</option>
                                    <option value="USD">US Dollar (USD)</option>
                                    <option value="EUR">Euro (EUR)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Payment Schedule</label>
                                <select class="form-select">
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly" selected>Quarterly</option>
                                    <option value="biannually">Bi-annually</option>
                                    <option value="annually">Annually</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Minimum Payout Threshold</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" value="100000">
                                </div>
                                <div class="form-hint">
                                    Minimum amount required before a payment is processed
                                </div>
                            </div>

                            <div class="hr-text">Rate Distribution</div>

                            <div class="row mb-3">
                                <label class="form-label">Artist Royalty Rate (per stream)</label>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" value="10">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Composer Royalty Rate (per stream)</label>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" value="8">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Cover Creator Royalty Rate (per stream)</label>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" value="5">
                                    </div>
                                </div>
                            </div>

                            <div class="hr-text">Revenue Share Percentages</div>

                            <div class="row mb-3">
                                <label class="form-label">Artist Revenue Share</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="50">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Composer Revenue Share</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="30">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Cover Creator Revenue Share</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="20">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-text">Platform-specific Rates</div>

                            <div class="row mb-3">
                                <label class="form-label">Spotify Rate Multiplier</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="1.2" step="0.1">
                                        <span class="input-group-text">x</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Apple Music Rate Multiplier</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="1.1" step="0.1">
                                        <span class="input-group-text">x</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">YouTube Music Rate Multiplier</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="0.8" step="0.1">
                                        <span class="input-group-text">x</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Other Platforms Rate Multiplier</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="0.7" step="0.1">
                                        <span class="input-group-text">x</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payment Methods</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="payment_methods[]" value="bank_transfer"
                                                class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3"
                                                        style="background-image: url(https://cdn-icons-png.flaticon.com/512/2168/2168742.png)"></span>
                                                    <div>
                                                        <div class="font-weight-medium">Bank Transfer</div>
                                                        <div class="text-muted">Direct bank transfers</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="payment_methods[]" value="paypal"
                                                class="form-selectgroup-input" checked>
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3"
                                                        style="background-image: url(https://cdn-icons-png.flaticon.com/512/174/174861.png)"></span>
                                                    <div>
                                                        <div class="font-weight-medium">PayPal</div>
                                                        <div class="text-muted">International payments</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="payment_methods[]" value="ewallet"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3"
                                                        style="background-image: url(https://cdn-icons-png.flaticon.com/512/4518/4518219.png)"></span>
                                                    <div>
                                                        <div class="font-weight-medium">E-Wallet</div>
                                                        <div class="text-muted">Digital wallet payments</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="payment_methods[]" value="crypto"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3"
                                                        style="background-image: url(https://cdn-icons-png.flaticon.com/512/5968/5968260.png)"></span>
                                                    <div>
                                                        <div class="font-weight-medium">Cryptocurrency</div>
                                                        <div class="text-muted">Bitcoin, Ethereum, etc.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Update Methods</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tax Settings</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Default Tax Rate</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" value="10">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <span class="form-check-label">Withhold taxes automatically</span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                            <span class="form-check-label">Require tax forms before payment</span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <span class="form-check-label">Generate tax reports automatically</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Save Tax Settings</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
