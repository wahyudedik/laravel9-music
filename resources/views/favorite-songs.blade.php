@extends('layouts.landing-page')

@section('styles')
<style>
    .favorite-song-card {
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }
    
    .favorite-song-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    .song-actions {
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    
    .favorite-song-card:hover .song-actions {
        opacity: 1;
    }
    
    .favorite-header {
        background: linear-gradient(to bottom, rgba(29, 185, 84, 0.8), rgba(29, 185, 84, 0.4), transparent);
        border-radius: 12px;
    }
    
    .song-number {
        width: 24px;
        text-align: right;
    }
    
    .empty-state {
        min-height: 400px;
    }
    
    /* Grid view styles */
    .grid-view-item {
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }
    
    .grid-view-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    /* Active view button styles */
    .view-btn.active {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4">
    <!-- Header Section -->
    <div class="favorite-header p-8 mb-8" data-aos="fade-up">
        <div class="flex flex-col md:flex-row items-center">
            <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                <div class="w-48 h-48 bg-gradient-to-br from-red-500 to-red-700 rounded-lg shadow-lg flex items-center justify-center">
                    <i class="ti ti-heart text-white text-6xl"></i>
                </div>
            </div>
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Lagu Favorit</h1>
                <p class="text-gray-300 mb-4">Koleksi lagu-lagu yang Anda sukai</p>
                <div class="flex items-center text-sm text-gray-400">
                    <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
                    <span class="mx-2">•</span>
                    <span id="songCount">{{ rand(5, 25) }} lagu</span>
                    <span class="mx-2">•</span>
                    <span>{{ rand(1, 3) }} jam {{ rand(10, 59) }} menit</span>
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex flex-wrap gap-3">
            <button class="btn-spotify rounded-full px-8 py-3 flex items-center gap-2 font-medium">
                <i class="ti ti-player-play"></i> Putar Semua
            </button>
            <button class="bg-gray-800 hover:bg-gray-700 text-white rounded-full px-4 py-3 flex items-center gap-2">
                <i class="ti ti-playlist-add"></i> Tambah ke Playlist
            </button>
            <button class="bg-gray-800 hover:bg-gray-700 text-white rounded-full px-4 py-3 flex items-center gap-2">
                <i class="ti ti-share"></i> Bagikan
            </button>
        </div>
    </div>
    
    <!-- Filter and Sort Section -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4" data-aos="fade-up">
        <div class="relative w-full md:w-64">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="ti ti-search text-gray-400"></i>
            </div>
            <input type="text" id="search-input" class="bg-gray-800 border border-gray-700 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5" placeholder="Cari di lagu favorit">
        </div>
        
        <div class="flex items-center gap-3 w-full md:w-auto">
            <select id="sort-select" class="bg-gray-800 border border-gray-700 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5">
                <option value="recent">Baru Ditambahkan</option>
                <option value="title">Judul (A-Z)</option>
                <option value="artist">Artis (A-Z)</option>
                <option value="album">Album (A-Z)</option>
                <option value="duration">Durasi</option>
            </select>
            
            <button id="grid-view-btn" class="view-btn p-2.5 text-white bg-gray-800 rounded-lg border border-gray-700 hover:bg-gray-700 active">
                <i class="ti ti-layout-grid"></i>
            </button>
            
            <button id="list-view-btn" class="view-btn p-2.5 text-white bg-gray-800 rounded-lg border border-gray-700 hover:bg-gray-700">
                <i class="ti ti-layout-list"></i>
            </button>
        </div>
    </div>
    
    <!-- Songs List View -->
    <div id="list-view" class="bg-gray-900 rounded-xl p-4 hidden" data-aos="fade-up">
        <table class="w-full text-sm text-left text-gray-400">
            <thead class="text-xs uppercase text-gray-400 border-b border-gray-800">
                <tr>
                    <th scope="col" class="px-4 py-3 w-12">#</th>
                    <th scope="col" class="px-4 py-3">Judul</th>
                    <th scope="col" class="px-4 py-3 hidden md:table-cell">Album</th>
                    <th scope="col" class="px-4 py-3 hidden lg:table-cell">Tanggal Ditambahkan</th>
                    <th scope="col" class="px-4 py-3 text-right"><i class="ti ti-clock"></i></th>
                    <th scope="col" class="px-4 py-3 w-10"></th>
                </tr>
            </thead>
            <tbody>
                @for($i = 1; $i <= rand(5, 15); $i++)
                    <tr class="favorite-song-card hover:bg-gray-800">
                        <td class="px-4 py-3 song-number">{{ $i }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded mr-3" src="https://picsum.photos/seed/song{{ $i }}/200/200" alt="Album cover">
                                <div>
                                    <div class="text-white font-medium">{{ ['Selamanya', 'Bintang Kehidupan', 'Aku Milikmu', 'Cinta Tak Terbatas', 'Semua Tentang Kita', 'Kau Adalah', 'Bukan Rayuan Gombal', 'Separuh Aku', 'Laskar Pelangi', 'Dia'][$i % 10] }}</div>
                                    <div class="text-sm">{{ ['Raisa', 'Nike Ardilla', 'Dewa 19', 'Samsons', 'Peterpan', 'Isyana Sarasvati', 'Judika', 'Noah', 'Nidji', 'Anji'][$i % 10] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 hidden md:table-cell">{{ ['Handmade', 'Bintang Kehidupan', 'Republik Cinta', 'Samsons', 'Taman Langit', 'Lexicon', 'Judika', 'Second Chance', 'Liberty', 'Dia'][$i % 10] }}</td>
                        <td class="px-4 py-3 hidden lg:table-cell">{{ now()->subDays(rand(1, 60))->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-right">{{ rand(2, 5) }}:{{ sprintf('%02d', rand(0, 59)) }}</td>
                        <td class="px-4 py-3">
                            <div class="song-actions flex justify-end">
                                <button class="text-gray-400 hover:text-white p-1" title="Hapus dari favorit">
                                    <i class="ti ti-heart-filled"></i>
                                </button>
                                <button class="text-gray-400 hover:text-white p-1" title="Tambah ke playlist">
                                    <i class="ti ti-playlist-add"></i>
                                </button>
                                <button class="text-gray-400 hover:text-white p-1" title="Opsi lainnya">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    
    <!-- Songs Grid View -->
    <div id="grid-view" class="bg-gray-900 rounded-xl p-4" data-aos="fade-up">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @for($i = 1; $i <= rand(5, 15); $i++)
                <div class="grid-view-item bg-gray-800 rounded-lg p-4">
                    <div class="relative mb-3">
                        <img src="https://picsum.photos/seed/song{{ $i }}/200/200" alt="Album cover" class="w-full aspect-square object-cover rounded-md">
                        <button class="play-song-btn absolute bottom-2 right-2 bg-primary-600 hover:bg-primary-500 rounded-full p-2.5 shadow-lg"
                                data-song-title="{{ ['Selamanya', 'Bintang Kehidupan', 'Aku Milikmu', 'Cinta Tak Terbatas', 'Semua Tentang Kita', 'Kau Adalah', 'Bukan Rayuan Gombal', 'Separuh Aku', 'Laskar Pelangi', 'Dia'][$i % 10] }}"
                                data-artist-name="{{ ['Raisa', 'Nike Ardilla', 'Dewa 19', 'Samsons', 'Peterpan', 'Isyana Sarasvati', 'Judika', 'Noah', 'Nidji', 'Anji'][$i % 10] }}"
                                data-cover-image="https://picsum.photos/seed/song{{ $i }}/200/200">
                            <i class="ti ti-player-play text-white"></i>
                        </button>
                    </div>
                    <h3 class="text-white font-medium truncate">{{ ['Selamanya', 'Bintang Kehidupan', 'Aku Milikmu', 'Cinta Tak Terbatas', 'Semua Tentang Kita', 'Kau Adalah', 'Bukan Rayuan Gombal', 'Separuh Aku', 'Laskar Pelangi', 'Dia'][$i % 10] }}</h3>
                    <p class="text-gray-400 text-sm truncate">{{ ['Raisa', 'Nike Ardilla', 'Dewa 19', 'Samsons', 'Peterpan', 'Isyana Sarasvati', 'Judika', 'Noah', 'Nidji', 'Anji'][$i % 10] }}</p>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-xs text-gray-500">{{ ['Handmade', 'Bintang Kehidupan', 'Republik Cinta', 'Samsons', 'Taman Langit', 'Lexicon', 'Judika', 'Second Chance', 'Liberty', 'Dia'][$i % 10] }}</span>
                        <div class="flex space-x-1">
                            <button class="text-gray-400 hover:text-white p-1" title="Hapus dari favorit">
                                <i class="ti ti-heart-filled"></i>
                            </button>
                            <button class="text-gray-400 hover:text-white p-1" title="Tambah ke playlist">
                                <i class="ti ti-playlist-add"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    
    <!-- Empty State (hidden by default) -->
    <div id="empty-state" class="bg-gray-900 rounded-xl p-4 hidden" data-aos="fade-up">
        <div class="empty-state flex flex-col items-center justify-center py-12">
            <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                             <i class="ti ti-heart text-gray-500 text-4xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-white mb-2">Belum ada lagu favorit</h3>
            <p class="text-gray-400 text-center max-w-md mb-6">Tandai lagu yang Anda sukai dengan mengklik ikon hati untuk menambahkannya ke koleksi favorit Anda.</p>
            <a href="{{ route('popular-songs') }}" class="btn-spotify rounded-full px-6 py-2.5 flex items-center gap-2">
                <i class="ti ti-music"></i> Jelajahi Lagu Populer
            </a>
        </div>
    </div>
    
    <!-- Recommendations Section -->
    <div class="mt-12" data-aos="fade-up">
        <h2 class="text-2xl font-bold text-white mb-6">Rekomendasi Berdasarkan Favorit Anda</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @for($i = 1; $i <= 6; $i++)
                <div class="music-card p-3">
                    <div class="relative mb-3">
                        <img src="https://picsum.photos/seed/rec{{ $i }}/300/300" alt="Album cover" class="music-card-img w-full aspect-square object-cover">
                        <button class="play-song-btn absolute bottom-2 right-2 bg-primary-600 hover:bg-primary-500 rounded-full p-2.5 shadow-lg"
                                data-song-title="{{ ['Pelangi', 'Bukan Dia Tapi Kamu', 'Ruang Rindu', 'Aku dan Dirimu', 'Sang Dewi', 'Menunggu Kamu'][$i-1] }}"
                                data-artist-name="{{ ['Hivi!', 'Judika', 'Letto', 'Ran', 'Lyodra', 'Anji'][$i-1] }}"
                                data-cover-image="https://picsum.photos/seed/rec{{ $i }}/300/300">
                            <i class="ti ti-player-play text-white"></i>
                        </button>
                    </div>
                    <h3 class="text-white font-medium truncate">{{ ['Pelangi', 'Bukan Dia Tapi Kamu', 'Ruang Rindu', 'Aku dan Dirimu', 'Sang Dewi', 'Menunggu Kamu'][$i-1] }}</h3>
                    <p class="text-gray-400 text-sm truncate">{{ ['Hivi!', 'Judika', 'Letto', 'Ran', 'Lyodra', 'Anji'][$i-1] }}</p>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // View toggle functionality
        const gridViewBtn = document.getElementById('grid-view-btn');
        const listViewBtn = document.getElementById('list-view-btn');
        const gridView = document.getElementById('grid-view');
        const listView = document.getElementById('list-view');
        const emptyState = document.getElementById('empty-state');
        
        // Initialize with grid view active
        gridView.classList.remove('hidden');
        listView.classList.add('hidden');
        emptyState.classList.add('hidden');
        
        // Toggle to grid view
        gridViewBtn.addEventListener('click', function() {
            // Update active button styles
            gridViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
            
            // Show grid view, hide list view
            gridView.classList.remove('hidden');
            listView.classList.add('hidden');
            
            // Add animation
            const gridItems = document.querySelectorAll('.grid-view-item');
            gridItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.3s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 50 * index);
            });
        });
        
        // Toggle to list view
        listViewBtn.addEventListener('click', function() {
            // Update active button styles
            listViewBtn.classList.add('active');
            gridViewBtn.classList.remove('active');
            
            // Show list view, hide grid view
            listView.classList.remove('hidden');
            gridView.classList.add('hidden');
            
            // Add animation
            const listItems = document.querySelectorAll('.favorite-song-card');
            listItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.3s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, 50 * index);
            });
        });
        
        // Search functionality
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            // Search in list view
            const listItems = document.querySelectorAll('#list-view .favorite-song-card');
            let listMatchCount = 0;
            
            listItems.forEach(item => {
                const title = item.querySelector('.text-white.font-medium').textContent.toLowerCase();
                const artist = item.querySelector('.text-sm').textContent.toLowerCase();
                const album = item.querySelector('.hidden.md\\:table-cell').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || artist.includes(searchTerm) || album.includes(searchTerm)) {
                    item.classList.remove('hidden');
                    listMatchCount++;
                } else {
                    item.classList.add('hidden');
                }
            });
            
            // Search in grid view
            const gridItems = document.querySelectorAll('#grid-view .grid-view-item');
            let gridMatchCount = 0;
            
            gridItems.forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                const artist = item.querySelector('p').textContent.toLowerCase();
                const album = item.querySelector('.text-xs.text-gray-500').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || artist.includes(searchTerm) || album.includes(searchTerm)) {
                    item.classList.remove('hidden');
                    gridMatchCount++;
                } else {
                    item.classList.add('hidden');
                }
            });
            
            // Show empty state if no matches
            if (gridMatchCount === 0 && !gridView.classList.contains('hidden')) {
                gridView.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else if (listMatchCount === 0 && !listView.classList.contains('hidden')) {
                listView.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
                
                if (!gridView.classList.contains('hidden')) {
                    gridView.classList.remove('hidden');
                }
                
                if (!listView.classList.contains('hidden')) {
                    listView.classList.remove('hidden');
                }
            }
        });
        
        // Sorting functionality
        const sortSelect = document.getElementById('sort-select');
        sortSelect.addEventListener('change', function() {
            const sortValue = this.value;
            
            // Sort list view items
            const listItems = Array.from(document.querySelectorAll('#list-view tbody tr'));
            sortItems(listItems, sortValue, 'list');
            
            // Sort grid view items
            const gridItems = Array.from(document.querySelectorAll('#grid-view .grid-view-item'));
            sortItems(gridItems, sortValue, 'grid');
        });
        
        function sortItems(items, sortBy, viewType) {
            items.sort((a, b) => {
                let valueA, valueB;
                
                if (viewType === 'list') {
                    if (sortBy === 'title') {
                        valueA = a.querySelector('.text-white.font-medium').textContent;
                        valueB = b.querySelector('.text-white.font-medium').textContent;
                    } else if (sortBy === 'artist') {
                        valueA = a.querySelector('.text-sm').textContent;
                        valueB = b.querySelector('.text-sm').textContent;
                    } else if (sortBy === 'album') {
                        valueA = a.querySelector('.hidden.md\\:table-cell').textContent;
                        valueB = b.querySelector('.hidden.md\\:table-cell').textContent;
                    } else if (sortBy === 'duration') {
                        valueA = a.querySelector('td:nth-last-child(2)').textContent;
                        valueB = b.querySelector('td:nth-last-child(2)').textContent;
                    } else { // recent (default)
                        valueA = a.querySelector('.hidden.lg\\:table-cell').textContent;
                        valueB = b.querySelector('.hidden.lg\\:table-cell').textContent;
                        return new Date(valueB) - new Date(valueA); // Descending for dates
                    }
                } else { // grid view
                    if (sortBy === 'title') {
                        valueA = a.querySelector('h3').textContent;
                        valueB = b.querySelector('h3').textContent;
                    } else if (sortBy === 'artist') {
                        valueA = a.querySelector('p').textContent;
                        valueB = b.querySelector('p').textContent;
                    } else if (sortBy === 'album') {
                        valueA = a.querySelector('.text-xs.text-gray-500').textContent;
                        valueB = b.querySelector('.text-xs.text-gray-500').textContent;
                    } else { // recent or duration (default to title for grid)
                        valueA = a.querySelector('h3').textContent;
                        valueB = b.querySelector('h3').textContent;
                    }
                }
                
                return valueA.localeCompare(valueB);
            });
            
            // Re-append sorted items
            const parent = items[0].parentNode;
            items.forEach(item => parent.appendChild(item));
        }
        
        // Add animation to song rows
        const songRows = document.querySelectorAll('.favorite-song-card');
        songRows.forEach((row, index) => {
            row.setAttribute('data-aos', 'fade-up');
            row.setAttribute('data-aos-delay', (index * 50).toString());
            
            // Add play functionality on row click
            row.addEventListener('click', function(e) {
                // Don't trigger if clicking on buttons
                if (e.target.closest('.song-actions')) {
                    return;
                }
                
                const title = this.querySelector('.text-white.font-medium').textContent;
                const artist = this.querySelector('.text-sm').textContent;
                const cover = this.querySelector('img').src;
                
                // Update mini player
                const miniPlayer = document.querySelector('.mini-player');
                const miniPlayerTitle = document.getElementById('miniPlayerTitle');
                const miniPlayerArtist = document.getElementById('miniPlayerArtist');
                const miniPlayerCover = document.getElementById('miniPlayerCover');
                const miniPlayerPlayBtn = document.getElementById('miniPlayerPlayBtn');
                
                miniPlayerTitle.textContent = title;
                miniPlayerArtist.textContent = artist;
                miniPlayerCover.src = cover;
                
                // Show mini player
                miniPlayer.classList.add('mini-player-visible');
                
                // Update current song data
                const currentSongData = {
                    title: title,
                    artist: artist,
                    cover: cover,
                    songId: null, // Demo songs don't have IDs
                    isPlaying: true,
                    progress: 0,
                    currentTime: 0,
                    duration: 300 // Default duration in seconds
                };
                
                // Store in session storage
                sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));
                
                // Set play button to pause
                miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-pause"></i>';
                
                // Start progress animation
                startProgressAnimation();
                
                // Add highlight to the clicked row
                songRows.forEach(r => r.classList.remove('bg-gray-800'));
                this.classList.add('bg-gray-800');
            });
        });
        
        // Add play functionality to grid items
        const gridItems = document.querySelectorAll('.grid-view-item');
        gridItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Don't trigger if clicking on buttons
                if (e.target.closest('button')) {
                    return;
                }
                
                const playBtn = this.querySelector('.play-song-btn');
                playBtn.click();
            });
        });
        
        // Handle remove from favorites
        const removeButtons = document.querySelectorAll('[title="Hapus dari favorit"]');
        removeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent row click
                
                let songTitle, row;
                
                if (this.closest('.favorite-song-card')) {
                    row = this.closest('.favorite-song-card');
                    songTitle = row.querySelector('.text-white.font-medium').textContent;
                } else {
                    row = this.closest('.grid-view-item');
                    songTitle = row.querySelector('h3').textContent;
                }
                
                // Show confirmation dialog
                Swal.fire({
                    title: 'Hapus dari favorit?',
                    text: `Apakah Anda yakin ingin menghapus "${songTitle}" dari daftar favorit?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    background: '#2a2a2a',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Animate row removal
                        row.style.transition = 'all 0.5s ease';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(20px)';
                        
                        setTimeout(() => {
                            row.remove();
                            
                                                       // Update song count
                            const songCount = document.getElementById('songCount');
                            const currentCount = parseInt(songCount.textContent);
                            songCount.textContent = (currentCount - 1) + ' lagu';
                            
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Dihapus dari favorit',
                                text: `"${songTitle}" telah dihapus dari daftar favorit Anda.`,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                toast: true,
                                position: 'top-end',
                                background: '#2a2a2a',
                                color: '#fff'
                            });
                            
                            // Check if all songs are removed
                            const remainingListItems = document.querySelectorAll('#list-view .favorite-song-card:not(.hidden)');
                            const remainingGridItems = document.querySelectorAll('#grid-view .grid-view-item:not(.hidden)');
                            
                            if (remainingListItems.length === 0 && remainingGridItems.length === 0) {
                                gridView.classList.add('hidden');
                                listView.classList.add('hidden');
                                emptyState.classList.remove('hidden');
                            }
                        }, 500);
                    }
                });
            });
        });
        
        // Handle add to playlist
        const playlistButtons = document.querySelectorAll('[title="Tambah ke playlist"]');
        playlistButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent row click
                
                let songTitle, artistName, coverImage;
                
                if (this.closest('.favorite-song-card')) {
                    const row = this.closest('.favorite-song-card');
                    songTitle = row.querySelector('.text-white.font-medium').textContent;
                    artistName = row.querySelector('.text-sm').textContent;
                    coverImage = row.querySelector('img').src;
                } else {
                    const card = this.closest('.grid-view-item');
                    songTitle = card.querySelector('h3').textContent;
                    artistName = card.querySelector('p').textContent;
                    coverImage = card.querySelector('img').src;
                }
                
                // Set data for the modal
                const playlistSongTitle = document.getElementById('playlistSongTitle');
                const playlistSongArtist = document.getElementById('playlistSongArtist');
                const playlistSongCover = document.getElementById('playlistSongCover');
                
                playlistSongTitle.textContent = songTitle;
                playlistSongArtist.textContent = artistName;
                playlistSongCover.src = coverImage;
                
                // Show the modal
                const modal = new Modal(document.getElementById('addToPlaylistModal'));
                modal.show();
            });
        });
        
        // Progress animation function (referenced in the click handler)
        let progressInterval;
        let progress = 0;
        
        function startProgressAnimation(initialProgress = 0) {
            // Reset progress if it's complete or use provided initial progress
            progress = initialProgress || 0;
            if (progress >= 100) {
                progress = 0;
            }
            
            const miniPlayerProgressBar = document.getElementById('miniPlayerProgressBar');
            miniPlayerProgressBar.style.width = progress + '%';
            
            // Clear any existing interval
            clearInterval(progressInterval);
            
            // Set play button to pause
            const miniPlayerPlayBtn = document.getElementById('miniPlayerPlayBtn');
            miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-pause"></i>';
            
            // Start progress animation
            progressInterval = setInterval(() => {
                progress += 0.1;
                miniPlayerProgressBar.style.width = progress + '%';
                
                // Update current song data in session storage
                const storedSongData = sessionStorage.getItem('currentSongData');
                if (storedSongData) {
                    const currentSongData = JSON.parse(storedSongData);
                    currentSongData.progress = progress;
                    currentSongData.currentTime = (progress / 100) * currentSongData.duration;
                    sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));
                }
                
                if (progress >= 100) {
                    clearInterval(progressInterval);
                    miniPlayerPlayBtn.innerHTML = '<i class="ti ti-player-play"></i>';
                    
                    // Update current song data
                    if (storedSongData) {
                        const currentSongData = JSON.parse(storedSongData);
                        currentSongData.isPlaying = false;
                        sessionStorage.setItem('currentSongData', JSON.stringify(currentSongData));
                    }
                }
            }, 30); // Approximately 5 minutes for full song
        }
        
        // Play All button functionality
        const playAllButton = document.querySelector('.btn-spotify');
        if (playAllButton) {
            playAllButton.addEventListener('click', function() {
                // Get the first song in the list
                const firstSongRow = document.querySelector('.favorite-song-card');
                const firstGridItem = document.querySelector('.grid-view-item');
                
                if (firstSongRow && !listView.classList.contains('hidden')) {
                    // Trigger a click on the first song in list view
                    firstSongRow.click();
                } else if (firstGridItem && !gridView.classList.contains('hidden')) {
                    // Trigger a click on the first song in grid view
                    const playBtn = firstGridItem.querySelector('.play-song-btn');
                    playBtn.click();
                }
                
                // Show notification
                Swal.fire({
                    icon: 'success',
                    title: 'Memutar semua',
                    text: 'Memutar semua lagu favorit Anda',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    background: '#2a2a2a',
                    color: '#fff'
                });
            });
        }
        
        // Initialize with grid view active (apply styles)
        gridViewBtn.click();
    });
</script>
@endsection

   
