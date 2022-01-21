<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Data as Promesas;
use App\Bitacora as Bitacora;

class bitacoraController extends Controller{

	public function getPromesaFull($idPromesa){
		$promesa = Promesas::where('opp', $idPromesa)->first();
		$promesa->proyecto = $promesa->proyectos->nombre;
		$promesa->etapa = $promesa->etapas->nombre;

		return $promesa;
	}

	public function getHistorial($opp){
		$historial = Bitacora::where('opp', $opp)->orderBy('id', 'DESC')->get();
		return ( !$historial->isEmpty() ) ? $historial : false;
	}
		
	public function mainView(Request $request){
		// Historial de contacto
		return view('pages.promesas.bitacora', [
			'title' => 'Historial de contacto',
			'data' => [
				'promesa' => $this->getPromesaFull($request->opp),
				'historial' => $this->getHistorial($request->opp)
			]
		]);
	}

	public function agregarHistorial(Request $request){
		$bitacora = new Bitacora;
		$bitacora->opp = $request->opp;
		$bitacora->observaciones = $request->fields['observaciones'];
		$bitacora->accion = $request->fields['tipo_contacto'];
		$response = false;

		if( array_key_exists('recepcion_documento', $request->fields) ){
			$bitacora->fec_recepcion_doc = $request->fields['recepcion_documento'];
		}

		if( $bitacora->save() ){
			// Se guardó correctamente
			$response = $this->getHistorial($request->opp);
		}

		// Devolvemos la respuesta
		return response()->json( $response );
	}

}
