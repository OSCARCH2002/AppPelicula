<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Helpers\ApiPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    private $apiKey;
    private $baseUrl = 'https://api.themoviedb.org/3';

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
        
        // Compartir géneros con todas las vistas
        $this->shareGenresWithAllViews();
    }

    private function shareGenresWithAllViews()
    {
        $genres = Cache::remember('movie_genres_global', 86400, function () {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . '/genre/movie/list', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES'
                ]);

                if ($response->successful()) {
                    // Leer el contenido una sola vez
                    return $response->json()['genres'] ?? [];
                }

                Log::warning('Error obteniendo géneros de TMDB', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [];
            } catch (\Exception $e) {
                Log::error('Excepción al obtener géneros de TMDB', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return [];
            }
        });

        // Compartir con todas las vistas
        view()->share('allGenres', $genres);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener películas de diferentes categorías desde la API
        $popularMovies = Cache::remember('home_popular_movies', 3600, function () {
            return $this->fetchMoviesFromApi('/movie/popular', 1);
        });

        $topRatedMovies = Cache::remember('home_top_rated_movies', 3600, function () {
            return $this->fetchMoviesFromApi('/movie/top_rated', 1);
        });

        $nowPlayingMovies = Cache::remember('home_now_playing_movies', 3600, function () {
            return $this->fetchMoviesFromApi('/movie/now_playing', 1);
        });

        $upcomingMovies = Cache::remember('home_upcoming_movies', 3600, function () {
            return $this->fetchMoviesFromApi('/movie/upcoming', 1);
        });

        // Obtener películas guardadas localmente para la sección "Tu Colección"
        $savedMovies = Movie::latest()->take(6)->get();

        // Obtener algunos géneros populares para mostrar en el inicio
        $popularGenres = Cache::remember('popular_genres', 86400, function () {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . '/genre/movie/list', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES'
                ]);

                if ($response->successful()) {
                    $allGenres = $response->json()['genres'];
                    // Filtrar solo géneros populares (Acción, Comedia, Terror, Drama, etc.)
                    $popularGenreIds = [28, 35, 27, 18, 12, 14, 10749, 878, 80, 16];
                    return array_filter($allGenres, function($genre) use ($popularGenreIds) {
                        return in_array($genre['id'], $popularGenreIds);
                    });
                }

                return [];
            } catch (\Exception $e) {
                Log::error('Error obteniendo géneros populares', [
                    'message' => $e->getMessage()
                ]);
                return [];
            }
        });

        return view('movies.index', compact(
            'popularMovies', 
            'topRatedMovies', 
            'nowPlayingMovies', 
            'upcomingMovies',
            'savedMovies',
            'popularGenres'
        ));
    }

    /**
     * Método auxiliar para obtener películas de la API con mejor manejo de errores
     */
    private function fetchMoviesFromApi($endpoint, $page = 1)
    {
        try {
            $response = Http::timeout(10)->get($this->baseUrl . $endpoint, [
                'api_key' => $this->apiKey,
                'language' => 'es-ES',
                'page' => $page
            ]);

            if ($response->successful()) {
                return $response->json()['results'];
            }

            Log::warning('Error obteniendo películas de TMDB', [
                'endpoint' => $endpoint,
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return [];
        } catch (\Exception $e) {
            Log::error('Excepción al obtener películas de TMDB', [
                'endpoint' => $endpoint,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return [];
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::where('vidapi_id', $id)->first();
        
        if (!$movie) {
            // Buscar en la API y guardar en la base de datos
            $movie = $this->fetchAndSaveMovie($id);
        }

        if (!$movie) {
            abort(404);
        }

        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        if (!$query) {
            return redirect()->route('movies.index');
        }

        $page = $request->get('page', 1);
        $cacheKey = 'search_' . md5($query) . '_page_' . $page;
        
        $response = Cache::remember($cacheKey, 1800, function () use ($query, $page) {
            try {
                return Http::timeout(10)->get($this->baseUrl . '/search/movie', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES',
                    'query' => $query,
                    'page' => $page
                ]);
            } catch (\Exception $e) {
                Log::error('Error en búsqueda de películas', [
                    'query' => $query,
                    'page' => $page,
                    'message' => $e->getMessage()
                ]);
                return null;
            }
        });

        if ($response && $response->successful()) {
            $data = $response->json();
            $movies = $data['results'];
            $totalPages = $data['total_pages'];
            $currentPage = $data['page'];
            $totalResults = $data['total_results'];
            
            $paginator = new ApiPaginator($currentPage, $totalPages, $totalResults);
        } else {
            $movies = [];
            $paginator = new ApiPaginator(1, 0, 0);
        }

        return view('movies.search', compact('movies', 'query', 'paginator'));
    }

    public function popular(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'popular_movies_page_' . $page;
        
        $data = Cache::remember($cacheKey, 3600, function () use ($page) {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . '/movie/popular', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES',
                    'page' => $page
                ]);
                if ($response->successful()) {
                    // Leer el contenido una sola vez y devolverlo como array
                    return $response->json();
                }
                return null;
            } catch (\Exception $e) {
                Log::error('Error en petición popular movies', [
                    'page' => $page,
                    'message' => $e->getMessage()
                ]);
                return null;
            }
        });

        if ($data) {
            $movies = $data['results'] ?? [];
            $totalPages = $data['total_pages'] ?? 0;
            $currentPage = $data['page'] ?? 1;
            $totalResults = $data['total_results'] ?? 0;
            $paginator = new ApiPaginator($currentPage, $totalPages, $totalResults);
        } else {
            $movies = [];
            $paginator = new ApiPaginator(1, 0, 0);
        }

        return view('movies.popular', compact('movies', 'paginator'));
    }

    public function topRated(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'top_rated_movies_page_' . $page;
        
        $data = Cache::remember($cacheKey, 3600, function () use ($page) {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . '/movie/top_rated', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES',
                    'page' => $page
                ]);
                if ($response->successful()) {
                    return $response->json();
                }
                return null;
            } catch (\Exception $e) {
                Log::error('Error en petición top rated movies', [
                    'page' => $page,
                    'message' => $e->getMessage()
                ]);
                return null;
            }
        });

        if ($data) {
            $movies = $data['results'] ?? [];
            $totalPages = $data['total_pages'] ?? 0;
            $currentPage = $data['page'] ?? 1;
            $totalResults = $data['total_results'] ?? 0;
            $paginator = new ApiPaginator($currentPage, $totalPages, $totalResults);
        } else {
            $movies = [];
            $paginator = new ApiPaginator(1, 0, 0);
        }

        return view('movies.top-rated', compact('movies', 'paginator'));
    }

    public function nowPlaying(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'now_playing_movies_page_' . $page;
        
        $data = Cache::remember($cacheKey, 3600, function () use ($page) {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . '/movie/now_playing', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES',
                    'page' => $page
                ]);
                if ($response->successful()) {
                    // Leer el contenido una sola vez y devolverlo como array
                    return $response->json();
                }
                return null;
            } catch (\Exception $e) {
                Log::error('Error en petición now playing movies', [
                    'page' => $page,
                    'message' => $e->getMessage()
                ]);
                return null;
            }
        });

        if ($data) {
            $movies = $data['results'] ?? [];
            $totalPages = $data['total_pages'] ?? 0;
            $currentPage = $data['page'] ?? 1;
            $totalResults = $data['total_results'] ?? 0;
            $paginator = new ApiPaginator($currentPage, $totalPages, $totalResults);
        } else {
            $movies = [];
            $paginator = new ApiPaginator(1, 0, 0);
        }

        return view('movies.now-playing', compact('movies', 'paginator'));
    }

    public function upcoming(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'upcoming_movies_page_' . $page;
        
        $data = Cache::remember($cacheKey, 3600, function () use ($page) {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . '/movie/upcoming', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES',
                    'page' => $page
                ]);
                if ($response->successful()) {
                    return $response->json();
                }
                return null;
            } catch (\Exception $e) {
                Log::error('Error en petición upcoming movies', [
                    'page' => $page,
                    'message' => $e->getMessage()
                ]);
                return null;
            }
        });

        if ($data) {
            $movies = $data['results'] ?? [];
            $totalPages = $data['total_pages'] ?? 0;
            $currentPage = $data['page'] ?? 1;
            $totalResults = $data['total_results'] ?? 0;
            $paginator = new ApiPaginator($currentPage, $totalPages, $totalResults);
        } else {
            $movies = [];
            $paginator = new ApiPaginator(1, 0, 0);
        }

        return view('movies.upcoming', compact('movies', 'paginator'));
    }

    public function genres()
    {
        $cacheKey = 'movie_genres';
        
        $genres = Cache::remember($cacheKey, 86400, function () {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . '/genre/movie/list', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES'
                ]);

                if ($response->successful()) {
                    // Leer el contenido una sola vez
                    return $response->json()['genres'] ?? [];
                }

                return [];
            } catch (\Exception $e) {
                Log::error('Error obteniendo géneros', [
                    'message' => $e->getMessage()
                ]);
                return [];
            }
        });

        return view('movies.genres', compact('genres'));
    }

    public function genre($id, $name = null, Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'genre_movies_' . $id . '_page_' . $page;
        
        $response = Cache::remember($cacheKey, 3600, function () use ($id, $page) {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . '/discover/movie', [
                    'api_key' => $this->apiKey,
                    'language' => 'es-ES',
                    'with_genres' => $id,
                    'sort_by' => 'popularity.desc',
                    'page' => $page
                ]);

                if ($response->successful()) {
                    // Leer el contenido una sola vez y devolverlo como array
                    return $response->json();
                }

                return null;
            } catch (\Exception $e) {
                Log::error('Error en petición genre movies', [
                    'genre_id' => $id,
                    'page' => $page,
                    'message' => $e->getMessage()
                ]);
                return null;
            }
        });

        if ($response) {
            $movies = $response['results'] ?? [];
            $totalPages = $response['total_pages'] ?? 0;
            $currentPage = $response['page'] ?? 1;
            $totalResults = $response['total_results'] ?? 0;
            
            $paginator = new ApiPaginator($currentPage, $totalPages, $totalResults);
        } else {
            $movies = [];
            $paginator = new ApiPaginator(1, 0, 0);
        }

        // Obtener el nombre del género si no se proporciona
        if (!$name) {
            $genres = Cache::remember('movie_genres', 86400, function () {
                try {
                    $response = Http::timeout(10)->get($this->baseUrl . '/genre/movie/list', [
                        'api_key' => $this->apiKey,
                        'language' => 'es-ES'
                    ]);

                    if ($response->successful()) {
                        // Leer el contenido una sola vez
                        return $response->json()['genres'] ?? [];
                    }

                    return [];
                } catch (\Exception $e) {
                    Log::error('Error obteniendo géneros para nombre', [
                        'message' => $e->getMessage()
                    ]);
                    return [];
                }
            });

            $genre = collect($genres)->firstWhere('id', $id);
            $name = $genre['name'] ?? 'Género';
        }

        return view('movies.genre', compact('movies', 'name', 'id', 'paginator'));
    }

    private function fetchAndSaveMovie($id)
    {
        try {
            $response = Http::timeout(10)->get($this->baseUrl . '/movie/' . $id, [
                'api_key' => $this->apiKey,
                'language' => 'es-ES'
            ]);

            if ($response->successful()) {
                $movieData = $response->json();
                
                return Movie::updateOrCreate(
                    ['vidapi_id' => $id],
                    [
                        'title' => $movieData['title'],
                        'description' => $movieData['overview'],
                        'poster_path' => $movieData['poster_path'],
                        'backdrop_path' => $movieData['backdrop_path'],
                        'release_date' => $movieData['release_date'],
                        'vote_average' => $movieData['vote_average'],
                        'vote_count' => $movieData['vote_count'],
                        'original_language' => $movieData['original_language'],
                        'original_title' => $movieData['original_title'],
                        'adult' => $movieData['adult'],
                        'popularity' => $movieData['popularity'],
                        'media_type' => 'movie'
                    ]
                );
            }

            Log::warning('Error obteniendo película de TMDB', [
                'movie_id' => $id,
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Excepción al obtener película de TMDB', [
                'movie_id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }
}
