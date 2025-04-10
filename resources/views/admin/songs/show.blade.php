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
                        <a href="{{ route('admin.songs.edit', $song->id) }}" class="btn btn-primary d-none d-sm-inline-block">
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
                                @php
                                    // Extract filename from the 3rd image variant (small)
                                    $coverImages = explode(',', $song->cover_image ?? '');
                                    $smallCoverFile = $coverImages[2] ?? null;

                                    // Get just the filename from the path (e.g. "cover_abc_sm.jpeg")
                                    $filename = $smallCoverFile ? basename($smallCoverFile) : null;

                                    // Generate image URL via route
                                    $imageUrl = $filename
                                        ? route('admin.songs.image', ['filename' => $filename])
                                        : 'https://via.placeholder.com/300';
                                @endphp

                                <img src="{{ $imageUrl }}" class="rounded" width="200" height="200"
                                    alt="Cover Image">
                                <h2 class="mt-3 mb-0">{{ $song->album->title }}</h2>
                                <p class="text-muted">{{ $song->artist->name }}</p>
                                <div class="mt-3">
                                    {{-- Status Badge --}}
                                    @if ($song->status === 'Active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($song->status === 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif ($song->status === 'Inactive')
                                        <span class="badge bg-danger">Inactive</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $song->status }}</span>
                                    @endif
                                    <span class="badge bg-blue ms-2">{{ $song->license_type }}</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                @php
                                    $filename = $song->file_path ? basename($song->file_path) : null;
                                    $audioUrl = $filename
                                        ? route('admin.songs.audio', ['filename' => $filename])
                                        : null;
                                @endphp

                                @if ($audioUrl)
                                    <audio controls class="w-100 mb-3">
                                        <source src="{{ $audioUrl }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                @endif




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
                                    <div class="datagrid-content">{{ $song->id }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Title</div>
                                    <div class="datagrid-content">{{ $song->title }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Artist</div>
                                    <div class="datagrid-content">{{ $song->artist->name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Album</div>
                                    <div class="datagrid-content">{{ $song->album->title }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Genre</div>
                                    <div class="datagrid-content">{{ $song->genre->name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Release Date</div>
                                    <div class="datagrid-content">
                                        {{ \Carbon\Carbon::parse($song->release_date)->format('F d, Y') }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Duration</div>
                                    <div class="datagrid-content">{{ gmdate('i:s', $song->duration) }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status</div>
                                    <div class="datagrid-content">
                                        @if ($song->status === 'Active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif ($song->status === 'Inactive')
                                            <span class="badge bg-secondary">Inactive</span>
                                        @elseif ($song->status === 'Pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-dark">{{ $song->status }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">License Type</div>
                                    <div class="datagrid-content">{{ $song->license_type ?? '-' }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">License Price</div>
                                    <div class="datagrid-content">
                                        {{ $song->license_price ? 'Rp. ' . number_format($song->license_price, 0, ',', '.') : '-' }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Allow Covers</div>
                                    <div class="datagrid-content">
                                        @if ($song->allow_cover_version)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Allow Commercial Use</div>
                                    <div class="datagrid-content">
                                        @if ($song->allow_commercial_use)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created At</div>
                                    <div class="datagrid-content">
                                        {{ \Carbon\Carbon::parse($song->created_at)->translatedFormat('F j, Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Last Updated</div>
                                    <div class="datagrid-content">
                                        {{ \Carbon\Carbon::parse($song->updated_at)->translatedFormat('F j, Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Composers & Credits</h3>
                        </div>
                        <div class="card-body">
                            @if ($song->composers->count())
                                <div class="mb-3">
                                    <h4 class="mb-2">Composers</h4>
                                    <div class="avatar-list avatar-list-stacked">
                                        @foreach ($song->composers as $composer)
                                            <span class="avatar avatar-md rounded"
                                                style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($composer->name) }}&background=e53935&color=fff')"
                                                data-bs-toggle="tooltip" title="{{ $composer->name }}">
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="mb-3">
                                    <h4 class="mb-2">Composers</h4>
                                    <p class="text-muted">No composers assigned.</p>
                                </div>
                            @endif
                            <div>
                                @if ($song->composers->count())
                                    <h4 class="mb-2">Production Credits</h4>
                                    <ul class="list-unstyled">
                                        <li class="mb-1">
                                            <strong>Composer:</strong>
                                            {{ $song->composers->pluck('name')->join(', ') }}
                                        </li>
                                    </ul>
                                @else
                                    <h4 class="mb-2">Production Credits</h4>
                                    <ul class="list-unstyled">
                                        <li class="mb-1 text-muted">
                                            <em>No composers assigned.</em>
                                        </li>
                                    </ul>
                                @endif

                                {{-- <ul class="list-unstyled">
                                    <li class="mb-1">
                                        <strong>Producer:</strong> Max Martin, Oscar Holter
                                    </li>
                                    <li class="mb-1">
                                        <strong>Mixing Engineer:</strong> Serban Ghenea
                                    </li>
                                    <li class="mb-1">
                                        <strong>Mastering Engineer:</strong> Dave Kutch
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Description</h3>
                        </div>
                        <div class="card-body">
                            {{ $song->description }}
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
                                    @forelse ($song->coverVersions as $cover)
                                        @php
                                            $artist = $cover->artist;
                                            $name = $artist?->name ?? 'Unknown';
                                            $avatarUrl =
                                                'https://ui-avatars.com/api/?name=' .
                                                urlencode($name) .
                                                '&background=e53935&color=fff';
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url({{ $avatarUrl }})"></span>
                                                    <div>{{ $name }}</div>
                                                </div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($cover->release_date)->format('M d, Y') }}</td>
                                            <td>{{ number_format($cover->play_count ?? 0) }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                    {{ $cover->status == 'Active'
                                                        ? 'bg-success'
                                                        : ($cover->status == 'Inactive'
                                                            ? 'bg-danger'
                                                            : ($cover->status == 'Pending'
                                                                ? 'bg-warning'
                                                                : 'bg-secondary')) }}">
                                                    {{ $cover->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.songs.show', $cover->id) }}"
                                                    class="btn btn-icon btn-ghost-secondary">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No cover versions available.
                                            </td>
                                        </tr>
                                    @endforelse

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
