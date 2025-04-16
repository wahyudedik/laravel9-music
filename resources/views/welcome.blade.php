@extends('layouts.landing-page')

@section('content')
    <!-- Hero Section with Video Background -->
    <div class="relative rounded-xl overflow-hidden mb-10" style="height: 500px;" data-aos="fade-up">
        <!-- Video Background with Blur and Opacity -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/70">
            <video autoplay muted loop
                class="min-w-full min-h-full object-cover opacity-60 filter blur-sm absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <source src="{{ asset('video/Electric background video.mp4') }}"
                    type="video/mp4">
            </video>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 h-full flex items-center p-8">
            <div class="container mx-auto">
                <div class="max-w-3xl" data-aos="fade-right" data-aos-delay="200">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Temukan Musik Terbaik</h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8">Platform musik Indonesia untuk mendengarkan, membuat
                        cover, dan berbagi karya musik.</p>

                    <!-- Search Section -->
                    <form action="#" method="GET" class="mb-8">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="ti ti-search text-gray-400"></i>
                            </div>
                            <input type="search"
                                class="block w-full p-4 pl-10 text-sm text-white border border-gray-700 rounded-lg bg-gray-800 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Cari judul lagu, nama artis...">
                            <button type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-800 font-medium rounded-lg text-sm px-4 py-2">Cari</button>
                        </div>
                    </form>

                    <!-- CTA Buttons -->
                    @guest
                        <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="400">
                            <a href="{{ route('register') }}"
                                class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-base px-6 py-3.5 inline-flex items-center">
                                <i class="ti ti-user-plus mr-2"></i> Daftar Sekarang
                            </a>
                            <a href="{{ route('login') }}"
                                class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-base px-6 py-3.5 inline-flex items-center">
                                <i class="ti ti-login mr-2"></i> Login
                            </a>
                        </div>
                    @endguest
                    @auth
                        <div class="flex items-center gap-4" data-aos="fade-up" data-aos-delay="400">
                            @php
                                $role = auth()->user()->getRoleNames()->first();
                            @endphp
                            @if ($role == 'Admin' || $role == 'Super Admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-base px-6 py-3.5 inline-flex items-center">
                                    <i class="ti ti-dashboard mr-2"></i> Dashboard
                                </a>
                            @else
                                <a href="{{ route('user.dashboard') }}"
                                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-base px-6 py-3.5 inline-flex items-center">
                                    <i class="ti ti-user mr-2"></i> Dashboard
                                </a>
                            @endif
                            <form action="{{ route('logout', ['role' => auth()->user()->getRoleNames()->first()]) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-base px-6 py-3.5 inline-flex items-center">
                                    <i class="ti ti-logout mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Songs Section -->
    <div class="mb-12" data-aos="fade-up">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="ti ti-music text-primary-500 mr-2"></i>Lagu Populer
            </h2>
            <a href="{{ route('popular-songs') }}"
                class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                Lihat Semua <i class="ti ti-chevron-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($songs as $index => $song)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ 100 + $index * 50 }}">
                    <div
                        class="bg-gray-800 p-4 rounded-lg transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2">
                        @php
                            $coverImages = explode(',', $song->cover_image ?? '');
                            $smallCoverFile = $coverImages[2] ?? null;
                            $filename = $smallCoverFile ? basename($smallCoverFile) : null;
                            $imageUrl = $filename
                                ? route('songs.image', ['filename' => $filename])
                                : 'https://via.placeholder.com/300';
                        @endphp
                        <div class="flex flex-col items-center">
                            <div class="relative mb-4">
                                <img src="{{ $imageUrl }}"
                                    class="w-32 h-32 rounded-lg object-cover transition-all duration-300 group-hover:shadow-lg"
                                    alt="{{ $song->title }}">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
                                    <button
                                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-3 inline-flex items-center justify-center play-song-btn"
                                        @guest
onclick="window.location.href='{{ route('login') }}'"
                                        @else
                                            onclick="window.location.href='{{ route('play-song', ['id' => $song->id]) }}'" @endguest>
                                        <i class="ti ti-player-play"></i>
                                    </button>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-white text-center mb-1">{{ $song->title }}</h3>
                            <p class="text-gray-400 text-sm text-center mb-3">{{ $song->artist->name ?? 'Unknown Artist' }}
                            </p>
                            <div class="flex justify-center gap-2 mb-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900 text-purple-200">
                                    <i class="ti ti-player-play mr-1"></i> {{ number_format(rand(1, 50)) }}M
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                    <i class="ti ti-heart mr-1"></i> {{ number_format(rand(100, 999)) }}K
                                </span>
                            </div>
                            <div class="flex justify-center gap-2">
                                <button
                                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-xs px-3 py-1.5 inline-flex items-center"
                                    @guest
onclick="window.location.href='{{ route('login') }}'"
                                    @else
                                        onclick="window.location.href='{{ route('play-song', ['id' => $song->id]) }}'" @endguest>
                                    <i class="ti ti-player-play mr-1"></i> Play
                                </button>
                                <button type="button"
                                    class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-xs px-3 py-1.5 inline-flex items-center"
                                    data-modal-target="addToPlaylistModal" data-modal-toggle="addToPlaylistModal"
                                    data-song-title="{{ $song->title }}"
                                    data-artist-name="{{ $song->artist->name ?? 'Unknown Artist' }}"
                                    data-cover-image="{{ $imageUrl }}">
                                    <i class="ti ti-plus mr-1"></i> Playlist
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Popular Artists Section -->
    <div class="mb-12" data-aos="fade-up">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="ti ti-microphone text-primary-500 mr-2"></i>Artis Populer
            </h2>
            <a href="{{ route('artists') }}"
                class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                Lihat Semua <i class="ti ti-chevron-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($artists as $index => $artist)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ 100 + $index * 50 }}">
                    <div
                        class="bg-gray-800 p-4 rounded-lg transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2 text-center">
                        <img src="https://picsum.photos/300/300?random={{ $artist->id }}"
                            class="w-32 h-32 rounded-full mx-auto mb-4 object-cover transition-all duration-300 group-hover:shadow-lg"
                            alt="{{ $artist->name }}">
                        <h3 class="text-lg font-semibold text-white mb-1">{{ $artist->name }}</h3>
                        <p class="text-gray-400 text-sm mb-3">{{ rand(5, 30) }} Lagu • {{ rand(1, 10) }}M Penggemar
                        </p>
                        <div class="flex justify-center gap-2 mb-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900 text-purple-200">
                                <i class="ti ti-users mr-1"></i> {{ rand(1, 10) }}M
                            </span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                <i class="ti ti-player-play mr-1"></i> {{ rand(10, 500) }}M
                            </span>
                        </div>
                        <a href="#"
                            class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center">
                            <i class="ti ti-user mr-1"></i> Lihat Profil
                        </a>
                    </div>
                </div>
            @endforeach
            @for ($i = 21; $i <= 24; $i++)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ 100 + $i * 50 }}">
                    <div
                        class="bg-gray-800 p-4 rounded-lg transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2 text-center">
                        <img src="https://picsum.photos/300/300?random={{ $i }}"
                            class="w-32 h-32 rounded-full mx-auto mb-4 object-cover transition-all duration-300 group-hover:shadow-lg"
                            alt="Artist">
                        <h3 class="text-lg font-semibold text-white mb-1">Artis Populer #{{ $i - 20 }}</h3>
                        <p class="text-gray-400 text-sm mb-3">{{ rand(5, 30) }} Lagu • {{ rand(1, 10) }}M Penggemar
                        </p>
                        <div class="flex justify-center gap-2 mb-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900 text-purple-200">
                                <i class="ti ti-users mr-1"></i> {{ rand(1, 10) }}M
                            </span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                <i class="ti ti-player-play mr-1"></i> {{ rand(10, 500) }}M
                            </span>
                        </div>
                        <a href="#"
                            class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center">
                            <i class="ti ti-user mr-1"></i> Lihat Profil
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Popular Covers Section -->
    <div class="mb-12" data-aos="fade-up">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="ti ti-disc text-primary-500 mr-2"></i>Cover Populer
            </h2>
            <a href="{{ route('covers') }}"
                class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                Lihat Semua <i class="ti ti-chevron-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for ($i = 41; $i <= 48; $i++)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ 100 + ($i - 40) * 50 }}">
                    <div
                        class="bg-gray-800 p-4 rounded-lg transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2">
                        <div class="relative mb-3">
                            <img src="https://picsum.photos/300/300?random={{ $i }}"
                                class="w-full h-48 object-cover rounded-lg transition-all duration-300 group-hover:shadow-lg"
                                alt="Cover Art">
                            <button
                                class="absolute bottom-2 right-2 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-3 inline-flex items-center justify-center play-song-btn"
                                @guest
