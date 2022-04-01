<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipos';

    public function pokemons() {
        return $this->belongsToMany(Pokemon::Class, 'pokemons_tipos', 'tipo_id', 'pokemon_id');
    }

}
