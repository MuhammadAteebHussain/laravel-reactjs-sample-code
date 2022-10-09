<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('film', [FilmController::class, 'index']);
Route::get('film/list', [FilmController::class, 'getAllFilms']);
Route::get('country/list', [FilmController::class, 'getFilmCountries']);
Route::get('film/{slug}', [FilmController::class, 'showBySlug']);
Route::post('user/register', [UserController::class, 'store']);
Route::post('user/login', [UserController::class, 'login']);
Route::post('film/store', [FilmController::class, 'store']);
Route::get('comment/{film_id}', [CommentController::class, 'getCommentsByFilmId']);

Route::middleware('auth:api')->group(function () {
    Route::post('genre/store', [GenreController::class, 'store']);    
    Route::post('comment/store', [CommentController::class, 'store']);
});
Route::get('genre/list', [GenreController::class, 'list']);


