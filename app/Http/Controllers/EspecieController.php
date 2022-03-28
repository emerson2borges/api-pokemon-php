<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Especie;

class EspecieController extends Controller
{
    public function createEspecie (Request $request) {
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
        $descricao = $request->input('descricao');

        $especie = new Especie();
        $especie->nome = $nome;
        $especie->descricao = $descricao;
        $especie->save();

        return $array;
    }

    public function readAllEspecies() {
        $array = ['error' => ''];

        $especiesList = Especie::all();
        if (sizeof($especiesList) >= 1) {
            $array['list'] = $especiesList;
        } else {
            $array['error'] = 'Nenhuma espécie encontrada';
        }

        return $array;
    }

    public function readOneEspecie($id) {
        $array = ['error' => ''];

        $especie = Especie::find($id);
        if ($especie) {
            $array['especie'] = $especie;
        } else {
            $array['error'] = 'A especie não foi encontrada';
        }

        return $array;
    }

    public function updateEspecie(Request $request, $id) {
        $array = ['error'=> ''];

        // VALIDANDO
        $rules = [
            'nome' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $nome = $request->input('nome');
        $descricao = $request->input('descricao');
        $altura = $request->input('altura');
        $ativo = $request->input('ativo');
        $deletado = $request->input('deletado');

        // ATUALIZANDO
        $especie = Especie::find($id);
        if ($especie) {
            if ($nome) {
                $especie->nome = $nome;
            }
            if ($descricao) {
                $especie->descricao = $descricao;
            }
            if ($ativo !== NULL) {
                $especie->ativo = $ativo;
            }
            if ( $deletado !== NULL) {
                $especie->deletado = $deletado;
            }
            $especie->save();
        } else {
            $array['error'] = 'A espécie buscada não foi encontrada';
        };

        return $array;
    }

    public function deleteEspecie($id) {
        $array = ['error' => ''];

        $especie = Especie::find($id);
        $especie->delete();

        return $array;
    }
}
