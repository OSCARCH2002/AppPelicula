@extends('layouts.app')

@section('title', 'Inicio - Mi App de Películas')

@section('content')
<div class="space-y-8 sm:space-y-12">
    <!-- Hero Section -->
    <div class="relative rounded-lg overflow-hidden h-64 sm:h-80 md:h-96 flex items-center justify-center text-center p-4 sm:p-6 shadow-2xl">
        @if(!empty($popularMovies) && isset($popularMovies[0]['backdrop_path']))
            <div class="absolute inset-0">
                <img src="https://image.tmdb.org/t/p/original{{ $popularMovies[0]['backdrop_path'] }}" alt="Hero background" class="w-full h-full object-cover opacity-20">
            </div>
        @else
            <div class="absolute inset-0 bg-slate-800 bg-grid-slate-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-transparent"></div>
            </div>
        @endif
        <div class="relative z-10">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3 sm:mb-4">Descubre tu Próxima Película Favorita</h1>
            <p class="text-sm sm:text-base lg:text-lg text-gray-300 mb-6 sm:mb-8 max-w-2xl mx-auto px-4">Explora un universo de películas, desde los grandes clásicos hasta los últimos estrenos.</p>
        </div>
    </div>

    <!-- Películas Populares -->
    @if(!empty($popularMovies))
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-2 sm:gap-0">
            <div class="border-l-4 border-cyan-400 pl-3 sm:pl-4">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">Películas Populares</h2>
                <p class="text-sm sm:text-base text-gray-400">Las más vistas y comentadas</p>
            </div>
            <a href="{{ route('movies.popular') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors text-sm sm:text-base">
                Ver todas <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($popularMovies as $movie)
                <div class="group relative bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-cyan-400/20 transition-all duration-300">
                    <a href="{{ route('movies.show', $movie['id']) }}" class="block">
                        @if(isset($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                            <div class="w-full aspect-[2/3] bg-slate-700 flex items-center justify-center">
                                <i class="fas fa-film text-2xl sm:text-3xl lg:text-5xl text-gray-500"></i>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-3 lg:p-4 text-white">
                            <h3 class="font-semibold text-xs sm:text-sm lg:text-md line-clamp-2">{{ $movie['title'] }}</h3>
                            
                            @if(isset($movie['vote_average']) && $movie['vote_average'] > 0)
                                <div class="flex items-center text-xs sm:text-sm mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ number_format($movie['vote_average'], 1) }} / 10</span>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Películas Mejor Valoradas -->
    @if(!empty($topRatedMovies))
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-2 sm:gap-0">
            <div class="border-l-4 border-yellow-400 pl-3 sm:pl-4">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">Mejor Valoradas</h2>
                <p class="text-sm sm:text-base text-gray-400">Las películas con mejores críticas</p>
            </div>
            <a href="{{ route('movies.top-rated') }}" class="text-yellow-400 hover:text-yellow-300 transition-colors text-sm sm:text-base">
                Ver todas <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($topRatedMovies as $movie)
                <div class="group relative bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-yellow-400/20 transition-all duration-300">
                    <a href="{{ route('movies.show', $movie['id']) }}" class="block">
                        @if(isset($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                            <div class="w-full aspect-[2/3] bg-slate-700 flex items-center justify-center">
                                <i class="fas fa-film text-2xl sm:text-3xl lg:text-5xl text-gray-500"></i>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-3 lg:p-4 text-white">
                            <h3 class="font-semibold text-xs sm:text-sm lg:text-md line-clamp-2">{{ $movie['title'] }}</h3>
                            
                            @if(isset($movie['vote_average']) && $movie['vote_average'] > 0)
                                <div class="flex items-center text-xs sm:text-sm mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ number_format($movie['vote_average'], 1) }} / 10</span>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Películas en Cines -->
    @if(!empty($nowPlayingMovies))
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-2 sm:gap-0">
            <div class="border-l-4 border-green-400 pl-3 sm:pl-4">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">En Cines</h2>
                <p class="text-sm sm:text-base text-gray-400">Las películas que están en cartelera</p>
            </div>
            <a href="{{ route('movies.now-playing') }}" class="text-green-400 hover:text-green-300 transition-colors text-sm sm:text-base">
                Ver todas <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($nowPlayingMovies as $movie)
                <div class="group relative bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-green-400/20 transition-all duration-300">
                    <a href="{{ route('movies.show', $movie['id']) }}" class="block">
                        @if(isset($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                            <div class="w-full aspect-[2/3] bg-slate-700 flex items-center justify-center">
                                <i class="fas fa-film text-2xl sm:text-3xl lg:text-5xl text-gray-500"></i>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-3 lg:p-4 text-white">
                            <h3 class="font-semibold text-xs sm:text-sm lg:text-md line-clamp-2">{{ $movie['title'] }}</h3>
                            
                            @if(isset($movie['vote_average']) && $movie['vote_average'] > 0)
                                <div class="flex items-center text-xs sm:text-sm mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ number_format($movie['vote_average'], 1) }} / 10</span>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Próximos Estrenos -->
    @if(!empty($upcomingMovies))
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-2 sm:gap-0">
            <div class="border-l-4 border-purple-400 pl-3 sm:pl-4">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">Próximos Estrenos</h2>
                <p class="text-sm sm:text-base text-gray-400">Las películas que están por llegar</p>
            </div>
            <a href="{{ route('movies.upcoming') }}" class="text-purple-400 hover:text-purple-300 transition-colors text-sm sm:text-base">
                Ver todas <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($upcomingMovies as $movie)
                <div class="group relative bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-purple-400/20 transition-all duration-300">
                    <a href="{{ route('movies.show', $movie['id']) }}" class="block">
                        @if(isset($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                            <div class="w-full aspect-[2/3] bg-slate-700 flex items-center justify-center">
                                <i class="fas fa-film text-2xl sm:text-3xl lg:text-5xl text-gray-500"></i>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-3 lg:p-4 text-white">
                            <h3 class="font-semibold text-xs sm:text-sm lg:text-md line-clamp-2">{{ $movie['title'] }}</h3>
                            
                            @if(isset($movie['vote_average']) && $movie['vote_average'] > 0)
                                <div class="flex items-center text-xs sm:text-sm mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ number_format($movie['vote_average'], 1) }} / 10</span>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Géneros Populares -->
    @if(!empty($popularGenres))
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-2 sm:gap-0">
            <div class="border-l-4 border-pink-400 pl-3 sm:pl-4">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">Géneros Populares</h2>
                <p class="text-sm sm:text-base text-gray-400">Explora por tu género favorito</p>
            </div>
            <a href="{{ route('movies.genres') }}" class="text-pink-400 hover:text-pink-300 transition-colors text-sm sm:text-base">
                Ver todos <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($popularGenres as $genre)
                <div class="group relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl overflow-hidden shadow-lg hover:shadow-pink-400/30 transition-all duration-300 hover:scale-105 border border-slate-700 hover:border-pink-400/50">
                    <a href="{{ route('movies.genre', ['id' => $genre['id'], 'name' => $genre['name']]) }}" class="block p-4 sm:p-6 text-center">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 rounded-full flex items-center justify-center relative overflow-hidden">
                            @switch($genre['id'])
                                @case(28)
                                    <!-- Acción -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-red-500 to-orange-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                                    </svg>
                                    @break
                                @case(12)
                                    <!-- Aventura -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-emerald-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 7L12 12L22 7L12 2Z M2 17L12 22L22 17 M2 12L12 17L22 12"/>
                                    </svg>
                                    @break
                                @case(16)
                                    <!-- Animación -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10C16 7.79 14.21 6 12 6Z"/>
                                    </svg>
                                    @break
                                @case(35)
                                    <!-- Comedia -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500 to-orange-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM8 14C9.1 14 10 13.1 10 12C10 10.9 9.1 10 8 10C6.9 10 6 10.9 6 12C6 13.1 6.9 14 8 14ZM16 14C17.1 14 18 13.1 18 12C18 10.9 17.1 10 16 10C14.9 10 14 10.9 14 12C14 13.1 14.9 14 16 14Z"/>
                                    </svg>
                                    @break
                                @case(80)
                                    <!-- Crimen -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-gray-600 to-gray-800"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 11.99H19C18.47 16.11 15.72 19.78 12 20.93V12H5V6.3L12 3.19V11.99Z"/>
                                    </svg>
                                    @break
                                @case(27)
                                    <!-- Terror -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-gray-700 to-black"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                                    </svg>
                                    @break
                                @case(14)
                                    <!-- Fantasía -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500 to-red-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                                    </svg>
                                    @break
                                @case(10749)
                                    <!-- Romance -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-red-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35L10.55 20.03C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3C9.24 3 10.91 3.81 12 5.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5C22 12.27 18.6 15.36 13.45 20.03L12 21.35Z"/>
                                    </svg>
                                    @break
                                @case(878)
                                    <!-- Ciencia Ficción -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                                    </svg>
                                    @break
                                @default
                                    <!-- Género por defecto -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-slate-500 to-gray-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 4L20 8H17L15 4H13L15 8H12L10 4H8L10 8H7L5 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V4H18Z"/>
                                    </svg>
                            @endswitch
                        </div>
                        
                        <h3 class="font-semibold text-sm sm:text-base lg:text-lg text-white mb-2 group-hover:text-pink-400 transition-colors duration-300">{{ $genre['name'] }}</h3>
                        
                        <div class="text-xs sm:text-sm text-gray-400 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.59 16.59L13.17 12L8.59 7.41L10 6L16 12L10 18L8.59 16.59Z"/>
                                </svg>
                                Explorar
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Tu Colección (Películas Guardadas) -->
    @if($savedMovies->count() > 0)
    <div>
        <div class="border-l-4 border-blue-400 pl-3 sm:pl-4 mb-4 sm:mb-6">
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">Tu Colección</h2>
            <p class="text-sm sm:text-base text-gray-400">Las películas que has explorado recientemente.</p>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($savedMovies as $movie)
                <div class="group relative bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-400/20 transition-all duration-300">
                    <a href="{{ route('movies.show', $movie->vidapi_id) }}" class="block">
                        @if($movie->poster_path)
                            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                            <div class="w-full aspect-[2/3] bg-slate-700 flex items-center justify-center">
                                <i class="fas fa-film text-2xl sm:text-3xl lg:text-5xl text-gray-500"></i>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-2 sm:p-3 lg:p-4 text-white">
                            <h3 class="font-semibold text-xs sm:text-sm lg:text-md line-clamp-2">{{ $movie->title }}</h3>
                            
                            @if($movie->vote_average > 0)
                                <div class="flex items-center text-xs sm:text-sm mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ number_format($movie->vote_average, 1) }} / 10</span>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection 