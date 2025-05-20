@extends('layouts.landing-page')

@section('content')
<div class="mb-8">
    @php
        $coverTitle = [
            'Zombie',
            'Hurt',
            'Sound of Silence',
            'Nothing Compares 2 U',
            'All Along the Watchtower',
            'I Will Always Love You',
            'Mad World',
            'Take On Me',
            'Hallelujah',
            'Sweet Dreams'
        ][$id % 10];
        
        $coverArtist = [
            'Bad Wolves',
            'Johnny Cash',
            'Disturbed',
            'Sinéad O\'Connor',
            'Jimi Hendrix',
            'Whitney Houston',
            'Gary Jules',
            'A-ha (MTV Unplugged)',
            'Jeff Buckley',
            'Marilyn Manson'
        ][$id % 10];
        
        $originalArtist = [
            'The Cranberries',
            'Nine Inch Nails',
            'Simon & Garfunkel',
            'Prince',
            'Bob Dylan',
            'Dolly Parton',
            'Tears for Fears',
            'A-ha',
            'Leonard Cohen',
            'Eurythmics'
        ][$id % 10];
        
        $cover = [
            'id' => $id,
            'title' => $coverTitle,
            'artist' => $coverArtist,
            'original_artist' => $originalArtist,
            'year' => rand(1990, 2022),
            'genre' => ['Rock', 'Pop', 'Alternative', 'R&B', 'Folk'][$id % 5],
            'image' => 'https://picsum.photos/seed/cover' . $id . '/400/400',
            'banner' => 'https://picsum.photos/seed/coverbanner' . $id . '/1200/400',
            'plays' => rand(1, 10) . 'M',
            'likes' => rand(50, 500) . 'K',
            'duration' => rand(3, 4) . ':' . rand(10, 59),
        ];
        
        $relatedCovers = [
            ['title' => 'Zombie', 'artist' => 'Bad Wolves', 'original' => 'The Cranberries', 'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300', 'id' => ($id + 1) % 20 + 1],
            ['title' => 'Mad World', 'artist' => 'Gary Jules', 'original' => 'Tears for Fears', 'img' => 'https://images.unsplash.com/photo-1453090927415-5f45085b65c0?q=80&w=300', 'id' => ($id + 2) % 20 + 1],
            ['title' => 'Take On Me', 'artist' => 'A-ha (MTV Unplugged)', 'original' => 'A-ha', 'img' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=300', 'id' => ($id + 3) % 20 + 1],
            ['title' => 'Hallelujah', 'artist' => 'Jeff Buckley', 'original' => 'Leonard Cohen', 'img' => 'https://images.unsplash.com/photo-1494232410401-ad00d5433cfa?q=80&w=300', 'id' => ($id + 4) % 20 + 1],
        ];
    @endphp

    <!-- Cover Header Section -->
    <div class="relative mb-8">
        <!-- Banner Image -->
        <div class="h-40 sm:h-48 md:h-64 lg:h-80 w-full overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-transparent z-10"></div>
            <img src="{{ $cover['banner'] }}" alt="{{ $cover['title'] }}" class="w-full h-full object-cover">
        </div>
        
        <!-- Cover Info Overlay -->
        <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 z-20">
            <div class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
                <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32 rounded-lg overflow-hidden bg-gray-800 flex-shrink-0 shadow-lg">
                    <img src="{{ $cover['image'] }}" alt="{{ $cover['title'] }}" class="w-full h-full object-cover">
                </div>
                
                <div class="flex-grow space-y-1 sm:space-y-2">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <span class="bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">COVER</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">{{ $cover['title'] }} by {{ $cover['original_artist'] }}</h1>
                    <p class="text-sm sm:text-base text-gray-400">{{ $cover['artist'] }}</p>
                    
                    <div class="flex flex-wrap items-center gap-3 sm:gap-4 mt-2">
                        <div class="text-xs sm:text-sm text-gray-300"><i class="ti ti-calendar mr-1"></i> {{ $cover['year'] }}</div>
                        <div class="text-xs sm:text-sm text-gray-300"><i class="ti ti-heart mr-1"></i> {{ $cover['likes'] }} likes</div>
                    </div>
                </div>
            </div>
            
            <div class="flex mt-4 sm:mt-4 gap-2 sm:absolute sm:bottom-6 sm:right-6">
                <button class="flex-1 sm:flex-auto bg-transparent border border-gray-600 hover:border-white transition-colors py-2 px-4 rounded-full flex items-center justify-center gap-2 text-sm">
                    <i class="ti ti-heart"></i> Like
                </button>
            </div>
        </div>
    </div>

    
    <!-- About the Cover Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="md:col-span-2">
            <h2 class="text-xl font-bold mb-4">About This Cover</h2>
            <p class="text-gray-300 mb-4">{{ $cover['artist'] }}'s cover of "{{ $cover['title'] }}" brings a fresh perspective to the original song by {{ $cover['original_artist'] }}, reimagining the classic with unique arrangements and vocal interpretation.</p>
            <p class="text-gray-300">Released in {{ $cover['year'] }}, this {{ $cover['genre'] }} rendition has gained popularity for its innovative approach while respecting the essence of the original song that fans have come to love.</p>
            
            <!-- Cover vs Original -->
            <div class="mt-6 bg-gray-800/50 rounded-lg p-4">
                <h3 class="font-semibold mb-3">Compare with Original</h3>
                <div class="flex items-center gap-3">
                    <div class="flex-1 bg-gray-700/50 rounded-lg p-3">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-gray-600 overflow-hidden">
                                <img src="{{ $cover['image'] }}" class="w-full h-full object-cover" alt="{{ $cover['title'] }}">
                            </div>
                            <div>
                                <div class="text-sm font-medium">Cover Version</div>
                                <div class="text-xs text-gray-400">{{ $cover['artist'] }} • {{ $cover['year'] }}</div>
                            </div>
                        </div>
                        <button class="w-full bg-red-600 hover:bg-red-700 transition-colors text-sm rounded-full py-1.5 flex items-center justify-center gap-1">
                            <i class="ti ti-player-play"></i> Play Cover
                        </button>
                    </div>
                    
                    <div class="flex-1 bg-gray-700/50 rounded-lg p-3">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-gray-600 overflow-hidden">
                                <img src="https://picsum.photos/seed/original{{ $id }}/300/300" class="w-full h-full object-cover" alt="Original {{ $cover['title'] }}">
                            </div>
                            <div>
                                <div class="text-sm font-medium">Original Version</div>
                                <div class="text-xs text-gray-400">{{ $cover['original_artist'] }} • {{ rand(1970, 1990) }}</div>
                            </div>
                        </div>
                        <button class="w-full bg-gray-600 hover:bg-gray-500 transition-colors text-sm rounded-full py-1.5 flex items-center justify-center gap-1">
                            <i class="ti ti-player-play"></i> Play Original
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div>
            <h2 class="text-xl font-bold mb-4">Artist</h2>
            <div class="bg-gray-800/50 rounded-lg p-4">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-16 h-16 rounded-full overflow-hidden">
                        <img src="https://picsum.photos/seed/artist{{ $id }}/300/300" alt="{{ $cover['artist'] }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="font-semibold">{{ $cover['artist'] }}</h3>
                        <p class="text-sm text-gray-400">{{ ['Rock', 'Pop', 'Alternative', 'R&B', 'Folk'][$id % 5] }} Artist</p>
                    </div>
                </div>
                <button class="w-full bg-transparent border border-gray-600 hover:border-white transition-colors rounded-full py-1.5 text-sm">
                    View Artist Profile
                </button>
                
                <div class="mt-4">
                    <h4 class="text-sm font-medium mb-2">More covers by {{ $cover['artist'] }}</h4>
                    <div class="space-y-2">
                        @for($i = 1; $i <= 3; $i++)
                            <div class="flex items-center gap-2 hover:bg-gray-700/50 p-2 rounded transition-colors">
                                <div class="w-8 h-8 bg-gray-700 rounded overflow-hidden">
                                    <img src="https://picsum.photos/seed/cover{{ $id * 10 + $i }}/100/100" alt="Cover {{ $i }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0 flex-grow">
                                    <div class="text-sm font-medium truncate">{{ ['Hurt', 'Love Will Tear Us Apart', 'Tainted Love', 'Take Me to Church'][$i % 4] }}</div>
                                    <div class="text-xs text-gray-400 truncate">Originally by {{ ['Nine Inch Nails', 'Joy Division', 'Soft Cell', 'Hozier'][$i % 4] }}</div>
                                </div>
                                <button class="text-gray-400 hover:text-white transition-colors">
                                    <i class="ti ti-player-play"></i>
                                </button>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Similar Covers Section -->
    <section class="mb-10">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-xl font-bold">Similar Covers</h2>
        </div>
        
        <div class="scroll-container">
            @foreach($relatedCovers as $relatedCover)
                <div class="scroll-item cover-card">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="{{ $relatedCover['img'] }}" alt="{{ $relatedCover['title'] }}"
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
                        <a href="{{ route('cover.profile', $relatedCover['id']) }}" class="hover:text-red-500 transition-colors">
                            <h3 class="font-semibold text-base truncate" title="{{ $relatedCover['title'] }}">{{ $relatedCover['title'] }}</h3>
                        </a>
                        <p class="text-sm text-gray-400 truncate" title="{{ $relatedCover['artist'] }}">{{ $relatedCover['artist'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Originally by <span
                                class="text-red-500">{{ $relatedCover['original'] }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    
    <!-- User Comments Section -->
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Comments ({{ rand(5, 30) }})</h2>
        
        <div class="bg-gray-800/50 rounded-lg p-4 mb-4">
            <div class="flex gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gray-700 overflow-hidden flex-shrink-0">
                    <!-- User avatar placeholder -->
                    <div class="w-full h-full bg-gradient-to-br from-purple-500 to-blue-500 flex items-center justify-center">
                        <span class="text-white font-bold">Y</span>
                    </div>
                </div>
                <div class="flex-grow">
                    <textarea class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-sm resize-none focus:outline-none focus:border-red-500 transition-colors" rows="2" placeholder="Leave a comment..."></textarea>
                    <div class="flex justify-end mt-2">
                        <button class="bg-red-600 hover:bg-red-700 transition-colors text-white px-4 py-1.5 rounded-full text-sm">
                            Post Comment
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Existing comments -->
            <div class="space-y-4">
                @for($i = 1; $i <= 3; $i++)
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-700 overflow-hidden flex-shrink-0">
                            <img src="https://picsum.photos/seed/user{{ $i }}/100/100" alt="User {{ $i }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-medium">{{ ['JohnMusic', 'CoverFan22', 'MusicLover'][$i-1] }}</span>
                                <span class="text-gray-500 text-xs">{{ rand(1, 30) }} days ago</span>
                            </div>
                            <p class="text-sm mt-1">{{ [
                                'I actually prefer this cover to the original! The way they reimagined the song is incredible.',
                                'Such a great interpretation. Brings new life to a classic song!',
                                'Love how they made this song their own while still respecting the original version.'
                            ][$i-1] }}</p>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
                                <button class="flex items-center gap-1 hover:text-white transition-colors">
                                    <i class="ti ti-thumb-up"></i> {{ rand(5, 50) }}
                                </button>
                                <button class="flex items-center gap-1 hover:text-white transition-colors">
                                    <i class="ti ti-message-circle"></i> Reply
                                </button>
                            </div>
                        </div>
                    </div>
                @endfor
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