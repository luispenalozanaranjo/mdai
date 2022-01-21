<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class excepcionDato extends Model{
    protected $table = 'excepciones_datos';
	protected $fillable = ['valor', 'observaciones', 'id_ed', 'id_datos'];

	public function deleteDetalles($id_ed){
		// Elimina los detalles guardados
		$deleting = $this->where('id_ed', $id_ed)->delete();
		return ( $deleting ) ? true : false;
	}

	public function insertDetalles($data){
		// Inserta los detalles de l nodo
		$detalle = $this->create([
			'valor' => $data['value'],
			'observaciones' => $data['observaciones'],
			'id_ed' => $data['id_ed'],
			'id_datos' => $data['id_datos']
		]);

		return ( $detalle ) ? $detalle : false;
	}

	public function getDetalles($id_ed){
		// Obtiene los campos guardados de un nodo
		$detalles = $this->where('id_ed', $id_ed)->get();

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

		return $detalles;
	}

	function detalle(){
		return $this->belongsTo('App\excepcionDetalle', 'id_ed', 'id');
	}

	public function almacen(){
		return $this->belongsTo('App\Almacen', 'id_datos');
	}
}
