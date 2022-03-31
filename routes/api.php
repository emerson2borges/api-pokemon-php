<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EspecieController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\TipoController;

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
Route::get('/especie', [EspecieController::class, 'readAllEspecies']);
Route::get('/especie/{id}', [EspecieController::class, 'readOneEspecie']);
Route::put('/especie/{id}', [EspecieController::class, 'updateEspecie']);
Route::delete('/especie/{id}', [EspecieController::class, 'deleteEspecie']);

Route::post('/tipo', [TipoController::class, 'createTipo']);
Route::get('/tipo', [TipoController::class, 'readAllTipos']);
Route::get('/tipo/{id}', [TipoController::class, 'readOneTipo']);
Route::put('/tipo/{id}', [TipoController::class, 'updateTipo']);
Route::delete('/tipo/{id}', [TipoController::class, 'deleteTipo']);

