<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

// Models
use App\Data as Promesas;
use App\Dato as Datos;
use App\Formulario;
use App\Respuesta as Respuestas;
use App\Workflow;
use App\workflowDetalle;
use App\Nodo as Nodos;
use App\nodoDetalle as nodosDetalle;
use App\Documento;
use App\Proyecto as Proyectos;
use App\Etapa as Etapas;
use App\Usuario as Usuarios;
use App\Notificacion;
use App\Almacen as Almacen;
use App\Permisos as Permisos;
use App\permisoUsuario as permisosUsuarios;
use App\Excepcion;
use App\excepcionDetalle;
use App\excepcionDato;
use App\notificacionCheck as notificacion_check;
use App\comision;

// Mails
use App\Mail\terminarNodo;

class promesasController extends Controller{

	use Notifiable;

	public function denegarAccesoProyecto($opp){
		$promesa = Promesas::where('opp', $opp)->first();

		if( !empty($promesa) ){
			$proyecto = $promesa->proyectos()->first();
			$this->authorize('pass', $proyecto);
		}
	}

	public function getPromesa($idPromesa){
		// Obtenemos el detalle de una promesa
		try { return Promesas::findOrFail($idPromesa); }
		catch(\Exception $e){ return false; }
	}

	public function documentosView(Request $request){
		// Vista de la lista de documentos por promesa
		$promesas = new Promesas;
		$promesa = $promesas->getPromesaFull($request->opp);

		// La promesa no existe	
		if( !$promesa ) return abort(404);
		
		// La promesa existe, obtenemos la demás informacion
		$documentos = new Documento;
		$workflowObj = new Workflow;
		$workflow = $workflowObj->getWorkflow($promesa->opp);
		$documentos_all = $documentos->getAll($workflow->detalles->id);
		
		// Retornamos la vista
		return view( 'pages.promesas.documentos', [
			'title' => "Promesa $promesa->opp - Documentos subidos",
			'promesa' => $promesa,
			'workflow' => $workflow,
			'documentos' => $documentos_all,
			'total_documentos' => showTotal($documentos_all->count(), 'documento', 'documentos')
		]);
	}

	public function documentosSubir(Request $request){
		$promesas = new Promesas;
		$workflowObj = new Workflow;
		$nodos = new Nodos;
		$nodosDetalle = new nodosDetalle;
		$promesa = $promesas->getPromesaFull($request->opp);

		if( $promesa ){
			$workflow = $workflowObj->getWorkflow($promesa->opp);
			$nodoSubir = $nodos->getNodoByNum(50);
			$nodoDetalle = $nodosDetalle->getNodoDetalles( $nodoSubir->num_nodo, $workflow->detalles->id );

			$data = (object)[
				'promesa' => $promesa,
				'workflow' => $workflow,
				'nodo' => $nodoDetalle
			];

			return view( 'pages.promesas.documentos-subir', [
				'title' => 'Subir documento',
				'data' => $data
			]);
		}else{
			abort(404);
		}
	}

	public function busquedaView(Request $request){
		// Vista de página de búsqueda
		$promesas = new Promesas;
		$usuario = auth()->user();
		$proyectos = ( $usuario->is_admin() ) ? Proyectos::all() : $usuario->proyectos()->get();

		$estados = $promesas::groupBy('estado')->pluck('estado');

		return view( 'pages.promesas.busqueda', [
			'title' => 'Búsqueda promesa',
			'estados' => $estados,
			'proyectos' => $proyectos,
			'marcas' => $promesas->marcasList(),
			'ejecutivos' => $promesas->ejecutivosList()
		]);
	}
	public function busquedaComision(Request $request){
		// Vista de página de búsqueda
		$promesas = new Promesas;
		$usuario = auth()->user();
		$proyectos = ( $usuario->is_admin() ) ? Proyectos::all() : $usuario->proyectos()->get();

		$estados = $promesas::groupBy('estado')->pluck('estado');

		return view( 'pages.comisiones.busqueda-comision', [
			'title' => 'Búsqueda promesa',
			'estados' => $estados,
			'proyectos' => $proyectos,
			'marcas' => $promesas->marcasList(),
			'ejecutivos' => $promesas->ejecutivosList()
		]);
	}
	public function busquedaReversa(Request $request){
		// Vista de página de búsqueda
		$promesas = new Promesas;
		$usuario = auth()->user();
		$proyectos = ( $usuario->is_admin() ) ? Proyectos::all() : $usuario->proyectos()->get();

		$estados = $promesas::groupBy('estado')->pluck('estado');

		return view( 'pages.reversa.buscador-reversa', [
			'title' => 'Búsqueda Reversa operacion',
			'estados' => $estados,
			'proyectos' => $proyectos,
			'marcas' => $promesas->marcasList(),
			'ejecutivos' => $promesas->ejecutivosList()
		]);
	}


	public function getEtapa(Request $request){
		// Busqueda de promesas
		$etapas = Etapas::where('id_proyecto', $request->proyecto)->get();
		return response()->json( $etapas );
	}

