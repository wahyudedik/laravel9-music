@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Artis Populer</h2>
            <div class="text-gray-400">Temukan semua artis populer dengan karya-karya terbaik mereka</div>
        </div>
    </div>

    <!-- Filter Chips -->
    <div class="flex flex-wrap items-center gap-2 mb-6" data-aos="fade-up" data-aos-delay="100">
        <div class="inline-flex rounded-md shadow-sm">
            <button type="button"
                class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-primary-600 rounded-l-lg hover:bg-primary-700 focus:z-10 focus:ring-2 focus:ring-primary-500 focus:text-white">
                Semua Genre
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

    <!-- Featured Artists Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg mb-10" data-aos="fade-up" data-aos-delay="200">
        <div class="border-b border-gray-700 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="ti ti-crown mr-2 text-primary-500"></i>Artis Teratas
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ 200 + $i * 50 }}">
                        <div class="text-center">
                            <div class="relative inline-block">
                                <img src="https://picsum.photos/300/300?random={{ $i + 50 }}"
                                    class="w-40 h-40 rounded-full mx-auto mb-4 object-cover transition-all duration-300 group-hover:shadow-lg group-hover:shadow-primary-900/30"
                                    alt="Artist">
                                <div
                                    class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <a href="#"
                                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-2 inline-flex items-center justify-center">
                                        <i class="ti ti-player-play"></i>
                                    </a>
                                </div>
                            </div>
                            <h4 class="text-xl font-bold text-white mb-1">Top Artist #{{ $i }}</h4>
                            <p class="text-gray-300 mb-3">{{ rand(20, 100) }} Lagu • {{ rand(5, 20) }}M Penggemar</p>
                            <div class="flex justify-center gap-2 mb-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900 text-purple-200">
                                    <i class="ti ti-users mr-1"></i> {{ rand(5, 20) }}M
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                    <i class="ti ti-player-play mr-1"></i> {{ rand(100, 999) }}M
                                </span>
                            </div>
                            <a href="#"
                                class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center transition-all duration-300 group-hover:shadow-lg group-hover:shadow-primary-900/30">
                                <i class="ti ti-user mr-1"></i> Lihat Profil
                            </a>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Artists Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10" data-aos="fade-up"
        data-aos-delay="300">
        @for ($i = 1; $i <= 24; $i++)
            <div class="group" data-aos="fade-up" data-aos-delay="{{ 300 + $i * 25 }}">
                <div
                    class="bg-gray-800 rounded-lg p-6 text-center transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2">
                    <div class="relative inline-block">
                        <img src="https://picsum.photos/300/300?random={{ $i + 100 }}"
                            class="w-32 h-32 rounded-full mx-auto mb-4 object-cover transition-all duration-300 group-hover:shadow-lg"
                            alt="Artist">
                        <div
                            class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <a href="#"
                                class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-2 inline-flex items-center justify-center">
                                <i class="ti ti-player-play"></i>
                            </a>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-1">Artis Populer #{{ $i }}</h4>
                    <p class="text-gray-400 mb-3">{{ rand(5, 30) }} Lagu • {{ rand(1, 10) }}M Penggemar</p>
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

    <!-- Pagination -->
    <div class="flex justify-center mt-8 mb-12" data-aos="fade-up" data-aos-delay="500">
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
        .badge {
            transition: all 0.2s ease;
        }

        .badge:hover {
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
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects for artist cards
            const artistCards = document.querySelectorAll('.group');

            artistCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const btn = this.querySelector('.bg-primary-600');
                    if (btn) {
                        btn.classList.add('btn-pulse');
                    }
                });

                card.addEventListener('mouseleave', function() {
                    const btn = this.querySelector('.bg-primary-600');
                    if (btn) {
                        btn.classList.remove('btn-pulse');
                    }
                });
            });

            // Add animation for badges
            const badges = document.querySelectorAll('.inline-flex');
            badges.forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1)';
                });

                badge.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
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
                    this.innerHTML =
                        `<i class="ti ti-check mr-2 text-primary-500"></i>${this.textContent}`;

                    document.getElementById('sortDropdownButton').innerHTML =
                        `<i class="ti ti-sort-ascending mr-2"></i>${this.textContent.trim()}<i class="ti ti-chevron-down ml-2"></i>`;
                });
            });
        });
    </script>
@endsection
