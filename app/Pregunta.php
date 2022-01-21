<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Respuesta;
use App\Excepcion;

class Pregunta extends Model{
	use SoftDeletes;
	
	protected $table = 'preguntas';
	protected $fillable = ['num_pregunta', 'marca_campo', 'configuracion', 'tipo', 'encabezado_pregunta', 'id_form'];
	public $timestamps = false;

	public function getPreguntas($id_form){
		$preguntas = $this->where('id_form', $id_form)->get();
		return ( !$preguntas->isEmpty() ) ? $preguntas : false;
	}

	public function getPreguntasFull($id_form, $id_dw){
		$preguntas = $this->where('id_form', $id_form)->get();

		foreach( $preguntas as $pregunta ){
			$respuestas = new Respuesta;
			$pregunta->respuesta = $respuestas->getRespuesta($pregunta->id, $id_dw);
			$pregunta->documento;
		}

		return ( !$preguntas->isEmpty() ) ? $preguntas : false;
	}

	public function formulario(){
		// Relacion pregunta/formulario
		return $this->belongsTo('App\Formulario', 'id_form');
	}

	public function documento(){
		// Relacion pregunta/documento
		return $this->hasOneThrough(
            'App\Documento',
            'App\Pregunta',
            'id', // Foreign key en Pregunta
            'id_preg', // Foreign key on Documento
            'id', // Local key on Pregunta
            'id' // Local key on Documento
        );
	}

}