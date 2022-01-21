<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Data as Promesas;
use App\Workflow;
use App\workflowDetalle;
use App\Usuario;
use App\Nodo;
use App\nodoDetalle;
use App\Excepcion;
use App\excepcionDetalle;
use App\excepcionDato;
use App\Notificacion;
use App\Permisos;
use App\permisosUsuarios;
use App\Respuesta;

use Carbon\Carbon;

class excepcionesController extends Controller{

	public function excepcionView(Request $request){
		$excepcion = Excepcion::find($request->id);

		if( $excepcion ){
			$nodo = nodoDetalle::find($excepcion->id_nd);
			$nodo->estados;

			$workflow = workflowDetalle::find($nodo->id_dw);
			$workflow->workflow;
			$opp = $workflow->workflow->opp;
			
			$promesas = new Promesas;
			$excepcionDetalle = new excepcionDetalle;

			$excepcion->estado;
			$excepcion->pregunta;
			$excepcion->nodo;
			$excepcion->nodo->nodo;
			$excepcion->usuario;
			$excepcion->estado;

			return view('pages.excepciones.detalle', [
				'title' => 'Detalle de excepción',
				'excepcion' => $excepcion,
				'nodo' => $nodo,
				'promesa' => $promesas->getPromesaFull($opp),
				'flujo' => $excepcionDetalle->getFlujo($excepcion->id)
			]);
		}
		else{
			return abort(404, 'No existe la excepción solicitada.');
		}
	}

	public function excepcionDetalle(Request $request){
		$excepcion = Excepcion::find($request->id);
		$detalle = excepcionDetalle::find($request->detalle);

		if( $detalle ){
			$detalle->estado;
			$detalle->excepcion;
			$detalle->excepcion->estado;
			$detalle->excepcion->pregunta;
			$detalle->excepcion->nodo;
			$detalle->excepcion->nodo->nodo;
			$detalle->excepcion->usuario;
			$detalle->terminado;

			$format = 'l d \d\e F \d\e\l Y \a \l\a\s H:i';
			$detalle->salida_format = Carbon::parse($detalle->fecha_salida)->locale('es')->translatedFormat($format);

			$nodo = nodoDetalle::find($excepcion->id_nd);
			$workflow = workflowDetalle::find($nodo->id_dw);
			$workflow->workflow;
			$opp = $workflow->workflow->opp;
			$promesas = new Promesas;
			$usuarios = new Usuario;

			$promesaFull = $promesas->getPromesaFull($opp);
			$vendedor = $usuarios::where('usuario_vivesoft', $promesaFull->ejecutivo)->first();

			$nodo = Nodo::find($detalle->id_nodo);
			$nodo->estados;

			$permissions = auth()->user()->permisos->where('num_nodo', $nodo->num_nodo)->first();
			$can_edit = ( !empty($permissions) || auth()->user()->id === 1 ) ? true : false;

			$data = (object)[
				'promesa' => $promesaFull,
				'detalle' => $detalle,
				'nodo' => $nodo,
				'can_edit' => $can_edit,
				'ejecutivos' => $usuarios->getUsersCargo(7),
				'vendedor' => [($vendedor) ? $vendedor : $usuarios::find(1)],
			];

			return view('pages.excepciones.detalle-excepcion', [
				'title' => 'Detalle de excepción',
				'data' => $data
			]);
		}
		else{
			return abort(404, 'Detalle no encontrado.');
		}
	}

