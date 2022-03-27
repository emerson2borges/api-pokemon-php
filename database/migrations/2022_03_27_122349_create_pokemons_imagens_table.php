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
        Schema::create('pokemons_imagens', function (Blueprint $table) {
            $table->id();
            $table->biginteger('pokemon_id');
            $table->biginteger('imagem_id');

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
        Schema::dropIfExists('pokemons_imagens');
    }
};