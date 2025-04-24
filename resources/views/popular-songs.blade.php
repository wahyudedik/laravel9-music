@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Lagu Populer</h2>
            <div class="text-gray-400">Daftar 50 lagu terpopuler saat ini berdasarkan jumlah stream dan likes</div>
        </div>
    </div>

    <!-- Filter Chips -->
    <div class="flex flex-wrap gap-2 mb-6" data-aos="fade-up" data-aos-delay="100">
        <div class="inline-flex rounded-md shadow-sm">
            <button type="button"
                class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-primary-600 rounded-l-lg hover:bg-primary-700 focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Semua
            </button>
            <button type="button"
                class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-t border-b border-gray-600 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Pop
            </button>
            <button type="button"
                class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-t border-b border-gray-600 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Rock
            </button>
            <button type="button"
                class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-t border-b border-gray-600 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Hip Hop
            </button>
            <button type="button"
                class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-t border-b border-gray-600 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                R&B
            </button>
            <button type="button"
                class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-r border-t border-b border-gray-600 rounded-r-lg hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Electronic
            </button>
        </div>
    </div>

    <!-- Popular Songs Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12" data-aos="fade-up"
        data-aos-delay="200">
        @for ($i = 1; $i <= 12; $i++)
            <div class="group" data-aos="fade-up" data-aos-delay="{{ 200 + $i * 10 }}">
                <div
                    class="bg-gray-800 rounded-lg overflow-hidden transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2 h-full">
                    <div class="relative">
                        <img src="https://picsum.photos/300/300?random={{ $i + 100 }}"
                            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
                            alt="Song Cover">
                        @guest
                            <span
                                class="absolute top-2 right-2 inline-flex items-center justify-center p-1.5 text-xs font-bold leading-none text-white bg-gray-900 rounded-full">
                                <i class="ti ti-lock"></i>
                            </span>
                        @endguest
                    </div>
                    <div class="p-4">
                        <h5 class="text-lg font-semibold text-white mb-1 truncate">Judul Lagu Populer #{{ $i }}
                        </h5>
                        <p class="text-gray-400 text-sm mb-3 truncate">Artis Populer #{{ rand(1, 20) }}</p>
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex gap-2">
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-900 text-blue-200">
                                    <i class="ti ti-player-play mr-1"></i> {{ rand(1, 50) }}M
                                </span>
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-red-900 text-red-200">
                                    <i class="ti ti-heart mr-1"></i> {{ rand(100, 999) }}K
                                </span>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-900 text-green-200">
                                <i class="ti ti-calendar mr-1"></i> {{ rand(1, 12) }} bulan
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <button
                                class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-3 py-1.5 inline-flex items-center play-song-btn"
                                @guest
onclick="window.location.href='{{ route('login') }}'"
                                @else
                                    onclick="window.location.href='{{ route('play-song', ['id' => $i]) }}'" @endguest
                                data-song-title="Judul Lagu Populer #{{ $i }}"
                                data-artist-name="Artis Populer #{{ rand(1, 20) }}"
                                data-cover-image="https://picsum.photos/300/300?random={{ $i + 100 }}">
                                <i class="ti ti-player-play mr-1"></i> Play
                            </button>
                            <div class="relative">
                                <button id="dropdownMenuButton{{ $i }}"
                                    data-dropdown-toggle="songDropdown{{ $i }}"
                                    class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-sm p-1.5 inline-flex items-center">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div id="songDropdown{{ $i }}"
                                    class="hidden z-10 w-44 bg-gray-800 rounded-lg shadow-lg">
                                    <ul class="py-2 text-sm text-gray-200"
                                        aria-labelledby="dropdownMenuButton{{ $i }}">
                                        @auth
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-700"
                                                    data-modal-target="addToPlaylistModal"
                                                    data-modal-toggle="addToPlaylistModal"
                                                    data-song-title="Judul Lagu Populer #{{ $i }}"
                                                    data-artist-name="Artis Populer #{{ rand(1, 20) }}"
                                                    data-cover-image="https://picsum.photos/300/300?random={{ $i + 100 }}">
                                                    <i class="ti ti-plus mr-2"></i> Tambah ke Playlist
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-700">
                                                    <i class="ti ti-heart mr-2"></i> Tambah ke Favorit
                                                </a>
                                            </li>

                                            @if (Auth::user()->hasAnyRole(['Cover Creator', 'Artist', 'Composer']))
                                                <li>
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-700">
                                                        <i class="ti ti-bookmark mr-2"></i> Tambah ke Wishlist
                                                    </a>
                                                </li>
                                            @endif

                                            @if (Auth::user()->hasAnyRole(['Cover Creator', 'Artist', 'Composer']))
                                                <li>
                                                    <hr class="h-px my-2 bg-gray-600 border-0">
                                                </li>
                                                <li>
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-700">
                                                        <i class="ti ti-microphone mr-2"></i> Buat Cover
                                                    </a>
                                                </li>
                                            @endif
                                        @else
                                            <li>
                                                <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-700">
                                                    <i class="ti ti-login mr-2"></i> Login untuk Opsi Lainnya
                                                </a>
                                            </li>
                                        @endauth

                                        <li>
                                            <hr class="h-px my-2 bg-gray-600 border-0">
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-700">
                                                <i class="ti ti-share mr-2"></i> Bagikan
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('play-song', ['id' => $i]) }}"
                                                class="block px-4 py-2 hover:bg-gray-700">
                                                <i class="ti ti-info-circle mr-2"></i> Detail Lagu
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Trending This Week Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg mb-10" data-aos="fade-up" data-aos-delay="400">
        <div class="border-b border-gray-700 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="ti ti-trending-up mr-2 text-primary-500"></i>Trending Minggu Ini
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ 400 + $i * 50 }}">
                        <div
                            class="bg-gray-700 rounded-lg overflow-hidden transition-all duration-300 hover:bg-gray-600 hover:shadow-xl hover:-translate-y-2 h-full">
                            <div class="relative">
                                <img src="https://picsum.photos/300/300?random={{ $i + 300 }}"
                                    class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
                                    alt="Trending Song">
                                <span
                                    class="absolute top-2 right-2 inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-red-900 text-red-200">
                                    <i class="ti ti-flame mr-1"></i> Hot
                                </span>
                            </div>
                            <div class="p-4">
                                <h5 class="text-lg font-semibold text-white mb-1 truncate">Trending Song
                                    #{{ $i }}</h5>
                                <p class="text-gray-300 text-sm mb-3 truncate">Trending Artist #{{ $i }}</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex gap-2">
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-900 text-blue-200">
                                            <i class="ti ti-player-play mr-1"></i> {{ rand(5, 20) }}M
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-red-900 text-red-200">
                                            <i class="ti ti-heart mr-1"></i> {{ rand(500, 999) }}K
                                        </span>
                                    </div>
                                    <button
                                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-3 py-1.5 inline-flex items-center play-song-btn"
                                        @guest
