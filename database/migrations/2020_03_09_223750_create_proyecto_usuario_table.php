<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoUsuarioTable extends Migration{
    
    public function up(){
        Schema::create('proyectos_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_proyecto')->nullable()->index();
            $table->foreign('id_proyecto')->references('id')->on('proyectos')->onDelete('cascade');
            $table->unsignedBigInteger('id_usuario')->nullable()->index();
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down(){
        Schema::dropIfExists('proyecto_usuario');
    }
}