	public function searchPromesas(Request $request){
		
		// Busqueda de promesas
		$fields = $request->except('pagina');
		$pagina = $request->input('pagina');

		$promesas = Promesas::has('proyectos');
		$proyectos = auth()->user()->proyectos()->pluck('id_proyecto');
		$is_admin = auth()->user()->is_admin();

		if( count($proyectos) > 0 || $is_admin ){
			if( $fields['opp'] !== null ){
				// Filtramos por la OPP
				$promesas->where('opp', $fields['opp']);
			}
			if( $fields['rut'] !== null ){
				// Filtramos por el RUT
				$promesas->where('rut_cliente', $fields['rut']);
			}
			if( $fields['nombre'] !== null ){
				// Filtramos por el Nombre
				$promesas->where('primer_nombre', 'like', '%' . $fields['nombre'] . '%');
			}
			if( $fields['apellido'] !== null ){
				// Filtramos por el Apellido
				$promesas->where('apellido_paterno', 'like', '%' . $fields['apellido'] . '%');
			}
			if( $fields['lote'] !== null ){
				// Filtramos por el Lote
				$promesas->where('lote', 'like', '%' . $fields['lote'] . '%');
			}
			if( $fields['proyecto'] !== null ){
				// Filtramos por el Proyecto
				$promesas->where('id_proyecto', $fields['proyecto']);
			}
			else{
				if( !$is_admin ){
					$promesas->whereIn('id_proyecto', $proyectos);
				}
			}
			if( $fields['tipo'] !== null ){
				// Filtramos por el Tipo
				$promesas->where('marca', $fields['tipo']);
			}
			if( $fields['ejecutivo'] !== null ){
				// Filtramos por el Ejecutivo
				$promesas->where('ejecutivo', $fields['ejecutivo']);
			}
			if( $fields['estado'] !== null ){
				// Filtramos por el Ejecutivo
				$promesas->where('estado', $fields['estado']);
			}
			if( $fields['etapa'] !== null ){
				// Filtramos por el Ejecutivo
				$promesas->where('id_etapa', $fields['etapa']);
			}
		
			$promesas->orderBy('opp');

			// Paginador
			Paginator::currentPageResolver(function() use ($pagina) {
				return $pagina;
			});

			$getPromesas = $promesas->paginate($fields['show']);
			// return response()->json($getPromesas);

			foreach( $getPromesas as $promesa ){
				// Agregamos el proyecto y la etapa
				$promesa->estados;
				$promesa->proyecto = $promesa->proyectos->nombre;
				$promesa->etapa = $promesa->etapas->nombre;
				$promesa->workflow_estado = $promesa->estadoWorkflow($promesa->opp);
				$promesa->workflow = $promesa->tieneWorkflow($promesa->opp);
			}
		}

		return response()->json( ( isset($getPromesas) && !empty($getPromesas) ) ? $getPromesas->toArray() : false );
	}

	public function detalleView(Request $request){
		// $this->denegarAccesoProyecto($request->opp);
		// Vista de detalle promesa
		$workflow = new Workflow;
		$promesas = new Promesas;

		$workflowInfo = $workflow->getWorkflow( $request->opp );

		if( $workflowInfo ){
			// El workflow existe
			$promesaDetalle = $promesas->getPromesaFull( $request->opp );

			if( $promesaDetalle ){
				// La promesa existe
				$nodosDetalle = new nodosDetalle;

				// Creamos el objeto con el contenido
				$content = new \stdClass;
				$content->promesa = $promesaDetalle;
				$content->etapas = $nodosDetalle->getResumen( $workflowInfo->detalles->id, $promesaDetalle->estado );
				$content->workflow_estado = $promesas->estadoWorkflow($request->opp);

				return view('pages.promesas.detalle', [
					'title' => 'Detalle promesa',
					'data' => $content
				]);
			}
			else{
				// La promesa no existe
				return abort(404, 'No se pudo encontrar el detalle de la OPP solicitada.');
			}
		}
		else{
			// El workflow no existe
			return abort(404, 'No se pudo encontrar el detalle del workflow de la OPP solicitada.');
		}
	}
	public function reversa(Request $request){
		
		$workflow = new Workflow;
		$promesas = new Promesas;

		$workflowInfo = $workflow->getWorkflow( $request->opp );

		if( $workflowInfo ){
			// El workflow existe
			$promesaDetalle = $promesas->getPromesaFull( $request->opp );

			if( $promesaDetalle ){
				// La promesa existe
				$nodosDetalle = new nodosDetalle;

				// Creamos el objeto con el contenido
				$content = new \stdClass;
				$content->promesa = $promesaDetalle;
				$content->etapas = $nodosDetalle->getResumen( $workflowInfo->detalles->id, $promesaDetalle->estado );
				$content->workflow_estado = $promesas->estadoWorkflow($request->opp);

				return view('pages.reversa.reversa', [
					'title' => 'Reversa OPP',
					'data' => $content
				]);
			}
			else{
				// La promesa no existe
				return abort(404, 'No se pudo encontrar el detalle de la OPP solicitada.');
			}
		}
		else{
			// El workflow no existe
			return abort(404, 'No se pudo encontrar el detalle del workflow de la OPP solicitada.');
		}



	}

	public function preReserva(Request $request){
			
			// Vista detalle del nodo

		// Vista de página de búsqueda
		$promesas = new Promesas;
		$usuario = auth()->user();
		$proyectos = ( $usuario->is_admin() ) ? Proyectos::all() : $usuario->proyectos()->get();

		$estados = $promesas::groupBy('estado')->pluck('estado');

		return view( 'pages.prereserva.prereserva', [
			'title' => 'Búsqueda promesa',
			'estados' => $estados,
			'proyectos' => $proyectos,
			'marcas' => $promesas->marcasList(),
			'ejecutivos' => $promesas->ejecutivosList()
		]);

	}

