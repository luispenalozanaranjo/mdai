<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NodosDetalle extends Migration{

    public function up(){
        Schema::create('nodos_detalle', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->integer('usuario')->nullable();
            $table->integer('estado');

            $table->unsignedBigInteger('id_dw');
            $table->unsignedBigInteger('id_nodo');

            $table->timestamps();
            $table->datetime('fecha_salida')->nullable();
        });
    }

    public function down(){
        //
    }
}
