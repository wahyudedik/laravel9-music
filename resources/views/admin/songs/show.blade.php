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
                                <p class="text-muted">{{ '' }}</p>
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
                                    <div class="h3 m-0">{{ number_format($song->play_count) }}</div>
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
                                    <div class="h3 m-0">{{ number_format($song->download_count) }}</div>
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
                                    <div class="h3 m-0">{{ number_format($song->licences_sold) }}</div>
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
                                    <div class="h3 m-0">{{ number_format($song->favorites_count) }}</div>
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
                            <div class="datagrid pb-4">
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
                                    <div class="datagrid-content">{{ $artistName }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Album</div>
                                    <div class="datagrid-content">{{ $song->album->title ?? '' }}</div>
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
                                    <div class="datagrid-content">
                                        {{ $song->duration ? gmdate('i:s', $song->duration) : '00:00' }}</div>
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
                                    <div class="datagrid-content">{{ 'Cover, Remake , Royalti' }}</div>
                                </div>
                                {{-- <div class="datagrid-item">
                                    <div class="datagrid-title">License Price</div>
                                    <div class="datagrid-content">
                                        {{ $song->license_price ? 'Rp. ' . number_format($song->license_price, 0, ',', '.') : '-' }}
                                    </div>
                                </div> --}}
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
                            <h3 class="card-title">Licenses & Price</h3>
                        </div>
                        <div class="card-body">

                            <div class="row g-3">

                                @foreach ($song->licenses as $licence)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex align-items-center">

                                                        <div class="me-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="32px"
                                                                height="25px" viewBox="0 0 32 25" version="1.1">
                                                                <g id="surface1">
                                                                    <path
                                                                        style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;"
                                                                        d="M 22.050781 11.042969 C 22.160156 11.113281 22.273438 11.207031 22.394531 11.3125 L 22.402344 11.320312 C 22.554688 11.449219 22.722656 11.597656 22.910156 11.703125 C 23.066406 11.789062 23.292969 11.796875 23.53125 11.808594 C 24.617188 11.847656 25.046875 12.328125 25.113281 13.382812 L 25.117188 13.421875 C 25.125 13.574219 25.144531 13.71875 25.199219 13.875 C 25.253906 14.039062 25.347656 14.210938 25.503906 14.421875 C 25.796875 14.8125 25.972656 15.140625 26.039062 15.445312 C 26.175781 16.0625 25.886719 16.46875 25.449219 16.839844 C 25.136719 17.113281 25.117188 17.21875 25.117188 17.648438 C 25.113281 17.902344 25.109375 18.160156 24.945312 18.492188 L 24.941406 18.5 C 24.628906 19.109375 24.097656 19.417969 23.417969 19.371094 C 23.273438 19.359375 23.136719 19.351562 23.039062 19.394531 L 23.027344 19.398438 C 22.8125 19.488281 22.621094 19.644531 22.4375 19.792969 C 21.585938 20.480469 20.992188 20.394531 20.246094 19.789062 C 20.0625 19.636719 19.867188 19.480469 19.652344 19.390625 C 19.546875 19.347656 19.414062 19.359375 19.269531 19.367188 C 18.8125 19.398438 18.5 19.3125 18.136719 19.007812 C 17.972656 18.863281 17.835938 18.6875 17.738281 18.488281 C 17.574219 18.15625 17.570312 17.898438 17.566406 17.644531 C 17.5625 17.460938 17.5625 17.285156 17.480469 17.089844 L 17.476562 17.085938 C 17.441406 17.011719 17.339844 16.925781 17.226562 16.828125 C 16.789062 16.453125 16.496094 16.058594 16.636719 15.4375 C 16.703125 15.132812 16.882812 14.804688 17.175781 14.414062 C 17.335938 14.207031 17.425781 14.03125 17.480469 13.867188 C 17.535156 13.710938 17.554688 13.5625 17.5625 13.410156 L 17.566406 13.378906 C 17.628906 12.320312 18.0625 11.84375 19.144531 11.804688 C 19.382812 11.796875 19.613281 11.785156 19.769531 11.699219 L 19.773438 11.695312 C 19.957031 11.589844 20.125 11.445312 20.277344 11.3125 C 20.398438 11.207031 20.511719 11.109375 20.628906 11.039062 C 21.09375 10.726562 21.582031 10.757812 22.050781 11.042969 Z M 1.5 0 L 30.5 0 C 30.910156 0 31.285156 0.167969 31.554688 0.441406 C 31.835938 0.71875 31.992188 1.101562 31.992188 1.496094 L 31.992188 20.140625 C 31.992188 20.554688 31.824219 20.929688 31.554688 21.199219 C 31.285156 21.472656 30.910156 21.640625 30.5 21.640625 L 28.820312 21.640625 C 28.417969 20.804688 27.96875 19.984375 27.546875 19.160156 L 30.367188 16.324219 L 30.367188 4.546875 L 27.464844 1.632812 L 4.535156 1.632812 L 1.632812 4.546875 L 1.632812 17.089844 L 4.535156 20.007812 L 14.699219 20.007812 L 13.859375 21.640625 L 1.5 21.640625 C 1.089844 21.640625 0.714844 21.472656 0.445312 21.199219 C 0.164062 20.917969 0.0078125 20.539062 0.0078125 20.140625 L 0.0078125 1.496094 C 0.0078125 1.085938 0.175781 0.710938 0.445312 0.441406 C 0.714844 0.167969 1.089844 0 1.5 0 Z M 7.425781 7.582031 L 7.355469 8.492188 L 5.027344 8.492188 L 5.085938 7.339844 L 5.027344 4.5625 L 6.257812 4.5625 L 6.191406 7.214844 L 6.207031 7.496094 L 7.359375 7.496094 Z M 5.539062 16.960938 C 6.640625 15.511719 7.578125 16.171875 8.890625 17.09375 C 8.957031 17.140625 9.023438 17.183594 9.089844 17.230469 C 9.277344 17.363281 9.472656 17.339844 9.671875 17.242188 C 9.886719 17.132812 10.101562 16.941406 10.3125 16.753906 L 10.316406 16.75 C 10.511719 16.582031 10.699219 16.414062 10.902344 16.285156 C 10.9375 16.261719 10.980469 16.273438 11 16.308594 L 11.300781 16.78125 C 11.320312 16.816406 11.3125 16.859375 11.277344 16.882812 C 11.121094 16.980469 10.953125 17.132812 10.78125 17.285156 L 10.777344 17.289062 C 10.476562 17.554688 10.171875 17.828125 9.832031 17.96875 C 9.484375 18.109375 9.105469 18.109375 8.6875 17.820312 L 8.488281 17.679688 C 7.980469 17.324219 7.550781 17.019531 7.160156 16.925781 C 6.789062 16.835938 6.449219 16.941406 6.105469 17.394531 C 6.078125 17.429688 6.03125 17.433594 6 17.410156 L 5.554688 17.066406 C 5.519531 17.042969 5.515625 16.996094 5.539062 16.960938 Z M 5.273438 11.851562 C 5.207031 11.851562 5.144531 11.808594 5.101562 11.742188 C 5.054688 11.675781 5.027344 11.578125 5.027344 11.476562 C 5.027344 11.371094 5.054688 11.273438 5.101562 11.207031 C 5.144531 11.140625 5.207031 11.097656 5.273438 11.097656 L 10.46875 11.097656 C 10.535156 11.097656 10.597656 11.140625 10.640625 11.207031 C 10.6875 11.273438 10.714844 11.371094 10.714844 11.476562 C 10.714844 11.578125 10.6875 11.675781 10.640625 11.742188 C 10.597656 11.808594 10.535156 11.851562 10.46875 11.851562 Z M 5.273438 14.113281 C 5.207031 14.113281 5.144531 14.070312 5.101562 14.003906 C 5.054688 13.933594 5.027344 13.839844 5.027344 13.734375 C 5.027344 13.628906 5.054688 13.535156 5.101562 13.46875 C 5.144531 13.398438 5.207031 13.359375 5.273438 13.359375 L 12.4375 13.359375 C 12.503906 13.359375 12.566406 13.398438 12.613281 13.46875 C 12.65625 13.535156 12.683594 13.628906 12.683594 13.734375 C 12.683594 13.839844 12.65625 13.933594 12.613281 14.003906 C 12.566406 14.070312 12.503906 14.113281 12.4375 14.113281 Z M 8.996094 7.214844 L 9.042969 8.492188 L 7.828125 8.492188 L 7.890625 7.339844 L 7.828125 4.5625 L 9.0625 4.5625 Z M 11.609375 4.496094 C 11.957031 4.496094 12.28125 4.550781 12.589844 4.660156 L 12.382812 5.625 L 12.304688 5.675781 C 12.199219 5.617188 12.078125 5.574219 11.941406 5.539062 C 11.804688 5.503906 11.679688 5.484375 11.5625 5.484375 C 11.316406 5.484375 11.140625 5.558594 11.03125 5.703125 C 10.921875 5.84375 10.867188 6.085938 10.867188 6.421875 C 10.867188 6.8125 10.929688 7.101562 11.054688 7.28125 C 11.179688 7.460938 11.375 7.550781 11.640625 7.550781 C 11.753906 7.550781 11.878906 7.539062 12.019531 7.515625 C 12.15625 7.496094 12.277344 7.464844 12.382812 7.421875 L 12.480469 7.484375 L 12.382812 8.441406 C 12.140625 8.519531 11.863281 8.558594 11.542969 8.558594 C 10.894531 8.558594 10.40625 8.386719 10.078125 8.050781 C 9.75 7.707031 9.585938 7.210938 9.585938 6.5625 C 9.585938 5.90625 9.761719 5.398438 10.113281 5.035156 C 10.46875 4.675781 10.964844 4.496094 11.609375 4.496094 Z M 15.859375 7.574219 L 15.925781 7.660156 L 15.855469 8.492188 L 13.097656 8.492188 L 13.160156 7.339844 L 13.097656 4.5625 L 15.902344 4.5625 L 15.96875 4.648438 L 15.890625 5.480469 L 14.308594 5.445312 L 14.296875 6.050781 L 15.523438 6.03125 L 15.589844 6.117188 L 15.515625 7.003906 L 14.269531 6.984375 L 14.265625 7.214844 L 14.277344 7.609375 Z M 20.039062 7.210938 L 20.089844 8.492188 L 18.769531 8.492188 L 17.671875 6.390625 L 17.597656 6.390625 L 17.59375 7.070312 L 17.640625 8.492188 L 16.539062 8.492188 L 16.601562 7.339844 L 16.539062 4.5625 L 17.859375 4.5625 L 18.957031 6.664062 L 19.03125 6.664062 L 18.996094 4.605469 L 20.105469 4.539062 Z M 22.351562 4.488281 C 22.734375 4.488281 23.113281 4.5625 23.488281 4.703125 L 23.292969 5.691406 L 23.125 5.765625 C 22.957031 5.660156 22.789062 5.578125 22.625 5.515625 C 22.457031 5.457031 22.324219 5.425781 22.226562 5.425781 C 22.132812 5.425781 22.058594 5.445312 22.003906 5.480469 C 21.953125 5.515625 21.921875 5.566406 21.921875 5.625 C 21.921875 5.703125 21.964844 5.769531 22.046875 5.824219 C 22.128906 5.875 22.269531 5.953125 22.460938 6.039062 C 22.683594 6.140625 22.875 6.234375 23.015625 6.320312 C 23.160156 6.40625 23.289062 6.527344 23.398438 6.679688 C 23.507812 6.832031 23.5625 7.019531 23.5625 7.242188 C 23.5625 7.488281 23.492188 7.714844 23.359375 7.910156 C 23.226562 8.109375 23.027344 8.273438 22.78125 8.386719 C 22.53125 8.503906 22.242188 8.566406 21.910156 8.566406 C 21.5 8.566406 21.070312 8.488281 20.617188 8.332031 L 20.792969 7.277344 L 20.914062 7.203125 C 21.101562 7.347656 21.300781 7.460938 21.507812 7.542969 C 21.71875 7.625 21.898438 7.664062 22.039062 7.664062 C 22.152344 7.664062 22.234375 7.644531 22.28125 7.609375 C 22.332031 7.570312 22.359375 7.523438 22.359375 7.464844 C 22.359375 7.378906 22.3125 7.308594 22.226562 7.25 C 22.144531 7.191406 22 7.117188 21.808594 7.035156 C 21.589844 6.9375 21.402344 6.84375 21.261719 6.757812 C 21.121094 6.671875 20.996094 6.550781 20.890625 6.398438 C 20.785156 6.25 20.734375 6.0625 20.734375 5.839844 C 20.734375 5.582031 20.804688 5.351562 20.9375 5.148438 C 21.074219 4.945312 21.269531 4.78125 21.511719 4.667969 C 21.757812 4.550781 22.039062 4.488281 22.351562 4.488281 Z M 26.863281 7.574219 L 26.929688 7.660156 L 26.859375 8.492188 L 24.101562 8.492188 L 24.164062 7.339844 L 24.101562 4.5625 L 26.90625 4.5625 L 26.972656 4.648438 L 26.894531 5.480469 L 25.3125 5.445312 L 25.300781 6.050781 L 26.527344 6.03125 L 26.59375 6.117188 L 26.519531 7.003906 L 25.277344 6.984375 L 25.269531 7.214844 L 25.28125 7.609375 Z M 26.109375 23.878906 L 24.933594 23.667969 L 24.34375 24.734375 C 24.339844 24.738281 24.335938 24.75 24.328125 24.753906 C 24.082031 25.058594 23.855469 25.050781 23.660156 24.890625 C 23.449219 24.71875 23.304688 24.347656 23.214844 24.101562 L 23.183594 24.011719 L 21.933594 21.648438 C 21.894531 21.570312 21.921875 21.480469 21.996094 21.445312 C 22.003906 21.441406 22.011719 21.4375 22.015625 21.4375 C 22.144531 21.394531 22.289062 21.304688 22.445312 21.1875 C 22.609375 21.066406 22.78125 20.910156 22.957031 20.753906 C 22.988281 20.726562 23.027344 20.710938 23.074219 20.714844 C 23.410156 20.722656 23.738281 20.695312 24.03125 20.597656 C 24.320312 20.5 24.585938 20.324219 24.8125 20.035156 C 24.863281 19.96875 24.957031 19.957031 25.019531 20.007812 C 25.035156 20.023438 25.050781 20.039062 25.058594 20.058594 L 26.503906 22.855469 L 26.628906 23.128906 C 26.632812 23.136719 26.636719 23.144531 26.636719 23.152344 C 26.695312 23.359375 26.707031 23.542969 26.636719 23.679688 C 26.558594 23.832031 26.40625 23.910156 26.144531 23.890625 C 26.140625 23.886719 26.125 23.882812 26.109375 23.878906 Z M 17.753906 23.667969 L 16.574219 23.878906 C 16.566406 23.882812 16.554688 23.882812 16.539062 23.882812 C 16.277344 23.902344 16.125 23.824219 16.046875 23.671875 C 15.976562 23.539062 15.988281 23.355469 16.046875 23.144531 L 16.054688 23.121094 L 16.179688 22.851562 L 17.625 20.050781 C 17.632812 20.03125 17.648438 20.015625 17.664062 20 C 17.730469 19.949219 17.820312 19.960938 17.871094 20.027344 C 18.09375 20.3125 18.359375 20.488281 18.652344 20.589844 C 18.949219 20.691406 19.273438 20.714844 19.609375 20.707031 C 19.652344 20.703125 19.6875 20.714844 19.726562 20.746094 C 19.898438 20.902344 20.074219 21.058594 20.238281 21.179688 C 20.394531 21.296875 20.539062 21.386719 20.667969 21.429688 L 20.6875 21.4375 C 20.761719 21.476562 20.789062 21.570312 20.75 21.640625 L 19.5 24.003906 L 19.464844 24.09375 C 19.375 24.339844 19.234375 24.707031 19.023438 24.882812 C 18.828125 25.039062 18.605469 25.050781 18.355469 24.742188 C 18.351562 24.734375 18.34375 24.734375 18.339844 24.722656 Z M 23.164062 13.707031 C 22.695312 13.238281 22.054688 12.949219 21.34375 12.949219 C 20.632812 12.949219 19.992188 13.238281 19.523438 13.707031 C 19.058594 14.175781 18.769531 14.820312 18.769531 15.535156 C 18.769531 16.25 19.058594 16.894531 19.523438 17.363281 C 19.992188 17.828125 20.632812 18.121094 21.34375 18.121094 C 22.054688 18.121094 22.695312 17.828125 23.164062 17.363281 C 23.628906 16.894531 23.917969 16.25 23.917969 15.535156 C 23.914062 14.824219 23.628906 14.175781 23.164062 13.707031 Z M 23.164062 13.707031 " />
                                                                </g>

                                                        </div>
                                                        <div class="fs-5 fw-bold">
                                                            {{ $licence->license_type }}
                                                        </div>
                                                    </div>

                                                    @php
                                                        $licenceAmountLocal =
                                                            $licence->amount_type == 'Price'
                                                                ? 'Rp.' . number_format($licence->local_amount)
                                                                : number_format($licence->local_amount) . '%';
                                                        $licenceAmountGlobal =
                                                            $licence->amount_type == 'Price'
                                                                ? 'Rp.' . number_format($licence->global_amount)
                                                                : number_format($licence->global_amount) . '%';
                                                    @endphp
                                                    <div class="d-flex flex-column mt-2">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="small text-secondary   ">Local</div>
                                                            <div class="small fw-bold">{{ $licenceAmountLocal }}</div>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="small text-secondary   ">Global</div>
                                                            <div class="small fw-bold">{{ $licenceAmountGlobal }}</div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                            <div class="row g-4 mt-1 mb-3">
                                <div class="col">
                                    <h5 class="fs-4">Local Zone</h5>
                                    <div class="d-flex align-items-center">


                                        <div class="me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                              </svg>
                                        </div>

                                        <div>
                                            {{ $song->local_zones }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Contributor & Credits</h3>
                        </div>
                        <div class="card-body">

                            @foreach ($song->songContributors as $contributor)
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-md rounded"
                                        style="width: 32px;height:32px;background-image: url('https://ui-avatars.com/api/?name={{ urlencode($contributor->user->name) }}&background=e53935&color=fff')"
                                        data-bs-toggle="tooltip" title="{{ $contributor->user->name }}">
                                    </span>
                                    <div class="d-flex flex-column">
                                        <div class="ms-2">{{ $contributor->user->name }}</div>
                                        <div class="ms-2 text-secondary small">{{ $contributor->role }}</div>
                                    </div>
                                    <div class="ms-4 small text-secondary">{{ $contributor->description }}</div>

                                    </div>
                                </div>
                            @endforeach

                            {{-- @if ($song->composers->count())
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
                            </div> --}}

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
