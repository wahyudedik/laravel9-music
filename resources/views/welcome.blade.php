<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Cool Poll</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Music Cool Poll</a>
            <div class="d-flex">
                @auth
                    <a href="{{ url('user/dashboard') }}" class="btn btn-outline-light me-2">User Dashboard</a>
                    @if (Auth::user()->hasRole(['Super Admin', 'Admin']))
                        <a href="{{ url('adminmusic/dashboard') }}" class="btn btn-outline-warning me-2">Admin Dashboard</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="fw-bold">Streaming Musik Tanpa Batas</h1>
            <p class="lead">Temukan musik favoritmu, dengarkan kapan saja, di mana saja.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">Mulai Sekarang</a>
        </div>
    </div>

    <!-- Card Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="https://picsum.photos/300/200?random=1" class="card-img-top" alt="Music">
                    <div class="card-body">
                        <h5 class="card-title">Musik Terbaru</h5>
                        <p class="card-text">Nikmati koleksi musik terbaru dari berbagai genre.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="https://picsum.photos/300/200?random=2" class="card-img-top" alt="Playlist">
                    <div class="card-body">
                        <h5 class="card-title">Buat Playlist</h5>
                        <p class="card-text">Kumpulkan lagu favoritmu dalam satu daftar putar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="https://picsum.photos/300/200?random=3" class="card-img-top" alt="Artist">
                    <div class="card-body">
                        <h5 class="card-title">Dukung Artist</h5>
                        <p class="card-text">Temukan musisi baru dan dukung karya mereka.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <img src="https://picsum.photos/300/200?random=4" class="card-img-top" alt="Cover Creator">
                    <div class="card-body">
                        <h5 class="card-title">Cover Creator</h5>
                        <p class="card-text">Dengarkan berbagai cover lagu dari kreator berbakat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2025 Music Cool Poll. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

