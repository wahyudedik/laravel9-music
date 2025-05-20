@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Cover Songs</h2>
            <div class="text-gray-400">Discover amazing new interpretations of your favorite tracks</div>
        </div>
    </div>

    <!-- Category Navigation -->
    <div class="category-nav mb-6" data-aos="fade-up" data-aos-delay="100">
        <div class="category-pill active">All</div>
        <div class="category-pill">Pop</div>
        <div class="category-pill">Rock</div>
        <div class="category-pill">Acoustic</div>
        <div class="category-pill">Electronic</div>
        <div class="category-pill">Viral</div>
        <div class="category-pill">Jazz</div>
        <div class="category-pill">Classical</div>
    </div>

    <!-- Featured Covers -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5" data-aos="fade-up" data-aos-delay="150">
            <h2 class="section-title text-2xl font-bold">Featured Covers</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @php
                $featuredCovers = [
                    [
                        'title' => 'Nothing Compares 2 U',
                        'artist' => 'Sinéad O\'Connor',
                        'original' => 'Prince',
                        'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300',
                        'id' => 1,
                    ],
                    [
                        'title' => 'Hurt',
                        'artist' => 'Johnny Cash',
                        'original' => 'Nine Inch Nails',
                        'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300',
                        'id' => 2,
                    ],
                    [
                        'title' => 'Sound of Silence',
                        'artist' => 'Disturbed',
                        'original' => 'Simon & Garfunkel',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                        'id' => 3,
                    ],
                ];
            @endphp

            @foreach ($featuredCovers as $cover)
                <div class="relative rounded-lg overflow-hidden group" data-aos="fade-up"
                    data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent z-10"></div>
                    <img src="{{ $cover['img'] }}" alt="{{ $cover['title'] }}"
                        class="w-full h-64 object-cover object-center transition-transform duration-500 group-hover:scale-110">

                    <div class="absolute top-4 right-4 z-20">
                        <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">FEATURED</span>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-6 z-20">
                        <h3 class="text-xl font-bold mb-1">{{ $cover['title'] }}</h3>
                        <div class="flex items-center gap-2 mb-2">
                            <a href="{{ route('cover.profile', $cover['id']) }}"
                                class="hover:text-red-500 transition-colors">
                                <p class="text-sm">{{ $cover['artist'] }}</p>
                            </a>
                            <span class="text-xs text-gray-400">•</span>
                            <p class="text-xs text-gray-400">Originally by <span
                                    class="text-white">{{ $cover['original'] }}</span></p>
                        </div>

                        <div class="flex items-center gap-2 mt-4">
                            <button
                                class="bg-red-600 hover:bg-red-700 transition-colors rounded-full w-12 h-12 flex items-center justify-center">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                            <a href="{{ route('cover.profile', $cover['id']) }}"
                                class="py-2 px-4 bg-white/10 hover:bg-white/20 transition-colors text-sm rounded-full flex items-center gap-2">
                                <i class="ti ti-info-circle"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Popular Covers -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Popular Covers</h2>
        </div>

        <div class="scroll-container">
            @php
                $popularCovers = [
                    [
                        'title' => 'Zombie',
                        'artist' => 'Bad Wolves',
                        'original' => 'The Cranberries',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                        'id' => 4,
                    ],
                    [
                        'title' => 'Mad World',
                        'artist' => 'Gary Jules',
                        'original' => 'Tears for Fears',
                        'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300',
                        'id' => 5,
                    ],
                    [
                        'title' => 'Take On Me',
                        'artist' => 'A-ha (MTV Unplugged)',
                        'original' => 'A-ha',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                        'id' => 6,
                    ],
                    [
                        'title' => 'Hallelujah',
                        'artist' => 'Jeff Buckley',
                        'original' => 'Leonard Cohen',
                        'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300',
                        'id' => 7,
                    ],
                    [
                        'title' => 'All Along the Watchtower',
                        'artist' => 'Jimi Hendrix',
                        'original' => 'Bob Dylan',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                        'id' => 8,
                    ],
                    [
                        'title' => 'I Will Always Love You',
                        'artist' => 'Whitney Houston',
                        'original' => 'Dolly Parton',
                        'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300',
                        'id' => 9,
                    ],
                    [
                        'title' => 'Valerie',
                        'artist' => 'Amy Winehouse',
                        'original' => 'The Zutons',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                        'id' => 10,
                    ],
                    [
                        'title' => 'Sweet Dreams',
                        'artist' => 'Marilyn Manson',
                        'original' => 'Eurythmics',
                        'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300',
                        'id' => 11,
                    ],
                ];
            @endphp

            @foreach ($popularCovers as $cover)
                <div class="scroll-item cover-card">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="{{ $cover['img'] }}" alt="{{ $cover['title'] }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
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
                        <a href="{{ route('cover.profile', $cover['id']) }}" class="hover:text-red-500 transition-colors">
                            <h3 class="font-semibold text-base truncate" title="{{ $cover['title'] }}">
                                {{ $cover['title'] }}</h3>
                        </a>
                        <p class="text-sm text-gray-400 truncate" title="{{ $cover['artist'] }}">{{ $cover['artist'] }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Originally by <span
                                class="text-red-500">{{ $cover['original'] }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Recent Covers -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">New Covers</h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @php
                $newCovers = [
                    [
                        'title' => 'Running Up That Hill',
                        'artist' => 'Meg Myers',
                        'original' => 'Kate Bush',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                        'id' => 12,
                    ],
                    [
                        'title' => 'Feeling Good',
                        'artist' => 'Muse',
                        'original' => 'Nina Simone',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                        'id' => 13,
                    ],
                    [
                        'title' => 'Enjoy the Silence',
                        'artist' => 'Lacuna Coil',
                        'original' => 'Depeche Mode',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                        'id' => 14,
                    ],
                    [
                        'title' => 'Landslide',
                        'artist' => 'The Smashing Pumpkins',
                        'original' => 'Fleetwood Mac',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                        'id' => 15,
                    ],
                    [
                        'title' => 'Jolene',
                        'artist' => 'The White Stripes',
                        'original' => 'Dolly Parton',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                        'id' => 16,
                    ],
                    [
                        'title' => 'Imagine',
                        'artist' => 'A Perfect Circle',
                        'original' => 'John Lennon',
                        'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300',
                        'id' => 17,
                    ],
                    [
                        'title' => 'Bitter Sweet Symphony',
                        'artist' => 'Taylor Swift',
                        'original' => 'The Verve',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                        'id' => 18,
                    ],
                    [
                        'title' => 'Love Will Tear Us Apart',
                        'artist' => 'Nouvelle Vague',
                        'original' => 'Joy Division',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                        'id' => 19,
                    ],
                    [
                        'title' => 'Careless Whisper',
                        'artist' => 'Seether',
                        'original' => 'George Michael',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                        'id' => 20,
                    ],
                    [
                        'title' => 'Wonderwall',
                        'artist' => 'Ryan Adams',
                        'original' => 'Oasis',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                        'id' => 21,
                    ],
                ];
            @endphp

            @foreach ($newCovers as $cover)
                <div class="music-card-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <div class="absolute top-2 right-2 z-10">
                            <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded-full">NEW</span>
                        </div>
                        <img src="{{ $cover['img'] }}" alt="{{ $cover['title'] }}"
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
                        <a href="{{ route('cover.profile', $cover['id']) }}" class="hover:text-red-500 transition-colors">
                            <h3 class="font-semibold text-base truncate" title="{{ $cover['title'] }}">
                                {{ $cover['title'] }}</h3>
                        </a>
                        <p class="text-sm text-gray-400 truncate" title="{{ $cover['artist'] }}">{{ $cover['artist'] }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Originally by <span
                                class="text-red-500">{{ $cover['original'] }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Cover Creator Highlight -->
    <section class="mb-10">
        <div class="relative rounded-xl overflow-hidden mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-900 to-pink-800 opacity-90"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-image: url('https://images.unsplash.com/photo-1471478331149-c72f17e33c73?q=80&w=1470&auto=format&fit=crop')">
            </div>

            <div class="relative z-10 p-8 md:p-12">
                <div class="max-w-3xl">
                    <span class="text-sm bg-white/20 text-white px-2 py-1 rounded-full">BECOME A CREATOR</span>
                    <h1 class="text-3xl md:text-4xl font-bold mt-3 mb-2">Create Your Own Covers</h1>
                    <p class="text-gray-300 mb-6">Join our community of cover creators and share your unique
                        interpretations with the world.</p>

                    <button
                        class="bg-white text-purple-900 hover:bg-gray-200 transition-colors px-5 py-2.5 rounded-full font-medium flex items-center gap-2 w-fit">
                        <i class="ti ti-music"></i> Start Creating
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
