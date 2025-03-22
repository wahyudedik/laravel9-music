<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Verifikasi Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Pengajuan Verifikasi Akun
                    </div>
                    <div class="card-body">
                        <form action="{{ route('verification.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipe Verifikasi</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="composer">Komposer</option>
                                    <option value="artist">Artis</option>
                                    <option value="cover">Pembuat Cover</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="document_ktp" class="form-label">Dokumen KTP</label>
                                <input type="file" name="document_ktp" id="document_ktp" class="form-control" accept="application/pdf,image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="document_npwp" class="form-label">Dokumen NPWP (Opsional)</label>
                                <input type="file" name="document_npwp" id="document_npwp" class="form-control" accept="application/pdf,image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">Ajukan Verifikasi</button>
                        </form>
                        </form>

                        @if (isset($message))
                            <div class="alert alert-success mt-3">
                                {{ $message }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
                                         <div class="mt-3">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                        </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>