onclick="window.location.href='{{ route('login') }}'"
                                        @else
                                            onclick="window.location.href='{{ route('play-song', ['id' => $i]) }}'" @endguest
                                        data-song-title="Trending Song #{{ $i }}"
                                        data-artist-name="Trending Artist #{{ $i }}"
                                        data-cover-image="https://picsum.photos/300/300?random={{ $i + 300 }}">
                                        <i class="ti ti-player-play mr-1"></i> Play
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- New Releases Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg mb-12" data-aos="fade-up" data-aos-delay="500">
        <div class="border-b border-gray-700 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="ti ti-sparkles mr-2 text-primary-500"></i>Rilis Terbaru
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ 500 + $i * 50 }}">
                        <div
                            class="bg-gray-700 rounded-lg overflow-hidden transition-all duration-300 hover:bg-gray-600 hover:shadow-xl hover:-translate-y-2 h-full">
                            <div class="relative">
                                <img src="https://picsum.photos/300/300?random={{ $i + 400 }}"
                                    class="w-full h-auto aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                                    alt="New Release">
                                <span
                                    class="absolute top-2 right-2 inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-900 text-green-200">Baru</span>
                            </div>
                            <div class="p-3">
                                <h6 class="text-sm font-semibold text-white mb-1 truncate">New Release
                                    #{{ $i }}</h6>
                                <p class="text-gray-300 text-xs mb-2 truncate">New Artist #{{ $i }}</p>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-blue-900 text-blue-200">
                                        <i class="ti ti-player-play mr-1"></i> {{ rand(100, 500) }}K
                                    </span>
                                    <button
                                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-1.5 inline-flex items-center justify-center play-song-btn"
                                        @guest
