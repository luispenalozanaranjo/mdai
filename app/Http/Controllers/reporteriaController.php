<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\reporteriaProduccion;
use Carbon\Carbon;

use App\Proyecto;
use App\Http\Controllers\proyectosController;

class reporteriaController extends Controller{

	public function mainView(){
		// Vista principal de la página de reportes
		$reportes = [
			'liquidacion' => (object) [
				'name' => 'Reporte producción',
				'route' => route('reporteria.produccion'),
				'bg' => 'bg-orange',
				'icon' => 'fa fa-file-alt',
			]
		];

		// Retornamos la vista
		return view( 'pages.reportes.home', [
			'title' => 'Reportes',
			'reportes' => $reportes
		]);
	}

	public function produccion(){
		// Vista de la página de reporte producción
		$proyectos = Proyecto::orderBy('id', 'DESC')->get();
		$proyectosController = new proyectosController();

		// Agregamos el total de promesas y el total de etapas
		foreach( $proyectos as $proyecto ){
			$proyecto->promesas = $proyectosController->totalPromesas( $proyecto->id );
			$proyecto->etapas = $proyectosController->totalEtapas( $proyecto->id );
		}

		// Retornamos la vistas
		return view( 'pages.reportes.produccion', [
			'title' => 'Reporte producción',
			'proyectos' => $proyectos,
			'total_proyectos' => showTotal($proyectos->count(), 'proyecto', 'proyectos')
		]);
	}

	public function getProduccion(Request $request, $idProyecto){
		// Descarga el Excel de producción
		$proyecto = Proyecto::find($idProyecto);

		// El proyecto no existe
		if( !$proyecto ) return abort(404, 'Proyecto no encontrado.');
		
		// Se encontró el proyecto solicitado
		try{
			// Intentamos ejecutar el sp de la base de datos
			$registros = DB::select( DB::raw("call sp_reporte_diario($idProyecto)") );
			$fecha = str_replace('-', '', Carbon::now()->toDateString());
			$nombre = 'produccion_' . $fecha . '.xlsx';
			return Excel::download(new reporteriaProduccion($registros), $nombre);
		}
		catch(\Exception $e){
			// No se pudo ejecutar la descarga del proyecto
			return abort(500, 'Hubo un problema al intentar descargar el reporte.');
		}
	}

}