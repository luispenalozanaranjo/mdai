<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Common;
use Carbon\Carbon;

class Estado extends Model{
	
	protected $table = 'estados';

	public function getEstado($idEstado){
		// Obtenemos el detalle del estado
		if( config('app.debug') ) DB::enableQueryLog();

		$estado = DB::table( $this->table )
		->where('id_estado', $idEstado)
		->select('descripcion')
		->first();

		return ( $estado ) ? $estado->descripcion : false;
	}

}
