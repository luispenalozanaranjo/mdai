<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nodos extends Migration{

    public function up(){
        Schema::create('nodos', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->integer('num_nodo')->unsigned()->unique();
            $table->string('nombre_nodo', 45);
            $table->string('actividad', 45);
            $table->string('subactividad', 45);
            $table->integer('num_nodo_salida');
            $table->integer('etapa');
        });
    }

    public function down(){
        //
    }
}
