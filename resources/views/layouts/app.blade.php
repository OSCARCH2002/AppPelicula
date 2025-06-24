<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PelisMod')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg-slate-900 { background-color: #0f172a; }
        .bg-slate-800 { background-color: #1e293b; }
        .text-cyan-400 { color: #22d3ee; }
        .border-cyan-400 { border-color: #22d3ee; }
        .ring-cyan-400 { --tw-ring-color: #22d3ee; }
        .hover\:bg-cyan-500:hover { background-color: #06b6d4; }
        .hover\:border-cyan-500:hover { border-color: #06b6d4; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .bg-grid-slate-700 {
            background-color: #334155;
            background-image: linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        /* Estilos para el dropdown de géneros */
        .group:hover .group-hover\:opacity-100 {
            opacity: 1;
        }
        .group:hover .group-hover\:visible {
            visibility: visible;
        }
        .group:hover .group-hover\:rotate-180 {
            transform: rotate(180deg);
        }
        /* Scrollbar personalizado para el dropdown */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 3px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 3px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
        /* Menú móvil */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu.open {
            transform: translateX(0);
        }
        /* Overlay para el menú móvil */
        .mobile-overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }
        .mobile-overlay.open {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="bg-slate-900 text-gray-200 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-slate-800 shadow-lg border-b border-slate-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('movies.index') }}" class="flex-shrink-0 flex items-center">
                        <i class="fas fa-film text-cyan-400 text-2xl sm:text-3xl mr-2"></i>
                        <span class="text-lg sm:text-xl font-bold text-white">PelisMod</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex lg:items-center lg:space-x-4">
                    <a href="{{ route('movies.popular') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Populares</a>
                    <a href="{{ route('movies.top-rated') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Mejor Valoradas</a>
                    <a href="{{ route('movies.now-playing') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">En Cines</a>
                    <a href="{{ route('movies.upcoming') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Próximos</a>
                    
                    <!-- Géneros Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center">
                            Géneros
                            <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute top-full left-0 mt-1 w-64 bg-slate-800 border border-slate-700 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 max-h-96 overflow-y-auto">
                            <div class="p-2">
                                @if(isset($allGenres) && !empty($allGenres))
                                    @foreach($allGenres as $genre)
                                        <a href="{{ route('movies.genre', ['id' => $genre['id'], 'name' => $genre['name']]) }}" 
                                           class="flex items-center px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-slate-700 rounded-md transition-colors">
                                            <div class="w-6 h-6 mr-3 flex items-center justify-center">
                                                @switch($genre['id'])
                                                    @case(28)
                                                        <!-- Acción -->
                                                        <img src="{{ asset('images/genres/action.svg') }}" 
                                                             alt="Acción" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-fist-raised text-red-400" style="display: none;"></i>
                                                        @break
                                                    @case(12)
                                                        <!-- Aventura -->
                                                        <img src="{{ asset('images/genres/adventure.svg') }}" 
                                                             alt="Aventura" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-mountain text-green-400" style="display: none;"></i>
                                                        @break
                                                    @case(16)
                                                        <!-- Animación -->
                                                        <img src="{{ asset('images/genres/animation.svg') }}" 
                                                             alt="Animación" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-palette text-purple-400" style="display: none;"></i>
                                                        @break
                                                    @case(35)
                                                        <!-- Comedia -->
                                                        <img src="{{ asset('images/genres/comedy.svg') }}" 
                                                             alt="Comedia" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-laugh text-yellow-400" style="display: none;"></i>
                                                        @break
                                                    @case(80)
                                                        <!-- Crimen -->
                                                        <img src="{{ asset('images/genres/crime.svg') }}" 
                                                             alt="Crimen" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-user-secret text-gray-400" style="display: none;"></i>
                                                        @break
                                                    @case(99)
                                                        <!-- Documental -->
                                                        <img src="{{ asset('images/genres/documentary.svg') }}" 
                                                             alt="Documental" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-camera text-blue-400" style="display: none;"></i>
                                                        @break
                                                    @case(18)
                                                        <!-- Drama -->
                                                        <img src="{{ asset('images/genres/drama.svg') }}" 
                                                             alt="Drama" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-theater-masks text-indigo-400" style="display: none;"></i>
                                                        @break
                                                    @case(10751)
                                                        <!-- Familiar -->
                                                        <img src="{{ asset('images/genres/family.svg') }}" 
                                                             alt="Familiar" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-baby text-pink-400" style="display: none;"></i>
                                                        @break
                                                    @case(14)
                                                        <!-- Fantasía -->
                                                        <img src="{{ asset('images/genres/fantasy.svg') }}" 
                                                             alt="Fantasía" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-dragon text-orange-400" style="display: none;"></i>
                                                        @break
                                                    @case(36)
                                                        <!-- Historia -->
                                                        <img src="{{ asset('images/genres/history.svg') }}" 
                                                             alt="Historia" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-landmark text-amber-400" style="display: none;"></i>
                                                        @break
                                                    @case(27)
                                                        <!-- Terror -->
                                                        <img src="{{ asset('images/genres/horror.svg') }}" 
                                                             alt="Terror" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-ghost text-gray-300" style="display: none;"></i>
                                                        @break
                                                    @case(10402)
                                                        <!-- Música -->
                                                        <img src="{{ asset('images/genres/music.svg') }}" 
                                                             alt="Música" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-music text-purple-300" style="display: none;"></i>
                                                        @break
                                                    @case(9648)
                                                        <!-- Misterio -->
                                                        <img src="{{ asset('images/genres/mystery.svg') }}" 
                                                             alt="Misterio" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-search text-cyan-400" style="display: none;"></i>
                                                        @break
                                                    @case(10749)
                                                        <!-- Romance -->
                                                        <img src="{{ asset('images/genres/romance.svg') }}" 
                                                             alt="Romance" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-heart text-red-300" style="display: none;"></i>
                                                        @break
                                                    @case(878)
                                                        <!-- Ciencia Ficción -->
                                                        <img src="{{ asset('images/genres/scifi.svg') }}" 
                                                             alt="Ciencia Ficción" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-rocket text-blue-300" style="display: none;"></i>
                                                        @break
                                                    @case(10770)
                                                        <!-- Película de TV -->
                                                        <img src="{{ asset('images/genres/tv.svg') }}" 
                                                             alt="Película de TV" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-tv text-green-300" style="display: none;"></i>
                                                        @break
                                                    @case(53)
                                                        <!-- Suspense -->
                                                        <img src="{{ asset('images/genres/thriller.svg') }}" 
                                                             alt="Suspense" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-exclamation-triangle text-yellow-300" style="display: none;"></i>
                                                        @break
                                                    @case(10752)
                                                        <!-- Guerra -->
                                                        <img src="{{ asset('images/genres/war.svg') }}" 
                                                             alt="Guerra" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-shield-alt text-gray-400" style="display: none;"></i>
                                                        @break
                                                    @case(37)
                                                        <!-- Western -->
                                                        <img src="{{ asset('images/genres/western.svg') }}" 
                                                             alt="Western" 
                                                             class="w-5 h-5 object-cover rounded-sm"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <i class="fas fa-horse text-brown-400" style="display: none;"></i>
                                                        @break
                                                    @default
                                                        <i class="fas fa-film text-gray-400"></i>
                                                @endswitch
                                            </div>
                                            <span>{{ $genre['name'] }}</span>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="px-3 py-2 text-sm text-gray-400">
                                        Cargando géneros...
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Bar and Mobile Menu Button -->
                <div class="flex items-center space-x-2">
                    <!-- Search Bar -->
                    <form action="{{ route('movies.search') }}" method="GET" class="hidden sm:flex">
                        <input type="text" name="query" placeholder="Buscar..." 
                               class="w-32 md:w-48 lg:w-64 px-3 py-2 rounded-l-md bg-slate-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition-all duration-300 text-sm"
                               value="{{ request('query') }}">
                        <button type="submit" class="px-3 py-2 bg-cyan-500 text-white rounded-r-md hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="lg:hidden p-2 rounded-md text-gray-300 hover:text-white hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="mobile-overlay fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 h-full w-80 bg-slate-800 shadow-xl z-50 lg:hidden overflow-y-auto">
        <div class="p-6">
            <!-- Close Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white">Menú</h2>
                <button id="mobile-menu-close" class="p-2 rounded-md text-gray-300 hover:text-white hover:bg-slate-700 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Mobile Search -->
            <form action="{{ route('movies.search') }}" method="GET" class="mb-6">
                <div class="flex">
                    <input type="text" name="query" placeholder="Buscar películas..." 
                           class="flex-1 px-3 py-2 rounded-l-md bg-slate-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition-all duration-300 text-sm"
                           value="{{ request('query') }}">
                    <button type="submit" class="px-3 py-2 bg-cyan-500 text-white rounded-r-md hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Mobile Navigation Links -->
            <div class="space-y-2 mb-6">
                <a href="{{ route('movies.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-slate-700 rounded-md transition-colors">
                    <i class="fas fa-home mr-3"></i> Inicio
                </a>
                <a href="{{ route('movies.popular') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-slate-700 rounded-md transition-colors">
                    <i class="fas fa-fire mr-3"></i> Populares
                </a>
                <a href="{{ route('movies.top-rated') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-slate-700 rounded-md transition-colors">
                    <i class="fas fa-star mr-3"></i> Mejor Valoradas
                </a>
                <a href="{{ route('movies.now-playing') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-slate-700 rounded-md transition-colors">
                    <i class="fas fa-film mr-3"></i> En Cines
                </a>
                <a href="{{ route('movies.upcoming') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-slate-700 rounded-md transition-colors">
                    <i class="fas fa-calendar mr-3"></i> Próximos
                </a>
            </div>

            <!-- Mobile Genres -->
            <div class="border-t border-slate-700 pt-6">
                <h3 class="text-lg font-semibold text-white mb-4">Géneros</h3>
                <div class="space-y-2 max-h-96 overflow-y-auto">
                    @if(isset($allGenres) && !empty($allGenres))
                        @foreach($allGenres as $genre)
                            <a href="{{ route('movies.genre', ['id' => $genre['id'], 'name' => $genre['name']]) }}" 
                               class="flex items-center px-3 py-2 text-gray-300 hover:text-white hover:bg-slate-700 rounded-md transition-colors">
                                <div class="w-6 h-6 mr-3 flex items-center justify-center">
                                    @switch($genre['id'])
                                        @case(28)
                                            <i class="fas fa-fist-raised text-red-400"></i>
                                            @break
                                        @case(12)
                                            <i class="fas fa-mountain text-green-400"></i>
                                            @break
                                        @case(16)
                                            <i class="fas fa-palette text-purple-400"></i>
                                            @break
                                        @case(35)
                                            <i class="fas fa-laugh text-yellow-400"></i>
                                            @break
                                        @case(80)
                                            <i class="fas fa-user-secret text-gray-400"></i>
                                            @break
                                        @case(27)
                                            <i class="fas fa-ghost text-gray-300"></i>
                                            @break
                                        @case(14)
                                            <i class="fas fa-dragon text-orange-400"></i>
                                            @break
                                        @case(10749)
                                            <i class="fas fa-heart text-red-300"></i>
                                            @break
                                        @case(878)
                                            <i class="fas fa-rocket text-blue-300"></i>
                                            @break
                                        @default
                                            <i class="fas fa-film text-gray-400"></i>
                                    @endswitch
                                </div>
                                <span class="text-sm">{{ $genre['name'] }}</span>
                            </a>
                        @endforeach
                    @else
                        <div class="px-3 py-2 text-sm text-gray-400">
                            Cargando géneros...
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8 w-full">
        @yield('content')
    </main>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');

        function openMobileMenu() {
            mobileMenu.classList.add('open');
            mobileOverlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('open');
            mobileOverlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        mobileMenuButton.addEventListener('click', openMobileMenu);
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileOverlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu on window resize if screen becomes large
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeMobileMenu();
            }
        });
    </script>
</body>
</html> 