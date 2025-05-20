<aside class="music-sidebar" id="sidebar">
    <div class="flex items-center justify-between p-4">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('img/favicon.png') }}" alt="Logo" class="w-8 h-8">
            <span class="font-bold text-lg">Playlist Music</span>
        </a>
        <button class="sidebar-toggle-btn" id="sidebarCollapseBtn">
            <i class="ti ti-menu-2"></i>
        </button>
    </div>
    <nav class="mt-6">
        <div class="nav-section mb-6">
            <a href="{{ url('/') }}" class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <i class="ti ti-home"></i>
                <span>Beranda</span>
            </a>
            <a href="{{ route('trending') }}" class="nav-item {{ Request::is('trending') ? 'active' : '' }}">
                <i class="ti ti-chart-bar"></i>
                <span>Trending</span>
            </a>
            <a href="{{ route('explore') }}" class="nav-item {{ Request::is('explore') ? 'active' : '' }}">
                <i class="ti ti-compass"></i>
                <span>Explore</span>
            </a>
            @auth
                <a href="{{ route('cart', ['idUser' => Auth::id()]) }}"
                    class="nav-item relative {{ Request::is('cart') ? 'active' : '' }}">
                    <i class="ti ti-shopping-cart"></i>
                    <div class="relative">
                        <div>Order</div>
                        <span
                        class="absolute top-0 -right-8 inline-flex items-center justify-center px-1.5 py-0.5 pb-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                        0
                    </span>

                    </div>

                    <!-- Red badge counter -->
                </a>
            @endauth

        </div>

        @auth
            <div class="nav-section">
                <div class="nav-section-title">Library</div>
                <a href="{{ route('favorite-songs') }}"
                    class="nav-item {{ Request::is('favorite-songs') ? 'active' : '' }}">
                    <i class="ti ti-heart"></i>
                    <span>Favorites</span>
                </a>
                <a href="{{ route('playlists') }}" class="nav-item {{ Request::is('playlists') ? 'active' : '' }}">
                    <i class="ti ti-playlist"></i>
                    <span>Playlists</span>
                </a>
            </div>
        @endauth

        @guest
            <div class="p-5 mt-4 bg-gray-800/50 rounded-lg mx-3">
                <h3 class="text-sm font-medium mb-3">Enjoy your favorite music</h3>
                <p class="text-xs text-gray-400 mb-4">Sign in to access your library, playlists and recommendations</p>
                <div class="space-y-2">
                    <a href="{{ route('login') }}"
                        class="block w-full py-2 px-4 bg-red-600 text-white font-medium rounded-full text-sm text-center hover:bg-red-700 transition">
                        Sign in
                    </a>
                </div>
            </div>
        @endguest
    </nav>
</aside>
