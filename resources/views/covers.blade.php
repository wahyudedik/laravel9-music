@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Cover Populer</h2>
            <div class="text-gray-400">Temukan semua cover lagu terbaik dari berbagai artis cover</div>
        </div>
    </div>

    <!-- Filter Chips -->
    <div class="flex flex-wrap items-center gap-2 mb-6" data-aos="fade-up" data-aos-delay="100">
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

    <!-- Covers Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-10" data-aos="fade-up" data-aos-delay="200">
        @for ($i = 1; $i <= 32; $i++)
            <div class="group" data-aos="fade-up" data-aos-delay="{{ 200 + $i * 25 }}">
                <div
                    class="bg-gray-800 rounded-lg overflow-hidden transition-all duration-300 hover:bg-gray-700 hover:shadow-xl hover:-translate-y-2 h-full">
                    <div class="relative">
                        <img src="https://picsum.photos/300/300?random={{ $i + 400 }}"
                            class="w-full h-auto aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            alt="Cover Art">
                        <button
                            class="absolute bottom-2 right-2 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-800 font-medium rounded-full p-2 inline-flex items-center justify-center play-song-btn"
                            data-song-title="Cover Lagu #{{ $i }}"
                            data-artist-name="Cover Artist {{ rand(1, 20) }}"
                            data-cover-image="https://picsum.photos/300/300?random={{ $i + 400 }}">
                            <i class="ti ti-player-play"></i>
                        </button>
                        @guest
                            <span
                                class="absolute top-2 right-2 inline-flex items-center justify-center p-1.5 text-xs font-bold leading-none text-white bg-gray-900 rounded-full">
                                <i class="ti ti-lock"></i>
                            </span>
                        @endguest
                    </div>
                    <div class="p-4">
                        <h5 class="text-md font-semibold text-white mb-1 truncate">Cover Lagu #{{ $i }}</h5>
                        <p class="text-gray-400 text-sm mb-2 truncate">Oleh: Cover Artist {{ rand(1, 20) }}</p>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-900 text-blue-200">
                                <i class="ti ti-player-play mr-1"></i> {{ rand(100, 999) }}K
                            </span>
                            <span
                                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-red-900 text-red-200">
                                <i class="ti ti-heart mr-1"></i> {{ rand(10, 99) }}K
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Featured Cover Artists Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg mb-10" data-aos="fade-up" data-aos-delay="300">
        <div class="border-b border-gray-700 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="ti ti-microphone mr-2 text-primary-500"></i>Artis Cover Terbaik
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ 300 + $i * 50 }}">
                        <div class="text-center">
                            <div class="relative inline-block">
                                <img src="https://picsum.photos/300/300?random={{ $i + 500 }}"
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
                            <h4 class="text-lg font-semibold text-white mb-1">Cover Artist #{{ $i }}</h4>
                            <p class="text-gray-400 mb-2">{{ rand(10, 100) }} cover lagu</p>
                            <div class="flex justify-center gap-2 mb-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900 text-purple-200">
                                    <i class="ti ti-users mr-1"></i> {{ rand(100, 500) }}K
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                    <i class="ti ti-player-play mr-1"></i> {{ rand(1, 50) }}M
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
            // Add hover effects for cover cards
            const coverCards = document.querySelectorAll('.group');

            coverCards.forEach(card => {
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
        });
    </script>
@endsection
