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
        Schema::table('imagens_pokemons', function (BluePrint $table) {
            $table->dropForeign('imagens_pokemons_pokemon_id_foreign');
            $table->dropForeign('imagens_pokemons_imagem_id_foreign');
            $table->foreign('pokemon_id')->references('id')->on('pokemons')->onDelete('cascade');
            $table->foreign('imagem_id')->references('id')->on('imagens')->onDelete('cascade');
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
            $table->dropForeign('imagens_pokemons_pokemon_id_foreign');
            $table->dropForeign('imagens_pokemons_imagem_id_foreign');

            $table->foreign('pokemon_id')->references('id')->on('pokemons');
            $table->foreign('imagem_id')->references('id')->on('imagens');
        });
    }
};
