<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Especie;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons';

    public function especie() {
        return $this->hasOne(Especie::class, 'id', 'especie_id');
    }
}
