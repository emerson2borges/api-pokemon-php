<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Especie;
use App\Models\Tipo;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons';

    public function especie() {
        return $this->hasOne(Especie::class, 'id', 'especie_id');
    }

    public function evolucaoDe() {
        return $this->hasOne(Pokemon::class, 'id', 'pokemon_id');
    }

    public function tipos() {
        return $this->belongsToMany(Tipo::class, 'pokemons_tipos', 'pokemon_id', 'tipo_id');
    }

    public function imagens() {
        return $this->belongsToMany(Imagem::Class, 'imagens_pokemons', 'pokemon_id', 'imagem_id');
    }
}
