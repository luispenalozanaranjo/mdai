<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model{
	protected $table = 'proyectos';
	protected $fillable = ['nombre', 'codigo', 'dueno', 'direccion', 'comuna', 'region', 'inmobiliaria', 'rut_inmobiliaria', 'estado', 'programa', 'tipologias', 'viviendas_totales', 'unidades_vulnerables', 'unidades_medios', 'tipo_documento_venta', 'ggoo', 'fondo_inicial', 'reserva', 'checklist', 'checklist_postulacion'];
	public $timestamps = true;

	public function Promesas(){
		return $this->hasMany('App\Data', 'id_proyecto');
	}

	public function Etapas(){
		return $this->hasMany('App\Etapa', 'id_proyecto');
	}

	public function Usuario(){
        return $this->belongsToMany('App\Usuario', 'proyecto_usuarios')->withPivot('usuario_id', 'proyecto_id');
	}
	

	public function NoProyecto(){
		return $this->belongsToMany('App\Usuario', 'proyecto_usuarios')->withPivot('usuario_id');

	}
}