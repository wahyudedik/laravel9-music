@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Ticketing</div>
                    <h2 class="page-title">Claim Hak Cipta</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('ticket.my-claims') }}" class="btn btn-outline-primary d-none d-sm-inline-block">
                            <i class="ti ti-list me-2"></i>Riwayat Klaim Saya
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Pengajuan Klaim Hak Cipta</h3>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label required">Jenis Klaim</label>
                                    <select class="form-select" name="claim_type" required>
                                        <option value="">Pilih jenis klaim</option>
                                        <option value="composer">Composer (Pencipta Lagu)</option>
                                        <option value="artist">Artist (Penyanyi/Band)</option>
                                        <option value="publisher">Publisher (Penerbit Musik)</option>
                                        <option value="copyright_owner">Pemilik Hak Cipta</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label required">Judul Lagu</label>
                                    <input type="text" class="form-control" name="song_title" placeholder="Masukkan judul lagu" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">Album (opsional)</label>
                                    <input type="text" class="form-control" name="album_title" placeholder="Masukkan judul album">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label required">Tahun Rilis</label>
                                    <input type="number" class="form-control" name="release_year" placeholder="Contoh: 2023" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label required">Deskripsi Klaim</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Jelaskan alasan klaim dan bukti kepemilikan hak cipta" required></textarea>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label required">Bukti Kepemilikan</label>
                                    <input type="file" class="form-control" name="ownership_proof" required>
                                    <small class="form-hint">Upload dokumen resmi yang membuktikan kepemilikan hak cipta (PDF, JPG, PNG. Maks 5MB)</small>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">Link Referensi (opsional)</label>
                                    <input type="url" class="form-control" name="reference_link" placeholder="https://example.com/your-song">
                                    <small class="form-hint">Link ke platform musik atau situs resmi yang menunjukkan kepemilikan</small>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agreement" required>
                                        <span class="form-check-label">Saya menyatakan bahwa informasi yang diberikan adalah benar dan saya memiliki hak untuk mengajukan klaim ini</span>
                                    </label>
                                </div>
                                
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-send me-2"></i>Ajukan Klaim
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Penting</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info mb-3">
                                <div class="d-flex">
                                    <div>
                                        <i class="ti ti-info-circle me-2"></i>
                                    </div>
                                    <div>
                                        <h4>Proses Verifikasi</h4>
                                        <p>Pengajuan klaim hak cipta akan diverifikasi oleh tim kami dalam waktu 3-5 hari kerja. Anda akan menerima notifikasi melalui email dan dashboard akun.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning mb-3">
                                <div class="d-flex">
                                    <div>
                                        <i class="ti ti-alert-triangle me-2"></i>
                                    </div>
                                    <div>
                                        <h4>Peringatan</h4>
                                        <p>Pengajuan klaim palsu dapat berakibat pada penangguhan akun dan tindakan hukum. Pastikan Anda memiliki bukti yang valid.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <h4>Dokumen yang Diterima sebagai Bukti:</h4>
                            <ul>
                                <li>Sertifikat hak cipta resmi</li>
                                <li>Kontrak dengan label rekaman atau penerbit musik</li>
                                <li>Dokumen pendaftaran dengan lembaga hak cipta</li>
                                <li>Bukti kepemilikan lainnya yang sah secara hukum</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
