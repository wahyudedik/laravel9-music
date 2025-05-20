@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Popular Artists</h2>
            <div class="text-gray-400">Discover all popular artists and their best works</div>
        </div>
    </div>

    <!-- Category Navigation (Genre Filter) -->
    <div class="category-nav mb-6" data-aos="fade-up" data-aos-delay="100">
        <div class="category-pill active">All Genres</div>
        <div class="category-pill">Pop</div>
        <div class="category-pill">Rock</div>
        <div class="category-pill">Hip Hop</div>
        <div class="category-pill">R&B</div>
        <div class="category-pill">Electronic</div>
        <div class="category-pill">Jazz</div>
        <div class="category-pill">Classical</div>
        <div class="category-pill">Country</div>
    </div>

    <!-- Featured Artists Section -->
    <section class="mb-10">
        <div class="section-header flex items-center justify-between mb-5" data-aos="fade-up" data-aos-delay="150">
            <h2 class="section-title text-2xl font-bold">Top Artists</h2>
        </div>

        <div class="scroll-container">
            @for ($i = 1; $i <= 12; $i++)
                <div class="scroll-item artist-card" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <div class="relative group">
                        <div
                            class="overflow-hidden rounded-full aspect-square border-2 border-transparent group-hover:border-red-500 transition-all duration-300">
                            <img src="https://picsum.photos/seed/{{ $i + 50 }}/300/300"
                                alt="Artist #{{ $i }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                    </div>
                    <a href="{{ route('artist.profile', $i) }}">
                        <h3 class="font-medium mt-3 text-center truncate" title="Artist #{{ $i }}">
                            Top Artist #{{ $i }}
                        </h3>
                    </a>
                    <p class="text-sm text-gray-400 text-center truncate">{{ rand(5, 30) }} Songs</p>
                </div>
            @endfor
        </div>
    </section>

    <!-- All Artists Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5" data-aos="fade-up" data-aos-delay="400">
            <h2 class="section-title text-2xl font-bold">All Artists</h2>
        </div>

        <div class="scroll-container pb-4">
            @for ($i = 1; $i <= 10; $i++)
                <div class="scroll-item" style="width: 220px;" data-aos="fade-up" data-aos-delay="{{ 400 + $i * 25 }}">
                    <div
                        class="bg-[var(--color-bg-card)] rounded-lg overflow-hidden group hover:bg-[var(--color-bg-hover)] transition duration-300">
                        <div class="relative">
                            <a href="{{ route('artist.profile', $i) }}">
                                <img src="https://picsum.photos/seed/{{ $i + 300 }}/300/300" alt="Artist #{{ $i }}"
                                    class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                            </a>
                            <div class="absolute top-2 right-2">
                                <span class="bg-amber-600 text-white text-xs px-2 py-0.5 rounded-full">New</span>
                            </div>
                            <div
                                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('artist.profile', $i) }}"
                                    class="w-12 h-12 rounded-full bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] flex items-center justify-center transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                    <i class="ti ti-eye text-xl text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-3">
                            <a href="{{ route('artist.profile', $i) }}">
                                <h4 class="font-medium truncate hover:text-red-500 transition-colors">Artist #{{ $i }}</h4>
                            </a>
                            <div class="text-sm text-gray-400 truncate mt-1">{{ rand(5, 15) }} Songs</div>
                            <div class="mt-2 flex items-center">
                                <div class="flex -space-x-2 mr-2">
                                    @for ($j = 1; $j <= 3; $j++)
                                        <img class="w-5 h-5 rounded-full border border-gray-800"
                                            src="https://picsum.photos/seed/{{ $i * 10 + $j }}/50/50" alt="Fan">
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-400">{{ rand(10, 50) }}K fans</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <!-- Artist Collaboration Highlight -->
    <section class="mb-10">
        <div class="relative rounded-xl overflow-hidden mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-purple-900 opacity-90"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-image: url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1470&auto=format&fit=crop')">
            </div>

            <div class="relative z-10 p-8 md:p-12">
                <div class="max-w-3xl">
                    <span class="text-sm bg-white/20 text-white px-2 py-1 rounded-full">Featured Collaboration</span>
                    <h1 class="text-3xl md:text-4xl font-bold mt-3 mb-2">Artist Collaborations</h1>
                    <p class="text-gray-300 mb-6">Discover incredible artist collaborations and their masterpieces.</p>

                    <div class="flex flex-wrap gap-3 mb-4">
                        <div class="flex items-center bg-white/10 backdrop-blur-sm px-3 py-2 rounded-full">
                            <img src="https://picsum.photos/seed/101/50/50" class="w-8 h-8 rounded-full mr-2"
                                alt="Artist">
                            <span>Artist One</span>
                        </div>
                        <div class="flex items-center bg-white/10 backdrop-blur-sm px-3 py-2 rounded-full">
                            <img src="https://picsum.photos/seed/102/50/50" class="w-8 h-8 rounded-full mr-2"
                                alt="Artist">
                            <span>Artist Two</span>
                        </div>
                        <div class="flex items-center bg-white/10 backdrop-blur-sm px-3 py-2 rounded-full">
                            <img src="https://picsum.photos/seed/103/50/50" class="w-8 h-8 rounded-full mr-2"
                                alt="Artist">
                            <span>Artist Three</span>
                        </div>
                    </div>
                </div>
            </div>
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

            // Category navigation pill click
            const categoryPills = document.querySelectorAll('.category-pill');

            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    categoryPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    // Here you would typically filter artists based on the selected genre
                });
            });
        });
    </script>
@endsection
