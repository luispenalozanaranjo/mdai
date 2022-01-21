<?php

namespace App\Policies;

use App\Usuario;
use App\Proyecto;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProyectoPolicy{

	use HandlesAuthorization;

	public function __construct(){
	}

	public function pass(Usuario $usuario, Proyecto $proyecto){
		$proyecto = $usuario->proyectos->where('id', $proyecto->id)->first();
		return ( !empty($proyecto) || $usuario->id === 1 ) ? true : false;
	}
}