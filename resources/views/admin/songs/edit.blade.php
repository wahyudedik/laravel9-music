@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Song
                    </h2>
                    <div class="text-muted mt-1">Update song information</div>
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
                    <form class="card" action="{{ route('admin.songs.update', $song->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Edit Song #{{ $song->title }}</h3>
                            <div class="card-actions">
                                <span class="badge bg-success">Active</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Song Title</div>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ old('title', $song->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Artist</div>
                                        <select name="artist_id" id="artist_id" data-artist="{{ $song->artist->id }}"
                                            class="selectpicker form-control @error('artist_id') is-invalid @enderror"
                                            data-json="@json($artist)" data-live-search="true" required>
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
                                        <select name="album_id" id="album_id" data-album="{{ $song->album->id }}"
                                            class="selectpicker form-control @error('album_id') is-invalid @enderror"
                                            data-live-search="true" data-json="@json($album)" required>
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
                                        <select name="genre_id" id="genre_id" data-genre="{{ $song->genre->id }}"
                                            class="selectpicker form-control @error('genre_id') is-invalid @enderror"
                                            data-live-search="true" data-json="@json($genre)" required>
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
                                        <input type="date"
                                            class="form-control @error('release_date') is-invalid @enderror"
                                            name="release_date"
                                            value="{{ old('release_date', substr($song->release_date, 0, 10)) }}" required>
                                        @error('release_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Status</div>
                                        <select class="form-select" name="status" required>
                                            <option value="Active"
                                                {{ old('status', $song->status) == 'Active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="Pending"
                                                {{ old('status', $song->status) == 'Pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="Inactive"
                                                {{ old('status', $song->status) == 'Inactive' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Composers</div>
                                        <select name="composer_ids[]" id="composer_id"
                                            data-composer="{{ $song->composers->pluck('id')->implode(',') }}"
                                            data-json="@json($composers)"
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
                                        <textarea class="form-control" name="description" rows="4" required>{{ old('description', $song->description) }}</textarea>

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
                                        <div class="form-label">Current Cover Image</div>
                                        <div class="d-flex align-items-center mt-2 mb-3">

                                            @php
                                                // Extract filename from the 3rd image variant (small)
                                                $coverImages = explode(',', $song->cover_image ?? '');
                                                $smallCoverFile = $coverImages[2] ?? null;

                                                // Get just the filename from the path (e.g. "cover_abc_sm.jpeg")
                                                $filename = $smallCoverFile ? basename($smallCoverFile) : null;

                                                // Generate image URL via route
                                                $imageUrl = $filename
                                                    ? route('admin.songs.image', ['filename' => $filename])
                                                    : 'https://via.placeholder.com/40';
                                            @endphp

                                            <img src="{{ $imageUrl }}" class="rounded" width="100"
                                                height="100" alt="Cover Image">
                                            {{-- <div class="ms-3">
                                                <a href="#" class="btn btn-sm btn-outline-danger">
                                                    <i class="ti ti-trash me-1"></i>Remove
                                                </a>
                                            </div> --}}
                                        </div>
                                        <div class="form-label">Upload New Cover Image</div>
                                        <input type="file" class="form-control" name="cover_image" accept="image/*">
                                        @error('cover_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-hint">Recommended size: 500x500px, max 2MB</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Current Audio File</div>
                                        <div class="d-flex align-items-center mt-2 mb-3">
                                            @php
                                                $filename = $song->file_path ? basename($song->file_path) : null;
                                                $audioUrl = $filename
                                                    ? route('admin.songs.audio', ['filename' => $filename])
                                                    : null;
                                            @endphp

                                            @if ($audioUrl)
                                                <audio controls class="w-100">
                                                    <source src="{{ $audioUrl }}" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            @endif
                                        </div>
                                        <div class="form-label">Upload New Audio File</div>
                                        <input type="file" class="form-control" name="file_path" accept="audio/*">
                                        <div class="form-hint">Supported formats: MP3, WAV, FLAC. Max 10MB</div>
                                        @error('file_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">Duration (seconds)</div>
                                        <input type="number" class="form-control"
                                            name="duration" placeholder="Enter song duration" required
                                            value="{{ old('duration', $song->duration) }}">
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
                                        <div class="form-label">License Type</div>
                                        <select class="form-select" name="license_type" required>
                                            <option value="Full License"
                                                {{ old('license_type', $song->license_type) == 'Full License' ? 'selected' : '' }}>
                                                Full License
                                            </option>
                                            <option value="Royalty"
                                                {{ old('license_type', $song->license_type) == 'Royalty' ? 'selected' : '' }}>
                                                Royalty
                                            </option>
                                            <option value="Free"
                                                {{ old('license_type', $song->license_type) == 'Free' ? 'selected' : '' }}>
                                                Free
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">License Price (Rp)</div>
                                        <input type="number" class="form-control" name="license_price"
                                            value="{{ old('license_price', $song->license_price) }}">
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
                                                value="1"
                                                {{ old('allow_cover_version', $song->allow_cover_version) ? 'checked' : '' }}>
                                            <span class="form-check-label">Allow Cover Versions</span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" name="allow_commercial_use" value="0">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="allow_commercial_use"
                                                value="1"
                                                {{ old('allow_commercial_use', $song->allow_commercial_use) ? 'checked' : '' }}>
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
                                    <i class="ti ti-device-floppy me-2"></i>Update Song
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

        });
    </script>

    <script>
        $(document).ready(function() {

            // Load artist list on Add Modal
            var selectedArtist = $('#artist_id').attr('data-artist');
            var selectedAlbum = $('#album_id').attr('data-album');
            var selectedGenre = $('#genre_id').attr('data-genre');
            var selectedComposer = $('#composer_id').attr('data-composer');
            var selectedComposerIds = selectedComposer ? selectedComposer.split(',').map(id => id.trim()) : [];


            fetchArtist("#artist_id", selectedArtist);
            fetchAlbum("#album_id", selectedAlbum);
            fetchGenre("#genre_id", selectedGenre);
            fetchComposer("#composer_id", selectedComposerIds);

        });

        function fetchArtist(selectId, selectedValue = "", search = "") {
            const artistSelect = $(selectId);
            const preloadedJson = artistSelect.attr('data-json');
            let preloadedArtist = null;

            try {
                preloadedArtist = JSON.parse(preloadedJson);
            } catch (e) {
                console.error("Invalid JSON in data-json:", e);
            }

            artistSelect.empty();
            artistSelect.append('<option value="">Select Artist</option>');

            // Step 1: Add preloaded artist if not empty
            if (preloadedArtist && preloadedArtist.id) {
                artistSelect.append('<option value="' + preloadedArtist.id + '" selected>' +
                    preloadedArtist.name + ' (' + preloadedArtist.rolename + ')</option>');
            }

            // Step 2: AJAX fetch for additional artist options
            $.ajax({
                url: "/admin/data/artists",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(index, user) {
                        // Skip if already added (avoid duplicates)
                        if (artistSelect.find('option[value="' + user.id + '"]').length === 0) {
                            const selected = user.id === selectedValue ? 'selected' : '';
                            artistSelect.append('<option value="' + user.id + '" ' + selected + '>' +
                                user.name + ' (' + user.roleName + ')</option>');
                        }
                    });

                    artistSelect.selectpicker("refresh");
                }
            });
        }

        function fetchAlbum(selectId, selectedValue = "", search = "") {
            const albumSelect = $(selectId);
            const preloadedJson = albumSelect.attr('data-json');
            let preloadedAlbum = null;

            // Parse JSON safely
            try {
                preloadedAlbum = JSON.parse(preloadedJson);
            } catch (e) {
                console.error("Invalid JSON in data-json:", e);
            }

            albumSelect.empty();
            albumSelect.append('<option value="">Select Album</option>');

            // Append preloaded selected album if it exists
            if (preloadedAlbum && preloadedAlbum.id) {
                albumSelect.append(
                    '<option value="' + preloadedAlbum.id + '" selected>' +
                    preloadedAlbum.title + ' (' + preloadedAlbum.artist + ')</option>'
                );
            }

            // AJAX to fetch albums
            $.ajax({
                url: "/admin/data/albums",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(index, album) {
                        // Avoid duplicates
                        if (albumSelect.find('option[value="' + album.id + '"]').length === 0) {
                            const selected = album.id === selectedValue ? 'selected' : '';
                            albumSelect.append(
                                '<option value="' + album.id + '" ' + selected + '>' +
                                album.title + ' (' + album.artist + ')</option>'
                            );
                        }
                    });

                    albumSelect.selectpicker("refresh");
                }
            });
        }


        function fetchGenre(selectId, selectedValue = "", search = "") {
            const genreSelect = $(selectId);
            const preloadedJson = genreSelect.attr('data-json');
            let preloadedGenre = null;

            // Parse JSON if exists
            try {
                preloadedGenre = JSON.parse(preloadedJson);
            } catch (e) {
                console.error("Invalid JSON in data-json:", e);
            }

            genreSelect.empty();
            genreSelect.append('<option value="">Select Genre</option>');

            // Add preloaded selected genre if available
            if (preloadedGenre && preloadedGenre.id) {
                genreSelect.append('<option value="' + preloadedGenre.id + '" selected>' +
                    preloadedGenre.name + '</option>');
            }

            // Fetch other genre options via AJAX
            $.ajax({
                url: "/admin/data/genres",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(index, genre) {
                        // Skip if already added (from preloaded data)
                        if (genreSelect.find('option[value="' + genre.id + '"]').length === 0) {
                            const selected = genre.id === selectedValue ? 'selected' : '';
                            genreSelect.append('<option value="' + genre.id + '" ' + selected + '>' +
                                genre.name + '</option>');
                        }
                    });

                    genreSelect.selectpicker("refresh");
                }
            });
        }


        function fetchComposer(selectId, selectedValues = [], search = "") {
            const composerSelect = $(selectId);
            const preloadedDataJson = composerSelect.attr('data-json');
            let preloadedComposers = [];

            try {
                preloadedComposers = JSON.parse(preloadedDataJson);
            } catch (e) {
                console.error("Invalid JSON in data-json:", e);
            }

            // Clear the select
            composerSelect.empty();

            // Step 1: Add preloaded composers first
            $.each(preloadedComposers, function(index, composer) {
                composerSelect.append('<option value="' + composer.id + '" selected>' +
                    composer.name + ' (' + composer.rolename + ')</option>');
            });

            // Step 2: Fetch and merge new data (like search results)
            $.ajax({
                url: "/admin/data/composers",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(index, composer) {
                        // Skip if composer already added (to avoid duplicate)
                        if (composerSelect.find('option[value="' + composer.id + '"]').length === 0) {
                            const selected = selectedValues.includes(composer.id) ? 'selected' : '';
                            composerSelect.append('<option value="' + composer.id + '" ' + selected +
                                '>' +
                                composer.name + ' (' + composer.roleName + ')</option>');
                        }
                    });

                    composerSelect.selectpicker("refresh");
                }
            });
        }
    </script>
@endsection
