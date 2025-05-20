@extends('layouts.landing-page')

@section('content')
<div class="mb-8">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl md:text-3xl font-bold">Your Recently Played Tracks</h1>
    </div>

    <!-- Recently Played Cards -->
    <div class="mb-8">
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @php
                $recentSongs = [
                    [
                        'title' => 'Blinding Lights',
                        'artist' => 'The Weeknd',
                        'album' => 'After Hours',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                        'played' => 'Today'
                    ],
                    [
                        'title' => 'Bad Guy',
                        'artist' => 'Billie Eilish',
                        'album' => 'When We All Fall Asleep, Where Do We Go?',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                        'played' => 'Today'
                    ],
                    [
                        'title' => 'Stay',
                        'artist' => 'The Kid LAROI, Justin Bieber',
                        'album' => 'F*CK LOVE 3: OVER YOU',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                        'played' => 'Yesterday'
                    ],
                    [
                        'title' => 'Levitating',
                        'artist' => 'Dua Lipa',
                        'album' => 'Future Nostalgia',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                        'played' => 'Yesterday'
                    ],
                    [
                        'title' => 'Anti-Hero',
                        'artist' => 'Taylor Swift',
                        'album' => 'Midnights',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                        'played' => '2 days ago'
                    ],
                    [
                        'title' => 'As It Was',
                        'artist' => 'Harry Styles',
                        'album' => "Harry's House",
                        'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300',
                        'played' => '2 days ago'
                    ],
                    [
                        'title' => 'Shivers',
                        'artist' => 'Ed Sheeran',
                        'album' => '=',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                        'played' => '3 days ago'
                    ],
                    [
                        'title' => 'STAY',
                        'artist' => 'The Kid LAROI, Justin Bieber',
                        'album' => 'F*CK LOVE 3: OVER YOU',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                        'time' => '2:21',
                        'played' => '3 days ago'
                    ],
                    [
                        'title' => 'Easy On Me',
                        'artist' => 'Adele',
                        'album' => '30',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                        'played' => '4 days ago'
                    ],
                    [
                        'title' => 'Woman',
                        'artist' => 'Doja Cat',
                        'album' => 'Planet Her',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                        'played' => '4 days ago'
                    ],
                    [
                        'title' => 'INDUSTRY BABY',
                        'artist' => 'Lil Nas X, Jack Harlow',
                        'album' => 'MONTERO',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                        'played' => '5 days ago'
                    ],
                    [
                        'title' => 'MONTERO (Call Me By Your Name)',
                        'artist' => 'Lil Nas X',
                        'album' => 'MONTERO',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                        'played' => '5 days ago'
                    ],
                    [
                        'title' => 'good 4 u',
                        'artist' => 'Olivia Rodrigo',
                        'album' => 'SOUR',
                        'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300',
                        'played' => '6 days ago'
                    ],
                    [
                        'title' => 'Kiss Me More',
                        'artist' => 'Doja Cat ft. SZA',
                        'album' => 'Planet Her',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                        'played' => '6 days ago'
                    ],
                    [
                        'title' => 'Peaches',
                        'artist' => 'Justin Bieber ft. Daniel Caesar, Giveon',
                        'album' => 'Justice',
                        'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300',
                        'played' => '1 week ago'
                    ],
                    [
                        'title' => 'drivers license',
                        'artist' => 'Olivia Rodrigo',
                        'album' => 'SOUR',
                        'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300',
                        'played' => '1 week ago'
                    ],
                    [
                        'title' => 'Butter',
                        'artist' => 'BTS',
                        'album' => 'Butter',
                        'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300',
                        'played' => '1 week ago'
                    ],
                    [
                        'title' => 'Mood',
                        'artist' => '24kGoldn ft. iann dior',
                        'album' => 'El Dorado',
                        'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300',
                        'played' => '1 week ago'
                    ],
                    [
                        'title' => 'Save Your Tears',
                        'artist' => 'The Weeknd',
                        'album' => 'After Hours',
                        'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300',
                        'played' => '1 week ago'
                    ],
                    [
                        'title' => 'Heartbreak Anniversary',
                        'artist' => 'Giveon',
                        'album' => 'Take Time',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300',
                        'played' => '2 weeks ago'
                    ],
                ];
            @endphp

            @foreach($recentSongs as $index => $song)
                <div class="bg-[var(--color-bg-card)] rounded-lg overflow-hidden group hover:bg-[var(--color-bg-hover)] transition duration-300">
                    <div class="relative">
                        <img src="{{ $song['img'] }}" alt="{{ $song['title'] }}" class="w-full aspect-square object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="w-12 h-12 rounded-full bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] flex items-center justify-center transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 left-2">
                            <span class="bg-black/50 text-white/90 text-xs px-2 py-1 rounded-full">{{ $song['played'] }}</span>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="font-medium truncate">{{ $song['title'] }}</div>
                        <div class="text-sm text-gray-400 truncate mt-1">{{ $song['artist'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recommendations Based on History -->
    <h2 class="text-xl font-bold mb-4">Recommended Based on Your History</h2>
    
    <div class="scroll-container pb-4">
        @php
            $recommendedSongs = [
                ['title' => 'Die For You', 'artist' => 'The Weeknd', 'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300'],
                ['title' => 'Cruel Summer', 'artist' => 'Taylor Swift', 'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300'],
                ['title' => 'Physical', 'artist' => 'Dua Lipa', 'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300'],
                ['title' => 'Ghost', 'artist' => 'Justin Bieber', 'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300'],
                ['title' => 'traitor', 'artist' => 'Olivia Rodrigo', 'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300'],
                ['title' => 'Dynamite', 'artist' => 'BTS', 'img' => 'https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=300'],
                ['title' => 'After Hours', 'artist' => 'The Weeknd', 'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=300'],
                ['title' => 'Anti-Hero', 'artist' => 'Taylor Swift', 'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300'],
                ['title' => 'New Rules', 'artist' => 'Dua Lipa', 'img' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=300'],
                ['title' => 'Sorry', 'artist' => 'Justin Bieber', 'img' => 'https://images.unsplash.com/photo-1496293455970-f8581aae0e3b?q=80&w=300'],
            ];
        @endphp

        @foreach($recommendedSongs as $song)
            <div class="scroll-item music-card-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="relative group overflow-hidden rounded-xl">
                    <img src="{{ $song['img'] }}" alt="{{ $song['title'] }}" 
                        class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                        <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                            <i class="ti ti-player-play text-white text-xl"></i>
                        </div>
                    </button>
                </div>
                <div class="mt-3">
                    <h3 class="font-semibold text-base truncate" title="{{ $song['title'] }}">{{ $song['title'] }}</h3>
                    <p class="text-sm text-gray-400 truncate" title="{{ $song['artist'] }}">{{ $song['artist'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div> 
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize animations for scroll items
        document.querySelectorAll('.scroll-item').forEach((item, index) => {
            item.style.setProperty('--index', index);
        });

        // Smooth scrolling for horizontal containers
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
