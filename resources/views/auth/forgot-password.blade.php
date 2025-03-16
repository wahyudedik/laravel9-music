@extends('layouts.guest')

@section('content')
    <div class="auth-card">
        <div class="brand-logo">MusicApp</div>

        <div class="icon-circle bg-primary bg-opacity-10">
            <i class="fas fa-key text-primary fa-2x"></i>
        </div>

        <h4 class="text-center mb-3">Forgot Password</h4>

        <p class="text-center text-muted mb-4">
            Enter your email address and we'll send you a link to reset your password.
        </p>

        @if (session('status'))
            <div class="alert alert-success mb-4">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-check-circle fa-lg"></i>
                    </div>
                    <div>
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                    autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i> Send Password Reset Link
                </button>
            </div>
        </form>

        <div class="text-center">
            <a href="{{ route('login') }}" class="link-primary">
                <i class="fas fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </div>
@endsection
