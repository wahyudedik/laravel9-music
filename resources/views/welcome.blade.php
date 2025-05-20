@extends('layouts.landing-page')

@section('content')
    <!-- Category Navigation -->
    <div class="category-nav mb-6">
        <div class="category-pill active">Untuk Anda</div>
        <div class="category-pill">Tangga Lagu</div>
        <div class="category-pill">Hip Hop</div>
        <div class="category-pill">Pop</div>
        <div class="category-pill">Rock</div>
        <div class="category-pill">R&B</div>
        <div class="category-pill">Electronic</div>
        <div class="category-pill">Jazz</div>
        <div class="category-pill">Classical</div>
        <div class="category-pill">Country</div>
        <div class="category-pill">Indie</div>
        <div class="category-pill">Metal</div>
        <div class="category-pill">Mood</div>
        <div class="category-pill">Workout</div>
        <div class="category-pill">Focus</div>
    </div>

    <!-- Hero Section -->
    <section class="mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="relative h-64 md:h-80 rounded-xl overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/20"></div>
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=1200"
                        class="w-full h-full object-cover" alt="Featured artist">
                    <div class="absolute bottom-0 left-0 p-6">

                        <span class="text-sm bg-red-600 text-white px-2 py-1 rounded-full">Featured Trend</span>
                        <h1 class="text-3xl font-bold mt-2 mb-1">This Week's Highlights</h1>
                        <p class="text-gray-300 mb-4">Discover the latest trending songs, artists, and etc.</p>
                        <a href="{{ route('trending') }}"
                            class="inline-flex bg-white text-black hover:bg-gray-200 font-medium py-2 px-4 rounded-full items-center gap-2 transition">
                            <i class="ti ti-player-play"></i> Listen Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden lg:block">
                <div
                    class="rounded-xl overflow-hidden bg-gradient-to-br from-blue-700 to-purple-700 p-5 h-80 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-bold mb-1">Your Daily Mix</h2>
                        <p class="text-white/80 text-sm">Musik yang dipersonalisasi hanya untuk Anda</p>
                    </div>
                    <div>
                        <div class="flex -space-x-4">
                            <img class="w-12 h-12 rounded-full border-2 border-blue-800" src="https://i.pravatar.cc/400"
                                alt="">
                            <img class="w-12 h-12 rounded-full border-2 border-blue-800" src="https://i.pravatar.cc/400"
                                alt="">
                            <img class="w-12 h-12 rounded-full border-2 border-blue-800"
                                src="https://images.unsplash.com/photo-1577805947697-89e18249d767?q=80&w=100"
                                alt="">


                        </div>
                        <p class="mt-4 mb-2 text-sm text-white/80">Based on your recent listening</p>
                        <a href="{{ route('mix_trending') }}"
                            class="mt-5 bg-white/20 hover:bg-white/30 text-white font-medium py-2 px-4 rounded-full text-sm transition">
                            Play Mix
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recently Played Section - horizontal scroll -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Recently Played</h2>
            <a href="{{ route('recently_played') }}"
                class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See All <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">

            @foreach ($songs as $song)
                @php
                    // Extract filename from the 3rd image variant (small)
                    $coverImages = explode(',', $song->cover_image ?? '');
                    $smallCoverFile = $coverImages[2] ?? null;
                    // Get just the filename from the path (e.g. "cover_abc_sm.jpeg")
                    $filename = $smallCoverFile ? basename($smallCoverFile) : null;
                    // Generate image URL via route
                    $imageUrl = $filename
                        ? route('songs.image', ['filename' => $filename])
                        : 'https://via.placeholder.com/500/500?random=' . $song->id;
                @endphp
                @php
                    $creatorName =
                        $song->songContributors
                            ->where('role', 'Composer')
                            ->pluck('user.name')
                            ->filter()
                            ->implode(', ') ?? '-';

                    if (empty($creatorName)) {
                        $creatorName = '-';
                    }

                    $artistName =
                        $song->songContributors
                            ->where('role', 'Artist')
                            ->pluck('user.name')
                            ->filter()
                            ->implode(', ') ?? '-';

                    if (empty($artistName)) {
                        $artistName = 'No Artist';
                    }
                @endphp

                <div class="scroll-item music-card-item" data-aos="fade-up" data-aos-delay="{{ 1 * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="{{ $imageUrl }}" alt="{{ $song->title }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center"
                            {{ Auth::guest() ? 'data-login-required=true onclick=window.location.href=\'' . route('login') . '\'' : '' }}

                            data-title="{{ $song->title }}"
                            data-artist="{{ $artistName }}"
                            data-cover="{{ $imageUrl }}"
                            data-id="{{ $song->id }}" data-duration="{{ rand(180, 320) }}"

                            >
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $song->title }}">{{ $song->title }}</h3>
                        <p class="text-sm text-gray-400 truncate" title="{{ $artistName }}">{{ $artistName }}</p>
                    </div>
                </div>
            @endforeach


            @php
                $recentSongs = [
                    [
                        'title' => 'Blinding Lights',
                        'artist' => 'The Weeknd',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                    ],
                    [
                        'title' => 'Bad Guy',
                        'artist' => 'Billie Eilish',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'title' => 'Stay',
                        'artist' => 'The Kid LAROI, Justin Bieber',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                    ],
                    [
                        'title' => 'Levitating',
                        'artist' => 'Dua Lipa',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                    ],
                    [
                        'title' => 'Anti-Hero',
                        'artist' => 'Taylor Swift',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'title' => 'As It Was',
                        'artist' => 'Harry Styles',
                        'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300',
                    ],
                    [
                        'title' => 'Blinding Lights',
                        'artist' => 'The Weeknd',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                    ],
                    [
                        'title' => 'Bad Guy',
                        'artist' => 'Billie Eilish',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'title' => 'Stay',
                        'artist' => 'The Kid LAROI, Justin Bieber',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                    ],
                    [
                        'title' => 'Levitating',
                        'artist' => 'Dua Lipa',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                    ],
                    [
                        'title' => 'Anti-Hero',
                        'artist' => 'Taylor Swift',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'title' => 'As It Was',
                        'artist' => 'Harry Styles',
                        'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300',
                    ],
                ];
            @endphp

            @foreach ($recentSongs as $song)
                <div class="scroll-item music-card-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="{{ $song['img'] }}" alt="{{ $song['title'] }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center"
                            {{ Auth::guest() ? 'data-login-required=true onclick=window.location.href=\'' . route('login') . '\'' : '' }}>
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

    <!-- Popular Artists Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Popular Artists</h2>
            <a href="{{ route('artists') }}"
                class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See All <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $popularArtists = [
                    [
                        'name' => 'Taylor Swift',
                        'img' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=300',
                    ],
                    [
                        'name' => 'The Weeknd',
                        'img' => 'https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=300',
                    ],
                    [
                        'name' => 'Drake',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'name' => 'Dua Lipa',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                    ],
                    [
                        'name' => 'Ed Sheeran',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'name' => 'Billie Eilish',
                        'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300',
                    ],
                    [
                        'name' => 'Taylor Swift',
                        'img' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=300',
                    ],
                    [
                        'name' => 'The Weeknd',
                        'img' => 'https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=300',
                    ],
                    [
                        'name' => 'Drake',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'name' => 'Dua Lipa',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                    ],
                    [
                        'name' => 'Ed Sheeran',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'name' => 'Billie Eilish',
                        'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300',
                    ],
                ];
            @endphp

            @foreach ($popularArtists as $artist)
                <div class="scroll-item artist-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="relative group">
                        <a href="{{ route('artist.profile', $loop->index + 1) }}" class="block">
                            <div
                                class="overflow-hidden rounded-full aspect-square border-2 border-transparent group-hover:border-red-500 transition-all duration-300">
                                <img src="{{ $artist['img'] }}" alt="{{ $artist['name'] }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                        </a>
                    </div>
                    <h3 class="font-medium mt-3 text-center truncate" title="{{ $artist['name'] }}">
                        {{ $artist['name'] }}
                    </h3>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Trending Songs Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Trending Songs</h2>
            <a href="{{ route('popular-songs') }}"
                class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See All <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">

            @php
                $trendingSongs = [
                    [
                        'title' => 'Anti-Hero',
                        'artist' => 'Taylor Swift',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                    ],
                    [
                        'title' => 'Blinding Lights',
                        'artist' => 'The Weeknd',
                        'img' => 'https://images.unsplash.com/photo-1504509546545-e000b4a62425?q=80&w=300',
                    ],
                    [
                        'title' => 'Rich Flex',
                        'artist' => 'Drake',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                    ],
                    [
                        'title' => 'Levitating',
                        'artist' => 'Dua Lipa',
                        'img' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=300',
                    ],
                    [
                        'title' => 'Shape of You',
                        'artist' => 'Ed Sheeran',
                        'img' => 'https://images.unsplash.com/photo-1468164016595-6108e4c60c8b?q=80&w=300',
                    ],
                    [
                        'title' => 'bad guy',
                        'artist' => 'Billie Eilish',
                        'img' => 'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?q=80&w=300',
                    ],
                    [
                        'title' => 'Anti-Hero',
                        'artist' => 'Taylor Swift',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                    ],
                    [
                        'title' => 'Blinding Lights',
                        'artist' => 'The Weeknd',
                        'img' => 'https://images.unsplash.com/photo-1504509546545-e000b4a62425?q=80&w=300',
                    ],
                    [
                        'title' => 'Rich Flex',
                        'artist' => 'Drake',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                    ],
                    [
                        'title' => 'Levitating',
                        'artist' => 'Dua Lipa',
                        'img' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=300',
                    ],
                    [
                        'title' => 'Shape of You',
                        'artist' => 'Ed Sheeran',
                        'img' => 'https://images.unsplash.com/photo-1468164016595-6108e4c60c8b?q=80&w=300',
                    ],
                    [
                        'title' => 'bad guy',
                        'artist' => 'Billie Eilish',
                        'img' => 'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?q=80&w=300',
                    ],
                ];
            @endphp

            @foreach ($trendingSongs as $index => $song)
                <div class="scroll-item music-card-item">
                    <div class="relative group overflow-hidden rounded-xl">
                        <div
                            class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                            #{{ $index + 1 }}
                        </div>
                        <img src="{{ $song['img'] }}" alt="{{ $song['title'] }}"
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
                        <h3 class="font-semibold text-base truncate" title="{{ $song['title'] }}">{{ $song['title'] }}
                        </h3>
                        <p class="text-sm text-gray-400 truncate" title="{{ $song['artist'] }}">{{ $song['artist'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Cover Songs Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Cover Songs</h2>
            <a href="{{ route('covers') }}"
                class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See All <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $coverSongs = [
                    [
                        'title' => 'Zombie (Cover)',
                        'artist' => 'Bad Wolves',
                        'original' => 'The Cranberries',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'title' => 'Hurt (Cover)',
                        'artist' => 'Johnny Cash',
                        'original' => 'Nine Inch Nails',
                        'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300',
                    ],
                    [
                        'title' => 'Sound of Silence (Cover)',
                        'artist' => 'Disturbed',
                        'original' => 'Simon & Garfunkel',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'title' => 'Nothing Compares 2 U (Cover)',
                        'artist' => 'Sinéad O\'Connor',
                        'original' => 'Prince',
                        'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300',
                    ],
                    [
                        'title' => 'Zombie (Cover)',
                        'artist' => 'Bad Wolves',
                        'original' => 'The Cranberries',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'title' => 'Hurt (Cover)',
                        'artist' => 'Johnny Cash',
                        'original' => 'Nine Inch Nails',
                        'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300',
                    ],
                    [
                        'title' => 'Sound of Silence (Cover)',
                        'artist' => 'Disturbed',
                        'original' => 'Simon & Garfunkel',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'title' => 'Nothing Compares 2 U (Cover)',
                        'artist' => 'Sinéad O\'Connor',
                        'original' => 'Prince',
                        'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300',
                    ],
                    [
                        'title' => 'Zombie (Cover)',
                        'artist' => 'Bad Wolves',
                        'original' => 'The Cranberries',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'title' => 'Hurt (Cover)',
                        'artist' => 'Johnny Cash',
                        'original' => 'Nine Inch Nails',
                        'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300',
                    ],
                    [
                        'title' => 'Sound of Silence (Cover)',
                        'artist' => 'Disturbed',
                        'original' => 'Simon & Garfunkel',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'title' => 'Nothing Compares 2 U (Cover)',
                        'artist' => 'Sinéad O\'Connor',
                        'original' => 'Prince',
                        'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300',
                    ],
                ];
            @endphp

            @foreach ($coverSongs as $song)
                <div class="scroll-item cover-card">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="{{ $song['img'] }}" alt="{{ $song['title'] }}"
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

    <!-- Popular Composers Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Popular Composers</h2>
            <a href="{{ route('composers') }}"
                class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See All <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $composers = [
                    [
                        'name' => 'Hans Zimmer',
                        'genre' => 'Film Score',
                        'img' => 'https://images.unsplash.com/photo-1507838153414-b4b713384a76?q=80&w=300',
                    ],
                    [
                        'name' => 'John Williams',
                        'genre' => 'Classical/Film',
                        'img' => 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=300',
                    ],
                    [
                        'name' => 'Ennio Morricone',
                        'genre' => 'Film Score',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'name' => 'Max Richter',
                        'genre' => 'Contemporary Classical',
                        'img' => 'https://images.unsplash.com/photo-1513883049090-d91fb58d69e1?q=80&w=300',
                    ],
                    [
                        'name' => 'Hans Zimmer',
                        'genre' => 'Film Score',
                        'img' => 'https://images.unsplash.com/photo-1507838153414-b4b713384a76?q=80&w=300',
                    ],
                    [
                        'name' => 'John Williams',
                        'genre' => 'Classical/Film',
                        'img' => 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=300',
                    ],
                    [
                        'name' => 'Ennio Morricone',
                        'genre' => 'Film Score',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'name' => 'Max Richter',
                        'genre' => 'Contemporary Classical',
                        'img' => 'https://images.unsplash.com/photo-1513883049090-d91fb58d69e1?q=80&w=300',
                    ],
                ];
            @endphp

            @foreach ($composers as $composer)
                <div class="scroll-item composer-card">
                    <a href="{{ route('composer.profile', $loop->index + 1) }}" class="block">
                        <div class="relative group">
                            <div
                                class="overflow-hidden rounded-full border-2 border-gray-700 aspect-square group-hover:border-red-500 transition-all duration-300">
                                <img src="{{ $composer['img'] }}" alt="{{ $composer['name'] }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <h3 class="font-semibold truncate" title="{{ $composer['name'] }}">{{ $composer['name'] }}
                            </h3>
                            <p class="text-sm text-gray-400 truncate" title="{{ $composer['genre'] }}">
                                {{ $composer['genre'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- New Releases Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold flex items-center gap-2">
                New Releases
                <span class="bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">New</span>
            </h2>
            <a href="#" class="section-link flex items-center gap-1 hover:text-red-500 transition-colors">
                See All <i class="ti ti-chevron-right text-sm"></i>
            </a>
        </div>

        <div class="scroll-container">
            @php
                $newReleases = [
                    [
                        'title' => 'Midnight Rain',
                        'artist' => 'Taylor Swift',
                        'date' => 'Oct 21, 2023',
                        'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300',
                    ],
                    [
                        'title' => 'Last Night',
                        'artist' => 'Morgan Wallen',
                        'date' => 'Oct 20, 2023',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                    ],
                    [
                        'title' => 'Flowers',
                        'artist' => 'Miley Cyrus',
                        'date' => 'Oct 19, 2023',
                        'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300',
                    ],
                    [
                        'title' => 'Kill Bill',
                        'artist' => 'SZA',
                        'date' => 'Oct 18, 2023',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                    ],
                    [
                        'title' => 'Anti-Hero',
                        'artist' => 'Taylor Swift',
                        'date' => 'Oct 17, 2023',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                    ],
                    [
                        'title' => 'Unholy',
                        'artist' => 'Sam Smith',
                        'date' => 'Oct 16, 2023',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                    ],
                    [
                        'title' => 'As It Was',
                        'artist' => 'Harry Styles',
                        'date' => 'Oct 15, 2023',
                        'img' => 'https://images.unsplash.com/photo-1587653263995-422546a7a559?q=80&w=300',
                    ],
                    [
                        'title' => 'About Damn Time',
                        'artist' => 'Lizzo',
                        'date' => 'Oct 14, 2023',
                        'img' => 'https://images.unsplash.com/photo-1526218626217-dc65a29bb444?q=80&w=300',
                    ],
                    [
                        'title' => 'Stay With Me',
                        'artist' => 'Calvin Harris',
                        'date' => 'Oct 13, 2023',
                        'img' => 'https://images.unsplash.com/photo-1571266028997-41675a1b9b1f?q=80&w=300',
                    ],
                    [
                        'title' => 'Break My Soul',
                        'artist' => 'Beyoncé',
                        'date' => 'Oct 12, 2023',
                        'img' => 'https://images.unsplash.com/photo-1513883049090-d91fb58d69e1?q=80&w=300',
                    ],
                ];
            @endphp

            @foreach ($newReleases as $index => $release)
                <div class="scroll-item new-release-card">
                    <div class="relative group overflow-hidden rounded-xl bg-gray-800/50">
                        <div class="absolute top-0 right-0 z-10">
                            <span class="bg-red-600 text-white text-xs px-2 py-1 opacity-80">NEW</span>
                        </div>
                        <img src="{{ $release['img'] }}" alt="{{ $release['title'] }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110 group-hover:opacity-70">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-40 group-hover:opacity-80 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                        <div
                            class="absolute bottom-0 left-0 right-0 p-3 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <div class="flex justify-between items-center">
                                <i class="ti ti-calendar text-xs"></i>
                                <span class="text-xs">{{ $release['date'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $release['title'] }}">
                            {{ $release['title'] }}</h3>
                        <p class="text-sm text-gray-400 truncate" title="{{ $release['artist'] }}">
                            {{ $release['artist'] }}</p>
                        <div class="flex items-center mt-1 text-xs text-gray-500">
                            <i class="ti ti-calendar text-red-500 mr-1"></i>
                            <span>Released {{ $release['date'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
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

                    // Here you would typically filter content based on the selected category
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
