@extends('layouts.landing-page')

@section('content')
    <div class="mb-8">
        <!-- Hero Section -->
        <div class="relative rounded-xl overflow-hidden mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-900 to-blue-900 opacity-90"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-image: url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=1470&auto=format&fit=crop')">
            </div>

            <div class="relative z-10 p-8 md:p-12">
                <div class="max-w-3xl">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">Today's Mix</h1>
                    <p class="text-gray-300 mb-6">Personalized trending tracks curated just for you, updated daily.</p>
                </div>
            </div>
        </div>

        <!-- Mix Info -->
        <div class="bg-[var(--color-bg-card)] p-4 rounded-lg mb-6">
            <div class="flex items-center gap-3 text-sm text-gray-400">
                <span><i class="ti ti-clock mr-1"></i> Updated today</span>
                <span>•</span>
                <span><i class="ti ti-music mr-1"></i> 25 tracks</span>
            </div> 
        </div>

        <!-- Track List as Cards -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Featured Tracks</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @for ($i = 1; $i <= 15; $i++)
                    <div
                        class="bg-[var(--color-bg-card)] rounded-lg overflow-hidden group hover:bg-[var(--color-bg-hover)] transition duration-300">
                        <div class="relative">
                            <img src="https://picsum.photos/seed/{{ $i }}/300/300" alt="Track art"
                                class="w-full aspect-square object-cover">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <button
                                    class="w-12 h-12 rounded-full bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] flex items-center justify-center transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                    <i class="ti ti-player-play text-xl"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="font-medium truncate">
                                {{ ['Blinding Lights', 'Save Your Tears', 'Starboy', 'Bad Guy', 'Circles', 'Don\'t Start Now', 'Watermelon Sugar', 'Levitating', 'Stay', 'Good 4 U', 'Mood', 'Peaches', 'Montero', 'Butter', 'Easy On Me'][$i - 1] }}
                            </div>
                            <div class="text-sm text-gray-400 truncate mt-1">
                                {{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Billie Eilish', 'Post Malone', 'Dua Lipa', 'Harry Styles', 'Dua Lipa', 'The Kid LAROI', 'Olivia Rodrigo', '24kGoldn', 'Justin Bieber', 'Lil Nas X', 'BTS', 'Adele'][$i % 15] }}
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <span
                                    class="text-xs text-gray-500">{{ rand(2, 4) }}:{{ sprintf('%02d', rand(0, 59)) }}</span>
                                <span
                                    class="text-xs px-2 py-1 rounded-full bg-white/10 text-gray-300">{{ ['Featured', 'Recommended', 'Trending', 'New Release', 'Popular'][$i % 5] }}</span>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Related Mixes Section -->
        <section class="mb-12">
            <div class="section-header flex items-center justify-between mb-5">
                <h2 class="section-title text-2xl font-bold">More Like This</h2>
                <a href="{{ route('trending') }}" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                    See All <i class="ti ti-chevron-right text-sm"></i>
                </a>
            </div>

            <div class="scroll-container">
                @php
                    $mixTitles = ['Workout Mix', 'Chill Vibes', 'Party Hits', 'Focus Flow', 'Morning Boost', 'Throwback Jams', 'EDM Favorites', 'Acoustic Sessions'];
                @endphp
            
                @foreach ($mixTitles as $index => $title)
                    <div class="scroll-item music-card-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="relative group overflow-hidden rounded-xl">
                            <img src="https://picsum.photos/seed/mix{{ $index + 1 }}/300/300" alt="{{ $title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                    <i class="ti ti-player-play text-white text-xl"></i>
                                </div>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h3 class="font-semibold text-base truncate" title="{{ $title }}">{{ $title }}</h3>
                            <p class="text-sm text-gray-400 truncate" title="{{ rand(10, 30) }} tracks">{{ rand(10, 30) }} tracks</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set animation delay for scroll items
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

            // Play buttons hover effects
            const musicCards = document.querySelectorAll('.music-card');
            musicCards.forEach(card => {
                const overlay = card.querySelector('.card-overlay');
                const playButton = card.querySelector('.play-button');

                if (overlay && playButton) {
                    card.addEventListener('mouseenter', function() {
                        overlay.classList.add('opacity-100');
                        playButton.classList.add('opacity-100');
                        playButton.style.transform = 'translateY(0)';
                    });

                    card.addEventListener('mouseleave', function() {
                        overlay.classList.remove('opacity-100');
                        playButton.classList.remove('opacity-100');
                        playButton.style.transform = 'translateY(10px)';
                    });
                }
            });
        });
    </script>
@endsection
