<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cargo extends Model{

	protected $table = 'cargos';

	public function getCargos(){
    	// Obtenemos el detalle de un usuario
		if( config('app.debug') ) DB::enableQueryLog();

		$areas = DB::table( $this->table )
		->whereNotNull('nombre')
		->get();

		return ( !empty($areas) ) ? $areas : null;
	}

}
