@extends('layouts.app')

@section('title', $name . ' - Mi App de Películas')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Header -->
    <div class="border-l-4 border-pink-400 pl-3 sm:pl-4">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white">{{ $name }}</h1>
        <p class="text-sm sm:text-base text-gray-400">Películas del género {{ $name }}</p>
        @if(isset($paginator))
            <p class="text-xs sm:text-sm text-gray-500 mt-1">{{ number_format($paginator->total()) }} películas disponibles</p>
        @endif
    </div>

    <!-- Grid de Películas -->
    @if(!empty($movies))
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($movies as $movie)
                <div class="group relative bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-pink-400/20 transition-all duration-300">
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
                            
                            @if(isset($movie['release_date']))
                                <div class="text-xs sm:text-sm text-gray-300 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-calendar mr-1"></i>
                                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('d/m/Y') }}</span>
                                </div>
                            @endif
                            
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

        <!-- Paginación -->
        @if(isset($paginator) && $paginator->hasPages())
            <div class="mt-6 sm:mt-8">
                @include('vendor.pagination.api', compact('paginator'))
            </div>
        @endif
    @else
        <div class="text-center py-12 sm:py-16 bg-slate-800 rounded-lg">
            <i class="fas fa-film text-4xl sm:text-6xl text-gray-600 mb-4"></i>
            <h3 class="text-lg sm:text-xl font-semibold mb-2 text-white">No hay películas de {{ $name }} disponibles</h3>
            <p class="text-sm sm:text-base text-gray-400">Intenta con otro género o más tarde.</p>
            <a href="{{ route('movies.genres') }}" class="inline-block mt-4 bg-pink-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-pink-600 transition-colors text-sm sm:text-base">
                Ver Todos los Géneros
            </a>
        </div>
    @endif
</div>
@endsection 