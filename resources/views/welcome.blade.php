@extends('layouts.landing-page')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">Musik untuk semua</h1>
            <p class="hero-subtitle">Jutaan lagu. Tanpa kartu kredit.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold">DAPATKAN PLAYLIST MUSIC
                GRATIS</a>
        </div>
    </div>

    <!-- Trending Songs Section -->
    <div class="container my-5">
        <h2 class="section-title">Lagu Trending</h2>
        <div class="row">
            @for ($i = 1; $i <= 8; $i++)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://picsum.photos/300/300?random={{ $i }}" class="card-img-top"
                            alt="Music Cover">
                        <div class="card-body">
                            <h5 class="card-title">Judul Lagu Trending #{{ $i }}</h5>
                            <p class="card-text">Artis Populer</p>
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Made For You Section -->
    <div class="container my-5">
        <h2 class="section-title">Dibuat untuk Kamu</h2>
        <div class="row">
            @for ($i = 9; $i <= 12; $i++)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://picsum.photos/300/300?random={{ $i }}" class="card-img-top"
                            alt="Playlist Cover">
                        <div class="card-body">
                            <h5 class="card-title">Daily Mix {{ $i - 8 }}</h5>
                            <p class="card-text">Dibuat khusus untukmu berdasarkan preferensimu</p>
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Recently Played Section -->
    <div class="container my-5">
        <h2 class="section-title">Baru Saja Diputar</h2>
        <div class="row">
            @for ($i = 13; $i <= 16; $i++)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://picsum.photos/300/300?random={{ $i }}" class="card-img-top"
                            alt="Album Cover">
                        <div class="card-body">
                            <h5 class="card-title">Album Populer #{{ $i - 12 }}</h5>
                            <p class="card-text">Artis Terkenal</p>
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Categories Section -->
    <div class="container my-5">
        <h2 class="section-title">Jelajahi Kategori</h2>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="category-card" style="background-color: #e51e2f;">
                    <h5>Pop</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="category-card" style="background-color: #8c1932;">
                    <h5>Rock</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="category-card" style="background-color: #b92b27;">
                    <h5>Hip Hop</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="category-card" style="background-color: #ff4b4b;">
                    <h5>Indie</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="category-card" style="background-color: #c41a29;">
                    <h5>Jazz</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="category-card" style="background-color: #ff3a4b;">
                    <h5>Electronic</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="category-card" style="background-color: #a71324;">
                    <h5>R&B</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="category-card" style="background-color: #d82738;">
                    <h5>Classical</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- New Releases Section -->
    <div class="container my-5">
        <h2 class="section-title">Rilis Terbaru</h2>
        <div class="row">
            @for ($i = 17; $i <= 20; $i++)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="https://picsum.photos/300/300?random={{ $i }}" class="card-img-top"
                            alt="New Release Cover">
                        <div class="card-body">
                            <h5 class="card-title">Album Baru #{{ $i - 16 }}</h5>
                            <p class="card-text">Artis Baru</p>
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-links">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h5>PERUSAHAAN</h5>
                        <ul>
                            <li><a href="#">Tentang</a></li>
                            <li><a href="#">Pekerjaan</a></li>
                            <li><a href="#">For the Record</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h5>KOMUNITAS</h5>
                        <ul>
                            <li><a href="#">Untuk Artis</a></li>
                            <li><a href="#">Pengembang</a></li>
                            <li><a href="#">Periklanan</a></li>
                            <li><a href="#">Investor</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h5>TAUTAN BERGUNA</h5>
                        <ul>
                            <li><a href="#">Dukungan</a></li>
                            <li><a href="#">Aplikasi Seluler</a></li>
                            <li><a href="#">Player Web</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h5>SOSIAL MEDIA</h5>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright text-center">
                <p>&copy; 2025 Playlist Music Indonesia</p>
            </div>
        </div>
    </footer>
@endsection
