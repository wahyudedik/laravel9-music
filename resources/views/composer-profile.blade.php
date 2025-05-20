@extends('layouts.landing-page')

@section('content')
<div class="mb-8">
    @php
        $composer = [
            'id' => $id,
            'name' => 'Composer ' . $id,
            'genre' => ['Contemporary Classical', 'Film Score', 'Orchestral', 'Minimalist'][$id % 4],
            'bio' => 'A renowned composer with a unique style, known for creating emotional and powerful compositions that resonate with audiences worldwide.',
            'image' => 'https://picsum.photos/seed/composer' . $id . '/400/400',
            'banner' => 'https://picsum.photos/seed/comp' . $id . '/1200/400',
            'followers' => rand(10, 100) . 'K',
            'compositions' => rand(20, 50),
            'awards' => rand(3, 15),
        ];
        
        $topTracks = [
            ['title' => 'Opus ' . rand(1, 99), 'year' => rand(2010, 2023), 'duration' => '4:' . rand(10, 59)],
            ['title' => 'Symphony No. ' . rand(1, 9), 'year' => rand(2010, 2023), 'duration' => '6:' . rand(10, 59)],
            ['title' => 'Requiem for a ' . ['Dream', 'Memory', 'Life', 'Soul'][$id % 4], 'year' => rand(2010, 2023), 'duration' => '5:' . rand(10, 59)],
            ['title' => 'Piano Concerto in ' . ['C Minor', 'D Major', 'G Minor', 'A Major'][$id % 4], 'year' => rand(2010, 2023), 'duration' => '7:' . rand(10, 59)],
            ['title' => 'The ' . ['Journey', 'Awakening', 'Revelation', 'Discovery'][$id % 4], 'year' => rand(2010, 2023), 'duration' => '3:' . rand(10, 59)],
        ];
        
        $albums = [
            ['title' => 'Orchestral Works Vol. ' . rand(1, 3), 'year' => rand(2015, 2023), 'tracks' => rand(8, 12), 'img' => 'https://picsum.photos/seed/comp_album' . ($id*2) . '/300/300'],
            ['title' => 'Film Scores Collection', 'year' => rand(2015, 2023), 'tracks' => rand(8, 12), 'img' => 'https://picsum.photos/seed/comp_album' . ($id*3) . '/300/300'],
            ['title' => 'Piano Compositions', 'year' => rand(2015, 2023), 'tracks' => rand(8, 12), 'img' => 'https://picsum.photos/seed/comp_album' . ($id*4) . '/300/300'],
            ['title' => 'Ambient Soundscapes', 'year' => rand(2015, 2023), 'tracks' => rand(8, 12), 'img' => 'https://picsum.photos/seed/comp_album' . ($id*5) . '/300/300'],
        ];
    @endphp

    <!-- Composer Header Section -->
    <div class="relative mb-8">
        <!-- Banner Image -->
        <div class="h-48 md:h-64 lg:h-80 w-full overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-transparent z-10"></div>
            <img src="{{ $composer['banner'] }}" alt="{{ $composer['name'] }}" class="w-full h-full object-cover">
        </div>
        
        <!-- Composer Info Overlay -->
        <div class="absolute bottom-0 left-0 right-0 p-6 z-20 flex flex-col md:flex-row items-start md:items-end gap-4">
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-gray-900 overflow-hidden bg-gray-800 flex-shrink-0">
                <img src="{{ $composer['image'] }}" alt="{{ $composer['name'] }}" class="w-full h-full object-cover">
            </div>
            
            <div class="flex-grow">
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold">{{ $composer['name'] }}</h1>
                <p class="text-gray-400 text-sm md:text-base mt-1">{{ $composer['genre'] }}</p>
                
                <div class="flex items-center gap-4 mt-3">
                    <div class="text-sm text-gray-300"><i class="ti ti-users mr-1"></i> {{ $composer['followers'] }} followers</div>
                    <div class="text-sm text-gray-300"><i class="ti ti-music mr-1"></i> {{ $composer['compositions'] }} compositions</div>
                    <div class="text-sm text-gray-300"><i class="ti ti-award mr-1"></i> {{ $composer['awards'] }} awards</div>
                </div>
            </div>
            
            <div class="flex gap-2 mt-4 md:mt-0">
                <button class="bg-transparent border border-gray-600 hover:border-white transition-colors py-2 px-4 rounded-full flex items-center gap-2">
                    <i class="ti ti-user-plus"></i> Follow
                </button>
            </div>
        </div>
    </div>
    
    <!-- Bio Section -->
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">About {{ $composer['name'] }}</h2>
        <p class="text-gray-300">{{ $composer['bio'] }}</p>
        <p class="text-gray-300 mt-3">Known for creating intricate compositions that blend traditional orchestral elements with contemporary influences, {{ $composer['name'] }} has established a unique musical identity in the {{ $composer['genre'] }} genre.</p>
    </section>
    
    <!-- Top Songs Section -->
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Popular Song</h2>
        
        <div class="bg-gray-800/50 rounded-lg overflow-hidden">
            @foreach($topTracks as $index => $track)
                <div class="flex items-center p-3 hover:bg-gray-700/50 transition-colors {{ $index < count($topTracks) - 1 ? 'border-b border-gray-700' : '' }}">
                    <div class="w-8 text-center text-gray-400">{{ $index + 1 }}</div>
                    <div class="flex-grow ml-3">
                        <div class="font-medium">{{ $track['title'] }}</div>
                        <div class="text-sm text-gray-400">{{ $track['year'] }}</div>
                    </div>
                    <div class="text-sm text-gray-400 mr-4">{{ $track['duration'] }}</div>
                    <button class="text-gray-400 hover:text-white transition-colors">
                        <i class="ti ti-player-play"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </section>
    
    <!-- Albums Section -->
    <section class="mb-10">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-xl font-bold">Albums & Songs</h2>
        </div>
        
        <div class="scroll-container">
            @foreach($albums as $album)
                <div class="scroll-item music-card-item">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="{{ $album['img'] }}" alt="{{ $album['title'] }}" 
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $album['title'] }}">{{ $album['title'] }}</h3>
                        <p class="text-sm text-gray-400">{{ $album['year'] }} • {{ $album['tracks'] }} tracks</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    
    <!-- Similar Composers -->
    <section class="mb-10">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-xl font-bold">Similar Composers</h2>
        </div>
        
        <div class="scroll-container">
            @for($i = 1; $i <= 6; $i++)
                @php
                    $similarId = ($id + $i) % 10 + 1;
                @endphp
                <div class="scroll-item composer-card">
                    <div class="relative group">
                        <div class="overflow-hidden rounded-full border-2 border-gray-700 aspect-square group-hover:border-red-500 transition-all duration-300">
                            <a href="{{ route('composer.profile', $similarId) }}">
                                <img src="https://picsum.photos/seed/composer{{ $similarId }}/300/300" alt="Composer {{ $similarId }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </a>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('composer.profile', $similarId) }}" class="hover:text-red-500 transition-colors">
                            <h3 class="font-semibold truncate" title="Composer {{ $similarId }}">Composer {{ $similarId }}</h3>
                        </a>
                        <p class="text-sm text-gray-400 truncate">{{ ['Classical', 'Film Score', 'Contemporary', 'Minimalist'][$similarId % 4] }}</p>
                    </div>
                </div>
            @endfor
        </div>
    </section>
    
    <!-- Featured Works Section -->
    <section class="mb-10">
        <div class="relative rounded-xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-indigo-900 opacity-90"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-image: url('https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=1470&auto=format&fit=crop')">
            </div>

            <div class="relative z-10 p-6 md:p-8">
                <div class="max-w-3xl">
                    <span class="text-sm bg-white/20 text-white px-2 py-1 rounded-full">FEATURED WORK</span>
                    <h1 class="text-2xl md:text-3xl font-bold mt-3 mb-2">{{ $topTracks[0]['title'] }}</h1>
                    <p class="text-gray-300 mb-4">Experience this acclaimed composition that showcases the unique style and artistic vision of {{ $composer['name'] }}.</p>
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
    });
</script>
@endsection