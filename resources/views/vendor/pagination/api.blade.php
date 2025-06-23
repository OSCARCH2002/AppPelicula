@if ($paginator->hasPages())
    <nav class="flex flex-col sm:flex-row items-center justify-between gap-4 sm:gap-0 mt-6 sm:mt-8">
        <div class="flex items-center text-xs sm:text-sm text-gray-400 text-center sm:text-left">
            <span>
                Mostrando página {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }} 
                <span class="hidden sm:inline">({{ number_format($paginator->total()) }} películas en total)</span>
                <span class="sm:hidden">({{ number_format($paginator->total()) }} total)</span>
            </span>
        </div>

        <div class="flex items-center space-x-1 sm:space-x-2">
            {{-- Botón Anterior --}}
            @if ($paginator->currentPage() > 1)
                <a href="{{ request()->fullUrlWithQuery(['page' => $paginator->currentPage() - 1]) }}" 
                   class="px-2 sm:px-4 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors text-xs sm:text-sm">
                    <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Anterior</span>
                </a>
            @else
                <span class="px-2 sm:px-4 py-2 bg-slate-800 text-gray-500 rounded-lg cursor-not-allowed text-xs sm:text-sm">
                    <i class="fas fa-chevron-left mr-1"></i> <span class="hidden sm:inline">Anterior</span>
                </span>
            @endif

            {{-- Números de Página --}}
            <div class="flex items-center space-x-1">
                @php
                    $start = max(1, $paginator->currentPage() - 2);
                    $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
                @endphp

                {{-- Primera página --}}
                @if ($start > 1)
                    <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}" 
                       class="px-2 sm:px-3 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors text-xs sm:text-sm">
                        1
                    </a>
                    @if ($start > 2)
                        <span class="px-1 sm:px-2 text-gray-400 text-xs sm:text-sm">...</span>
                    @endif
                @endif

                {{-- Páginas del medio --}}
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $paginator->currentPage())
                        <span class="px-2 sm:px-3 py-2 bg-cyan-500 text-white rounded-lg text-xs sm:text-sm">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" 
                           class="px-2 sm:px-3 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors text-xs sm:text-sm">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                {{-- Última página --}}
                @if ($end < $paginator->lastPage())
                    @if ($end < $paginator->lastPage() - 1)
                        <span class="px-1 sm:px-2 text-gray-400 text-xs sm:text-sm">...</span>
                    @endif
                    <a href="{{ request()->fullUrlWithQuery(['page' => $paginator->lastPage()]) }}" 
                       class="px-2 sm:px-3 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors text-xs sm:text-sm">
                        {{ $paginator->lastPage() }}
                    </a>
                @endif
            </div>

            {{-- Botón Siguiente --}}
            @if ($paginator->currentPage() < $paginator->lastPage())
                <a href="{{ request()->fullUrlWithQuery(['page' => $paginator->currentPage() + 1]) }}" 
                   class="px-2 sm:px-4 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors text-xs sm:text-sm">
                    <span class="hidden sm:inline">Siguiente</span> <i class="fas fa-chevron-right ml-1"></i>
                </a>
            @else
                <span class="px-2 sm:px-4 py-2 bg-slate-800 text-gray-500 rounded-lg cursor-not-allowed text-xs sm:text-sm">
                    <span class="hidden sm:inline">Siguiente</span> <i class="fas fa-chevron-right ml-1"></i>
                </span>
            @endif
        </div>
    </nav>
@endif 