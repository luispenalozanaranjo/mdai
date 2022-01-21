<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Closure;
class Permissions{

	public function handle($request, Closure $next, $num_nodo){
		$user_id = auth()->user()->id;

		if( $num_nodo == 2004 ){
			// Perfil de usuario
			if( $user_id == 1 || $user_id == $request->idUsuario ){
				// Es el admin o es el mismo usuario del perfil que se requiere
				return $next($request);
			}
			else{
				return redirect()->route('login');
			}
		}
		else{
			if( $user_id == 1 ){
				// Es el admin o es el mismo usuario del perfil que se requiere
				return $next($request);
			}
			else{
				// Si no, verificamos si tiene los permisos para entrar
				$permisoObtenido = auth()->user()->permisos->where('num_nodo', $num_nodo)->first();
				return ( empty($permisoObtenido) ) ? abort(403) : $next($request);
			}
		}
	}

}