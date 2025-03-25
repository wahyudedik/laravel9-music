@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">My Assets</div>
                    <h2 class="page-title">Purchased Songs</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('profile.my-assets') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>Back to Assets
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- Filter and Search -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-5">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Search purchased songs...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option value="recent">Recently Purchased</option>
                                <option value="oldest">Oldest First</option>
                                <option value="price-high">Price: High to Low</option>
                                <option value="price-low">Price: Low to High</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select">
                                <option value="all">All Licenses</option>
                                <option value="cover">Cover License</option>
                                <option value="standard">Standard License</option>
                                <option value="premium">Premium License</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary w-100">
                                <i class="ti ti-filter me-1"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchased Songs Grid -->
            <div class="row row-cards">
                @for($i = 1; $i <= 12; $i++)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-sm">
                            <a href="#" class="d-block">
                                <img src="https://picsum.photos/400/200?random={{ $i + 100 }}" class="card-img-top" alt="Song Cover">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="font-weight-medium">Purchased Song {{ $i }}</div>
                                        <div class="text-muted">Artist Name {{ $i }}</div>
                                    </div>
                                    <div class="ms-auto">
                                        <span class="badge bg-green-lt">
                                            <i class="ti ti-check me-1"></i>Licensed
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="ti ti-player-play me-1"></i>Play
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary ms-auto">
                                        <i class="ti ti-download me-1"></i>Download
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <i class="ti ti-calendar me-1"></i>Purchased: {{ now()->subDays(rand(1, 60))->format('M d, Y') }}
                                    </div>
                                    <div class="ms-auto">
                                        <i class="ti ti-license me-1"></i>Cover License
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Pagination -->
            <div class="d-flex mt-4">
                <ul class="pagination ms-auto">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="ti ti-chevron-left"></i>
                            prev
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
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
