<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorAPIController;
use App\Http\Controllers\MovieAPIController;
use App\Http\Controllers\DirectorAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/movies', [MovieAPIController::class, 'index'])->name('moviesM');
Route::post('/movies', [MovieAPIController::class, 'store'])->name('createM');
Route::get('/movies/{id}', [MovieAPIController::class, 'show'])->name('movieM');
Route::patch('/movies/{id}', [MovieAPIController::class, 'update'])->name('updateM');
Route::delete('/movies/{id}', [MovieAPIController::class, 'destroy'])->name('deleteM');
Route::get('/movies/{id}/actors', [MovieAPIController::class, 'actors'])->name('actorsM');
Route::post('/movies/{id}/actors', [MovieAPIController::class, 'actorInMovies'])->name('actorInMovies');
Route::get('/movies/{id}/director', [MovieAPIController::class, 'director'])->name('directorM');

Route::get('/directors', [DirectorAPIController::class, 'index'])->name('directorsD');
Route::post('/directors', [DirectorAPIController::class, 'store'])->name('createD');
Route::get('/directors/{id}', [DirectorAPIController::class, 'show'])->name('directorD');
Route::patch('/directors/{id}', [DirectorAPIController::class, 'update'])->name('updateD');
Route::delete('/directors/{id}', [DirectorAPIController::class, 'destroy'])->name('deleteD');
Route::get('/directors/{id}/movies', [DirectorAPIController::class, 'movies'])->name('moviesD');

Route::get('/actors', [ActorAPIController::class, 'index'])->name('actorsA');
Route::post('/actors', [ActorAPIController::class, 'store'])->name('createA');
Route::get('/actors/{id}', [ActorAPIController::class, 'show'])->name('actorA');
Route::patch('/actors/{id}', [ActorAPIController::class, 'update'])->name('updateA');
Route::delete('/actors/{id}', [ActorAPIController::class, 'destroy'])->name('deleteA');
Route::get('/actors/{id}/movies', [ActorAPIController::class, 'movies'])->name('moviesA');

