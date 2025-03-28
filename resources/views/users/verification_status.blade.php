@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Account</div>
                        <h2 class="page-title">Status Verifikasi Akun</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary d-sm-none btn-icon">
                                <i class="ti ti-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-id-badge me-2 text-primary"></i>Detail Verifikasi
                                </h3>
                            </div>
                            <div class="card-body">
                                @if (!$verification)
                                    <div class="empty">
                                        <div class="empty-img">
                                            <span class="avatar avatar-xl bg-secondary-lt">
                                                <i class="ti ti-file-x" style="font-size: 2rem;"></i>
                                            </span>
                                        </div>
                                        <p class="empty-title">Belum Ada Pengajuan Verifikasi</p>
                                        <p class="empty-subtitle text-muted">
                                            Anda belum mengajukan verifikasi akun. Verifikasi akun diperlukan untuk
                                            mengakses fitur-fitur tertentu.
                                        </p>
                                        <div class="empty-action">
                                            <a href="{{ route('verification.form') }}" class="btn btn-primary">
                                                <i class="ti ti-plus me-1"></i> Ajukan Verifikasi
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-4 text-center mb-4 mb-md-0">
                                            @if ($verification->status == 'pending')
                                                <span class="avatar avatar-xl bg-warning-lt mb-3">
                                                    <i class="ti ti-hourglass text-warning" style="font-size: 2rem;"></i>
                                                </span>
                                                <h4 class="mt-3">Menunggu Persetujuan</h4>
                                                <span class="badge bg-warning">{{ ucfirst($verification->status) }}</span>
                                            @elseif($verification->status == 'approved')
                                                <span class="avatar avatar-xl bg-success-lt mb-3">
                                                    <i class="ti ti-check text-success" style="font-size: 2rem;"></i>
                                                </span>
                                                <h4 class="mt-3">Disetujui</h4>
                                                <span class="badge bg-success">{{ ucfirst($verification->status) }}</span>
                                            @elseif($verification->status == 'rejected')
                                                <span class="avatar avatar-xl bg-danger-lt mb-3">
                                                    <i class="ti ti-x text-danger" style="font-size: 2rem;"></i>
                                                </span>
                                                <h4 class="mt-3">Ditolak</h4>
                                                <span class="badge bg-danger">{{ ucfirst($verification->status) }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="datagrid">
                                                <div class="datagrid-item">
                                                    <div class="datagrid-title">Tipe Verifikasi</div>
                                                    <div class="datagrid-content">
                                                        <span
                                                            class="badge bg-primary-lt">{{ ucfirst($verification->type) }}</span>
                                                    </div>
                                                </div>
                                                <div class="datagrid-item">
                                                    <div class="datagrid-title">Tanggal Pengajuan</div>
                                                    <div class="datagrid-content">
                                                        {{ $verification->created_at->format('d M Y H:i') }}</div>
                                                </div>
                                                <div class="datagrid-item">
                                                    <div class="datagrid-title">Terakhir Diperbarui</div>
                                                    <div class="datagrid-content">
                                                        {{ $verification->updated_at->format('d M Y H:i') }}</div>
                                                </div>
                                                <div class="datagrid-item">
                                                    <div class="datagrid-title">Dokumen KTP</div>
                                                    <div class="datagrid-content">
                                                        <a href="{{ asset('storage/' . $verification->document_ktp) }}"
                                                            target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="ti ti-file me-1"></i> Lihat Dokumen
                                                        </a>
                                                    </div>
                                                </div>
                                                @if ($verification->document_npwp)
                                                    <div class="datagrid-item">
                                                        <div class="datagrid-title">Dokumen NPWP</div>
                                                        <div class="datagrid-content">
                                                            <a href="{{ asset('storage/' . $verification->document_npwp) }}"
                                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                                <i class="ti ti-file me-1"></i> Lihat Dokumen
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-text mt-4 mb-4">Status Informasi</div>

                                    @if ($verification->status == 'rejected')
                                        <div class="alert alert-danger" role="alert">
                                            <div class="d-flex">
                                                <div>
                                                    <i class="ti ti-alert-triangle icon alert-icon"></i>
                                                </div>
                                                <div>
                                                    <h4 class="alert-title">Pengajuan Anda Ditolak</h4>
                                                    <div class="text-muted">Silahkan ajukan kembali dengan dokumen yang
                                                        valid.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 text-center">
                                            @if ($verification->type == 'cover')
                                                <a href="{{ route('verification.form') }}" class="btn btn-primary">
                                                    <i class="ti ti-refresh me-1"></i> Ajukan Ulang Verifikasi Cover
                                                </a>
                                            @elseif($verification->type == 'artist')
                                                <button type="button" class="btn btn-primary" id="btnAjukanUlangArtist">
                                                    <i class="ti ti-refresh me-1"></i> Ajukan Ulang Verifikasi Artist
                                                </button>
                                            @elseif($verification->type == 'composer')
                                                <button type="button" class="btn btn-primary" id="btnAjukanUlangComposer">
                                                    <i class="ti ti-refresh me-1"></i> Ajukan Ulang Verifikasi Composer
                                                </button>
                                            @endif
                                        </div>
                                    @elseif($verification->status == 'approved')
                                        <div class="alert alert-success" role="alert">
                                            <div class="d-flex">
                                                <div>
                                                    <i class="ti ti-check icon alert-icon"></i>
                                                </div>
                                                <div>
                                                    <h4 class="alert-title">Selamat! Akun Anda Telah Terverifikasi</h4>
                                                    <div class="text-muted">Anda sekarang dapat mengakses semua fitur
                                                        sebagai {{ ucfirst($verification->type) }}.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="card card-sm">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <span class="avatar bg-primary-lt me-3">
                                                                    <i class="ti ti-upload"></i>
                                                                </span>
                                                                <div>
                                                                    <div class="font-weight-medium">Upload Karya</div>
                                                                    <div class="text-muted small">Bagikan karya Anda</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card card-sm">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <span class="avatar bg-primary-lt me-3">
                                                                    <i class="ti ti-coin"></i>
                                                                </span>
                                                                <div>
                                                                    <div class="font-weight-medium">Royalti</div>
                                                                    <div class="text-muted small">Dapatkan penghasilan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card card-sm">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <span class="avatar bg-primary-lt me-3">
                                                                    <i class="ti ti-chart-bar"></i>
                                                                </span>
                                                                <div>
                                                                    <div class="font-weight-medium">Statistik</div>
                                                                    <div class="text-muted small">Pantau performa</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                @if ($verification->type != 'artist' && !($verification->type == 'composer' && $verification->status == 'approved'))
                                                    <div class="mt-4">
                                                        <button type="button" class="btn btn-primary"
                                                            id="btnUpgradeArtist">
                                                            <i class="ti ti-arrow-up-circle me-1"></i> Upgrade ke
                                                            Verifikasi Artist
                                                        </button>
                                                    </div>
                                                @elseif ($verification->type == 'artist' && $verification->status == 'approved')
                                                    <div class="mt-4">
                                                        <button type="button" class="btn btn-primary"
                                                            id="btnUpgradeComposer">
                                                            <i class="ti ti-arrow-up-circle me-1"></i> Upgrade ke
                                                            Verifikasi Composer
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-info" role="alert">
                                            <div class="d-flex">
                                                <div>
                                                    <i class="ti ti-hourglass icon alert-icon"></i>
                                                </div>
                                                <div>
                                                    <h4 class="alert-title">Pengajuan Sedang Diproses</h4>
                                                    <div class="text-muted">Mohon tunggu persetujuan dari admin. Proses ini
                                                        biasanya memakan waktu 1-3 hari kerja.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress mt-4">
                                            <div class="progress-bar progress-bar-indeterminate bg-primary"></div>
                                        </div>
                                        <div class="text-center text-muted mt-3">
                                            <small>Tim kami sedang memeriksa dokumen Anda</small>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                        <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
                                    </a>
                                    @if (!$verification || $verification->status == 'rejected')
                                        <a href="{{ route('verification.form') }}" class="btn btn-primary">
                                            <i class="ti ti-id me-1"></i>
                                            {{ $verification && $verification->status == 'rejected' ? 'Ajukan Ulang' : 'Ajukan Verifikasi' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ti ti-info-circle me-2 text-primary"></i>Informasi Verifikasi
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h4>Manfaat Verifikasi</h4>
                                    <ul class="text-muted">
                                        <li class="mb-2">
                                            <span class="badge bg-primary-lt me-1"><i class="ti ti-check"></i></span>
                                            Akses ke fitur khusus kreator
                                        </li>
                                        <li class="mb-2">
                                            <span class="badge bg-primary-lt me-1"><i class="ti ti-check"></i></span>
                                            Monetisasi karya musik Anda
                                        </li>
                                        <li class="mb-2">
                                            <span class="badge bg-primary-lt me-1"><i class="ti ti-check"></i></span>
                                            Perlindungan hak cipta
                                        </li>
                                        <li class="mb-2">
                                            <span class="badge bg-primary-lt me-1"><i class="ti ti-check"></i></span>
                                            Tampil di halaman kreator terverifikasi
                                        </li>
                                    </ul>
                                </div>

                                <div class="mb-3">
                                    <h4>Status Verifikasi</h4>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="badge bg-warning-lt">
                                                        <i class="ti ti-hourglass"></i>
                                                    </span>
                                                </div>
                                                <div class="col text-truncate">
                                                    <div class="d-block text-muted text-truncate mt-n1">Menunggu
                                                        Persetujuan</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="badge bg-success-lt">
                                                        <i class="ti ti-check"></i>
                                                    </span>
                                                </div>
                                                <div class="col text-truncate">
                                                    <div class="d-block text-muted text-truncate mt-n1">Disetujui</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="badge bg-danger-lt">
                                                        <i class="ti ti-x"></i>
                                                    </span>
                                                </div>
                                                <div class="col text-truncate">
                                                    <div class="d-block text-muted text-truncate mt-n1">Ditolak</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="alert alert-info" role="alert">
                                        <div class="d-flex">
                                            <div>
                                                <i class="ti ti-help-circle icon alert-icon"></i>
                                            </div>
                                            <div>
                                                <h4 class="alert-title">Butuh Bantuan?</h4>
                                                <div class="text-muted">Jika Anda memiliki pertanyaan tentang proses
                                                    verifikasi, silahkan hubungi tim dukungan kami.</div>
                                                <div class="mt-2">
                                                    <a href="#" class="btn btn-sm btn-info">
                                                        <i class="ti ti-messages me-1"></i> Hubungi Kami
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Forms for SweetAlert2 -->
    <form id="formArtistVerification" action="{{ route('verification.submit.artist') }}" method="POST"
        enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="hidden" name="type" value="artist">
        <input type="hidden" name="status" value="pending">
        <input type="file" id="artistKtpFile" name="document_ktp" accept="image/*,application/pdf" required>
    </form>

    <form id="formComposerVerification" action="{{ route('verification.submit.composer') }}" method="POST"
        enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="hidden" name="type" value="composer">
        <input type="hidden" name="status" value="pending">
        <input type="file" id="composerKtpFile" name="document_ktp" accept="image/*,application/pdf" required>
        <input type="file" id="composerNpwpFile" name="document_npwp" accept="image/*,application/pdf" required>
    </form>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validasi untuk semua input file
            const validateFileSize = (file) => {
                if (file && file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File terlalu besar',
                        text: 'Ukuran file maksimal adalah 2MB',
                    });
                    return false;
                }
                return true;
            };

            // Fungsi untuk menangani pengajuan ulang verifikasi Artist
            const btnAjukanUlangArtist = document.getElementById('btnAjukanUlangArtist');
            if (btnAjukanUlangArtist) {
                btnAjukanUlangArtist.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Ajukan Ulang Verifikasi Artist',
                        html: `
                        <div class="mb-3">
                            <label class="form-label text-start d-block">Dokumen KTP</label>
                            <input type="file" id="swal-ktp-artist" class="form-control" accept="image/*,application/pdf">
                            <small class="text-muted text-start d-block">Format yang didukung: PDF, JPG, PNG, GIF (Max 2MB)</small>
                        </div>
                    `,
                        showCancelButton: true,
                        confirmButtonText: 'Ajukan Ulang',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#6c757d',
                        didOpen: () => {
                            const fileInput = document.getElementById('swal-ktp-artist');
                            fileInput.addEventListener('change', function() {
                                validateFileSize(this.files[0]);
                            });
                        },
                        preConfirm: () => {
                            const fileInput = document.getElementById('swal-ktp-artist');
                            if (!fileInput.files[0]) {
                                Swal.showValidationMessage('Dokumen KTP wajib diisi');
                                return false;
                            }
                            if (!validateFileSize(fileInput.files[0])) {
                                return false;
                            }
                            return true;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const fileInput = document.getElementById('swal-ktp-artist');
                            const artistKtpFile = document.getElementById('artistKtpFile');

                            // Transfer file dari SweetAlert ke form tersembunyi
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(fileInput.files[0]);
                            artistKtpFile.files = dataTransfer.files;

                            // Submit form
                            document.getElementById('formArtistVerification').submit();

                            // Tampilkan loading
                            Swal.fire({
                                title: 'Mengirim Pengajuan',
                                html: 'Mohon tunggu...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        }
                    });
                });
            }

            // Fungsi untuk menangani pengajuan ulang verifikasi Composer
            const btnAjukanUlangComposer = document.getElementById('btnAjukanUlangComposer');
            if (btnAjukanUlangComposer) {
                btnAjukanUlangComposer.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Ajukan Ulang Verifikasi Composer',
                        html: `
                        <div class="mb-3">
                            <label class="form-label text-start d-block">Dokumen KTP</label>
                            <input type="file" id="swal-ktp-composer" class="form-control" accept="image/*,application/pdf">
                            <small class="text-muted text-start d-block">Format yang didukung: PDF, JPG, PNG, GIF (Max 2MB)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-start d-block">Dokumen NPWP</label>
                            <input type="file" id="swal-npwp-composer" class="form-control" accept="image/*,application/pdf">
                            <small class="text-muted text-start d-block">Format yang didukung: PDF, JPG, PNG, GIF (Max 2MB)</small>
                        </div>
                    `,
                        showCancelButton: true,
                        confirmButtonText: 'Ajukan Ulang',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#6c757d',
                        didOpen: () => {
                            const ktpInput = document.getElementById('swal-ktp-composer');
                            const npwpInput = document.getElementById('swal-npwp-composer');

                            ktpInput.addEventListener('change', function() {
                                validateFileSize(this.files[0]);
                            });

                            npwpInput.addEventListener('change', function() {
                                validateFileSize(this.files[0]);
                            });
                        },
                        preConfirm: () => {
                            const ktpInput = document.getElementById('swal-ktp-composer');
                            const npwpInput = document.getElementById('swal-npwp-composer');

                            if (!ktpInput.files[0]) {
                                Swal.showValidationMessage('Dokumen KTP wajib diisi');
                                return false;
                            }

                            if (!npwpInput.files[0]) {
                                Swal.showValidationMessage('Dokumen NPWP wajib diisi');
                                return false;
                            }

                            if (!validateFileSize(ktpInput.files[0]) || !validateFileSize(
                                    npwpInput.files[0])) {
                                return false;
                            }

                            return true;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const ktpInput = document.getElementById('swal-ktp-composer');
                            const npwpInput = document.getElementById('swal-npwp-composer');

                            const composerKtpFile = document.getElementById('composerKtpFile');
                            const composerNpwpFile = document.getElementById('composerNpwpFile');

                            // Transfer file KTP dari SweetAlert ke form tersembunyi
                            let dataTransfer = new DataTransfer();
                            dataTransfer.items.add(ktpInput.files[0]);
                            composerKtpFile.files = dataTransfer.files;

                            // Transfer file NPWP dari SweetAlert ke form tersembunyi
                            dataTransfer = new DataTransfer();
                            dataTransfer.items.add(npwpInput.files[0]);
                            composerNpwpFile.files = dataTransfer.files;

                            // Submit form
                            document.getElementById('formComposerVerification').submit();

                            // Tampilkan loading
                            Swal.fire({
                                title: 'Mengirim Pengajuan',
                                html: 'Mohon tunggu...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        }
                    });
                });
            }

            // Fungsi untuk menangani upgrade ke Artist
            const btnUpgradeArtist = document.getElementById('btnUpgradeArtist');
            if (btnUpgradeArtist) {
                btnUpgradeArtist.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Upgrade ke Verifikasi Artist',
                        html: `
                        <div class="mb-3">
                            <label class="form-label text-start d-block">Dokumen KTP</label>
                            <input type="file" id="swal-ktp-upgrade-artist" class="form-control" accept="image/*,application/pdf">
                            <small class="text-muted text-start d-block">Format yang didukung: PDF, JPG, PNG, GIF (Max 2MB)</small>
                        </div>
                    `,
                        showCancelButton: true,
                        confirmButtonText: 'Ajukan Upgrade',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#6c757d',
                        didOpen: () => {
                            const fileInput = document.getElementById(
                            'swal-ktp-upgrade-artist');
                            fileInput.addEventListener('change', function() {
                                validateFileSize(this.files[0]);
                            });
                        },
                        preConfirm: () => {
                            const fileInput = document.getElementById(
                            'swal-ktp-upgrade-artist');
                            if (!fileInput.files[0]) {
                                Swal.showValidationMessage('Dokumen KTP wajib diisi');
                                return false;
                            }
                            if (!validateFileSize(fileInput.files[0])) {
                                return false;
                            }
                            return true;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const fileInput = document.getElementById('swal-ktp-upgrade-artist');
                            const artistKtpFile = document.getElementById('artistKtpFile');

                            // Transfer file dari SweetAlert ke form tersembunyi
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(fileInput.files[0]);
                            artistKtpFile.files = dataTransfer.files;

                            // Submit form
                            document.getElementById('formArtistVerification').submit();

                            // Tampilkan loading
                            Swal.fire({
                                title: 'Mengirim Pengajuan',
                                html: 'Mohon tunggu...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        }
                    });
                });
            }

            // Fungsi untuk menangani upgrade ke Composer
            const btnUpgradeComposer = document.getElementById('btnUpgradeComposer');
            if (btnUpgradeComposer) {
                btnUpgradeComposer.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Upgrade ke Verifikasi Composer',
                        html: `
                        <div class="mb-3">
                            <label class="form-label text-start d-block">Dokumen KTP</label>
                            <input type="file" id="swal-ktp-upgrade-composer" class="form-control" accept="image/*,application/pdf">
                            <small class="text-muted text-start d-block">Format yang didukung: PDF, JPG, PNG, GIF (Max 2MB)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-start d-block">Dokumen NPWP</label>
                            <input type="file" id="swal-npwp-upgrade-composer" class="form-control" accept="image/*,application/pdf">
                            <small class="text-muted text-start d-block">Format yang didukung: PDF, JPG, PNG, GIF (Max 2MB)</small>
                        </div>
                    `,
                        showCancelButton: true,
                        confirmButtonText: 'Ajukan Upgrade',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#e53935',
                        cancelButtonColor: '#6c757d',
                        didOpen: () => {
                            const ktpInput = document.getElementById(
                                'swal-ktp-upgrade-composer');
                            const npwpInput = document.getElementById(
                                'swal-npwp-upgrade-composer');

                            ktpInput.addEventListener('change', function() {
                                validateFileSize(this.files[0]);
                            });

                            npwpInput.addEventListener('change', function() {
                                validateFileSize(this.files[0]);
                            });
                        },
                        preConfirm: () => {
                            const ktpInput = document.getElementById(
                                'swal-ktp-upgrade-composer');
                            const npwpInput = document.getElementById(
                                'swal-npwp-upgrade-composer');

                            if (!ktpInput.files[0]) {
                                Swal.showValidationMessage('Dokumen KTP wajib diisi');
                                return false;
                            }

                            if (!npwpInput.files[0]) {
                                Swal.showValidationMessage('Dokumen NPWP wajib diisi');
                                return false;
                            }

                            if (!validateFileSize(ktpInput.files[0]) || !validateFileSize(
                                    npwpInput.files[0])) {
                                return false;
                            }

                            return true;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const ktpInput = document.getElementById('swal-ktp-upgrade-composer');
                            const npwpInput = document.getElementById('swal-npwp-upgrade-composer');

                            const composerKtpFile = document.getElementById('composerKtpFile');
                            const composerNpwpFile = document.getElementById('composerNpwpFile');

                            // Transfer file KTP dari SweetAlert ke form tersembunyi
                            let dataTransfer = new DataTransfer();
                            dataTransfer.items.add(ktpInput.files[0]);
                            composerKtpFile.files = dataTransfer.files;

                            // Transfer file NPWP dari SweetAlert ke form tersembunyi
                            dataTransfer = new DataTransfer();
                            dataTransfer.items.add(npwpInput.files[0]);
                            composerNpwpFile.files = dataTransfer.files;

                            // Submit form
                            document.getElementById('formComposerVerification').submit();

                            // Tampilkan loading
                            Swal.fire({
                                title: 'Mengirim Pengajuan',
                                html: 'Mohon tunggu...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        }
                    });
                });
            }
        });
    </script>
@endsection
