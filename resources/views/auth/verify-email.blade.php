@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">

        <div class="card shadow-lg p-4" style="max-width: 700px; width: 100%;">
            <div class="card-body text-center">
                <h3 class="mb-3">Verifikasi Email</h3>

                <p class="text-muted"> {!! session('message') ??
                    'Kami telah mengirim email verifikasi ke <strong>' .
                        session('email') .
                        '</strong>. Silakan periksa kotak masuk Anda dan klik tautan untuk mengaktifkan akun.' !!} </p>



                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('dashboard'))
                    <div class="my-3 text-center">
                        <div class="d-flex justify-content-between w-100">
                            <a href="{{ url('user/dashboard') }}" class="btn btn-primary w-100"> User Dashboard </a>
                        </div>
                    </div>
                @else
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <button type="submit" class="btn btn-primary w-100">Kirim Ulang Email Verifikasi</button>
                    </form>

                    <p class="mt-3 text-muted">Jika tidak menerima email, periksa folder spam atau coba kirim ulang.</p>
                @endif





                <div class="mt-3 text-center">
                    <div class="d-flex justify-content-between w-100">
                        <small><a class="text-decoration-none" href="{{ url('/') }}"> Home</a> </small>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
