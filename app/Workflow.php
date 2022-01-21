<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Common;
use Carbon\Carbon;

class Workflow extends Model{

	protected $table = 'workflow';
	protected $fillable = ['opp', 'rut_cliente', 'fecha_recepcion_final'];

	protected $detalle = 'workflow_detalle';
	protected $datos = 'almacen_datos';

	public function getWorkflow($opp){
		//Obtenemos el detalle de un workflow
		try {
			$workflow = $this->where('opp', $opp)->first();
			$workflow->detalles;
			return $workflow;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function createWorkflow($item){
		// Inserta un workflow
		$workflow = $this->create([
			'opp' => $item['Opp'],
			'rut_cliente' => $item['RUT Cliente'],
			'fecha_recepcion_final' => null
		]);

		return ( $workflow ) ? $workflow->id : false;
	}

	// public function getWorkflowFull($idPromesa){
	// 	// Obtiene el estado completo del workflow

	// 	$workflow = $this->where('opp', $idPromesa)
	// 	->join( $this->detalle, $this->detalle . '.id_workflow', '=', $this->table . '.id')
	// 	->select( $this->table.'.id as id_workflow', 'opp', 'rut_cliente', $this->table.'.created_at', 'fecha_recepcion_final', $this->detalle.'.id as id_dw')
	// 	->first();

	// 	return ( $workflow ) ? $workflow : false;
	// }

	public function insertDetalleDatos($data){
		// Obtiene el estado completo del workflow
		if( config('app.debug') ) DB::enableQueryLog();

		$detalle = DB::table( $this->datos )
		->insertGetId([
			'valor' => $data['value'],
			'id_nodo' => $data['id_nodo'],
			'id_datos' => $data['id_workflow_datos']
		]);

		return ( $detalle ) ? $detalle : false;
	}

	public function detalles(){
		return $this->belongsTo('App\workflowDetalle', 'id', 'id_workflow');
	}

	public function promesa(){
		return $this->belongsTo('App\Data', 'opp');
	}

}