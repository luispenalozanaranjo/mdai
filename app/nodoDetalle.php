<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Nodo as Nodos;
use App\Usuario as Usuarios;

class nodoDetalle extends Model{
	protected $table = 'nodos_detalle';
	protected $fillable = ['usuario', 'estado', 'id_dw', 'id_nodo'];

	public function getDetalle($id){
		// Obtenemos el detalle de una promesa
		try{
			return $this->findOrFail($id);
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function getResumen( $workflowDetalle, $estado ){
		$resumen = $this->where('id_dw', $workflowDetalle)->orderBy('id', 'DESC');

		if( $estado === 'Desistida' ){
			$resumen->where('estado', 13);
		}

		$resumen = $resumen->get();

		if( !$resumen->isEmpty() ){
			// Creamos el objeto que contendrá la info
			$workflow = [];

			foreach( $resumen as $item ){ 
				// Agrupamos los nodos por etapa
				$resumenEtapas = ['1', '2', '3', '4'];
				$nombre_etapa = $item->nodo->etapa;

				if( in_array($nombre_etapa, $resumenEtapas) ){
					// La etapa esta dentro del resumen

					// Recorremos y agregamos las relaciones
					$item->nodo;
					$item->usuarios;
					$item->terminado;
					$item->estados;

					$format = 'l d \d\e F \d\e\l Y \a \l\a\s H:i';
					$item->created_format = Carbon::parse($item->created_at)->locale('es')->translatedFormat($format);
					$item->salida_format = Carbon::parse($item->fecha_salida)->locale('es')->translatedFormat($format);

					if( !array_key_exists($nombre_etapa, $workflow) ){
						// Si no existe la etapa, la creamos
						$workflow[$nombre_etapa] = [];
					}

					// Agregamos el item donde corresponda
					array_push( $workflow[$nombre_etapa], $item );

					// Si tiene siguiente lo agregamos
					$nodos = new Nodos;
					$siguiente = $nodos->getNodoByNum( $item->nodo->num_nodo_salida );

					if( $siguiente ){
						$item->siguiente = $siguiente;
					}
				}
			}

			// Si el workflow contiene algo lo devolvemos
			return $workflow;
		}
		else{
			return false;
		}
	}

	public function getCambioUnidad($workflowDetalle, $ejecutivo){
		$nodoCambioUnidad = Nodos::where('num_nodo', 115)->first();
		$cambioUnidad = $this->where('id_nodo', $nodoCambioUnidad->id)->where('id_dw', $workflowDetalle)->first();

		if( $cambioUnidad === null ){
			// No tiene desestimiento creado
			$this->create([
				'usuario' => $this->getUserByName($ejecutivo)->id,
				'estado' => 3,
				'id_dw' => $workflowDetalle,
				'id_nodo' => $nodoCambioUnidad->id
			]);
		}

		$resumen = $this->where('id_dw', $workflowDetalle)->orderBy('id', 'DESC')->get();
		$workflow = false;

		if( !$resumen->isEmpty() ){
			// Creamos el objeto que contendrá la info
			$nombre_etapa = 'Cambio unidad';
			$workflow[$nombre_etapa] = [];

			foreach( $resumen as $item ){ 
				$etapa = $item->nodo->etapa;

				if( $etapa === 5 ){
					// Pertenece al cambio de unidad
					$item->nodo;
					$item->usuarios;
					$item->terminado;
					$item->estados;

					// Agregamos el item donde corresponda
					array_push($workflow[$nombre_etapa], $item);

					// Si tiene siguiente lo agregamos
					$nodos = new Nodos;
					$siguiente = $nodos->getNodoByNum( $item->nodo->num_nodo_salida );
					if( $siguiente ){
						$item->siguiente = $siguiente;
					}
				}
			}
		}

		return $workflow;
	}

	public function getDesistimiento($workflowDetalle, $ejecutivo){
		$nodoDesestimiento = Nodos::where('num_nodo', 150)->first();
		$desestimiento = $this->where('id_nodo', $nodoDesestimiento->id)->where('id_dw', $workflowDetalle)->first();

		if( $desestimiento === null ){
			// No tiene desestimiento creado
			$this->create([
				'usuario' => $this->getUserByName($ejecutivo)->id,
				'estado' => 3,
				'id_dw' => $workflowDetalle,
				'id_nodo' => $nodoDesestimiento->id
			]);
		}

		$resumen = $this->where('id_dw', $workflowDetalle)->orderBy('id', 'DESC')->get();
		$workflow = false;

		if( !$resumen->isEmpty() ){
			// Creamos el objeto que contendrá la info
			$nombre_etapa = 'Desistimiento';
			$workflow[$nombre_etapa] = [];

			foreach( $resumen as $item ){ 
				// Recorremos y agregamos las relaciones
				$etapa = $item->nodo->etapa;

				if( $etapa === 7 ){
					// Pertenece al cambio de unidad
					$item->nodo;
					$item->usuarios;
					$item->terminado;
					$item->estados;

					// Agregamos el item donde corresponda
					array_push($workflow[$nombre_etapa], $item);

					// Si tiene siguiente lo agregamos
					$nodos = new Nodos;
					$siguiente = $nodos->getNodoByNum( $item->nodo->num_nodo_salida );

					if( $siguiente ){
						$item->siguiente = $siguiente;
					}
				}
			}
		}

		return $workflow;
	}

	public function getEntregaUnidad($workflowDetalle, $ejecutivo){
		$resumen = $this->where('id_dw', $workflowDetalle)->orderBy('id', 'DESC')->get();
		$workflow = false;

		if( !$resumen->isEmpty() ){
			// Creamos el objeto que contendrá la info
			$nombre_etapa = 'Entrega Unidad';
			$workflow[$nombre_etapa] = [];

			foreach( $resumen as $item ){ 
				// Recorremos y agregamos las relaciones
				$etapa = $item->nodo->etapa;

				if( $etapa === 9 ){
					// Pertenece al cambio de unidad
					$item->nodo;
					$item->usuarios;
					$item->terminado;
					$item->estados;

					// Agregamos el item donde corresponda
					array_push($workflow[$nombre_etapa], $item);

					// Si tiene siguiente lo agregamos
					$nodos = new Nodos;
					$siguiente = $nodos->getNodoByNum( $item->nodo->num_nodo_salida );

					if( $siguiente ){
						$item->siguiente = $siguiente;
					}
				}
			}
		}

		return $workflow;
	}

	public function getNodoDetalles($num_nodo, $workflowDetalle){
		// Obtenemos el detalle de un nodo
		$detalle = $this->where('id_dw', $workflowDetalle)->get();

		foreach( $detalle as $item ){
			$item->nodo;
			$item->usuarios;
			$item->terminado;
			$item->estados;

			$format = 'l d \d\e F \d\e\l Y \a \l\a\s H:i';
			$item->created_format = Carbon::parse($item->created_at)->locale('es')->translatedFormat($format);
			$item->salida_format = Carbon::parse($item->fecha_salida)->locale('es')->translatedFormat($format);

			if( $item->nodo->num_nodo == $num_nodo ){
				return $item;
			}
		}
	}

	public function terminarNodo($id_nodo, $id_dw){
		// Cambia el estado de un nodo, terminandolo
		$detalle = $this->where('id_nodo', $id_nodo)->where('id_dw', $id_dw)->first();

		// No se encontró el detale
		if( !$detalle ) return false;

		// El detalle existe, actualizamos
		$detalle->estado = 13;
		$detalle->fecha_salida = dateNow();
		$detalle->user_termina = auth()->user()->id;
		return ( $detalle->save() ) ? true : false;
	}

	public function getUserByName($nombre){
		$usuario = Usuarios::where('usuario_vivesoft', $nombre)->first();
		return ( $usuario ) ? $usuario : Usuarios::find(1);
	}

	public function checkExists($id_nodo, $id_dw){
		// Verificamos si ya existe en el workflow
		$nodo = $this->where('id_nodo', $id_nodo)->where('id_dw', $id_dw)->first();
		return ( !empty($nodo) ) ? true : false;
	}

	public function nodo(){
		return $this->belongsTo('App\Nodo', 'id_nodo');
	}

	public function usuarios(){
		return $this->belongsTo('App\Usuario', 'usuario')->select('id', 'nombres', 'apellidos', 'email');
	}

	public function terminado(){
		return $this->belongsTo('App\Usuario', 'user_termina')->select('id', 'nombres', 'apellidos', 'email');
	}

	public function estados(){
		return $this->belongsTo('App\Estado', 'estado');
	}
}