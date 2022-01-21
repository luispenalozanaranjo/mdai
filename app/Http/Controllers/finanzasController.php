<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntidadFinanciera as Entidades;
use App\Data as Data;
use App\Proyecto as Proyectos;
use App\Etapa as Etapas;
use App\Dato as Datos;
use App\Almacen;
use App\Workflow;
use App\workflowDetalle;
use App\Nodo as Nodos;
use App\nodoDetalle as nodosDetalle;

class finanzasController extends Controller{

	public function mainView(){
		// GET - Página inicial de finanzas
		$finanzas = [
			'liquidacion' => (object) [
				'name' => 'Liquidacion de gastos operacionales',
				'route' => route('finanzas.liquidacion.busqueda'),
				'bg' => 'bg-orange',
				'icon' => 'fa fa-file-invoice-dollar'
			],
			'pago' => (object) [
				'name' => 'Pago Operación',
				'route' => route('finanzas.pago.busqueda'),
				'bg' => 'bg-purple',
				'icon' => 'fa fa-donate'
			]
		];

		// Retornamos la data
		return view('pages.finanzas.finanzas', [
			'title' => 'Finanzas',
			'finanzas' => $finanzas
		]);
	}
	
	public function imprimeExcel(){
		
	}

	public function busquedaLiquidacionView(Request $request){
		// GET - Página inicial de Liquidación gastos operacionales
		$promesas = new Data;
		$todasPromesas = Data::where('estado', 'Promesada')->get();
		$usuario = auth()->user();
		$proyectos = ( $usuario->is_admin() ) ? Proyectos::all() : $usuario->proyectos()->get();
		
		$nodoDetalle = [];
		
		// if( $todasPromesas ){
		// 	foreach( $todasPromesas as $promesa ){
		// 		$workflow = Workflow::where('opp', $promesa->opp)->first();
		// 		$id_wf = $workflow->id;
		// 		$detalle_wf = workflowDetalle::where('id_workflow', $id_wf)->first();
		// 		$id_dw = $detalle_wf->id;
		// 		$detalleaux = nodosDetalle::where('id_dw', $id_dw)->where('id_nodo', 97)->first();
		// 		$detalleaux['opp'] = $promesa->opp;
		// 		$nodoDetalle[] = $detalleaux;
		// 	}
		// }

		return view( 'pages.promesas.busqueda-finanzas-liquidacion', [
			'title' => 'Liquidación gastos operacionales',
			'estados' => Data::groupBy('estado')->pluck('estado'),
			'proyectos' => $proyectos,
			'marcas' => $promesas->marcasList(),
			'ejecutivos' => $promesas->ejecutivosList(),
			// 'nodos' => $nodoDetalle
		]);
	}
	
	public function busquedaPagoView(Request $request){
		// GET - Página de búsqueda de pago operación
		$promesas = new Data;
		$todasPromesas = Data::where('estado', 'Promesada')->get();
		$usuario = auth()->user();
		$proyectos = ( $usuario->is_admin() ) ? Proyectos::all() : $usuario->proyectos()->get();
		// $nodoDetalle = [];
		
		// if( $todasPromesas ){
		// 	foreach( $todasPromesas as $promesa ){
		// 		$workflow = Workflow::where('opp', $promesa->opp)->first();
		// 		$id_wf = $workflow->id;
		// 		$detalle_wf = workflowDetalle::where('id_workflow',$id_wf)->first();
		// 		$id_dw = $detalle_wf->id;
		// 		$detalleaux = nodosDetalle::where('id_dw', $id_wf)->where('id_nodo',98)->first();
		// 		$detalleaux['opp'] = $promesa->opp;
		// 		$nodoDetalle[] = $detalleaux;
		// 	}
		// }

		return view( 'pages.promesas.busqueda-finanzas-pago', [
			'title' => 'Búsqueda Pago Operación',
			'estados' => $promesas::groupBy('estado')->pluck('estado'),
			'proyectos' => $proyectos,
			'marcas' => $promesas->marcasList(),
			'ejecutivos' => $promesas->ejecutivosList(),
			// 'nodos' =>$nodoDetalle
		]);
	}

	public function totalPromesas($idProyecto){
		// Devuelve el total de promesas de acuerdo a un proyecto
		$dataObj = new Data();
		$total = $dataObj->where('id_proyecto', $idProyecto)->get()->toArray();
		return $total;
	}
	
	public function etapasResum($idProyecto){
		// Muestra el resumen de la etapa para la primera vista
		$etapasObj = new Etapas();
		$etapas = $etapasObj->where('id_proyecto', $idProyecto)->orderBy('nombre')->get();

		foreach( $etapas as $etapa ){
			// Agregamos el total de promesas por cada etapa
			$etapa->promesas = $this->totalPromesasByEtapa($etapa->id);
		}

		return $etapas->toArray();
	}

