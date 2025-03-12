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

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Dashboard User</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ url('/') }}">🏠 Home</a>
        <a href="#">🎵 Playlist</a>
        <a href="#">👤 Profil</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2 class="fw-bold">Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p>Email: {{ auth()->user()->email }}</p>
        <p>Nomor HP: {{ auth()->user()->phone }}</p>

        <h3 class="mt-4">🎶 Playlist Favorit</h3>
        <ul>
            <li>🎵 Lagu 1</li>
            <li>🎵 Lagu 2</li>
            <li>🎵 Lagu 3</li>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
