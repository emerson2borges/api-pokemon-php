<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagens_pokemons', function (Blueprint $table) {
            $table->foreign('pokemon_id')->references('id')->on('pokemons');
            $table->foreign('imagem_id')->references('id')->on('imagens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagens_pokemons', function (BluePrint $table) {
            $table->dropForeign('pokemons_imagens_pokemon_id_foreign');
            $table->dropForeign('pokemons_imagens_imagem_id_foreign');
        });
    }
};
