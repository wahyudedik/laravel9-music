<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar */
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Dashboard User</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="sidebar">
        <a href="{{ url('/') }}">🏠 Home</a>
        <a href="#">🎵 Playlist</a>
        <a href="#">👤 Profil</a>
    </div>

    <div class="content">
        <h2 class="fw-bold">Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p>Email: {{ auth()->user()->email }}</p>
        <p>Nomor HP: {{ auth()->user()->phone }}</p>

        <form action="{{ route('user.dashboard') }}" method="GET" class="mt-4">
            <div class="input-group">
                <input type="text" name="q" value="{{ $query }}" class="form-control" placeholder="Cari lagu atau artis...">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        @if (count($results) > 0)
            <h3 class="mt-4">Hasil Pencarian</h3>
            <ul>
                @foreach ($results as $song)
                    <li>
                        {{ $song->title }} - {{ $song->artist ? $song->artist->name : 'Unknown Artist' }}
                    </li>
                @endforeach
            </ul>
        @elseif ($query)
            <p class="mt-4">Tidak ada hasil ditemukan untuk "{{ $query }}".</p>
        @endif

        <h3 class="mt-4">Daftar Lagu</h3>
        <ul>
            @foreach ($allSongs as $song)
                <li>
                    {{ $song->title }} - {{ $song->artist ? $song->artist->name : 'Unknown Artist' }}
                </li>
            @endforeach
        </ul>

        <h3 class="mt-4">Lagu Populer</h3>
        <ul>
            @foreach ($popularSongs as $song)
                <li>
                    {{ $song->title }} - {{ $song->artist ? $song->artist->name : 'Unknown Artist' }} ({{ $song->stream_count }} streams)
                </li>
            @endforeach
        </ul>

        <h3 class="mt-4">Artis Populer</h3>
        <ul>
            @foreach ($popularArtists as $artist)
                <li>
                    {{ $artist->name }} ({{ $artist->stream_count }} streams)
                </li>
            @endforeach
        </ul>

        <h3 class="mt-4">Pencipta Populer</h3>
        <ul>
            @foreach ($popularComposers as $composer)
                <li>
                    {{ $composer->name }} ({{ $composer->stream_count }} streams)
                </li>
            @endforeach
        </ul>

        <h3 class="mt-4">Cover Creator Populer</h3>
        <ul>
            @foreach ($popularCoverCreators as $coverCreator)
                <li>
                    {{ $coverCreator->name }} ({{ $coverCreator->stream_count }} streams)
                </li>
            @endforeach
        </ul>

        <h3 class="mt-4">🎶 Playlist Favorit</h3>
        <ul>
            <li>🎵 Lagu 1</li>