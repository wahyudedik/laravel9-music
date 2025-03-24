@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Create New Claim
                    </h2>
                    <div class="text-muted mt-1">Submit a new song ownership claim</div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <form action="{{ route('admin.claims.store') }}" method="POST" enctype="multipart/form-data"
                        class="card">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Claim Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">User</label>
                                <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Song</label>
                                <select name="song_id" class="form-select @error('song_id') is-invalid @enderror">
                                    <option value="">Select Song</option>
                                    @foreach ($songs as $song)
                                        <option value="{{ $song->id }}"
                                            {{ old('song_id') == $song->id ? 'selected' : '' }}>
                                            {{ $song->title }} - {{ $song->artist }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('song_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Supporting Document</label>
                                <input type="file" name="document"
                                    class="form-control @error('document') is-invalid @enderror">
                                <small class="form-hint">Accepted formats: PDF, DOC, DOCX, JPG, JPEG, PNG (max 2MB)</small>
                                @error('document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.claims.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit Claim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
