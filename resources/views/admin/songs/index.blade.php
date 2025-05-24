@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manajemen Lagu
                    </h2>
                    <div class="text-muted mt-1">Kelola semua lagu dalam sistem</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.songs.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-plus me-2"></i>
                            Tambahkan Lagu Baru
                        </a>
                        <a href="{{ route('admin.songs.create') }}" class="btn btn-primary d-sm-none btn-icon">
                            <i class="ti ti-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card mb-4 " style="overflow: auto;">
                <div class="card-header">
                    <h3 class="card-title">Filter Lagu</h3>
                </div>
                <form id="form-filter" action="{{ route('admin.songs.index') }}" method="GET" class="d-flex">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Album</label>
                                <select name="falbum_id" id="falbum_id" data-album="{{ request('falbum_id') }}"
                                    data-json="@json($album)" class="selectpicker form-control"
                                    data-live-search="true" required>
                                    <option value="">Select Album</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Genre</label>
                                <select name="fgenre_id" id="fgenre_id" data-genre="{{ request('fgenre_id') }}"
                                    data-json="@json($genre)" class="selectpicker form-control "
                                    data-live-search="true" required>
                                    <option value="">Select Genre</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select id="status-filter" name="fstatus" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="Published" {{ request('fstatus') == 'Published' ? 'selected' : '' }}>
                                        Release
                                    </option>
                                    <option value="Draft" {{ request('fstatus') == 'Draft' ? 'selected' : '' }}>Belum
                                        Release
                                    </option>
                                    <option value="Inactive" {{ request('fstatus') == 'Inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.songs.index') }}" id="reset-filters"
                                        class="btn btn-link me-2">Reset</a>
                                    <button type="submit" id="apply-filters" class="btn btn-primary">Terapkan
                                        Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Lagu</h3>
                    <div class="d-flex">
                        <form action="{{ route('admin.songs.index') }}" method="GET" class="d-flex">
                            <div class="input-icon me-3">
                                <span class="input-icon-addon">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" name="search" id="song-search" class="form-control"
                                    value="{{ request('search') }}" placeholder="Search songs...">
                            </div>
                        </form>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                id="bulkActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Tindakan Massal
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="bulkActionsDropdown">
                                <li><a class="dropdown-item bulk-action-btn" href="javascript:void(0)"
                                        data-action="activate"><i class="ti ti-check me-2"></i>Activate Selected</a></li>
                                <li><a class="dropdown-item bulk-action-btn" href="javascript:void(0)"
                                        data-action="deactivate"><i class="ti ti-x me-2"></i>Deactivate Selected</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger bulk-action-btn" href="javascript:void(0)"
                                        data-action="delete"><i class="ti ti-trash me-2"></i>Delete Selected</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-hover">
                        <thead>
                            <tr>
                                <th class="w-1">
                                    <input class="form-check-input m-0 align-middle" type="checkbox" id="select-all">
                                </th>
                                <th>Judul</th>
                                <th>Pencipta</th>
                                <th>Artis</th>
                                <th>Album</th>
                                <th>Genre</th>
                                <th>Tanggal Rilis</th>
                                <th>Status</th>
                                <th class="w-1">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="songs-table-body">
                            @foreach ($songs as $song)
                                @php
                                    // Extract filename from the 3rd image variant (small)
                                    $coverImages = explode(',', $song->cover_image ?? '');
                                    $smallCoverFile = $coverImages[2] ?? null;

                                    // Get just the filename from the path (e.g. "cover_abc_sm.jpeg")
                                    $filename = $smallCoverFile ? basename($smallCoverFile) : null;

                                    // Generate image URL via route
                                    $imageUrl = $filename ? route('admin.songs.image', ['filename' => $filename]) : 'https://via.placeholder.com/40';
                                @endphp

                                <tr class="song-row" data-album="{{ $song->album->title ?? '-' }}"
                                    data-genre="{{ $song->genre->name ?? '-' }}"
                                    data-status="{{ $song->status ?? 'Inactive' }}">
                                    <td>
                                        <input class="form-check-input m-0 align-middle song-checkbox" type="checkbox"
                                            value="{{ $song->id }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url('{{ $imageUrl }}')"></span>
                                            <div>{{ $song->title }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $creatorName =
                                                $song->songContributors
                                                    ->where('role', 'Composer')
                                                    ->pluck('user.name')
                                                    ->filter()
                                                    ->implode(', ') ?? '-';

                                            if (empty($creatorName)) {
                                                $creatorName = '-';
                                            }
                                        @endphp

                                        {{ $creatorName }}
                                    </td>
                                    <td>
                                        @php
                                            $artistNames =
                                                $song->songContributors
                                                    ->where('role', 'Artist')
                                                    ->pluck('user.name')
                                                    ->filter()
                                                    ->implode(', ') ?? '-';

                                            if (empty($artistNames)) {
                                                $artistNames = '-';
                                            }
                                        @endphp

                                        {{ $artistNames }}
                                    </td>

                                    <td>{{ $song->album?->title ?? '-' }}</td>
                                    <td>{{ $song->genre->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($song->release_date)->format('d M Y') }}</td>
                                    <td>
                                        @if ($song->status == 'Published')
                                            <span class="badge bg-success">Release</span>
                                        @elseif($song->status == 'Draft')
                                            <span class="badge bg-warning text-white">Belum Release</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-ghost-secondary" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.songs.show', $song->id) }}"
                                                    class="dropdown-item">
                                                    <i class="ti ti-eye me-2"></i>View
                                                </a>
                                                <a href="{{ route('admin.songs.edit', $song->id) }}"
                                                    class="dropdown-item">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ti ti-player-play me-2"></i>Preview
                                                </a>
                                                <div class="dropdown-divider"></div>

                                                <a href="javascript:void(0)" class="dropdown-item text-danger delete-song"
                                                    onclick="confirmDelete('{{ $song->id }}')"
                                                    data-id="{{ $song->id }}">
                                                    <i class="ti ti-trash me-2"></i>Delete
                                                </a>

                                                <form id="delete-form-{{ $song->id }}"
                                                    action="{{ route('admin.songs.destroy', $song) }}" method="POST"
                                                    class="d-none">
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
                    {{ $songs->links() }}
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

            // When #select-all is clicked
            $('#select-all').on('change', function() {
                $('.song-checkbox').prop('checked', this.checked);
            });

            // If any individual checkbox is unchecked, uncheck #select-all
            $('.song-checkbox').on('change', function() {
                if (!$(this).is(':checked')) {
                    $('#select-all').prop('checked', false);
                }

                // If all are checked, check #select-all
                if ($('.song-checkbox:checked').length === $('.song-checkbox').length) {
                    $('#select-all').prop('checked', true);
                }
            });

            var selectedAlbum = $('#falbum_id').attr('data-album');
            var selectedGenre = $('#fgenre_id').attr('data-genre');

            fetchAlbum("#falbum_id", selectedAlbum);
            fetchGenre("#fgenre_id", selectedGenre);
            $('#apply-filters').on('click', function() {
                $('#form-filter').submit(); // force submit
            });



            // Handle bulk action buttons
            document.querySelectorAll('.bulk-action-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const action = this.dataset.action;
                    const selectedIds = Array.from(document.querySelectorAll(
                        '.song-checkbox:checked')).map(cb => cb.value);

                    if (selectedIds.length === 0) {
                        return Swal.fire({
                            icon: 'warning',
                            title: 'No Songs Selected',
                            text: 'Please select at least one song to proceed.',
                            confirmButtonText: 'OK'
                        });
                    }

                    Swal.fire({
                        title: `Are you sure?`,
                        text: `You are about to ${action} ${selectedIds.length} song(s).`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, proceed!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`{{ route('admin.songs.bulk-action') }}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        action: action,
                                        song_ids: selectedIds
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('Success', data.message, 'success')
                                            .then(() => location.reload());
                                    } else {
                                        Swal.fire('Error', data.message ||
                                            'Something went wrong.', 'error');
                                    }
                                })
                                .catch(err => {
                                    console.error(err);
                                    Swal.fire('Error', 'Request failed.', 'error');
                                });
                        }
                    });
                });
            });



        });

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
    </script>
@endsection
