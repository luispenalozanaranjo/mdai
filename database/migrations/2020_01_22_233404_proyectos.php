<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Proyectos extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('proyectos', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            // Columnas iniciales
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('codigo');

            // Nuevas columnas (mantenedor de proyectos)
            $table->string('dueno')->nullable();
            $table->string('direccion')->nullable();
            $table->string('comuna')->nullable();
            $table->string('region')->nullable();
            $table->string('inmobiliaria')->nullable();
            $table->string('rut_inmobiliaria')->nullable();
            $table->string('estado')->nullable();
            $table->string('programa')->nullable();
            $table->string('tipologias')->nullable();
            $table->integer('viviendas_totales')->nullable();
            $table->integer('unidades_vulnerables')->nullable();
            $table->integer('unidades_medios')->nullable();
            $table->string('tipo_documento_venta')->nullable();
            $table->integer('ggoo')->nullable();
            $table->integer('fondo_inicial')->nullable();
            $table->integer('reserva')->nullable();
            $table->integer('checklist')->nullable();
            $table->integer('checklist_postulacion')->nullable();
            // $table->string('arquitecto');
            // $table->string('responsable_area_tecnica');
            // $table->string('constructora');
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
