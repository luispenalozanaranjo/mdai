<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;

use App\Data as Promesas;
use App\Proyecto as Proyectos;
use App\Workflow;
use App\nodoDetalle as nodosDetalle;

class escrituracionController extends Controller{
	
	public function mainView(){
		$escrituracion = [
			'liquidacion' => (object) [
				'name' => 'Entrega de unidad',
				'route' => route('entrega-unidad-home'),
				'icon' => 'fa fa-key',
			]
		];

		return view( 'pages.escrituracion.main', [
			'title' => 'Escrituracion',
			'escrituracion' => $escrituracion
		]);
	}

	public function entregaUnidadView(){
		$promesas = new Promesas;
		$usuario = auth()->user();
		$proyectos = ( $usuario->is_admin() ) ? Proyectos::all() : $usuario->proyectos()->get();

		$estados = $promesas::groupBy('estado')->pluck('estado');

		return view( 'pages.escrituracion.entrega-unidad', [
			'title' => 'Entrega de unidad',
			'estados' => $estados,
			'proyectos' => $proyectos,
			'marcas' => $promesas->marcasList(),
			'ejecutivos' => $promesas->ejecutivosList()
		]);
	}

	public function searchEntregaUnidad(Request $request){
		// Busqueda de promesas
		$fields = $request->except('pagina');
		$pagina = $request->input('pagina');

		$promesas = Promesas::has('proyectos');
		$proyectos = auth()->user()->proyectos()->pluck('id_proyecto');
		$is_admin = auth()->user()->is_admin();

		if( count($proyectos) > 0 || $is_admin ){
			if( $fields['opp'] !== null ){
				// Filtramos por el RUT
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

	public function entregaUnidad(Request $request){
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
				$content->etapas = $nodosDetalle->getEntregaUnidad( $workflowInfo->detalles->id, $promesaDetalle->ejecutivo );

				return view( 'pages.promesas.entrega-unidad', [
					'title' => 'Entrega de unidad',
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

}