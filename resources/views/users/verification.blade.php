@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Akun</div>
                        <h2 class="page-title">Pengajuan Verifikasi Akun</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ route('user.dashboard') }}"
                                class="btn btn-outline-secondary d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            @php
                                $verificationType = 'cover'; // Default type
                                $formTitle = 'Pengajuan Verifikasi Akun';
                                $formSubtitle = 'Verifikasi Pertama';

                                if (
                                    isset($existingVerification) &&
                                    $existingVerification &&
                                    $existingVerification->status == 'rejected'
                                ) {
                                    $verificationType = $existingVerification->type;
                                    $formTitle = 'Pengajuan Ulang Verifikasi ' . ucfirst($verificationType);
                                    $formSubtitle = 'Pengajuan Ulang';
                                }
                            @endphp

                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-id me-2 text-primary"></i>{{ $formTitle }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <form
                                    action="{{ $verificationType == 'cover'
                                        ? route('verification.submit')
                                        : ($verificationType == 'artist'
                                            ? route('verification.submit.artist')
                                            : route('verification.submit.composer')) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="type_display" class="form-label">Tipe Verifikasi</label>
                                        <div class="form-control-plaintext" id="type_display">
                                            <span class="badge bg-primary">{{ ucfirst($verificationType) }}</span>
                                        </div>
                                        <small
                                            class="form-text text-{{ isset($existingVerification) && $existingVerification && $existingVerification->status == 'rejected' ? 'danger' : 'muted' }}">
                                            <i
                                                class="ti ti-{{ isset($existingVerification) && $existingVerification && $existingVerification->status == 'rejected' ? 'alert-circle' : 'info-circle' }} me-1"></i>{{ $formSubtitle }}
                                        </small>
                                        <input type="hidden" name="type" value="{{ $verificationType }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="document_ktp" class="form-label">Dokumen KTP</label>
                                        <input type="file" name="document_ktp" id="document_ktp" class="form-control"
                                            accept="application/pdf,image/*" required>
                                        <small class="form-text text-muted">
                                            <i class="ti ti-info-circle me-1"></i>Format yang diterima: PDF, JPG, PNG (Maks.
                                            2MB)
                                        </small>
                                    </div>

                                    @if ($verificationType == 'composer')
                                        <div class="mb-3">
                                            <label for="document_npwp" class="form-label">Dokumen NPWP</label>
                                            <input type="file" name="document_npwp" id="document_npwp"
                                                class="form-control" accept="application/pdf,image/*" required>
                                            <small class="form-text text-muted">
                                                <i class="ti ti-info-circle me-1"></i>Format yang diterima: PDF, JPG, PNG
                                                (Maks. 2MB)
                                            </small>
                                        </div>
                                    @endif

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-send me-2"></i>Ajukan Verifikasi
                                        </button>
                                    </div>
                                </form>

                                @if (isset($message))
                                    <div class="alert alert-success mt-3">
                                        <i class="ti ti-check me-2"></i>{{ $message }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <h4 class="alert-title">
                                            <i class="ti ti-alert-triangle me-2"></i>Terjadi kesalahan
                                        </h4>
                                        <ul class="mt-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h3 class="card-title">
                                    <i class="ti ti-info-circle me-2 text-primary"></i>Informasi Verifikasi
                                </h3>
                                <p>Verifikasi akun diperlukan untuk mengakses fitur-fitur berikut:</p>
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-center mb-2">
                                        <span class="avatar avatar-xs bg-primary-lt me-2">
                                            <i class="ti ti-upload"></i>
                                        </span>
                                        <span>Mengunggah karya cover musik</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-2">
                                        <span class="avatar avatar-xs bg-primary-lt me-2">
                                            <i class="ti ti-coin"></i>
                                        </span>
                                        <span>Mendapatkan royalti dari karya yang diunggah</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="avatar avatar-xs bg-primary-lt me-2">
                                            <i class="ti ti-badge"></i>
                                        </span>
                                        <span>Mendapatkan badge verifikasi pada profil</span>
                                    </li>
                                </ul>
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
        document.addEventListener('DOMContentLoaded', function() {
            // File input preview functionality could be added here
            const fileInput = document.getElementById('document_ktp');
            fileInput.addEventListener('change', function() {
                // Validate file size
                if (this.files[0] && this.files[0].size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File terlalu besar',
                        text: 'Ukuran file maksimal adalah 2MB',
                    });
                    this.value = '';
                }
            });

            // Add validation for NPWP document if it exists
            const npwpInput = document.getElementById('document_npwp');
            if (npwpInput) {
                npwpInput.addEventListener('change', function() {
                    // Validate file size
                    if (this.files[0] && this.files[0].size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File terlalu besar',
                            text: 'Ukuran file maksimal adalah 2MB',
                        });
                        this.value = '';
                    }
                });
            }

            // Validasi untuk semua input file
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.files[0] && this.files[0].size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File terlalu besar',
                            text: 'Ukuran file maksimal adalah 2MB',
                        });
                        this.value = '';
                    }
                });
            });
        });
    </script>
@endsection
