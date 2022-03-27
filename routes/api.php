<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

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

Route::post('/pokemon', [ApiController::class, 'createPokemon']);
Route::get('/pokemon', [ApiController::class, 'readAllPokemons']);
Route::get('/pokemon/{id}', [ApiController::class, 'readOnePokemon']);
Route::put('/pokemon/{id}', [ApiController::class, 'updatePokemon']);
Route::delete('/pokemon/{id}', [ApiController::class, 'deletePokemon']);