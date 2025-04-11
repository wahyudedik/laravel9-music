@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Add New Song
                    </h2>
                    <div class="text-muted mt-1">Create a new song in the system</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
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
                <div class="col-12">
                    <form class="card" action="{{ route('admin.songs.store') }}"
                        method="post"enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Song Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Song Title</div>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" placeholder="Enter song title" required
                                            value="{{ old('title') }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Artist</div>
                                        <select name="artist_id" id="artist_id"
                                            class="selectpicker form-control @error('artist_id') is-invalid @enderror"
                                            data-live-search="true" required>
                                            <option value="">Select Artist</option>
                                        </select>
                                        @error('artist_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Album</div>
                                        <select name="album_id" id="album_id"
                                            class="selectpicker form-control @error('album_id') is-invalid @enderror"
                                            data-live-search="true" required>
                                            <option value="">Select Album</option>
                                        </select>
                                        @error('album_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Genre</div>
                                        <select name="genre_id" id="genre_id"
                                            class="selectpicker form-control @error('genre_id') is-invalid @enderror"
                                            data-live-search="true" required>
                                            <option value="">Select Genre</option>
                                        </select>
                                        @error('genre_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Release Date</div>
                                        <input type="date" class="form-control" name="release_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Status</div>
                                        <select class="form-select" name="status" required>
                                            <option value="Active">Active</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Composers</div>

                                        <select name="composer_ids[]" id="composer_id"
                                            class="selectpicker form-control @error('composer_id') is-invalid @enderror"
                                            data-live-search="true" multiple required>
                                            <option value="">Select Composer</option>
                                        </select>
                                        @error('composer_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="form-hint">You can select multiple composers</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Description</div>
                                        <textarea class="form-control" name="description" rows="4" placeholder="Enter song description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Media Files</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Cover Image</div>
                                        <input type="file"
                                            class="form-control @error('cover_image') is-invalid @enderror"
                                            name="cover_image" accept="image/*" required>
                                        @error('cover_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-hint">Recommended size: 500x500px, max 2MB</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Audio File</div>
                                        <input type="file"
                                            class="form-control @error('file_path') is-invalid @enderror" name="file_path"
                                            accept="audio/*" required>
                                        @error('file_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-hint">Supported formats: MP3, WAV, FLAC. Max 10MB</div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-label">Duration (seconds)</div>
                                        <input type="number" class="form-control"
                                            name="duration" placeholder="Enter song duration" required
                                            value="{{ old('duration') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Licensing & Rights</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label required">License Type</div>
                                        <select class="form-select @error('license_type') is-invalid @enderror" name="license_type">
                                            <option value="Full License">Full License</option>
                                            <option value="Royalty">Royalty</option>
                                            <option value="Free">Free</option>
                                        </select>
                                        @error('license_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-label">License File</div>
                                        <input type="file"
                                            class="form-control @error('license_file') is-invalid @enderror"
                                            name="license_file" accept=".pdf,.doc,.docx,.xls,.xlsx">
                                        @error('license_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-hint">Upload license document (PDF, DOC, etc)</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">License Price (Rp)</div>
                                        <input type="number"
                                            class="form-control @error('license_price') is-invalid @enderror"
                                            name="license_price" placeholder="Enter license price"
                                            value="{{ old('license_price') }}">
                                        @error('license_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="hidden" name="allow_cover_version" value="0">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="allow_cover_version"
                                                value="1" {{ old('allow_cover_version') ? 'checked' : '' }}>
                                            <span class="form-check-label">Allow Cover Versions</span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" name="allow_commercial_use" value="0">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="allow_commercial_use"
                                                value="1" {{ old('allow_commercial_use') ? 'checked' : '' }}>
                                            <span class="form-check-label">Allow Commercial Use</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="{{ route('admin.songs.index') }}" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <i class="ti ti-device-floppy me-2"></i>Save Song
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

    <style>
        .bootstrap-select>.dropdown-toggle {
            height: 35.6px;
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
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Creating Song',
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
                        title: 'Song Created Successfully',
                        text: 'The song has been added to the system.',
                        confirmButtonColor: '#e53935'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('admin.songs.index') }}";
                        }
                    });
                }, 1500);
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            // Load artist list on Add Modal
            fetchArtist("#artist_id");
            fetchAlbum("#album_id");
            fetchGenre("#genre_id");
            fetchComposer("#composer_id");

        });

        function fetchArtist(selectId, selectedValue = "", search = "") {
            $.ajax({
                url: "/admin/data/artists",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    var userSelect = $(selectId);
                    userSelect.empty();
                    userSelect.append('<option value="">Select Artist</option>');

                    $.each(data, function(index, user) {
                        const selected = user.id == selectedValue ? 'selected' : '';
                        userSelect.append('<option value="' + user.id + '" ' + selected +
                            '>' + user.name + ' (' + user.roleName + ')</option>');
                    });

                    userSelect.selectpicker("refresh");
                }
            });
        }

        function fetchAlbum(selectId, selectedValue = "", search = "") {
            $.ajax({
                url: "/admin/data/albums",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    var albumSelect = $(selectId);
                    albumSelect.empty();
                    albumSelect.append('<option value="">Select Album</option>');

                    $.each(data, function(index, album) {
                        const selected = album.id == selectedValue ? 'selected' : '';
                        albumSelect.append('<option value="' + album.id + '" ' + selected +
                            '>' + album.title + ' (' + album.artist + ')' + ' </option>');
                    });

                    albumSelect.selectpicker("refresh");
                }
            });
        }

        function fetchGenre(selectId, selectedValue = "", search = "") {
            $.ajax({
                url: "/admin/data/genres",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    var genreSelect = $(selectId);
                    genreSelect.empty();
                    genreSelect.append('<option value="">Select Genre</option>');

                    $.each(data, function(index, genre) {
                        const selected = genre.id == selectedValue ? 'selected' : '';
                        genreSelect.append('<option value="' + genre.id + '" ' + selected +
                            '>' + genre.name + ' </option>');
                    });

                    genreSelect.selectpicker("refresh");
                }
            });
        }

        function fetchComposer(selectId, selectedValue = "", search = "") {
            $.ajax({
                url: "/admin/data/composers",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    var composerSelect = $(selectId);
                    composerSelect.empty();
                    // composerSelect.append('<option value="">Select Composer</option>');

                    $.each(data, function(index, composer) {
                        const selected = composer.id == selectedValue ? 'selected' : '';
                        composerSelect.append('<option value="' + composer.id + '" ' + selected +
                            '>' + composer.name + ' (' + composer.roleName + ')</option>');
                    });

                    composerSelect.selectpicker("refresh");
                }
            });
        }
    </script>
@endsection
