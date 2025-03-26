@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Ticketing</div>
                        <h2 class="page-title">Riwayat Klaim Hak Cipta</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <a href="{{ route('ticket.copyright') }}" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-plus me-2"></i>Ajukan Klaim Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Klaim Saya</h3>
                        <div class="card-actions">
                            <div class="btn-group">
                                <button class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="ti ti-filter me-1"></i>Filter
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Semua Status</a>
                                    <a class="dropdown-item" href="#">Pending</a>
                                    <a class="dropdown-item" href="#">Approved</a>
                                    <a class="dropdown-item" href="#">Rejected</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-muted">
                                Tampilkan
                                <div class="mx-2 d-inline-block">
                                    <select class="form-select form-select-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                entri
                            </div>
                            <div class="ms-auto text-muted">
                                Cari:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" placeholder="Cari...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Klaim</th>
                                    <th>Judul Lagu</th>
                                    <th>Jenis Klaim</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th class="w-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statuses = ['pending', 'approved', 'rejected'];
                                    $claimTypes = ['composer', 'artist', 'publisher', 'copyright_owner'];
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
                                @endphp

                                @for ($i = 1; $i <= 10; $i++)
                                    @php
                                        $status = $statuses[array_rand($statuses)];
                                        $claimType = $claimTypes[array_rand($claimTypes)];
                                        $song = $songs[$i - 1];
                                        $date = now()->subDays(rand(1, 60))->format('d M Y');
                                        $claimId = 'CLM-' . str_pad($i, 5, '0', STR_PAD_LEFT);
                                    @endphp
                                    <tr>
                                        <td>{{ $claimId }}</td>
                                        <td>{{ $song }}</td>
                                        <td>
                                            @if ($claimType == 'composer')
                                                <span class="badge bg-blue-lt">Composer</span>
                                            @elseif ($claimType == 'artist')
                                                <span class="badge bg-purple-lt">Artist</span>
                                            @elseif ($claimType == 'publisher')
                                                <span class="badge bg-teal-lt">Publisher</span>
                                            @else
                                                <span class="badge bg-indigo-lt">Copyright Owner</span>
                                            @endif
                                        </td>
                                        <td>{{ $date }}</td>
                                        <td>
                                            @if ($status == 'pending')
                                                <span class="badge bg-yellow">Pending</span>
                                            @elseif ($status == 'approved')
                                                <span class="badge bg-green">Approved</span>
                                            @else
                                                <span class="badge bg-red">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="{{ route('ticket.claim.detail', $i) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="ti ti-eye"></i>
                                                    Detail
                                                </a>
                                                @if ($status == 'approved')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="confirmUnclaim('{{ $song }}', {{ $i }})">
                                                        <i class="ti ti-x"></i>
                                                        Unclaim
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">Menampilkan <span>1</span> sampai <span>10</span> dari <span>16</span>
                            entri</p>
                        <ul class="pagination m-0 ms-auto">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <i class="ti ti-chevron-left"></i>
                                    prev
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    next
                                    <i class="ti ti-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmUnclaim(songTitle, claimId) {
            Swal.fire({
                title: 'Konfirmasi Unclaim',
                html: `<div class="text-center mb-3">
                    <i class="ti ti-alert-triangle text-danger" style="font-size: 3rem;"></i>
                </div>
                <p>Anda yakin ingin membatalkan klaim hak cipta untuk lagu <strong>${songTitle}</strong>?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan dan Anda harus mengajukan klaim baru jika diperlukan di masa mendatang.</p>`,
                icon: false,
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="ti ti-x me-2"></i>Ya, Batalkan Klaim',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-secondary ms-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Here you would normally make an AJAX call to your backend
                    // For demo purposes, we'll just show a success message
                    Swal.fire({
                        title: 'Berhasil!',
                        text: `Klaim untuk lagu "${songTitle}" telah dibatalkan.`,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#206bc4',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        // Optionally refresh the page or update the UI
                        // window.location.reload();
                    });
                }
            });
        }
    </script>
@endsection
