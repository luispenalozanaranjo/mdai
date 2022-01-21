<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dato extends Model{
	protected $table = 'datos';
	protected $fillable = ['valor', 'observaciones', 'id_nd', 'id_datos'];

	public function getDetalles($id_nd){
		// Obtiene los campos guardados de un nodo
		$detalles = $this->where('id_nd', $id_nd)->get();

		if( !$detalles->isEmpty() ){
			// Hay datos
			foreach( $detalles as $detalle ){
				$detalle->almacen;
			}
			return $detalles;
		}
		else{
			return false;
		}
	}

	public function deleteDetalles($id_nd){
		// Elimina los detalles guardados
		$deleting = $this->where('id_nd', $id_nd)->delete();
		return ( $deleting ) ? true : false;
	}

	public function insertDetalles($data){
		// Inserta los detalles de l nodo
		$detalle = $this->create([
			'valor' => $data['value'],
			'observaciones' => $data['observaciones'],
			'id_nd' => $data['id_nd'],
			'id_datos' => $data['id_datos']
		]);

		return ( $detalle ) ? $detalle : false;
	}

	public function getDatos($fields, $id_nd){
		$datos = $this->whereIn('id_datos', $fields)->whereIn('id_nd', $id_nd)->select('valor', 'observaciones')->get();
		return ( $datos && !empty($datos) ) ? $datos : false;
	}

	public function almacen(){
		return $this->belongsTo('App\Almacen', 'id_datos');
	}
}