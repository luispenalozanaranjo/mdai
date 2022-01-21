<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Etapas extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
         Schema::create('etapas', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('codigo');
            $table->date('fecha_recepcion')->nullable();
            $table->integer('total_unidades')->nullable();
            $table->integer('total_vulnerables')->nullable();
            $table->integer('escrituracion_notificacion')->nullable();
            $table->unsignedBigInteger('id_proyecto');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_region')->nullable();

            for( $i = 1; $i <= 5; $i++ ){ 
               $table->integer('pis_v_' . $i)->nullable();
               $table->integer('pis_t_' . $i)->nullable();
            }
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
