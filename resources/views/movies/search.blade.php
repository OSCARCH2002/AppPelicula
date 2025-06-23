@extends('layouts.app')

@section('title', 'Búsqueda: ' . $query . ' - Mi App de Películas')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <div class="border-l-4 border-cyan-400 pl-3 sm:pl-4">
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">Resultados para "{{ $query }}"</h1>
        <p class="text-sm sm:text-base text-gray-400">{{ count($movies) }} películas encontradas.</p>
    </div>

    @if(count($movies) > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($movies as $movie)
                <div class="group relative bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-cyan-400/20 transition-all duration-300">
                    <a href="{{ route('movies.show', $movie['id']) }}" class="block">
                        @if(isset($movie['poster_path']) && $movie['poster_path'])
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" 
                                 alt="{{ $movie['title'] }}" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110">
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
    @else
        <div class="text-center py-12 sm:py-16 bg-slate-800 rounded-lg">
            <i class="fas fa-search-minus text-4xl sm:text-6xl text-gray-600 mb-4"></i>
            <h3 class="text-lg sm:text-xl font-semibold mb-2 text-white">No hay resultados</h3>
            <p class="text-sm sm:text-base text-gray-400 mb-4 sm:mb-6">No se encontraron películas para "{{ $query }}". Intenta con otro término.</p>
            <a href="{{ route('movies.index') }}" class="bg-cyan-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-cyan-600 transition-colors text-sm sm:text-base">
                Volver al Inicio
            </a>
        </div>
    @endif
</div>
@endsection 