<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EspeciesTableSeeder extends Seeder
{

    static $especies = [
        ['Semente', 'descricao', 1, 0],
        ['Lagarto', 'descricao', 1, 0],
        ['Chama', 'descricao', 1, 0],
        ['Mini Tartaruga', 'descricao', 1, 0],
        ['Tartaruga', 'descricao', 1, 0],
        ['Crustáceo', 'descricao', 1, 0],
        ['Verme', 'descricao', 1, 0],
        ['Casulo', 'descricao', 1, 0],
        ['Borboleta', 'descricao', 1, 0],
        ['Inseto Peludo', 'descricao', 1, 0],
        ['Abelha Venenosa', 'descricao', 1, 0],
        ['Mini Pássaro', 'descricao', 1, 0],
        ['Pássaro', 'descricao', 1, 0],
        ['Rato', 'descricao', 1, 0],
        ['Bico', 'descricao', 1, 0],
        ['Serpente', 'descricao', 1, 0],
        ['Cobra', 'descricao', 1, 0],
        ['Agulha Venenosa', 'descricao', 1, 0],
        ['Broca', 'descricao', 1, 0],
        ['Fada', 'descricao', 1, 0],
        ['Raposa', 'descricao', 1, 0],
        ['Balão', 'descricao', 1, 0],
        ['Morcego', 'descricao', 1, 0],
        ['Erva Daninha', 'descricao', 1, 0],
        ['Flor', 'descricao', 1, 0],
        ['Cogumelo', 'descricao', 1, 0],
        ['Inseto', 'descricao', 1, 0],
        ['Mariposa Venenosa', 'descricao', 1, 0],
        ['Toupeira', 'descricao', 1, 0],
        ['Gato Arranhão', 'descricao', 1, 0],
        ['Gato Superior', 'descricao', 1, 0],
        ['Pato', 'descricao', 1, 0],
        ['Macaco-Porco', 'descricao', 1, 0],
        ['Cachorrinho', 'descricao', 1, 0],
        ['Escoteiro', 'descricao', 1, 0],
        ['Lendário', 'descricao', 1, 0],
        ['Girino', 'descricao', 1, 0],
        ['Psíquico', 'descricao', 1, 0],
        ['Super Poder', 'descricao', 1, 0],
        ['Papa-Mosca', 'descricao', 1, 0],
        ['Água-Viva', 'descricao', 1, 0],
        ['Rocha', 'descricao', 1, 0],
        ['Megaton', 'descricao', 1, 0],
        ['Cavalo de Fogo', 'descricao', 1, 0],
        ['Chifre Único', 'descricao', 1, 0],
        ['Pateta', 'descricao', 1, 0],
        ['Bernado-Eremita', 'descricao', 1, 0],
        ['Imã', 'descricao', 1, 0],
        ['Pato Selvagem', 'descricao', 1, 0],
        ['Passáros Gêmeos', 'descricao', 1, 0],
        ['Passáro Triplo', 'descricao', 1, 0],
        ['Leão Marinho', 'descricao', 1, 0],
        ['Lodo', 'descricao', 1, 0],
        ['Bivalve', 'descricao', 1, 0],
        ['Gás', 'descricao', 1, 0],
        ['Sombra', 'descricao', 1, 0],
        ['Cobra de Rocha', 'descricao', 1, 0],
        ['Hipnose', 'descricao', 1, 0],
        ['Caranguejo de Rio', 'descricao', 1, 0],
        ['Pinça', 'descricao', 1, 0],
        ['Bola', 'descricao', 1, 0],
        ['Esfera', 'descricao', 1, 0],
        ['Ovo', 'descricao', 1, 0],
        ['Coco', 'descricao', 1, 0],
        ['Solitário', 'descricao', 1, 0],
        ['Guarda-Ossos', 'descricao', 1, 0],
        ['Chutador', 'descricao', 1, 0],
        ['Socador', 'descricao', 1, 0],
        ['Lambedor', 'descricao', 1, 0],
        ['Gás Venenoso', 'descricao', 1, 0],
        ['Espinhos', 'descricao', 1, 0],
        ['Vinha', 'descricao', 1, 0],
        ['Materno', 'descricao', 1, 0],
        ['Dragão', 'descricao', 1, 0],
        ['Peixe-Dourado', 'descricao', 1, 0],
        ['Forma de Estrela', 'descricao', 1, 0],
        ['Misterioso', 'descricao', 1, 0],
        ['Barreira', 'descricao', 1, 0],
        ['Dançante', 'descricao', 1, 0],
        ['Louva-a-Deus', 'descricao', 1, 0],
        ['Forma Humana', 'descricao', 1, 0],
        ['Elétrico', 'descricao', 1, 0],
        ['Cuspidor de Fogo', 'descricao', 1, 0],
        ['Besouro Lucano', 'descricao', 1, 0],
        ['Touro Selvagem', 'descricao', 1, 0],
        ['Peixe', 'descricao', 1, 0],
        ['Atroz', 'descricao', 1, 0],
        ['Transporte', 'descricao', 1, 0],
        ['Transformação', 'descricao', 1, 0],
        ['Evolução', 'descricao', 1, 0],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$especies as $especie) {

            DB::table('especies')->insert([
                'nome' => $especie[0],
                'descricao' => $especie[1],
                'ativo' => $especie[2],
                'deletado' => $especie[3],
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ]);
        };
    }
}
