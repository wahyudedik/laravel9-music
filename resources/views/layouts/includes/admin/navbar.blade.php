<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="#">MusicApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">

                    <a class="nav-link active" href="{{ url('/admin/dashboard') }}">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/user') }}">
                        <i class="fas fa-users me-1"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-music me-1"></i> Songs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog me-1"></i> Settings
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4361ee&color=fff"
                            class="rounded-circle me-2" width="32" height="32" alt="Profile">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            @php
                                $user = Auth::user();
                                $userRole = $user->getRoleNames()->first();
                            @endphp
                            <form action="{{ route('logout', ['role' => $userRole]) }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
