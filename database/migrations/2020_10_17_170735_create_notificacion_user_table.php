<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionUserTable extends Migration{

	public function up(){
		Schema::create('notificaciones_usuarios', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('id_permiso')->index();
			$table->foreign('id_permiso')->references('id')->on('permisos')->onDelete('cascade');
			$table->unsignedBigInteger('id_usuario')->index();
			$table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
			
		});
	}

	public function down(){
	}

}
