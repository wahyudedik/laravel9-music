@extends('layouts.landing-page')

@section('content')
    <!-- Explore Navigation -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-6">Explore</h1>

        <div class="category-nav mb-6">
            <div class="category-pill active">All</div>
            <div class="category-pill">Charts</div>
            <div class="category-pill">New releases</div>
            <div class="category-pill">Moods & genres</div>
            <div class="category-pill">For you</div>
            <div class="category-pill">Trending</div>
            <div class="category-pill">Pop</div>
            <div class="category-pill">Hip Hop</div>
            <div class="category-pill">Rock</div>
            <div class="category-pill">R&B</div>
            <div class="category-pill">Electronic</div>
            <div class="category-pill">Country</div>
            <div class="category-pill">Latin</div>
        </div>
    </div>

    <!-- Trending Now Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Trending Song</h2>
            <a href="#" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See all <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
            @for ($i = 1; $i <= 12; $i++)
                <div class="scroll-item music-card-item" id="recently-item-music"
                    data-id="123" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <div class="relative group overflow-hidden rounded-lg">
                        <div
                            class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            <i class="ti ti-trending-up mr-1"></i> Trending
                        </div>
                        <img src="https://picsum.photos/300/300?random={{ $i + 300 }}"
                            alt="Trending Song #{{ $i }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center"
                        {{ Auth::guest() ? 'data-login-required=true onclick=window.location.href=\''.route('login').'\'' : '' }}
                            data-title="Trending Song #{{ $i }}"
                            data-artist="Trending Artist #{{ $i }}"
                            data-cover="https://picsum.photos/300/300?random={{ $i + 300 }}"
                            data-id="{{ $i + 100 }}" data-duration="{{ rand(180, 320) }}">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                        @guest
                            <div class="absolute top-2 right-2">
                                <div class="bg-gray-900/70 backdrop-blur-sm text-white text-xs p-1 rounded-full">
                                    <i class="ti ti-lock text-xs"></i>
                                </div>
                            </div>
                        @endguest
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="Trending Song #{{ $i }}">
                            Trending Song #{{ $i }}
                        </h3>
                        <p class="text-sm text-gray-400 truncate" title="Trending Artist #{{ $i }}">
                            Trending Artist #{{ $i }}
                        </p>

                        <div class="flex items-center mt-1">
                            <span class="text-xs text-gray-500 flex items-center">
                                Song • {{ rand(1, 50) }}M views
                            </span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <!-- Trending Playlists Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Trending Playlists</h2>
            <a href="#" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See all <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $playlists = [
                    [
                        'title' => 'Today\'s Hits',
                        'desc' => 'The most played tracks right now',
                        'color' => 'from-pink-600 to-red-600',
                        'songs' => rand(30, 50),
                    ],
                    [
                        'title' => 'Rap Caviar',
                        'desc' => 'Best hip hop tracks this week',
                        'color' => 'from-blue-600 to-indigo-600',
                        'songs' => rand(30, 50),
                    ],
                    [
                        'title' => 'Pop Mix',
                        'desc' => 'The hottest pop songs',
                        'color' => 'from-purple-600 to-pink-600',
                        'songs' => rand(30, 50),
                    ],
                    [
                        'title' => 'Mega Hit Mix',
                        'desc' => 'A mix of the biggest songs right now',
                        'color' => 'from-red-600 to-orange-600',
                        'songs' => rand(30, 50),
                    ],
                    [
                        'title' => 'Chill Vibes',
                        'desc' => 'Relaxing tunes for your day',
                        'color' => 'from-teal-600 to-blue-600',
                        'songs' => rand(30, 50),
                    ],
                    [
                        'title' => 'Dance Party',
                        'desc' => 'Top electronic and dance hits',
                        'color' => 'from-green-600 to-teal-600',
                        'songs' => rand(30, 50),
                    ],
                ];
            @endphp

            @foreach ($playlists as $index => $playlist)
                <div class="relative" style="min-width: 160px; max-width: 180px;" data-aos="fade-up"
                    data-aos-delay="{{ $index * 50 }}">
                    <div class="bg-gray-800 rounded-lg overflow-hidden group">
                        <div class="aspect-square bg-gradient-to-br {{ $playlist['color'] }} relative">
                            <div class="absolute inset-0 opacity-40">
                                <img src="https://picsum.photos/300/300?random={{ $index + 200 }}"
                                    class="w-full h-full object-cover mix-blend-overlay" alt="{{ $playlist['title'] }}">
                            </div>
                            <div class="absolute bottom-0 right-0 p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button
                                    class="bg-red-600 hover:bg-red-700 text-white rounded-full p-2 shadow-lg transition transform hover:scale-105">
                                    <i class="ti ti-player-play"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-sm truncate" title="{{ $playlist['title'] }}">
                                {{ $playlist['title'] }}</h3>
                            <p class="text-xs text-gray-400 truncate mt-1">{{ $playlist['songs'] }} songs</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Trending Artists -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Trending artists</h2>
            <a href="#" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See all <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $artists = [
                    'Taylor Swift',
                    'The Weeknd',
                    'Drake',
                    'Billie Eilish',
                    'Dua Lipa',
                    'Bad Bunny',
                    'Ariana Grande',
                    'BTS',
                    'Ed Sheeran',
                    'Justin Bieber',
                ];
            @endphp

            @foreach ($artists as $index => $artist)
                <div class="scroll-item artist-card" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <div class="relative group">
                        <div
                            class="overflow-hidden rounded-full aspect-square border-2 border-transparent group-hover:border-red-500 transition-all duration-300">
                            <img src="https://picsum.photos/300/300?random={{ $index + 900 }}" alt="{{ $artist }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="absolute bottom-0 right-0">
                            <div
                                class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-300 shadow-lg">
                                <i class="ti ti-player-play text-white"></i>
                            </div>
                        </div>
                    </div>
                    <h3 class="font-medium mt-3 text-center truncate" title="{{ $artist }}">{{ $artist }}
                    </h3>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Trending Composer Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-6">
            <h2 class="section-title text-2xl font-bold">Trending composers</h2>
            <div class="flex items-center space-x-2">
                <a href="#" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                    See all <i class="ti ti-chevron-right text-sm"></i>
                </a>
            </div>
        </div>

        <div class="bg-gray-800/30 backdrop-blur-sm rounded-lg overflow-hidden border border-gray-700/50">
            <div class="p-1">
                <ul class="divide-y divide-gray-700/50">
                    @for ($i = 1; $i <= 10; $i++)
                        <li class="group hover:bg-gray-700/50 transition-all duration-300 rounded-md" data-aos="fade-up"
                            data-aos-delay="{{ $i * 30 }}">
                            <div class="flex items-center px-4 py-3">
                                <div class="text-gray-400 w-6 text-center mr-6">{{ $i }}</div>
                                <div class="relative flex-shrink-0 mr-4">
                                    <img src="https://picsum.photos/300/300?random={{ $i + 500 }}"
                                        class="w-12 h-12 rounded object-cover transition-transform duration-300 group-hover:scale-105"
                                        alt="Composer #{{ $i }}">
                                    <button
                                        class="play-song-btn absolute inset-0 bg-red-600/80 rounded opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all duration-300"
                                        data-title="Composition #{{ $i }}"
                                        data-artist="Composer #{{ $i }}"
                                        data-cover="https://picsum.photos/300/300?random={{ $i + 500 }}"
                                        data-id="{{ $i + 300 }}" data-duration="{{ rand(180, 320) }}">
                                        <i class="ti ti-player-play text-white"></i>
                                    </button>
                                </div>
                                <div class="min-w-0 flex-1 pr-4">
                                    <p
                                        class="text-sm font-medium text-white truncate group-hover:text-red-400 transition-colors duration-300">
                                        Composition #{{ $i }}
                                    </p>
                                    <div class="flex items-center">
                                        <p class="text-xs text-gray-400 truncate">Composer #{{ $i }}</p>
                                        @if (rand(0, 1))
                                            <span
                                                class="inline-flex items-center ml-2 bg-gray-700 text-gray-300 text-xs px-1.5 py-0.5 rounded">
                                                <i class="ti ti-music text-xs mr-0.5"></i> Classical
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 text-gray-400">
                                    <span class="text-xs">{{ rand(2, 5) }}:{{ sprintf('%02d', rand(0, 59)) }}</span>
                                    @auth
                                        <button class="p-2 hover:text-red-500 transition-colors">
                                            <i class="ti ti-heart"></i>
                                        </button>
                                    @endauth
                                    <div class="relative">
                                        <button class="p-2 hover:text-white transition-colors"
                                            onclick="toggleMenu('composerMenu{{ $i }}')">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg p-2 hidden z-20"
                                            id="composerMenu{{ $i }}">
                                            <ul class="space-y-1">
                                                @auth
                                                    <li>
                                                        <a href="#"
                                                            class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                                            <i class="ti ti-playlist"></i> Add to playlist
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                                            <i class="ti ti-heart"></i> Save to library
                                                        </a>
                                                    </li>
                                                @endauth
                                                <li>
                                                    <a href="#"
                                                        class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                                        <i class="ti ti-share"></i> Share
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                                        <i class="ti ti-music"></i> Go to composer
                                                    </a>
                                                </li>
                                                @guest
                                                    <li>
                                                        <a href="{{ route('login') }}"
                                                            class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                                            <i class="ti ti-login"></i> Sign in for more options
                                                        </a>
                                                    </li>
                                                @endguest
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        window.App = {
            loggedIn: @json(Auth::check())
        };
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category pill click
            const categoryPills = document.querySelectorAll('.category-pill');
            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    categoryPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Toggle menu function
            window.toggleMenu = function(menuId) {
                const menu = document.getElementById(menuId);
                if (menu) {
                    menu.classList.toggle('hidden');

                    // Close when clicking outside
                    const closeMenu = function(e) {
                        if (!menu.contains(e.target) && !e.target.closest(
                                `[onclick="toggleMenu('${menuId}')"]`)) {
                            menu.classList.add('hidden');
                            document.removeEventListener('click', closeMenu);
                        }
                    };

                    document.addEventListener('click', closeMenu);
                }
            };

            // Add animation delay to grid items
            document.querySelectorAll('.scroll-item').forEach((item, index) => {
                item.style.setProperty('--index', index);
            });

            // Initialize AOS animation library if it exists
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: true
                });
            }
        });


    </script>
@endsection
