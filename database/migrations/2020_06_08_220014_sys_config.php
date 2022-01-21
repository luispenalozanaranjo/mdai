<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SysConfig extends Migration{

    public function up(){
        Schema::create('sys_config', function(Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('infoType', 50);
            $table->json('data');
            $table->timestamp('ts');
        });
    }

    public function down(){
    }
}
