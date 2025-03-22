@extends('layouts.guest')

@section('content')
    <div class="auth-card">
        <div class="brand-logo text-center mb-4">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/icon1.png') }}" alt="Logo" width="150" height="50">
            </a>
        </div>
        <h4 class="text-center mb-4">Login to your account</h4>

        <form method="POST" action="{{ route('login') }}"> 
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
                @error('email')
                    <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <span class="password-toggle"><i class="far fa-eye"></i></span>
                </div>
                @error('password')
                    <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-muted" for="remember" style="font-size: 0.9rem;">
                        Remember me
                    </label>
                </div>
                <a href="{{ route('password.reset') }}" class="link-primary" style="font-size: 0.9rem;">Forgot password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="divider">
            <span>or</span>
        </div>

        <div class="d-grid gap-2">
            <a href="#" class="btn btn-outline-secondary">
                <i class="fab fa-google me-2"></i>Continue with Google
            </a>
        </div>

        <div class="text-center mt-4">
            <p class="mb-0 text-muted">Don't have an account? <a href="{{ url('register') }}" class="link-primary">Sign
                    up</a></p>
        </div>
    </div>
@endsection