onclick="window.location.href='{{ route('login') }}'"
                                @else
                                    onclick="window.location.href='{{ route('play-song', ['id' => $i]) }}'" @endguest
                                data-song-title="Cover Lagu #{{ $i - 40 }}"
                                data-artist-name="Cover Artist {{ $i - 40 }}"
                                data-cover-image="https://picsum.photos/300/300?random={{ $i }}">
                                <i class="ti ti-player-play"></i>
                            </button>
                            @guest
                                <span
                                    class="absolute top-2 right-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-gray-900 rounded-full">
                                    <i class="ti ti-lock"></i>
                                </span>
                            @endguest
                        </div>
                        <h3 class="text-lg font-semibold text-white truncate mb-1">Cover Lagu #{{ $i - 40 }}</h3>
                        <p class="text-gray-400 text-sm truncate mb-3">Oleh: Cover Artist {{ $i - 40 }}</p>
                        <div class="flex gap-2">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                <i class="ti ti-player-play mr-1"></i> {{ rand(100, 999) }}K
                            </span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-900 text-red-200">
                                <i class="ti ti-heart mr-1"></i> {{ rand(10, 99) }}K
                            </span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Popular Composers Section -->
    <div class="mb-12" data-aos="fade-up">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="ti ti-note text-primary-500 mr-2"></i>Pencipta Lagu Teratas
            </h2>
            <a href="{{ route('composers') }}"
                class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                Lihat Semua <i class="ti ti-chevron-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for ($i = 31; $i <= 38; $i++)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ 100 + ($i - 30) * 50 }}">
                    <div
                        class="bg-gray-800 p-4 rounded-lg transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2 text-center">
                        <img src="https://picsum.photos/300/300?random={{ $i }}"
                            class="w-32 h-32 rounded-full mx-auto mb-4 object-cover transition-all duration-300 group-hover:shadow-lg"
                            alt="Composer">
                        <h3 class="text-lg font-semibold text-white mb-1">Pencipta #{{ $i - 30 }}</h3>
                        <p class="text-gray-400 text-sm mb-3">{{ rand(20, 100) }} karya • {{ rand(100, 900) }}K Penggemar
                        </p>
                        <div class="flex justify-center gap-2 mb-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                <i class="ti ti-player-play mr-1"></i> {{ rand(50, 800) }}M
                            </span>
                        </div>
                        <a href="#"
                            class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center">
                            <i class="ti ti-user mr-1"></i> Lihat Profil
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Call to Action -->
    @guest
        <div class="mb-12" data-aos="fade-up">
            <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-xl p-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Bergabunglah dengan Komunitas Musik Kami</h2>
                <p class="text-xl text-gray-300 mb-8">Dengarkan, buat cover, dan bagikan karya musik Anda dengan dunia.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}"
                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-base px-6 py-3.5 inline-flex items-center">
                        <i class="ti ti-user-plus mr-2"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}"
                        class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-base px-6 py-3.5 inline-flex items-center">
                        <i class="ti ti-login mr-2"></i> Login
                    </a>
                </div>
            </div>
        </div>
    @endguest

    <!-- Features Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12" data-aos="fade-up">
        <div data-aos="fade-up" data-aos-delay="100">
            <div
                class="bg-gray-800 rounded-xl p-6 h-full transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2">
                <div class="bg-primary-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="ti ti-music text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-white text-center mb-4">Dengarkan Musik</h3>
                <p class="text-gray-300 text-center">Akses jutaan lagu dari berbagai genre dan artis favorit Anda.
                    Streaming kualitas tinggi kapan saja dan di mana saja.</p>
            </div>
        </div>
        <div data-aos="fade-up" data-aos-delay="200">
            <div
                class="bg-gray-800 rounded-xl p-6 h-full transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2">
                <div class="bg-primary-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="ti ti-microphone text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-white text-center mb-4">Buat Cover</h3>
                <p class="text-gray-300 text-center">Tunjukkan bakat Anda dengan membuat cover lagu favorit. Dapatkan
                    pengakuan dan bangun basis penggemar Anda sendiri.</p>
            </div>
        </div>
        <div data-aos="fade-up" data-aos-delay="300">
            <div
                class="bg-gray-800 rounded-xl p-6 h-full transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2">
                <div class="bg-primary-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="ti ti-share text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-white text-center mb-4">Bagikan Karya</h3>
                <p class="text-gray-300 text-center">Bagikan karya musik Anda dengan dunia. Dapatkan umpan balik, komentar,
                    dan bangun komunitas musik Anda sendiri.</p>
            </div>
        </div>
    </div>

    <!-- Trending Now Section -->
    <div class="mb-12" data-aos="fade-up">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="ti ti-trending-up text-primary-500 mr-2"></i>Trending Sekarang
            </h2>
        </div>

        <div class="bg-gray-800 rounded-xl p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase text-gray-400 border-b border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Artis</th>
                            <th scope="col" class="px-6 py-3">Album</th>
                            <th scope="col" class="px-6 py-3">Durasi</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 5; $i++)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4">{{ $i }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img src="https://picsum.photos/300/300?random={{ 60 + $i }}"
                                            class="w-10 h-10 rounded mr-3" alt="Album Cover">
                                        <span class="font-medium text-white">Trending Song #{{ $i }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">Trending Artist {{ $i }}</td>
                                <td class="px-6 py-4">Album {{ $i }}</td>
                                <td class="px-6 py-4">{{ rand(2, 4) }}:{{ sprintf('%02d', rand(0, 59)) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button
                                            class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-2 inline-flex items-center justify-center play-song-btn"
                                            data-song-title="Trending Song #{{ $i }}"
                                            data-artist-name="Trending Artist {{ $i }}"
                                            data-cover-image="https://picsum.photos/300/300?random={{ 60 + $i }}">
                                            <i class="ti ti-player-play"></i>
                                        </button>
                                        <button type="button"
                                            class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-full p-2 inline-flex items-center justify-center"
                                            data-modal-target="addToPlaylistModal" data-modal-toggle="addToPlaylistModal"
                                            data-song-title="Trending Song #{{ $i }}"
                                            data-artist-name="Trending Artist {{ $i }}"
                                            data-cover-image="https://picsum.photos/300/300?random={{ 60 + $i }}">
                                            <i class="ti ti-plus"></i>
                                        </button>
                                        <button
                                            class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-full p-2 inline-flex items-center justify-center">
                                            <i class="ti ti-heart"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- New Releases Section -->
    <div class="mb-12" data-aos="fade-up">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="ti ti-calendar-event text-primary-500 mr-2"></i>Rilis Terbaru
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @for ($i = 51; $i <= 56; $i++)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ 100 + ($i - 50) * 50 }}">
                    <div
                        class="bg-gray-800 p-3 rounded-lg transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2">
                        <div class="relative mb-3">
                            <img src="https://picsum.photos/300/300?random={{ $i }}"
                                class="w-full h-auto aspect-square object-cover rounded-lg transition-all duration-300 group-hover:shadow-lg"
                                alt="Album Cover">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
                                <button
                                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-3 inline-flex items-center justify-center play-song-btn"
                                    data-song-title="New Release #{{ $i - 50 }}"
                                    data-artist-name="New Artist {{ $i - 50 }}"
                                    data-cover-image="https://picsum.photos/300/300?random={{ $i }}">
                                    <i class="ti ti-player-play"></i>
                                </button>
                            </div>
                        </div>
                        <h3 class="text-sm font-semibold text-white truncate">New Release #{{ $i - 50 }}</h3>
                        <p class="text-gray-400 text-xs truncate">New Artist {{ $i - 50 }}</p>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add custom animations for music cards
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to trending rows
            const trendingRows = document.querySelectorAll('tbody tr');
            trendingRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.classList.add('bg-gray-700');
                    this.style.transform = 'translateX(5px)';
                });

                row.addEventListener('mouseleave', function() {
                    this.classList.remove('bg-gray-700');
                    this.style.transform = '';
                });
            });

            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('button, a.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>
@endsection