	public function listprereserva(Request $request){
		// Vista detalle del nodo
		// $this->denegarAccesoProyecto($request->opp);
		
		$workflow = new Workflow;
		$promesas = new Promesas;
		$usuarios = new Usuarios;
		$notificacion = new Notificacion;
//dd($request);

		$workflowInfo = $workflow->getWorkflow($request->opp);

		if( $workflowInfo ){
			// Si el workflow existe
			$nodosDetalle = new nodosDetalle;
			$formulario = new Formulario;

			// Obtenemos la data
			$promesaDetalle = $promesas->getPromesaFull($request->opp);
			$nodoDetalle = $nodosDetalle->getNodoDetalles( $request->idNodo, $workflowInfo->detalles->id );

			if( $nodoDetalle ){
				// Revisamos los permidos
				$permissions = auth()->user()->permisos->where('num_nodo', $nodoDetalle->nodo->num_nodo)->first();
				$can_edit = ( !empty($permissions) || auth()->user()->is_admin() ) ? true : false;

				// Verificamos si tiene notificacion
				$notificacion->findAndMark($workflowInfo->detalles->id, $nodoDetalle->nodo->id);

				// Obtenemos el checklist si es que tiene
				$tipo_credito = ( $promesaDetalle->tipo_credito ) ? $promesaDetalle->tipo_credito : null;
				$checklist = $formulario->getFormularioFull( $promesaDetalle->marca, $nodoDetalle->id_dw, $request->idNodo, $tipo_credito );

				if( $checklist ){
					// Existe un checklist
					foreach( $checklist->preguntas as $pregunta ){
						// Buscamos las excepciones en cada pregunta
						$excepcion = Excepcion::with('estado')
						->where('id_nd', $nodoDetalle->id)
						->where('id_pregunta', $pregunta->id)
						->first();

						if( $excepcion && $excepcion['id_estado'] == 3 ){
							// Excepcion pendiente
							$pregunta->respuesta = false;
						}

						$pregunta->excepcion = $excepcion;
					}
				}
				//dd($nodoDetalle);		 
				if( $promesaDetalle && $nodoDetalle ){
					// La promesa existe
					$data = (object) [
						'promesa' => $promesaDetalle,
						'nodo' => $nodoDetalle,
						'checklist' => $checklist,
						'ejecutivos' => $usuarios->getUsersCargo(7),
						'excepcionadores' => $usuarios->getExcepcionadores(),
						'can_edit' => $can_edit
					];

					
					// return response()->json($data);
					return view('pages.prereserva.listprereserva', [
						'title' => 'Detalle promesa',
						'data' => $data
					]);
				}
				else{
					// La promesa no existe
					return abort(404, 'La promesa no existe.');
				}
			}
			else{
				// El nodo no está creado
				return abort(404, 'El nodo no está creado.');
			}
		}
		else{
			// El workflow no existe
			return abort(404, 'El workflow no existe.');
		}
	}

	public function detallePreReserva(Request $request){
		// $this->denegarAccesoProyecto($request->opp);
		// Vista de detalle promesa
		$workflow = new Workflow;
		$promesas = new Promesas;

		$workflowInfo = $workflow->getWorkflow( $request->opp );

		if( $workflowInfo ){
			// El workflow existe
			$promesaDetalle = $promesas->getPromesaFull( $request->opp );

			if( $promesaDetalle ){
				// La promesa existe
				$nodosDetalle = new nodosDetalle;

				// Creamos el objeto con el contenido
				$content = new \stdClass;
				$content->promesa = $promesaDetalle;
				$content->etapas = $nodosDetalle->getResumen( $workflowInfo->detalles->id, $promesaDetalle->estado );
				$content->workflow_estado = $promesas->estadoWorkflow($request->opp);

				return view('pages.prereserva.detalleprereserva', [
					'title' => 'Detalle promesa',
					'data' => $content
				]);
			}
			else{
				// La promesa no existe
				return abort(404, 'No se pudo encontrar el detalle de la OPP solicitada.');
			}
		}
		else{
			// El workflow no existe
			return abort(404, 'No se pudo encontrar el detalle del workflow de la OPP solicitada.');
		}
	}

	public function spReversa(Request $request){
		$data = DB::select('call sp_reversa_opp(?, ?, ?)', array($request->opp, $request->nodo_actual,$request->reversar));
	}

