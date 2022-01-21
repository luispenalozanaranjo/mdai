<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers\Common;

class Notificacion extends Model{
	protected $table = 'notificaciones';
	protected $fillable = [
		'usuario',
		'fecha_lectura',
		'detalle',
		'id_dw',
		'id_nodo',
		'titulo',
		'estado',
		'url'
	];

	public function find($id_dw, $id_nodo){
		// Obtenemos el registro de una notificacion
		try{
			return $this->where('id_dw', $id_dw)->where('id_nodo', $id_nodo)->first();
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function findAndMark($id_dw, $id_nodo){
		// Busca una notificacion y la marca como leída
		try{
			$notificaciones = $this->where('id_dw', $id_dw)
			->where('id_nodo', $id_nodo)
			->whereNull('fecha_lectura')
			->get();

			if( !empty($notificaciones) ){
				// Existe la notificacion
				foreach( $notificaciones as $notificacion ){
					$notificacion->estado = true;
					$notificacion->fecha_lectura = dateNow();
					$notificacion->save();
				}
				return true;
			}
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function markAsRead($notificacion_id){
		// Marca una notificacion como leída
		$notificacion = Notificacion::findOrFail($notificacion_id);
		$notificacion->estado = true;
		$notificacion->fecha_lectura = dateNow();
		return $notificacion->save();
	}

	public function workflow(){
		return $this->belongsTo('App\workflowDetalle', 'id_dw');
	}

	public function nodo(){
		return $this->belongsTo('App\Nodo', 'id_nodo');
	}
}
