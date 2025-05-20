@extends('layouts.landing-page')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6" data-aos="fade-up">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Your Playlists</h2>
            <div class="text-gray-400">Create and manage your personal playlists</div>
        </div>
        <div>
            <button id="createPlaylistBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full flex items-center gap-2 transition-colors">
                <i class="ti ti-plus"></i> Create Playlist
            </button>
        </div>
    </div>

    <!-- Playlists Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5 mb-10">
        <!-- My Liked Songs (Special Playlist) -->
        <div class="bg-gradient-to-br from-purple-900 to-blue-900 rounded-xl overflow-hidden relative group" data-aos="fade-up">
            <div class="p-5 h-40 flex flex-col justify-end">
                <div class="text-lg font-bold mb-1">Liked Songs</div>
                <div class="text-sm text-white/80 mb-4">{{ rand(25, 120) }} songs</div>
                <div class="absolute bottom-0 right-0 p-4">
                    <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg hover:bg-red-700 hover:scale-105">
                        <i class="ti ti-player-play text-white"></i>
                    </button>
                </div>
            </div>
        </div>

        @for ($i = 1; $i <= 9; $i++)
            <a href="{{ route('playlist.detail', $i) }}" class="block">
                <div class="bg-[var(--color-bg-card)] rounded-xl overflow-hidden relative group" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <div class="relative">
                        <img src="https://picsum.photos/seed/playlist{{ $i }}/300/300" alt="Playlist {{ $i }}" 
                            class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="absolute bottom-3 right-3">
                                <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:bg-red-700 hover:scale-105">
                                    <i class="ti ti-player-play text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-white">Playlist {{ $i }}</h3>
                        <p class="text-sm text-gray-400 mt-1">{{ rand(5, 30) }} songs</p>
                    </div>
                </div>
            </a>
        @endfor
    </div>

    <!-- Create Playlist Modal -->
    <div id="createPlaylistModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-gray-800 rounded-xl w-full max-w-md p-6 relative">
                <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                    <i class="ti ti-x text-xl"></i>
                </button>
                
                <h3 class="text-xl font-bold mb-4">Create New Playlist</h3>
                
                <form>
                    <div class="mb-4">
                        <label for="playlistName" class="block text-sm font-medium text-gray-300 mb-2">Playlist Name</label>
                        <input type="text" id="playlistName" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Enter playlist name">
                    </div>
                    
                    <div class="mb-5">
                        <label for="playlistDescription" class="block text-sm font-medium text-gray-300 mb-2">Description (optional)</label>
                        <textarea id="playlistDescription" rows="3" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Add an optional description"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Privacy</label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="privacy" value="public" class="mr-2 text-red-600 focus:ring-red-500">
                                <span>Public</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="privacy" value="private" checked class="mr-2 text-red-600 focus:ring-red-500">
                                <span>Private</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button type="button" id="cancelBtn" class="px-4 py-2 bg-transparent border border-gray-600 rounded-lg text-white hover:bg-gray-700">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 rounded-lg text-white hover:bg-red-700">
                            Create Playlist
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set animation delay for scroll items
            document.querySelectorAll('.scroll-item').forEach((item, index) => {
                item.style.setProperty('--index', index);
            });

            // Smooth drag scrolling for horizontal containers
            const sliders = document.querySelectorAll('.scroll-container');

            sliders.forEach(container => {
                container.addEventListener('wheel', (e) => {
                    if (e.deltaY !== 0) {
                        e.preventDefault();
                        container.scrollLeft += e.deltaY;
                    }
                });
            });

            // Modal functionality
            const modal = document.getElementById('createPlaylistModal');
            const openModalBtn = document.getElementById('createPlaylistBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelBtn = document.getElementById('cancelBtn');

            function openModal() {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeModal() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            openModalBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        });
    </script>
@endsection