	public function comision(Request $request){
		// Vista detalle del nodo
		// $this->denegarAccesoProyecto($request->opp);
		
		$workflow = new Workflow;
		$promesas = new Promesas;
		$usuarios = new Usuarios;
		$notificacion = new Notificacion;
//dd($request);

		$workflowInfo = $workflow->getWorkflow($request->opp);

		if( $workflowInfo ){
			// Si el workflow existe
			$nodosDetalle = new nodosDetalle;
			$formulario = new Formulario;

			// Obtenemos la data
			$promesaDetalle = $promesas->getPromesaFull($request->opp);
			$nodoDetalle = $nodosDetalle->getNodoDetalles( $request->idNodo, $workflowInfo->detalles->id );

			if( $nodoDetalle ){
				// Revisamos los permidos
				$permissions = auth()->user()->permisos->where('num_nodo', $nodoDetalle->nodo->num_nodo)->first();
				$can_edit = ( !empty($permissions) || auth()->user()->is_admin() ) ? true : false;

				// Verificamos si tiene notificacion
				$notificacion->findAndMark($workflowInfo->detalles->id, $nodoDetalle->nodo->id);

				// Obtenemos el checklist si es que tiene
				$tipo_credito = ( $promesaDetalle->tipo_credito ) ? $promesaDetalle->tipo_credito : null;
				$checklist = $formulario->getFormularioFull( $promesaDetalle->marca, $nodoDetalle->id_dw, $request->idNodo, $tipo_credito );

				if( $checklist ){
					// Existe un checklist
					foreach( $checklist->preguntas as $pregunta ){
						// Buscamos las excepciones en cada pregunta
						$excepcion = Excepcion::with('estado')
						->where('id_nd', $nodoDetalle->id)
						->where('id_pregunta', $pregunta->id)
						->first();

						if( $excepcion && $excepcion['id_estado'] == 3 ){
							// Excepcion pendiente
							$pregunta->respuesta = false;
						}

						$pregunta->excepcion = $excepcion;
					}
				}
				//dd($nodoDetalle);		 
				if( $promesaDetalle && $nodoDetalle ){
					// La promesa existe
					$data = (object) [
						'promesa' => $promesaDetalle,
						'nodo' => $nodoDetalle,
						'checklist' => $checklist,
						'ejecutivos' => $usuarios->getUsersCargo(7),
						'excepcionadores' => $usuarios->getExcepcionadores(),
						'can_edit' => $can_edit
					];

					
					// return response()->json($data);
					return view('pages.comisiones.comision', [
						'title' => 'Detalle promesa',
						'data' => $data
					]);
				}
				else{
					// La promesa no existe
					return abort(404, 'La promesa no existe.');
				}
			}
			else{
				// El nodo no está creado
				return abort(404, 'El nodo no está creado.');
			}
		}
		else{
			// El workflow no existe
			return abort(404, 'El workflow no existe.');
		}
	}
	public function nodoView(Request $request){
		// Vista detalle del nodo
		// $this->denegarAccesoProyecto($request->opp);
		
		$workflow = new Workflow;
		$promesas = new Promesas;
		$usuarios = new Usuarios;
		$notificacion = new Notificacion;
        $notificacion_check = new notificacion_check;
		$workflowInfo = $workflow->getWorkflow($request->opp);

		if( $workflowInfo ){
			// Si el workflow existe
			$nodosDetalle = new nodosDetalle;
			$formulario = new Formulario;

			// Obtenemos la data
			$promesaDetalle = $promesas->getPromesaFull($request->opp);
			$nodoDetalle = $nodosDetalle->getNodoDetalles( $request->idNodo, $workflowInfo->detalles->id );

			if( $nodoDetalle ){
				// Revisamos los permidos
				$permissions = auth()->user()->permisos->where('num_nodo', $nodoDetalle->nodo->num_nodo)->first();
				$can_edit = ( !empty($permissions) || auth()->user()->is_admin() ) ? true : false;

				// Verificamos si tiene notificacion
				$notificacion->findAndMark($workflowInfo->detalles->id, $nodoDetalle->nodo->id);

				// Obtenemos el checklist si es que tiene
				$tipo_credito = ( $promesaDetalle->tipo_credito ) ? $promesaDetalle->tipo_credito : null;
				$checklist = $formulario->getFormularioFull( $promesaDetalle->marca, $nodoDetalle->id_dw, $request->idNodo, $tipo_credito );

				if( $checklist ){
					// Existe un checklist
					foreach( $checklist->preguntas as $pregunta ){
						// Buscamos las excepciones en cada pregunta
						$excepcion = Excepcion::with('estado')
						->where('id_nd', $nodoDetalle->id)
						->where('id_pregunta', $pregunta->id)
						->first();

						if( $excepcion && $excepcion['id_estado'] == 3 ){
							// Excepcion pendiente
							$pregunta->respuesta = false;
						}

						$pregunta->excepcion = $excepcion;
						$pregunta->documento;
					}
				}
				 
				if( $promesaDetalle && $nodoDetalle ){
					// La promesa existe
					if ($nodoDetalle->nodo->num_nodo ==  580 || $nodoDetalle->nodo->num_nodo == 581) {
						//GG
						
						$registro = $notificacion_check->where('id_dw', $nodoDetalle->id_dw)->first();
						//si no tiene poner enviado
						if ($registro) {
							$data = (object) [
								'promesa' => $promesaDetalle,
								'nodo' => $nodoDetalle,
								'checklist' => $checklist,
								'ejecutivos' => $usuarios->getUsersCargo(7),
								'excepcionadores' => $usuarios->getExcepcionadores(),
								'can_edit' => $can_edit,
								'estado_notificacion' => $registro->estado
							];
						}else{
							
							$data = (object) [
								'promesa' => $promesaDetalle,
								'nodo' => $nodoDetalle,
								'checklist' => $checklist,
								'ejecutivos' => $usuarios->getUsersCargo(7),
								'excepcionadores' => $usuarios->getExcepcionadores(),
								'can_edit' => $can_edit
							];

						}
						
					}else{

						$data = (object) [
							'promesa' => $promesaDetalle,
							'nodo' => $nodoDetalle,
							'checklist' => $checklist,
							'ejecutivos' => $usuarios->getUsersCargo(7),
							'excepcionadores' => $usuarios->getExcepcionadores(),
							'can_edit' => $can_edit
						];
					}
					
					// return response()->json($data);
					return view('pages.promesas.detalle-nodo', [
						'title' => 'Detalle promesa',
						'data' => $data
					]);
				}
				else{
					// La promesa no existe
					return abort(404, 'La promesa no existe.');
				}
			}
			else{
				// El nodo no está creado
				return abort(404, 'El nodo no está creado.');
			}
		}
		else{
			// El workflow no existe
			return abort(404, 'El workflow no existe.');
		}
	}

