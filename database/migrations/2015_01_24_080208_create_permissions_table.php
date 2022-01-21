<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration{

	public function up(){
		// $name = config('shinobi.tables.permissions');
		Schema::create('permisos', function(Blueprint $table){
			$table->bigIncrements('id');
			$table->integer('num_nodo')->unsigned()->unique();
		});
	}

	public function down(){
		// $name = config('shinobi.tables.permissions');
		// Schema::drop($name);
	}
}
