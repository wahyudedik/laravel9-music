document.addEventListener('DOMContentLoaded', function () {
    // Player elements
    const playerBar = document.getElementById('playerBar');
    const fullscreenPlayer = document.getElementById('fullscreenPlayer');
    const playButton = document.getElementById('playButton');
    const fullscreenPlayButton = document.getElementById('fullscreenPlayButton');
    const closePlayerButton = document.getElementById('closePlayerButton');
    const fullscreenPlayerButton = document.getElementById('fullscreenPlayerButton');
    const closeFullscreenPlayer = document.getElementById('closeFullscreenPlayer');
    const closeFullscreenPlayer2 = document.getElementById('closeFullscreenPlayer2');
    const progressBar = document.getElementById('progressBar');
    const fullscreenProgressBar = document.getElementById('fullscreenProgressBar');
    const fullscreenProgressHandle = document.getElementById('fullscreenProgressHandle');
    const fullscreenProgressContainer = document.getElementById('fullscreenProgressContainer');
    const playerTitle = document.getElementById('playerTitle');
    const playerArtist = document.getElementById('playerArtist');
    const playerCover = document.getElementById('playerCover');
    const fullscreenTitle = document.getElementById('fullscreenTitle');
    const fullscreenArtist = document.getElementById('fullscreenArtist');
    const fullscreenCover = document.getElementById('fullscreenCover');
    const fullscreenAlbum = document.getElementById('fullscreenAlbum');

    // Player tab buttons
    const tabButtons = document.querySelectorAll('.player-tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    // Player view buttons
    const viewButtons = document.querySelectorAll('.player-view-btn');
    const playerViews = document.querySelectorAll('.player-view');

    // Initial state - Hide player bar until a song is played
    let isPlayerVisible = false;
    let currentSong = {
        title: '',
        artist: '',
        cover: '',
        album: '',
        songId: null,
        isPlaying: false,
        progress: 0,
        currentTime: 0,
        duration: 300, // Default 5 minutes
        volume: 80
    };

    // Load saved song from session storage (if exists)
    function loadCurrentSong(element) {
        showDetailSong(element)
        // const saved = sessionStorage.getItem('currentSong');
        // if (saved) {
        //     currentSong = JSON.parse(saved);

        //     // Show player if we have a song
        //     if (currentSong.title) {
        //         showPlayer();
        //         updatePlayerUI();
        //     }
        // }
    }

    // Save current song to session storage
    function saveCurrentSong() {
        sessionStorage.setItem('currentSong', JSON.stringify(currentSong));
    }

    // Show the player bar
    function showPlayer() {
        if (!isPlayerVisible) {
            // playerBar.classList.remove('hidden');
            isPlayerVisible = true;
        }
    }

    // Hide the player bar
    function hidePlayer() {
        playerBar.classList.add('hidden');
        isPlayerVisible = false;

        // Reset current song
        currentSong = {
            title: '',
            artist: '',
            cover: '',
            album: '',
            songId: null,
            isPlaying: false,
            progress: 0,
            currentTime: 0,
            duration: 300,
            volume: 80
        };

        // Remove from session storage
        sessionStorage.removeItem('currentSong');
    }

    // Update player UI with current song info
    function updatePlayerUI() {

    }
    // function updatePlayerUI() {
    //     // Mini player
    //     playerTitle.textContent = currentSong.title;
    //     playerArtist.textContent = currentSong.artist;
    //     playerCover.src = currentSong.cover || 'https://via.placeholder.com/48';
    //     progressBar.style.width = currentSong.progress + '%';

    //     // Fullscreen player
    //     fullscreenTitle.textContent = currentSong.title;
    //     fullscreenArtist.textContent = currentSong.artist;
    //     fullscreenCover.src = currentSong.cover || 'https://via.placeholder.com/480';
    //     fullscreenAlbum.textContent = currentSong.album || 'Unknown Album • 2023';
    //     fullscreenProgressBar.style.width = currentSong.progress + '%';
    //     fullscreenProgressHandle.style.left = currentSong.progress + '%';

    //     // Set play/pause button state
    //     if (currentSong.isPlaying) {
    //         playButton.innerHTML = '<i class="ti ti-player-pause"></i>';
    //         fullscreenPlayButton.innerHTML = '<i class="ti ti-player-pause text-2xl"></i>';
    //         // Add rotation animation to album cover
    //         fullscreenCover.classList.add('album-rotating');
    //     } else {
    //         playButton.innerHTML = '<i class="ti ti-player-play"></i>';
    //         fullscreenPlayButton.innerHTML = '<i class="ti ti-player-play text-2xl"></i>';
    //         // Pause rotation animation
    //         fullscreenCover.classList.remove('album-rotating');
    //     }

    //     // Update queue display
    //     document.getElementById('queueCurrentTitle').textContent = currentSong.title;
    //     document.getElementById('queueCurrentArtist').textContent = currentSong.artist;
    //     document.getElementById('queueCurrentCover').src = currentSong.cover || 'https://via.placeholder.com/48';

    //     // Also update view-specific displays
    //     document.getElementById('visualizerTitle').textContent = currentSong.title;
    //     document.getElementById('visualizerArtist').textContent = currentSong.artist;
    //     document.getElementById('videoTitle').textContent = currentSong.title;
    //     document.getElementById('videoArtist').textContent = currentSong.artist;
    // }

    // Event listeners for buttons

    // Close player button
    if (closePlayerButton) {
        closePlayerButton.addEventListener('click', function () {
            hidePlayer();
        });
    }

    // Open fullscreen player
    // if (fullscreenPlayerButton) {
    //     fullscreenPlayerButton.addEventListener('click', function () {
    //         if (isPlayerVisible) {
    //             fullscreenPlayer.classList.remove('hidden');
    //             document.body.style.overflow = 'hidden'; // Prevent background scrolling
    //         }
    //     });
    // }

    function showDetailSong(songId) {
        if (isPlayerVisible) {
            fullscreenPlayer.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

    }

    // Close fullscreen player
    if (closeFullscreenPlayer) {
        closeFullscreenPlayer.addEventListener('click', function () {
            fullscreenPlayer.classList.add('closing');
            setTimeout(() => {
                fullscreenPlayer.classList.remove('closing');
                fullscreenPlayer.classList.add('hidden');
                document.body.style.overflow = ''; // Restore scrolling
            }, 300);
        });
    }

    if (closeFullscreenPlayer2) {
        closeFullscreenPlayer2.addEventListener('click', function () {
            fullscreenPlayer.classList.add('closing');
            setTimeout(() => {
                fullscreenPlayer.classList.remove('closing');
                fullscreenPlayer.classList.add('hidden');
                document.body.style.overflow = ''; // Restore scrolling
            }, 300);
        });
    }

    // Tab switching in fullscreen player
    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            const tabId = this.getAttribute('data-tab');

            // Remove active class from all buttons and content
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            document.getElementById(tabId + '-tab').classList.add('active');
        });
    });

    // View switching in fullscreen player
    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const viewId = this.getAttribute('data-view');

            // Remove active class from all buttons
            viewButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            // Hide all views
            playerViews.forEach(view => view.classList.add('hidden'));

            // Show selected view
            if (viewId === 'cover') {
                document.getElementById('coverView').classList.remove('hidden');
            } else if (viewId === 'visualizer') {
                document.getElementById('visualizerView').classList.remove('hidden');
                initializeVisualizer();
            } else if (viewId === 'video') {
                document.getElementById('videoView').classList.remove('hidden');
            }
        });
    });

    // More options menu toggle
    const moreOptionsButton = document.getElementById('moreOptionsButton');
    const playerOptionsMenu = document.getElementById('playerOptionsMenu');

    if (moreOptionsButton && playerOptionsMenu) {
        moreOptionsButton.addEventListener('click', function () {
            playerOptionsMenu.classList.toggle('hidden');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (e) {
            if (!moreOptionsButton.contains(e.target) && !playerOptionsMenu.contains(e.target)) {
                playerOptionsMenu.classList.add('hidden');
            }
        });
    }

    // Add to playlist button functionality
    const addToPlaylistButton = document.getElementById('addToPlaylistButton');
    if (addToPlaylistButton) {
        addToPlaylistButton.addEventListener('click', function () {
            // Create a pop-up dialog for playlist selection
            Swal.fire({
                title: 'Add to Playlist',
                html: `
                    <div class="text-left">
                        <div class="mb-4">
                            <input type="text" placeholder="Search playlists" class="w-full p-2 bg-gray-700 text-white rounded border border-gray-600">
                        </div>
                        <div class="space-y-2 max-h-60 overflow-y-auto">
                            <div class="flex items-center p-2 hover:bg-gray-700 rounded cursor-pointer">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-blue-600 rounded mr-3 flex items-center justify-center">
                                    <i class="ti ti-plus text-white"></i>
                                </div>
                                <div>Create new playlist</div>
                            </div>
                            <div class="flex items-center p-2 hover:bg-gray-700 rounded cursor-pointer">
                                <img src="https://picsum.photos/100/100?random=1" class="w-10 h-10 rounded mr-3">
                                <div>My Favorites</div>
                            </div>
                            <div class="flex items-center p-2 hover:bg-gray-700 rounded cursor-pointer">
                                <img src="https://picsum.photos/100/100?random=2" class="w-10 h-10 rounded mr-3">
                                <div>Workout Mix</div>
                            </div>
                            <div class="flex items-center p-2 hover:bg-gray-700 rounded cursor-pointer">
                                <img src="https://picsum.photos/100/100?random=3" class="w-10 h-10 rounded mr-3">
                                <div>Chill Vibes</div>
                            </div>
                            <div class="flex items-center p-2 hover:bg-gray-700 rounded cursor-pointer">
                                <img src="https://picsum.photos/100/100?random=4" class="w-10 h-10 rounded mr-3">
                                <div>Party Playlist</div>
                            </div>
                        </div>
                    </div>
                `,
                background: '#2a2a2a',
                color: '#fff',
                showCloseButton: true,
                showConfirmButton: false
            });
        });
    }

    // Like button functionality
    const likeButton = document.getElementById('likeButton');
    const fullscreenLikeButton = document.getElementById('fullscreenLikeButton');

    function toggleLike(button) {
        button.classList.toggle('text-red-500');
        if (button.classList.contains('text-red-500')) {
            button.innerHTML = '<i class="ti ti-heart-filled' + (button.id === 'likeButton' ? '' : ' text-xl') + '"></i>';
            // Here you would send an API request to save the liked song
        } else {
            button.innerHTML = '<i class="ti ti-heart' + (button.id === 'likeButton' ? '' : ' text-xl') + '"></i>';
            // Here you would send an API request to remove the liked song
        }
    }

    if (likeButton) {
        likeButton.addEventListener('click', function () {
            toggleLike(this);
            // Sync the other like button
            if (fullscreenLikeButton) {
                fullscreenLikeButton.classList.toggle('text-red-500');
                fullscreenLikeButton.innerHTML = this.innerHTML.replace('"></i>', ' text-xl"></i>');
            }
        });
    }

    if (fullscreenLikeButton) {
        fullscreenLikeButton.addEventListener('click', function () {
            toggleLike(this);
            // Sync the other like button
            if (likeButton) {
                likeButton.classList.toggle('text-red-500');
                likeButton.innerHTML = this.innerHTML.replace(' text-xl', '');
            }
        });
    }

    // Remake button functionality
    const remakeButton = document.getElementById('remakeButton');
    if (remakeButton) {
        remakeButton.addEventListener('click', function () {
            // Restart the current song from beginning
            currentSong.progress = 0;
            currentSong.currentTime = 0;
            updatePlayerUI();

            // If not playing, start playing
            if (!currentSong.isPlaying) {
                togglePlayPause();
            }

            // Show a small notification
            Swal.fire({
                text: 'Restarting song',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#333',
                color: '#fff'
            });
        });
    }

    // Share button functionality
    const shareButton = document.getElementById('shareButton');
    if (shareButton) {
        shareButton.addEventListener('click', function () {
            Swal.fire({
                title: 'Share',
                html: `
                    <div class="space-y-4">
                        <div class="flex flex-wrap justify-center gap-4">
                            <button class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="ti ti-brand-facebook text-xl"></i>
                            </button>
                            <button class="w-12 h-12 bg-blue-400 rounded-full flex items-center justify-center">
                                <i class="ti ti-brand-twitter text-xl"></i>
                            </button>
                            <button class="w-12 h-12 bg-pink-600 rounded-full flex items-center justify-center">
                                <i class="ti ti-brand-instagram text-xl"></i>
                            </button>
                            <button class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                                <i class="ti ti-brand-whatsapp text-xl"></i>
                            </button>
                            <button class="w-12 h-12 bg-blue-800 rounded-full flex items-center justify-center">
                                <i class="ti ti-mail text-xl"></i>
                            </button>
                        </div>
                        <div class="pt-4 border-t border-gray-700">
                            <p class="text-sm mb-2">Copy link</p>
                            <div class="flex">
                                <input type="text" readonly value="https://music.example.com/song/123456"
                                   class="flex-1 p-2 bg-gray-700 border border-gray-600 rounded-l text-sm">
                                <button class="bg-red-600 hover:bg-red-700 px-4 rounded-r">
                                    <i class="ti ti-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `,
                background: '#2a2a2a',
                color: '#fff',
                showConfirmButton: false,
                showCloseButton: true
            });
        });
    }

    // Download button functionality
    const downloadButton = document.getElementById('downloadButton');
    if (downloadButton) {
        downloadButton.addEventListener('click', function () {
            Swal.fire({
                title: 'Download',
                text: 'Do you want to download this song?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Download',
                confirmButtonColor: '#e62117',
                background: '#2a2a2a',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Downloading...',
                        text: 'Your download will begin shortly',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#2a2a2a',
                        color: '#fff'
                    });
                }
            });
        });
    }

    // Audio visualizer initialization
    function initializeVisualizer() {
        const canvas = document.getElementById('audioVisualizer');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;

        // Simple visualizer animation
        function drawVisualizer() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Only animate if song is playing
            if (currentSong.isPlaying) {
                const bars = 60;
                const barWidth = canvas.width / bars;

                for (let i = 0; i < bars; i++) {
                    // Generate random height for simulation
                    const height = Math.random() * canvas.height * 0.8;

                    // Create gradient fill
                    const gradient = ctx.createLinearGradient(0, canvas.height, 0, canvas.height - height);
                    gradient.addColorStop(0, 'rgba(78, 16, 229, 0.8)');
                    gradient.addColorStop(1, 'rgba(240, 55, 165, 0.8)');

                    ctx.fillStyle = gradient;
                    ctx.fillRect(i * barWidth, canvas.height - height, barWidth - 2, height);
                }

                requestAnimationFrame(drawVisualizer);
            }
        }

        drawVisualizer();
    }

    // Play/Pause functionality
    function togglePlayPause() {
        if (!currentSong.title) return;

        currentSong.isPlaying = !currentSong.isPlaying;
        updatePlayerUI();
        saveCurrentSong();

        // Simulate progress update
        if (currentSong.isPlaying) {
            startProgressUpdate();
        } else {
            stopProgressUpdate();
        }
    }

    let progressInterval;

    // Start updating progress
    function startProgressUpdate() {
    }
    // function startProgressUpdate() {
    //     // Clear any existing interval
    //     clearInterval(progressInterval);

    //     // Update progress every 300ms (for demonstration)
    //     progressInterval = setInterval(() => {
    //         currentSong.progress += 0.1;
    //         currentSong.currentTime = (currentSong.progress / 100) * currentSong.duration;

    //         // Update UI
    //         progressBar.style.width = currentSong.progress + '%';
    //         fullscreenProgressBar.style.width = currentSong.progress + '%';
    //         fullscreenProgressHandle.style.left = currentSong.progress + '%';

    //         // Update time displays
    //         document.getElementById('currentTime').textContent = formatTime(currentSong.currentTime);
    //         document.getElementById('totalTime').textContent = formatTime(currentSong.duration);
    //         document.getElementById('fullscreenCurrentTime').textContent = formatTime(currentSong.currentTime);
    //         document.getElementById('fullscreenTotalTime').textContent = formatTime(currentSong.duration);

    //         // Save state
    //         saveCurrentSong();

    //         // If song ended
    //         if (currentSong.progress >= 100) {
    //             clearInterval(progressInterval);
    //             currentSong.isPlaying = false;
    //             currentSong.progress = 0;
    //             currentSong.currentTime = 0;
    //             updatePlayerUI();
    //             saveCurrentSong();
    //         }
    //     }, 300);
    // }

    // Stop progress updates
    function stopProgressUpdate() {
        clearInterval(progressInterval);
    }

    // Format time (seconds to MM:SS)
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = Math.floor(seconds % 60);
        return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
    }

    // Play/Pause buttons event listeners
    if (playButton) {
        playButton.addEventListener('click', togglePlayPause);
    }

    if (fullscreenPlayButton) {
        fullscreenPlayButton.addEventListener('click', togglePlayPause);
    }

    // Progress bar click for seeking
    if (fullscreenProgressContainer) {
        fullscreenProgressContainer.addEventListener('click', function (e) {
            if (!currentSong.title) return;

            const rect = this.getBoundingClientRect();
            const clickPosition = e.clientX - rect.left;
            const progressPercentage = (clickPosition / rect.width) * 100;

            currentSong.progress = progressPercentage;
            currentSong.currentTime = (progressPercentage / 100) * currentSong.duration;

            updatePlayerUI();
            saveCurrentSong();

            // If playing, restart the progress update
            if (currentSong.isPlaying) {
                stopProgressUpdate();
                startProgressUpdate();
            }
        });
    }

    // Player progress bar click (seek in mini player)
    const playerProgressBar = document.querySelector('.player-progress');
    if (playerProgressBar) {
        playerProgressBar.addEventListener('click', function (e) {
            if (!currentSong.title) return;

            const rect = this.getBoundingClientRect();
            const clickPosition = e.clientX - rect.left;
            const progressPercentage = (clickPosition / rect.width) * 100;

            currentSong.progress = progressPercentage;
            currentSong.currentTime = (progressPercentage / 100) * currentSong.duration;

            updatePlayerUI();
            saveCurrentSong();

            // If playing, restart the progress update
            if (currentSong.isPlaying) {
                stopProgressUpdate();
                startProgressUpdate();
            }
        });
    }

    // Play song click handler - works with song items in the UI
    document.querySelectorAll('.play-song-btn').forEach(button => {
        button.addEventListener('click', function (e) {

            // Only prevent default if not a login link
            if (!this.hasAttribute('data-login-required')) {
                e.preventDefault();

                // Get song data from attributes
                const title = this.getAttribute('data-title') || 'Unknown Song';
                const artist = this.getAttribute('data-artist') || 'Unknown Artist';
                const cover = this.getAttribute('data-cover') || 'https://via.placeholder.com/300';
                const album = this.getAttribute('data-album') || 'Unknown Album';
                const songId = this.getAttribute('data-id') || Date.now().toString();

                const duration = parseInt(this.getAttribute('data-duration') || 300);

                // Update current song
                currentSong = {
                    title: title,
                    artist: artist,
                    cover: cover,
                    album: album,
                    songId: songId,
                    duration: duration,
                    isPlaying: true,
                    progress: 0,
                    currentTime: 0,
                    volume: currentSong.volume || 80
                };

                // Show player, update UI, save state and start playing
                // showPlayer();
                showPlayer();
                showDetailSong(songId);
                updatePlayerUI();
                saveCurrentSong();
                // stopProgressUpdate();
                // startProgressUpdate();

                // Show notification
                // if (typeof Swal !== 'undefined') {
                //     Swal.fire({
                //         text: `Now playing: ${title} - ${artist}`,
                //         toast: true,
                //         position: 'top-end',
                //         showConfirmButton: false,
                //         timer: 3000,
                //         timerProgressBar: true,
                //         background: '#333',
                //         color: '#fff',
                //         iconHtml: '<i class="ti ti-music text-red-500"></i>'
                //     });
                // }
            }
        });
    });

    // Volume control
    const volumeSlider = document.getElementById('volumeSlider');
    const fullscreenVolumeSlider = document.getElementById('fullscreenVolumeSlider');
    const muteButton = document.getElementById('muteButton');
    const fullscreenMuteButton = document.getElementById('fullscreenMuteButton');
    let isMuted = false;
    let lastVolume = 80;

    // Set initial volume
    function setVolume(value) {
        // Update both volume sliders
        if (volumeSlider) volumeSlider.value = value;
        if (fullscreenVolumeSlider) fullscreenVolumeSlider.value = value;

        // Update mute button icon based on volume
        updateMuteButtonIcon(value);

        // Save to current song
        currentSong.volume = value;
        saveCurrentSong();
    }

    // Update mute button icon based on volume
    function updateMuteButtonIcon(volume) {
        const icon = volume == 0 ?
            '<i class="ti ti-volume-off"></i>' :
            (volume < 50 ?
                '<i class="ti ti-volume-2"></i>' :
                '<i class="ti ti-volume"></i>');

        if (muteButton) muteButton.innerHTML = icon;
        if (fullscreenMuteButton) fullscreenMuteButton.innerHTML = icon;
    }

    // Sync volume sliders
    if (volumeSlider) {
        volumeSlider.addEventListener('input', function () {
            setVolume(this.value);
        });
    }

    if (fullscreenVolumeSlider) {
        fullscreenVolumeSlider.addEventListener('input', function () {
            setVolume(this.value);
        });
    }

    // Mute button functionality
    function toggleMute() {
        if (isMuted) {
            // Unmute - restore last volume
            setVolume(lastVolume || 80);
            isMuted = false;
        } else {
            // Mute - save current volume and set to 0
            lastVolume = currentSong.volume;
            setVolume(0);
            isMuted = true;
        }
    }

    if (muteButton) {
        muteButton.addEventListener('click', toggleMute);
    }

    if (fullscreenMuteButton) {
        fullscreenMuteButton.addEventListener('click', toggleMute);
    }

    // Shuffle button functionality
    const shuffleButton = document.getElementById('shuffleButton');
    const fullscreenShuffleButton = document.getElementById('fullscreenShuffleButton');
    let isShuffled = false;

    function toggleShuffle() {
        isShuffled = !isShuffled;

        if (shuffleButton) {
            if (isShuffled) {
                shuffleButton.classList.add('text-red-500');
            } else {
                shuffleButton.classList.remove('text-red-500');
            }
        }

        if (fullscreenShuffleButton) {
            if (isShuffled) {
                fullscreenShuffleButton.classList.add('text-red-500');
            } else {
                fullscreenShuffleButton.classList.remove('text-red-500');
            }
        }
    }

    if (shuffleButton) {
        shuffleButton.addEventListener('click', toggleShuffle);
    }

    if (fullscreenShuffleButton) {
        fullscreenShuffleButton.addEventListener('click', toggleShuffle);
    }

    // Repeat button functionality
    const repeatButton = document.getElementById('repeatButton');
    const fullscreenRepeatButton = document.getElementById('fullscreenRepeatButton');
    let repeatMode = 'none'; // 'none', 'all', 'one'

    function toggleRepeat() {
        if (repeatMode === 'none') {
            repeatMode = 'all';
            updateRepeatButtonUI('all');
        } else if (repeatMode === 'all') {
            repeatMode = 'one';
            updateRepeatButtonUI('one');
        } else {
            repeatMode = 'none';
            updateRepeatButtonUI('none');
        }
    }

    function updateRepeatButtonUI(mode) {
        if (repeatButton) {
            if (mode === 'none') {
                repeatButton.innerHTML = '<i class="ti ti-repeat"></i>';
                repeatButton.classList.remove('text-red-500');
            } else if (mode === 'all') {
                repeatButton.innerHTML = '<i class="ti ti-repeat"></i>';
                repeatButton.classList.add('text-red-500');
            } else {
                repeatButton.innerHTML = '<i class="ti ti-repeat-once"></i>';
                repeatButton.classList.add('text-red-500');
            }
        }

        if (fullscreenRepeatButton) {
            if (mode === 'none') {
                fullscreenRepeatButton.innerHTML = '<i class="ti ti-repeat text-xl"></i>';
                fullscreenRepeatButton.classList.remove('text-red-500');
            } else if (mode === 'all') {
                fullscreenRepeatButton.innerHTML = '<i class="ti ti-repeat text-xl"></i>';
                fullscreenRepeatButton.classList.add('text-red-500');
            } else {
                fullscreenRepeatButton.innerHTML = '<i class="ti ti-repeat-once text-xl"></i>';
                fullscreenRepeatButton.classList.add('text-red-500');
            }
        }
    }

    if (repeatButton) {
        repeatButton.addEventListener('click', toggleRepeat);
    }

    if (fullscreenRepeatButton) {
        fullscreenRepeatButton.addEventListener('click', toggleRepeat);
    }

    // Previous button
    const prevButton = document.getElementById('prevButton');
    const fullscreenPrevButton = document.getElementById('fullscreenPrevButton');

    function playPreviousSong() {
        // Reset current song to beginning if progress is past 3 seconds
        if (currentSong.currentTime > 3) {
            currentSong.progress = 0;
            currentSong.currentTime = 0;
            updatePlayerUI();

            if (currentSong.isPlaying) {
                stopProgressUpdate();
                startProgressUpdate();
            }

            return;
        }

        // Otherwise, play the previous song in queue
        // For demo purposes, we'll just simulate with random data
        const prevSongData = {
            title: 'Previous Song ' + Math.floor(Math.random() * 100),
            artist: 'Artist ' + Math.floor(Math.random() * 20),
            cover: 'https://picsum.photos/300/300?random=' + Math.floor(Math.random() * 1000),
            album: 'Album ' + Math.floor(Math.random() * 10),
            songId: Date.now().toString(),
            duration: 180 + Math.floor(Math.random() * 180),
            isPlaying: true,
            progress: 0,
            currentTime: 0,
            volume: currentSong.volume
        };

        currentSong = prevSongData;
        showPlayer();
        updatePlayerUI();
        saveCurrentSong();

        if (currentSong.isPlaying) {
            stopProgressUpdate();
            startProgressUpdate();
        }
    }

    if (prevButton) {
        prevButton.addEventListener('click', playPreviousSong);
    }

    if (fullscreenPrevButton) {
        fullscreenPrevButton.addEventListener('click', playPreviousSong);
    }

    // Next button
    const nextButton = document.getElementById('nextButton');
    const fullscreenNextButton = document.getElementById('fullscreenNextButton');

    function playNextSong() {
        // Play the next song in queue
        // For demo purposes, we'll just simulate with random data
        const nextSongData = {
            title: 'Next Song ' + Math.floor(Math.random() * 100),
            artist: 'Artist ' + Math.floor(Math.random() * 20),
            cover: 'https://picsum.photos/300/300?random=' + Math.floor(Math.random() * 1000),
            album: 'Album ' + Math.floor(Math.random() * 10),
            songId: Date.now().toString(),
            duration: 180 + Math.floor(Math.random() * 180),
            isPlaying: true,
            progress: 0,
            currentTime: 0,
            volume: currentSong.volume
        };

        currentSong = nextSongData;
        showPlayer();
        updatePlayerUI();
        saveCurrentSong();

        if (currentSong.isPlaying) {
            stopProgressUpdate();
            startProgressUpdate();
        }
    }

    if (nextButton) {
        nextButton.addEventListener('click', playNextSong);
    }

    if (fullscreenNextButton) {
        fullscreenNextButton.addEventListener('click', playNextSong);
    }

    // Queue functionality
    const clearQueueButton = document.getElementById('clearQueueButton');

    if (clearQueueButton) {
        clearQueueButton.addEventListener('click', function () {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Clear Queue',
                    text: 'Are you sure you want to clear your queue?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, clear it',
                    confirmButtonColor: '#e62117',
                    background: '#2a2a2a',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Clear queue items
                        const queueItems = document.getElementById('queueItems');
                        if (queueItems) {
                            queueItems.innerHTML = '';
                        }

                        Swal.fire({
                            text: 'Queue cleared',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            background: '#333',
                            color: '#fff'
                        });
                    }
                });
            }
        });
    }

    // Related songs play functionality
    document.querySelectorAll('.play-related-btn').forEach(button => {
        button.addEventListener('click', function () {
            const songItem = this.closest('div.flex');

            if (songItem) {
                const title = songItem.querySelector('h4').textContent;
                const artist = songItem.querySelector('p').textContent;
                const coverImg = songItem.querySelector('img');
                const cover = coverImg ? coverImg.src : 'https://via.placeholder.com/300';

                // Update current song
                currentSong = {
                    title: title,
                    artist: artist,
                    cover: cover,
                    album: 'Related Songs',
                    songId: Date.now().toString(),
                    duration: 180 + Math.floor(Math.random() * 180),
                    isPlaying: true,
                    progress: 0,
                    currentTime: 0,
                    volume: currentSong.volume || 80
                };

                // Show player, update UI, save state and start playing
                showPlayer();
                updatePlayerUI();
                saveCurrentSong();
                stopProgressUpdate();
                startProgressUpdate();
            }
        });
    });

    // Handle keyboard shortcuts
    document.addEventListener('keydown', function (e) {
        // Only if player is visible
        if (!isPlayerVisible) return;

        // Space: Play/Pause
        if (e.code === 'Space' && !e.target.matches('input, textarea, button, [contenteditable]')) {
            e.preventDefault(); // Prevent page scrolling
            togglePlayPause();
        }

        // Left Arrow: Rewind 5 seconds
        if (e.code === 'ArrowLeft' && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            const newTime = Math.max(0, currentSong.currentTime - 5);
            currentSong.currentTime = newTime;
            currentSong.progress = (newTime / currentSong.duration) * 100;
            updatePlayerUI();

            if (currentSong.isPlaying) {
                stopProgressUpdate();
                startProgressUpdate();
            }
        }

        // Right Arrow: Forward 5 seconds
        if (e.code === 'ArrowRight' && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            const newTime = Math.min(currentSong.duration, currentSong.currentTime + 5);
            currentSong.currentTime = newTime;
            currentSong.progress = (newTime / currentSong.duration) * 100;
            updatePlayerUI();

            if (currentSong.isPlaying) {
                stopProgressUpdate();
                startProgressUpdate();
            }
        }

        // M: Mute/Unmute
        if (e.code === 'KeyM' && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            toggleMute();
        }

        // N: Next song
        if (e.code === 'KeyN' && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            playNextSong();
        }

        // P: Previous song
        if (e.code === 'KeyP' && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            playPreviousSong();
        }

        // L: Loop/Repeat toggle
        if (e.code === 'KeyL' && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            toggleRepeat();
        }

        // S: Shuffle toggle
        if (e.code === 'KeyS' && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            toggleShuffle();
        }

        // F: Fullscreen toggle
        if (e.code === 'KeyF' && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            if (fullscreenPlayer.classList.contains('hidden')) {
                fullscreenPlayer.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                fullscreenPlayer.classList.add('closing');
                setTimeout(() => {
                    fullscreenPlayer.classList.remove('closing');
                    fullscreenPlayer.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        // ESC: Close fullscreen
        if (e.code === 'Escape' && !fullscreenPlayer.classList.contains('hidden')) {
            fullscreenPlayer.classList.add('closing');
            setTimeout(() => {
                fullscreenPlayer.classList.remove('closing');
                fullscreenPlayer.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        // 0-9: Volume control (0 = 0%, 1 = 10%, ..., 9 = 90%)
        if (e.code.match(/^Digit[0-9]$/) && !e.target.matches('input, textarea, [contenteditable]')) {
            e.preventDefault();
            const volumeLevel = parseInt(e.code.replace('Digit', '')) * 10;
            setVolume(volumeLevel);
        }
    });

    // Initialize player functionality when document is loaded
    function initPlayer() {
        // Load saved song if exists
        //loadCurrentSong();

        // Set initial volume
        if (volumeSlider && currentSong.volume) {
            volumeSlider.value = currentSong.volume;
        }

        if (fullscreenVolumeSlider && currentSong.volume) {
            fullscreenVolumeSlider.value = currentSong.volume;
        }

        // Start progress updates if song is playing
        if (currentSong.isPlaying) {
            startProgressUpdate();
        }

        // Initialize drag functionality for queue items if sortable library exists
        if (typeof Sortable !== 'undefined') {
            const queueList = document.getElementById('queueItems');
            if (queueList) {
                Sortable.create(queueList, {
                    animation: 150,
                    ghostClass: 'bg-gray-700'
                });
            }
        }

        // Setup mobile player bar functionality
        setupMobilePlayerBar();
    }

    // Resize event for visualizer
    window.addEventListener('resize', function () {
        const canvas = document.getElementById('audioVisualizer');
        if (canvas) {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
    });

    // Handle player bar click on mobile
    function setupMobilePlayerBar() {
        const playerBar = document.getElementById('playerBar');

        if (playerBar) {
            // Add click event to the entire player bar for mobile
            playerBar.addEventListener('click', function(e) {
                // Only open fullscreen when clicking on non-interactive elements on mobile
                if (window.innerWidth <= 768) {
                    // Check if not clicking on button, slider, or progress bar
                    if (!e.target.closest('.player-button') &&
                        !e.target.closest('.volume-slider') &&
                        !e.target.closest('.player-progress')) {

                        // Open fullscreen player
                        if (fullscreenPlayer && fullscreenPlayer.classList.contains('hidden')) {
                            fullscreenPlayer.classList.remove('hidden');
                            document.body.style.overflow = 'hidden'; // Prevent background scrolling
                        }
                    }
                }
            });
        }
    }

    // Init player
    initPlayer();
});


