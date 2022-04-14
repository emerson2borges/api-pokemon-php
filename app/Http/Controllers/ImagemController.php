<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagem;

class ImagemController extends Controller
{
    private static function createImage(Request $request, $nameFile) {
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

    public static function uploadImage($request) {
        $nameFile = null;
        $retorno = false;

        $name = uniqid(date('HisYmd'));
        
        $extension = $request->imagem->extension();

        $nameFile = "{$name}.{$extension}";

        $imagemId = ImagemController::createImage($request, $nameFile);
        
        $upload = $request->imagem->storeAs('img_pokemons', $nameFile);
        
        if ( !$upload ) {
            return redirect()->back()->with('error', 'Falha ao fazer upload')->withInput();
        }

        return $imagemId;
    }

    private static function deleteImageFile($pokemon) {
        $array = ['error' => ''];

        foreach ($pokemon->imagens as $pokemon) {
            // Deleta o arquivo da imagem
            Storage::delete("img_pokemons/$pokemon->nome");
        }

        // Em caso de falhas redireciona o usuário de vola e informa que não foi possível deletar
        return redirect()->back()->with('error', 'Falha ao deletar!');
    }
}
