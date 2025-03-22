@extends('layouts.guest')

@section('content')
    <div class="auth-card">
        <div class="brand-logo text-center mb-4">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/icon1.png') }}" alt="Logo" width="150" height="50">
            </a>
        </div>
        <h4 class="text-center mb-4">Create your account</h4>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    <span class="password-toggle"><i class="far fa-eye"></i></span>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <div class="position-relative">
                    <input type="password" name="password_confirmation" class="form-control" required>
                    <span class="password-toggle"><i class="far fa-eye"></i></span>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
        </form>

        <div class="divider">
            <span>or</span>
        </div>

        <div class="d-grid gap-2 mb-4">
            <a href="#" class="btn btn-outline-secondary">
                <i class="fab fa-google me-2"></i>Continue with Google
            </a>
        </div>

        <div class="text-center">
            <p class="mb-0 text-muted">Already have an account? <a href="{{ route('login') }}" class="link-primary">Login</a></p>
        </div>
    </div>
@endsection
