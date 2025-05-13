<!-- Full Screen Player -->
<div id="fullscreenPlayer" class="fixed inset-0 bg-black/95 z-[100] hidden backdrop-blur-xl flex flex-col">
    <div class="flex justify-between items-center p-5 border-b border-white/10">
        <div class="flex items-center gap-4">
            <button id="closeFullscreenPlayer" class="text-white hover:text-red-500 transition-colors">
                <i class="ti ti-chevron-down text-2xl"></i>
            </button>
            <div>
                <h2 class="text-lg font-medium">Dimainkan Saat ini</h2>
                {{-- <p class="text-sm text-gray-400" id="fullscreenSource">From: Your Library</p> --}}
            </div>
        </div>
        <div class="flex items-center gap-4">
        </div>
    </div>

    <div class="flex-1 flex flex-col md:flex-row overflow-auto">
        <!-- Left: Album Art and Song Info -->

        <div class="w-full md:w-7/12 flex flex-col items-center justify-center p-6 relative player-view" id="coverView">
            <div class="relative w-full aspect-square rounded-lg overflow-auto shadow-2xl mb-6">

                @php
                    $embedUrl = convert_youtubev2('https://www.youtube.com/shorts/6JKSGOCPkEA');
                @endphp
                <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $embedUrl }}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>


            </div>


        </div>

        <!-- Right: Tabs (Lyrics, Related, Up Next) -->
        <div class="w-full md:w-5/12 bg-white/5 flex flex-col">
            <div class="border-b border-white/10">
                <div class="flex">
                    <button class="player-tab-btn active" data-tab="lyrics">
                        Lyrics
                    </button>
                    <button class="player-tab-btn" data-tab="related">
                        Related
                    </button>
                    <button class="player-tab-btn" data-tab="queue">
                        Up Next
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4">
                <!-- Lyrics Tab -->
                <div class="tab-content active" id="lyrics-tab">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Lyrics</h3>
                        <span class="text-xs text-gray-400">Source: Lyrics Provider</span>
                    </div>
                    <div class="lyrics-content space-y-6 text-gray-300">
                        <p class="lyrics-line">First line of the song lyrics</p>
                        <p class="lyrics-line">Second line that continues the verse</p>
                        <p class="lyrics-line">And another line follows this way</p>
                        <p class="lyrics-line active">This is the currently playing line</p>
                        <p class="lyrics-line">The lyrics continue as the song plays</p>
                        <p class="lyrics-line">More lyrics for the current song</p>
                        <p class="lyrics-line">This is the chorus part perhaps</p>
                        <p class="lyrics-line">More lyrics for demonstration</p>
                        <p class="lyrics-line">The song continues with more verses</p>
                        <p class="lyrics-line">Until it reaches the end eventually</p>
                        <p class="lyrics-line">Each line represents a lyric line</p>
                        <p class="lyrics-line">In the actual song being played</p>
                    </div>
                </div>

                <!-- Related Tab -->
                <div class="tab-content hidden" id="related-tab">
                    <h3 class="text-lg font-medium mb-4">Similar Songs</h3>
                    <div class="space-y-3">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="flex items-center gap-3 p-2 rounded-md hover:bg-white/5 transition-colors">
                                <img src="https://picsum.photos/80/80?random={{ $i }}" alt="Related song"
                                    class="w-12 h-12 rounded">
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-medium truncate">Related Song {{ $i }}</h4>
                                    <p class="text-xs text-gray-400 truncate">Artist {{ $i }}</p>
                                </div>
                                <button class="text-gray-400 hover:text-white play-related-btn">
                                    <i class="ti ti-player-play"></i>
                                </button>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Queue Tab -->
                <div class="tab-content hidden" id="queue-tab">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Up Next</h3>
                        <button class="text-sm text-blue-400 hover:text-blue-300" id="clearQueueButton">Clear</button>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-2 bg-white/10 rounded-md">
                            <div class="text-red-500 text-xs font-medium">NOW</div>
                            <img id="queueCurrentCover" src="https://via.placeholder.com/48" alt="Current song"
                                class="w-12 h-12 rounded">
                            <div class="min-w-0 flex-1">
                                <h4 id="queueCurrentTitle" class="text-sm font-medium truncate">Current Song</h4>
                                <p id="queueCurrentArtist" class="text-xs text-gray-400 truncate">Current Artist</p>
                            </div>
                        </div>

                        <div class="queue-items space-y-3" id="queueItems">
                            @php
                                $queueSongs = [
                                    ['title' => 'Next Song 1', 'artist' => 'Artist A'],
                                    ['title' => 'Next Song 2', 'artist' => 'Artist B'],
                                    ['title' => 'Next Song 3', 'artist' => 'Artist C'],
                                    ['title' => 'Next Song 4', 'artist' => 'Artist D'],
                                    ['title' => 'Next Song 5', 'artist' => 'Artist E'],
                                    ['title' => 'Next Song 6', 'artist' => 'Artist F'],
                                    ['title' => 'Next Song 7', 'artist' => 'Artist G'],
                                ];
                            @endphp

                            @foreach ($queueSongs as $index => $song)
                                <div
                                    class="flex items-center gap-3 p-2 rounded-md hover:bg-white/5 transition-colors queue-song-item">
                                    <div class="text-gray-500 text-xs w-6 text-center">{{ $index + 1 }}</div>
                                    <img src="https://picsum.photos/80/80?random={{ $index + 20 }}"
                                        alt="{{ $song['title'] }}" class="w-12 h-12 rounded">
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-sm font-medium truncate">{{ $song['title'] }}</h4>
                                        <p class="text-xs text-gray-400 truncate">{{ $song['artist'] }}</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button class="text-gray-400 hover:text-white queue-song-drag-handle">
                                            <i class="ti ti-grip-vertical"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-white queue-song-options">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Player Controls -->
    <div class="p-6 border-t border-white/10">
        <div class="max-w-4xl mx-auto">

            <div class="flex items-center">
                <div class="flex justify-center items-center">
                    <img src="https://placehold.co/14" alt="Song Cover"
                    class="w-16 h-16 rounded-lg object-cover mr-4" />
                </div>
                <div class="flex flex-col">
                    <h2 class="text-xl font-semibold text-gray-100">Song Title</h2>
                    <p class="text-gray-300 text-sm mt-1">Artist Name</p>
                </div>

            </div>


        </div>

    </div>

    <!-- Additional views (initially hidden) -->
    <div class="hidden w-full md:w-7/12 flex-col items-center justify-center p-6 relative player-view"
        id="visualizerView">
        <div
            class="relative w-full max-w-md aspect-square rounded-lg overflow-hidden shadow-2xl mb-6 bg-gradient-to-br from-purple-900 to-blue-900">
            <div class="absolute inset-0 flex items-center justify-center">
                <canvas id="audioVisualizer" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    <div class="hidden w-full md:w-7/12 flex-col items-center justify-center p-6 relative player-view" id="videoView">
        <div class="relative w-full max-w-xl aspect-video rounded-lg overflow-hidden shadow-2xl mb-6">
            <div class="absolute inset-0 bg-black flex items-center justify-center">
                <img src="https://via.placeholder.com/640x360" alt="Video thumbnail"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-white/50">No video available</span>
                </div>
            </div>
        </div>

    </div>
</div>