onclick="window.location.href='{{ route('login') }}'"
                                        @else
                                            onclick="window.location.href='{{ route('play-song', ['id' => $i]) }}'" @endguest
                                        data-song-title="New Release #{{ $i }}"
                                        data-artist-name="New Artist #{{ $i }}"
                                        data-cover-image="https://picsum.photos/300/300?random={{ $i + 400 }}">
                                        <i class="ti ti-player-play"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Genre Highlights -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12" data-aos="fade-up" data-aos-delay="600">
        <div class="bg-gray-800 rounded-lg shadow-lg h-full">
            <div class="border-b border-gray-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="ti ti-music mr-2 text-primary-500"></i>Pop Hits
                </h3>
            </div>
            <div class="p-4">
                <ul class="divide-y divide-gray-700">
                    @for ($i = 1; $i <= 5; $i++)
                        <li class="py-3 transition-all duration-300 hover:bg-gray-700 hover:translate-x-2 rounded-lg px-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 text-gray-400">{{ $i }}</div>
                                <div class="flex-shrink-0 relative">
                                    <img src="https://picsum.photos/300/300?random={{ $i + 500 }}"
                                        class="w-10 h-10 rounded-md" alt="Pop Song">
                                    <button
                                        class="absolute -bottom-1 -right-1 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-1 inline-flex items-center justify-center play-song-btn"
                                        data-song-title="Pop Hit #{{ $i }}"
                                        data-artist-name="Pop Artist #{{ $i }}"
                                        data-cover-image="https://picsum.photos/300/300?random={{ $i + 500 }}">
                                        <i class="ti ti-player-play text-xs"></i>
                                    </button>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-white truncate">Pop Hit #{{ $i }}</p>
                                    <p class="text-sm text-gray-400 truncate">Pop Artist #{{ $i }}</p>
                                </div>
                                <div
                                    class="inline-flex items-center text-xs font-medium rounded-full px-2 py-0.5 bg-blue-900 text-blue-200">
                                    <i class="ti ti-player-play mr-1"></i> {{ rand(1, 10) }}M
                                </div>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-lg h-full">
            <div class="border-b border-gray-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="ti ti-music mr-2 text-primary-500"></i>Hip Hop Hits
                </h3>
            </div>
            <div class="p-4">
                <ul class="divide-y divide-gray-700">
                    @for ($i = 1; $i <= 5; $i++)
                        <li class="py-3 transition-all duration-300 hover:bg-gray-700 hover:translate-x-2 rounded-lg px-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 text-gray-400">{{ $i }}</div>
                                <div class="flex-shrink-0 relative">
                                    <img src="https://picsum.photos/300/300?random={{ $i + 600 }}"
                                        class="w-10 h-10 rounded-md" alt="Hip Hop Song">
                                    <button
                                        class="absolute -bottom-1 -right-1 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-1 inline-flex items-center justify-center play-song-btn"
                                        data-song-title="Hip Hop Hit #{{ $i }}"
                                        data-artist-name="Hip Hop Artist #{{ $i }}"
                                        data-cover-image="https://picsum.photos/300/300?random={{ $i + 600 }}">
                                        <i class="ti ti-player-play text-xs"></i>
                                    </button>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-white truncate">Hip Hop Hit #{{ $i }}
                                    </p>
                                    <p class="text-sm text-gray-400 truncate">Hip Hop Artist #{{ $i }}</p>
                                </div>
                                <div
                                    class="inline-flex items-center text-xs font-medium rounded-full px-2 py-0.5 bg-blue-900 text-blue-200">
                                    <i class="ti ti-player-play mr-1"></i> {{ rand(1, 10) }}M
                                </div>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8 mb-12" data-aos="fade-up" data-aos-delay="700">
        <nav aria-label="Page navigation">
            <ul class="inline-flex -space-x-px">
                <li>
                    <a href="#"
                        class="px-3 py-2 ml-0 leading-tight text-gray-400 bg-gray-800 border border-gray-700 rounded-l-lg hover:bg-gray-700 hover:text-white">
                        <i class="ti ti-chevron-left"></i>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-white bg-primary-600 border border-primary-600 hover:bg-primary-700 hover:text-white">1</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white">2</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white">3</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white">4</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white">5</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 rounded-r-lg hover:bg-gray-700 hover:text-white">
                        <i class="ti ti-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection

@section('styles')
    <style>
        /* Pulse animation for trending badges */
        .bg-red-900 {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(220, 38, 38, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0);
            }
        }

        /* Fade in animation for new badges */
        .bg-green-900 {
            animation: fadeInOut 3s infinite;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0.7;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.7;
            }
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects for song rows
            const songRows = document.querySelectorAll('li');

            songRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    const btn = this.querySelector('.play-song-btn');
                    if (btn) {
                        btn.classList.add('scale-110');
                    }
                });

                row.addEventListener('mouseleave', function() {
                    const btn = this.querySelector('.play-song-btn');
                    if (btn) {
                        btn.classList.remove('scale-110');
                    }
                });
            });

            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!this.classList.contains('play-song-btn') || !this.hasAttribute(
                        'onclick')) {
                        const ripple = document.createElement('span');
                        ripple.classList.add('ripple');
                        this.appendChild(ripple);

                        const rect = this.getBoundingClientRect();
                        const size = Math.max(rect.width, rect.height);
                        const x = e.clientX - rect.left - size / 2;
                        const y = e.clientY - rect.top - size / 2;

                        ripple.style.width = ripple.style.height = `${size}px`;
                        ripple.style.left = `${x}px`;
                        ripple.style.top = `${y}px`;

                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
                    }
                });
            });

            // Add active class to filter buttons on click
            const filterButtons = document.querySelectorAll('.inline-flex button');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-primary-600', 'border-primary-600',
                            'text-white');
                        btn.classList.add('bg-gray-800', 'border-gray-600',
                        'text-gray-300');
                    });

                    this.classList.remove('bg-gray-800', 'border-gray-600', 'text-gray-300');
                    this.classList.add('bg-primary-600', 'border-primary-600', 'text-white');
                });
            });
        });
    </script>
@endsection
