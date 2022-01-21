<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model{
    protected $table = 'bitacora_contacto';
    protected $fillable = ['fec_recepcion_doc', 'observaciones', 'accion', 'opp'];

    public function promesa(){
		return $this->hasMany('App\Data', 'opp');
	}
}
