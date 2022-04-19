<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Pokemon;
use App\Models\Tipo;
use App\Models\Imagem;

class PokemonController extends Controller
{

    public function createPokemon(Request $request) {
        $array = ['error' => ''];

        $rules = [
            'nome' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $ordem = $request->input('ordem');
        $nome = $request->input('nome');
        $descricao = $request->input('descricao');
        $peso = $request->input('peso');
        $altura = $request->input('altura');
        $especieId = $request->input('especie_id');
        $pokemonId = $request->input('pokemon_id');
        $tipo = $request->input('tipo');
        $imagem_id;


        DB::beginTransaction();
        // envia imagem
        if ($request->imagem) {
            $imagem_id = ImagemController::uploadImage($request);
        }

        $pokemon = new Pokemon();
        $pokemon->ordem = $ordem;
        $pokemon->nome = $nome;
        $pokemon->descricao = $descricao;
        $pokemon->peso = $peso;
        $pokemon->altura = $altura;
        $pokemon->especie_id = $especieId;
        $pokemon->pokemon_id = $pokemonId;


        try {
            $pokemon->save();
            $pokemon->tipos()->attach($tipo);
            $pokemon->imagens()->attach($imagem_id);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            $array['error'] = $ex;
        }

        return $array;
    }

    public function readAllPokemons() {
        $pokemonsList = Pokemon::get();

        foreach ($pokemonsList as $pokemon) {
            $pokemon->imagens;
        }

        if (sizeof($pokemonsList) >= 1) {
            return $pokemonsList;
        }
        return 'Nenhum pokemon encontrado';
    }

    public function readOnePokemon(Request $request) {
        $array = ['error' => ''];

        $pokemon = Pokemon::find($request->id);
        $pokemon->evolucaoDe;
        $pokemon->tipos;
        $pokemon->especie;
        $pokemon->imagens;

        if ($pokemon) {
            $array['pokemon'] = $pokemon;
        } else {
            $array['error'] = 'O pokemon buscado não existe';
        };

        return $array;
    }

    public function readAllPokemonsByTipo(Request $request) {
        $pokemonsByTipo = Tipo::find($request->id)->pokemons;
    }

    public function updatePokemon(Request $request, $id) {
        $array = ['error' => ''];

        //VALIDANDO
        $rules = [
            'ativo' => 'boolean',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $ordem = $request->input('ordem');
        $nome = $request->input('nome');
        $descricao = $request->input('descricao');
        $peso = $request->input('peso');
        $altura = $request->input('altura');
        $ativo = $request->input('ativo');
        $deletado = $request->input('deletado');
        $especie_id = $request->input('especie_id');
        $pokemon_id = $request->input('pokemon_id');

        //ATUALIZANDO
        $pokemon = Pokemon::find($id);

        DB::beginTransaction();
        try{
            if ($pokemon) {
                if ($ordem) {
                    $pokemon->ordem = $ordem;
                }
                if ($nome) {
                    $pokemon->nome = $nome;
                }
                if ($descricao) {
                    $pokemon->descricao = $descricao;
                }
                if ($altura) {
                    $pokemon->altura = $altura;
                }
                if ($peso) {
                    $pokemon->peso = $peso;
                }
                if ($ativo !== NULL) {
                    $pokemon->ativo = $ativo;
                }
                if ($deletado !== NULL) {
                    $pokemon->deletado = $deletado;
                }
                if ($especie_id !== NULL) {
                    $pokemon->especie_id = $especie_id;
                }
                if ($pokemon_id !== NULL) {
                    $pokemon->pokemon_id = $pokemon_id;
                }
                $pokemon->save();
                DB::commit();
            } else {
                DB::rollback();
                $array['error'] = 'O pokemon buscado não existe';
            };
        } catch (QueryException $ex) {
            DB::rollback();
            $array['error'] = $ex;
        }

        return $array;
    }

    public function deletePokemon($id) {
        $array = ['error' => ''];

        $pokemon = Pokemon::find($id);
        $pokemon->imagens;
        $pokemon->imagens()->delete();
        ImagemController::deleteImageFile($pokemon);
        $pokemon->delete();

        return $array;
    }

}
