<header class="music-header">
    <div class="header-left">
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            <i class="ti ti-menu-2"></i>
        </button>
    </div>

    <div class="search-container">
        <form class="search-form" action="#" method="GET">
            <i class="ti ti-search search-icon"></i>
            <input type="search" class="search-input" placeholder="Search songs, artists, albums..."
                aria-label="Search">
            {{-- <button type="button" class="mic-button">
                <i class="ti ti-microphone"></i>
            </button> --}}
        </form>
    </div>

    <div class="header-right ml-3">
        @guest
            <a href="{{ route('login') }}" class="login-btn">
                Sign in
            </a>
        @else
            <!-- User is authenticated -->
            <div class="flex items-center gap-3">
                {{-- <button class="icon-btn" title="Settings">
                    <i class="ti ti-settings"></i>
                </button>
                <button class="icon-btn" title="Notifications">
                    <i class="ti ti-bell"></i>
                </button> --}}
                <div class="relative">
                    <div
                        class="w-9 h-9 rounded-full bg-gray-700 flex items-center justify-center text-white cursor-pointer"
                        id="userMenuButton">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="absolute right-0 mt-2 w-60 bg-gray-800 rounded-lg shadow-lg p-4 hidden" id="userDropdown">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-400">{{ Auth::user()->getRoleNames()->first() }}</div>
                            </div>
                        </div>
                        <div class="border-t border-gray-700 pt-3 space-y-2">
                            @php
                                $role = Auth::user()->getRoleNames()->first();
                            @endphp
                            
                            @if ($role == 'Admin' || $role == 'Super Admin')
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="w-full text-left flex items-center gap-2 text-gray-400 hover:text-white text-sm py-1">
                                    <i class="ti ti-dashboard"></i> Dashboard
                                </a>
                            @else
                                <a href="{{ route('user.dashboard') }}" 
                                   class="w-full text-left flex items-center gap-2 text-gray-400 hover:text-white text-sm py-1">
                                    <i class="ti ti-dashboard"></i> Dashboard
                                </a>
                            @endif
                            
                            <form action="{{ url('logout/' . Auth::user()->getRoleNames()->first()) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left flex items-center gap-2 text-gray-400 hover:text-white text-sm py-1">
                                    <i class="ti ti-logout"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</header>

<script>
    // Add this script at the bottom of your file or in your scripts section
    document.addEventListener('DOMContentLoaded', function() {
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');
        
        if (userMenuButton && userDropdown) {
            userMenuButton.addEventListener('click', function() {
                userDropdown.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
    });
</script>
