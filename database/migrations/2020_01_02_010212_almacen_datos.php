<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlmacenDatos extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('almacen_datos', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('slug', 45);
            $table->string('nombre', 100);
            $table->string('type', 45);
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
