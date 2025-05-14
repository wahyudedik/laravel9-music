<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist Music - Discover and Play Music</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Application Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')
</head>


<body>
    <div class="app-container">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Header -->
        @include('layouts.partials.header')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            @yield('content')
        </main>

        <!-- Player Bar -->
        {{-- @include('layouts.partials.player-bar') --}}

        <!-- Full Screen Player -->
        {{-- @include('layouts.partials.fullscreen-player') --}}
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const header = document.querySelector('.music-header');
            const body = document.body;

            // Toggle sidebar collapse
            sidebarCollapseBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                body.classList.toggle('sidebar-collapsed');

                // Update icon
                const icon = this.querySelector('i');
                if (sidebar.classList.contains('collapsed')) {
                    icon.classList.remove('ti-chevron-left');
                    icon.classList.add('ti-chevron-right');
                } else {
                    icon.classList.remove('ti-chevron-right');
                    icon.classList.add('ti-chevron-left');
                }

                // Save state in localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });

            // Mobile menu toggle
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                const isClickInsideSidebar = sidebar.contains(e.target);
                const isClickOnToggle = mobileMenuToggle && mobileMenuToggle.contains(e.target);

                if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 992 && sidebar
                    .classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });

            // Load sidebar state from localStorage
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                body.classList.add('sidebar-collapsed');
                const icon = sidebarCollapseBtn.querySelector('i');
                icon.classList.remove('ti-chevron-left');
                icon.classList.add('ti-chevron-right');
            }

            // Notifications
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    background: '#2a2a2a',
                    color: '#fff'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    showConfirmButton: true,
                    confirmButtonColor: '#e62117',
                    background: '#2a2a2a',
                    color: '#fff'
                });
            @endif
        });
    </script>

    @yield('scripts')
</body>

</html>
