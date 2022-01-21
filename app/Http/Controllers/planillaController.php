<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use App\Data as Promesa;
use App\Workflow;
use App\workflowDetalle;
use App\Nodo;
use App\nodoDetalle;
use App\Usuario as Usuarios;
use App\Proyecto as Proyectos;
use App\Etapa as Etapas;
use App\Notificacion;

// Mails
use App\Mail\terminarNodo;

class planillaController extends Controller{

	public function mainView(){
		return view('pages.planilla.upload', [
			'title' => 'Cargar planilla'
		]);
	}

	public function getPromesa( $opp ){
		try {
			Promesa::FindOrFail($opp);
			return true;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function insertProyecto($opp){
		$proyecto = $this->checkProyecto($opp['Proyecto']);

		if( !$proyecto ){
			// El proyecto no existe
			$proyecto = new Proyectos();
			$proyecto->nombre = $opp['Proyecto'];
			$proyecto->codigo = $opp['Código Proyecto'];
			$proyecto->save();
		}

		return $proyecto->id;
	}

	public function insertEtapa($opp){
		$proyecto = $this->checkProyecto($opp['Proyecto']);
		$etapa = $this->checkEtapa($opp['Código Etapa'], $proyecto->id);

		if( $proyecto && !$etapa ){
			// La etapa no existe
			$etapa = new Etapas();
			$etapa->nombre = $opp['Etapa'];
			$etapa->codigo = $opp['Código Etapa'];
			$etapa->id_proyecto = $proyecto->id;
			$etapa->save();
		}

		return $etapa->id;
	}

	public function insertOrUpdate( $item ){
		if( $this->getPromesa($item['Opp']) ){
			// La promesa existe
			$promesa = Promesa::find( $item['Opp'] );
		}
		else{
			// La promesa no existe
			$promesa = new Promesa();
			$promesa->opp = $item['Opp'];
			$promesa->id_proyecto = $this->insertProyecto($item);
			$promesa->id_etapa = $this->insertEtapa($item);
		}
		
		$promesa->ejecutivo = $item['Ejecutivo'];
		$promesa->fecha_opp = $item['Fecha Opp'];
		$promesa->lote = $item['Lote'];
		$promesa->modelo = $item['Modelo'];
		$promesa->frente = $item['Frente'];
		$promesa->serviu = $item['Serviu'];
		$promesa->estado = $item['Estado'];
		$promesa->precio_lista_opp = $item['Precio Lista Opp'];
		$promesa->precio_final_opp = $item['Precio Final Opp'];
		$promesa->descuento_unidad = $item['Descuento Unidad'];
		$promesa->marca = $item['Marca'];
		$promesa->rut_cliente = $item['RUT Cliente'];
		$promesa->primer_nombre = $item['Nombre Cliente'];
		$promesa->segundo_nombre = $item['Segundo Nombre'];
		$promesa->apellido_paterno = $item['Apellido Paterno'];
		$promesa->apellido_materno = $item['Apellido Materno'];
		$promesa->estado_civil = $item['Estado Civil'];
		$promesa->telefonos = $item['Teléfonos'];
		$promesa->comuna_cliente = $item['Comuna Cliente'];
		$promesa->email = $item['Email'];
		$promesa->canal = $item['Canal'];
		$promesa->medio = $item['Medio'];
		$promesa->unidad_principal = $item['Unidad Principal'];
		$promesa->precio_unidad_principal = $item['Precio Uni. Principal'];
		$promesa->descuento_unidad_principal = $item['Descuento Uni. Principal'];
		$promesa->estacionamiento = $item['Estacionamiento'];
		$promesa->precio_estacionamiento = $item['Precio Estacionamiento'];
		$promesa->descuento_estacionamiento = $item['Descuento Estacionamiento'];
		$promesa->bodega = $item['Bodega'];
		$promesa->precio_bodega = $item['Precio Bodega'];
		$promesa->descuento_bodega = $item['Descuento Bodega'];
		$promesa->estado_riesgo = $item['Estado Riesgo'];
		$promesa->nombre_riesgo = $item['Nombre Riesgo'];
		$promesa->preaprobacion_riesgo = $item['Preaprobación Riesgo'];
		$promesa->fecha_cotizacion = parseDate($item['Fecha Cotizacion']);
		$promesa->fecha_reserva = parseDate($item['Fecha Reserva']);
		$promesa->fecha_cierre = parseDate($item['Fecha Cierre']);
		$promesa->fecha_promesa = parseDate($item['Fecha Promesa']);
		$promesa->pie = $item['Pie'];
		$promesa->cuotas_pie = $item['Cuotas Pie'];
		$promesa->pie_cuota_1 = $item['Pie Cuota 1'];
		$promesa->pie_cuota_2 = $item['Pie Cuota 2'];
		$promesa->pie_restante = $item['Pie Restante'];
		$promesa->pago_contra_promesa = $item['Pago contra Promesa'];
		$promesa->promesa_pagada = $item['Promesa Pagada'];
		$promesa->escritura = $item['Escritura'];
		$promesa->escritura_pagada = $item['Escritura Pagada'];
		$promesa->pie_pagado = $item['Pie Pagado'];
		$promesa->gops_pagados = $item['GOPS Pagados'];
		$promesa->cupon_gops = $item['Cupon GOPS'];
		$promesa->chip = $item['Chip'];
		$promesa->ahorro = $item['Ahorro'];
		$promesa->subsidio = $item['Subsidio'];
		$promesa->bono_captación = $item['Bono Captación'];
		$promesa->bono_integración = $item['Bono Integración'];
		$promesa->reserva = $item['Reserva'];
		$promesa->gops = $item['GOPS'];
		$promesa->num_cuotas_gops = $item['Número de Cuotas GOPS'];
		$promesa->gops_cuota_1 = $item['GOPS Cuota 1'];
		$promesa->gops_cuota_2 = $item['GOPS Cuota 2'];
		$promesa->gop_restante = $item['GOPS Restante'];
		$promesa->vencimiento_subsidio = parseDate($item['Vencimiento Subsidio']);
		$promesa->serie_subsidio = $item['Serie Subsidio'];
		$promesa->num_subsidio = $item['Número Subsidio'];
		$promesa->llamado_subsidio = $item['Llamado Subsidio'];
		$promesa->anio_subsidio = $item['Año Subsidio'];
		$promesa->banco = $item['Institución Financiera Evaluación'];
		$promesa->cupon_unidad_principal = $item['Cupon Uni. Principal'];
		$promesa->cupon_estacionamiento = $item['Cupon Estacionamiento'];
		$promesa->cupon_bodega = $item['Cupon Bodega'];
		$promesa->cupon_ahorro_previo = $item['Cupon Ahorro Previo'];
		$promesa->cupon_pago_contra_escritura = $item['Cupon Pago Contra Escritura'];
		$promesa->cupon_giftcard = $item['Cupon Giftcard'];
		$promesa->rut_conyuge = $item['RUT Conyuge'];
		$promesa->nombre_conyuge = $item['Nombre Conyuge'];
		$promesa->rent_conyuge = $item['Renta Conyuge'];
		$promesa->rut_aval = $item['RUT Aval'];
		$promesa->nombre_aval = $item['Nombre Aval'];
		$promesa->renta_aval = $item['Renta Aval'];
		$promesa->rut_codeudor = $item['RUT Codeudor'];
		$promesa->nombre_codeudor = $item['Nombre Codeudor'];
		$promesa->renta_codeudor = $item['Renta Codeudor'];
		$promesa->updated_at = dateNow();

		// Devolvemos
		if( $promesa->save() ){
			$promesa->proyectos;
			return $promesa;
		}
		else{
			return false;
		}
	}

	public function get($arr){
		try {
			$promesas = Promesa::find($arr);
			
			foreach($promesas as $promesa){
				$promesa->estados;
			}

			return $promesas;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function getUserByName($nombre){
		$usuario = Usuarios::where('usuario_vivesoft', $nombre)->first();
		return ( $usuario ) ? $usuario : Usuarios::find(1);
	}

	public function checkProyecto($proyecto){
		try {
			return Proyectos::where('nombre', $proyecto)->firstOrFail();
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function checkEtapa($etapa, $idProyecto){
		try {
			return Etapas::where([
				'codigo' => $etapa,
				'id_proyecto' => $idProyecto
			])->firstOrFail();
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function upload(Request $request){
		// Sube los datos que recibe desde la planilla Excel
		$promesados = $request->promesados;
		$workflow = new Workflow;
		$workflowDetalle = new workflowDetalle;
		$nodo = new Nodo;
		$nodoDetalle = new nodoDetalle;
		$complete = [];

		foreach( $promesados as $promesado ){
			// Recorremos todas las promesas del Excel
			$promesado_opp = $promesado['Opp'];

			if( !$this->getPromesa($promesado_opp) ){
				// La promesa no existe, la creamos
				$promesa = $this->insertOrUpdate($promesado);

				if( $promesa->estado !== 'Desistida' ){
					// Ingresado en la data
					$workflow_ready = $workflow->createWorkflow($promesado);

					if( $workflow_ready ){
						// Workflow ready, insertamos el detalle
						$detalle_ready = $workflowDetalle->newDetalle($workflow_ready);

						if( $detalle_ready ){
							// Obtenemos el detalle del nodo inicial y del siguiente
							$detalle_nodo = $nodo->getNodoByNum(99);

							// $detalle_nodo = $nodo->getNodoByNum(320);
							$siguiente_nodo = $nodo->getNodoByNum($detalle_nodo->num_nodo_salida);

							// Obtenemos el ejecutivo encargado de la promesa
							$encargado = $this->getUserByName( $promesado['Ejecutivo'] );

							$url = route('nodo', ['opp' => $promesa->opp, 'idNodo' => $siguiente_nodo->num_nodo]);

							// Mail::to( $encargado->email )->send(
							// 	// Notificación por email
							// 	new terminarNodo($siguiente_nodo->subactividad, $promesa->proyectos->nombre, $promesa->rut_cliente, $promesa->primer_nombre, $promesa->apellido_paterno, $url)
							// );

							Notificacion::create([
								// Notificacion web
								'usuario' => $encargado->id,
								'fecha_lectura' => NULL,
								'titulo' => 'Actividad pendiente',
								'detalle' => $siguiente_nodo->subactividad. ' ' . $promesa->proyectos->nombre . ' ' . $promesa->rut_cliente . ' ' . $promesa->primer_nombre . ' ' . $promesa->apellido_paterno, 
								'id_dw' => $detalle_ready,
								'id_nodo' => $siguiente_nodo->id,
								'url' => $url,
								'estado' => false
							]);

							// Insertamos otros nodos
							$insertNodos = [115, 150, 50, 590, 950, 960];
							foreach( $insertNodos as $numNodo ){
								$info = $nodo->getNodoByNum($numNodo);

								$nodoDetalle->create([
									'id_dw' => $detalle_ready,
									'id_nodo' => $info->id,
									'usuario' => $encargado->id,
									'fecha_salida' => null,
									'estado' => 3
								]);
							}

							$nodo_ready = $nodoDetalle->create([
								// Insertamos el detalle del nodo inicial
								'id_dw' => $detalle_ready,
								'id_nodo' => $detalle_nodo->id,
								'usuario' => $encargado->id,
								'fecha_salida' => null,
								'estado' => 13
							]);

							$siguiente_ready = $nodoDetalle->create([
								// Insertamos el detalle del siguiente nodo
								'id_dw' => $detalle_ready,
								'id_nodo' => $siguiente_nodo->id,
								'usuario' => $encargado->id,
								'fecha_salida' => null,
								'estado' => 3
							]);

							if( $nodo_ready && $siguiente_ready ){
							// if( $nodo_ready ){
								array_push( $complete, $promesa->opp );
							}
						}
					}
				}
			}
			else{
				// Actualizamos los datos
				array_push( $complete, $this->insertOrUpdate($promesado)->opp );
			}
		}

		return response()->json([
			'data' => (count($complete) > 0) ? $this->get($complete) : false,
			'count' => (count($complete))
		]);
	}

}