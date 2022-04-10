<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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
        $imagemId;

        
        DB::beginTransaction();
        // envia imagem
        if ($request->imagem) {
            $imagemId = PokemonController::uploadImage($request);
        }

        $pokemon = new Pokemon();
        $pokemon->ordem = $ordem;
        $pokemon->nome = $nome;
        $pokemon->descricao = $descricao;
        $pokemon->peso = $peso;
        $pokemon->altura = $altura;
        $pokemon->especieId = $especieId;
        $pokemon->pokemonId = $pokemonId;

        try {
            $pokemon->save();
            $pokemon->tipos()->attach($tipo);
            $pokemon->imagens()->attach($imagemId);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            $array['error'] = $ex;
        }

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
        $especieId = $request->input('especie_id');
        $pokemonId->input('pokemon_id');

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
            if ( $especieId !== NULL) {
                $pokemon->especieId = $especieId;
            }
            if ( $pokemonId !== NULL) {
                $pokemon->pokemonId = $pokemonId;
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
        $pokemon->imagens;
        $pokemon->delete();
        $pokemon->imagens()->delete();
        
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
        $imagemId = ImagemController::createImage($request, $nameFile);

        return $imagemId;
    }
}
