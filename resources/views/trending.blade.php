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
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
            @for ($i = 1; $i <= 12; $i++)
                <div class="scroll-item music-card-item" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
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
                            @guest data-login-required="true" onclick="window.location.href='{{ route('login') }}'" @endguest
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

    <!-- Trending Cover Creator Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Trending cover creators</h2>
        </div>

        <div class="scroll-container">
            @php
                $creators = [
                    'Alex Covers',
                    'Music Master',
                    'Cover Queen',
                    'Acoustic Vibes',
                    'Melody Maker',
                    'Piano Pro',
                    'Guitar Hero',
                    'Voice Master',
                    'Cover King',
                    'Music Magic',
                ];
            @endphp

            @foreach ($creators as $index => $creator)
                <div class="scroll-item creator-card" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <div class="relative group">
                        <div
                            class="overflow-hidden rounded-full aspect-square border-2 border-transparent group-hover:border-red-500 transition-all duration-300">
                            <img src="https://picsum.photos/300/300?random={{ $index + 600 }}" alt="{{ $creator }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="bg-red-600 px-4 py-2 rounded-full text-white text-sm transform scale-0 group-hover:scale-100 transition-transform duration-300 shadow-lg">
                                View
                            </div>
                        </div>
                    </div>
                    <h3 class="font-medium mt-3 text-center truncate" title="{{ $creator }}">{{ $creator }}</h3>
                    <p class="text-sm text-gray-400 text-center">{{ rand(100, 999) }}K followers</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Trending Artists -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Trending artists</h2>
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
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="bg-red-600 px-4 py-2 rounded-full text-white text-sm transform scale-0 group-hover:scale-100 transition-transform duration-300 shadow-lg">
                                View
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
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Trending composers</h2>
        </div>

        <div class="scroll-container">
            @php
                $composers = [
                    'Hans Zimmer',
                    'John Williams',
                    'Ennio Morricone',
                    'Howard Shore',
                    'James Horner',
                    'Max Richter',
                    'Ludovico Einaudi',
                    'Philip Glass',
                    'Joe Hisaishi',
                    'Yann Tiersen',
                ];
            @endphp

            @foreach ($composers as $index => $composer)
                <div class="scroll-item composer-card" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <div class="relative group">
                        <div
                            class="overflow-hidden rounded-full aspect-square border-2 border-transparent group-hover:border-red-500 transition-all duration-300">
                            <img src="https://picsum.photos/300/300?random={{ $index + 1000 }}" alt="{{ $composer }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="bg-red-600 px-4 py-2 rounded-full text-white text-sm transform scale-0 group-hover:scale-100 transition-transform duration-300 shadow-lg">
                                View
                            </div>
                        </div>
                    </div>
                    <h3 class="font-medium mt-3 text-center truncate" title="{{ $composer }}">{{ $composer }}
                    </h3>
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

                    // Here you would typically filter content based on the selected category
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
