@extends('layouts.app')

@section('title', 'Géneros - Mi App de Películas')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Header -->
    <div class="border-l-4 border-pink-400 pl-3 sm:pl-4">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white">Géneros de Películas</h1>
        <p class="text-sm sm:text-base text-gray-400">Explora películas por tu género favorito</p>
    </div>

    <!-- Grid de Géneros -->
    @if(!empty($genres))
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
            @foreach($genres as $genre)
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
                                @case(99)
                                    <!-- Documental -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-cyan-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10C16 7.79 14.21 6 12 6Z"/>
                                    </svg>
                                    @break
                                @case(18)
                                    <!-- Drama -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10C16 7.79 14.21 6 12 6Z"/>
                                    </svg>
                                    @break
                                @case(10751)
                                    <!-- Familiar -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-rose-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 4C16 2.89 15.11 2 14 2C12.89 2 12 2.89 12 4C12 5.11 12.89 6 14 6C15.11 6 16 5.11 16 4ZM20 22V16H22L21 12C20.72 11.22 20.16 10.55 19.47 10.12C18.78 9.69 17.96 9.5 17.14 9.5C16.32 9.5 15.5 9.69 14.81 10.12C14.12 10.55 13.56 11.22 13.28 12L12 16H14V22H20ZM12.5 11.5C12.5 10.12 13.62 9 15 9C16.38 9 17.5 10.12 17.5 11.5C17.5 12.88 16.38 14 15 14C13.62 14 12.5 12.88 12.5 11.5ZM5.5 6C6.88 6 8 7.12 8 8.5C8 9.88 6.88 11 5.5 11C4.12 11 3 9.88 3 8.5C3 7.12 4.12 6 5.5 6ZM7.5 15C8.88 15 10 16.12 10 17.5C10 18.88 8.88 20 7.5 20C6.12 20 5 18.88 5 17.5C5 16.12 6.12 15 7.5 15ZM15 15C16.38 15 17.5 16.12 17.5 17.5C17.5 18.88 16.38 20 15 20C13.62 20 12.5 18.88 12.5 17.5C12.5 16.12 13.62 15 15 15Z"/>
                                    </svg>
                                    @break
                                @case(14)
                                    <!-- Fantasía -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500 to-red-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                                    </svg>
                                    @break
                                @case(36)
                                    <!-- Historia -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500 to-yellow-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10C16 7.79 14.21 6 12 6Z"/>
                                    </svg>
                                    @break
                                @case(27)
                                    <!-- Terror -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-gray-700 to-black"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                                    </svg>
                                    @break
                                @case(10402)
                                    <!-- Música -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-violet-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 3V13.55C11.41 13.21 10.73 13 10 13C7.79 13 6 14.79 6 17C6 19.21 7.79 21 10 21C12.21 21 14 19.21 14 17V7H18V3H12Z"/>
                                    </svg>
                                    @break
                                @case(9648)
                                    <!-- Misterio -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500 to-blue-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10C16 7.79 14.21 6 12 6Z"/>
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
                                @case(10770)
                                    <!-- Película de TV -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-teal-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M21 3H3C1.89 3 1 3.89 1 5V19C1 20.11 1.89 21 3 21H21C22.11 21 23 20.11 23 19V5C23 3.89 22.11 3 21 3ZM21 19H3V5H21V19Z M8 15L13 12L8 9V15Z"/>
                                    </svg>
                                    @break
                                @case(53)
                                    <!-- Suspense -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500 to-orange-600"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                                    </svg>
                                    @break
                                @case(10752)
                                    <!-- Guerra -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-gray-600 to-gray-800"></div>
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 11.99H19C18.47 16.11 15.72 19.78 12 20.93V12H5V6.3L12 3.19V11.99Z"/>
                                    </svg>
                                    @break
                                @case(37)
                                    <!-- Western -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-amber-600 to-orange-700"></div>
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
    @else
        <div class="text-center py-12 sm:py-16 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border border-slate-700">
            <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 sm:mb-6 bg-gradient-to-br from-gray-600 to-gray-700 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18 4L20 8H17L15 4H13L15 8H12L10 4H8L10 8H7L5 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V4H18Z"/>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl font-semibold mb-2 text-white">No hay géneros disponibles</h3>
            <p class="text-sm sm:text-base text-gray-400">Intenta más tarde.</p>
        </div>
    @endif
</div>
@endsection 