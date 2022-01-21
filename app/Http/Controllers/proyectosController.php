<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Permission;

use App\Data as Data;
use App\Proyecto as Proyectos;
use App\Etapa as Etapas;
use App\Region as Regiones;
use App\Usuario as Usuarios;

use App\Exports\pisExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Almacen as Almacen;

class proyectosController extends Controller{

	public function denegarAccesoProyecto($proyecto){
		$proyecto2 = Proyectos::find($proyecto);
		$this->authorize('pass', $proyecto2);
	}

	public function get( $idProyecto ){
		// Busca un proyecto, si no encuentra devuelve la excepcion
		try { return Proyectos::findOrFail($idProyecto); }
		catch(\Exception $e){ return false; }
	}

	public function etapa( $idEtapa ){
		// Busca una etapa, si no encuentra devuelve la excepcion
		try {
			$etapa = Etapas::findOrFail($idEtapa);

			if( $etapa->id_usuario ){
				$etapa->has('usuarios');
			}

			return $etapa;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function totalPromesas($idProyecto){
		// Devuelve el total de promesas de acuerdo a un proyecto
		$total = Data::where('id_proyecto', $idProyecto)->get()->toArray();
		return count($total);
	}

	public function totalPromesasByEtapa($idEtapa){
		// Devuelve el total de promesas de acuerdo a una etapa
		$total = Data::where('id_etapa', $idEtapa)->get()->toArray();
		return count($total);
	}

	public function totalEtapas($idProyecto){
		// Devuelve el total de etapas de un proyecto
		$total = Etapas::where('id_proyecto', $idProyecto)->get()->toArray();
		return count($total);
	}

	public function proyectosResum(){
		// Muestra el resumen del proyecto para la primera vista
		$admin = false;

		if( auth()->user()->id === 1 ){
			$proyectos = Proyectos::groupBy('nombre')->select('id', 'nombre', 'codigo', 'dueno', 'inmobiliaria', 'programa')->orderBy('id', 'DESC')->get();
			$admin = true;
		}
		else{
			$proyectos = auth()->user()->proyectos()->get();
		}

		foreach( $proyectos as $proyecto ){
			// Agregamos el total de promesas y el total de etapas
			$proyecto->promesas = $this->totalPromesas( ($admin) ? $proyecto->id : $proyecto->pivot['id_proyecto'] );
			$proyecto->etapas = $this->totalEtapas( ($admin) ? $proyecto->id : $proyecto->pivot['id_proyecto'] );
		}

		return $proyectos->toArray();
	}

	public function proyectosPis(){
		$proyectos = Proyectos::groupBy('nombre')
		->select('id', 'nombre', 'codigo')
		->get()->toArray();

		$dataObj = new Data();
		$totalPromesa = $dataObj->where('id_proyecto', $idProyecto)->get()->toArray();
	}

	public function etapasResum($idProyecto){
		// Muestra el resumen de la etapa para la primera vista
		$etapas = Etapas::where('id_proyecto', $idProyecto)->orderBy('nombre')->get();

		foreach( $etapas as $etapa ){
			// Agregamos el total de promesas por cada etapa
			$etapa->promesas = $this->totalPromesasByEtapa($etapa->id);
		}

		return $etapas->toArray();
	}

	public function getPromesasByEtapa($idEtapa){
		// Obtenemos las promesas por una etapa
		$promesas = Data::where('id_etapa', $idEtapa)->orderBy('primer_nombre')->get();
		// Recorremos las promesas y agregamos informacion
		foreach($promesas as $promesa){
			$promesa->estados;
			$promesa->proyecto = $promesa->proyectos->nombre;
			$promesa->etapa = $promesa->etapas->nombre;
			$promesa->workflow_estado = $promesa->estadoWorkflow($promesa->opp);
			$promesa->workflow = $promesa->tieneWorkflow($promesa->opp);
		}
		// Retornamos la info
		return $promesas;
	}

	public function mainView(){
		// Vista general de proyectos
		$proyectos = $this->proyectosResum();
		$total = count($proyectos);

		return view('pages.proyectos.proyectos', [
			'title' => 'Proyectos',
			'proyectos' => $proyectos,
			'total_proyectos' => $total,
			'total_proyectos_text' => showTotal($total, 'proyecto', 'proyectos')
		]);
	}

	public function excelPis(Request $request){
		// exportal a excel
		$etapa = $this->etapa($request->etapa);
		$proyecto = $this->get($request->proyecto);
		$etapasObj = new Data();

		$promesa = $etapasObj->where('id_etapa', $etapa->id)
		->where('marca', '!=', 'Privado')
		->select('rut_cliente', 'primer_nombre', 'apellido_paterno', 'marca', 'pis_1', 'pis_2', 'pis_3', 'pis_4', 'pis_5')
		->get();

		$proyectoEtapa = $etapa->nombre.'-'.$proyecto->nombre;		
		return Excel::download(new pisExport($promesa), $proyectoEtapa. '-PIS.xlsx');
	}

	public function proyectoView(Request $request){
		// Vista detalle del proyecto
		$this->denegarAccesoProyecto($request->proyecto);

		$proyecto = $this->get($request->proyecto);
		if( $proyecto ){
			return view('pages.proyectos.detalle', [
				'title' => 'Proyecto',
				'proyecto' => $proyecto,
				'etapas' => $this->etapasResum( $request->proyecto )
				
			]);
		}else{
			return abort(404);
		}
	}

	public function proyectoEdit(Request $request){
		// Vista edición del proyecto
		$this->denegarAccesoProyecto($request->proyecto);

		// Obtenemos el proyecto
		$proyecto = $this->get($request->proyecto);

		// El proyecto no existe
		if( !$proyecto ) return abort(404);

		return view('pages.proyectos.edit', [
			'title' => 'Proyecto',
			'proyecto' => $proyecto
		]);
	}

	public function proyectoPisView(Request $request){
		// Vista detalle del proyecto
		$proyecto = $this->get($request->proyecto);
		if( !$proyecto ) return abort(404);

		$etapas = $this->etapasResum( $request->proyecto );
		return view('pages.proyectos.detalle-pis', [
			'title' => "PIS - Proyecto $proyecto->nombre",
			'proyecto' => $proyecto,
			'total_etapas' => showTotal(count($etapas), 'etapa', 'etapas'),
			'etapas' => $etapas
		]);
	}

	public function etapaView(Request $request){
		// Vista de la etapa
		$this->denegarAccesoProyecto($request->proyecto);
		$etapa = $this->etapa($request->etapa);

		// Etapa no encontrada
		if( !$etapa ) return abort(404);

		// Retornamos la vista
		$proyecto = $this->get($request->proyecto);
		$promesas = $this->getPromesasByEtapa($request->etapa);

		// return $promesas;

		return view('pages.proyectos.etapa', [
			'title' => "Proyecto $proyecto->nombre - Etapa $etapa->nombre ($etapa->codigo)",
			'proyecto' => $proyecto,
			'etapa' => $etapa,
			'promesas' => $promesas,
			'total_promesas' => showTotal(count($promesas), 'promesa', 'promesas')
		]);
	}

	public function etapaEdit(Request $request){
		// Vista de la etapa
		$this->denegarAccesoProyecto($request->proyecto);
		$etapa = $this->etapa( $request->etapa );

		if( $etapa ){
			return view('pages.proyectos.etapa-edit', [
				'title' => 'Proyecto',
				'proyecto' => $this->get( $request->proyecto ),
				'etapa' => $etapa,
				'promesas' => $this->getPromesasByEtapa($request->etapa),
				'regiones' => Regiones::all(),
				'ejecutivos' => Usuarios::where('id_cargo', 7)->get()
			]);
		}
		else{
			return abort(404);
		}
	}

	public function proyectoSave(Request $request){
		$proyecto = $this->get($request->proyecto);
		if( !$proyecto ) return abort(404);

		// Convertimos los datos recibidos a objetos
		$fields = (object) $request->fields;

		try{
			// Guardamos los datos
			$proyecto->nombre = $fields->nombre;
			$proyecto->codigo = $fields->codigo;
			$proyecto->dueno = $fields->dueno;
			$proyecto->direccion = $fields->direccion;
			$proyecto->comuna = $fields->comuna;
			$proyecto->region = $fields->region;
			$proyecto->inmobiliaria = $fields->inmobiliaria;
			$proyecto->rut_inmobiliaria = $fields->rut_inmobiliaria;
			$proyecto->estado = $fields->estado;
			$proyecto->programa = $fields->programa;
			$proyecto->tipo_documento_venta = $fields->tipo_documento_venta;
			$proyecto->tipologias = $fields->tipologias;
			$proyecto->viviendas_totales = $fields->viviendas_totales;
			$proyecto->unidades_vulnerables = $fields->unidades_vulnerables;
			$proyecto->unidades_medios = $fields->unidades_medios;
			$proyecto->ggoo = $fields->ggoo;
			$proyecto->fondo_inicial = $fields->fondo_inicial;
			$proyecto->reserva = $fields->reserva;
			$proyecto->checklist = $fields->checklist;
			$proyecto->checklist_postulacion = $fields->checklist_postulacion;
			$proyecto->save();

			// Guardado correctamente y devolvemos el objeto
			$response = ['status' => true, 'message' => 'Cambios guardados correctamente.'];
			return response()->json($response);
		}
		catch(\Exception $e){
			// Hubo un problema en el guardado, devolvemos el objeto
			$response = ['status' => false, 'message' => 'Hubo un problema al intentar guardar los datos.'];
			return response()->json($response);
		}
	}

	public function saveConfig($idEtapa, $fields){
		$etapa = $this->etapa( $idEtapa );
		$response = ['status' => true, 'message' => 'Hubo un problema al intentar guardar los datos.'];

		if( $etapa ){
			// La etapa existe
			foreach ($fields as $item => $value) {
				// Recorremos el objeto y seteamos el nuevo valor
				$etapa[$item] = $value;
			}
			// Guardamos
			$etapa->save();
			$response = ['status' => true, 'message' => 'Cambios guardados correctamente.'];
		}
		
		// Devolvemos la respuesta
		return $response;
	}

	public function etapaSaveConfig(Request $request){
		$fields = (object) $request->fields;
		return response()->json( $this->saveConfig($request->etapa, $fields) );
	}

	public function etapaView2(Request $request){
		// Vista de la etapa
		$this->denegarAccesoProyecto($request->proyecto);
		$etapa = $this->etapa($request->etapa);

		if( !$etapa ) return abort(404);
		
		$proyecto = $this->get( $request->proyecto );
		$promesas = $this->getPromesasByEtapa($request->etapa);

		return view('pages.proyectos.listar-promesas-etapa-pis', [
			'title' => "PIS - Proyecto $proyecto->nombre -  Etapa $etapa->nombre ($etapa->codigo)",
			'proyecto' => $proyecto,
			'etapa' => $etapa,
			'promesas' => $promesas,
			'total_promesas' => showTotal(count($promesas), 'promesa', 'promesas')
		]);
	}

	public function homePis(){
		// Vista general de proyectos
		$proyectos = $this->proyectosResum();

		return view('pages.proyectos.proyectos-pis', [
			'title' => 'PIS',
			'proyectos' => $proyectos,
			'total_proyectos' => showTotal(count($proyectos), 'proyecto', 'proyectos')
		]);
	}

	public function etapaSavePis(Request $request){
		$fields = (object) $request->fields;
		return response()->json( $this->saveConfig($request->etapa, $fields) );
	}

	public function guardarPisPromesa(Request $request, $promesa){
		$promesaupdate = Data::where('opp', $promesa)->first();
		$promesaupdate->pis_1 = $request->pis_1;
		$promesaupdate->pis_2 = $request->pis_2;
		$promesaupdate->pis_3 = $request->pis_3;
		$promesaupdate->pis_4 = $request->pis_4;
		$promesaupdate->pis_5 = $request->pis_5;
		// $PromesaUpdate->update($request->all());
		$promesaupdate->save();
		return $request;
	}

	public function getPis($opp){
		$promesaget = Data::where('opp', $opp)->first();
		return $promesaget;
	}
	
	public function getAlmacenProyecto(Request $request){
		$arr = $request->all();
		$almacen = [];
		$datos = Almacen::whereIn('id', $arr)->get();

		foreach( $datos as $dato ){
			// $dato->value = ($dato->type === 'select') ? 'Seleccione' : null;
			$almacen[$dato->slug] = $dato;
			$almacen[$dato->slug]['observaciones'] = null;
		}

		return $almacen;
	}

}