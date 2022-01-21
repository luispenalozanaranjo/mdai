<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Formulario;

class Respuesta extends Model{
	protected $table = 'respuestas';
	protected $fillable = ['valor', 'titular', 'codeudor', 'excepcion', 'subsanado', 'autoriza_id', 'id_preg', 'id_dw'];

	public function getRespuesta($id_pregunta, $id_dw){
		$respuesta = $this->with('autoriza')->where('id_preg', $id_pregunta)->where('id_dw', $id_dw)->first();

		return ( !empty($respuesta) ) ? $respuesta : false;
	}

	public function pregunta(){
		// Relación respuesta/pregunta
		return $this->belongsTo('App\Pregunta', 'id_preg');
	}

	public function workflow(){
		return $this->belongsTo('App\workflowDetalle', 'id_dw');
	}

	public function autoriza(){
		return $this->belongsTo('App\Usuario', 'autoriza_id', 'id');
	}
}
