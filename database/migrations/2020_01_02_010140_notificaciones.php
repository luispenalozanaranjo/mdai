<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notificaciones extends Migration{

    public function up(){
        Schema::create('notificaciones', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('usuario', 45);
            $table->datetime('fecha_lectura')->nullable();
            $table->string('titulo', 60);
            $table->text('detalle');
            $table->text('url');
            $table->unsignedBigInteger('id_dw');
            $table->unsignedBigInteger('id_nodo')->nullable();
            $table->boolean('estado');
            $table->timestamps();
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
