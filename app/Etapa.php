<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model{
	protected $table = 'etapas';
	protected $fillable = [
		'nombre',
		'codigo',
		'fecha_recepcion',
		'total_unidades',
		'total_vulnerables',
		'escrituracion_notificacion',
		'id_proyecto',
		'id_usuario',
		'pis_v_1',
		'pis_t_1',
		'pis_v_2',
		'pis_t_2',
		'pis_v_3',
		'pis_t_3',
		'pis_v_4',
		'pis_t_4',
		'pis_v_5',
		'pis_t_5'
	];

	public $timestamps = false;

	public function Promesas(){
		return $this->has('App\Data', 'id_etapa');
	}

	public function usuarios(){
    	return $this->belongsTo('App\Usuario', 'id_usuario');
    }
}