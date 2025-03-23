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
                        <button type="button" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#addGenreModal">
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
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" id="genre-search" class="form-control"
                                        placeholder="Search genres...">
                                </div>
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
                                        $genres = [
                                            [
                                                'name' => 'Pop',
                                                'description' => 'Contemporary popular music',
                                                'songs' => 245,
                                                'albums' => 32,
                                                'status' => 'Active',
                                                'color' => 'blue',
                                            ],
                                            [
                                                'name' => 'Hip Hop',
                                                'description' => 'Music consisting of stylized rhythmic music',
                                                'songs' => 187,
                                                'albums' => 24,
                                                'status' => 'Active',
                                                'color' => 'purple',
                                            ],
                                            [
                                                'name' => 'Rock',
                                                'description' => 'Music centered on the electric guitar',
                                                'songs' => 156,
                                                'albums' => 18,
                                                'status' => 'Active',
                                                'color' => 'red',
                                            ],
                                            [
                                                'name' => 'R&B',
                                                'description' => 'Rhythm and blues music',
                                                'songs' => 132,
                                                'albums' => 15,
                                                'status' => 'Active',
                                                'color' => 'orange',
                                            ],
                                            [
                                                'name' => 'Electronic',
                                                'description' => 'Music that employs electronic instruments',
                                                'songs' => 118,
                                                'albums' => 14,
                                                'status' => 'Active',
                                                'color' => 'cyan',
                                            ],
                                            [
                                                'name' => 'Jazz',
                                                'description' => 'Music characterized by improvisation and swing',
                                                'songs' => 87,
                                                'albums' => 12,
                                                'status' => 'Active',
                                                'color' => 'yellow',
                                            ],
                                            [
                                                'name' => 'Classical',
                                                'description' => 'Art music produced in the Western tradition',
                                                'songs' => 76,
                                                'albums' => 9,
                                                'status' => 'Active',
                                                'color' => 'lime',
                                            ],
                                            [
                                                'name' => 'Country',
                                                'description' => 'Music originating in the rural Southern US',
                                                'songs' => 65,
                                                'albums' => 8,
                                                'status' => 'Active',
                                                'color' => 'green',
                                            ],
                                            [
                                                'name' => 'Folk',
                                                'description' => 'Traditional music passed through generations',
                                                'songs' => 54,
                                                'albums' => 7,
                                                'status' => 'Inactive',
                                                'color' => 'teal',
                                            ],
                                            [
                                                'name' => 'Reggae',
                                                'description' => 'Music originating in Jamaica',
                                                'songs' => 43,
                                                'albums' => 6,
                                                'status' => 'Pending',
                                                'color' => 'indigo',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($genres as $index => $genre)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-sm me-2 bg-{{ $genre['color'] }}-lt">
                                                        <i class="ti ti-category text-{{ $genre['color'] }}"></i>
                                                    </span>
                                                    <div>{{ $genre['name'] }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $genre['description'] }}</td>
                                            <td>{{ $genre['songs'] }}</td>
                                            <td>{{ $genre['albums'] }}</td>
                                            <td>
                                                @if ($genre['status'] == 'Active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif($genre['status'] == 'Pending')
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
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editGenreModal{{ $index }}">
                                                            <i class="ti ti-edit me-2"></i>Edit
                                                        </a>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ti ti-music me-2"></i>View Songs
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" class="dropdown-item text-danger delete-genre"
                                                            data-id="{{ $index }}">
                                                            <i class="ti ti-trash me-2"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Showing <span>1</span> to <span>10</span> of <span>10</span> entries
                            </p>
                            <ul class="pagination m-0 ms-auto">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="ti ti-chevron-left"></i>
                                        prev
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
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
                                        @foreach ($genres as $index => $genre)
                                            @if ($index < 5)
                                                <div class="col-6 mb-3">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <span>{{ $genre['name'] }}</span>
                                                        <span>{{ round(($genre['songs'] / array_sum(array_column($genres, 'songs'))) * 100) }}%</span>
                                                    </div>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar bg-{{ $genre['color'] }}"
                                                            role="progressbar"
                                                            style="width: {{ round(($genre['songs'] / array_sum(array_column($genres, 'songs'))) * 100) }}%">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Genre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Genre Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter genre name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter genre description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon Color</label>
                        <div class="row g-2">
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="color" type="radio" value="blue" class="form-colorinput-input"
                                        checked>
                                    <span class="form-colorinput-color bg-blue"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="color" type="radio" value="purple" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-purple"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="color" type="radio" value="red" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-red"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="color" type="radio" value="green" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-green"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="color" type="radio" value="orange" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-orange"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="color" type="radio" value="cyan" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-cyan"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Status</label>
                        <select class="form-select" name="status">
                            <option value="Active">Active</option>
                            <option value="Pending">Pending</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary ms-auto" id="saveGenreBtn">
                        <i class="ti ti-plus me-2"></i>Add Genre
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Genre Modals (one for each genre) -->
    @foreach ($genres as $index => $genre)
        <div class="modal modal-blur fade" id="editGenreModal{{ $index }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Genre: {{ $genre['name'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Genre Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $genre['name'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $genre['description'] }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Color</label>
                            <div class="row g-2">
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="color{{ $index }}" type="radio" value="blue"
                                            class="form-colorinput-input"
                                            {{ $genre['color'] == 'blue' ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-blue"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="color{{ $index }}" type="radio" value="purple"
                                            class="form-colorinput-input"
                                            {{ $genre['color'] == 'purple' ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-purple"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="color{{ $index }}" type="radio" value="red"
                                            class="form-colorinput-input" {{ $genre['color'] == 'red' ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-red"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="color{{ $index }}" type="radio" value="green"
                                            class="form-colorinput-input"
                                            {{ $genre['color'] == 'green' ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-green"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="color{{ $index }}" type="radio" value="orange"
                                            class="form-colorinput-input"
                                            {{ $genre['color'] == 'orange' ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-orange"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="color{{ $index }}" type="radio" value="cyan"
                                            class="form-colorinput-input"
                                            {{ $genre['color'] == 'cyan' ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-cyan"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select" name="status">
                                <option value="Active" {{ $genre['status'] == 'Active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="Pending" {{ $genre['status'] == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="Inactive" {{ $genre['status'] == 'Inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary ms-auto" data-id="{{ $index }}"
                            onclick="updateGenre(this)">
                            <i class="ti ti-device-floppy me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('genre-search');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const description = row.querySelector('td:nth-child(2)').textContent
                        .toLowerCase();

                    if (name.includes(searchTerm) || description.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Add genre functionality
            document.getElementById('saveGenreBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Creating Genre',
                    text: 'Please wait while we process your request...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Simulate form submission delay
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Genre Created Successfully',
                        text: 'The genre has been added to the system.',
                        confirmButtonColor: '#e53935'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#addGenreModal').modal('hide');
                            location.reload();
                        }
                    });
                }, 1500);
            });

            // Delete genre functionality
            document.querySelectorAll('.delete-genre').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const genreId = this.dataset.id;

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
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The genre has been deleted.',
                                icon: 'success',
                                confirmButtonColor: '#e53935'
                            }).then(() => {
                                // Simulate deletion by hiding the row
                                const row = this.closest('tr');
                                row.style.display = 'none';
                            });
                        }
                    });
                });
            });

            // Initialize genre distribution chart
            @php
            $chartData = [];
            foreach(array_slice($genres, 0, 5) as $genre) {
                $chartData[] = [
                    'name' => $genre['name'],
                    'data' => $genre['songs']
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

        // Update genre function
        function updateGenre(button) {
            const genreId = button.dataset.id;

            Swal.fire({
                title: 'Updating Genre',
                text: 'Please wait while we process your request...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simulate form submission delay
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Genre Updated Successfully',
                    text: 'The genre information has been updated.',
                    confirmButtonColor: '#e53935'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#editGenreModal${genreId}`).modal('hide');
                    }
                });
            }, 1500);
        }
    </script>
@endsection

