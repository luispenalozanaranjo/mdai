<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Area extends Model{

	protected $table = 'areas';
    
    public function getAreas(){
    	// Obtenemos el detalle de un usuario
		if( config('app.debug') ) DB::enableQueryLog();

		$areas = DB::table( $this->table )
		->whereNotNull('nombre')
		->get();

		return ( !empty($areas) ) ? $areas : null;
	}

}
