@extends('layouts.app-admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Claim
                    </h2>
                    <div class="text-muted mt-1">Update claim information</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.claims.index') }}" class="btn btn-outline-secondary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left me-2"></i>
                            Back to Claims
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
                    <form action="{{ route('admin.claims.update', $claim) }}" method="POST" enctype="multipart/form-data"
                        class="card">
                        @csrf
                        @method('PUT')
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
                                            {{ old('user_id', $claim->user_id) == $user->id ? 'selected' : '' }}>
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
                                            {{ old('song_id', $claim->song_id) == $song->id ? 'selected' : '' }}>
                                            {{ $song->title }} - {{ $song->artist }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('song_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="pending" {{ old('status', $claim->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ old('status', $claim->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ old('status', $claim->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="4">{{ old('notes', $claim->notes) }}</textarea>
                                <small class="form-hint">Additional information about this claim</small>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-label">Current Document</div>
                                @if($claim->document)
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="avatar me-2 bg-primary-lt">
                                            <i class="ti ti-file-text text-primary"></i>
                                        </span>
                                        <div>
                                            <a href="{{ Storage::url($claim->document) }}" target="_blank">
                                                View current document
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-muted mb-3">No document attached</div>
                                @endif
                                
                                <label class="form-label">Replace Document</label>
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
                            <button type="submit" class="btn btn-primary">Update Claim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
