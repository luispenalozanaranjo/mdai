<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notificacionCheck extends Model
{

    protected $table = 'notificacion_check';
	protected $fillable = ['id_dw', 'id_check', 'estado'];
    public $timestamps = false;


    public function buscaNotificacion($id_dw, $id_check){
		// Obtenemos el registro de una notificacion
		try{
			return $this->where('id_dw', $id_dw)->where('id_check', $id_check)->first();
		}
		catch(\Exception $e){
			return false;
		}
	}
}
