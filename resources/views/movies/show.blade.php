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
                    <!-- Provider Selector -->
                    <div class="bg-slate-800 p-4 rounded-lg shadow-lg">
                        <h3 class="text-lg font-semibold text-white mb-3">
                            <i class="fas fa-globe mr-2 text-cyan-400"></i>Seleccionar Proveedor
                        </h3>
                        
                        <!-- Spanish Providers Section -->
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-green-400 mb-2">
                                <i class="fas fa-language mr-1"></i>Proveedores en Español
                            </h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                                @foreach($videoProviders as $key => $provider)
                                    @if($provider['supports_language'])
                                        <button 
                                            class="provider-btn bg-slate-700 hover:bg-slate-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors border border-slate-600 hover:border-green-500"
                                            data-provider="{{ $key }}"
                                            data-url="{{ $provider['url'] }}"
                                            title="{{ $provider['description'] }}">
                                            <div class="flex items-center justify-center space-x-1">
                                                <i class="fas fa-language text-green-400 text-xs"></i>
                                                <span>{{ $provider['name'] }}</span>
                                            </div>
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Other Providers Section -->
                        <div>
                            <h4 class="text-sm font-medium text-yellow-400 mb-2">
                                <i class="fas fa-film mr-1"></i>Otros Proveedores
                            </h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                                @foreach($videoProviders as $key => $provider)
                                    @if(!$provider['supports_language'])
                                        <button 
                                            class="provider-btn bg-slate-700 hover:bg-slate-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors border border-slate-600 hover:border-yellow-500"
                                            data-provider="{{ $key }}"
                                            data-url="{{ $provider['url'] }}"
                                            title="{{ $provider['description'] }}">
                                            <div class="flex items-center justify-center space-x-1">
                                                <i class="fas fa-film text-yellow-400 text-xs"></i>
                                                <span>{{ $provider['name'] }}</span>
                                            </div>
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        
                        
                    </div>

                    <!-- Movie Player -->
                    <div class="bg-black rounded-lg overflow-hidden aspect-video shadow-lg border border-slate-800 relative">
                        <div id="player-container" class="w-full h-full">
                            <iframe 
                                id="movie-player"
                                src="{{ $defaultProvider['url'] }}" 
                                frameborder="0" 
                                allowfullscreen 
                                class="w-full h-full">
                            </iframe>
                        </div>
                        
                        <!-- Loading indicator -->
                        <div id="loading-indicator" class="absolute inset-0 bg-slate-900 flex items-center justify-center hidden">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-cyan-400 mx-auto mb-4"></div>
                                <p class="text-white text-sm">Cargando reproductor...</p>
                            </div>
                        </div>
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

<script>
function changeProvider(providerKey, url) {
    // Show loading indicator
    document.getElementById('loading-indicator').classList.remove('hidden');
    
    // Update active button
    document.querySelectorAll('.provider-btn').forEach(btn => {
        btn.classList.remove('bg-cyan-600', 'border-cyan-500', 'bg-green-600', 'border-green-500', 'bg-yellow-600', 'border-yellow-500');
        btn.classList.add('bg-slate-700', 'border-slate-600');
    });
    
    const activeButton = document.querySelector(`[data-provider="${providerKey}"]`);
    if (activeButton) {
        // Determine color based on provider type
        const isSpanishProvider = activeButton.querySelector('.fa-language') !== null;
        if (isSpanishProvider) {
            activeButton.classList.add('bg-green-600', 'border-green-500');
        } else {
            activeButton.classList.add('bg-yellow-600', 'border-yellow-500');
        }
        activeButton.classList.remove('bg-slate-700', 'border-slate-600');
    }
    
    // Change iframe source
    const iframe = document.getElementById('movie-player');
    iframe.src = url;
    
    // Hide loading indicator after a short delay
    setTimeout(() => {
        document.getElementById('loading-indicator').classList.add('hidden');
    }, 2000);
}

// Set initial active provider and add event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listeners to all provider buttons
    document.querySelectorAll('.provider-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const providerKey = this.getAttribute('data-provider');
            const url = this.getAttribute('data-url');
            changeProvider(providerKey, url);
        });
    });
    
    // Find the default provider (first Spanish provider or first provider)
    const spanishProviders = document.querySelectorAll('.provider-btn .fa-language');
    const defaultProvider = spanishProviders.length > 0 
        ? spanishProviders[0].closest('.provider-btn')
        : document.querySelector('.provider-btn');
    
    if (defaultProvider) {
        const isSpanishProvider = defaultProvider.querySelector('.fa-language') !== null;
        if (isSpanishProvider) {
            defaultProvider.classList.add('bg-green-600', 'border-green-500');
        } else {
            defaultProvider.classList.add('bg-yellow-600', 'border-yellow-500');
        }
        defaultProvider.classList.remove('bg-slate-700', 'border-slate-600');
    }
});
</script>
@endsection 