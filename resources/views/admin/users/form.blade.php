@extends('layouts.app')

@section('content')
    @include('layouts.includes.admin.navbar');

    <div class="container py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">{{ $mode }} User </h2>
                {{-- <p class="text-muted mb-0">list view</p> --}}
            </div>
            <div>
                <a href="{{ url('/admin/user') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-12">

                <ul class="nav nav-tabs " id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-information-tab" data-bs-toggle="pill"
                            href="#pills-information" role="tab" aria-controls="pills-information" aria-selected="true">
                            Information
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                            role="tab" aria-controls="pills-profile" aria-selected="false">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-document-tab" data-bs-toggle="pill" href="#pills-document"
                            role="tab" aria-controls="pills-document" aria-selected="false">
                            Document
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-bank-tab" data-bs-toggle="pill" href="#pills-bank" role="tab"
                            aria-controls="pills-bank" aria-selected="false">
                            Bank
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        @if (session('status'))
            <div class="row g-4 mb-4">
                <div class="col-md-12">

                    <div class="alert alert-success mb-4">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                            <div>
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="row g-4 mb-4">
                <div class="col-md-12">

                    <div class="alert alert-success mb-4">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                            <div>
                                {{ session('error') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif


        <!-- Tab Content -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-information" role="tabpanel"
                aria-labelledby="pills-information-tab">

                @php
                    $route = route('admin.user.store');
                    if ($mode == 'Edit') {
                        $route = route('admin.users.update', ['id' => $user->id]);
                    }

                @endphp
                <form method="POST" action="{{ $route }}">
                    @csrf
                    @if ($mode == 'Edit')
                        @method('PUT')
                    @endif

                    <div class="row g-4">

                        <div class="col-md-12">


                            <div class="card mb-4 card-no-hover">

                                <div class="card-body p-4">

                                    <div class="row g-3">

                                        <div class="col-md-4">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">FullName</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="input full name"
                                                    value="{{ old('name', $user->name ?? '') }}" required>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                        </div>

                                        <div class="col-md-4">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Username</label>
                                                <input type="text" name="username"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    placeholder="input username"
                                                    value="{{ old('username', $user->username ?? '') }}" required>
                                                @error('username')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-4">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Email</label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="input email"
                                                    value="{{ old('email', $user->email ?? '') }}" required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="position-relative">
                                                    <input type="password" name="password" id="password"
                                                        placeholder="input password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        value="{{ old('password') }}" >
                                                    <span class="password-toggle"><i class="far fa-eye"></i></span>
                                                </div>
                                                @error('password')
                                                    <small class="text-danger mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>


                                        </div>
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password Confirmation</label>
                                                <div class="position-relative">
                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation"
                                                        placeholder="input password confirmation"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        value="{{ old('password_confirmation') }}" >
                                                    <span class="password-toggle"><i class="far fa-eye"></i></span>
                                                </div>
                                                @error('password_confirmation')
                                                    <small class="text-danger mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="card mb-4 card-no-hover">

                                <div class="card-body p-4">

                                    <div class="row g-3">
                                        <div class="col-md-12">

                                            <div class="mb-3">

                                                <label class="form-label fw-bold">Phone Number</label>
                                                <input type="number" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    placeholder="input phone format. 085999888"
                                                    value="{{ old('phone', isset($user->phone) ? preg_replace('/^62/', '0', $user->phone) : '') }}">
                                                @error('phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>

                                    <div class="row g-3">

                                        <div class="col-md-4">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Country</label>
                                                <input type="text" name="country"
                                                    class="form-control @error('country') is-invalid @enderror"
                                                    placeholder="input country" value="Indonesia" readonly required>
                                                @error('country')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Region</label>
                                                <select
                                                    class="form-control @error('region') is-invalid @enderror selectpicker "
                                                    name="region" id="region" data-live-search="true"
                                                    data-size="5">
                                                    <option>Select Region</option>
                                                </select>
                                                @error('region')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">City</label>
                                                <select
                                                    class="form-control @error('city') is-invalid @enderror selectpicker "
                                                    name="city" id="city" data-live-search="true"
                                                    data-size="5">
                                                    <option>Select City</option>
                                                </select>
                                                @error('city')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card mb-4 card-no-hover">

                                <div class="card-body p-4">

                                    <div class="row g-3">
                                        <div class="col-md-12">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Role</label>
                                                <select
                                                    class="form-control @error('role') is-invalid @enderror selectpicker"
                                                    name="role" id="role" data-live-search="true"
                                                    data-size="5">
                                                    <option value="">Select Role</option> <!-- Default option -->

                                                    @php
                                                        $roleName = $mode == 'Edit' ? $user->getRoleNames()->first() : 'User';
                                                    @endphp

                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ $role->name == $roleName ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-no-hover">
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" name="save_information"
                                                value="save_information"> Save Information</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card p-3">
                    <h5>Profile</h5>
                    <p>Manage your profile details here.</p>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-document" role="tabpanel" aria-labelledby="pills-document-tab">
                <div class="card p-3">
                    <h5>Document</h5>
                    <p>Upload and manage documents here.</p>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-bank" role="tabpanel" aria-labelledby="pills-bank-tab">
                <div class="card p-3">
                    <h5>Bank</h5>
                    <p>Bank account details and transactions.</p>
                </div>
            </div>
        </div>





    </div>

    <div class="container w-100 " style="height: 100px;"></div>

    @include('layouts.includes.footer');
@endsection
@push('styles')
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <style>
        .bootstrap-select>.dropdown-toggle {
            height: 48.4px;
        }

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
@push('scripts')
    <!-- Include jQuery & Bootstrap Select -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>


    <script>
        $(document).ready(function() {
            let selectedRegion = @json(old('region', $user->region ?? ''));
            let selectedCity = @json(old('city', $user->city ?? ''));

            $.getJSON("/admin/data/regions", function(data) {
                let provinceSelect = $("#region");
                provinceSelect.empty().append('<option value="">Select Region</option>');

                data.forEach(region => {
                    let option = new Option(region.provinsi, region.provinsi);
                    if (region.provinsi === selectedRegion) {
                        option.selected = true;
                    }
                    provinceSelect.append(option);
                });

                // Refresh Bootstrap Select UI
                $('.selectpicker').selectpicker('refresh');

                // Store regions globally (fix for create mode)
                window.regions = data;

                // If edit mode OR validation error, populate cities
                if (selectedRegion) {
                    populateCities(selectedRegion, selectedCity);
                }
            });

            // Event listener for region change (works in both modes)
            $("#region").on("change", function() {
                let selectedProvince = $(this).val();
                populateCities(selectedProvince);
            });

            function populateCities(selectedProvince, selectedCity = '') {
                let citySelect = $("#city");
                citySelect.empty().append(new Option("Select City", ""));

                // Fix: Ensure `regions` is available
                let cities = window.regions?.find(region => region.provinsi === selectedProvince)?.kota || [];

                cities.forEach(city => {
                    let option = new Option(city, city);
                    if (city === selectedCity) {
                        option.selected = true;
                    }
                    citySelect.append(option);
                });

                // Refresh Bootstrap Select UI
                $('.selectpicker').selectpicker('refresh');
            }
        });
    </script>
@endpush
