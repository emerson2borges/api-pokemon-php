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

        Schema::table('pokemons_tipos', function (Blueprint $table) {
            $table->dropForeign('pokemons_tipos_pokemon_id_foreign');
            $table->foreign('pokemon_id')->references('id')->on('pokemons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pokemons_tipos', function (BluePrint $table) {
            $table->dropForeign('pokemons_tipos_pokemon_id_foreign');
            $table->foreign('pokemon_id')->references('id')->on('pokemons');
        });
    }
};
