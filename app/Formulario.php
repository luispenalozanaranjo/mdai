<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Common;

use App\Pregunta as Preguntas;

class Formulario extends Model{

	protected $table = 'formularios';
	protected $fillable = ['tipo', 'etapa', 'num_nodo'];
	public $timestamps = true;

	public function getFormularioFull($marca, $id_dw, $nodo, $tipo_credito = null){
		// Obtenemos el formulario
		$finanzas = [];
		$formulario = $this->where('num_nodo', '=', $nodo)->where('tipo', 'like', '%' . $marca . '%');

		if( $nodo === 460 && $tipo_credito ){
			$formulario->where('tipo', 'like', '%' . $tipo_credito . '%');
		}

		$formulario = $formulario->first();

		if( !empty($formulario) ){
			// Si existe obtenemos las preguntas
			$preguntas = new Preguntas;
			$formulario->preguntas = $preguntas->getPreguntasFull( $formulario->id, $id_dw );
		}
		else{
			$formulario = false;
		}

		return $formulario;
	}
}
