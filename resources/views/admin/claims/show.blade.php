@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Claim Details
                    </h2>
                    <div class="text-muted mt-1">Viewing claim #{{ $claim->id }}</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.claims.index') }}"
                            class="btn btn-outline-secondary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to Claims
                        </a>
                        <a href="{{ route('admin.claims.edit', $claim) }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-edit me-2"></i>
                            Edit Claim
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Claim Information</h3>
                            <div class="card-actions">
                                <span
                                    class="badge {{ $claim->status == 'pending'
                                        ? 'bg-warning text-dark'
                                        : ($claim->status == 'approved'
                                            ? 'bg-success'
                                            : 'bg-danger') }}">
                                    {{ ucfirst($claim->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Claim ID</label>
                                        <div class="form-control-plaintext">#{{ $claim->id }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Created Date</label>
                                        <div class="form-control-plaintext">{{ $claim->created_at->format('d M Y, H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">User</label>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url(https://ui-avatars.com/api/?name={{ urlencode($claim->user->name) }}&background=e53935&color=fff)"></span>
                                            <div>
                                                <div>{{ $claim->user->name }}</div>
                                                <div class="text-muted small">{{ $claim->user->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Last Updated</label>
                                        <div class="form-control-plaintext">{{ $claim->updated_at->format('d M Y, H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted">Song Information</label>
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-lg me-3"
                                        style="background-image: url({{ isset($claim->song->cover_url) ? $claim->song->cover_url : 'https://picsum.photos/100/100?random=' . rand(1, 100) }})"></span>
                                    <div>
                                        @if (isset($claim->song) && $claim->song)
                                            <div class="h3 mb-0">{{ $claim->song->title }}</div>
                                            <div class="text-muted small">
                                                <span
                                                    class="badge bg-blue-lt me-1">{{ $claim->song->genre ?? 'Unknown Genre' }}</span>
                                                <span>{{ $claim->song->duration ?? '0' }} min</span>
                                            </div>
                                        @else
                                            <div class="h3 mb-0">Unknown Song</div>
                                            <div class="text-muted">Song data not available</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted">User Information</label>
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-lg me-3"
                                        style="background-image: url({{ isset($claim->user->profile_picture) ? $claim->user->profile_picture : 'https://picsum.photos/100/100?random=' . rand(1, 100) }})"></span>
                                    <div>
                                        @if (isset($claim->user) && $claim->user)
                                            <div class="h3 mb-0">{{ $claim->user->name }}</div>
                                            <div class="text-muted">{{ $claim->user->email }}</div>
                                        @else
                                            <div class="h3 mb-0">Unknown User</div>
                                            <div class="text-muted">User data not available</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if ($claim->document)
                                <div class="mb-3">
                                    <label class="form-label text-muted">Supporting Document</label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <span class="avatar bg-primary-lt">
                                                <i class="ti ti-file-text text-primary"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <div>Supporting Document</div>
                                            <div class="text-muted small">
                                                {{ pathinfo($claim->document, PATHINFO_EXTENSION) }} file
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="{{ Storage::url($claim->document) }}" target="_blank"
                                                class="btn btn-outline-primary">
                                                <i class="ti ti-download me-1"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($claim->notes)
                                <div class="mb-3">
                                    <label class="form-label text-muted">Notes</label>
                                    <div class="form-control-plaintext">{{ $claim->notes }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Actions</h3>
                                </div>
                                <div class="card-body">
                                    @if ($claim->status == 'pending')
                                        <div class="mb-3">
                                            <form action="{{ route('admin.claims.approve', $claim) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success w-100 mb-2">
                                                    <i class="ti ti-check me-2"></i> Approve Claim
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.claims.reject', $claim) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-danger w-100">
                                                    <i class="ti ti-x me-2"></i> Reject Claim
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($claim->status == 'approved')
                                        <div class="mb-3">
                                            <form action="{{ route('admin.claims.unclaim', $claim) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning w-100 mb-2">
                                                    <i class="ti ti-ban me-2"></i> Unclaim Song
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <a href="{{ route('admin.claims.edit', $claim) }}"
                                            class="btn btn-outline-primary w-100 mb-2">
                                            <i class="ti ti-edit me-2"></i> Edit Claim
                                        </a>

                                        <button type="button" class="btn btn-outline-danger w-100"
                                            onclick="confirmDelete()">
                                            <i class="ti ti-trash me-2"></i> Delete Claim
                                        </button>

                                        <form id="delete-form" action="{{ route('admin.claims.destroy', $claim) }}"
                                            method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Claim Timeline</h3>
                                </div>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded bg-primary-lt">
                                                    <i class="ti ti-plus text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="text-body">Claim Created</div>
                                                <div class="text-muted">{{ $claim->created_at->format('d M Y, H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($claim->status != 'pending')
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div
                                                        class="avatar avatar-rounded {{ $claim->status == 'approved' ? 'bg-success-lt' : 'bg-danger-lt' }}">
                                                        <i
                                                            class="ti {{ $claim->status == 'approved' ? 'ti-check text-success' : 'ti-x text-danger' }}"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="text-body">Claim {{ ucfirst($claim->status) }}</div>
                                                    <div class="text-muted">{{ $claim->updated_at->format('d M Y, H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete() {
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
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
@endsection
