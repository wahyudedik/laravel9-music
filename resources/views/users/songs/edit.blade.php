@extends('layouts.app')

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
                        <a href="{{ route('user.songs.index') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
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
                    <form class="card" action="{{ route('user.songs.update', $song->id) }}" method="post"
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
                                <div class="col-md-4 col-xl-4">
                                    <div class="mb-3">
                                        <div class="form-label required">Song Title</div>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ old('title', $song->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-4">
                                    <div class="mb-3">
                                        <div class="form-label ">Album</div>
                                        <select name="album_id" id="album_id" data-album="{{ $song->album->id ?? '' }}"
                                            class="selectpicker form-control @error('album_id') is-invalid @enderror"
                                            data-live-search="true" data-json="@json($album)">
                                            <option value="">Select Album</option>
                                        </select>
                                        @error('album_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-4">
                                    <div class="mb-3">
                                        <div class="form-label required">Genre</div>
                                        <select name="genre_id" id="genre_id"
                                            class="selectpicker form-control @error('genre_id') is-invalid @enderror"
                                            data-live-search="true" required>
                                            <option value="">Select Genre</option>
                                            @foreach ($genres as $genre)
                                                <option value="{{ $genre->id }}"
                                                    {{ (old('genre_id') ?? $song->genre_id) == $genre->id ? 'selected' : '' }}>
                                                    {{ $genre->name }}
                                                </option>
                                            @endforeach
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
                                            <option value="Draft"
                                                {{ old('status', $song->status) == 'Draft' ? 'selected' : '' }}>Draft
                                            </option>
                                            <option value="Published"
                                                {{ old('status', $song->status) == 'Published' ? 'selected' : '' }}>
                                                Published
                                            </option>
                                            <option value="Inactive"
                                                {{ old('status', $song->status) == 'Inactive' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Description</div>
                                        <textarea class="form-control" name="description" rows="4" required>{{ old('description', $song->description) }}</textarea>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Lyrics</div>
                                        <textarea class="form-control" name="lyrics" rows="4" placeholder="Enter song lyrics">{{ old('lyrics', $song->lyrics) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <h3 class="card-title">Song Creator</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="mb-3">

                                        <div class="form-label required">Composer</div>
                                        <div class="d-flex align-items-center ">

                                            <select
                                                class="form-control @error('composer_ids') is-invalid @enderror selectpicker"
                                                name="composer_ids[]" id="composer_ids"
                                                data-composer="{{ $composer_ids->pluck('id')->implode(',') }}"
                                                data-json='@json($composers)' data-live-search="true"
                                                data-size="5" multiple>
                                            </select>

                                            <button type="button" class="btn btn-outline-primary ms-3 btn-clear-composer">
                                                <i class="ti ti-trash me-2"></i>
                                                Clear
                                            </button>

                                        </div>
                                        @error('composer_ids')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card-header">
                            <h3 class="card-title">Song Links</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-label required">Platform</div>
                                    <select class="form-control selectpicker" id="platform" name="platform"
                                        data-live-search="true" data-size="5">
                                        <option value="">Select Platform</option>
                                        @foreach ($socialMedias as $socialMedia)
                                            <option value="{{ $socialMedia->name }}">{{ $socialMedia->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Links (URL)</div>
                                        <input type="text" class="form-control @error('link') is-invalid @enderror"
                                            name="link" id="link" placeholder="Enter song link"
                                            value="{{ old('link') }}">
                                        @error('link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <div class="form-label">&nbsp;</div>
                                        <button type="button" id="btn-add-song-link"
                                            class="btn btn-primary btn-add-song-link">
                                            <i class="ti ti-plus me-2"></i> Add
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="table-responsive">

                                            <table class="table border">
                                                <thead>
                                                    <tr>
                                                        <td class="fw-bold">Platform</td>
                                                        <td class="fw-bold">Links</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="song-link-lists">
                                                    @php
                                                        $count = 0;
                                                    @endphp
                                                    @foreach ($songLinks as $songLink)
                                                        <tr id="song-item-{{ $count }}">
                                                            <td>
                                                                {{ $songLink->platform }}
                                                                <input type="hidden" id="platforms-{{ $count }}"
                                                                    class="platforms platforms-{{ $count }}"
                                                                    name="platforms[]" value="{{ $songLink->platform }}">
                                                            </td>
                                                            <td>
                                                                {{ $songLink->link }}
                                                                <input type="hidden" id="links-{{ $count }}"
                                                                    class="links links-{{ $count }}"
                                                                    name="links[]" value="{{ $songLink->link }}">
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <button class="btn btn-outline-danger"
                                                                        data-index="{{ $count }}"
                                                                        onClick="removeSongLinks($(this))">
                                                                        <i class="ti ti-trash me-2"></i> Delete</button>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @php
                                                            $count++;
                                                        @endphp
                                                    @endforeach


                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="20">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                            <div class="d-flex flex-column">
                                                @error('platforms')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                @error('links')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

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
                                                $imageUrl = $filename ? route('songs.image', ['filename' => $filename]) : 'https://via.placeholder.com/40';
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
                                                $audioUrl = $filename ? route('songs.audio', ['filename' => $filename]) : null;
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
                                        <input type="number" class="form-control" name="duration"
                                            placeholder="Enter song duration"
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
                                <div class="col-md-12">
                                    <div class="table-responsive mb-3">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>License Type</th>
                                                    <th>Amount Type</th>
                                                    <th>Local Amount</th>
                                                    <th>Global Amount</th>
                                                    <th>License File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($songLicences as $songLicence)
                                                    @if ($songLicence->license_type == 'Cover')
                                                        <tr>
                                                            <td>
                                                                <div class="license-type">Cover</div>
                                                                <input type="hidden" name="license_type[]"
                                                                    value="Cover">
                                                            </td>
                                                            <td>
                                                                <div class="amount-type">Price</div>
                                                                <input type="hidden" name="amount_type[]"
                                                                    value="Price">
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="input-group ">
                                                                        <span class="input-group-text"
                                                                            id="local_amount">Rp.</span>
                                                                        <input type="number" class="form-control"
                                                                            name="local_amount[]"
                                                                            placeholder="Enter local amount"
                                                                            value="{{ $songLicence->local_amount }}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="input-group ">
                                                                        <span class="input-group-text"
                                                                            id="global_amount">Rp.</span>
                                                                        <input type="number" class="form-control"
                                                                            name="global_amount[]"
                                                                            placeholder="Enter global amount"
                                                                            value="{{ $songLicence->global_amount }}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="file" class="form-control"
                                                                    name="license_file[]" accept=".pdf, .doc, .docx"
                                                                    placeholder="Enter license file">
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if ($songLicence->license_type == 'Remake')
                                                        <tr>
                                                            <td>
                                                                <div class="license-type">Remake</div>
                                                                <input type="hidden" name="license_type[]"
                                                                    value="Remake">
                                                            </td>
                                                            <td>
                                                                <div class="amount-type">Price</div>
                                                                <input type="hidden" name="amount_type[]"
                                                                    value="Price">
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="input-group ">
                                                                        <span class="input-group-text"
                                                                            id="local_amount">Rp.</span>
                                                                        <input type="number" class="form-control"
                                                                            name="local_amount[]"
                                                                            placeholder="Enter local amount"
                                                                            value="{{ $songLicence->local_amount }}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="input-group ">
                                                                        <span class="input-group-text"
                                                                            id="global_amount">Rp.</span>
                                                                        <input type="number" class="form-control"
                                                                            name="global_amount[]"
                                                                            placeholder="Enter global amount"
                                                                            value="{{ $songLicence->global_amount }}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="file" class="form-control"
                                                                    name="license_file[]" accept=".pdf, .doc, .docx"
                                                                    placeholder="Enter license file">
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if ($songLicence->license_type == 'Royalty')
                                                        <tr>
                                                            <td>
                                                                <div class="license-type">Royalty</div>
                                                                <input type="hidden" name="license_type[]"
                                                                    value="Royalty">
                                                            </td>
                                                            <td>
                                                                <div class="amount-type">Percentage</div>
                                                                <input type="hidden" name="amount_type[]"
                                                                    value="Percentage">
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="input-group ">
                                                                        <input type="number" class="form-control"
                                                                            name="local_amount[]"
                                                                            placeholder="Enter local amount"
                                                                            value="{{ $songLicence->local_amount }}">
                                                                        <span class="input-group-text"
                                                                            id="local_amount">%</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">

                                                                    <div class="input-group ">
                                                                        <input type="number" class="form-control"
                                                                            name="global_amount[]"
                                                                            placeholder="Enter global amount"
                                                                            value="{{ $songLicence->global_amount }}">
                                                                        <span class="input-group-text"
                                                                            id="global_amount">%</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="file" class="form-control"
                                                                    name="license_file[]" accept=".pdf, .doc, .docx"
                                                                    placeholder="Enter license file">
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach


                                            </tbody>
                                        </table>
                                        <div class="d-flex flex-column">
                                            @error('licence_file')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-5">
                                        <div class="form-label required">Local Zones</div>
                                        <div class="d-flex align-items-center ">
                                            <select
                                                class="form-control @error('local_zones') is-invalid @enderror selectpicker "
                                                name="local_zones[]" id="local_zones"
                                                data-json='@json($localZonesJson)' data-live-search="true"
                                                data-size="5" multiple>
                                                <option>Select City</option>
                                            </select>
                                            <button type="button" class="btn btn-outline-primary ms-3 btn-clear-zone">
                                                <i class="ti ti-trash me-2"></i>
                                                Clear
                                            </button>

                                        </div>
                                        @error('local_zones')
                                            <div class="text-danger">{{ $message }}</div>
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
                                <a href="{{ route('songs.index') }}" class="btn btn-link">Cancel</a>
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
            var selectedAlbum = $('#album_id').attr('data-album');
            var selectedGenre = $('#genre_id').attr('data-genre');
            var selectedComposer = $('#composer_ids').attr('data-composer');
            var selectedComposerIds = selectedComposer ? selectedComposer.split(',').map(id => id.trim()) : [];

            fetchAlbum("#album_id", selectedAlbum);
            fetchComposer("#composer_ids", selectedComposerIds);
            fetchCity('#local_zones');

            document.querySelector('.btn-clear-zone').addEventListener('click', function() {
                $('#local_zones').val([]);
                $('#local_zones').selectpicker('refresh');
            });

            document.querySelector('.btn-clear-composer').addEventListener('click', function() {
                $('#composer_ids').val([]);
                $('#composer_ids').selectpicker('refresh');
            });

            $('#btn-add-song-link').on('click', function() {
                addSongLinks();
            });

        });

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

        function fetchComposer(selectId, selectedValues = [], search = "") {
            const composerSelect = $(selectId);
            const preloadedJson = composerSelect.attr('data-json');

            // Parse JSON safely
            try {
                preloadedComposers = JSON.parse(preloadedJson);
            } catch (e) {
                console.error("Invalid JSON in data-json:", e);
            }
            // Clear the select
            composerSelect.empty();
            // Step 1: Add preloaded composers first
            $.each(preloadedComposers, function(index, row) {
                composerSelect.append('<option value="' + row.id + '" selected>' +
                    row.name + '</option>');
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
                                composer.name + '</option>');
                        }
                    });

                    composerSelect.selectpicker("refresh");
                }
            });
        }

        function fetchCity(selector, selectedLocalZone) {
            fetch('/admin/data/cities')
                .then(response => response.json())
                .then(data => {
                    let select = document.querySelector(selector);
                    let preloadedJson = select.dataset.json;
                    let selectedJson = [];

                    try {
                        selectedJson = JSON.parse(preloadedJson);
                    } catch (e) {
                        console.error('Invalid JSON in data-json:', e);
                    }

                    // Clear all options
                    select.innerHTML = '';

                    // Add default option
                    select.insertAdjacentHTML('beforeend', '<option disabled>Select City</option>');

                    // Add preloaded selected cities
                    selectedJson.forEach(function(city) {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.text = city.name;
                        option.selected = true;
                        select.appendChild(option);
                    });

                    // Append cities from fetch, skip if already added
                    data.forEach(function(city) {
                        const exists = Array.from(select.options).some(opt => opt.value === city);
                        if (!exists) {
                            const option = document.createElement('option');
                            option.value = city;
                            option.text = city;

                            if (selectedLocalZone && Array.isArray(selectedLocalZone) && selectedLocalZone
                                .includes(city)) {
                                option.selected = true;
                            }

                            select.appendChild(option);
                        }
                    });

                    // Refresh selectpicker to reflect updates
                    $('.selectpicker').selectpicker('refresh');
                })
                .catch(error => {
                    console.error('Error fetching cities:', error);
                });
        }



        function addSongLinks() {

            let platform = $('#platform').val();
            let link = $('#link').val();

            if (!link || !platform) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'link or platform cannot be empty',
                });
                return;
            }

            //check platform exist on table
            let found = false;
            let count = 0;
            let rowCount = $('#song-link-lists tr').length;
            if (rowCount > 0) {
                $('#song-link-lists tr').each(function(index) {
                    count++;
                    let platformValue = $(this).find('.platforms').val();
                    let linkValue = $(this).find('.links').val();
                    if (platform == platformValue || link == linkValue) {
                        found = true;
                    }
                });
            }

            if (found) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'the platform data and link are already filled in',
                });
                return;
            }

            //insert ke
            let songItem = `
            <tr id="song-item-${count}">
                <td>
                    ${platform}
                    <input type="hidden" id="platforms-${count}" class="platforms platforms-${count}"
                        name="platforms[]" value="${platform}">
                </td>
                <td>
                    ${link}
                    <input type="hidden" id="links-${count}" class="links links-${count}"
                        name="links[]" value="${link}">
                </td>
                <td>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-danger" data-index="${count}" onClick="removeSongLinks($(this))" >
                            <i class="ti ti-trash me-2"></i> Delete</button>
                    </div>
                </td>
            </tr>
            `;
            $('#song-link-lists').append(songItem);

            $('#link').val('');
            $('#platform').val('');


        }

        function removeSongLinks(e) {
            let idx = e.attr('data-index');
            $(`#song-item-${idx}`).remove();
        }
    </script>
@endsection
