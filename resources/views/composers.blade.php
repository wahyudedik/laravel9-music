@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Pencipta Lagu</h2>
            <div class="text-gray-400">Temukan semua pencipta lagu terbaik dengan karya-karya mereka</div>
        </div>
    </div>

    <!-- Filter Chips -->
    <div class="flex flex-wrap items-center gap-2 mb-6" data-aos="fade-up" data-aos-delay="100">
        <div class="inline-flex rounded-md shadow-sm">
            <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-primary-600 rounded-l-lg hover:bg-primary-700 focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Semua Genre
            </button>
            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-t border-b border-gray-600 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Pop
            </button>
            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-t border-b border-gray-600 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Rock
            </button>
            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-t border-b border-gray-600 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Hip Hop
            </button>
            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-t border-b border-gray-600 hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                R&B
            </button>
            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800 border-r border-t border-b border-gray-600 rounded-r-lg hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Electronic
            </button>
        </div>
    </div>

    <!-- Featured Composers Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg mb-10" data-aos="fade-up" data-aos-delay="200">
        <div class="border-b border-gray-700 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="ti ti-award mr-2 text-primary-500"></i>Pencipta Lagu Terbaik
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ 200 + $i * 50 }}">
                        <div class="text-center">
                            <div class="relative inline-block">
                                <img src="https://picsum.photos/300/300?random={{ $i + 500 }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover transition-all duration-300 group-hover:shadow-lg" alt="Composer">
                                <div class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <a href="#" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-2 inline-flex items-center justify-center">
                                        <i class="ti ti-player-play"></i>
                                    </a>
                                </div>
                            </div>
                            <h4 class="text-lg font-semibold text-white mb-1">Pencipta Terbaik #{{ $i }}</h4>
                            <p class="text-gray-400 mb-2">{{ rand(50, 200) }} karya • {{ rand(500, 900) }}K Penggemar</p>
                            <div class="flex justify-center gap-2 mb-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                    <i class="ti ti-player-play mr-1"></i> {{ rand(50, 200) }}M
                                </span>
                            </div>
                            <a href="#" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center">
                                <i class="ti ti-user mr-1"></i> Lihat Profil
                            </a>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Composers Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10" data-aos="fade-up" data-aos-delay="300">
        @for ($i = 1; $i <= 32; $i++)
            <div class="group" data-aos="fade-up" data-aos-delay="{{ 300 + $i * 25 }}">
                <div class="bg-gray-800 rounded-lg p-6 text-center transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2 h-full">
                    <div class="relative inline-block">
                        <img src="https://picsum.photos/300/300?random={{ $i + 400 }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover transition-all duration-300 group-hover:shadow-lg" alt="Composer">
                        <div class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <a href="#" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-2 inline-flex items-center justify-center">
                                <i class="ti ti-player-play"></i>
                            </a>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-1">Pencipta Lagu #{{ $i }}</h4>
                    <p class="text-gray-400 mb-2">{{ rand(20, 100) }} karya • {{ rand(100, 900) }}K Penggemar</p>
                    <div class="flex justify-center gap-2 mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                            <i class="ti ti-music mr-1"></i> {{ rand(20, 100) }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-200">
                            <i class="ti ti-microphone mr-1"></i> {{ rand(5, 50) }} Dicover
                        </span>
                    </div>
                    <a href="#" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center">
                        <i class="ti ti-user mr-1"></i> Lihat Profil
                    </a>
                </div>
            </div>
        @endfor
    </div>

    <!-- Composer Spotlight Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg mb-10" data-aos="fade-up" data-aos-delay="500">
        <div class="border-b border-gray-700 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="ti ti-spotlight mr-2 text-primary-500"></i>Sorotan Pencipta Lagu
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div data-aos="fade-right" data-aos-delay="550">
                    <div class="relative rounded-lg overflow-hidden">
                        <img src="https://picsum.photos/800/450?random=777" class="w-full h-auto rounded-lg" alt="Composer Spotlight">
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-gray-900 to-transparent">
                            <h4 class="text-white text-xl font-bold mb-1">Pencipta Lagu Legendaris</h4>
                            <p class="text-gray-300 mb-0">Mengenal lebih dekat dengan karya-karya terbaik</p>
                        </div>
                        <span class="absolute top-3 right-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-600 text-white">
                            <i class="ti ti-star mr-1"></i> Spesial
                        </span>
                    </div>
                </div>
                <div data-aos="fade-left" data-aos-delay="600">
                    <h4 class="text-xl font-bold text-white mb-3">Perjalanan Karir Pencipta Lagu</h4>
                    <p class="text-gray-400 mb-4">Pencipta lagu adalah sosok penting di balik lagu-lagu hits yang kita nikmati. Mereka menuangkan ide, emosi, dan pengalaman hidup ke dalam lirik dan melodi yang menyentuh hati pendengar.</p>

                    <div class="flex gap-2 mb-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                            <i class="ti ti-music mr-1"></i> 500+ Karya
                        </span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-900 text-green-200">
                            <i class="ti ti-award mr-1"></i> 50+ Penghargaan
                        </span>
                    </div>

                    <div class="flex gap-2">
                        <a href="#" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                            <i class="ti ti-user mr-1"></i> Lihat Profil
                        </a>
                        <a href="#" class="text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:ring-gray-600 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                            <i class="ti ti-playlist mr-1"></i> Lihat Karya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Composer Categories Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10" data-aos="fade-up" data-aos-delay="600">
        <div class="bg-gray-800 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="650">
            <div class="border-b border-gray-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="ti ti-star mr-2 text-primary-500"></i>Pencipta Legendaris
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="flex items-center space-x-4 hover:bg-gray-700 p-2 rounded-lg transition-all duration-300">
                            <img src="https://picsum.photos/300/300?random={{ $i + 700 }}" class="w-12 h-12 rounded-full" alt="Legendary Composer">
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-medium truncate">Pencipta Legendaris #{{ $i }}</p>
                                <p class="text-gray-400 text-sm truncate">{{ rand(100, 500) }}+ karya hits</p>
                            </div>
                            <a href="#" class="text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:ring-gray-600 font-medium rounded-lg text-xs px-3 py-1.5 inline-flex items-center">
                                <i class="ti ti-user mr-1"></i> Profil
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="700">
            <div class="border-b border-gray-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="ti ti-trending-up mr-2 text-primary-500"></i>Pencipta Trending
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="flex items-center space-x-4 hover:bg-gray-700 p-2 rounded-lg transition-all duration-300">
                            <img src="https://picsum.photos/300/300?random={{ $i + 800 }}" class="w-12 h-12 rounded-full" alt="Trending Composer">
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-medium truncate">Pencipta Trending #{{ $i }}</p>
                                <p class="text-gray-400 text-sm truncate">{{ rand(5, 20) }} lagu hits baru</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-200">
                                <i class="ti ti-arrow-up mr-1"></i> {{ rand(10, 50) }}%
                            </span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="750">
            <div class="border-b border-gray-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="ti ti-users mr-2 text-primary-500"></i>Pencipta Baru
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="flex items-center space-x-4 hover:bg-gray-700 p-2 rounded-lg transition-all duration-300">
                            <img src="https://picsum.photos/300/300?random={{ $i + 900 }}" class="w-12 h-12 rounded-full" alt="New Composer">
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-medium truncate">Pencipta Baru #{{ $i }}</p>
                                <p class="text-gray-400 text-sm truncate">{{ rand(1, 10) }} karya pertama</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                <i class="ti ti-star mr-1"></i> Baru
                            </span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8 mb-12" data-aos="fade-up" data-aos-delay="800">
        <nav aria-label="Page navigation">
            <ul class="inline-flex -space-x-px">
                <li>
                    <a href="#" class="px-3 py-2 ml-0 leading-tight text-gray-400 bg-gray-800 border border-gray-700 rounded-l-lg hover:bg-gray-700 hover:text-white">
                        <i class="ti ti-chevron-left"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="px-3 py-2 leading-tight text-white bg-primary-600 border border-primary-600 hover:bg-primary-700 hover:text-white">1</a>
                </li>
                <li>
                    <a href="#" class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white">2</a>
                </li>
                <li>
                    <a href="#" class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white">3</a>
                </li>
                <li>
                    <a href="#" class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white">4</a>
                </li>
                <li>
                    <a href="#" class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 hover:bg-gray-700 hover:text-white">5</a>
                </li>
                <li>
                    <a href="#" class="px-3 py-2 leading-tight text-gray-400 bg-gray-800 border border-gray-700 rounded-r-lg hover:bg-gray-700 hover:text-white">
                        <i class="ti ti-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Become a Composer Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg mb-10" data-aos="fade-up" data-aos-delay="900">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <div data-aos="fade-right" data-aos-delay="950">
                    <h4 class="text-2xl font-bold text-white mb-3">Ingin Menjadi Pencipta Lagu?</h4>
                                        <p class="text-gray-400 mb-4">Bagikan karya musik Anda dengan dunia. Daftar sebagai pencipta lagu dan mulai perjalanan musik Anda bersama kami. Dapatkan royalti dari karya Anda yang digunakan oleh artis lain.</p>

                    <div class="flex gap-2 mb-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                            <i class="ti ti-coin mr-1"></i> Dapatkan Royalti
                        </span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-900 text-green-200">
                            <i class="ti ti-copyright mr-1"></i> Lindungi Karya Anda
                        </span>
                    </div>

                    <div class="flex gap-2">
                        <a href="#" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                            <i class="ti ti-user-plus mr-1"></i> Daftar Sekarang
                        </a>
                        <a href="#" class="text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:ring-gray-600 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                            <i class="ti ti-info-circle mr-1"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div data-aos="fade-left" data-aos-delay="1000">
                    <img src="https://picsum.photos/600/400?random=999" class="rounded-lg shadow-lg" alt="Become a Composer">
                </div>
            </div>
        </div>
    </div>

    <!-- Composer Resources Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg mb-10" data-aos="fade-up" data-aos-delay="1050">
        <div class="border-b border-gray-700 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="ti ti-book mr-2 text-primary-500"></i>Sumber Daya untuk Pencipta Lagu
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-700 rounded-lg p-6" data-aos="fade-up" data-aos-delay="1100">
                    <div class="text-primary-500 text-3xl mb-4">
                        <i class="ti ti-music"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-2">Panduan Menulis Lagu</h4>
                    <p class="text-gray-400 mb-4">Pelajari teknik dan tips menulis lirik dan melodi yang menarik untuk berbagai genre musik.</p>
                    <a href="#" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                        Baca Selengkapnya
                        <i class="ti ti-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="bg-gray-700 rounded-lg p-6" data-aos="fade-up" data-aos-delay="1150">
                    <div class="text-primary-500 text-3xl mb-4">
                        <i class="ti ti-copyright"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-2">Hak Cipta & Royalti</h4>
                    <p class="text-gray-400 mb-4">Informasi lengkap tentang cara melindungi karya Anda dan mendapatkan royalti dari penggunaan musik.</p>
                    <a href="#" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                        Baca Selengkapnya
                        <i class="ti ti-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="bg-gray-700 rounded-lg p-6" data-aos="fade-up" data-aos-delay="1200">
                    <div class="text-primary-500 text-3xl mb-4">
                        <i class="ti ti-users"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-2">Komunitas Pencipta</h4>
                    <p class="text-gray-400 mb-4">Bergabung dengan komunitas pencipta lagu untuk berbagi pengalaman, mendapatkan umpan balik, dan berkolaborasi.</p>
                    <a href="#" class="text-primary-500 hover:text-primary-400 inline-flex items-center">
                        Bergabung Sekarang
                        <i class="ti ti-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Card hover effects */
        .group:hover .play-song-btn {
            transform: scale(1.1);
            opacity: 1;
        }
        
        .play-song-btn {
            opacity: 0.9;
            transition: all 0.3s ease;
        }
        
        /* Badge animations */
        .inline-flex {
            transition: all 0.2s ease;
        }
        
        .inline-flex:hover {
            transform: scale(1.1);
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
        
        /* Pulse animation for primary buttons */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(79, 70, 229, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0);
            }
        }
        
        .btn-pulse {
            animation: pulse 2s infinite;
        }
        
        /* Fade in animation for badges */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .badge-animated {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects for composer cards
            const composerCards = document.querySelectorAll('.group');

            composerCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const btn = this.querySelector('.play-song-btn');
                    if (btn) {
                        btn.style.opacity = '1';
                        btn.style.transform = 'scale(1.15)';
                    }
                });

                card.addEventListener('mouseleave', function() {
                    const btn = this.querySelector('.play-song-btn');
                    if (btn) {
                        btn.style.opacity = '0.9';
                        btn.style.transform = 'scale(1)';
                    }
                });
            });

            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!this.classList.contains('play-song-btn') || !this.hasAttribute('onclick')) {
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

            // Animate badges on scroll
            const animateBadges = () => {
                const badges = document.querySelectorAll('.inline-flex:not(.badge-animated)');
                badges.forEach((badge, index) => {
                    const rect = badge.getBoundingClientRect();
                    if (rect.top < window.innerHeight) {
                        setTimeout(() => {
                            badge.classList.add('badge-animated');
                        }, index * 50);
                    }
                });
            };

            // Call animation when page is loaded
            animateBadges();

            // Call animation on scroll
            window.addEventListener('scroll', animateBadges);

            // Add active class to filter buttons on click
            const filterButtons = document.querySelectorAll('.inline-flex button');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-primary-600', 'border-primary-600', 'text-white');
                        btn.classList.add('bg-gray-800', 'border-gray-600', 'text-gray-300');
                    });
                    
                    this.classList.remove('bg-gray-800', 'border-gray-600', 'text-gray-300');
                    this.classList.add('bg-primary-600', 'border-primary-600', 'text-white');
                });
            });

            // Add active class to sort dropdown items
            const sortItems = document.querySelectorAll('#sortDropdown a');
            sortItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    sortItems.forEach(i => {
                        i.classList.remove('active');
                        i.innerHTML = i.textContent;
                    });
                    
                    this.classList.add('active');
                    this.innerHTML = `<i class="ti ti-check mr-2 text-primary-500"></i>${this.textContent}`;
                    
                    document.getElementById('sortDropdownButton').innerHTML = `<i class="ti ti-sort-ascending mr-2"></i>${this.textContent.trim()}<i class="ti ti-chevron-down ml-2"></i>`;
                });
            });
            
            // Initialize accordion functionality
            const accordionButtons = document.querySelectorAll('[data-accordion-target]');
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-accordion-target');
                    const target = document.querySelector(targetId);
                    
                    if (target.classList.contains('hidden')) {
                        target.classList.remove('hidden');
                        this.setAttribute('aria-expanded', 'true');
                        this.querySelector('.ti-chevron-down').classList.add('rotate-180');
                    } else {
                        target.classList.add('hidden');
                        this.setAttribute('aria-expanded', 'false');
                        this.querySelector('.ti-chevron-down').classList.remove('rotate-180');
                    }
                });
            });
            
            // Add pulse effect to primary buttons on hover
            const primaryButtons = document.querySelectorAll('.bg-primary-600');
            primaryButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.classList.add('btn-pulse');
                });
                
                button.addEventListener('mouseleave', function() {
                    this.classList.remove('btn-pulse');
                });
            });
            
            // Table row hover effect
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    const badges = this.querySelectorAll('.inline-flex');
                    badges.forEach(badge => {
                        badge.classList.add('scale-110');
                    });
                });
                
                row.addEventListener('mouseleave', function() {
                    const badges = this.querySelectorAll('.inline-flex');
                    badges.forEach(badge => {
                        badge.classList.remove('scale-110');
                    });
                });
            });
            
            // Initialize dropdowns
            const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');
            dropdownButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-dropdown-toggle');
                    const target = document.getElementById(targetId);
                    
                    if (target.classList.contains('hidden')) {
                        // Close all other dropdowns first
                        document.querySelectorAll('[id^="compositionActionDropdown"]').forEach(dropdown => {
                            if (dropdown.id !== targetId) {
                                dropdown.classList.add('hidden');
                            }
                        });
                        
                        target.classList.remove('hidden');
                        
                        // Position the dropdown
                        const buttonRect = this.getBoundingClientRect();
                        target.style.position = 'absolute';
                        target.style.top = `${buttonRect.bottom + window.scrollY + 5}px`;
                        target.style.left = `${buttonRect.left + window.scrollX - target.offsetWidth + buttonRect.width}px`;
                        
                        // Close dropdown when clicking outside
                        const closeDropdown = function(e) {
                            if (!target.contains(e.target) && e.target !== button) {
                                target.classList.add('hidden');
                                document.removeEventListener('click', closeDropdown);
                            }
                        };
                        
                        setTimeout(() => {
                            document.addEventListener('click', closeDropdown);
                        }, 100);
                    } else {
                        target.classList.add('hidden');
                    }
                });
            });
            
            // Lazy load images
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('opacity-0');
                            observer.unobserve(img);
                        }
                    });
                });
                
                lazyImages.forEach(img => {
                    imageObserver.observe(img);
                });
            } else {
                // Fallback for browsers without IntersectionObserver support
                lazyImages.forEach(img => {
                    img.src = img.dataset.src;
                    img.classList.remove('opacity-0');
                });
            }
        });
    </script>
@endsection



