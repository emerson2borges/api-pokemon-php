<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EspecieController;
use App\Http\Controllers\PokemonController;

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

Route::post('/pokemon', [PokemonController::class, 'createPokemon']);
Route::get('/pokemon', [PokemonController::class, 'readAllPokemons']);
Route::get('/pokemon/{id}', [PokemonController::class, 'readOnePokemon']);
Route::put('/pokemon/{id}', [PokemonController::class, 'updatePokemon']);
Route::delete('/pokemon/{id}', [PokemonController::class, 'deletePokemon']);

Route::post('/especie', [EspecieController::class, 'createEspecie']);
Route::get('/especie', [PokemonController::class, 'readAllEspecies']);
Route::get('/especie/{id}', [PokemonController::class, 'readOneEspecie']);
Route::put('/especie/{id}', [PokemonController::class, 'updateEspecie']);
Route::delete('/especie/{id}', [PokemonController::class, 'deleteEspecie']);

