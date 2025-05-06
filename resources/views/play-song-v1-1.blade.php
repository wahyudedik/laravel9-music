@extends('layouts.landing-page')

@section('styles')
    <style>
        /* Player-specific styles */
        :root {
            --player-primary: #e53935;
            --player-dark: #c62828;
            --player-light: #ef5350;
            --player-bg: #121212;
            --player-card: #181818;
            --player-hover: #282828;
            --player-text: #fff;
            --player-text-secondary: #b3b3b3;
            --player-border: #2a2a2a;
            --player-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            --player-gradient: linear-gradient(180deg, rgba(18, 18, 18, 0.8) 0%, rgba(18, 18, 18, 1) 100%);
            --mini-player-height: 90px;
        }

        /* Main player container with glass effect */
        .player-container {
            background-color: rgba(24, 24, 24, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: var(--player-shadow);
            overflow: hidden;
            border: 1px solid var(--player-border);
            transition: all 0.3s ease;
        }

        /* Album artwork with hover effects */
        .album-cover-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: var(--player-shadow);
            transition: transform 0.3s ease;
        }

        .album-cover {
            width: 100%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .album-cover-container:hover .album-cover {
            transform: scale(1.05);
        }

        .album-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .album-cover-container:hover .album-overlay {
            opacity: 1;
        }

        /* Waveform visualization */
        .waveform {
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
            margin: 15px 0;
        }

        .waveform-bar {
            width: 3px;
            background-color: var(--player-text-secondary);
            border-radius: 3px;
            transition: height 0.2s ease;
        }

        .waveform-bar.active {
            background-color: var(--player-primary);
        }

        /* Enhanced player controls */
        .player-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .control-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(42, 42, 42, 0.7);
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: all 0.2s ease;
            color: #fff;
            border: none;
        }

        .control-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
            background-color: #333;
        }

        .play-btn {
            width: 60px;
            height: 60px;
            background-color: var(--player-primary);
            color: white;
        }

        .play-btn:hover {
            background-color: var(--player-dark);
        }

        /* Smooth progress bar */
        .progress-container {
            width: 100%;
            height: 6px;
            background-color: rgba(62, 62, 62, 0.5);
            border-radius: 3px;
            margin: 20px 0;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--player-primary) 0%, var(--player-light) 100%);
            border-radius: 3px;
            width: 0%;
            position: relative;
            transition: width 0.1s linear;
        }

        .progress-handle {
            width: 16px;
            height: 16px;
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            right: -8px;
            top: -5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .progress-container:hover .progress-handle {
            opacity: 1;
        }

        /* Song info with animation */
        .song-info {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .song-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
            transition: all 0.3s ease;
        }

        .song-artist {
            font-size: 1.2rem;
            color: var(--player-text-secondary);
            transition: all 0.3s ease;
        }

        /* Lyrics with scroll effect */
        .lyrics-container {
            background-color: rgba(24, 24, 24, 0.7);
            backdrop-filter: blur(5px);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 20px;
            max-height: 300px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--player-primary) var(--player-card);
        }

        .lyrics-container::-webkit-scrollbar {
            width: 6px;
        }

        .lyrics-container::-webkit-scrollbar-track {
            background: var(--player-card);
        }

        .lyrics-container::-webkit-scrollbar-thumb {
            background-color: var(--player-primary);
            border-radius: 6px;
        }

        .lyrics-text {
            white-space: pre-line;
            line-height: 1.8;
            color: #e0e0e0;
        }

        /* Related songs with hover effects */
        .related-songs {
            background-color: rgba(24, 24, 24, 0.7);
            backdrop-filter: blur(5px);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .related-song-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.2s ease;
            text-decoration: none !important;
        }

        .related-song-item:hover {
            background-color: var(--player-hover);
            transform: translateX(5px);
        }

        .related-song-cover {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .related-song-item:hover .related-song-cover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* Mini player enhancements */
        .mini-player {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: var(--mini-player-height);
            background-color: rgba(18, 18, 18, 0.9);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0 20px;
            display: flex;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .mini-player.minimized {
            transform: translateY(calc(100% - 40px));
        }

        .mini-player-handle {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            cursor: pointer;
        }

        /* Visualizer in mini player */
        .mini-player-visualizer {
            display: flex;
            align-items: center;
            gap: 2px;
            height: 20px;
            margin-left: 15px;
        }

        .visualizer-bar {
            width: 2px;
            background-color: var(--player-primary);
            border-radius: 2px;
        }

        /* Floating action buttons */
        .floating-actions {
            position: fixed;
            bottom: 100px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 900;
        }

        .floating-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--player-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .floating-btn:hover {
            transform: scale(1.1);
            background-color: var(--player-dark);
        }

        /* Volume control */
        .volume-container {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .volume-slider {
            width: 80px;
            height: 4px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            position: relative;
            cursor: pointer;
        }

        .volume-level {
            height: 100%;
            background-color: var(--player-primary);
            border-radius: 2px;
            width: 70%;
        }

        .volume-handle {
            position: absolute;
            right: 30%;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background-color: white;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .volume-slider:hover .volume-handle {
            opacity: 1;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .player-controls {
                gap: 10px;
            }

            .control-btn {
                width: 40px;
                height: 40px;
            }

            .play-btn {
                width: 50px;
                height: 50px;
            }

            .song-title {
                font-size: 1.5rem;
            }

            .song-artist {
                font-size: 1rem;
            }
        }
    </style>
@endsection

@section('content')
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
    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Main Player Section -->


            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related Songs with Enhanced UI -->
                <div class="related-songs">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title text-white mb-0">Related Songs</h3>
                        <a href="#" class="btn btn-sm btn-dark">View All</a>
                    </div>

                    @for ($i = 1; $i <= 5; $i++)
                        <a href="{{ route('play-song', $i) }}" class="text-decoration-none">
                            <div class="related-song-item">
                                <img src="https://picsum.photos/100/100?random={{ $i }}"
                                    class="related-song-cover">
                                <div class="flex-grow-1">
                                    <div class="text-white fw-medium">
                                        {{ ['After Hours', 'Don\'t Start Now', 'Peaches', 'MONTERO', 'positions', 'Watermelon Sugar', 'Good 4 U', 'Mood', 'Dynamite', 'Circles'][$i % 10] }}
                                    </div>
                                    <div class="text-muted small">
                                        {{ ['The Weeknd', 'Dua Lipa', 'Justin Bieber', 'Lil Nas X', 'Ariana Grande', 'Harry Styles', 'Olivia Rodrigo', '24kGoldn', 'BTS', 'Post Malone'][$i % 10] }}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span
                                        class="text-muted me-3">{{ ['3:20', '3:45', '2:56', '4:10', '3:14', '2:54', '3:30', '2:21', '3:19', '3:35'][$i % 10] }}</span>
                                    <button class="btn btn-sm btn-icon btn-dark play-related-btn">
                                        <i class="ti ti-player-play"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endfor
                </div>

                <!-- Artist Info with Enhanced UI -->
                <div class="related-songs mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title text-white mb-0">Artist</h3>
                        <a href="#" class="btn btn-sm btn-dark">View Profile</a>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ '' }}&background=e53935&color=fff&size=128"
                            class="me-3 rounded-circle" style="width: 80px; height: 80px;">
                        <div>
                            <h4 class="mb-1 text-white">{{ '' }}</h4>
                            <p class="text-secondary mb-2">{{ number_format(rand(1000000, 50000000)) }} monthly listeners
                            </p>
                            <button class="btn btn-sm btn-primary">
                                <i class="ti ti-user-plus me-1"></i> Follow
                            </button>
                        </div>
                    </div>

                    <p class="text-muted">
                        {{ $song->artist->bio ?? 'No artist biography available.' }}
                    </p>

                    <div class="d-flex mt-3 gap-2">
                        <a href="#" class="btn btn-sm btn-dark">
                            <i class="ti ti-brand-spotify me-1"></i> Spotify
                        </a>
                        <a href="#" class="btn btn-sm btn-dark">
                            <i class="ti ti-brand-instagram me-1"></i> Instagram
                        </a>
                        <a href="#" class="btn btn-sm btn-dark">
                            <i class="ti ti-brand-twitter me-1"></i> Twitter
                        </a>
                    </div>
                </div>

                <!-- Album Info with Enhanced UI -->
                <div class="related-songs mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title text-white mb-0">Album</h3>
                        <a href="#" class="btn btn-sm btn-dark">View Album</a>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        @php
                            // Extract filename from the 3rd image variant (small)
                            $coverImages = explode(',', $song->album->cover_image ?? '');
                            $smallCoverFile = $coverImages[2] ?? null;

                            // Get just the filename from the path (e.g. "cover_abc_sm.jpeg")
                            $filename = $smallCoverFile ? basename($smallCoverFile) : null;

                            // Generate image URL via route
                            $imageAlbumUrl = $filename
                                ? route('albums.image', ['filename' => $filename])
                                : 'https://picsum.photos/500/500?random=' . $song->id;
                        @endphp
                        <img src="{{ $imageAlbumUrl }}" class="me-3 rounded"
                            style="width: 80px; height: 80px; object-fit: cover;">
                        <div>
                            <h4 class="mb-1 text-white">{{ $song->album->title ?? '' }}</h4>
                            <p class="text-secondary mb-0">{{ $song->album->artist->name ?? '' }}</p>
                            <p class="text-secondary">Released: {{ '' }} •
                                {{ rand(8, 15) }} songs</p>
                        </div>
                    </div>

                    <!-- Album tracks preview -->
                    <div class="album-tracks mt-3">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="d-flex align-items-center py-2 border-top border-dark">
                                <span class="text-muted me-3">{{ $i }}</span>
                                <div class="flex-grow-1">
                                    <div class="text-white">
                                        {{ ['After Hours', 'Blinding Lights', 'Save Your Tears'][$i - 1] }}</div>
                                    <div class="text-muted small">{{ '' }}</div>
                                </div>
                                <span class="text-muted">{{ ['3:20', '3:45', '2:56'][$i - 1] }}</span>
                            </div>
                        @endfor
                        <div class="text-center mt-2">
                            <button class="btn btn-sm btn-link text-muted">
                                <i class="ti ti-dots me-1"></i> Show more
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating action buttons -->

    <!-- Mini Player with Enhanced UI -->


    <!-- Share Modal -->

    <!-- Lyrics Full Screen Modal -->

    <!-- Equalizer Modal -->

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const audioPlayer = document.getElementById('audioPlayer');
            const playButton = document.getElementById('playButton');
            const miniPlayBtn = document.getElementById('miniPlayBtn');
            const mainPlayBtn = document.querySelector('.main-play-btn');
            const progressBar = document.getElementById('progressBar');
            const progressContainer = document.getElementById('progressContainer');
            const miniPlayerProgressBar = document.getElementById('miniPlayerProgressBar');
            const currentTimeEl = document.getElementById('currentTime');
            const totalTimeEl = document.getElementById('totalTime');
            const volumeIcon = document.getElementById('volumeIcon');
            const volumeSlider = document.getElementById('volumeSlider');
            const volumeLevel = document.getElementById('volumeLevel');
            const repeatButton = document.getElementById('repeatButton');
            const shuffleButton = document.getElementById('shuffleButton');
            const miniPlayer = document.getElementById('miniPlayer');
            const miniPlayerHandle = document.getElementById('miniPlayerHandle');
            const minimizePlayerBtn = document.getElementById('minimizePlayerBtn');
            const expandLyricsBtn = document.getElementById('expandLyricsBtn');
            const lyricsText = document.getElementById('lyricsText');
            const waveform = document.getElementById('waveform');
            const miniVisualizer = document.getElementById('miniVisualizer');
            const equalizerBtn = document.getElementById('equalizerBtn');
            const fullscreenBtn = document.getElementById('fullscreenBtn');
            const copyLinkBtn = document.getElementById('copyLinkBtn');
            const shareLink = document.getElementById('shareLink');

            // State variables
            let isPlaying = false;
            let isMuted = false;
            let isRepeat = false;
            let isShuffle = false;
            let isMinimized = false;
            let currentVolume = 0.7;
            let updateTimer;

            // Initialize audio player if it exists
            if (audioPlayer) {
                audioPlayer.volume = currentVolume;

                // Set initial volume UI
                volumeLevel.style.width = (currentVolume * 100) + '%';

                // Format and display total time
                audioPlayer.addEventListener('loadedmetadata', function() {
                    totalTimeEl.textContent = formatTime(audioPlayer.duration);
                });

                // Update progress as audio plays
                audioPlayer.addEventListener('timeupdate', updateProgress);

                // Reset UI when audio ends
                audioPlayer.addEventListener('ended', function() {
                    if (isRepeat) {
                        audioPlayer.currentTime = 0;
                        audioPlayer.play();
                    } else {
                        resetPlayer();
                    }
                });
            }

            // Play/Pause functionality
            function togglePlayPause() {
                if (!audioPlayer) return;

                if (isPlaying) {
                    audioPlayer.pause();
                    isPlaying = false;
                    updatePlayIcons(false);
                    stopWaveformAnimation();
                } else {
                    audioPlayer.play()
                        .then(() => {
                            isPlaying = true;
                            updatePlayIcons(true);
                            startWaveformAnimation();
                        })
                        .catch(error => {
                            console.error('Playback failed:', error);
                            // Show error notification
                            showNotification('Playback error', 'Could not play the audio. Please try again.',
                                'error');
                        });
                }
            }

            // Update all play/pause icons
            function updatePlayIcons(playing) {
                const playIcon = '<i class="ti ti-player-play"></i>';
                const pauseIcon = '<i class="ti ti-player-pause"></i>';

                if (playButton) playButton.innerHTML = playing ? pauseIcon : playIcon;
                if (miniPlayBtn) miniPlayBtn.innerHTML = playing ? pauseIcon : playIcon;
                if (mainPlayBtn) mainPlayBtn.innerHTML = playing ? pauseIcon : playIcon;
            }

            // Update progress bar and time display
            function updateProgress() {
                if (!audioPlayer) return;

                const currentTime = audioPlayer.currentTime;
                const duration = audioPlayer.duration;

                if (duration) {
                    // Update progress bars
                    const progressPercent = (currentTime / duration) * 100;
                    if (progressBar) progressBar.style.width = progressPercent + '%';
                    if (miniPlayerProgressBar) miniPlayerProgressBar.style.width = progressPercent + '%';

                    // Update time display
                    if (currentTimeEl) currentTimeEl.textContent = formatTime(currentTime);
                }

                // Update active waveform bars based on current progress
                updateWaveformVisualization(currentTime, duration);
            }

            // Format time in MM:SS
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const remainingSeconds = Math.floor(seconds % 60);
                return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
            }

            // Reset player state
            function resetPlayer() {
                isPlaying = false;
                updatePlayIcons(false);
                if (progressBar) progressBar.style.width = '0%';
                if (miniPlayerProgressBar) miniPlayerProgressBar.style.width = '0%';
                if (currentTimeEl) currentTimeEl.textContent = '0:00';
                stopWaveformAnimation();
            }

            // Waveform animation
            function startWaveformAnimation() {
                if (!waveform || !miniVisualizer) return;

                // Clear any existing animation
                stopWaveformAnimation();

                // Animate main waveform
                const waveformBars = waveform.querySelectorAll('.waveform-bar');
                waveformBars.forEach(bar => {
                    const randomHeight = Math.floor(Math.random() * 25) + 5;
                    bar.style.height = `${randomHeight}px`;
                    bar.classList.add('active');

                    // Add animation
                    bar.style.animation =
                        `waveformAnimation ${Math.random() * 0.5 + 0.5}s ease-in-out infinite alternate`;
                });

                // Animate mini player visualizer
                const visualizerBars = miniVisualizer.querySelectorAll('.visualizer-bar');
                visualizerBars.forEach(bar => {
                    const randomHeight = Math.floor(Math.random() * 10) + 5;
                    bar.style.height = `${randomHeight}px`;

                    // Add animation
                    bar.style.animation =
                        `waveformAnimation ${Math.random() * 0.5 + 0.5}s ease-in-out infinite alternate`;
                });

                // Add keyframes for animation if not already added
                if (!document.getElementById('waveformKeyframes')) {
                    const style = document.createElement('style');
                    style.id = 'waveformKeyframes';
                    style.textContent = `
                    @keyframes waveformAnimation {
                        0% { height: 5px; }
                        100% { height: 30px; }
                    }
                `;
                    document.head.appendChild(style);
                }
            }

            function stopWaveformAnimation() {
                if (!waveform || !miniVisualizer) return;

                // Stop main waveform animation
                const waveformBars = waveform.querySelectorAll('.waveform-bar');
                waveformBars.forEach(bar => {
                    bar.style.animation = 'none';
                    bar.classList.remove('active');
                });

                // Stop mini visualizer animation
                const visualizerBars = miniVisualizer.querySelectorAll('.visualizer-bar');
                visualizerBars.forEach(bar => {
                    bar.style.animation = 'none';
                });
            }

            function updateWaveformVisualization(currentTime, duration) {
                if (!waveform || !duration) return;

                const waveformBars = waveform.querySelectorAll('.waveform-bar');
                const totalBars = waveformBars.length;
                const activeBarCount = Math.floor((currentTime / duration) * totalBars);

                waveformBars.forEach((bar, index) => {
                    if (index < activeBarCount) {
                        bar.classList.add('active');
                    } else {
                        bar.classList.remove('active');
                    }
                });
            }

            // Seek functionality
            if (progressContainer) {
                progressContainer.addEventListener('click', function(e) {
                    if (!audioPlayer) return;

                    const rect = progressContainer.getBoundingClientRect();
                    const clickPosition = (e.clientX - rect.left) / rect.width;

                    // Set the current time based on click position
                    audioPlayer.currentTime = clickPosition * audioPlayer.duration;

                    // Update UI
                    updateProgress();
                });
            }

            // Volume control
            if (volumeSlider && volumeLevel) {
                volumeSlider.addEventListener('click', function(e) {
                    if (!audioPlayer) return;

                    const rect = volumeSlider.getBoundingClientRect();
                    const clickPosition = (e.clientX - rect.left) / rect.width;

                    // Set volume (0-1)
                    currentVolume = Math.max(0, Math.min(1, clickPosition));
                    audioPlayer.volume = currentVolume;

                    // Update UI
                    volumeLevel.style.width = (currentVolume * 100) + '%';

                    // Update icon
                    updateVolumeIcon();
                });
            }

            // Mute/unmute
            if (volumeIcon) {
                volumeIcon.addEventListener('click', function() {
                    if (!audioPlayer) return;

                    isMuted = !isMuted;
                    audioPlayer.muted = isMuted;

                    // Update icon
                    updateVolumeIcon();
                });
            }

            function updateVolumeIcon() {
                if (!volumeIcon) return;

                if (isMuted || currentVolume === 0) {
                    volumeIcon.className = 'ti ti-volume-off';
                } else if (currentVolume < 0.5) {
                    volumeIcon.className = 'ti ti-volume-2';
                } else {
                    volumeIcon.className = 'ti ti-volume';
                }
            }

            // Repeat button
            if (repeatButton) {
                repeatButton.addEventListener('click', function() {
                    isRepeat = !isRepeat;

                    if (audioPlayer) {
                        audioPlayer.loop = isRepeat;
                    }

                    // Update UI
                    repeatButton.classList.toggle('active', isRepeat);
                    if (isRepeat) {
                        repeatButton.innerHTML = '<i class="ti ti-repeat-once"></i>';
                        repeatButton.style.color = 'var(--player-primary)';
                    } else {
                        repeatButton.innerHTML = '<i class="ti ti-repeat"></i>';
                        repeatButton.style.color = '';
                    }
                });
            }

            // Shuffle button
            if (shuffleButton) {
                shuffleButton.addEventListener('click', function() {
                    isShuffle = !isShuffle;

                    // Update UI
                    shuffleButton.classList.toggle('active', isShuffle);
                    if (isShuffle) {
                        shuffleButton.style.color = 'var(--player-primary)';
                    } else {
                        shuffleButton.style.color = '';
                    }

                    // Show notification
                    showNotification(
                        'Shuffle ' + (isShuffle ? 'On' : 'Off'),
                        isShuffle ? 'Songs will play in random order' : 'Songs will play in order',
                        'info'
                    );
                });
            }

            // Mini player toggle
            if (miniPlayerHandle) {
                miniPlayerHandle.addEventListener('click', function() {
                    toggleMiniPlayer();
                });
            }

            function toggleMiniPlayer() {
                isMinimized = !isMinimized;

                if (miniPlayer) {
                    miniPlayer.classList.toggle('minimized', isMinimized);
                }
            }

            // Lyrics fullscreen
            if (expandLyricsBtn) {
                expandLyricsBtn.addEventListener('click', function() {
                    // Show lyrics modal
                    const lyricsModal = new bootstrap.Modal(document.getElementById('lyricsModal'));
                    lyricsModal.show();
                });
            }

            // Equalizer button
            if (equalizerBtn) {
                equalizerBtn.addEventListener('click', function() {
                    // Show equalizer modal
                    const equalizerModal = new bootstrap.Modal(document.getElementById('equalizerModal'));
                    equalizerModal.show();
                });
            }

            // Fullscreen button
            if (fullscreenBtn) {
                fullscreenBtn.addEventListener('click', function() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen().catch(err => {
                            showNotification('Error', 'Could not enter fullscreen mode: ' + err
                                .message, 'error');
                        });
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        }
                    }
                });
            }

            // Copy share link
            if (copyLinkBtn && shareLink) {
                copyLinkBtn.addEventListener('click', function() {
                    shareLink.select();
                    document.execCommand('copy');

                    // Change button text temporarily
                    const originalHTML = copyLinkBtn.innerHTML;
                    copyLinkBtn.innerHTML = '<i class="ti ti-check"></i>';
                    copyLinkBtn.disabled = true;

                    setTimeout(() => {
                        copyLinkBtn.innerHTML = originalHTML;
                        copyLinkBtn.disabled = false;
                    }, 2000);

                    // Show notification
                    showNotification('Link Copied', 'Share link copied to clipboard', 'success');
                });
            }

            // Like button functionality
            const likeButton = document.getElementById('likeButton');
            if (likeButton) {
                likeButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Toggle liked state
                    const isLiked = likeButton.classList.toggle('liked');

                    // Update icon and color
                    if (isLiked) {
                        likeButton.querySelector('i').className = 'ti ti-heart-filled';
                        likeButton.style.color = 'var(--player-primary)';

                        // Show notification
                        showNotification('Added to Liked Songs',
                            'This song has been added to your Liked Songs', 'success');
                    } else {
                        likeButton.querySelector('i').className = 'ti ti-heart';
                        likeButton.style.color = '';

                        // Show notification
                        showNotification('Removed from Liked Songs',
                            'This song has been removed from your Liked Songs', 'info');
                    }
                });
            }

            // Download button
            const downloadButton = document.getElementById('downloadButton');
            if (downloadButton) {
                downloadButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Show notification
                    showNotification('Download Started', 'Your download will begin shortly', 'success');

                    // Simulate download (in a real app, this would be a proper download link)
                    setTimeout(() => {
                        const dummyLink = document.createElement('a');
                        dummyLink.href = "{{ $audioUrl ?? '#' }}";
                        dummyLink.download = "{{ $song->title ?? 'song' }}.mp3";
                        document.body.appendChild(dummyLink);
                        dummyLink.click();
                        document.body.removeChild(dummyLink);
                    }, 1000);
                });
            }

            // Notification system
            function showNotification(title, message, type = 'info') {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `toast show notification-toast notification-${type}`;
                notification.setAttribute('role', 'alert');
                notification.setAttribute('aria-live', 'assertive');
                notification.setAttribute('aria-atomic', 'true');

                // Set notification content
                notification.innerHTML = `
                <div class="toast-header bg-dark text-white border-0">
                    <i class="ti ti-${type === 'success' ? 'check' : type === 'error' ? 'alert-triangle' : 'info-circle'} me-2"></i>
                    <strong class="me-auto">${title}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-dark text-white">
                    ${message}
                </div>
            `;

                // Add notification to container (create if doesn't exist)
                let notificationContainer = document.querySelector('.toast-container');
                if (!notificationContainer) {
                    notificationContainer = document.createElement('div');
                    notificationContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
                    document.body.appendChild(notificationContainer);
                }

                notificationContainer.appendChild(notification);

                // Auto-remove after 3 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        notificationContainer.removeChild(notification);
                    }, 300);
                }, 3000);
            }

            // Attach event listeners to play buttons
            if (playButton) playButton.addEventListener('click', togglePlayPause);
            if (miniPlayBtn) miniPlayBtn.addEventListener('click', togglePlayPause);
            if (mainPlayBtn) mainPlayBtn.addEventListener('click', togglePlayPause);

            // Handle related song play buttons
            const playRelatedBtns = document.querySelectorAll('.play-related-btn');
            playRelatedBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Get song info from parent element
                    const songItem = this.closest('.related-song-item');
                    const songTitle = songItem.querySelector('.text-white').textContent.trim();
                    const artistName = songItem.querySelector('.text-muted').textContent.trim();

                    // Show notification
                    showNotification('Now Playing', `${songTitle} by ${artistName}`, 'success');

                    // In a real app, this would load and play the new song
                    // For demo, we'll just update the UI
                    document.querySelector('.song-title').textContent = songTitle;
                    document.querySelector('.song-artist').textContent = artistName;

                    // Start playing
                    if (audioPlayer) {
                        audioPlayer.currentTime = 0;
                        togglePlayPause();
                    }
                });
            });

            // Add custom CSS for notifications
            const notificationStyles = document.createElement('style');
            notificationStyles.textContent = `
            .notification-toast {
                background-color: rgba(24, 24, 24, 0.9);
                backdrop-filter: blur(10px);
                border-radius: 8px;
                border: 1px solid var(--player-border);
                overflow: hidden;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                margin-bottom: 10px;
            }

            .notification-success .toast-header {
                border-left: 4px solid #28a745;
            }

            .notification-error .toast-header {
                border-left: 4px solid #dc3545;
            }

            .notification-info .toast-header {
                border-left: 4px solid #17a2b8;
            }

            .eq-slider {
                -webkit-appearance: slider-vertical;
            }
        `;
            document.head.appendChild(notificationStyles);

            // Initialize keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Space bar: Play/Pause
                if (e.code === 'Space' && !e.target.matches('input, textarea')) {
                    e.preventDefault();
                    togglePlayPause();
                }

                // Left arrow: Rewind 5 seconds
                if (e.code === 'ArrowLeft' && audioPlayer) {
                    audioPlayer.currentTime = Math.max(0, audioPlayer.currentTime - 5);
                }

                // Right arrow: Forward 5 seconds
                if (e.code === 'ArrowRight' && audioPlayer) {
                    audioPlayer.currentTime = Math.min(audioPlayer.duration, audioPlayer.currentTime + 5);
                }

                // M key: Mute/Unmute
                if (e.code === 'KeyM' && audioPlayer) {
                    isMuted = !isMuted;
                    audioPlayer.muted = isMuted;
                    updateVolumeIcon();
                }

                // Up arrow: Volume up
                if (e.code === 'ArrowUp' && audioPlayer) {
                    currentVolume = Math.min(1, currentVolume + 0.1);
                    audioPlayer.volume = currentVolume;
                    volumeLevel.style.width = (currentVolume * 100) + '%';
                    updateVolumeIcon();
                }

                // Down arrow: Volume down
                if (e.code === 'ArrowDown' && audioPlayer) {
                    currentVolume = Math.max(0, currentVolume - 0.1);
                    audioPlayer.volume = currentVolume;
                    volumeLevel.style.width = (currentVolume * 100) + '%';
                    updateVolumeIcon();
                }

                // L key: Toggle lyrics
                if (e.code === 'KeyL') {
                    const lyricsModal = new bootstrap.Modal(document.getElementById('lyricsModal'));
                    lyricsModal.show();
                }

                // F key: Toggle fullscreen
                if (e.code === 'KeyF') {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen().catch(err => {
                            console.error('Could not enter fullscreen mode:', err);
                        });
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        }
                    }
                }
            });

            // NEW FEATURE: Back button functionality with mini player
            // This allows users to go back to the previous page while keeping the mini player active
            if (minimizePlayerBtn) {
                minimizePlayerBtn.addEventListener('click', function() {
                    // Store current song state in localStorage
                    if (audioPlayer) {
                        const songState = {
                            title: document.querySelector('.song-title').textContent,
                            artist: document.querySelector('.song-artist').textContent,
                            coverImage: document.querySelector('.album-cover').src,
                            currentTime: audioPlayer.currentTime,
                            duration: audioPlayer.duration,
                            isPlaying: isPlaying,
                            songId: "{{ $song->id ?? '' }}"
                        };

                        localStorage.setItem('currentSongState', JSON.stringify(songState));
                    }

                    // Show notification
                    showNotification('Player Minimized', 'Music will continue playing while you browse',
                        'info');

                    // Make mini player visible and persistent
                    if (miniPlayer) {
                        miniPlayer.classList.add('mini-player-visible');
                        // Store mini player visibility state
                        localStorage.setItem('miniPlayerVisible', 'true');
                    }

                    // Navigate back to previous page
                    window.history.back();
                });
            }

            // Check if we should restore mini player state from previous navigation
            const storedMiniPlayerVisible = localStorage.getItem('miniPlayerVisible');
            const storedSongState = localStorage.getItem('currentSongState');

            if (storedMiniPlayerVisible === 'true' && storedSongState) {
                try {
                    const songState = JSON.parse(storedSongState);

                    // Update mini player UI with stored song info
                    if (miniPlayer) {
                        miniPlayer.classList.add('mini-player-visible');

                        // Update mini player info
                        if (document.getElementById('miniPlayerTitle')) {
                            document.getElementById('miniPlayerTitle').textContent = songState.title;
                        }

                        if (document.getElementById('miniPlayerArtist')) {
                            document.getElementById('miniPlayerArtist').textContent = songState.artist;
                        }

                        if (document.getElementById('miniPlayerCover')) {
                            document.getElementById('miniPlayerCover').src = songState.coverImage;
                        }

                        // Set progress bar based on stored time
                        if (songState.currentTime && songState.duration) {
                            const progressPercent = (songState.currentTime / songState.duration) * 100;
                            if (miniPlayerProgressBar) {
                                miniPlayerProgressBar.style.width = progressPercent + '%';
                            }
                        }

                        // Update play/pause button state
                        if (miniPlayBtn) {
                            miniPlayBtn.innerHTML = songState.isPlaying ?
                                '<i class="ti ti-player-pause"></i>' :
                                '<i class="ti ti-player-play"></i>';
                        }

                        // Start visualizer animation if song was playing
                        if (songState.isPlaying && miniVisualizer) {
                            const visualizerBars = miniVisualizer.querySelectorAll('.visualizer-bar');
                            visualizerBars.forEach(bar => {
                                const randomHeight = Math.floor(Math.random() * 10) + 5;
                                bar.style.height = `${randomHeight}px`;
                                bar.style.animation =
                                    `waveformAnimation ${Math.random() * 0.5 + 0.5}s ease-in-out infinite alternate`;
                            });
                        }
                    }

                } catch (error) {
                    console.error('Error restoring mini player state:', error);
                }
            }
        });
    </script>

    <style>
        /* Animation for waveform */
        @keyframes waveformAnimation {
            0% {
                height: 5px;
            }

            100% {
                height: 30px;
            }
        }

        /* Styling for active buttons */
        .control-btn.active {
            color: var(--player-primary);
            background-color: rgba(229, 57, 53, 0.2);
        }

        /* Styling for liked button */
        .action-btn.liked {
            color: var(--player-primary);
        }

        /* Custom scrollbar for lyrics */
        .lyrics-container::-webkit-scrollbar {
            width: 6px;
        }

        .lyrics-container::-webkit-scrollbar-track {
            background: rgba(42, 42, 42, 0.5);
            border-radius: 3px;
        }

        .lyrics-container::-webkit-scrollbar-thumb {
            background-color: var(--player-primary);
            border-radius: 3px;
        }

        /* Social media buttons */
        .btn-facebook {
            background-color: #3b5998;
            color: white;
        }

        .btn-twitter {
            background-color: #1da1f2;
            color: white;
        }

        .btn-whatsapp {
            background-color: #25d366;
            color: white;
        }

        .btn-telegram {
            background-color: #0088cc;
            color: white;
        }

        .btn-instagram {
            background-color: #e1306c;
            color: white;
        }

        .btn-facebook:hover,
        .btn-twitter:hover,
        .btn-whatsapp:hover,
        .btn-telegram:hover,
        .btn-instagram:hover {
            opacity: 0.9;
            color: white;
        }

        /* Back button with mini player styles */
        .back-with-player {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background-color: rgba(24, 24, 24, 0.8);
            backdrop-filter: blur(5px);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid var(--player-border);
        }

        .back-with-player:hover {
            transform: scale(1.1);
            background-color: var(--player-hover);
        }

        /* Make mini player persistent across pages */
        .mini-player-visible {
            display: flex !important;
        }
    </style>
@endsection
