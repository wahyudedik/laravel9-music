@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Ticketing</div>
                        <h2 class="page-title">Detail Klaim Hak Cipta</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ route('ticket.my-claims') }}"
                                class="btn btn-outline-primary d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                            <button class="btn btn-primary d-none d-sm-inline-block" onclick="window.print();">
                                <i class="ti ti-printer me-2"></i>Cetak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        @php
                            $statuses = ['pending', 'approved', 'rejected'];
                            $status = $statuses[array_rand($statuses)];
                            $claimId = 'CLM-' . str_pad($id, 5, '0', STR_PAD_LEFT);
                            $songs = [
                                'Menunggu Kamu',
                                'Bintang di Surga',
                                'Kau Adalah',
                                'Separuh Nafas',
                                'Bukan Rayuan Gombal',
                                'Aku dan Dirimu',
                                'Semua Tentang Kita',
                                'Laskar Pelangi',
                                'Kita Selamanya',
                                'Memori Indah',
                            ];
                            $song = $songs[$id % 10];
                            $submittedDate = now()->subDays(rand(10, 60));
                            $updatedDate = $status != 'pending' ? now()->subDays(rand(1, 9)) : null;
                        @endphp

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Klaim #{{ $claimId }}
                                    @if ($status == 'pending')
                                        <span class="badge bg-yellow ms-2">Pending</span>
                                    @elseif ($status == 'approved')
                                        <span class="badge bg-green ms-2">Approved</span>
                                    @else
                                        <span class="badge bg-red ms-2">Rejected</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="datagrid">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">ID Klaim</div>
                                        <div class="datagrid-content">{{ $claimId }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Status</div>
                                        <div class="datagrid-content">
                                            @if ($status == 'pending')
                                                <span class="badge bg-yellow">Pending</span>
                                            @elseif ($status == 'approved')
                                                <span class="badge bg-green">Approved</span>
                                            @else
                                                <span class="badge bg-red">Rejected</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Tanggal Pengajuan</div>
                                        <div class="datagrid-content">{{ $submittedDate->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Terakhir Diperbarui</div>
                                        <div class="datagrid-content">
                                            {{ $updatedDate ? $updatedDate->format('d M Y, H:i') : 'Belum diperbarui' }}
                                        </div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Jenis Klaim</div>
                                        <div class="datagrid-content">
                                            <span class="badge bg-blue-lt">Composer</span>
                                        </div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Diajukan Oleh</div>
                                        <div class="datagrid-content">{{ auth()->user()->name }}</div>
                                    </div>
                                </div>

                                <div class="hr-text mt-4 mb-3">Informasi Lagu</div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Judul Lagu</label>
                                            <div class="form-control-plaintext">{{ $song }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Album</label>
                                            <div class="form-control-plaintext">Album {{ ceil($id / 3) }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tahun Rilis</label>
                                            <div class="form-control-plaintext">{{ 2010 + ($id % 13) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Link Referensi</label>
                                            <div class="form-control-plaintext">
                                                <a href="#"
                                                    target="_blank">https://music-platform.com/song/{{ strtolower(str_replace(' ', '-', $song)) }}</a>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Bukti Kepemilikan</label>
                                            <div class="form-control-plaintext">
                                                <a href="#" class="btn btn-sm btn-outline-primary">
                                                    <i class="ti ti-file-download me-1"></i>
                                                    bukti-kepemilikan.pdf
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Klaim</label>
                                    <div class="form-control-plaintext">
                                        Saya adalah pencipta lagu "{{ $song }}" yang dirilis pada tahun
                                        {{ 2010 + ($id % 13) }}.
                                        Lagu ini telah terdaftar di Direktorat Jenderal Kekayaan Intelektual dengan nomor
                                        pendaftaran
                                        EC{{ rand(10000, 99999) }}. Saya mengajukan klaim ini untuk memastikan hak cipta
                                        saya
                                        terlindungi di platform Playlist Music.
                                    </div>
                                </div>

                                @if ($status == 'approved')
                                    <div class="alert alert-success mt-4">
                                        <div class="d-flex">
                                            <div>
                                                <i class="ti ti-check me-2"></i>
                                            </div>
                                            <div>
                                                <h4>Klaim Disetujui</h4>
                                                <div class="text-muted">Klaim hak cipta Anda telah disetujui pada
                                                    {{ $updatedDate->format('d M Y, H:i') }}. Anda sekarang terdaftar
                                                    sebagai pemilik hak cipta untuk lagu ini di platform kami.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-danger" onclick="confirmUnclaim('{{ $song }}', {{ $id }})">
                                            <i class="ti ti-x me-2"></i>Batalkan Klaim (Unclaim)
                                        </button>
                                    </div>
                                @elseif ($status == 'rejected')
                                    <div class="alert alert-danger mt-4">
                                        <div class="d-flex">
                                            <div>
                                                <i class="ti ti-alert-triangle me-2"></i>
                                            </div>
                                            <div>
                                                <h4>Klaim Ditolak</h4>
                                                <div class="text-muted">Klaim hak cipta Anda ditolak pada
                                                    {{ $updatedDate->format('d M Y, H:i') }}. Silakan periksa alasan
                                                    penolakan di bawah ini.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label class="form-label">Alasan Penolakan</label>
                                        <div class="form-control-plaintext text-danger">
                                            Dokumen bukti kepemilikan yang Anda berikan tidak cukup untuk memverifikasi
                                            klaim hak cipta.
                                            Silakan ajukan kembali dengan dokumen resmi dari lembaga hak cipta atau bukti
                                            kepemilikan yang lebih kuat.
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <a href="{{ route('ticket.copyright') }}" class="btn btn-primary">
                                            <i class="ti ti-plus me-2"></i>Ajukan Klaim Baru
                                        </a>
                                    </div>
                                @else
                                    <div class="alert alert-info mt-4">
                                        <div class="d-flex">
                                            <div>
                                                <i class="ti ti-hourglass me-2"></i>
                                            </div>
                                            <div>
                                                <h4>Klaim Sedang Diproses</h4>
                                                <div class="text-muted">Klaim hak cipta Anda sedang dalam proses
                                                    peninjauan. Proses ini biasanya membutuhkan waktu 3-5 hari kerja.</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Riwayat Aktivitas</h3>
                            </div>
                            <div class="card-body">
                                <ul class="timeline">
                                    <li class="timeline-event">
                                        <div class="timeline-event-icon bg-primary-lt">
                                            <i class="ti ti-file-plus"></i>
                                        </div>
                                        <div class="timeline-event-card">
                                            <div class="timeline-event-date">{{ $submittedDate->format('d M Y') }}</div>
                                            <h4 class="timeline-event-title">Klaim Diajukan</h4>
                                            <p class="text-muted">{{ auth()->user()->name }} mengajukan klaim hak cipta
                                                untuk lagu "{{ $song }}".</p>
                                        </div>
                                    </li>

                                    @if ($status != 'pending')
                                        <li class="timeline-event">
                                            <div
                                                class="timeline-event-icon {{ $status == 'approved' ? 'bg-green-lt' : 'bg-red-lt' }}">
                                                <i class="ti ti-{{ $status == 'approved' ? 'check' : 'x' }}"></i>
                                            </div>
                                            <div class="timeline-event-card">
                                                <div class="timeline-event-date">{{ $updatedDate->format('d M Y') }}</div>
                                                <h4 class="timeline-event-title">
                                                    Klaim {{ $status == 'approved' ? 'Disetujui' : 'Ditolak' }}
                                                </h4>
                                                <p class="text-muted">
                                                    @if ($status == 'approved')
                                                        Admin menyetujui klaim hak cipta Anda. Anda sekarang terdaftar
                                                        sebagai pemilik hak cipta untuk lagu ini.
                                                    @else
                                                        Admin menolak klaim hak cipta Anda karena dokumen bukti kepemilikan
                                                        tidak mencukupi.
                                                    @endif
                                                </p>
                                            </div>
                                        </li>
                                    @endif

                                    @if ($status == 'approved')
                                        <li class="timeline-event">
                                            <div class="timeline-event-icon bg-blue-lt">
                                                <i class="ti ti-certificate"></i>
                                            </div>
                                            <div class="timeline-event-card">
                                                <div class="timeline-event-date">
                                                    {{ $updatedDate->addDays(1)->format('d M Y') }}</div>
                                                <h4 class="timeline-event-title">Sertifikat Diterbitkan</h4>
                                                <p class="text-muted">Sertifikat kepemilikan hak cipta digital telah
                                                    diterbitkan untuk lagu "{{ $song }}".</p>
                                                <div class="mt-2">
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="ti ti-download me-1"></i>
                                                        Unduh Sertifikat
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
