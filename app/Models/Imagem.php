<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pokemon;

class Imagem extends Model
{
    use HasFactory;

    protected $table = 'imagens';

    public function Pokemons() {
        return $this->belongsToMany(Pokemon::Class, 'imagens_pokemons', 'pokemon_id', 'imagem_id');
    }
}
