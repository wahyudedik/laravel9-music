@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 25rem;">
        <h3 class="text-center mb-3">Update Password</h3>

        <!-- Tampilkan pesan error -->
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Tampilkan pesan sukses -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control" required >
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ubah Password</button>
        </form>
        <div class="mt-3 text-center">
            <div class="d-flex justify-content-between w-100">
                <small><a class="text-decoration-none" href="{{ url('/') }}"><- Home</a> </small>
                <small><a class="text-decoration-none" href="{{ url('/login') }}">Login</a> </small>
            </div>
        </div>

    </div>
</div>
@endsection
