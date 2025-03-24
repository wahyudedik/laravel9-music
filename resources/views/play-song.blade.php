<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Song - Playlist Music</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <!-- Tabler Core CSS & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e53935;
            --secondary-color: #f8f9fa;
            --text-color: #212529;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .player-container {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .album-cover {
            width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .album-cover:hover {
            transform: scale(1.02);
        }

        .player-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .control-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .play-btn {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: white;
        }

        .progress-container {
            width: 100%;
            height: 6px;
            background-color: #e0e0e0;
            border-radius: 3px;
            margin: 20px 0;
            cursor: pointer;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            background-color: var(--primary-color);
            border-radius: 3px;
            width: 30%;
            position: relative;
        }

        .progress-handle {
            width: 16px;
            height: 16px;
            background-color: var(--primary-color);
            border-radius: 50%;
            position: absolute;
            right: -8px;
            top: -5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .song-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .song-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .song-artist {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .time-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .related-songs {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .related-song-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s ease;
        }

        .related-song-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .related-song-item:last-child {
            border-bottom: none;
        }

        .related-song-cover {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
        }

        .related-song-info {
            flex: 1;
        }

        .related-song-title {
            font-weight: 600;
            margin-bottom: 2px;
        }

        .related-song-artist {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .related-song-duration {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .song-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #6c757d;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            color: var(--primary-color);
        }

        .action-btn i {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .action-btn span {
            font-size: 0.8rem;
        }

        .lyrics-container {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-top: 20px;
        }

        .lyrics-text {
            white-space: pre-line;
            line-height: 1.8;
            color: #495057;
        }

        .comment-container {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-top: 20px;
        }

        .comment-item {
            display: flex;
            margin-bottom: 20px;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .comment-content {
            flex: 1;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .comment-author {
            font-weight: 600;
        }

        .comment-time {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .comment-text {
            color: #495057;
            margin-bottom: 5px;
        }

        .comment-actions {
            display: flex;
            gap: 15px;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .comment-action {
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .comment-action:hover {
            color: var(--primary-color);
        }

        .comment-form {
            display: flex;
            margin-top: 20px;
        }

        .comment-input {
            flex: 1;
            border-radius: 20px;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            margin-right: 10px;
        }

        .comment-submit {
            border-radius: 20px;
        }

        @media (max-width: 768px) {
            .player-controls {
                gap: 10px;
            }

            .control-btn {
                width: 40px;
                height: 40px;
            }

            .play-btn {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md navbar-light d-print-none sticky-top bg-white shadow-sm">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/') }}" class="d-flex align-items-center">
                        <img src="{{ asset('img/favicon.png') }}" class="me-2" alt="Music Icon"
                            style="width: 20px; height: 20px;">
                        <span>Playlist Music</span>
                    </a>
                </h1>

                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item d-none d-md-flex me-3">
                        <a href="{{ url('/') }}" class="nav-link px-0" data-bs-toggle="tooltip" title="Home">
                            <i class="ti ti-home"></i>
                        </a>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                            <span class="avatar avatar-sm"
                                style="background-image: url(https://ui-avatars.com/api/?name=User&background=e53935&color=fff)"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrapper">
            <div class="container-xl py-4">
                <div class="row g-4">
                    <!-- Main Player Section -->
                    <div class="col-lg-8">
                        <div class="player-container p-4">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="https://picsum.photos/500/500?random={{ $id }}"
                                        alt="Album Cover" class="album-cover mb-3">

                                    <div class="song-actions">
                                        <div class="action-btn">
                                            <i class="ti ti-heart"></i>
                                            <span>Like</span>
                                        </div>
                                        <div class="action-btn">
                                            <i class="ti ti-share"></i>
                                            <span>Share</span>
                                        </div>
                                        <div class="action-btn">
                                            <i class="ti ti-playlist"></i>
                                            <span>Add</span>
                                        </div>
                                        <div class="action-btn">
                                            <i class="ti ti-download"></i>
                                            <span>Download</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="song-info">
                                        <h2 class="song-title">
                                            {{ ['Blinding Lights', 'Save Your Tears', 'Levitating', 'Stay', 'Industry Baby'][$id % 5] }}
                                        </h2>
                                        <p class="song-artist">
                                            {{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande'][$id % 5] }}
                                        </p>
                                        <div class="badge bg-primary mb-3">
                                            {{ ['Pop', 'Rock', 'Hip Hop', 'Electronic', 'R&B'][$id % 5] }}</div>
                                    </div>

                                    <div class="progress-container">
                                        <div class="progress-bar">
                                            <div class="progress-handle"></div>
                                        </div>
                                    </div>
                                    <div class="time-info">
                                        <span>1:23</span>
                                        <span>3:45</span>
                                    </div>

                                    <div class="player-controls">
                                        <div class="control-btn">
                                            <i class="ti ti-player-skip-back"></i>
                                        </div>
                                        <div class="control-btn">
                                            <i class="ti ti-player-track-prev"></i>
                                        </div>
                                        <div class="control-btn play-btn">
                                            <i class="ti ti-player-play"></i>
                                        </div>
                                        <div class="control-btn">
                                            <i class="ti ti-player-track-next"></i>
                                        </div>
                                        <div class="control-btn">
                                            <i class="ti ti-player-skip-forward"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-volume me-2"></i>
                                            <div class="progress-container" style="width: 100px; margin: 0;">
                                                <div class="progress-bar" style="width: 70%;">
                                                    <div class="progress-handle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="control-btn" style="width: 40px; height: 40px;">
                                                <i class="ti ti-repeat"></i>
                                            </div>
                                            <div class="control-btn" style="width: 40px; height: 40px;">
                                                <i class="ti ti-shuffle"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Lyrics Section -->
                            <div class="lyrics-container mt-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="card-title">Lyrics</h3>
                                    <button class="btn btn-sm btn-outline-primary">Show Full Lyrics</button>
                                </div>
                                <div class="lyrics-text">
                                    @php
                                        $lyrics = [
                                            "I've been tryna call
                                    I've been on my own for long enough
                                    Maybe you can show me how to love, maybe
                                    I'm going through withdrawals
                                    You don't even have to do too much
                                    You can turn me on with just a touch, baby
                                    I look around and Sin City's cold and empty
                                    With no one in sight, save for a few
                                    can turn me on with just a touch, baby
                                    I look around and Sin City's cold and empty
                                    No one's around to judge me
                                    I can't see clearly when you're gone",

                                            "I'm levitating
                                    You're the moonlight needed for the night sky
                                    I got you, my love, my baby
                                    My heartbeat's racing
                                    Electricity is flowing through my veins
                                    I got you, moonlight, you're my
                                    Starlight, I need you all night",

                                            "I do the same thing I told you that I never would
                                    I told you I'd change, even when I knew I never could
I know that I can't find nobody else as good as you
I need you to stay, need you to stay, hey",

                                            "Baby back, ayy
Couple racks, ayy
Couple Grammys on him
Couple plaques, ayy
That's a fact, ayy
Throw it back, ayy
Throw it back, ayy",

                                            "Save your tears for another day
I realize that I'm much too late
And you deserve someone better
Still living in the currents you create",
                                        ];
                                    @endphp
                                    {{ $lyrics[$id % 5] }}
                                </div>
                            </div>

                            <!-- Comments Section -->
                            <div class="comment-container mt-4">
                                <h3 class="card-title mb-4">Comments (24)</h3>

                                @for ($i = 0; $i < 3; $i++)
                                    <div class="comment-item">
                                        <img src="https://ui-avatars.com/api/?name={{ ['John Doe', 'Jane Smith', 'Alex Johnson'][$i] }}&background=e53935&color=fff"
                                            class="comment-avatar">
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <span
                                                    class="comment-author">{{ ['John Doe', 'Jane Smith', 'Alex Johnson'][$i] }}</span>
                                                <span
                                                    class="comment-time">{{ ['2 hours ago', 'Yesterday', '3 days ago'][$i] }}</span>
                                            </div>
                                            <p class="comment-text">
                                                {{ ['This song is amazing! I can\'t stop listening to it.', 'The beat is so catchy, definitely one of my favorites this year.', 'I love the lyrics, they really speak to me.'][$i] }}
                                            </p>
                                            <div class="comment-actions">
                                                <span class="comment-action"><i class="ti ti-thumb-up me-1"></i>
                                                    {{ rand(5, 50) }}</span>
                                                <span class="comment-action"><i class="ti ti-thumb-down me-1"></i>
                                                    {{ rand(0, 5) }}</span>
                                                <span class="comment-action"><i class="ti ti-message-circle me-1"></i>
                                                    Reply</span>
                                            </div>
                                        </div>
                                    </div>
                                @endfor

                                <div class="comment-form">
                                    <input type="text" class="form-control comment-input"
                                        placeholder="Add a comment...">
                                    <button class="btn btn-primary comment-submit">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Related Songs -->
                        <div class="related-songs">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="card-title">Related Songs</h3>
                                <a href="#" class="btn btn-sm btn-link">View All</a>
                            </div>

                            @for ($i = 1; $i <= 5; $i++)
                                <a href="{{ route('play-song', ($id + $i) % 10) }}" class="text-decoration-none">
                                    <div class="related-song-item">
                                        <img src="https://picsum.photos/100/100?random={{ $id + $i }}"
                                            class="related-song-cover">
                                        <div class="related-song-info">
                                            <div class="related-song-title">
                                                {{ ['After Hours', 'Don\'t Start Now', 'Peaches', 'MONTERO', 'positions', 'Watermelon Sugar', 'Good 4 U', 'Mood', 'Dynamite', 'Circles'][$i % 10] }}
                                            </div>
                                            <div class="related-song-artist">
                                                {{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande', 'Harry Styles', 'Olivia Rodrigo', '24kGoldn', 'BTS', 'Post Malone'][$i % 10] }}
                                            </div>
                                        </div>
                                        <div class="related-song-duration">
                                            {{ ['3:20', '3:45', '2:56', '4:10', '3:14', '2:54', '3:30', '2:21', '3:19', '3:35'][$i % 10] }}
                                        </div>
                                    </div>
                                </a>
                            @endfor
                        </div>

                        <!-- Artist Info -->
                        <div class="related-songs mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="card-title">Artist</h3>
                                <a href="#" class="btn btn-sm btn-link">View Profile</a>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <img src="https://ui-avatars.com/api/?name={{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande'][$id % 5] }}&background=e53935&color=fff&size=128"
                                    class="me-3" style="width: 80px; height: 80px; border-radius: 50%;">
                                <div>
                                    <h4 class="mb-1">
                                        {{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande'][$id % 5] }}
                                    </h4>
                                    <p class="text-muted mb-2">{{ number_format(rand(1000000, 50000000)) }} monthly
                                        listeners</p>
                                    <button class="btn btn-sm btn-primary">
                                        <i class="ti ti-user-plus me-1"></i> Follow
                                    </button>
                                </div>
                            </div>

                            <p class="text-muted">
                                {{ ['Canadian singer-songwriter and record producer.', 'English singer and songwriter.', 'Canadian singer.', 'American rapper and singer.', 'American singer and actress.'][$id % 5] }}
                            </p>

                            <div class="d-flex mt-3">
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2">
                                    <i class="ti ti-brand-spotify me-1"></i> Spotify
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2">
                                    <i class="ti ti-brand-instagram me-1"></i> Instagram
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">
                                    <i class="ti ti-brand-twitter me-1"></i> Twitter
                                </a>
                            </div>
                        </div>

                        <!-- Album Info -->
                        <div class="related-songs mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="card-title">Album</h3>
                                <a href="#" class="btn btn-sm btn-link">View Album</a>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <img src="https://picsum.photos/500/500?random={{ $id }}" class="me-3"
                                    style="width: 80px; height: 80px; border-radius: 8px;">
                                <div>
                                    <h4 class="mb-1">
                                        {{ ['After Hours', 'Future Nostalgia', 'Justice', 'MONTERO', 'Positions'][$id % 5] }}
                                    </h4>
                                    <p class="text-muted mb-0">
                                        {{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande'][$id % 5] }}
                                    </p>
                                    <p class="text-muted">Released:
                                        {{ ['2020', '2020', '2021', '2021', '2020'][$id % 5] }} • {{ rand(10, 16) }}
                                        songs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="#" class="link-secondary">Privacy
                                        Policy</a></li>
                                <li class="list-inline-item"><a href="#" class="link-secondary">Terms of
                                        Service</a></li>
                                <li class="list-inline-item"><a href="#" class="link-secondary">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    &copy; 2023 <a href="." class="link-secondary">Playlist Music</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Tabler Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>

    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle play/pause button
            const playBtn = document.querySelector('.play-btn');
            let isPlaying = false;

            playBtn.addEventListener('click', function() {
                if (isPlaying) {
                    this.innerHTML = '<i class="ti ti-player-play"></i>';
                    isPlaying = false;
                } else { 
                    this.innerHTML = '<i class="ti ti-player-pause"></i>';
                    isPlaying = true;
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>

</html>
