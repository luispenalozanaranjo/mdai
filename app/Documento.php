<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Common;
use Carbon\Carbon;

class Documento extends Model{

	protected $table = 'documentos_subidos';
	protected $fillable = ['ruta', 'nombre_archivo', 'nombre_original', 'comentarios', 'id_dw', 'id_nd', 'id_preg', 'id_usuario'];

	public function saveFile($data){
		// Inserta un archivo
		$archivo = $this->create([
			'ruta' => $data['ruta'],
			'nombre_archivo' => $data['nombre_archivo'],
			'nombre_original' => $data['nombre_original'],
			'comentarios' => $data['comentarios'],
			'id_dw' => $data['id_dw'],
			'id_nd' => $data['id_nd'],
			'id_preg' => $data['id_preg'] ? $data['id_preg'] : null,
			'id_usuario' => Auth::user()->id
		]);

		return ( $archivo ) ? $archivo->id : false;
	}

	public function getFile($id_nd){
		// Obtiene un archivo
		$archivo = $this->where('id_nd', $id_nd)->first();
		return ( !empty($archivo) ) ? $archivo : false;
	}

	public function getFiles($id_nd){
		// Obtiene los archivos del nodo
		$archivos = $this->where('id_nd', $id_nd)->get();
		return ( !$archivos->isEmpty() ) ? $archivos : false;
	}

	public function deleteFile($filename){
		// Elimina un archivo
		return $this->where('nombre_archivo', $filename)->delete();
	}

	public function getAll($id_dw){
		// Obtenemos todos los archivos de un determinado workflow
		$archivos = $this->where('id_dw', $id_dw)->orderBy('id', 'DESC')->get();

		foreach( $archivos as $archivo ){
			// Obtenemos el detalle del nodo y normalizamos las fechas
			$archivo->nodoDetalle->nodo;
			$creacion = Carbon::parse($archivo->created_at)->locale('es');
			$archivo->created_format = $creacion->translatedFormat('l d \d\e F \d\e\l Y \a \l\a\s H:i \h\r\s.');
			$archivo->usuario;
			$archivo->pregunta;
		}
		// Devolvemos la informacion
		return $archivos;
		//return ( !$archivos->isEmpty() ) ? $archivos : false;
	}

	public function workflow(){
		return $this->belongsTo('App\Data', 'id_dw');
	}

	public function nodoDetalle(){
		return $this->belongsTo('App\nodoDetalle', 'id_nd', 'id');
	}

	public function usuario(){
		return $this->belongsTo('App\Usuario', 'id_usuario', 'id')->select(['id', 'usuario', 'nombres', 'apellidos']);
	}

	public function pregunta(){
		return $this->belongsTo('App\Pregunta', 'id_preg', 'id')->select(['id', 'encabezado_pregunta']);
	}

}