<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcepciones extends Migration{

	public function up(){
		Schema::create('excepciones', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('id_nd');
			$table->foreign('id_nd')->references('id')->on('nodos_detalle');
			$table->unsignedBigInteger('id_pregunta');
			$table->foreign('id_pregunta')->references('id')->on('preguntas');
			$table->unsignedBigInteger('id_usuario');
			$table->foreign('id_usuario')->references('id')->on('usuarios');
			$table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estados');
			$table->text('observaciones');
			$table->timestamps();
		});
	}

	public function down(){
		Schema::dropIfExists('excepciones');
	}
	
}