<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model{
	protected $fillable = ['num_nodo'];
	public $timestamps = false;

	public function Usuario(){
		return $this->belongsToMany('App\Usuario', 'permisos_usuarios', 'id', 'id_usuario');
	}

	public function nodo(){
		return $this->belongsTo('App\Nodo', 'num_nodo', 'num_nodo');
	}
}