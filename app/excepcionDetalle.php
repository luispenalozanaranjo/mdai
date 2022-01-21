<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Nodo as Nodos;

class excepcionDetalle extends Model{
	protected $table = 'excepciones_detalle';
	protected $fillable = ['id_nodo', 'id_excepcion', 'id_estado', 'fecha_salida'];

	public function getFlujo($id_excepcion){
		$detalle = $this->where('id_excepcion', $id_excepcion)->orderBy('id', 'DESC')->get();

		if( $detalle ){
			foreach( $detalle as $item ){
				$item->nodo;
				$item->estados;
				$item->terminado;

				// Si tiene siguiente lo agregamos
				$nodos = new Nodos;
				$siguiente = $nodos->getNodoByNum( $item->nodo->num_nodo_salida );

				if( $siguiente ){
					$item->siguiente = $siguiente;
				}
			}

			$flujo['Excepción'] = $detalle;
		}

		return ($detalle) ? $flujo : false;
	}

	public function terminarExcepcion($id_ed){
		$excepcion = $this::find($id_ed);

		if( $excepcion ){
			$excepcion->id_estado = 13;
			$excepcion->fecha_salida = dateNow();
			$excepcion->user_termina = auth()->user()->id;
			return ( $excepcion->save() ) ? true : false;
		}
		else{
			return false;
		}
	}

	public function nodo(){
		return $this->belongsTo('App\Nodo', 'id_nodo', 'id');
	}

	public function estados(){
		return $this->belongsTo('App\Estado', 'id_estado', 'id');
	}

	public function excepcion(){
		return $this->belongsTo('App\Excepcion', 'id_excepcion', 'id');	
	}

	public function terminado(){
		return $this->belongsTo('App\Usuario', 'user_termina', 'id');		
	}
}
