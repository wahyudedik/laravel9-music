@extends('layouts.guest')

@section('content')
    <div class="auth-card">

        <div class="icon-circle bg-primary bg-opacity-10">
            <i class="fas fa-envelope text-primary fa-2x"></i>
        </div>

        <h4 class="text-center mb-3">Verify Your Email</h4>

        <p class="text-center text-muted mb-4">
            Thanks for signing up! Before getting started, please verify your email address by clicking the button below.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success mb-4">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-check-circle fa-lg"></i>
                    </div>
                    <div>
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('verification.resend') }}" class="mb-3">
            @csrf
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i> Resend Verification Email
                </button>
            </div>
        </form>

        <div class="d-grid mb-4">
            <a href="{{ route('login') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Login
            </a>
        </div>

        <form action="{{ route('logout', ['role' => 'User']) }}" method="POST">
            @csrf
            <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>
                Logout</button>
        </form>
    </div>
@endsection
