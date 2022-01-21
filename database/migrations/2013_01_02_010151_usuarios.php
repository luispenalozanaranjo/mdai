<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration{

    public function up(){
        Schema::create('usuarios', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('usuario', 45);
            $table->string('password');
            $table->string('nombres', 45);
            $table->string('apellidos', 45)->nullable();
            $table->string('rut')->unique();
            $table->string('usuario_vivesoft', 45)->nullable();
            $table->integer('backup')->nullable();
            $table->integer('representante_legal')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('rol', 45)->nullable();
            $table->string('perfil', 45)->nullable();
            $table->string('vacaciones', 1)->nullable();
            $table->date('fecha_desde')->nullable();
            $table->date('fecha_hasta')->nullable();

            $table->unsignedBigInteger('id_cargo');
            $table->unsignedBigInteger('id_area');

            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(){
        //
    }
}