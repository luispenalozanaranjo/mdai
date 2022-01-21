<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Models
use App\Data as Promesas;
use App\Workflow;
use App\workflowDetalle;
use App\Nodo as Nodos;
use App\nodoDetalle as nodosDetalle;
use App\Permisos as Permisos;

class revisionesController extends Controller{

	private function totalFlujo(){
		$proyectos = auth()->user()->proyectos()->pluck('id_proyecto');
		$permissions = auth()->user()->permisos;
		$nodos = [];
		$etapas = [1, 2, 3, 4];

		foreach ($permissions as $permiso) {
			$fullNodo = Nodos::where('num_nodo', $permiso->num_nodo)->first();
			if( in_array($fullNodo->etapa, $etapas) && !in_array($fullNodo->id, $nodos) ){
				array_push($nodos, $fullNodo->id);
			}
		}

		$detalles = nodosDetalle::whereIn('id_nodo', $nodos)->where('estado', 3)->pluck('id_dw');
		$dworkflow = workflowDetalle::whereIn('id', $detalles)->pluck('id_workflow');
		$opps = Workflow::whereIn('id', $dworkflow)->pluck('opp');
		$flujo = Promesas::whereIn('opp', $opps)
				 ->whereIn('id_proyecto', $proyectos)
				 ->groupBy('opp')
				 ->orderBy('opp')
				 ->get();

		$flujo2 = [];

		foreach( $flujo as $promesa ){
			// Agregamos el proyecto y la etapa
			$promesa->estados;
			$promesa->proyecto = $promesa->proyectos->nombre;
			$promesa->etapa = $promesa->etapas->nombre;
			$promesa->workflow_estado = $promesa->estadoWorkflow($promesa->opp);

			if( !$promesa->workflow_estado ){
				array_push($flujo2, $promesa);
			}
		}

		return count($flujo2);
	}

	private function getFlujo($etapa){
		$proyectos = auth()->user()->proyectos()->pluck('id_proyecto');
		$permissions = auth()->user()->permisos;
		$nodos = [];

		foreach( $permissions as $permiso ){
			$fullNodo = Nodos::where('num_nodo', $permiso->num_nodo)->first();

			if( $fullNodo->etapa === $etapa && !in_array($fullNodo->id, $nodos) ){
				// Agregamos el id a los nodos por recorrer
				array_push($nodos, $fullNodo->id);
			}
		}

		$detalles = nodosDetalle::whereIn('id_nodo', $nodos)->where('estado', 3)->pluck('id_dw');
		$dworkflow = workflowDetalle::whereIn('id', $detalles)->pluck('id_workflow');
		$opps = Workflow::whereIn('id', $dworkflow)->pluck('opp');
		$flujo = Promesas::whereIn('opp', $opps)
				 ->whereIn('id_proyecto', $proyectos)
				 ->groupBy('opp')
				 ->orderBy('opp')
				 ->get();

		$flujo2 = [];

		foreach( $flujo as $promesa ){
			// Agregamos el proyecto y la etapa
			$promesa->estados;
			$promesa->proyecto = $promesa->proyectos->nombre;
			$promesa->etapa = $promesa->etapas->nombre;
			$promesa->workflow_estado = $promesa->estadoWorkflow($promesa->opp);

			if( !$promesa->workflow_estado ){
				array_push($flujo2, $promesa);
			}
		}

		return $flujo2;
	}

	public function obtenerPendientes(){
		$etapas = [1,2,4];
		$flujoCompleto = [];

		foreach( $etapas as $etapa ){
			// Buscamos el flujo por cada etapa

			$flujoCompleto[$etapa] = (object)[
				'nombre' => 'Etapa ' . $etapa,
				'flujo' => $this->getFlujo($etapa)
			];
		}

		return view('pages.revisiones.pendientes', [
			'title' => 'Revisiones pendientes',
			'revisiones' => $flujoCompleto,
			'total' => $this->totalFlujo()
		]);
	}

}