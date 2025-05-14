<!-- Full Screen Player -->
@php
$role = Auth::user()->getRoleNames()->first();
@endphp
<div id="fullscreenPlayer" data-id="" class="fixed inset-0 bg-black/95 z-[100] hidden backdrop-blur-xl flex flex-col">
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

                <iframe class="absolute top-0 left-0 w-full h-full" id="fullscreenPlayerEmbed" src=""
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>

            </div>




        </div>

        <!-- Right: Tabs (Lyrics, Related, Up Next) -->
        <div class="w-full md:w-5/12 bg-white/5 flex flex-col">

            <div class="flex flex-wrap px-4 pt-4 pb-2">
                <div class="flex items-center mr-2 mb-2">

                    <div class="relative inline-block text-left" x-data="{ open: false }">
                        <button @click="open = !open" type="button"
                            class="inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-black text-sm font-medium text-gray-50 hover:bg-gray-50 hover:text-gray-800"
                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                            Beli Lisensi
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown panel -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">

                                @if ($role == 'Artist' || $role == 'Cover' || $role == 'Composer')
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                        role="menuitem">Cover</a>
                                @endif
                                @if ($role == 'Artist' || $role == 'Composer')
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                        role="menuitem">Remake</a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex items-center mr-2 mb-2">

                    <div class="relative inline-block text-left" x-data="{ open: false }">
                        <button @click="open = !open" type="button"
                            class="inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-black text-sm font-medium text-gray-50 hover:bg-gray-50 hover:text-gray-800"
                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                            <i class="ti ti-shopping-cart mx-2 mt-1"></i>
                            Tambah Order
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown panel -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                @if ($role == 'Artist' || $role == 'Cover' || $role == 'Composer')
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                        role="menuitem">Cover</a>
                                @endif
                                @if ($role == 'Artist' || $role == 'Composer')
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                        role="menuitem">Remake</a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex items-center mr-2 mb-2">

                    <div class="relative inline-block text-left">
                        <button type="button"
                            class="inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-black text-sm font-medium text-gray-50 hover:bg-gray-50 hover:text-gray-800"
                            id="menu-button">
                            Profit Sharing
                        </button>


                    </div>

                </div>
            </div>

            <div class="border-b border-white/10">
                <div class="flex">
                    <button class="player-tab-btn active" data-tab="lyrics">
                        Lirik
                    </button>
                    <button class="player-tab-btn" data-tab="related">
                        Terkait
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
                        <h3 class="text-lg font-medium">Lirik Lagu</h3>
                        <span class="text-xs text-gray-400">Source: Lyrics Provider</span>
                    </div>
                    <div class="lyrics-content space-y-6 text-gray-300" id="fullscreenPlayerLyrics">

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
                            <img id="queueCurrentCover" src="https://picsum.photos/48" alt="Current song"
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
        <div class="w-full mx-auto">
            <div></div>
            <div class="flex items-center">

                <div class="flex justify-center items-center">
                    <img id="fullscreenPlayerCoverAvatar" src="https://placehold.co/14" alt="Song Cover"
                        class="w-16 h-16 rounded-lg object-cover mr-4" />
                </div>

                <div class="flex flex-col">
                    <div id="fullscreenPlayerAlbum"></div>
                    <h2 id="fullscreenPlayerSongTitle" class="text-xl font-semibold text-gray-100">Song Title </h2>
                    <p id="fullscreenPlayerArtist" class="text-gray-300 text-sm">Artist Name</p>
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
                <img src="https://picsum.photos/640/360" alt="Video thumbnail" class="w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-white/50">No video available</span>
                </div>
            </div>
        </div>

    </div>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

        });
    </script>
@endpush
