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
                    <form class="card" action="#" method="post" enctype="multipart/form-data">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Edit Song #{{ $id }}</h3>
                            <div class="card-actions">
                                <span class="badge bg-success">Active</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Song Title</div>
                                        <input type="text" class="form-control" name="title" value="Blinding Lights"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Artist</div>
                                        <select class="form-select" name="artist_id" required>
                                            <option value="">Select Artist</option>
                                            <option value="1" selected>The Weeknd</option>
                                            <option value="2">Dua Lipa</option>
                                            <option value="3">Justin Bieber</option>
                                            <option value="4">Lil Nas X</option>
                                            <option value="5">Doja Cat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Album</div>
                                        <select class="form-select" name="album_id" required>
                                            <option value="">Select Album</option>
                                            <option value="1" selected>After Hours</option>
                                            <option value="2">Future Nostalgia</option>
                                            <option value="3">Justice</option>
                                            <option value="4">MONTERO</option>
                                            <option value="5">Planet Her</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Genre</div>
                                        <select class="form-select" name="genre_id" required>
                                            <option value="">Select Genre</option>
                                            <option value="1" selected>Pop</option>
                                            <option value="2">Hip Hop</option>
                                            <option value="3">R&B</option>
                                            <option value="4">Electronic</option>
                                            <option value="5">Rock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Release Date</div>
                                        <input type="date" class="form-control" name="release_date" value="2020-11-29"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <div class="form-label required">Status</div>
                                        <select class="form-select" name="status" required>
                                            <option value="Active" selected>Active</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Composers</div>
                                        <select class="form-select" name="composers[]" multiple>
                                            <option value="1" selected>John Doe</option>
                                            <option value="2" selected>Jane Smith</option>
                                            <option value="3">Robert Johnson</option>
                                            <option value="4">Emily Davis</option>
                                            <option value="5">Michael Brown</option>
                                        </select>
                                        <div class="form-hint">You can select multiple composers</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-label">Description</div>
                                        <textarea class="form-control" name="description" rows="4">Blinding Lights is a song by Canadian singer the Weeknd. It was released on November 29, 2019, as the second single from his fourth studio album After Hours. The Weeknd wrote and produced the song with Max Martin and Oscar Holter, with Belly and Jason Quenneville receiving additional writing credits.</textarea>
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
                                            <img src="https://picsum.photos/200/200?random=1" class="rounded"
                                                width="100" height="100" alt="Cover Image">
                                            <div class="ms-3">
                                                <a href="#" class="btn btn-sm btn-outline-danger">
                                                    <i class="ti ti-trash me-1"></i>Remove
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-label">Upload New Cover Image</div>
                                        <input type="file" class="form-control" name="cover_image" accept="image/*">
                                        <div class="form-hint">Recommended size: 500x500px, max 2MB</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Current Audio File</div>
                                        <div class="d-flex align-items-center mt-2 mb-3">
                                            <audio controls class="w-100">
                                                <source src="#" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                        <div class="form-label">Upload New Audio File</div>
                                        <input type="file" class="form-control" name="audio_file" accept="audio/*">
                                        <div class="form-hint">Supported formats: MP3, WAV, FLAC. Max 10MB</div>
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
                                        <select class="form-select" name="license_type">
                                            <option value="standard">Standard</option>
                                            <option value="premium" selected>Premium</option>
                                            <option value="exclusive">Exclusive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">License Price (Rp)</div>
                                        <input type="number" class="form-control" name="license_price" value="150000">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="allow_covers" checked>
                                            <span class="form-check-label">Allow Cover Versions</span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="allow_commercial"
                                                checked>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Updating Song',
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
                        title: 'Song Updated Successfully',
                        text: 'The song information has been updated.',
                        confirmButtonColor: '#e53935'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('admin.songs.index') }}";
                        }
                    });
                }, 1500);
            });
        });
    </script>
@endsection