	public function getAlmacen(Request $request){
		$arr = $request->all();
		$almacen = [];
		$datos = Almacen::whereIn('id', $arr)->get();

		foreach( $datos as $dato ){
			// $dato->value = ($dato->type === 'select') ? 'Seleccione' : null;
			$almacen[$dato->slug] = $dato;
			$almacen[$dato->slug]['value'] = null;
			$almacen[$dato->slug]['observaciones'] = null;
		}

		return $almacen;
	}

	public function getDetallesNodo(Request $request){
		$workflow = new Workflow;
		$documentos = new Documento;
		$datos = new Datos;

		$data = new \stdClass;
		$data->detalles = $datos->getDetalles( $request->id_nd );
		$data->file = $documentos->getFile( $request->id_nd );

		return response()->json( $data );
	}
	
	public function guardarDetallesNodo(Request $request){
		// Ejecuta el método para guardar los datos (Route)
		return $this->guardarDetalleNodo([
			'id_ed' => ($request->has('id_ed')) ? $request->id_ed : false,
			'id_nd' => ($request->has('id_nd')) ? $request->id_nd : false,
			'fields' => $request->fields
		]);
	}

	public function guardarDetalleNodo($data){
		// Guarda los datos de un nodo

		if( $data['id_ed'] ){
			// Estamos guardando una excepción
			$datos = new excepcionDato;
			$id = $data['id_ed'];
			$data['id_ed'] = $id;
		}
		else{
			// Estamos guardando un nodo normal
			$datos = new Datos;
			$id = $data['id_nd'];
			$data['id_nd'] = $id;
		}

		$datos->deleteDetalles( $id );
		foreach( $data['fields'] as $field ){
			if( array_key_exists('value', $field) && $field['value'] !== null ){
				$content = [
					'value' => ($field['value']) ? $field['value'] : 0,
					'id_datos' => $field['id'],
					'observaciones' => ( array_key_exists('observaciones', $field) ) ? $field['observaciones'] : null
				];

				if( $data['id_ed'] ){
					$content['id_ed'] = $id;
				}
				else{
					$content['id_nd'] = $id;
				}

				$datos->insertDetalles($content);
			}
		}
		return response()->json( true );
	}

	public function obtenerNotificacion($usuarios, $siguiente, $request){
		$workflowDetalle = new workflowDetalle;
		$id_dw = $request->nodo['id_dw'];

		$promesa = $workflowDetalle->getDetalle($id_dw);
		$usuario_info = $promesa->workflow->promesa;
		
		$url = route('nodo', ['opp' => $promesa->workflow->opp, 'idNodo' => $siguiente->num_nodo]);
		
		try {
			foreach( $usuarios as $user ){
				$usuario = Usuarios::find($user);
				// Recorremos la lista de usuarios
				Mail::to( $usuario->email )->send(
					// Notificación por email
					new terminarNodo($siguiente->subactividad, $usuario_info->proyectos->nombre, $usuario_info->rut_cliente, $usuario_info->primer_nombre, $usuario_info->apellido_paterno, $url)
				);

				Notificacion::create([
					// Notificacion web
					'usuario' => $usuario->id,
					'fecha_lectura' => NULL,
					'titulo' => 'Actividad pendiente',
					'detalle' => $siguiente->subactividad. ' ' . $usuario_info->proyectos->nombre . ' ' . $usuario_info->rut_cliente . ' ' . $usuario_info->primer_nombre . ' ' . $usuario_info->apellido_paterno, 
					'id_dw' => $id_dw,
					'id_nodo' => $siguiente->id,
					'url' => $url,
					'estado' => false
				]);
				// sleep(1);
			}
		}
		catch (\Throwable $th) {
			//throw $th;
			foreach( $usuarios as $user ){
				// Recorremos la lista de usuarios
				$usuario = Usuarios::find($user);
				Notificacion::create([
					// Notificacion web
					'usuario' => $usuario->id,
					'fecha_lectura' => NULL,
					'titulo' => 'Actividad pendiente',
					'detalle' => $siguiente->subactividad. ' ' . $usuario_info->proyectos->nombre . ' ' . $usuario_info->rut_cliente . ' ' . $usuario_info->primer_nombre . ' ' . $usuario_info->apellido_paterno, 
					'id_dw' => $id_dw,
					'id_nodo' => $siguiente->id,
					'url' => $url,
					'estado' => false
				]);
				// sleep(1);
			}
		}
	}

	public function notificacionEntregaUnidad(Request $request){
		$nodos = new Nodos;
		$nodosDetalle = new nodosDetalle;
		$salida = 590;
		$permisos_id = Permisos::where('num_nodo', $salida)->pluck('id');
		$usuarios_nodo = permisosUsuarios::whereIn('id_permiso', $permisos_id)->pluck('id_usuario')->toArray();
		array_push($usuarios_nodo, 1);
		$siguiente_nodo = new \stdClass;
		$siguiente_nodo->num_nodo = 590;
		$siguiente_nodo->subactividad = "Entrega de Unidad";
		$siguiente_nodo->id = 54;
		$valor_check = $request->valor;
		$id_check = $request->id_check;
		$id_dw = $request->nodo['id_dw'];
		$notificacion_check = new notificacion_check;
        $estado = ($request->estado) ? $request->estado : "Enviado";
	
		if( $valor_check == 1 ){
			//$notificacion_check =  $notificacion_check->buscaNotificacion($id_dw,$id_check);

			$registro = $notificacion_check->where('id_dw', $id_dw)->where('id_check', $id_check)->first();
			if( $registro ){
				$data = $registro;
				$data->existe = true;
				return response()->json( $data );
			}
			else {
				notificacion_check::create(["id_dw"=>$id_dw,"id_check"=>$id_check,"estado"=>$estado]);
				if( $estado == "Enviado" ){
					$data =$this->obtenerNotificacion($usuarios_nodo, $siguiente_nodo, $request);
				}
					
				$data = ($estado=="Enviado") ? "Notificacion enviada" : "Notificacion se enviara en actividad correspondiente";	
				return response()->json( $data );	  
			}
		}
	}

