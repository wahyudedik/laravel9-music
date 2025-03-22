@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Verifikasi</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>User</th>
                    <th>Tipe</th>
                    <th>KTP</th>
                    <th>NPWP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($verifications as $verification)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $verification->user->name }}</td>
                        <td>{{ $verification->type }}</td>
                        <td><a href="{{ asset('storage/' . $verification->document_ktp) }}" target="_blank">Lihat KTP</a></td>
                        <td>
                            @if($verification->document_npwp)
                                <a href="{{ asset('storage/' . $verification->document_npwp) }}" target="_blank">Lihat NPWP</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $verification->status }}</td>
                        <td>
                            @if($verification->status === 'pending')
                                <form action="{{ route('admin.verifications.approve', $verification->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>
                                <form action="{{ route('admin.verifications.reject', $verification->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            @else
                                {{ $verification->status }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
                             <div class="mt-3">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection