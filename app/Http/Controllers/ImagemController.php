<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagem;

class ImagemController extends Controller
{
    public static function createImage(Request $request, $nameFile) {
        $nome = $nameFile;
        $descricao = $request->input('descricao_imagem');    
        
        $imagem = new Imagem();
        $imagem->nome = $nome;
        $imagem->descricao = $descricao;
        $imagem->ativo = true;
        $imagem->deletado = false;

        
        $imagem->save();
        
        return $imagem->id;
    }

    public function deleteImage($id) {
        $array = ['error' => ''];

        $imagem = Imagem::find($id);
        $imagem->delete();

        return $array;
    }
}
