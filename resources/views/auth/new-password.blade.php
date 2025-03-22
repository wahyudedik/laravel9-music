@extends('layouts.guest')

@section('content')
    <div class="auth-card">

        <div class="icon-circle bg-primary bg-opacity-10">
            <i class="fas fa-lock-open text-primary fa-2x"></i>
        </div>

        <h4 class="text-center mb-3">Reset Password</h4>

        <p class="text-center text-muted mb-4">
            Create a new secure password for your account.
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required>
                    <span class="input-group-text">
                        <i class="far fa-eye password-toggle" style="cursor: pointer;"></i>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        required>
                    <span class="input-group-text">
                        <i class="far fa-eye password-toggle" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Reset Password
                </button>
            </div>
        </form>

        
    </div>

    <script>
        // Perbaikan untuk password toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.password-toggle');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    // Dapatkan input password (perlu naik ke parent dulu, lalu cari input)
                    const inputGroup = this.closest('.input-group');
                    const passwordInput = inputGroup.querySelector(
                        'input[type="password"], input[type="text"]');

                    // Toggle tipe input
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' :
                        'password';
                    passwordInput.setAttribute('type', type);

                    // Ganti ikon
                    this.className = type === 'password' ? 'far fa-eye password-toggle' :
                        'far fa-eye-slash password-toggle';
                });
            });
        });
    </script>
@endsection
