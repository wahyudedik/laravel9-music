@extends('layouts.landing-page')

@section('content')
    <!-- Explore Navigation -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-6">Explore</h1>

        <div class="category-nav mb-6">
            <div class="category-pill active">All</div>
            <div class="category-pill">New Artists</div>
            <div class="category-pill">New Songs</div>
            <div class="category-pill">New Composers</div>
            <div class="category-pill">New Covers</div>
        </div>
    </div>

    <!-- New Artists Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">New Artists</h2>
            <a href="{{ route('artists') }}" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See all <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $newArtists = [
                    'Olivia Rodrigo',
                    'Tate McRae',
                    'The Kid LAROI',
                    'Conan Gray',
                    'Joji',
                    'Beabadoobee',
                    'girl in red',
                    'Måneskin',
                    'Bazzi',
                    'BENEE',
                ];
            @endphp

            @foreach ($newArtists as $index => $artist)
                <div class="scroll-item artist-card" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <div class="relative group">
                        <div
                            class="overflow-hidden rounded-full aspect-square border-2 border-transparent group-hover:border-red-500 transition-all duration-300">
                            <img src="https://picsum.photos/300/300?random={{ $index + 1200 }}" alt="{{ $artist }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="absolute top-0 right-0">
                            <span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full">NEW</span>
                        </div>
                        <div class="absolute bottom-0 right-0">
                            <div
                                class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-300 shadow-lg">
                                <i class="ti ti-player-play text-white"></i>
                            </div>
                        </div>
                    </div>
                    <h3 class="font-medium mt-3 text-center truncate" title="{{ $artist }}">{{ $artist }}</h3>
                </div>
            @endforeach
        </div>
    </section>

    <!-- New Songs Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">New Songs</h2>
            <a href="{{ route('popular-songs') }}" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See all <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
            @for ($i = 1; $i <= 12; $i++)
                <div class="scroll-item new-release-card" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <div class="relative group overflow-hidden rounded-lg">
                        <div class="absolute top-0 right-0 z-10">
                            <span class="bg-red-600 text-white text-xs px-2 py-1 opacity-80">NEW</span>
                        </div>
                        <img src="https://picsum.photos/300/300?random={{ $i + 400 }}"
                            alt="New Song #{{ $i }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110 group-hover:opacity-70">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center"
                            @guest data-login-required="true" onclick="window.location.href='{{ route('login') }}'" @endguest
                            data-title="New Song #{{ $i }}" data-artist="Artist #{{ $i }}"
                            data-cover="https://picsum.photos/300/300?random={{ $i + 400 }}"
                            data-id="{{ $i + 200 }}" data-duration="{{ rand(180, 320) }}">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="New Song #{{ $i }}">
                            New Song #{{ $i }}
                        </h3>
                        <p class="text-sm text-gray-400 truncate" title="Artist #{{ $i }}">
                            Artist #{{ $i }}
                        </p>
                        <div class="flex items-center mt-1 text-xs text-gray-500">
                            <span>{{ date('F j, Y', strtotime('-' . rand(1, 30) . ' days')) }}</span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <!-- New Composers Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">New Composers</h2>
            <a href="{{ route('composers') }}" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See all <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $composers = [
                    [
                        'name' => 'Ludwig Göransson',
                        'genre' => 'Film Score/Contemporary',
                        'img' => 'https://picsum.photos/300/300?random=7001',
                    ],
                    [
                        'name' => 'Hildur Guðnadóttir',
                        'genre' => 'Film Score/Electronic',
                        'img' => 'https://picsum.photos/300/300?random=7002',
                    ],
                    [
                        'name' => 'Jacob Collier',
                        'genre' => 'Jazz/Contemporary',
                        'img' => 'https://picsum.photos/300/300?random=7003',
                    ],
                    [
                        'name' => 'Daniel Pemberton',
                        'genre' => 'Film Score',
                        'img' => 'https://picsum.photos/300/300?random=7004',
                    ],
                    [
                        'name' => 'Nainita Desai',
                        'genre' => 'Film Score/World',
                        'img' => 'https://picsum.photos/300/300?random=7005',
                    ],
                    [
                        'name' => 'Floating Points',
                        'genre' => 'Electronic/Classical',
                        'img' => 'https://picsum.photos/300/300?random=7006',
                    ],
                    [
                        'name' => 'Caroline Shaw',
                        'genre' => 'Classical/Contemporary',
                        'img' => 'https://picsum.photos/300/300?random=7007',
                    ],
                    [
                        'name' => 'Kris Bowers',
                        'genre' => 'Film Score/Jazz',
                        'img' => 'https://picsum.photos/300/300?random=7008',
                    ],
                ];
            @endphp

            @foreach ($composers as $index => $composer)
                <div class="scroll-item composer-card" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <div class="relative group">
                        <div
                            class="overflow-hidden rounded-full border-2 border-gray-700 aspect-square group-hover:border-red-500 transition-all duration-300">
                            <img src="{{ $composer['img'] }}" alt="{{ $composer['name'] }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="absolute top-0 right-0">
                            <span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full">NEW</span>
                        </div>
                        <div class="absolute bottom-0 right-0">
                            <div
                                class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-300 shadow-lg">
                                <i class="ti ti-player-play text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <h3 class="font-semibold truncate" title="{{ $composer['name'] }}">{{ $composer['name'] }}</h3>
                        <p class="text-sm text-gray-400 truncate" title="{{ $composer['genre'] }}">
                            {{ $composer['genre'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- New Covers Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">New Covers</h2>
            <a href="{{ route('covers') }}" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See all <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $coverSongs = [
                    [
                        'title' => 'Running Up That Hill (Cover)',
                        'artist' => 'Meg Myers',
                        'original' => 'Kate Bush',
                        'img' => 'https://picsum.photos/300/300?random=8001',
                    ],
                    [
                        'title' => 'Hallelujah (Cover)',
                        'artist' => 'Pentatonix',
                        'original' => 'Leonard Cohen',
                        'img' => 'https://picsum.photos/300/300?random=8002',
                    ],
                    [
                        'title' => 'Mad World (Cover)',
                        'artist' => 'Jasmine Thompson',
                        'original' => 'Tears for Fears',
                        'img' => 'https://picsum.photos/300/300?random=8003',
                    ],
                    [
                        'title' => 'Take On Me (Cover)',
                        'artist' => 'The Last of Us Part II',
                        'original' => 'a-ha',
                        'img' => 'https://picsum.photos/300/300?random=8004',
                    ],
                    [
                        'title' => 'Toxic (Cover)',
                        'artist' => 'Melanie Martinez',
                        'original' => 'Britney Spears',
                        'img' => 'https://picsum.photos/300/300?random=8005',
                    ],
                    [
                        'title' => 'Creep (Cover)',
                        'artist' => 'Haley Reinhart',
                        'original' => 'Radiohead',
                        'img' => 'https://picsum.photos/300/300?random=8006',
                    ],
                    [
                        'title' => 'Wicked Game (Cover)',
                        'artist' => 'Ursine Vulpine',
                        'original' => 'Chris Isaak',
                        'img' => 'https://picsum.photos/300/300?random=8007',
                    ],
                    [
                        'title' => 'Jolene (Cover)',
                        'artist' => 'Miley Cyrus',
                        'original' => 'Dolly Parton',
                        'img' => 'https://picsum.photos/300/300?random=8008',
                    ],
                ];
            @endphp

            @foreach ($coverSongs as $index => $song)
                <div class="scroll-item cover-card" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="{{ $song['img'] }}" alt="{{ $song['title'] }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute top-0 right-0 z-10">
                            <span class="bg-red-600 text-white text-xs px-2 py-1 opacity-80">NEW</span>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-40 group-hover:opacity-80 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                        <div
                            class="absolute bottom-0 left-0 right-0 p-3 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <span class="bg-black/50 text-xs px-2 py-1 rounded-full backdrop-blur-sm">Cover Song</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $song['title'] }}">{{ $song['title'] }}
                        </h3>
                        <p class="text-sm text-gray-400 truncate" title="{{ $song['artist'] }}">{{ $song['artist'] }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Originally by <span
                                class="text-red-500">{{ $song['original'] }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category pill click
            const categoryPills = document.querySelectorAll('.category-pill');
            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    categoryPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    // Here you would filter content based on the selected category
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

            // Smooth drag scrolling for horizontal containers
            const sliders = document.querySelectorAll('.scroll-container');

            sliders.forEach(container => {
                container.addEventListener('wheel', (e) => {
                    if (e.deltaY !== 0) {
                        e.preventDefault();
                        container.scrollLeft += e.deltaY;
                    }
                });
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
