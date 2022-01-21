<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcepcionDetalle extends Migration{

    public function up(){
        Schema::create('excepciones_detalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_nodo');
            $table->foreign('id_nodo')->references('id')->on('nodos');
            $table->unsignedBigInteger('id_excepcion');
            $table->foreign('id_excepcion')->references('id')->on('excepciones');
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->unsignedBigInteger('user_termina')->nullable();
            $table->foreign('user_termina')->references('id')->on('usuarios');
            $table->datetime('fecha_salida')->nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('excepcion_detalle');
    }
}
