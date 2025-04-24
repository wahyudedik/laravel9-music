@extends('layouts.landing-page')

@section('content')
    <div>
        <!-- Hero Section -->
        <div class="hero-section rounded-lg mb-8" data-aos="fade-up">
            <div class="video-background">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-spotify-dark opacity-90"></div>
                <video autoplay muted loop class="w-full h-full object-cover">
                    <source src="{{ asset('video/Electric background video.mp4') }}" type="video/mp4">
                </video>
            </div>
            <div class="hero-content">
                <div class="container mx-auto px-4">
                    <div class="max-w-3xl">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up">Playlist Saya</h1>
                        <p class="text-xl text-gray-300 mb-6" data-aos="fade-up" data-aos-delay="100">
                            Koleksi playlist musik favorit yang telah Anda buat dan kumpulkan.
                        </p>
                        <div class="flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="200">
                            <button class="btn-spotify px-6 py-3 rounded-full flex items-center gap-2">
                                <i class="ti ti-plus"></i> Buat Playlist Baru
                            </button>
                            <button class="btn-outline-spotify px-6 py-3 rounded-full flex items-center gap-2">
                                <i class="ti ti-playlist"></i> Lihat Semua
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Playlists Section -->
        <div class="mb-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold" data-aos="fade-up">Playlist Saya</h2>
                <a href="#" class="text-primary-500 hover:text-primary-400 flex items-center gap-1"
                    data-aos="fade-up">
                    Lihat Semua <i class="ti ti-chevron-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                <!-- Playlist Card 1 -->
                <div class="music-card" data-aos="fade-up">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/playlist1/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Playlist Favorit Saya" data-artist-name="20 lagu"
                                data-cover-image="https://picsum.photos/seed/playlist1/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Favorit Saya</h3>
                    <p class="text-gray-400 text-sm">20 lagu • Dibuat oleh Anda</p>
                </div>

                <!-- Playlist Card 2 -->
                <div class="music-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/playlist2/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Workout Mix" data-artist-name="15 lagu"
                                data-cover-image="https://picsum.photos/seed/playlist2/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Workout Mix</h3>
                    <p class="text-gray-400 text-sm">15 lagu • Dibuat oleh Anda</p>
                </div>

                <!-- Playlist Card 3 -->
                <div class="music-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/playlist3/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Lagu Santai" data-artist-name="12 lagu"
                                data-cover-image="https://picsum.photos/seed/playlist3/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Lagu Santai</h3>
                    <p class="text-gray-400 text-sm">12 lagu • Dibuat oleh Anda</p>
                </div>

                <!-- Playlist Card 4 -->
                <div class="music-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/playlist4/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Lagu Nostalgia" data-artist-name="18 lagu"
                                data-cover-image="https://picsum.photos/seed/playlist4/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Lagu Nostalgia</h3>
                    <p class="text-gray-400 text-sm">18 lagu • Dibuat oleh Anda</p>
                </div>

                <!-- Playlist Card 5 -->
                <div class="music-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative mb-4 group">
                        <div class="flex items-center justify-center w-full h-full bg-gray-800 rounded-lg aspect-square">
                            <i class="ti ti-plus text-4xl text-gray-400"></i>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Buat Playlist Baru</h3>
                    <p class="text-gray-400 text-sm">Tambahkan koleksi lagu favorit</p>
                </div>
            </div>
        </div>

        <!-- Recommended Playlists -->
        <div class="mb-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold" data-aos="fade-up">Rekomendasi Playlist</h2>
                <a href="#" class="text-primary-500 hover:text-primary-400 flex items-center gap-1"
                    data-aos="fade-up">
                    Lihat Semua <i class="ti ti-chevron-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                <!-- Recommended Playlist 1 -->
                <div class="music-card" data-aos="fade-up">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/rec1/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Top Hits Indonesia" data-artist-name="25 lagu"
                                data-cover-image="https://picsum.photos/seed/rec1/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Top Hits Indonesia</h3>
                    <p class="text-gray-400 text-sm">25 lagu • Playlist Music</p>
                </div>

                <!-- Recommended Playlist 2 -->
                <div class="music-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/rec2/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Dangdut Hits" data-artist-name="30 lagu"
                                data-cover-image="https://picsum.photos/seed/rec2/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Dangdut Hits</h3>
                    <p class="text-gray-400 text-sm">30 lagu • Playlist Music</p>
                </div>

                <!-- Recommended Playlist 3 -->
                <div class="music-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/rec3/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Pop Indonesia 2000an" data-artist-name="22 lagu"
                                data-cover-image="https://picsum.photos/seed/rec3/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Pop Indonesia 2000an</h3>
                    <p class="text-gray-400 text-sm">22 lagu • Playlist Music</p>
                </div>

                <!-- Recommended Playlist 4 -->
                <div class="music-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/rec4/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Rock Indonesia Klasik" data-artist-name="18 lagu"
                                data-cover-image="https://picsum.photos/seed/rec4/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Rock Indonesia Klasik</h3>
                    <p class="text-gray-400 text-sm">18 lagu • Playlist Music</p>
                </div>

                <!-- Recommended Playlist 5 -->
                <div class="music-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative mb-4 group">
                        <img src="https://picsum.photos/seed/rec5/300/300" alt="Playlist Cover"
                            class="music-card-img w-full rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <button
                                class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                                data-song-title="Indie Indonesia" data-artist-name="15 lagu"
                                data-cover-image="https://picsum.photos/seed/rec5/300/300">
                                <i class="ti ti-player-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-1">Indie Indonesia</h3>
                    <p class="text-gray-400 text-sm">15 lagu • Playlist Music</p>
                </div>
            </div>
        </div>

        <!-- Recently Played Playlists -->
        <div class="mb-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold" data-aos="fade-up">Terakhir Diputar</h2>
                <a href="#" class="text-primary-500 hover:text-primary-400 flex items-center gap-1"
                    data-aos="fade-up">
                    Lihat Semua <i class="ti ti-chevron-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Recently Played Item 1 -->
                <div class="bg-spotify-card hover:bg-gray-800 p-4 rounded-lg flex items-center gap-4 transition-all"
                    data-aos="fade-up">
                    <img src="https://picsum.photos/seed/recent1/300/300" alt="Playlist Cover"
                        class="w-16 h-16 rounded-md">
                    <div class="flex-grow">
                        <h3 class="font-semibold text-white">Favorit Saya</h3>
                        <p class="text-gray-400 text-sm">20 lagu • Terakhir diputar 2 jam yang lalu</p>
                    </div>
                    <button
                        class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                        data-song-title="Favorit Saya" data-artist-name="20 lagu"
                        data-cover-image="https://picsum.photos/seed/recent1/300/300">
                        <i class="ti ti-player-play text-xl"></i>
                    </button>
                </div>

                <!-- Recently Played Item 2 -->
                <div class="bg-spotify-card hover:bg-gray-800 p-4 rounded-lg flex items-center gap-4 transition-all"
                    data-aos="fade-up" data-aos-delay="100">
                    <img src="https://picsum.photos/seed/recent2/300/300" alt="Playlist Cover"
                        class="w-16 h-16 rounded-md">
                    <div class="flex-grow">
                        <h3 class="font-semibold text-white">Top Hits Indonesia</h3>
                        <p class="text-gray-400 text-sm">25 lagu • Terakhir diputar 1 hari yang lalu</p>
                    </div>
                    <button
                        class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                        data-song-title="Top Hits Indonesia" data-artist-name="25 lagu"
                        data-cover-image="https://picsum.photos/seed/recent2/300/300">
                        <i class="ti ti-player-play text-xl"></i>
                    </button>
                </div>

                <!-- Recently Played Item 3 -->
                <div class="bg-spotify-card hover:bg-gray-800 p-4 rounded-lg flex items-center gap-4 transition-all"
                    data-aos="fade-up" data-aos-delay="200">
                    <img src="https://picsum.photos/seed/recent3/300/300" alt="Playlist Cover"
                        class="w-16 h-16 rounded-md">
                    <div class="flex-grow">
                        <h3 class="font-semibold text-white">Lagu Santai</h3>
                        <p class="text-gray-400 text-sm">12 lagu • Terakhir diputar 3 hari yang lalu</p>
                    </div>
                    <button
                        class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                        data-song-title="Lagu Santai" data-artist-name="12 lagu"
                        data-cover-image="https://picsum.photos/seed/recent3/300/300">
                        <i class="ti ti-player-play text-xl"></i>
                    </button>
                </div>

                <!-- Recently Played Item 4 -->
                <div class="bg-spotify-card hover:bg-gray-800 p-4 rounded-lg flex items-center gap-4 transition-all"
                    data-aos="fade-up" data-aos-delay="300">
                    <img src="https://picsum.photos/seed/recent4/300/300" alt="Playlist Cover"
                        class="w-16 h-16 rounded-md">
                    <div class="flex-grow">
                        <h3 class="font-semibold text-white">Dangdut Hits</h3>
                        <p class="text-gray-400 text-sm">30 lagu • Terakhir diputar 5 hari yang lalu</p>
                    </div>
                    <button
                        class="play-song-btn p-3 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-all transform hover:scale-105"
                        data-song-title="Dangdut Hits" data-artist-name="30 lagu"
                        data-cover-image="https://picsum.photos/seed/recent4/300/300">
                        <i class="ti ti-player-play text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Create New Playlist Section -->
        <div class="bg-gradient-to-r from-spotify-card to-gray-900 rounded-lg p-8 mb-10" data-aos="fade-up">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="md:w-2/3">
                    <h2 class="text-2xl font-bold mb-3">Buat Playlist Baru</h2>
                    <p class="text-gray-300 mb-4">Kumpulkan lagu-lagu favorit Anda dalam playlist yang dapat disesuaikan.
                        Tambahkan lagu, atur urutan, dan bagikan dengan teman.</p>
                    <div class="flex flex-wrap gap-3">
                        <button class="btn-spotify px-6 py-3 rounded-full flex items-center gap-2">
                            <i class="ti ti-plus"></i> Buat Playlist
                        </button>
                        <button class="btn-outline-spotify px-6 py-3 rounded-full flex items-center gap-2">
                            <i class="ti ti-info-circle"></i> Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>
                <div class="md:w-1/3 flex justify-center">
                    <div class="relative w-48 h-48">
                        <div class="absolute top-0 left-0 w-36 h-36 bg-primary-600 rounded-lg transform rotate-6 z-10">
                        </div>
                        <div class="absolute top-4 left-4 w-36 h-36 bg-gray-800 rounded-lg transform -rotate-3 z-20"></div>
                        <div
                            class="absolute top-8 left-8 w-36 h-36 bg-gray-700 rounded-lg transform rotate-12 z-30 flex items-center justify-center">
                            <i class="ti ti-playlist text-5xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Playlist Categories -->
        <div class="mb-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold" data-aos="fade-up">Kategori Playlist</h2>
                <a href="#" class="text-primary-500 hover:text-primary-400 flex items-center gap-1"
                    data-aos="fade-up">
                    Lihat Semua <i class="ti ti-chevron-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                <!-- Category 1 -->
                <div class="relative overflow-hidden rounded-lg aspect-video group" data-aos="fade-up">
                    <img src="https://picsum.photos/seed/cat1/400/200" alt="Pop"
                        class="w-full h-full object-cover transition-transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-xl font-bold text-white">Pop</h3>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="relative overflow-hidden rounded-lg aspect-video group" data-aos="fade-up"
                    data-aos-delay="100">
                    <img src="https://picsum.photos/seed/cat2/400/200" alt="Rock"
                        class="w-full h-full object-cover transition-transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-xl font-bold text-white">Rock</h3>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="relative overflow-hidden rounded-lg aspect-video group" data-aos="fade-up"
                    data-aos-delay="200">
                    <img src="https://picsum.photos/seed/cat3/400/200" alt="Dangdut"
                        class="w-full h-full object-cover transition-transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-xl font-bold text-white">Dangdut</h3>
                    </div>
                </div>

                <!-- Category 4 -->
                <div class="relative overflow-hidden rounded-lg aspect-video group" data-aos="fade-up"
                    data-aos-delay="300">
                    <img src="https://picsum.photos/seed/cat4/400/200" alt="Indie"
                        class="w-full h-full object-cover transition-transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4">
                        <h3 class="text-xl font-bold text-white">Indie</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="bg-spotify-card rounded-lg p-6 mb-10" data-aos="fade-up">
            <h2 class="text-xl font-bold mb-4">Tips Membuat Playlist</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex items-start gap-3">
                    <div class="bg-primary-600 p-2 rounded-full">
                        <i class="ti ti-bulb text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-1">Tentukan Tema</h3>
                        <p class="text-gray-400 text-sm">Pilih tema spesifik untuk playlist Anda, seperti mood, aktivitas,
                            atau genre.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="bg-primary-600 p-2 rounded-full">
                        <i class="ti ti-sort-ascending text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-1">Atur Urutan</h3>
                        <p class="text-gray-400 text-sm">Susun lagu dengan urutan yang tepat untuk menciptakan pengalaman
                            mendengarkan yang menarik.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="bg-primary-600 p-2 rounded-full">
                        <i class="ti ti-share text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-1">Bagikan</h3>
                        <p class="text-gray-400 text-sm">Bagikan playlist Anda dengan teman dan dapatkan masukan untuk
                            meningkatkan kualitasnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Playlist Modal -->
    <div id="createPlaylistModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-gray-900 rounded-lg shadow">
                <div class="flex items-center justify-between p-4 border-b border-gray-700">
                    <h3 class="text-xl font-semibold text-white">
                        Buat Playlist Baru
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="createPlaylistModal">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <div class="mb-4">
                        <label for="playlist-name" class="block mb-2 text-sm font-medium text-white">Nama Playlist</label>
                        <input type="text" id="playlist-name"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                            placeholder="Masukkan nama playlist">
                    </div>

                    <div class="mb-4">
                        <label for="playlist-description" class="block mb-2 text-sm font-medium text-white">Deskripsi
                            (Opsional)</label>
                        <textarea id="playlist-description" rows="3"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                            placeholder="Tambahkan deskripsi playlist"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-white">Cover Playlist</label>
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-24 bg-gray-800 rounded-lg flex items-center justify-center">
                                <i class="ti ti-photo text-3xl text-gray-400"></i>
                            </div>
                            <div class="flex-grow">
                                <label for="playlist-cover"
                                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg cursor-pointer hover:bg-gray-700 focus:ring-4 focus:ring-gray-700">
                                    <i class="ti ti-upload mr-2"></i> Unggah Gambar
                                    <input id="playlist-cover" type="file" class="hidden" accept="image/*">
                                </label>
                                <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG. Maks 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-white">Privasi</label>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 bg-gray-800 rounded-lg cursor-pointer hover:bg-gray-700">
                                <input type="radio" name="privacy" value="public" checked
                                    class="w-4 h-4 mr-3 text-primary-600 bg-gray-700 border-gray-600 focus:ring-primary-600 focus:ring-2">
                                <div>
                                    <div class="text-white">Publik</div>
                                    <div class="text-gray-400 text-sm">Semua orang dapat menemukan dan mendengarkan</div>
                                </div>
                            </label>

                            <label class="flex items-center p-3 bg-gray-800 rounded-lg cursor-pointer hover:bg-gray-700">
                                <input type="radio" name="privacy" value="private"
                                    class="w-4 h-4 mr-3 text-primary-600 bg-gray-700 border-gray-600 focus:ring-primary-600 focus:ring-2">
                                <div>
                                    <div class="text-white">Pribadi</div>
                                    <div class="text-gray-400 text-sm">Hanya Anda yang dapat melihat dan mendengarkan</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center p-4 border-t border-gray-700">
                    <button type="button"
                        class="text-gray-300 bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-700 rounded-lg border border-gray-600 text-sm font-medium px-5 py-2.5 hover:text-white focus:z-10 mr-2"
                        data-modal-hide="createPlaylistModal">
                        Batal
                    </button>
                    <button type="button"
                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5"
                        data-modal-hide="createPlaylistModal">
                        Buat Playlist
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Playlist Detail Modal -->
    <div id="playlistDetailModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <div class="relative bg-gray-900 rounded-lg shadow">
                <div class="flex items-center justify-between p-4 border-b border-gray-700">
                    <h3 class="text-xl font-semibold text-white">
                        Detail Playlist
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="playlistDetailModal">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6 mb-6">
                        <div class="md:w-1/3">
                            <img src="https://picsum.photos/seed/playlist1/300/300" alt="Playlist Cover"
                                class="w-full rounded-lg shadow-lg">
                            <div class="mt-4 flex gap-2">
                                <button
                                    class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2 rounded-lg flex items-center justify-center gap-2">
                                    <i class="ti ti-player-play"></i> Putar
                                </button>
                                <button class="bg-gray-800 hover:bg-gray-700 text-white p-2 rounded-lg">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <h2 class="text-2xl font-bold mb-2">Favorit Saya</h2>
                            <p class="text-gray-400 mb-4">Kumpulan lagu-lagu favorit yang sering didengarkan.</p>
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white">
                                    <span class="text-xs">YD</span>
                                </div>
                                <span class="text-white">Dibuat oleh Anda</span>
                            </div>
                            <div class="flex items-center gap-4 text-gray-400 text-sm">
                                <span>20 lagu</span>
                                <span>1 jam 15 menit</span>
                                <span>Dibuat 2 bulan yang lalu</span>
                            </div>

                            <div class="mt-6 flex flex-wrap gap-2">
                                <button
                                    class="text-white bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-full flex items-center gap-2 text-sm">
                                    <i class="ti ti-edit"></i> Edit
                                </button>
                                <button
                                    class="text-white bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-full flex items-center gap-2 text-sm">
                                    <i class="ti ti-share"></i> Bagikan
                                </button>
                                <button
                                    class="text-white bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-full flex items-center gap-2 text-sm">
                                    <i class="ti ti-download"></i> Download
                                </button>
                                <button
                                    class="text-white bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-full flex items-center gap-2 text-sm">
                                    <i class="ti ti-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="ti ti-search text-gray-400"></i>
                            </div>
                            <input type="text"
                                class="block w-full p-2 pl-10 text-sm border rounded-lg bg-gray-800 border-gray-700 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Cari dalam playlist">
                        </div>

                        <div class="mt-4 overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-400">
                                <thead class="text-xs uppercase bg-gray-800 text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">Judul</th>
                                        <th scope="col" class="px-6 py-3">Album</th>
                                        <th scope="col" class="px-6 py-3">Ditambahkan</th>
                                        <th scope="col" class="px-6 py-3">Durasi</th>
                                        <th scope="col" class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Song 1 -->
                                    <tr class="border-b bg-gray-900 border-gray-800 hover:bg-gray-800">
                                        <td class="px-6 py-4">1</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <img class="w-10 h-10 rounded mr-3"
                                                    src="https://picsum.photos/seed/song1/100/100" alt="Song cover">
                                                <div>
                                                    <div class="text-white">Judul Lagu 1</div>
                                                    <div>Artis 1</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">Album 1</td>
                                        <td class="px-6 py-4">2 hari yang lalu</td>
                                        <td class="px-6 py-4">3:45</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="text-gray-400 hover:text-white">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Song 2 -->
                                    <tr class="border-b bg-gray-900 border-gray-800 hover:bg-gray-800">
                                        <td class="px-6 py-4">2</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <img class="w-10 h-10 rounded mr-3"
                                                    src="https://picsum.photos/seed/song2/100/100" alt="Song cover">
                                                <div>
                                                    <div class="text-white">Judul Lagu 2</div>
                                                    <div>Artis 2</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">Album 2</td>
                                        <td class="px-6 py-4">1 minggu yang lalu</td>
                                        <td class="px-6 py-4">4:20</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="text-gray-400 hover:text-white">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Song 3 -->
                                    <tr class="border-b bg-gray-900 border-gray-800 hover:bg-gray-800">
                                        <td class="px-6 py-4">3</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <img class="w-10 h-10 rounded mr-3"
                                                    src="https://picsum.photos/seed/song3/100/100" alt="Song cover">
                                                <div>
                                                    <div class="text-white">Judul Lagu 3</div>
                                                    <div>Artis 3</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">Album 3</td>
                                        <td class="px-6 py-4">2 minggu yang lalu</td>
                                        <td class="px-6 py-4">3:15</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="text-gray-400 hover:text-white">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Song 4 -->
                                    <tr class="border-b bg-gray-900 border-gray-800 hover:bg-gray-800">
                                        <td class="px-6 py-4">4</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <img class="w-10 h-10 rounded mr-3"
                                                    src="https://picsum.photos/seed/song4/100/100" alt="Song cover">
                                                <div>
                                                    <div class="text-white">Judul Lagu 4</div>
                                                    <div>Artis 4</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">Album 4</td>
                                        <td class="px-6 py-4">3 minggu yang lalu</td>
                                        <td class="px-6 py-4">4:05</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="text-gray-400 hover:text-white">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Song 5 -->
                                    <tr class="bg-gray-900 hover:bg-gray-800">
                                        <td class="px-6 py-4">5</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <img class="w-10 h-10 rounded mr-3"
                                                    src="https://picsum.photos/seed/song5/100/100" alt="Song cover">
                                                <div>
                                                    <div class="text-white">Judul Lagu 5</div>
                                                    <div>Artis 5</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">Album 5</td>
                                        <td class="px-6 py-4">1 bulan yang lalu</td>
                                        <td class="px-6 py-4">3:30</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="text-gray-400 hover:text-white">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create Playlist Button
            const createPlaylistBtns = document.querySelectorAll('.btn-spotify');
            createPlaylistBtns.forEach(btn => {
                if (btn.textContent.includes('Buat Playlist')) {
                    btn.addEventListener('click', function() {
                        const modal = new window.Flowbite.Modal(document.getElementById(
                            'createPlaylistModal'));
                        modal.show();
                    });
                }
            });

            // Playlist Card Click
            const playlistCards = document.querySelectorAll('.music-card');
            playlistCards.forEach(card => {
                // Skip the "Create New Playlist" card
                if (!card.querySelector('.ti-plus')) {
                    card.addEventListener('click', function(e) {
                        // Don't trigger if clicking the play button
                        if (!e.target.closest('.play-song-btn')) {
                            const modal = new window.Flowbite.Modal(document.getElementById(
                                'playlistDetailModal'));
                            modal.show();
                        }
                    });
                }
            });

            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const x = e.clientX - e.target.getBoundingClientRect().left;
                    const y = e.clientY - e.target.getBoundingClientRect().top;

                    const ripple = document.createElement('div');
                    ripple.classList.add('ripple');
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Playlist Cover Upload Preview
            const playlistCoverInput = document.getElementById('playlist-cover');
            if (playlistCoverInput) {
                playlistCoverInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const coverPreview = playlistCoverInput.closest('.flex').querySelector(
                                '.w-24');
                            coverPreview.innerHTML =
                                `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">`;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endsection
