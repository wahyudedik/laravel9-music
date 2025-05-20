@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Favorite Songs</h2>
            <div class="text-gray-400">Your collection of liked songs</div>
        </div>
    </div>

    <!-- Song card -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">You Might Also Like</h2>
        </div>

        <div class="scroll-container">
            @for ($i = 1; $i <= 8; $i++)
                <div class="scroll-item music-card-item" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="https://picsum.photos/seed/rec{{ $i }}/300/300" alt="Recommended Song {{ $i }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate">Recommended Song {{ $i }}</h3>
                        <p class="text-sm text-gray-400 truncate">Artist {{ ($i % 5) + 6 }}</p>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <!-- Similar Songs You Might Like -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">You Might Also Like</h2>
        </div>

        <div class="scroll-container">
            @for ($i = 1; $i <= 8; $i++)
                <div class="scroll-item music-card-item" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="https://picsum.photos/seed/rec{{ $i }}/300/300" alt="Recommended Song {{ $i }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate">Recommended Song {{ $i }}</h3>
                        <p class="text-sm text-gray-400 truncate">Artist {{ ($i % 5) + 6 }}</p>
                    </div>
                </div>
            @endfor
        </div>
    </section>
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
        });
    </script>
@endsection
