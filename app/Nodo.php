<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Common;
use Carbon\Carbon;
use App\Notifications\NotificacionCorreo;
use App\Usuario;

class Nodo extends Model{
	
	protected $table = 'nodos';
	protected $fillable = ['num_nodo', 'nombre_nodo', 'actividad', 'subactividad', 'num_nodo_salida', 'etapa'];

	public function getNodo($idNodo){
		// Obtenemos el detalle de un nodo
		try{
			return $this->findOrFail($idNodo);
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function getNodoByNum($num_nodo){
		// Obtenemos el detalle de un nodo por el número de nodo
		try{
			return $this->where('num_nodo', $num_nodo)->first();
		}
		catch(\Exception $e){
			return false;
		}
	}

	// public function detalleExist($id_dato){
	// 	// Inserta un workflow
	// 	if( config('app.debug') ) DB::enableQueryLog();

	// 	$detalle = DB::table( $this->datos )
	// 	->where('id_datos', $id_dato)
	// 	->first();

	// 	return ( $detalle ) ? true : false;
	// }

	// public function updateDetalles($data){
	// 	// Inserta un workflow
	// 	if( config('app.debug') ) DB::enableQueryLog();

	// 	$detalle = DB::table( $this->datos )
	// 	->where('id_nodo', $data['id_nodo'])
	// 	->where('id_datos', $data['id_datos'])
	// 	->update([
	// 		'valor' => $data['value']
	// 	]);

	// 	return ( $detalle ) ? $detalle : false;
	// }

	public function formularios(){
		return $this->hasMany('App\Formulario', 'num_nodo');
	}

	public function info_etapa(){
		return $this->belongsTo('App\workflowEtapas', 'etapa');
	}
}
