<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Data as Clientes;
use App\Proyecto as Proyectos;
use App\Etapa as Etapas;

class clientesController extends Controller{

	public function get( $rut ){
		try {
			return Clientes::where('rut_cliente', $rut)->firstOrFail();
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function getAll($pagina, $show){
		// Paginador
		Paginator::currentPageResolver(function() use ($pagina) {
			return $pagina;
		});

		$clientes = Clientes::orderBy('rut_cliente')->groupBy('rut_cliente');
		return $clientes->paginate($show)->toArray();
	}

	public function unidades($rut, $columns = []){
		$unidades = Clientes::where('rut_cliente', $rut);

		if( !empty($columns) ){
			// Verificamos si existe la lista de las columnas
			$unidades->select($columns);
		}

		// Obtenemos todos las unidades
		$unidades = $unidades->get();

		foreach( $unidades as $unidad ){
			// Agregamos la info del proyecto y etapa
			if( isset($unidad->id_proyecto) ){
				$unidad->proyectos;
				$unidad->etapas;
			}
		}

		// Disponibilizamos la data
		return $unidades;
	}

	public function detalleView(Request $request){
		$rut = $request->rut_usuario;
		$cliente = $this->get($rut);

		// El cliente no existe
		if( !$cliente ) return abort(404);

		// El cliente existe
		return view('pages.clientes.detalle', [
			'title' => 'Detalle cliente',
			'usuario' => $cliente,
			'unidades' => $this->unidades($rut)
		]);
	}

	public function mainView(Request $request){
		// GET - Detalle de la página principal de clientes
		$pagina = ( isset($request->pagina) ) ? $request->pagina : 1;
		$show = ( $request->input('show') ) ? $request->input('show') : 15;

		return view('pages.clientes.index', [
			'title' => 'Clientes',
			'clientes' => $this->getAll($pagina, $show)
		]);
	}

	public function getClientes(Request $request){
		// GET (API) - Obtenemos la lista de clientes
		$pagina = ( $request->input('page') ) ? $request->input('page') : 1;
		$show = ( $request->input('show') ) ? $request->input('show') : 15;
		// Devolvemos la data encontrada
		return response()->json( $this->getAll($pagina, $show) );
	}
}