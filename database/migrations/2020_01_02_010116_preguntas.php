<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Preguntas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('preguntas', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->integer('num_pregunta');
            $table->text('marca_campo')->nullable();
            $table->string('configuracion', 45)->nullable();
            $table->string('tipo', 45)->default('check')->nullable();
            $table->text('encabezado_pregunta');
            $table->integer('requerido');
            $table->softDeletes();

            $table->unsignedBigInteger('id_form');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
