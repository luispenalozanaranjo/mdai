<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use App\Usuario as Usuario;

class Controller extends BaseController{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct(){
		$route = request()->route()->uri;

		if( $route !== 'login' ){
			// Compartimos el menú lateral personalizado según permisos de usuario
			// solo si no es la página de login
			$this->middleware('auth');
			$this->middleware(function($request, $next){
				$usuario = Usuario::findOrFail( Auth::user()->id );
				if( $usuario ){
					// Retornamos la variable compartida
					View::share('user_menu', $this->userMenu($usuario));
					return $next($request);
				}
			});
		}
	}

	public function userMenu($usuario){
		// Definimos el menu para el usuario de acuerdo a sus permisos
		$permisos_granted = $usuario->permisos()->pluck('num_nodo')->toArray();
		// return dd($permisos_granted);
		$is_admin = $usuario->id === 1;

		// Mantenedores
		$mantenedores = [2000, 2001, 2002, 2003, 2008];
		$mantenedores_enable = searchInArray($permisos_granted, $mantenedores);

		$menu = [
		    [ 'name' => 'Dashboard', 'icon' => 'fa-tachometer-alt', 'route' => 'dashboard', 'hover' => false ],
		    [ 'name' => 'Búsqueda', 'icon' => 'fa-search', 'route' => 'buscar-promesa', 'hover' => false ],
			[ 'name' => 'Proyectos', 'icon' => 'fa-key', 'route' => 'proyectos', 'hover' => false ]
		];

		// Tiene permiso para ver a todos los usuarios
		if( in_array('2004', $permisos_granted) || $is_admin )
			array_push($menu, [ 'name' => 'Clientes', 'icon' => 'fa-users', 'route' => 'clientes.home', 'hover' => false ]);

		// Tiene permiso para ver todos los proyectos
		if( in_array('2005', $permisos_granted) || $is_admin )
			array_push($menu, [ 'name' => 'PIS', 'icon' => 'fa-percent', 'route' => 'proyectos-pis', 'hover' => false ]);
		
		array_push($menu,
		    [ 'name' => 'Finanzas', 'icon' => 'fa-money-check-alt', 'route' => 'finanzas.home', 'hover' => false ],
		    [ 'name' => 'Entrega de unidad', 'icon' => 'fa-home', 'route' => 'entrega-unidad-home', 'hover' => false ]
		);

		if( $mantenedores_enable || $is_admin ) // Tiene por lo menos uno de los items de mantenedores
			array_push($menu, [ 'name' => 'Mantenedores', 'icon' => 'fa-cog', 'route' => 'mantenedores', 'hover' => false ]);

		array_push($menu, [ 'name' => 'Reporteria', 'icon' => 'fa-file-alt', 'route' => 'reporteria.home', 'hover' => false ]);

		// Retornamos el menú
		return $menu;
	}
}