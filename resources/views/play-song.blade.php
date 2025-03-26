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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e53935; 
            --primary-dark: #c62828;
            --primary-light: #ef5350;
            --secondary-color: #f8f9fa;
            --text-color: #fff;
            --text-muted: #b3b3b3;
            --bg-color: #121212;
            --card-bg: #181818;
            --sidebar-bg: #000000;
            --border-color: #2a2a2a;
            --sidebar-width: 240px;
            --mini-player-height: 90px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            background-color: var(--sidebar-bg);
            overflow-y: auto;
            transition: all 0.3s;
        }

        .sidebar-logo {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav .nav-link {
            color: var(--text-muted);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
            transition: all 0.2s;
            text-decoration: none;
        }

        .sidebar-nav .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav .nav-link.active {
            color: #fff;
            border-left-color: var(--primary-color);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav .nav-link-icon {
            margin-right: 0.75rem;
        }

        .sidebar-section-title {
            color: var(--text-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1rem 1.5rem 0.5rem;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            padding-bottom: calc(var(--mini-player-height) + 2rem);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .player-container {
            background-color: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .album-cover {
            width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
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
            background-color: #2a2a2a;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: all 0.2s ease;
            color: #fff;
            border: none;
        }

        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
            background-color: #333;
        }

        .play-btn {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: white;
        }

        .play-btn:hover {
            background-color: var(--primary-dark);
        }

        .progress-container {
            width: 100%;
            height: 6px;
            background-color: #3e3e3e;
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
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
        }

        .song-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .song-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }

        .song-artist {
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        .time-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .related-songs {
            background-color: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .related-song-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #2a2a2a;
            transition: all 0.2s ease;
        }

        .related-song-item:hover {
            background-color: #2a2a2a;
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
            color: #fff;
        }

                    .related-song-artist {
                font-size: 0.85rem;
                color: var(--text-muted);
            }

            .related-song-duration {
                color: var(--text-muted);
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
                color: var(--text-muted);
                transition: all 0.2s ease;
                cursor: pointer;
                text-decoration: none;
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
                background-color: var(--card-bg);
                border-radius: 16px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                padding: 20px;
                margin-top: 20px;
            }

            .lyrics-text {
                white-space: pre-line;
                line-height: 1.8;
                color: #e0e0e0;
            }

            .comment-container {
                background-color: var(--card-bg);
                border-radius: 16px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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
                color: #fff;
            }

            .comment-time {
                font-size: 0.85rem;
                color: var(--text-muted);
            }

            .comment-text {
                color: #e0e0e0;
                margin-bottom: 5px;
            }

            .comment-actions {
                display: flex;
                gap: 15px;
                font-size: 0.85rem;
                color: var(--text-muted);
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
                border: 1px solid #3e3e3e;
                background-color: #2a2a2a;
                color: #fff;
                margin-right: 10px;
            }

            .comment-submit {
                border-radius: 20px;
            }

            /* Mini Player */
            .mini-player {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: var(--mini-player-height);
                background-color: #181818;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                padding: 0 20px;
                display: flex;
                align-items: center;
                z-index: 1000;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
            }

            .mini-player-info {
                display: flex;
                align-items: center;
                flex: 1;
            }

            .mini-player-controls {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .mini-player-progress {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background-color: #3e3e3e;
            }

            .mini-player-progress-bar {
                height: 100%;
                background-color: var(--primary-color);
                width: 30%;
            }

            /* Responsive */
            @media (max-width: 992px) {
                .sidebar {
                    transform: translateX(-100%);
                }

                .sidebar.show {
                    transform: translateX(0);
                }

                .main-content {
                    margin-left: 0;
                }
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
        <div class="d-flex">
            <!-- Sidebar -->
            <aside class="sidebar" id="sidebar">
                <a href="{{ url('/') }}" class="sidebar-logo">
                    <img src="{{ asset('img/favicon.png') }}" width="32" height="32" alt="Logo" class="me-2">
                    <span class="font-weight-bold">Playlist Music</span>
                </a>
                
                <div class="sidebar-nav">
                    <div class="sidebar-section-title">Menu</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                <span class="nav-link-icon"><i class="ti ti-home"></i></span>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('popular-songs') }}">
                                <span class="nav-link-icon"><i class="ti ti-music"></i></span>
                                <span>Lagu Populer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('artists') }}">
                                <span class="nav-link-icon"><i class="ti ti-microphone"></i></span>
                                <span>Artis</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('covers') }}">
                                <span class="nav-link-icon"><i class="ti ti-disc"></i></span>
                                <span>Cover</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('composers') }}">
                                <span class="nav-link-icon"><i class="ti ti-note"></i></span>
                                <span>Pencipta</span>
                            </a>
                        </li>
                    </ul>
                    
                    @auth
                    <div class="sidebar-section-title mt-4">Koleksi Saya</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-icon"><i class="ti ti-heart"></i></span>
                                <span>Lagu Favorit</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-icon"><i class="ti ti-playlist"></i></span>
                                <span>Playlist Saya</span>
                            </a>
                        </li>
                        @if (Auth::user()->hasAnyRole(['Cover Creator', 'Artist', 'Composer']))
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-icon"><i class="ti ti-bookmark"></i></span>
                                <span>Wishlist</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-icon"><i class="ti ti-microphone-2"></i></span>
                                <span>Cover Saya</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                    @endauth
                </div>
                
                <div class="p-3 mt-auto">
                    @auth
                    <div class="d-flex align-items-center mb-3">
                        <span class="avatar avatar-sm bg-primary-lt me-2">{{ substr(Auth::user()->name, 0, 2) }}</span>
                        <div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="small text-muted">{{ Auth::user()->getRoleNames()->first() }}</div>
                        </div>
                    </div>
                    <div class="d-grid">
                        @php
                            $user = Auth::user();
                            $userRole = $user->getRoleNames()->first();
                        @endphp
                        <form action="{{ url('logout/' . $userRole) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm w-100">
                                <i class="ti ti-logout me-1"></i> Logout
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="d-grid gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="ti ti-login me-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="ti ti-user-plus me-1"></i> Register
                        </a>
                    </div>
                    @endauth
                </div>
            </aside>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Mobile Navbar for Sidebar Toggle -->
                <div class="d-lg-none mb-4">
                    <button class="btn btn-dark" id="sidebarToggle">
                        <i class="ti ti-menu-2"></i>
                    </button>
                </div>
                
                <div class="container-fluid py-4">
                    <div class="row g-4">
                        <!-- Main Player Section -->
                        <div class="col-lg-8">
                            <div class="player-container p-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img src="https://picsum.photos/500/500?random={{ $id }}"
                                            alt="Album Cover" class="album-cover mb-3">

                                        <div class="song-actions">
                                            <a href="#" class="action-btn">
                                                <i class="ti ti-heart"></i>
                                                <span>Like</span>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="ti ti-share"></i>
                                                <span>Share</span>
                                            </a>
                                            <a href="#" class="action-btn" data-bs-toggle="modal" data-bs-target="#addToPlaylistModal"
                                                data-song-title="{{ ['Blinding Lights', 'Save Your Tears', 'Levitating', 'Stay', 'Industry Baby'][$id % 5] }}"
                                                data-artist-name="{{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande'][$id % 5] }}"
                                                data-cover-image="https://picsum.photos/500/500?random={{ $id }}">
                                                <i class="ti ti-playlist"></i>
                                                <span>Add</span>
                                            </a>
                                            @if (Auth::check() && Auth::user()->hasAnyRole(['Cover Creator', 'Artist', 'Composer']))
                                            <a href="#" class="action-btn">
                                                <i class="ti ti-bookmark"></i>
                                                <span>Wishlist</span>
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="ti ti-microphone-2"></i>
                                                <span>Cover</span>
                                            </a>
                                            @endif
                                            <a href="#" class="action-btn">
                                                <i class="ti ti-download"></i>
                                                <span>Download</span>
                                            </a>
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
                                            <button class="control-btn">
                                                <i class="ti ti-player-skip-back"></i>
                                            </button>
                                            <button class="control-btn">
                                                <i class="ti ti-player-track-prev"></i>
                                            </button>
                                            <button class="control-btn play-btn">
                                                <i class="ti ti-player-play"></i>
                                            </button>
                                                                                        <button class="control-btn">
                                                <i class="ti ti-player-track-next"></i>
                                            </button>
                                            <button class="control-btn">
                                                <i class="ti ti-player-skip-forward"></i>
                                            </button>
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
                                                <button class="control-btn" style="width: 40px; height: 40px;">
                                                    <i class="ti ti-repeat"></i>
                                                </button>
                                                <button class="control-btn" style="width: 40px; height: 40px;">
                                                    <i class="ti ti-shuffle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lyrics Section -->
                                <div class="lyrics-container mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h3 class="card-title text-white">Lyrics</h3>
                                        <button class="btn btn-sm btn-dark">Show Full Lyrics</button>
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
                                    <h3 class="card-title mb-4 text-white">Comments (24)</h3>

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
                                    <h3 class="card-title text-white">Related Songs</h3>
                                    <a href="#" class="btn btn-sm btn-dark">View All</a>
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
                                    <h3 class="card-title text-white">Artist</h3>
                                    <a href="#" class="btn btn-sm btn-dark">View Profile</a>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande'][$id % 5] }}&background=e53935&color=fff&size=128"
                                        class="me-3" style="width: 80px; height: 80px; border-radius: 50%;">
                                    <div>
                                        <h4 class="mb-1 text-white">
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
                                    <a href="#" class="btn btn-sm btn-dark me-2">
                                        <i class="ti ti-brand-spotify me-1"></i> Spotify
                                    </a>
                                    <a href="#" class="btn btn-sm btn-dark me-2">
                                        <i class="ti ti-brand-instagram me-1"></i> Instagram
                                    </a>
                                    <a href="#" class="btn btn-sm btn-dark">
                                        <i class="ti ti-brand-twitter me-1"></i> Twitter
                                    </a>
                                </div>
                            </div>

                            <!-- Album Info -->
                            <div class="related-songs mt-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="card-title text-white">Album</h3>
                                    <a href="#" class="btn btn-sm btn-dark">View Album</a>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://picsum.photos/500/500?random={{ $id }}" class="me-3"
                                        style="width: 80px; height: 80px; border-radius: 8px;">
                                    <div>
                                        <h4 class="mb-1 text-white">
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
            </div>
        </div>

        <!-- Mini Player -->
        <div class="mini-player">
            <div class="mini-player-progress">
                <div class="mini-player-progress-bar" id="miniPlayerProgressBar"></div>
            </div>
            <div class="mini-player-info">
                <img src="https://picsum.photos/500/500?random={{ $id }}" class="rounded me-3"
                    style="width: 56px; height: 56px;" alt="Cover">
                <div>
                    <div class="fw-bold text-white">
                        {{ ['Blinding Lights', 'Save Your Tears', 'Levitating', 'Stay', 'Industry Baby'][$id % 5] }}
                    </div>
                    <div class="text-muted small">
                        {{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande'][$id % 5] }}
                    </div>
                </div>
            </div>
            <div class="mini-player-controls">
                <button class="control-btn" style="width: 36px; height: 36px;">
                    <i class="ti ti-player-skip-back"></i>
                </button>
                <button class="control-btn play-btn" style="width: 46px; height: 46px;" id="miniPlayerPlayBtn">
                    <i class="ti ti-player-play"></i>
                </button>
                <button class="control-btn" style="width: 36px; height: 36px;">
                    <i class="ti ti-player-skip-forward"></i>
                </button>
            </div>
        </div>

        <!-- Add to Playlist Modal -->
        <div class="modal modal-blur fade" id="addToPlaylistModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title">Add to Playlist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Song</label>
                            <div class="d-flex align-items-center">
                                <img src="" id="playlistSongCover" class="avatar avatar-md me-3" alt="">
                                <div>
                                    <div class="fw-bold" id="playlistSongTitle"></div>
                                    <div class="text-muted small" id="playlistSongArtist"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Playlist</label>
                            <div class="playlist-list">
                                @auth
                                                                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="playlist" value="liked"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3 bg-dark">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3 bg-primary">
                                                        <i class="ti ti-heart"></i>
                                                    </span>
                                                    <div>
                                                        <div class="font-weight-medium">Liked Songs</div>
                                                        <div class="text-muted">{{ rand(10, 100) }} songs</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="playlist" value="favorites"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3 bg-dark">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3 bg-blue">
                                                        <i class="ti ti-star"></i>
                                                    </span>
                                                    <div>
                                                        <div class="font-weight-medium">My Favorites</div>
                                                        <div class="text-muted">{{ rand(5, 50) }} songs</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="radio" name="playlist" value="workout"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-3 bg-dark">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-3 bg-green">
                                                        <i class="ti ti-playlist"></i>
                                                    </span>
                                                    <div>
                                                        <div class="font-weight-medium">Workout Mix</div>
                                                        <div class="text-muted">{{ rand(10, 30) }} songs</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @else
                                    <div class="alert alert-dark">
                                        <div class="d-flex">
                                            <div>
                                                <i class="ti ti-login me-2"></i> Please <a href="{{ route('login') }}"
                                                    class="alert-link">login</a> to add to playlist
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Create New Playlist</label>
                            <div class="input-group">
                                <input type="text" class="form-control bg-dark text-white border-dark" placeholder="Playlist name">
                                <button class="btn btn-primary" type="button">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            Add to Playlist
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Custom JS -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle play/pause button
                const playBtn = document.querySelector('.play-btn');
                const miniPlayerPlayBtn = document.getElementById('miniPlayerPlayBtn');
                let isPlaying = false;

                function togglePlayPause() {
                    if (isPlaying) {
                        playBtn.innerHTML = '<i class="ti ti-player-play"></i>';
                        miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-play"></i>';
                        isPlaying = false;
                    } else { 
                        playBtn.innerHTML = '<i class="ti ti-player-pause"></i>';
                        miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-pause"></i>';
                        isPlaying = true;
                    }
                }

                playBtn.addEventListener('click', togglePlayPause);
                miniPlayerPlayBtn.addEventListener('click', togglePlayPause);

                // Progress animation
                const miniPlayerProgressBar = document.querySelector('.mini-player-progress-bar');
                const progressBar = document.querySelector('.progress-bar');
                let progressInterval;
                let progress = 30; // Starting at 30% as shown in the UI

                function startProgressAnimation() {
                    // Clear any existing interval
                    clearInterval(progressInterval);

                    // Start progress animation
                    progressInterval = setInterval(() => {
                        progress += 0.1;
                        if (progress > 100) progress = 100;
                        
                        miniPlayerProgressBar.style.width = progress + '%';
                        progressBar.style.width = progress + '%';

                        if (progress >= 100) {
                            clearInterval(progressInterval);
                            togglePlayPause();
                        }
                    }, 100); // Faster for demo purposes
                }

                function pauseProgressAnimation() {
                    clearInterval(progressInterval);
                }

                // Start progress when play is clicked
                playBtn.addEventListener('click', function() {
                    if (isPlaying) {
                        startProgressAnimation();
                    } else {
                        pauseProgressAnimation();
                    }
                });

                miniPlayerPlayBtn.addEventListener('click', function() {
                    if (isPlaying) {
                        startProgressAnimation();
                    } else {
                        pauseProgressAnimation();
                    }
                });

                // Mobile sidebar toggle
                const sidebarToggleBtn = document.getElementById('sidebarToggle');
                const sidebar = document.getElementById('sidebar');
                
                if (sidebarToggleBtn) {
                    sidebarToggleBtn.addEventListener('click', function() {
                        sidebar.classList.toggle('show');
                    });
                }

                // Add to Playlist Modal
                const addToPlaylistModal = document.getElementById('addToPlaylistModal');
                if (addToPlaylistModal) {
                    addToPlaylistModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        const songTitle = button.getAttribute('data-song-title');
                        const artistName = button.getAttribute('data-artist-name');
                        const coverImage = button.getAttribute('data-cover-image');
                        
                        const playlistSongTitle = document.getElementById('playlistSongTitle');
                        const playlistSongArtist = document.getElementById('playlistSongArtist');
                        const playlistSongCover = document.getElementById('playlistSongCover');
                        
                        playlistSongTitle.textContent = songTitle;
                        playlistSongArtist.textContent = artistName;
                        playlistSongCover.src = coverImage;
                    });
                }
            });
        </script>
    </body>
</html>



