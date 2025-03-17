@extends('layouts.guest')

@section('content')
    <div class="auth-card">
        <div class="brand-logo">MusicApp</div>

        <div class="icon-circle bg-primary bg-opacity-10">
            <i class="fas fa-lock-open text-primary fa-2x"></i>
        </div>

        <h4 class="text-center mb-3">Reset Password</h4>

        <p class="text-center text-muted mb-4">
            Create a new secure password for your account.
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $request->email) }}"
                    required autofocus readonly>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">New Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                <span class="password-toggle"><i class="far fa-eye"></i></span>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4 position-relative">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    required>
                <span class="password-toggle"><i class="far fa-eye"></i></span>
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Reset Password
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
