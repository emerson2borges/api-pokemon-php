<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

use App\Models\Tipo;


class TipoController extends Controller
{
    public function createTipo(Request $request) {
        $array = ['error' => ''];

        $rules = [
            'nome' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }
        
        $nome = $request->input('nome');
        $nome_alternativo = $request->input('nome_alternativo');
        $nome_ingles = $request->input('nome_ingles');
        $descricao = $request->input('descricao');
        $ativo = $request->input('ativo');
        
        $tipo = new Tipo();
        $tipo->nome = $nome;
        $tipo->nome_alternativo = $nome_alternativo;
        $tipo->nome_ingles = $nome_ingles;
        $tipo->descricao = $descricao;
        $tipo->save();
        
        return $array;
    }
    
    public function readAllTipos() {
        $array = ['error' => ''];

        $tiposList = Tipo::all();
        if (sizeof($tiposList) >= 1) {
            $array['list'] = $tiposList;
        } else {
            $array['error'] = 'Nenhum tipo encontrado';
        }

        return $array;
    }
    
    public function readOneTipo(Request $request) {
        $array = ['error' => ''];

        $tipo = Tipo::find($request->id);

        
        if ($tipo) {
            $array['tipo'] = $tipo->especie;
        } else {
            $array['error'] = 'O tipo buscado não existe';
        };

        return $array;
    }

    public function updateTipo(Request $request, $id) {
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
        
        $nome = $request->input('nome');
        $nome_alternativo = $request->input('nome_alternativo');
        $nome_ingles = $request->input('nome_ingles');
        $descricao = $request->input('descricao');
        $ativo = $request->input('ativo');
        $deletado = $request->input('deletado');
        $updated = Carbon::now()->format('Y-m-d');


        //ATUALIZANDO
        $tipo = Tipo::find($id);

        if ($tipo) {
            if ($nome) {
                $tipo->nome = $nome;
            }
            if ($nome_alternativo) {
                $tipo->nome_alternativo = $nome_alternativo;
            }
            if ($nome_ingles) {
                $tipo->nome_ingles = $nome_ingles;
            }
            if ($descricao) {
                $tipo->descricao = $descricao;
            }
            if ($ativo !== NULL) {
                $tipo->ativo = $ativo;
            }
            if ( $deletado !== NULL) {
                $tipo->deletado = $deletado;
            }
            // $updated->updated = $updated;
            $tipo->save();
        } else {
            $array['error'] = 'O pokemon buscado não existe';
        };

        return $array;
    }

    public function deleteTipo($id) {
        $array = ['error' => ''];

        $tipo = Tipo::find($id);
        $tipo->delete();

        return $array;
    }
}
