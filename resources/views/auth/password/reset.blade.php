@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 25rem;">
        <h3 class="text-center mb-3">Reset Password</h3>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>
        </form>
        <div class="mt-3 text-center">
            <div class="d-flex justify-content-between w-100">
                <small><a class="text-decoration-none" href="{{ url('login') }}"><- Kembali</a> </small>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection