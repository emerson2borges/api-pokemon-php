<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

class TiposTableSeeder extends Seeder
{

    static $tipos = [
        ['normal', 'normal', 'normal', 'descrição normal', 1, 0],
        ['fogo', 'fogo', 'fire', 'descrição fogo', 1, 0],
        ['água', 'água', 'water', 'descrição água', 1, 0],
        ['grama', 'Planta', 'grass', 'descrição grama', 1, 0],
        ['voador', 'voador', 'Normal', 'descrição voador', 1, 0],
        ['lutador', 'lutador', 'Normal', 'descrição lutador', 1, 0],
        ['veneno', 'veneno', 'Normal', 'descrição veneno', 1, 0],
        ['elétrico', 'elétrico', 'Normal', 'descrição elétrico', 1, 0],
        ['terra', 'terra', 'Normal', 'descrição terra', 1, 0],
        ['pedra', 'pedra', 'Normal', 'descrição pedra', 1, 0],
        ['psíquico', 'psíquico', 'Normal', 'descrição psíquico', 1, 0],
        ['gelo', 'gelo', 'Normal', 'descrição gelo', 1, 0],
        ['inseto', 'inseto', 'Normal', 'descrição inseto', 1, 0],
        ['fantasma', 'fantasma', 'Normal', 'descrição fantasma', 1, 0],
        ['ferro', 'ferro', 'Normal', 'descrição ferro', 1, 0],
        ['dragão', 'dragão', 'Normal', 'descrição dragão', 1, 0],
        ['sombrio', 'sombrio', 'Normal', 'descrição sombrio', 1, 0],
        ['fada', 'fada', 'Normal', 'descrição fada', 1, 0],
        ['desconhecido', 'desconhecido', 'Unknow', 'descrição desconhecido', 1, 0],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$tipos as $tipo) {
            DB::table('tipos')->insert([
                'nome' => $tipo[0],
                'nome_alternativo' => $tipo[1],
                'nome_ingles' => $tipo[2],
                'descricao' => $tipo[3],
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d'),
                'ativo' => $tipo[4],
                'deletado' => $tipo[5]
            ]);
        }
    }
}
