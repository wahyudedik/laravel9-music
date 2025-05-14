<!-- Player Bar -->
<div class="player-bar hidden" id="playerBar">
    <div class="player-progress">
        <div class="player-progress-filled" id="progressBar"></div>
    </div>

    <div class="player-left">
        <div class="player-thumbnail">
            <img src="https://picsum.photos/48" id="playerCover" alt="Music cover">
        </div>
        <div class="player-details">
            <div class="player-song-title" id="playerTitle">Select a song</div>
            <div class="player-artist" id="playerArtist">Artist</div>
        </div>
    </div>

    <div class="player-center">
        <div class="player-controls">
            <button class="player-button" id="shuffleButton">
                <i class="ti ti-arrows-shuffle"></i>
            </button>
            <button class="player-button" id="prevButton">
                <i class="ti ti-player-skip-back"></i>
            </button>
            <button class="player-button main" id="playButton">
                <i class="ti ti-player-play"></i>
            </button>
            <button class="player-button" id="nextButton">
                <i class="ti ti-player-skip-forward"></i>
            </button>
            <button class="player-button" id="repeatButton">
                <i class="ti ti-repeat"></i>
            </button>
        </div>
        <div class="player-time">
            <span id="currentTime">0:00</span>
            <span id="totalTime">0:00</span>
        </div>
    </div>

    <div class="player-right">
        <button class="player-button" id="fullscreenPlayerButton">
            <i class="ti ti-arrows-maximize"></i>
        </button>
        <button class="player-button" id="lyricsButton">
            <i class="ti ti-message"></i>
        </button>
        <button class="player-button" id="queueButton">
            <i class="ti ti-playlist"></i>
        </button>
        <div class="volume-control">
            <button class="player-button" id="muteButton">
                <i class="ti ti-volume"></i>
            </button>
            <input type="range" min="0" max="100" value="80" class="volume-slider" id="volumeSlider">
        </div>
        <button class="player-button text-gray-500 hover:text-red-500 ml-2" id="closePlayerButton">
            <i class="ti ti-x"></i>
        </button>
    </div>
</div>