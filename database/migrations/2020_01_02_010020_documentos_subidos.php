<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocumentosSubidos extends Migration{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('documentos_subidos', function(Blueprint $table){
			$table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';

			$table->bigIncrements('id');
			$table->string('ruta', 255);
			$table->string('nombre_archivo', 255);
			$table->string('nombre_original', 255);
			$table->unsignedBigInteger('id_dw');
			$table->unsignedBigInteger('id_nd')->nullable();
			$table->unsignedBigInteger('id_preg')->nullable();
			$table->unsignedBigInteger('id_usuario');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		//
	}
}
