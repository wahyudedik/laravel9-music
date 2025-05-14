@extends('layouts.landing-page')

@section('content')
    <!-- Artist Header Banner Section -->
    <div class="relative mb-6">
        <!-- Large Artist Cover/Banner Image -->
        <div class="relative h-64 md:h-80 w-full overflow-hidden rounded-xl">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-black/30"></div>
            <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=1500"
                class="w-full h-full object-cover" alt="Artist banner">

            <!-- Artist Info Overlay -->
            <div class="absolute bottom-0 left-0 p-6 flex flex-col md:flex-row items-start md:items-end gap-5 w-full">
                <!-- Artist Profile Image -->
                <div class="relative z-10">
                    <div
                        class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-[var(--color-bg-dark)] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=300"
                            class="w-full h-full object-cover" alt="Artist profile">
                    </div>
                </div>

                <!-- Artist Details -->
                <div class="flex-1">
                    <span class="bg-red-600/90 text-white text-xs px-2 py-1 rounded-full mb-2 inline-block">VERIFIED
                        ARTIST</span>
                    <h1 class="text-3xl md:text-5xl font-bold mb-1">Drake</h1>
                    <div class="flex items-center gap-3 text-sm text-gray-300 mb-3">
                        <span>{{ number_format(rand(15, 50)) }}M monthly listeners</span>
                        <span>•</span>
                        <span>{{ rand(50, 150) }} songs</span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 mt-4">
                        <button
                            class="bg-white/10 hover:bg-white/20 text-white font-medium py-2 px-6 rounded-full flex items-center gap-2 transition"
                            id="shareButton">
                            <i class="ti ti-share"></i> Share
                        </button>
                        <button
                            class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition">
                            <i class="ti ti-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Songs Section -->
    <section class="mb-10">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Popular</h2>
        </div>

        <div class="bg-[var(--color-bg-card)] rounded-xl p-3">
            <!-- Top Songs List -->
            @for ($i = 1; $i <= 6; $i++)
                <div class="flex items-center hover:bg-white/5 p-2 rounded-lg group transition-colors">
                    <div class="w-10 text-center text-gray-400 mr-3">{{ $i }}</div>
                    <div class="w-12 h-12 rounded overflow-hidden mr-3 relative group-hover:shadow-md transition-all">
                        <img src="https://picsum.photos/seed/{{ $i + 100 }}/300/300" class="w-full h-full object-cover"
                            alt="Song cover">
                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="ti ti-player-play text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium truncate">
                            {{ ['God\'s Plan', 'Hotline Bling', 'Started From the Bottom', 'In My Feelings', 'One Dance', 'Passionfruit'][$i - 1] }}
                        </div>
                        <div class="text-sm text-gray-400 truncate">
                            {{ number_format(rand(10, 800)) }}M plays
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <!-- Latest Albums Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Albums</h2>
        </div>

        <div class="scroll-container">
            @php
                $albums = [
                    'Certified Lover Boy',
                    'Scorpion',
                    'Views',
                    'Nothing Was the Same',
                    'Take Care',
                    'Thank Me Later',
                    'If You\'re Reading This It\'s Too Late',
                    'More Life',
                ];
                $years = ['2021', '2018', '2016', '2013', '2011', '2010', '2015', '2017'];
            @endphp

            @foreach ($albums as $index => $album)
                <div class="scroll-item" style="width: 180px;" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="https://picsum.photos/seed/album{{ $index + 200 }}/300/300" alt="{{ $album }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $album }}">{{ $album }}</h3>
                        <p class="text-sm text-gray-400 truncate">Album • {{ $years[$index % count($years)] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Singles & EPs Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Singles & EPs</h2>
        </div>

        <div class="scroll-container">
            @php
                $singles = [
                    'Toosie Slide',
                    'Life Is Good',
                    'Money in the Grave',
                    'Nice For What',
                    'God\'s Plan',
                    'Signs',
                    'Sneakin\'',
                    'Back to Back',
                ];
                $years = ['2020', '2020', '2019', '2018', '2018', '2017', '2016', '2015'];
            @endphp

            @foreach ($singles as $index => $single)
                <div class="scroll-item" style="width: 180px;" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="https://picsum.photos/seed/single{{ $index + 300 }}/300/300" alt="{{ $single }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $single }}">{{ $single }}</h3>
                        <p class="text-sm text-gray-400 truncate">Single • {{ $years[$index % count($years)] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Featured In Section -->
    <section class="mb-12">
        <div class="section-header flex items-center justify-between mb-5">
            <h2 class="section-title text-2xl font-bold">Featured In</h2>
        </div>

        <div class="scroll-container">
            @php
                $features = [
                    'Sicko Mode - Travis Scott',
                    'MIA - Bad Bunny',
                    'Walk It Talk It - Migos',
                    'No Stylist - French Montana',
                    'Yes Indeed - Lil Baby',
                    'Look Alive - BlocBoy JB',
                    'Going Bad - Meek Mill',
                    'Moment 4 Life - Nicki Minaj',
                ];
            @endphp

            @foreach ($features as $index => $feature)
                <div class="scroll-item" style="width: 180px;" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="relative group overflow-hidden rounded-xl">
                        <img src="https://picsum.photos/seed/feature{{ $index + 400 }}/300/300" alt="{{ $feature }}"
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <button class="play-song-btn absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                <i class="ti ti-player-play text-white text-xl"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h3 class="font-semibold text-base truncate" title="{{ $feature }}">{{ $feature }}
                        </h3>
                        <p class="text-sm text-gray-400 truncate">Featured</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Artist Bio Section -->
    <section class="mb-12">
        <div class="bg-[var(--color-bg-card)] rounded-xl p-6">
            <div class="section-header mb-4">
                <h2 class="section-title text-2xl font-bold">About</h2>
            </div>

            <div class="flex flex-col md:flex-row gap-6">
                <div class="flex-1">
                    <p class="text-gray-300 mb-4">
                        Aubrey Drake Graham (born October 24, 1986) is a Canadian rapper, singer, and actor. An influential
                        figure in contemporary popular music, Drake has been credited for popularizing singing and R&B
                        sensibilities in hip hop.
                    </p>
                    <p class="text-gray-300 mb-4">
                        He gained recognition by starring as Jimmy Brooks in the CTV teen drama series Degrassi: The Next
                        Generation (2001–08) and subsequently pursued a career in music releasing his debut mixtape Room for
                        Improvement in 2006.
                    </p>

                    <div class="flex items-center gap-4 mt-6">
                        <button class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Visit Instagram</span>
                            <i class="ti ti-brand-instagram text-2xl"></i>
                        </button>
                        <button class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Visit Twitter</span>
                            <i class="ti ti-brand-twitter text-2xl"></i>
                        </button>
                        <button class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Visit YouTube</span>
                            <i class="ti ti-brand-youtube text-2xl"></i>
                        </button>
                        <button class="text-gray-400 hover:text-white transition">
                            <span class="sr-only">Visit Website</span>
                            <i class="ti ti-world text-2xl"></i>
                        </button>
                    </div>
                </div>

                <div class="md:w-72">
                    <div class="bg-[var(--color-bg-hover)] p-4 rounded-lg">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <div class="text-3xl font-bold text-red-500">{{ number_format(rand(40, 80)) }}M</div>
                                <div class="text-sm text-gray-400">Monthly Listeners</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-red-500">{{ number_format(rand(5, 20)) }}B</div>
                                <div class="text-sm text-gray-400">Total Streams</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-red-500">{{ rand(5, 12) }}</div>
                                <div class="text-sm text-gray-400">Albums</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-red-500">{{ rand(60, 120) }}</div>
                                <div class="text-sm text-gray-400">Songs</div>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-700">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm">From</div>
                                <div class="font-medium">Toronto, Canada</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-sm">Active since</div>
                                <div class="font-medium">2006</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function initScrollItems() {
            document.querySelectorAll('.scroll-item').forEach((item, index) => {
                item.style.setProperty('--index', index);
            });
        }

        function initDragScroll(container) {
            let isDown = false;
            let startX;
            let scrollLeft;

            const onMouseDown = (e) => {
                isDown = true;
                container.style.cursor = 'grabbing';
                startX = e.pageX - container.offsetLeft;
                scrollLeft = container.scrollLeft;
            };

            const onMouseLeave = () => {
                isDown = false;
                container.style.cursor = 'grab';
            };

            const onMouseMove = (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - container.offsetLeft;
                const walk = (x - startX) * 2;
                container.scrollLeft = scrollLeft - walk;
            };

            const onWheel = (e) => {
                if (e.deltaY !== 0) {
                    e.preventDefault();
                    container.scrollLeft += e.deltaY;
                }
            };

            container.addEventListener('mousedown', onMouseDown);
            container.addEventListener('mouseleave', onMouseLeave);
            container.addEventListener('mouseup', onMouseLeave);
            container.addEventListener('mousemove', onMouseMove);
            container.addEventListener('wheel', onWheel);
        }

        function initShareModal() {
            const shareButton = document.getElementById('shareButton');
            const shareModal = document.getElementById('shareModal');
            const closeShareModal = document.getElementById('closeShareModal');

            if (!shareButton || !shareModal || !closeShareModal) return;

            const toggleModal = (show) => {
                shareModal.classList.toggle('hidden', !show);
                document.body.style.overflow = show ? 'hidden' : 'auto';
            };

            shareButton.addEventListener('click', () => toggleModal(true));
            closeShareModal.addEventListener('click', () => toggleModal(false));

            shareModal.addEventListener('click', (event) => {
                if (event.target === shareModal) toggleModal(false);
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !shareModal.classList.contains('hidden')) {
                    toggleModal(false);
                }
            });
        }

        function copyShareLink() {
            const linkInput = document.querySelector('#shareModal input[type="text"]');
            const copyButton = document.querySelector('#shareModal button:last-child');

            if (!linkInput || !copyButton) return;

            linkInput.select();
            document.execCommand('copy');

            const originalText = copyButton.textContent;
            copyButton.textContent = 'Copied!';

            setTimeout(() => {
                copyButton.textContent = originalText;
            }, 2000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            initScrollItems();
            document.querySelectorAll('.scroll-container').forEach(initDragScroll);
            initShareModal();
        });
    </script>
@endsection
