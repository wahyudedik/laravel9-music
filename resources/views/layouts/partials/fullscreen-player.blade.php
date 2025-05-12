<!-- Full Screen Player -->
<div id="fullscreenPlayer" class="fixed inset-0 bg-black/95 z-[100] hidden backdrop-blur-xl flex flex-col">
    <div class="flex justify-between items-center p-5 border-b border-white/10">
        <div class="flex items-center gap-4">
            <button id="closeFullscreenPlayer" class="text-white hover:text-red-500 transition-colors">
                <i class="ti ti-chevron-down text-2xl"></i>
            </button>
            <div>
                <h2 class="text-lg font-medium">Now Playing</h2>
                <p class="text-sm text-gray-400" id="fullscreenSource">From: Your Library</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <button class="player-button hover:text-red-500" id="castButton" title="Cast to device">
                <i class="ti ti-cast text-xl"></i>
            </button>
            <div class="relative">
                <button class="player-button hover:text-red-500" id="moreOptionsButton" title="More options">
                    <i class="ti ti-dots-vertical text-xl"></i>
                </button>
                <div class="absolute right-0 mt-2 w-60 bg-gray-800 rounded-lg shadow-lg p-2 hidden z-20" id="playerOptionsMenu">
                    <ul class="space-y-1">
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                <i class="ti ti-share"></i> Share song
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                <i class="ti ti-download"></i> Download for offline
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                <i class="ti ti-info-circle"></i> View song details
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-white text-sm p-2 rounded hover:bg-gray-700">
                                <i class="ti ti-report"></i> Report issue
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1 flex flex-col md:flex-row overflow-hidden">
        <!-- Left: Album Art and Song Info -->
        <div class="w-full md:w-7/12 flex flex-col items-center justify-center p-6 relative player-view" id="coverView">
            <div class="relative w-full max-w-md aspect-square rounded-lg overflow-hidden shadow-2xl mb-6">
                <img id="fullscreenCover" src="https://via.placeholder.com/480" alt="Album cover"
                    class="w-full h-full object-cover album-rotating">
                <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                    <div class="flex gap-4">
                        <button class="bg-red-600 hover:bg-red-700 w-14 h-14 rounded-full flex items-center justify-center shadow-lg transition-all hover:scale-110">
                            <i class="ti ti-player-play text-white text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mb-5 w-full max-w-md">
                <h2 id="fullscreenTitle" class="text-2xl font-bold truncate">Song Title</h2>
                <p id="fullscreenArtist" class="text-gray-400 truncate">Artist Name</p>
                <p id="fullscreenAlbum" class="text-gray-500 text-sm mt-1">Album Name • 2023</p>
            </div>

            <div class="flex items-center gap-6 mt-2 w-full max-w-md justify-center">
                <button class="player-action-btn" id="addToPlaylistButton" title="Add to playlist">
                    <i class="ti ti-playlist-add text-xl"></i>
                </button>
                <button class="player-action-btn" id="fullscreenLikeButton" title="Add to favorites">
                    <i class="ti ti-heart text-xl"></i>
                </button>
                <button class="player-action-btn" id="remakeButton" title="Remake">
                    <i class="ti ti-refresh text-xl"></i>
                </button>
                <button class="player-action-btn" id="downloadButton" title="Download">
                    <i class="ti ti-download text-xl"></i>
                </button>
                <button class="player-action-btn" id="shareButton" title="Share">
                    <i class="ti ti-share text-xl"></i>
                </button>
            </div>
            
            <!-- View selector buttons -->
            <div class="flex gap-3 mt-8">
                <button class="player-view-btn active" data-view="cover" title="Cover view">
                    <i class="ti ti-disc text-xl"></i>
                </button>
                <button class="player-view-btn" data-view="visualizer" title="Visualizer">
                    <i class="ti ti-waveform text-xl"></i>
                </button>
                <button class="player-view-btn" data-view="video" title="Video">
                    <i class="ti ti-video text-xl"></i>
                </button>
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
                                <img src="https://picsum.photos/80/80?random={{ $i }}"
                                    alt="Related song" class="w-12 h-12 rounded">
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
                            <img id="queueCurrentCover" src="https://via.placeholder.com/48"
                                alt="Current song" class="w-12 h-12 rounded">
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
                                <div class="flex items-center gap-3 p-2 rounded-md hover:bg-white/5 transition-colors queue-song-item">
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
            <div class="flex items-center gap-4">
                <span id="fullscreenCurrentTime" class="text-sm text-gray-400">0:00</span>
                <div id="fullscreenProgressContainer"
                    class="flex-1 relative h-2 bg-white/10 rounded-full cursor-pointer">
                    <div id="fullscreenProgressBar" class="absolute h-full bg-red-600 rounded-full"
                        style="width: 30%"></div>
                    <div id="fullscreenProgressHandle" class="absolute w-4 h-4 bg-white rounded-full -mt-1"
                        style="left: 30%"></div>
                </div>
                <span id="fullscreenTotalTime" class="text-sm text-gray-400">3:30</span>
            </div>

            <div class="flex flex-wrap items-center justify-between mt-4 gap-4">
                <div class="flex items-center">
                    <button class="player-button text-gray-300 hover:text-white" id="fullscreenMuteButton">
                        <i class="ti ti-volume"></i>
                    </button>
                    <input type="range" min="0" max="100" value="80" class="volume-slider mx-2"
                        id="fullscreenVolumeSlider">
                </div>

                <div class="flex items-center justify-center gap-6">
                    <button class="player-button text-gray-300 hover:text-white" id="fullscreenShuffleButton">
                        <i class="ti ti-arrows-shuffle text-xl"></i>
                    </button>
                    <button class="player-button text-gray-300 hover:text-white" id="fullscreenPrevButton">
                        <i class="ti ti-player-skip-back text-2xl"></i>
                    </button>
                    <button
                        class="player-button main bg-white text-black hover:bg-gray-200 rounded-full w-14 h-14 flex items-center justify-center"
                        id="fullscreenPlayButton">
                        <i class="ti ti-player-pause text-2xl"></i>
                    </button>
                    <button class="player-button text-gray-300 hover:text-white" id="fullscreenNextButton">
                        <i class="ti ti-player-skip-forward text-2xl"></i>
                    </button>
                    <button class="player-button text-gray-300 hover:text-white" id="fullscreenRepeatButton">
                        <i class="ti ti-repeat text-xl"></i>
                    </button>
                </div>

                <div>
                    <!-- Additional controls can be added here -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Additional views (initially hidden) -->
    <div class="hidden w-full md:w-7/12 flex-col items-center justify-center p-6 relative player-view" id="visualizerView">
        <div class="relative w-full max-w-md aspect-square rounded-lg overflow-hidden shadow-2xl mb-6 bg-gradient-to-br from-purple-900 to-blue-900">
            <div class="absolute inset-0 flex items-center justify-center">
                <canvas id="audioVisualizer" class="w-full h-full"></canvas>
            </div>
        </div>
        
        <div class="text-center mb-5 w-full max-w-md">
            <h2 id="visualizerTitle" class="text-2xl font-bold truncate">Song Title</h2>
            <p id="visualizerArtist" class="text-gray-400 truncate">Artist Name</p>
        </div>
    </div>
    
    <div class="hidden w-full md:w-7/12 flex-col items-center justify-center p-6 relative player-view" id="videoView">
        <div class="relative w-full max-w-xl aspect-video rounded-lg overflow-hidden shadow-2xl mb-6">
            <div class="absolute inset-0 bg-black flex items-center justify-center">
                <img src="https://via.placeholder.com/640x360" alt="Video thumbnail" class="w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-white/50">No video available</span>
                </div>
            </div>
        </div>
        
        <div class="text-center mb-5 w-full max-w-md">
            <h2 id="videoTitle" class="text-2xl font-bold truncate">Song Title</h2>
            <p id="videoArtist" class="text-gray-400 truncate">Artist Name</p>
        </div>
    </div>
</div>
