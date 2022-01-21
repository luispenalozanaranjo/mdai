<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class workflowDetalle extends Model{
	protected $table = 'workflow_detalle';
	protected $fillable = ['id_workflow', 'ultimo_estado'];

	public function getDetalle($id_dw){
		// Obtenemos el detalle de un nodo
		try{
			$detalle = $this->findOrFail($id_dw);
			$detalle->workflow;
			$detalle->workflow->promesa;
			$detalle->workflow->promesa->proyectos;
			$detalle->workflow->promesa->etapas;
			return $detalle;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function newDetalle($idWorkflow){
		// Inserta un detalle de workflow
		$workflow_detalle = $this->create([
			'ultimo_estado' => null,
			'id_workflow' => $idWorkflow,
		]);
		return ( $workflow_detalle ) ? $workflow_detalle->id : false;
	}

	public function workflow(){
		// Relacion workflow/detalle
		return $this->belongsTo('App\Workflow', 'id_workflow');
	}
}