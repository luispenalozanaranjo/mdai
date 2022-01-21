<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Formulario;
use App\EntidadFinanciera;

class mantenedorController extends Controller{
	
	public function mainView(){
		$permissions = auth()->user()->permisos->where('num_nodo', 2000)->first();
		$can_access = ( !empty($permissions) || auth()->user()->id === 1 ) ? true : false;

		if( $can_access ){
			// Tiene los accesos para ver la vista
			$mantenedores = [
				'planilla' => (object) [
					'name' => 'Cargar planilla',
					'bg' => 'bg-orange',
					'route' => route('cargar-planilla'),
					'icon' => 'fa fa-file-upload',
					'num_nodo' => 2001,
					'total' => null
				],
				'checklist' => (object) [
					'name' => 'Checklist',
					'bg' => 'bg-cyan',
					'route' => route('checklists.home'),
					'icon' => 'fa fa-align-left',
					'num_nodo' => 2002,
					'total' => Formulario::count()
				],
				'usuarios' => (object) [
					'name' => 'Usuarios',
					'bg' => 'bg-green',
					'route' => route('usuarios.home'),
					'icon' => 'fa fa-user',
					'num_nodo' => 2002,
					'total' => Usuario::count()
				],
				'entidades' => (object) [
					'name' => 'Entidades Financieras',
					'bg' => 'bg-purple',
					'route' => route('entidades.home'),
					'icon' => 'fa fa-wallet',
					'num_nodo' => 2003,
					'total' => EntidadFinanciera::count()
				],
				'comisiones' => (object) [
					'name' => 'Comisiones',
					'bg' => 'bg-yellow',
					'route' => route('buscar-comision'),
					'icon' => 'fa fa-dollar-sign',
					'num_nodo' => 2006,
					'total' => null
				],
				'reversar' => (object) [
					'name' => 'Reversar OPP',
					'bg' => 'bg-dark-blue',
					'route' => route('buscar-reversa'),
					'icon' => 'fa fa-undo-alt',
					'num_nodo' => 2007,
					'total' => null
				],
				'prereserva' => (object) [
					'name' => 'Pre-Reserva',
					'bg' => 'bg-dark-blue',
					'route' => route('ver-prereserva'),
					'icon' => 'fa fa-file',
					'num_nodo' => 80,
					'total' => null
				]
			];

			foreach( $mantenedores as $mantenedor ){
				// Recorremos para verificar los accesos
				$permissions = auth()->user()->permisos->where('num_nodo', $mantenedor->num_nodo)->first();
				$mantenedor->permiso = ( !empty($permissions) || auth()->user()->id === 1 ) ? true : false;
			}

			return view( 'pages.mantenedores', [
				'title' => 'Mantenedores',
				'mantenedores' => $mantenedores
			]);
		}
		else{
			return abort(403);
		}
	}

}
