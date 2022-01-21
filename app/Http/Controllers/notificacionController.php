<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Usuario as Usuarios;
use App\Notificacion as Notificaciones;

class notificacionController extends Controller{

	public function mainView(Request $request){
		// Vista principal de las notificaciones
		$notificaciones = $this->showNotificacion();

		return view( 'pages.notificaciones', [
			'title' => 'Notificaciones',
			'total_notificaciones' => showTotal($notificaciones->count(), 'notificacion', 'notificaciones'),
			'notificaciones' => $notificaciones
		]);
	}

	public function get($idUsuario){
		// Obtenemos el detalle de una promesa
		try {
			$notificaciones = Notificaciones::where('usuario', $idUsuario)
			->select('detalle', 'estado', 'id_dw', 'titulo', 'url')
			->orderBy('id', 'desc')
			->get();

			foreach( $notificaciones as $notificacion ){
				$notificacion->nodo;
			}

			return $notificaciones;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function showNotificacion(){
		$notificaciones = Notificaciones::where('usuario', Auth::user()->id)
		->orderBy('id', 'DESC')
		->get();

		foreach( $notificaciones as $notificacion ){
			$creacion = Carbon::parse($notificacion->created_at)->locale('es');
			$notificacion->created_format = $creacion->translatedFormat('l d \d\e F \d\e\l Y \a \l\a\s H:i');
		}

		return $notificaciones;
	}

	public function getAll(Request $request){
		return response()->json( $this->get($request->idUsuario) );
	}

}