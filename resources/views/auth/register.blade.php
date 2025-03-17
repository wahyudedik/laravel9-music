@extends('layouts.guest')

@section('content')
    <div class="auth-card">
        <div class="brand-logo">MusicApp</div>

        <h4 class="text-center mb-4">Create an account</h4>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
                @error('name')
                    <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
                @error('username')
                    <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
                @error('email')
                    <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" required>
                @error('phone')
                    <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" name="password" class="form-control" required>
                    <span class="password-toggle"><i class="far fa-eye"></i></span>
                </div>
                @error('password')
                    <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <div class="position-relative">
                    <input type="password" name="password_confirmation" class="form-control" required>
                    <span class="password-toggle"><i class="far fa-eye"></i></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="text-center mt-4">
            <p class="mb-0 text-muted">Already have an account? <a href="{{ url('login') }}" class="link-primary">Login</a>
            </p>
        </div>

        <div class="text-center mt-3">
            <a href="{{ url('/') }}" class="link-secondary" style="font-size: 0.9rem;">
                <i class="fas fa-arrow-left me-1"></i> Back to home
            </a>
        </div>
    </div>
@endsection