	public function switchSiguiente($object){
		$siguiente = $object->num_nodo_salida;
		$num_nodo_salida = $object->num_nodo_salida;

		if( $num_nodo_salida === 220 ){
			// Primer checklist (etapa 1)
			switch( $object->marca ){
				case "Vulnerable":
					$siguiente = 230;
					break;
				case "Medio":
					$siguiente = 240;
					break;
				case "Privado":
					$siguiente = 250;
					break;
			}
		}
		elseif( $num_nodo_salida === 330 ){
			// Checklist Vigenteo 1
			switch( $object->marca ){
				case "Vulnerable":
					$siguiente = 340;
					break;
				case "Medio":
					$siguiente = 350;
					break;
				case "Privado":
					$siguiente = 360;
					break;
			}
		}
		elseif( $num_nodo_salida === 400 ){
			if( $object->tipo_credito === 'Contado' ){
				switch( $object->marca ){
					case "Vulnerable":
					case "Medio":
						$siguiente = 410;
						break;
					case "Privado":
						$siguiente = 460;
						break;
				}
			}
			elseif( $object->tipo_credito === 'Gestión Propia' ){
				switch( $object->marca ){
					case "Privado":
					case "Medio":
						$siguiente = 450;
						break;
				}
			}
			elseif( $object->tipo_credito === 'Gestión MDAI' ){
				switch( $object->marca ){
					case "Privado":
						$siguiente = 430;
						break;
					case "Medio":
						$siguiente = 420;
						break;
				}
			}
		}
		elseif($num_nodo_salida === 128 ) {
			switch ($object->cambio_unidad_tipo) {
				case 'mayor valor':
					$siguiente = 117;
					break;
				
				case 'menor o igual valor':
					if($object->marca == "Privado"){
						$siguiente = 119;
					}
					elseif($object->marca == "Medio"){
						$siguiente = 120;
					}
					elseif ($object->marca== "Vulnerable") {
						$siguiente = 120;
					}
					break;
			}
		}
		elseif( $num_nodo_salida === 129 ){
			switch( $object->autoriza_cambio_unidad ){
				case 'aprobado':
					if ($object->marca == "Privado") {
						$siguiente = 119;
					}
					elseif ($object->marca == "Medio" || $object->marca == "Vulnerable") {
						$siguiente = 120;
					}
					break; 
				case 'rechazado':
					$siguiente = 118;
					break;
			}
		}
		elseif( $num_nodo_salida === 153 ){
			switch( $object->cliente_desiste ){
				case 'desiste':
					$siguiente = 154;
					break;
				case 'no desiste':
					$siguiente = 172;
					break;
			}
		}
		elseif( $num_nodo_salida === 155 ){
			switch( $object->tiene_gops ){
				case 'sin gops':
					$siguiente = 156;
					break;
				case 'con gops':
					$siguiente = 157;
				break;
			}
		}
		elseif( $num_nodo_salida === 102 ){
			switch( $object->autoriza_cambio_unidad ){
				case 'autoriza':
					$siguiente = 0;
					break;
				case 'no autoriza':
					$siguiente = 102;
					break;
				default:
					break;
			}
		}
		elseif($num_nodo_salida === 471){
			if( $object->marca === 'Privado' ){
				$siguiente = 511;
			}
			else{
				$siguiente = 500;
			}
		}
		elseif ($num_nodo_salida === 501) {
			if ($object->marca === 'Vulnerable' || $object->marca === 'Medio') {
				$siguiente = 510;
			}
			
		}
		elseif($num_nodo_salida === 512){
			switch( $object->marca ){
				case 'Vulnerable':
					$siguiente = 520;
					break;
				case 'Medio':
				case 'Privado':
					if( $object->tipo_credito === 'Contado' ){
						$siguiente = 520;
						break;
					}
					else{
						$siguiente = 521;
						break;
					}
			}
		}
		elseif( $num_nodo_salida === 571 ){
			switch( $object->marca ){
				case 'Vulnerable':
					$siguiente = 580;
					break;
				case 'Medio':
				case 'Privado':
					if( $object->tipo_credito === 'Contado' ){
						$siguiente = 580;
						break;
					}
					else if( $object->tipo_credito !== 'Contado' ){
						$siguiente = 581;
						break;
					}
			}
		}
		elseif ($num_nodo_salida === 999) {
			$siguiente = 0;
		}

		return $siguiente;
	}

