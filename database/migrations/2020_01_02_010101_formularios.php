<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Formularios extends Migration{

    public function up(){
        Schema::create('formularios', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('tipo', 100)->nullable();
            $table->integer('etapa');
            $table->integer('num_nodo')->unsigned();

            $table->timestamps();
        });
    }

    public function down(){
        //
    }
}