	public function terminarExcepcion(Request $request){
		$result = false;
		$autoriza = false;

		if( !empty($request->all()) ){
			$nodos = new Nodo;
			$excepcionDetalle = new excepcionDetalle;

			$excepcionR = $request->excepcion;
			$estado = 3;

			// Actualimos el estado y guardamos el siguiente
			$terminado = $excepcionDetalle->terminarExcepcion( $excepcionR['id'] );

			// Verificamos si tiene notificacion
			// $notificacion = new Notificacion;
			// $notificacion->findAndMark($request->nodo['id_dw'], $request->nodo['id_nodo']);

			// Buscamos los usuarios que tengan permisos para el siguiente nodo
			// $permisos_id = Permisos::where('num_nodo', $salida)->pluck('id');
			// $usuarios_nodo = permisosUsuarios::whereIn('id_permiso', $permisos_id)->pluck('id_usuario')->toArray();

			// Agregamos al admin a la lista de correos
			// array_push($usuarios_nodo, 1);

			$siguiente_nodo = $nodos->getNodoByNum( $request->nodo['num_nodo_salida'] );

			if( $terminado ){
				// Nodo terminado
				$result = true;

				$excepcion = Excepcion::find( $excepcionR['id_excepcion'] );
				$respuesta = Respuesta::where('id_preg', $excepcionR['excepcion']['id_pregunta'])
				->where('id_dw', $excepcionR['excepcion']['nodo']['id_dw'])
				->first();

				if( $request->nodo['num_nodo'] === 101 ){
					// El primer nodo de la excepción
					if( $request->has('autoriza') ){
						if( $request->autoriza === 'autoriza' && $excepcion ){
							$excepcion->id_estado = 13;
							$excepcion->save();

							$autoriza = true;

							if( $respuesta ){
								// la respuesta existe
								$respuesta->titular = 1;
								$respuesta->excepcion = 1;
								$respuesta->autoriza_id = auth()->user()->id;
								$respuesta->subsanado = 'Pendiente.';
								$respuesta->save();
							}
							else{
								// La respuesta no existe
								Respuesta::create([
									'titular' => 1,
									'excepcion' => 1,
									'subsanado' => 'Pendiente.',
									'autoriza_id' => auth()->user()->id,
									'id_preg' => $excepcionR['excepcion']['id_pregunta'],
									'id_dw' => $excepcionR['excepcion']['nodo']['id_dw'],
								]);
							}
						}
					}

				}
				elseif( $request->nodo['num_nodo'] === 104 ){
					// Es el ultimo nodo de la excepción
					if( $excepcion ){
						$excepcion->id_estado = 13;
						$excepcion->save();

						if( $respuesta ){
							// la respuesta existe
							$respuesta->titular = 1;
							$respuesta->excepcion = 1;
							$respuesta->autoriza_id = auth()->user()->id;
							$respuesta->subsanado = 'Pendiente.';
							$respuesta->save();
						}
						else{
							// La respuesta no existe
							Respuesta::create([
								'titular' => 1,
								'excepcion' => 1,
								'subsanado' => 'Pendiente.',
								'autoriza_id' => auth()->user()->id,
								'id_preg' => $excepcionR['excepcion']['id_pregunta'],
								'id_dw' => $excepcionR['excepcion']['nodo']['id_dw'],
							]);
						}
					}
				}

				if( $siguiente_nodo && !$autoriza ){
					// Si hay un nodo siguiente, lo creamos
					$siguiente_ready = $excepcionDetalle->create([
						'id_excepcion' => $excepcionR['id_excepcion'],
						'id_nodo' => $siguiente_nodo->id,
						'id_estado' => $estado
					]);

					if( $siguiente_ready ){
						// El siguiente nodo se creo bien
						$result = true;

						if( !empty($usuarios_nodo) ){
							// Mandamos la notificacion
							if( !in_array($siguiente_nodo->num_nodo, $exclude) ){
								// Si no esta en la lista, mandamos la notificacion
								// $this->obtenerNotificacion($usuarios_nodo, $siguiente_nodo, $request);
							}
						}
					}
				}
			}
		}
		
		return response()->json( $result );
	}
	public function cambiarEstado(Request $request){
		
			
		$respuesta = Respuesta::where('id_preg', $request['check']['respuesta']['id_preg'])
		->where('id_dw', $request['check']['respuesta']['id_dw'])
		->first();

			if( $respuesta ){
				// la respuesta existe

				if ($respuesta->subsanado == 'Sí.') {
					# code...
					return response()->json(["respondido" => "El estado ya es sí"]);
				}else{
					$respuesta->subsanado = 'Sí.';
					return response()->json($respuesta->save());

				}
				
				
			}
			
	}

	public function getDatos(Request $request){
		$datos = new excepcionDato;
		$data = new \stdClass;
		$data->detalles = $datos->getDetalles( $request->id_ed );
		return response()->json( $data );
	}
	
	public function crearExcepcion(Request $request){
		$excepcion = Excepcion::create([
			'id_nd' => $request->id_nd,
			'id_usuario' => $request->id_usuario,
			'id_pregunta' => $request->id_pregunta,
			'observaciones' => $request->observaciones,
			'id_estado' => 3
		]);

		if( $excepcion ){
			$detalle = excepcionDetalle::create([
				'id_nodo' => 72,
				'id_excepcion' => $excepcion->id,
				'id_estado' => 3,
			]);

			$response = [
				'route' => route('excepcion', $excepcion->id),
				'excepcion' => $excepcion,
				'status' => ($excepcion && $detalle)
			];

			return response()->json($response);
		}
	}

}