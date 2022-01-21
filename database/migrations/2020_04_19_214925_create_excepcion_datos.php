<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcepcionDatos extends Migration{

    public function up(){
        Schema::create('excepciones_datos', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->text('valor');
            $table->text('observaciones')->nullable();

            $table->unsignedBigInteger('id_ed');
            $table->foreign('id_ed')->references('id')->on('excepciones_detalle');
            $table->unsignedBigInteger('id_datos');
            $table->foreign('id_datos')->references('id')->on('almacen_datos');

            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('excepciones_datos');
    }
}
