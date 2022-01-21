<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excepcion extends Model{
	protected $table = 'excepciones';
	protected $fillable = ['id_nd', 'id_pregunta', 'id_usuario', 'id_estado', 'observaciones'];

	public function nodo(){
		return $this->belongsTo('App\nodoDetalle', 'id_nd', 'id');
	}

	public function pregunta(){
		return $this->belongsTo('App\Pregunta', 'id_pregunta', 'id');
	}

	public function estado(){
		return $this->belongsTo('App\Estado', 'id_estado', 'id');
	}

	public function usuario(){
		return $this->belongsTo('App\Usuario', 'id_usuario', 'id');
	}
}