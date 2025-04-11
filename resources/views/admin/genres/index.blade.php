@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Genre Management
                    </h2>
                    <div class="text-muted mt-1">Manage music genres in the system</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" id="addGenreBtn" class="btn btn-primary d-none d-sm-inline-block"
                            data-bs-toggle="modal" data-bs-target="#addGenreModal">
                            <i class="ti ti-plus me-2"></i>
                            Add New Genre
                        </button>
                        <button type="button" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#addGenreModal">
                            <i class="ti ti-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Genres</h3>
                            <div class="d-flex">
                                <form action="{{ route('admin.genres.index') }}" method="GET" class="d-flex">
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-search"></i>
                                        </span>
                                        <input type="text" id="genre-search" name="search" class="form-control"
                                            placeholder="Search genres..." value="{{ request('search') }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Genre</th>
                                        <th>Description</th>
                                        <th>Songs</th>
                                        <th>Albums</th>
                                        <th>Status</th>
                                        <th class="w-1">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // $genresx = [
                                        //     [
                                        //         'name' => 'Pop',
                                        //         'description' => 'Contemporary popular music',
                                        //         'songs' => 245,
                                        //         'albums' => 32,
                                        //         'status' => 'Active',
                                        //         'color' => 'blue',
                                        //     ],
                                        //     [
                                        //         'name' => 'Hip Hop',
                                        //         'description' => 'Music consisting of stylized rhythmic music',
                                        //         'songs' => 187,
                                        //         'albums' => 24,
                                        //         'status' => 'Active',
                                        //         'color' => 'purple',
                                        //     ],
                                        //     [
                                        //         'name' => 'Rock',
                                        //         'description' => 'Music centered on the electric guitar',
                                        //         'songs' => 156,
                                        //         'albums' => 18,
                                        //         'status' => 'Active',
                                        //         'color' => 'red',
                                        //     ],
                                        //     [
                                        //         'name' => 'R&B',
                                        //         'description' => 'Rhythm and blues music',
                                        //         'songs' => 132,
                                        //         'albums' => 15,
                                        //         'status' => 'Active',
                                        //         'color' => 'orange',
                                        //     ],
                                        //     [
                                        //         'name' => 'Electronic',
                                        //         'description' => 'Music that employs electronic instruments',
                                        //         'songs' => 118,
                                        //         'albums' => 14,
                                        //         'status' => 'Active',
                                        //         'color' => 'cyan',
                                        //     ],
                                        //     [
                                        //         'name' => 'Jazz',
                                        //         'description' => 'Music characterized by improvisation and swing',
                                        //         'songs' => 87,
                                        //         'albums' => 12,
                                        //         'status' => 'Active',
                                        //         'color' => 'yellow',
                                        //     ],
                                        //     [
                                        //         'name' => 'Classical',
                                        //         'description' => 'Art music produced in the Western tradition',
                                        //         'songs' => 76,
                                        //         'albums' => 9,
                                        //         'status' => 'Active',
                                        //         'color' => 'lime',
                                        //     ],
                                        //     [
                                        //         'name' => 'Country',
                                        //         'description' => 'Music originating in the rural Southern US',
                                        //         'songs' => 65,
                                        //         'albums' => 8,
                                        //         'status' => 'Active',
                                        //         'color' => 'green',
                                        //     ],
                                        //     [
                                        //         'name' => 'Folk',
                                        //         'description' => 'Traditional music passed through generations',
                                        //         'songs' => 54,
                                        //         'albums' => 7,
                                        //         'status' => 'Inactive',
                                        //         'color' => 'teal',
                                        //     ],
                                        //     [
                                        //         'name' => 'Reggae',
                                        //         'description' => 'Music originating in Jamaica',
                                        //         'songs' => 43,
                                        //         'albums' => 6,
                                        //         'status' => 'Pending',
                                        //         'color' => 'indigo',
                                        //     ],
                                        // ];
                                    @endphp

                                    @foreach ($genres as $genre)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-sm me-2 bg-{{ $genre->icon_color }}-lt">
                                                        <i class="ti ti-category text-{{ $genre->icon_color }}"></i>
                                                    </span>
                                                    <div>{{ $genre->name }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $genre->description }}</td>
                                            <td>{{ $genre->songs_count }}</td>
                                            <td>{{ $genre->albums_count }}</td>
                                            <td>
                                                @if ($genre->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif($genre->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon btn-ghost-secondary"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">

                                                        <a href="javascript:void(0)" class="dropdown-item"
                                                            onclick="editGenre('{{ $genre->id }}', '{{ $genre->name }}', '{{ $genre->description }}', '{{ $genre->icon_color }}', '{{ $genre->status }}'  )">
                                                            <i class="ti ti-edit me-2"></i>Edit
                                                        </a>

                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-music me-2"></i>View Songs
                                                        </a>
                                                        <div class="dropdown-divider"></div>

                                                        <a href="javascript:void(0)"
                                                            class="dropdown-item text-danger delete-genre"
                                                            onclick="confirmDelete('{{ $genre->id }}')"
                                                            data-id="{{ $genre->id }}">
                                                            <i class="ti ti-trash me-2"></i>Delete
                                                        </a>

                                                        <form id="delete-form-{{ $genre->id }}"
                                                            action="{{ route('admin.genres.destroy', $genre) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">

                            {{ $genres->links() }}

                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Genre Distribution</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="genre-chart" style="height: 300px;"></div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="row">
                                        @php
                                            $totalSongs = $genres->sum('songs_count');
                                        @endphp
                                        @foreach ($genres->take(5) as $genre)
                                            <div class="col-6 mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>{{ $genre->name }}</span>
                                                    <span>{{ $totalSongs > 0 ? round(($genre->songs_count / $totalSongs) * 100) : 0 }}%</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-{{ $genre->icon_color }}"
                                                        role="progressbar"
                                                        style="width: {{ $totalSongs > 0 ? round(($genre->songs_count / $totalSongs) * 100) : 0 }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Genre Modal -->
    <div class="modal modal-blur fade" id="addGenreModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ route('admin.genres.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Genre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Genre Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter genre name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter genre description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Color</label>
                            <div class="row g-2">
                                @foreach (['blue', 'purple', 'red', 'green', 'orange', 'cyan'] as $color)
                                    <div class="col-auto">
                                        <label class="form-colorinput">
                                            <input name="icon_color" type="radio" value="{{ $color }}"
                                                class="form-colorinput-input" {{ $color === 'blue' ? 'checked' : '' }}>
                                            <span class="form-colorinput-color bg-{{ $color }}"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ms-auto" id="saveGenreBtn">
                            <i class="ti ti-plus me-2"></i>Add Genre
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Genre Modals (one for each genre) -->
    <div class="modal modal-blur fade" id="editGenreModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="#" id="edit-genre-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="genre_id" id="edit-genre-id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Genre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Genre Name</label>
                            <input type="text" class="form-control" name="name" id="edit-genre-name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Description</label>
                            <textarea class="form-control" name="description" id="edit-genre-description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Color</label>
                            <div class="row g-2">
                                @foreach (['blue', 'purple', 'red', 'green', 'orange', 'cyan'] as $color)
                                    <div class="col-auto">
                                        <label class="form-colorinput">
                                            <input type="radio" name="icon_color" class="form-colorinput-input"
                                                value="{{ $color }}" id="edit-color-{{ $color }}">
                                            <span class="form-colorinput-color bg-{{ $color }}"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select" name="status" id="edit-genre-status" required>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="ti ti-device-floppy me-2"></i>Update Genre
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var baseUrl = "{{ url('/') }}";

        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('addGenreBtn').addEventListener('click', function(e) {

                setTimeout(() => {
                    document.querySelector('#addGenreModal input[name="name"]').focus();
                }, 300);

            });

            // Add genre functionality
            document.getElementById('saveGenreBtn').addEventListener('click', function(e) {
                e.preventDefault(); // prevent default submit

                // Swal.fire({
                //     title: 'Creating Genre',
                //     text: 'Please wait while we process your request...',
                //     allowOutsideClick: false,
                //     didOpen: () => Swal.showLoading()
                // });

                // Submit form after short delay (for smoother UX)
                setTimeout(() => {
                    this.closest('form').submit();
                }, 500);
            });


            // Initialize genre distribution chart
            @php
                $chartData = [];

                foreach ($genres->take(5) as $genre) {
                    $chartData[] = [
                        'name' => $genre->name,
                        'data' => $genre->songs_count,
                    ];
                }
            @endphp

            const genreData = @json($chartData);

            const options = {
                series: genreData.map(item => item.data),
                chart: {
                    type: 'donut',
                    height: 300
                },
                labels: genreData.map(item => item.name),
                colors: ['#206bc4', '#a855f7', '#d63939', '#f59f00', '#2fb344'],
                legend: {
                    position: 'bottom'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 300
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            const chart = new ApexCharts(document.querySelector("#genre-chart"), options);
            chart.render();
        });

        //edit genre
        function editGenre(id, name, description, icon_color, status) {
            // Set form action to the update route
            document.getElementById('edit-genre-form').action = `${baseUrl}/admin/genres/${id}`;

            // Fill form fields
            document.getElementById('edit-genre-id').value = id;
            document.getElementById('edit-genre-name').value = name;
            document.getElementById('edit-genre-description').value = description;
            document.getElementById('edit-genre-status').value = status;

            // Set the selected icon color
            const colors = ['blue', 'purple', 'red', 'green', 'orange', 'cyan'];
            colors.forEach(color => {
                const radio = document.getElementById(`edit-color-${color}`);
                if (radio) {
                    radio.checked = (color === icon_color);
                }
            });

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('editGenreModal'));
            modal.show();
        }

        // Delete genre functionality
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
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }


    </script>
@endsection
@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
