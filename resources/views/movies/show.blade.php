@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div>
    <!-- Hero Section with Backdrop -->
    <div class="relative h-48 sm:h-64 md:h-[60vh] min-h-[300px] sm:min-h-[400px] rounded-lg overflow-hidden shadow-2xl">
        <div class="absolute inset-0">
            @if($movie->backdrop_path)
                <img src="{{ $movie->backdrop_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-slate-800"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/70 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/50 to-transparent"></div>
        </div>
        
        <div class="relative z-10 h-full flex flex-col justify-end p-4 sm:p-6 md:p-8 lg:p-12 text-white">
            <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-6xl font-bold mb-2 line-clamp-2">{{ $movie->title }}</h1>
            <p class="text-sm sm:text-base md:text-lg text-gray-300 italic line-clamp-1">{{ $movie->original_title }}</p>
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 mt-2 sm:mt-4 text-sm sm:text-base md:text-lg gap-2 sm:gap-0">
                @if($movie->release_date)
                    <span>{{ $movie->formatted_release_date }}</span>
                @endif
                @if($movie->vote_average > 0)
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400 mr-1 sm:mr-2"></i>
                        <span>{{ number_format($movie->vote_average, 1) }}/10</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-4 sm:py-6 md:py-8">
        <!-- Movie Player and Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 lg:gap-8">
            <!-- Main content: Player and Description -->
            <div class="lg:col-span-8 xl:col-span-9 order-2 lg:order-1">
                <div class="space-y-4 sm:space-y-6 md:space-y-8">
                    <!-- Movie Player -->
                    <div class="bg-black rounded-lg overflow-hidden aspect-video shadow-lg border border-slate-800">
                        <iframe 
                            src="https://vidsrc.to/embed/movie/{{ $movie->vidapi_id }}" 
                            frameborder="0" 
                            allowfullscreen 
                            class="w-full h-full">
                        </iframe>
                    </div>

                    <!-- Description -->
                    <div class="bg-slate-800 p-4 sm:p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl sm:text-2xl font-bold text-white mb-3 sm:mb-4">Sinopsis</h2>
                        <p class="text-sm sm:text-base text-gray-300 leading-relaxed">{{ $movie->description ?: 'No hay sinopsis disponible.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Poster and Info -->
            <div class="lg:col-span-4 xl:col-span-3 order-1 lg:order-2">
                <div class="bg-slate-800 rounded-lg overflow-hidden shadow-lg">
                    @if($movie->poster_path)
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full object-cover">
                    @else
                        <div class="w-full aspect-[2/3] bg-slate-700 flex items-center justify-center">
                            <i class="fas fa-film text-3xl sm:text-4xl md:text-6xl text-gray-500"></i>
                        </div>
                    @endif
                    <div class="p-3 sm:p-4 space-y-3 sm:space-y-4">
                         <a href="https://www.themoviedb.org/movie/{{ $movie->vidapi_id }}" 
                           target="_blank" 
                           class="block w-full bg-cyan-500 text-white text-center font-semibold py-2 sm:py-3 rounded-lg hover:bg-cyan-600 transition-colors text-sm sm:text-base">
                            <i class="fas fa-info-circle mr-2"></i>Ver en TMDB
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 