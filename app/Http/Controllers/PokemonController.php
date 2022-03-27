<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Pokemon;

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
        $especie_id = $request->input('especie_id');
        $evolucao_pokemon_id = $request->input('evolucao_pokemon_id');

        $pokemon = new Pokemon();
        $pokemon->ordem = $ordem;
        $pokemon->nome = $nome;
        $pokemon->descricao = $descricao;
        $pokemon->peso = $peso;
        $pokemon->altura = $altura;
        $pokemon->especie_id = $especie_id;
        $pokemon->evolucao_pokemon_id = $evolucao_pokemon_id;
        $pokemon->save();
        
        return $array;
    }

    public function readAllPokemons() {
        $array = ['error' => ''];

        $pokemonsList = Pokemon::all();
        if (sizeof($pokemonsList) >= 1) {
            $array['list'] = $pokemonsList;
        } else {
            $array['error'] = 'Nenhum pokemon encontrado';
        }

        return $array;
    }
    
    public function readOnePokemon($id) {
        $array = ['error' => ''];

        $pokemon = Pokemon::find($id);

        if ($pokemon) {
            $array['pokemon'] = $pokemon;
        } else {
            $array['error'] = 'O pokemon buscado não existe';
        };

        return $array;
    }
    
    public function updatePokemon(Request $request, $id) {
        $array = ['error' => ''];

        //VALIDANDO
        $rules = [
            'ativo' => 'boolean'
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
        $evolucao_pokemon_id->input('evolucao_pokemon_id');

        //ATUALIZANDO
        $pokemon = Pokemon::find($id);

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
            if ( $deletado !== NULL) {
                $pokemon->deletado = $deletado;
            }
            if ( $especie_id !== NULL) {
                $pokemon->especie_id = $especie_id;
            }
            if ( $evolucao_pokemon_id !== NULL) {
                $pokemon->evolucao_pokemon_id = $evolucao_pokemon_id;
            }
            $pokemon->save();
        } else {
            $array['error'] = 'O pokemon buscado não existe';
        };

        return $array;
    }

    public function deletePokemon($id) {
        $array = ['error' => ''];

        $pokemon = Pokemon::find($id);
        $pokemon->delete();

        return $array;
    }
}
