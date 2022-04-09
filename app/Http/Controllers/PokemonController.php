<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $especie_id = $request->input('especie_id');
        $pokemon_id = $request->input('pokemon_id');
        $tipo = $request->input('tipo');
        $imagem_id;

        
        //envia imagem
        if ($request->imagem) {
            $imagem_id = PokemonController::uploadImage($request);
        }

        $pokemon = new Pokemon();
        $pokemon->ordem = $ordem;
        $pokemon->nome = $nome;
        $pokemon->descricao = $descricao;
        $pokemon->peso = $peso;
        $pokemon->altura = $altura;
        $pokemon->especie_id = $especie_id;
        $pokemon->pokemon_id = $pokemon_id;

        // dd('PAROU ANTES DE SALVAR POKEMON');

        $pokemon->save();
        
        $pokemon->tipos()->attach($tipo);

        $pokemon->imagens()->attach($imagem_id);
        
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
    
    public function readOnePokemon(Request $request) {
        $array = ['error' => ''];

        $pokemon = Pokemon::find($request->id);
        $pokemon->evolucaoDe;
        $pokemon->tipos;
        $pokemon->especie;
        
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

    private function uploadImage($request) {
        $nameFile = null;
        $retorno = false;

        $name = uniqid(date('HisYmd'));
        
        $extension = $request->imagem->extension();

        $nameFile = "{$name}.{$extension}";

        $imagem_id = PokemonController::registraImageNaTabela($request, $nameFile);
        
        $upload = $request->imagem->storeAs('img_pokemons', $nameFile);
        
        if ( !$upload ) {
            return redirect()->back()->with('error', 'Falha ao fazer upload')->withInput();
        }

        return $imagem_id;
    }

    private function registraImageNaTabela($request, $nameFile) {
        $imagem_id = ImagemController::createImage($request, $nameFile);

        return $imagem_id;
    }
}
