@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Song Details
                    </h2>
                    <div class="text-muted mt-1">View complete song information</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.songs.edit', $id) }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-edit me-2"></i>
                            Edit Song
                        </a>
                        <a href="{{ route('admin.songs.index') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to Songs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="https://picsum.photos/300/300?random=1" class="rounded" width="200"
                                    height="200" alt="Cover Image">
                                <h2 class="mt-3 mb-0">Blinding Lights</h2>
                                <p class="text-muted">The Weeknd</p>
                                <div class="mt-3">
                                    <span class="badge bg-success">Active</span>
                                    <span class="badge bg-blue ms-2">Premium</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <audio controls class="w-100 mb-3">
                                    <source src="#" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-outline-primary me-2">
                                        <i class="ti ti-download me-2"></i>Download
                                    </button>
                                    <button class="btn btn-outline-danger">
                                        <i class="ti ti-share me-2"></i>Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Song Statistics</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <span class="avatar rounded bg-blue-lt">
                                        <i class="ti ti-eye text-blue"></i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-muted">Total Plays</div>
                                    <div class="h3 m-0">1,245,678</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <span class="avatar rounded bg-green-lt">
                                        <i class="ti ti-download text-green"></i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-muted">Downloads</div>
                                    <div class="h3 m-0">45,892</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <span class="avatar rounded bg-purple-lt">
                                        <i class="ti ti-license text-purple"></i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-muted">Licenses Sold</div>
                                    <div class="h3 m-0">328</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="avatar rounded bg-red-lt">
                                        <i class="ti ti-heart text-red"></i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-muted">Favorites</div>
                                    <div class="h3 m-0">87,345</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Song Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Song ID</div>
                                    <div class="datagrid-content">{{ $id }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Title</div>
                                    <div class="datagrid-content">Blinding Lights</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Artist</div>
                                    <div class="datagrid-content">The Weeknd</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Album</div>
                                    <div class="datagrid-content">After Hours</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Genre</div>
                                    <div class="datagrid-content">Pop</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Release Date</div>
                                    <div class="datagrid-content">November 29, 2020</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Duration</div>
                                    <div class="datagrid-content">3:20</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">License Type</div>
                                    <div class="datagrid-content">Premium</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">License Price</div>
                                    <div class="datagrid-content">Rp. 150,000</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Allow Covers</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-success">Yes</span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Allow Commercial Use</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-success">Yes</span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created At</div>
                                    <div class="datagrid-content">January 15, 2023</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Last Updated</div>
                                    <div class="datagrid-content">March 22, 2023</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Composers & Credits</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h4 class="mb-2">Composers</h4>
                                <div class="avatar-list avatar-list-stacked">
                                    <span class="avatar avatar-md rounded"
                                        style="background-image: url(https://ui-avatars.com/api/?name=John+Doe&background=e53935&color=fff)"
                                        data-bs-toggle="tooltip" title="John Doe"></span>
                                    <span class="avatar avatar-md rounded"
                                        style="background-image: url(https://ui-avatars.com/api/?name=Jane+Smith&background=e53935&color=fff)"
                                        data-bs-toggle="tooltip" title="Jane Smith"></span>
                                    <span class="avatar avatar-md rounded"
                                        style="background-image: url(https://ui-avatars.com/api/?name=The+Weeknd&background=e53935&color=fff)"
                                        data-bs-toggle="tooltip" title="The Weeknd"></span>
                                </div>
                            </div>
                            <div>
                                <h4 class="mb-2">Production Credits</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-1">
                                        <strong>Producer:</strong> Max Martin, Oscar Holter
                                    </li>
                                    <li class="mb-1">
                                        <strong>Mixing Engineer:</strong> Serban Ghenea
                                    </li>
                                    <li class="mb-1">
                                        <strong>Mastering Engineer:</strong> Dave Kutch
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Description</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                Blinding Lights is a song by Canadian singer the Weeknd. It was released on November 29,
                                2019, as the second single from his fourth studio album After Hours. The Weeknd wrote and
                                produced the song with Max Martin and Oscar Holter, with Belly and Jason Quenneville
                                receiving additional writing credits.
                            </p>
                            <p>
                                The song set the record for most weeks in the top five and top ten of the US Billboard Hot
                                100. It also holds the record for the longest charting song on the Hot 100 of all time,
                                spending 90 weeks on the chart.
                            </p>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Cover Versions</h3>
                            <a href="#" class="btn btn-sm btn-primary">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Cover Artist</th>
                                        <th>Released</th>
                                        <th>Plays</th>
                                        <th>Status</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://ui-avatars.com/api/?name=Alex+Johnson&background=e53935&color=fff)"></span>
                                                <div>Alex Johnson</div>
                                            </div>
                                        </td>
                                        <td>Jan 15, 2023</td>
                                        <td>24,567</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-ghost-secondary">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://ui-avatars.com/api/?name=Sarah+Williams&background=e53935&color=fff)"></span>
                                                <div>Sarah Williams</div>
                                            </div>
                                        </td>
                                        <td>Feb 28, 2023</td>
                                        <td>18,932</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-ghost-secondary">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url(https://ui-avatars.com/api/?name=Mike+Thompson&background=e53935&color=fff)"></span>
                                                <div>Mike Thompson</div>
                                            </div>
                                        </td>
                                        <td>Mar 10, 2023</td>
                                        <td>12,345</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-ghost-secondary">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        });
    </script>
@endsection
