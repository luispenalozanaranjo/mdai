<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relations extends Migration{

    public function up(){
        Schema::table('data', function(Blueprint $table){
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
            $table->foreign('id_etapa')->references('id')->on('etapas');
        });

        Schema::table('datos', function(Blueprint $table){
            $table->foreign('id_nd')->references('id')->on('nodos_detalle');
            $table->foreign('id_datos')->references('id')->on('almacen_datos');
        });

        Schema::table('nodos_detalle', function(Blueprint $table){
            $table->foreign('id_dw')->references('id')->on('workflow_detalle');
            $table->foreign('id_nodo')->references('id')->on('nodos');
        });

        Schema::table('documentos_subidos', function(Blueprint $table){
            $table->foreign('id_dw')->references('id')->on('workflow_detalle');
            $table->foreign('id_nd')->references('id')->on('nodos_detalle');
            $table->foreign('id_preg')->references('id')->on('preguntas');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
        });

        Schema::table('preguntas', function(Blueprint $table){
            $table->foreign('id_form')->references('id')->on('formularios');
        });

        Schema::table('respuestas', function(Blueprint $table){
            $table->foreign('id_preg')->references('id')->on('preguntas');
            $table->foreign('id_dw')->references('id')->on('workflow_detalle');
            $table->foreign('autoriza_id')->references('id')->on('usuarios');
        });

        Schema::table('notificaciones', function(Blueprint $table){
            $table->foreign('id_dw')->references('id')->on('workflow_detalle');
            $table->foreign('id_nodo')->references('id')->on('nodos');
        });

        Schema::table('workflow_detalle', function(Blueprint $table){
            $table->foreign('id_workflow')->references('id')->on('workflow');
        });

        Schema::table('usuarios', function(Blueprint $table){
            $table->foreign('id_cargo')->references('id')->on('cargos');
            $table->foreign('id_area')->references('id')->on('areas');
        });

        Schema::table('etapas', function(Blueprint $table){
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_region')->references('id')->on('regiones');
        });

        Schema::table('bitacora_contacto', function(Blueprint $table){
            $table->foreign('opp')->references('opp')->on('data');
        });

        Schema::table('nodos', function(Blueprint $table){
            $table->foreign('etapa')->references('id')->on('workflow_etapas');
        });
        
        Schema::table('notificacion_check', function(Blueprint $table){
            $table->foreign('id_dw')->references('id')->on('workflow_detalle');
            $table->foreign('id_check')->references('id')->on('almacen_datos');
        });

        // Schema::table('formularios', function(Blueprint $table){
        //     $table->foreign('num_nodo')->references('num_nodo')->on('nodos');
        // });

        Schema::table('permisos', function(Blueprint $table){
            $table->foreign('num_nodo')->references('num_nodo')->on('nodos');
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
