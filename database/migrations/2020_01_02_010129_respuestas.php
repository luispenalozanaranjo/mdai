<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Respuestas extends Migration{

    public function up(){
        Schema::create('respuestas', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('valor', 255)->nullable();
            $table->string('titular', 45)->nullable();
            $table->string('codeudor', 45)->nullable();
            $table->string('excepcion', 45)->nullable();
            $table->string('subsanado', 45)->nullable();
            $table->unsignedBigInteger('autoriza_id')->nullable();
            $table->unsignedBigInteger('id_preg');
            $table->unsignedBigInteger('id_dw');

            $table->timestamps();
        });
    }

    public function down(){
        //
    }
}
