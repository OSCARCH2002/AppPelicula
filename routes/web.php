<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return redirect()->route('movies.index');
});

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
Route::get('/movies/popular', [MovieController::class, 'popular'])->name('movies.popular');
Route::get('/movies/top-rated', [MovieController::class, 'topRated'])->name('movies.top-rated');
Route::get('/movies/now-playing', [MovieController::class, 'nowPlaying'])->name('movies.now-playing');
Route::get('/movies/upcoming', [MovieController::class, 'upcoming'])->name('movies.upcoming');
Route::get('/movies/genres', [MovieController::class, 'genres'])->name('movies.genres');
Route::get('/movies/genre/{id}/{name?}', [MovieController::class, 'genre'])->name('movies.genre');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
