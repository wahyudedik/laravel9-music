@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Music Composers</h2>
            <div class="text-gray-400">Discover talented composers and their original compositions</div>
        </div>
    </div>

    <!-- Category Navigation -->
    <div class="category-nav mb-6" data-aos="fade-up" data-aos-delay="100">
        <div class="category-pill active">All</div>
        <div class="category-pill">Classical</div>
        <div class="category-pill">Film Score</div>
        <div class="category-pill">Contemporary</div>
        <div class="category-pill">Orchestral</div>
        <div class="category-pill">Instrumental</div>
        <div class="category-pill">Electronic</div>
        <div class="category-pill">Fusion</div>
    </div>

    <!-- Featured Composers Section -->
    <section class="mb-10">
        <div class="section-header flex items-center justify-between mb-5" data-aos="fade-up" data-aos-delay="150">
            <h2 class="section-title text-2xl font-bold">Featured Composers</h2>
        </div>

        <div class="scroll-container">
            @php
                $featuredComposers = [
                    ['name' => 'Hans Zimmer', 'genre' => 'Film Score', 'img' => 'https://images.unsplash.com/photo-1507838153414-b4b713384a76?q=80&w=300'],
                    ['name' => 'John Williams', 'genre' => 'Classical/Film', 'img' => 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=300'],
                    ['name' => 'Ennio Morricone', 'genre' => 'Film Score', 'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300'],
                    ['name' => 'Max Richter', 'genre' => 'Contemporary Classical', 'img' => 'https://images.unsplash.com/photo-1513883049090-d91fb58d69e1?q=80&w=300'],
                    ['name' => 'Philip Glass', 'genre' => 'Minimalist', 'img' => 'https://images.unsplash.com/photo-1507838153414-b4b713384a76?q=80&w=300'],
                    ['name' => 'Ludovico Einaudi', 'genre' => 'Classical/Contemporary', 'img' => 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=300'],
                    ['name' => 'Thomas Newman', 'genre' => 'Film Score', 'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300'],
                    ['name' => 'Yann Tiersen', 'genre' => 'Contemporary', 'img' => 'https://images.unsplash.com/photo-1513883049090-d91fb58d69e1?q=80&w=300'],
                ];
            @endphp

            @foreach ($featuredComposers as $composer)
                <div class="scroll-item composer-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="relative group">
                        <div class="overflow-hidden rounded-full border-2 border-gray-700 aspect-square group-hover:border-red-500 transition-all duration-300">
                            <a href="{{ route('composer.profile', $loop->index + 1) }}">
                                <img src="{{ $composer['img'] }}" alt="{{ $composer['name'] }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </a>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('composer.profile', $loop->index + 1) }}" class="hover:text-red-500 transition-colors">
                            <h3 class="font-semibold truncate" title="{{ $composer['name'] }}">{{ $composer['name'] }}</h3>
                        </a>
                        <p class="text-sm text-gray-400 truncate" title="{{ $composer['genre'] }}">
                            {{ $composer['genre'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- All Composers Grid -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">All Composers</h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @for ($i = 1; $i <= 15; $i++)
                <div class="composer-card-grid" data-aos="fade-up" data-aos-delay="{{ $i * 30 }}">
                    <div class="relative group bg-gray-800/30 p-4 rounded-xl hover:bg-gray-800/60 transition-all duration-300">
                        <div class="flex flex-col items-center">
                            <div class="overflow-hidden rounded-full border-2 border-gray-700 w-24 h-24 mb-3 group-hover:border-red-500 transition-all duration-300">
                                <a href="{{ route('composer.profile', $i) }}">
                                    <img src="https://picsum.photos/seed/composer{{ $i }}/300/300" alt="Composer {{ $i }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                </a>
                            </div>
                            <a href="{{ route('composer.profile', $i) }}" class="hover:text-red-500 transition-colors">
                                <h3 class="font-semibold text-center" title="Composer {{ $i }}">Composer {{ $i }}</h3>
                            </a>
                            <p class="text-sm text-gray-400 text-center">{{ ['Classical', 'Film Score', 'Contemporary', 'Minimalist', 'Orchestral'][$i % 5] }}</p>
                            <p class="text-xs text-gray-500 mt-1 text-center">{{ rand(5, 25) }} compositions</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <!-- Featured Composition -->
    <section class="mb-10">
        <div class="relative rounded-xl overflow-hidden mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-indigo-900 opacity-90"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-image: url('https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=1470&auto=format&fit=crop')">
            </div>

            <div class="relative z-10 p-8 md:p-12">
                <div class="max-w-3xl">
                    <span class="text-sm bg-white/20 text-white px-2 py-1 rounded-full">Featured Composition</span>
                    <h1 class="text-3xl md:text-4xl font-bold mt-3 mb-2">The Art of Composition</h1>
                    <p class="text-gray-300 mb-6">Explore the creative process behind the most beautiful musical compositions.</p>

                    <div class="flex items-center gap-4 mb-6">
                        <img src="https://picsum.photos/seed/feat101/100/100" class="w-16 h-16 rounded-full" alt="Featured composer">
                        <div>
                            <h3 class="font-bold text-xl">Hans Zimmer</h3>
                            <p class="text-sm text-gray-300">Film Score Composer</p>
                        </div>
                    </div>

                    <button class="bg-white text-indigo-900 hover:bg-gray-200 transition-colors px-5 py-2.5 rounded-full font-medium flex items-center gap-2 w-fit">
                        <i class="ti ti-player-play"></i> Listen to Featured Works
                    </button>
                </div>
            </div>
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

            // Category navigation pill click
            const categoryPills = document.querySelectorAll('.category-pill');

            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    categoryPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
@endsection
