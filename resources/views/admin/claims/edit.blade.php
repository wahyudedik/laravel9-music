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
                        <a href="{{ route('admin.claims.index') }}"
                            class="btn btn-outline-secondary d-none d-sm-inline-block">
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
                                <select name="user_id" id="user_id"
                                    class="selectpicker  form-control  @error('user_id') is-invalid @enderror"
                                    data-live-search="true">
                                    <option value="">Select User</option>
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Song</label>

                                <select name="song_id" id="song_id"
                                    class="selectpicker  form-control  @error('song_id') is-invalid @enderror"
                                    data-live-search="true">
                                    <option value="">Select Song</option>
                                </select>
                                @error('song_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="pending"
                                        {{ old('status', $claim->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved"
                                        {{ old('status', $claim->status) == 'approved' ? 'selected' : '' }}>Approved
                                    </option>
                                    <option value="rejected"
                                        {{ old('status', $claim->status) == 'rejected' ? 'selected' : '' }}>Rejected
                                    </option>
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
                                @if ($claim->document)
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
@push('styles')
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

    <style>
        .bootstrap-select>.dropdown-toggle {
            height: 48.4px;
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
        $(document).ready(function() {
            function fetchUsers(search = "") {
                $.ajax({
                    url: "/admin/data/users",
                    type: "GET",
                    data: {
                        search: search,
                        limit: 10
                    }, // Adjust limit as needed
                    dataType: "json",
                    success: function(data) {
                        var userSelect = $("#user_id");
                        userSelect.empty();
                        userSelect.append('<option value="">Select a user</option>');

                        $.each(data, function(index, user) {
                            let selected = user.id == "{{ old('user_id', $claim->user_id) }}" ?
                                "selected" : "";
                            userSelect.append('<option value="' + user.id + '" ' + selected +
                                '>' + user.name + ' (' + user.roleName + ')</option>');
                        });

                        userSelect.selectpicker("refresh");
                    }
                });
            }

            // Load initial user when the select is opened
            $("#user_id").on("shown.bs.select", function() {
                if ($(this).children("option").length === 1) { // Avoid reloading if already loaded
                    fetchUsers();
                }
            });

            // Search users dynamically
            $(".bs-searchbox input").on("keyup", function() {
                let searchQuery = $(this).val();
                fetchUsers(searchQuery);
            });

            // Preload selected user if editing
            fetchUsers();
        });
    </script>
    <script>
        $(document).ready(function() {
            function fetchSongs(search = "") {
                $.ajax({
                    url: "/admin/data/songs", // Your backend API endpoint
                    type: "GET",
                    data: {
                        search: search,
                        limit: 20
                    }, // Limit the number of results
                    dataType: "json",
                    success: function(data) {
                        var songSelect = $("#song_id");
                        songSelect.empty();
                        songSelect.append('<option value="">Select a song</option>');

                        $.each(data, function(index, song) {
                            let selected = song.id == "{{ old('song_id', $claim->song_id) }}" ?
                                "selected" : "";
                            songSelect.append('<option value="' + song.id + '" ' + selected +
                                '>' + song.title + ' - ' + song.artist + '</option>');
                        });

                        songSelect.selectpicker("refresh"); // Refresh Bootstrap Select
                    }
                });
            }

            // Load initial songs when select is opened
            $("#song_id").on("shown.bs.select", function() {
                if ($(this).children("option").length === 1) { // Avoid unnecessary reloads
                    fetchSongs();
                }
            });

            // Fetch songs dynamically as the user types in search
            $(".bs-searchbox input").on("keyup", function() {
                let searchQuery = $(this).val();
                fetchSongs(searchQuery);
            });

            // Preload selected song if editing
            fetchSongs();


        });
    </script>
@endsection