	public function terminarNodo(Request $request){
		$result = null;
		$estado = 3;
		$users = 19;
		$nodos = new Nodos;
		$nodosDetalle = new nodosDetalle;
		$salida = $request->nodo['nodo']['num_nodo_salida'];
		$result = false;
		$exclude = [99, 999, 1000];

		if( !empty($request->all()) ){
			// Actualimos el estado y guardamos el siguiente
			$terminado = $nodosDetalle->terminarNodo($request->nodo['id_nodo'], $request->nodo['id_dw']);

			// Verificamos si tiene notificacion
			$notificacion = new Notificacion;
			$notificacion->findAndMark($request->nodo['id_dw'], $request->nodo['id_nodo']);

			// Buscamos los usuarios que tengan permisos para el siguiente nodo
			$permisos_id = Permisos::where('num_nodo', $salida)->pluck('id');
			$usuarios_nodo = permisosUsuarios::whereIn('id_permiso', $permisos_id)->pluck('id_usuario')->toArray();

			// Agregamos al admin a la lista de correos
			array_push($usuarios_nodo, 1);

			// Buscamos el siguiente
			$tipo_credito = ( isset($request->tipo_credito) ) ? $request->tipo_credito : false;
			$cambio_unidad_tipo = ( isset($request->cambio_unidad_tipo) ) ? $request->cambio_unidad_tipo : false;
			$autoriza_cambio_unidad = (isset($request->autoriza)) ? $request->autoriza : false;
			$cliente_desiste = (isset($request->cliente_desiste)) ? $request->cliente_desiste : false;
			$tiene_gops = (isset($request->tiene_gops)) ? $request->tiene_gops : false;

			$switch_obj = (object)[
				'marca' => $request->marca,
				'num_nodo_salida' => $salida,
				'tipo_credito' => $tipo_credito,
				'cambio_unidad_tipo' => $cambio_unidad_tipo,
				'autoriza_cambio_unidad' => $autoriza_cambio_unidad,
				'cliente_desiste' => $cliente_desiste,
				'tiene_gops' => $tiene_gops
			];

			$siguiente = $this->switchSiguiente($switch_obj);
			$siguiente_nodo = $nodos->getNodoByNum( $siguiente );

			if( $terminado ){
				// Nodo terminado
				$result = true;

				if( $siguiente_nodo ){
					// Si hay un nodo siguiente, lo creamos
					$siguiente_ready = $nodosDetalle->create([
						'id_dw' => $request->nodo['id_dw'],
						'id_nodo' => $siguiente_nodo->id,
						'usuario' => $request->nodo['usuario'],
						'fecha_salida' => null,
						'estado' => $estado
					]);

					if( $siguiente_ready ){
						// El siguiente nodo se creo bien
						$result = true;

						if( !empty($usuarios_nodo) ){
							// Mandamos la notificacion
							if( !in_array($siguiente_nodo->num_nodo, $exclude) ){
								// Si no esta en la lista, mandamos la notificacion
								$this->obtenerNotificacion($usuarios_nodo, $siguiente_nodo, $request);
							}
						}
					}
				}
			}
		}
		
		return response()->json( $result );
	}

	public function guardarRespuestas(Request $request){
		$id_nodo = $request->id_nodo;

		if( count($request->checklist) > 0 ){
			// Actualizamos o insertamos las nuevas
			foreach( $request->checklist as $field ){
				if( $field['valor'] !== null || $field['titular'] !== null ){
					// Si tiene un valor continuamos
					$respuestas = new Respuestas;
					$respuestas->updateOrCreate(
						['id_preg' => $field['id_preg'], 'id_dw' => $field['id_dw']],
						$field
					);
				}
			}
		}

		// Guardamos los demás datos
		$detalles = $this->guardarDetalleNodo([
			'id_ed' => ($request->has('id_ed')) ? $request->id_ed : false,
			'id_nd' => $request->id_nd,
			'fields' => $request->fields
		]);

		return response()->json( ($detalles ) ? true : false );
	}

	public function digitalizar(Request $request){
		$file = $request->file('file');

		if( $file && $file->getClientOriginalExtension() ){
			$validator = Validator::make($request->all(), [
				'file' => 'max:20000'
			]);

			// La validación del tamaño falló
			if( $validator->fails() ) return response()->json(['status' => false, 'message' => 'El archivo no puede superar los 20MB.']);

			// Se inicia la subida del archivo
			$folder = 'promesas';
			$datePath = date('Y') . "/" . date('m');
			$extension = $file->getClientOriginalExtension();
			$hash = Str::random(5);
			$name = $hash . '_file_dw_' . $request->id_dw . '.' . $extension;

			$documentos = new Documento;
			$current_files = $documentos->getFiles( $request->id_nd );
			$nodo = Nodos::find( nodosDetalle::find($request->id_nd)->id_nodo );

			if( $current_files && $nodo->num_nodo !== 50 && !isset($request->id_preg) ){
				// Tiene archivos previos
				foreach( $current_files as $archivo ){
					if( $documentos->deleteFile($archivo->nombre_archivo) ){
						// Eliminamos el registro y el archivo
						Storage::disk($folder)->delete($datePath . '/' . $archivo->nombre_archivo);
					}
				}
			}

			if( isset($request->id_preg) ){
				// El documento viene con un id de pregunta
				$current_files = Documento::where('id_nd', $request->id_nd)->where('id_preg', $request->id_preg)->get();
				foreach( $current_files as $archivo ){
					if( $documentos->deleteFile($archivo->nombre_archivo) ){
						// Eliminamos el registro y el archivo
						Storage::disk($folder)->delete($datePath . '/' . $archivo->nombre_archivo);
					}
				}
			}

			if( $file->storeAs($datePath, $name, $folder) ){
				// Se guardó el archivo
				$documento = [
					'ruta' => $folder . '/'. $datePath . '/'. $name,
					'nombre_archivo' => $name,
					'nombre_original' => $file->getClientOriginalName(),
					'comentarios' => ($request->comentarios) ? $request->comentarios : null,
					'id_dw' => $request->id_dw,
					'id_nd' => $request->id_nd,
					'id_preg' => $request->id_preg ? $request->id_preg : null
				];

				$documentos->saveFile($documento);
				$data = [
					'response' => ['status' => true, 'message' => 'Documento subido correctamente.'],
					'documento' => $documento
				];
			}

			// Retornamos la data
			return response()->json($data);
		}
	}

