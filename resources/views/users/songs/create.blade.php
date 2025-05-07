
@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none py-4">
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
                        <a href="{{ route('profile.my-assets') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to MyAsset
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
                    <form class="card" action="{{ route('user.songs.store') }}"
                        method="post"enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Song Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-xl-4">
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

                                <div class="col-md-4 col-xl-4">
                                    <div class="mb-3">
                                        <div class="form-label ">Album</div>
                                        <select name="album_id" id="album_id"
                                            class="selectpicker form-control @error('album_id') is-invalid @enderror"
                                            data-live-search="true">
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
                                                    {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                                    {{ $genre->name }}</option>
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
                                            name="release_date" value="{{ old('release_date', now()->format('Y-m-d')) }}"
                                            required>
                                        @error('release_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Status</div>
                                        <select class="form-select" name="status" required>
                                            <option value="Draft">Draft</option>
                                            <option value="Published">Published</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Description</div>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"
                                            placeholder="Enter song description"></textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Lyrics</div>
                                        <textarea class="form-control" name="lyrics" rows="4" placeholder="Enter song lyrics"></textarea>
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
                                                class="form-control @error('composer_ids') is-invalid @enderror selectpicker "
                                                name="composer_ids[]" id="composer_ids" data-live-search="true"
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
                                    <div class="form-label">Platform</div>
                                    <select class="form-control selectpicker" id="platform" name="platform" data-live-search="true"
                                    data-size="5">
                                        <option value="">Select Platform</option>
                                        @foreach ($socialMedias as $socialMedia )
                                            <option value="{{ $socialMedia->name }}">{{ $socialMedia->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Links (URL)</div>
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
                                        <div class="form-label ">Audio File</div>
                                        <input type="file"
                                            class="form-control @error('file_path') is-invalid @enderror" name="file_path"
                                            accept="audio/*">
                                        @error('file_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-hint">Supported formats: MP3, WAV, FLAC. Max 10MB</div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-label">Duration (seconds)</div>
                                        <input type="number" class="form-control" name="duration"
                                            placeholder="Enter song duration" value="{{ old('duration') }}">
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
                                                <tr>
                                                    <td>
                                                        <div class="license-type">Cover</div>
                                                        <input type="hidden" name="license_type[]" value="Cover">
                                                    </td>
                                                    <td>
                                                        <div class="amount-type">Price</div>
                                                        <input type="hidden" name="amount_type[]" value="Price">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="input-group ">
                                                                <span class="input-group-text"
                                                                    id="local_amount">Rp.</span>
                                                                <input type="number" class="form-control"
                                                                    name="local_amount[]" placeholder="Enter local amount"
                                                                    value="500000">
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
                                                                    placeholder="Enter global amount" value="1500000">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="license_file[]"
                                                            accept=".pdf, .doc, .docx" placeholder="Enter license file">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="license-type">Remake</div>
                                                        <input type="hidden" name="license_type[]" value="Remake">
                                                    </td>
                                                    <td>
                                                        <div class="amount-type">Price</div>
                                                        <input type="hidden" name="amount_type[]" value="Price">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="input-group ">
                                                                <span class="input-group-text"
                                                                    id="local_amount">Rp.</span>
                                                                <input type="number" class="form-control"
                                                                    name="local_amount[]" placeholder="Enter local amount"
                                                                    value="1000000">
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
                                                                    placeholder="Enter global amount" value="2000000">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="license_file[]"
                                                            accept=".pdf, .doc, .docx" placeholder="Enter license file">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="license-type">Royalty</div>
                                                        <input type="hidden" name="license_type[]" value="Royalty">
                                                    </td>
                                                    <td>
                                                        <div class="amount-type">Percentage</div>
                                                        <input type="hidden" name="amount_type[]" value="Percentage">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="input-group ">
                                                                <input type="number" class="form-control"
                                                                    name="local_amount[]" placeholder="Enter local amount"
                                                                    value="30">
                                                                <span class="input-group-text" id="local_amount">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">

                                                            <div class="input-group ">
                                                                <input type="number" class="form-control"
                                                                    name="global_amount[]"
                                                                    placeholder="Enter global amount" value="40">
                                                                <span class="input-group-text" id="global_amount">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="license_file[]"
                                                            accept=".pdf, .doc, .docx" placeholder="Enter license file">
                                                    </td>
                                                </tr>
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
                                                name="local_zones[]" id="local_zones" data-json='@json($lastZones)' data-live-search="true"
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
                                <a href="{{ route('profile.my-assets') }}" class="btn btn-link">Cancel</a>
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
            height: auto;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
            white-space: normal !important;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner {
            white-space: normal !important;
        }

        .bootstrap-select .dropdown-toggle {
            max-height: 100px;
            overflow-y: auto;
            white-space: normal !important;
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
                            window.location.href = "{{ route('profile.my-assets') }}";
                        }
                    });
                }, 1500);
            });


        });
    </script>

    <script>
        $(document).ready(function() {

            fetchAlbum("#album_id");

            let oldComposerIds = {!! json_encode(old('composer_ids', [])) !!};
            let composerNames = {!! json_encode(session('composer_names', [])) !!};
            let composerSelect = $('#composer_ids');
            oldComposerIds.forEach(function(id) {
                if (composerSelect.find('option[value="' + id + '"]').length === 0) {
                    let name = composerNames[id] || 'Selected Composer';
                    composerSelect.append('<option value="' + id + '" selected>' + name + '</option>');
                }
            });

            composerSelect.selectpicker("refresh");
            fetchComposer("#composer_ids", oldComposerIds);

            let oldLocalZones = @json(old('local_zones'));
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
            $.ajax({
                url: "/user/data/albums",
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

        function fetchComposer(selectId, selectedValues = [], search = "") {
            $.ajax({
                url: "/user/data/composers",
                type: "GET",
                data: {
                    search: search,
                    limit: 20
                },
                dataType: "json",
                success: function(data) {
                    var composerSelect = $(selectId);
                    $.each(data, function(index, composer) {
                        if (composerSelect.find('option[value="' + composer.id + '"]').length === 0) {
                            const selected = selectedValues.includes(composer.id) ? 'selected' : '';
                            composerSelect.append('<option value="' + composer.id + '" ' + selected +
                                '>' + composer.name + '</option>');
                        }
                    });

                    composerSelect.selectpicker("refresh");
                }
            });
        }

        function fetchCity(selector, selectedLocalZone) {
            fetch('/user/data/cities')
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
