@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Popular Songs</h2>
            <div class="text-gray-400">Top trending tracks loved by our community</div>
        </div>
    </div>

    <!-- Category Navigation -->
    <div class="category-nav mb-6" data-aos="fade-up" data-aos-delay="100">
        <div class="category-pill active">All</div>
        <div class="category-pill">Pop</div>
        <div class="category-pill">Rock</div>
        <div class="category-pill">Hip Hop</div>
        <div class="category-pill">R&B</div>
        <div class="category-pill">Electronic</div>
        <div class="category-pill">Jazz</div>
        <div class="category-pill">Classical</div>
    </div>

    <!-- Popular Songs Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Popular Tracks</h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
            @for ($i = 1; $i <= 12; $i++)
                <div class="scroll-item music-card-item" id="recently-item-music"
                    data-id="123" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <div class="relative group overflow-hidden rounded-lg">
       
                        <div
                            class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            #{{ $index + 1 }}
                        </div>
                        <img src="{{ $song['img'] }}" alt="{{ $song['title'] }}"
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
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $song['title'] }}">{{ $song['title'] }}
                        </h3>
                        <p class="text-sm text-gray-400 truncate" title="{{ $song['artist'] }}">{{ $song['artist'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- New Releases Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold flex items-center gap-2">
                New Hits
                <span class="bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">New</span>
            </h2>
        </div>

        <div class="scroll-container">
            @php
                $newReleases = [
                    [
                        'title' => 'Midnight Rain',
                        'artist' => 'Taylor Swift',
                        'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300',
                    ],
                    [
                        'title' => 'Last Night',
                        'artist' => 'Morgan Wallen',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'title' => 'Flowers',
                        'artist' => 'Miley Cyrus',
                        'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300',
                    ],
                    [
                        'title' => 'Kill Bill',
                        'artist' => 'SZA',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'title' => 'Anti-Hero',
                        'artist' => 'Taylor Swift',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                    ],
                    [
                        'title' => 'Unholy',
                        'artist' => 'Sam Smith',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                    ],
                    [
                        'title' => 'As It Was',
                        'artist' => 'Harry Styles',
                        'img' => 'https://images.unsplash.com/photo-1587653263995-422546a7a559?q=80&w=300',
                    ],
                    [
                        'title' => 'About Damn Time',
                        'artist' => 'Lizzo',
                        'img' => 'https://images.unsplash.com/photo-1526218626217-dc65a29bb444?q=80&w=300',
                    ],
                    [
                        'title' => 'Stay With Me',
                        'artist' => 'Calvin Harris',
                        'img' => 'https://images.unsplash.com/photo-1571266028997-41675a1b9b1f?q=80&w=300',
                    ],
                    [
                        'title' => 'Break My Soul',
                        'artist' => 'Beyoncé',
                        'img' => 'https://images.unsplash.com/photo-1513883049090-d91fb58d69e1?q=80&w=300',
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
                        <img src="{{ $release['img'] }}" alt="{{ $release['title'] }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110 group-hover:opacity-70">
                        <div
                            class="overflow-hidden rounded-full aspect-square border-2 border-transparent group-hover:border-red-500 transition-all duration-300">
                            <img src="https://picsum.photos/300/300?random={{ $index + 900 }}" alt="{{ $artist }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $release['title'] }}">
                            {{ $release['title'] }}</h3>
                        <p class="text-sm text-gray-400 truncate" title="{{ $release['artist'] }}">
                            {{ $release['artist'] }}</p>
                    </div>
                </div>
            @endforeach
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