	public function getProyecto( $idProyecto ){
		// Busca un proyecto, si no encuentra devuelve la excepcion
		try {
			return Proyectos::findOrFail($idProyecto);
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function liquidacionGastosView(Request $request, $opp){
		// GET - Detalle de una OPP (Liquidación de Gastos operacionales)
		$num_nodo = 950;
		$promesas = new Data();
		$promesa = $promesas->getPromesaFull($opp);

		// La promesa no existe
		if( !$promesa ) return abort(404, 'La promesa no existe');

		// La promesa existe
		$nodo_detalle = new nodosDetalle;
		$permissions = auth()->user()->permisos->where('num_nodo', $num_nodo)->first();
		$can_edit = ( !empty($permissions) || auth()->user()->is_admin() ) ? true : false;

		$workflow = Workflow::where('opp', $promesa->opp)->first();
		$detalle_wf = workflowDetalle::where('id_workflow', $workflow->id)->first();
		$nodo_detalle = $nodo_detalle->getNodoDetalles($num_nodo, $workflow->id);

		return view('pages.finanzas.liquidacion-gastos-op', [
			'title' => 'Liquidación de gastos operacionales',
			'entidades' => $this->getEntidades(),
			'nodo' => $nodo_detalle,
			'promesa' => $promesa,
			'can_edit' => $can_edit
		]);
	}
	
	public function pagoOperacionView(Request $request, $opp){
		// GET - Detalle de una OPP (Liquidación de Gastos operacionales)
		$num_nodo = 960;
		$promesas = new Data();
		$promesa = $promesas->getPromesaFull($opp);

		// La promesa no existse
		if( !$promesa ) return abort(404, 'La promesa no existe');

		// La promesa existe
		$nodo_detalle = new nodosDetalle;
		$permissions = auth()->user()->permisos->where('num_nodo', $num_nodo)->first();
		$can_edit = ( !empty($permissions) || auth()->user()->is_admin() ) ? true : false;

		$workflow = Workflow::where('opp', $promesa->opp)->first();
		$detalle_wf = workflowDetalle::where('id_workflow', $workflow->id)->first();
		$nodo_detalle = $nodo_detalle->getNodoDetalles($num_nodo, $workflow->id);

		return view('pages.finanzas.pago-operacion', [
			'title' => 'Pago Operación',
			'entidades'=> $this->getEntidades(),
			'nodo' => $nodo_detalle,
			'promesa'=> $promesa,
			'can_edit' => $can_edit
		]);
	}

	public function getEntidades(){
		return $entidades = Entidades::all();	 
	}

	public function guardarLiquidacion(Request $request, $opp){
		return $request;
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

	public function getDetalleWorkflow(Request $request, $opp){
		$workflow = Workflow::where('opp', $opp)->first();
		$detalle_wf = workflowDetalle::where('id_workflow', $workflow->id)->first();
		$nodo_detalle = nodosDetalle::where('id_dw', $workflow->id)->where('id_nodo', 97)->first();

		if( !$nodo_detalle ) return abort(403);
		return ['id_nd' => $nodo_detalle->id, 'id_dw' => $detalle_wf->id];
	}

	public function getDetalleWorkflowPago($opp){
		$workflow = Workflow::where('opp', $opp)->first();
		$id_wf = $workflow->id;
		$detalle_wf = workflowDetalle::where('id_workflow',$id_wf)->first();
		$id_dw = $detalle_wf->id;
		$nodoDetalle = nodosDetalle::where('id_dw', $id_wf)->where('id_nodo', 98)->first();
		$id_nd = $nodoDetalle->id; 
	   
	   return ['id_nd' => $id_nd, 'id_dw' => $id_dw];
	}

	public function terminarNodo(Request $request){
		// PUT - Terminar nodo liquidación gastos operacionales
		$nodoDetalle = new nodosDetalle;
		$terminado = $nodoDetalle->terminarNodo($request->id_nodo, $request->id_dw);
		return response()->json($terminado);
	}

	public function guardarDetallesFinanzas(Request $request){
		// Ejecuta el método para guardar los datos (Route)
		return $this->guardarDetalleFinanzas([
			'id_nd' => $request->id_nd,
			'fields' => $request->fields
		]);
	}

	public function guardarDetalleFinanzas($data){
		// Guarda los datos de un nodo
		$datos = new Datos;

		foreach( $data['fields'] as $field ){
			if( array_key_exists('value', $field) && $field['value'] !== null ){
				$datos->insertDetalles([
					'value' => ($field['value']) ? $field['value'] : 0,
					'id_nd' => $data['id_nd'],
					'id_datos' => $field['id'],
					'observaciones' => ( array_key_exists('observaciones', $field) ) ? $field['observaciones'] : null
				]);
			}
		}

		return response()->json( true );
	}

}