	public function updateTipoCredito(Request $request){
		// Actualizamos el tipo de crédito de una promesa
		$promesaInst = new Promesas;
		$promesa = $promesaInst->getPromesa($request->opp);
		$response = false;

		if( $promesa ){
			// Si la promesa existe actualizamos el valor
			$promesa->tipo_credito = $request->tipo_credito;
			$response = $promesa->save();
		}

		return response()->json( $response );
	}

	public function aprobacionComercial(Request $request){
		// Actualizamos el valor del la nueva unidad cambiada de una promesa
		$promesaInst = new Promesas;
		$promesa = $promesaInst->getPromesa($request->opp);
		$response = false;

		if( $promesa ){
			$promesa->cambio_unidad_tipo = $request->cambio_unidad_tipo;

			if( $promesa->save() ){
				// Actualizamos el dato en la promesa
				$this->guardarDetalleNodo([
					// Guardamos los demás datos
					'id_ed' => ($request->has('id_ed')) ? $request->id_ed : false,
					'id_nd' => $request->id_nd,
					'fields' => $request->fields
				]);

				$response = true;
			}
		}

		return response()->json( $response );
	}

	public function cambioUnidadView(Request $request){
		// Vista de página cambio de unidad
		$workflow = new Workflow;
		$promesas = new Promesas;

		$workflowInfo = $workflow->getWorkflow( $request->opp );

		if( $workflowInfo ){
			// El workflow existe
			$promesaDetalle = $promesas->getPromesaFull( $request->opp );

			if( $promesaDetalle ){
				// La promesa existe
				$nodosDetalle = new nodosDetalle;

				// Creamos el objeto con el contenido
				$content = new \stdClass;
				$content->promesa = $promesaDetalle;
				$content->etapas = $nodosDetalle->getCambioUnidad( $workflowInfo->detalles->id, $promesaDetalle->ejecutivo );

				return view( 'pages.promesas.cambio-unidad', [
					'title' => 'Cambio de unidad',
					'data' => $content
				]);
			}
			else{
				// La promesa no existe
				return abort(404);
			}
		}
		else{
			// El workflow no existe
			return abort(404);
		}
	}

	public function desistimientoView(Request $request){
		// Vista de página cambio de unidad
		$workflow = new Workflow;
		$promesas = new Promesas;

		$workflowInfo = $workflow->getWorkflow( $request->opp );

		if( $workflowInfo ){
			// El workflow existe
			$promesaDetalle = $promesas->getPromesaFull( $request->opp );

			if( $promesaDetalle ){
				// La promesa existe
				$nodosDetalle = new nodosDetalle;

				// Creamos el objeto con el contenido
				$content = new \stdClass;
				$content->promesa = $promesaDetalle;
				$content->etapas = $nodosDetalle->getDesistimiento( $workflowInfo->detalles->id, $promesaDetalle->ejecutivo );

				return view( 'pages.promesas.cambio-unidad', [
					'title' => 'Desistimiento',
					'data' => $content
				]);
			}
			else{
				// La promesa no existe
				return abort(404);
			}
		}
		else{
			// El workflow no existe
			return abort(404);
		}
	}

	public function getDatos(Request $request){
		$workflow = new Workflow;
		$datos = new Datos;
		$nodos = new Nodos;
		$nodoDetalles = new nodosDetalle;

		$workflowInfo = $workflow->getWorkflow( $request->opp );
		$detalleWorkflow = $workflowInfo->detalles->id;

		$nodos = $nodos->whereIn('num_nodo', $request->num_nodo)->pluck('id');
		$detalles = $nodoDetalles->whereIn('id_nodo', $nodos)->where('id_dw', $detalleWorkflow)->get();

		return response()->json( $datos->getDatos($request->fields, $detalles) );
	}

	public function guardarComision(Request $request){
		$comision = new comision;
		$opp = $request->opp;
		$nodo = $request->nodo;
		$estado = $request->estado;

		$result = $comision->where('opp',$opp)->first();

		if( $result ){
			return "La comision ya existe";
		}
		else{
			$comision->opp = $opp;
			$comision->nodo = $nodo;
			$comision->estado = $estado;
			$comision->save();
			return $comision;
		}
	}

	public function notificacion580(Request $request){
		$nodos = new Nodos;
		$nodosDetalle = new nodosDetalle;
		$salida = 590;
		$permisos_id = Permisos::where('num_nodo', $salida)->pluck('id');
		$usuarios_nodo = permisosUsuarios::whereIn('id_permiso', $permisos_id)->pluck('id_usuario')->toArray();
		array_push($usuarios_nodo, 1);
		$siguiente_nodo = new \stdClass;
		$siguiente_nodo->num_nodo = 590;
		$siguiente_nodo->subactividad = "Entrega de Unidad";
		$siguiente_nodo->id = 54;
		
		$id_dw = $request->nodo['id_dw'];
		$notificacion_check = new notificacion_check;
        $estado = "Enviado";
	
		//$notificacion_check =  $notificacion_check->buscaNotificacion($id_dw,$id_check);

		$registro = $notificacion_check->where('id_dw', $id_dw)->first();
		if( $registro ){
			$registro['estado']= $estado;
			$registro->update();
			$data =$this->obtenerNotificacion($usuarios_nodo, $siguiente_nodo, $request);
			$data = "Ok";
			return response()->json( $data );
		}
	}
}