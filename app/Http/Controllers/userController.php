<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

use App\Usuario as Usuarios;
use App\Area as Areas;
use App\Cargo as Cargos;
use App\Permisos as Permisos;
use App\Proyecto as Proyectos;
use App\Nodo as Nodos;

class userController extends Controller{

	public function mainView(){
		// Vista principal de los usuarios
		$permissions = auth()->user()->permisos->where('num_nodo', 2002)->first();
		$can_access = ( !empty($permissions) || auth()->user()->id === 1 ) ? true : false;

		// Usuario no permitido en la vista
		if( !$can_access ) return abort(403);
		
		// Usuario con permisos, continuamos
		return view('pages.usuarios.usuarios', [
			'title' => 'Usuarios',
			'usuarios' => $this->getAllPaginate()
		]);
	}

	public function usuarioView(Request $request, $user){
		// Vista detalle de usuario
		$usuario = Usuarios::where('usuario', $user)->first();

		// Usuario no encontrado
		if( !$usuario ) return abort(404, 'Usuario no encontrado.');

		// Usuario encontrado, continuamos
		$permissions = auth()->user()->permisos->where('num_nodo', 2004)->first();
		$can_manage_permissions = ( !empty($permissions) || auth()->user()->id === 1 ) ? true : false;

		$permisos = [];
		foreach( Permisos::all() as $permiso ){
			// Recorremos los permisos y agregamos la info de los nodos
			$permiso->nodo;
			$permiso->nodo->info_etapa;

			if( $permiso->nodo->exclude === 0 ){
				array_push($permisos, $permiso);
			}
		}
		
		// Retornamos todo
		return view('pages.usuarios.detalle', [
			'title' => 'Editar usuario',
			'cargos' => Cargos::all(),
			'areas' => Areas::all(),
			'usuarios' => $this->getAll([$usuario->id], ['id', 'nombres', 'apellidos','id_cargo', 'id_area']),
			'usuario' => $this->get($usuario->id),
			'permisos' => $permisos,
			'permisos_granted' => $usuario->permisos()->get(),
			'proyectos_granted' => $usuario->proyectos()->get(),
			'manage_permisos' => $can_manage_permissions,
			'proyectos' => Proyectos::all(),
			'permiso_notificacion' => $usuario->notificaciones()->get()
		]);
	}

	public function perfilView(){
		// Vista detalle de usuario
		$usuario = auth()->user();

		// Retornamos todo
		return view('pages.usuarios.perfil', [
			'title' => 'Detalles usuario',
			'cargos' => Cargos::all(),
			'areas' => Areas::all(),
			'usuarios' => $this->getAll([$usuario->id], ['id', 'nombres', 'apellidos','id_cargo', 'id_area']),
			'usuario' => $this->get($usuario->id),
		]);
	}

	public function usuarioNuevo(){
		// GET - Vista de un nuevo usuario
		return view('pages.usuarios.agregar', [
			'title' => 'Agregar usuario',
			'usuarios' => $this->getAll([], ['id', 'nombres', 'apellidos']),
			'cargos' => Cargos::all(),
			'areas' => Areas::all()
		]);
	}

	public function get($idUsuario){
		// Obtenemos el usuario
		try {
			// Buscamos el usuario y devolvemos
			$usuario = Usuarios::where('id', $idUsuario)->firstOrFail();
			$usuario->cargo;
			$usuario->area;
			return $usuario;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function getAll($exclude = [], $columns = []){
		// Obtenemos todos los usuarios
		$usuarios = Usuarios::whereNotIn('id', $exclude)->orderBy('nombres');

		if( !empty($columns) ){
			// Verificamos si existe la lista de las columnas
			$usuarios->select($columns);
		}

		// Obtenemos todos los usuarios
		$usuarios = $usuarios->get();

		foreach( $usuarios as $usuario ){
			// Agregamos la info de cargo y area
			if( isset($usuario->id_cargo) && isset($usuario->id_area) ){
				$usuario->cargo;
				$usuario->area;
			}
		}

		// Retornamos todos los valores
		return $usuarios->toArray();
	}
	
	public function getRepresentantes(){
		$usuarios = Usuarios::where('representante_legal', '1')
		->select('id', 'nombres', 'apellidos')
		->get();

		return $usuarios;
	}

	public function getAllPaginate($pagina = 1, $show = 16){
		// Obtenemos todos los usuarios con paginacion
		Paginator::currentPageResolver(function() use ($pagina) {
			return $pagina;
		});

		// Armamos la query de los usuarios
		$usuarios = Usuarios::orderBy('nombres')
		->select('id', 'usuario', 'nombres', 'apellidos', 'email', 'id_cargo', 'id_area', 'rut', 'representante_legal')
		->paginate($show);

		// Agregamos la relacion de cargo y area	
		foreach( $usuarios as $usuario ){
			$usuario->cargo;
			$usuario->area;
		}

		// Disponibilizamos la data
		return $usuarios->toArray();
	}

	public function getUsuarios(Request $request){
		// API para traer los usuarios
		return $this->getAllPaginate( $request->page, $request->show );
	}

	public function update(Request $request){
		// PUT - Actualizamos la información de un usuario
		$usuario = Usuarios::where('usuario', $request->usuario['value'])->first();
		$data = new \stdClass;

		if( !$usuario ){
			// El usuario no existe
			return response()->json(['status' => false,  'message' => 'Ocurrió un problema al actualizar el usuario.']);
		}
		
		try{
			$usuario->nombres = $request->nombres['value'];
			$usuario->apellidos = $request->apellidos['value'];
			$usuario->rut = $request->rut['value'];
			$usuario->backup = $request->backup['value'];
			$usuario->email = $request->email['value'];
			$usuario->representante_legal = $request->representante_legal['value'];
			$usuario->excepcion = $request->excepcion['value'];
			$usuario->usuario_vivesoft = $request->usuario_vivesoft['value'];
			$usuario->vacaciones = $request->vacaciones['value'];
			$usuario->fecha_desde = $request->fecha_desde['value'];
			$usuario->fecha_hasta = $request->fecha_hasta['value'];
			$usuario->id_cargo = $request->id_cargo['value'];
			$usuario->id_area = $request->id_area['value'];
			$usuario->save();

			// Devolvemos
			$data = ['status' => true, 'message' => 'Usuario actualizado correctamente.'];
		}
		catch(\Exception $e){
			$data = ['status' => false, 'message' => 'Ocurrió un problema al intentar actualizar el usuario.', 'trace' => $e];
		}

		// Devolvemos la data
		return response()->json($data);
	}

	public function create(Request $request){
		// Buscamos si existe un usuario
		$exist = $this->checkUser([
			'usuario' => $request->usuario['value'],
			'rut' => $request->rut['value'],
			'email' => $request->email['value']
		]);
		
		if( $exist ){
			// El usuario existe
			return response()->json(['status' => false, 'message' => 'Ya existe con usuario con alguno de los datos proporcionados.']);
		}
		else{
			// El usuario no existe
			try{
				$usuario = new Usuarios();
				$usuario->password = bcrypt('1234');
				$usuario->usuario = $request->usuario['value'];
				$usuario->nombres = $request->nombres['value'];
				$usuario->apellidos = $request->apellidos['value'];
				$usuario->rut = $request->rut['value'];
				$usuario->backup = $request->backup['value'];
				$usuario->email = $request->email['value'];

				if( $request->has('representante_legal') ){
					$usuario->representante_legal = $request->representante_legal['value'];
				}
				if( $request->has('excepcion') ){
					$usuario->excepcion = $request->excepcion['value'];
				}
				if( $request->has('usuario_vivesoft') ){
					$usuario->usuario_vivesoft = $request->usuario_vivesoft['value'];
				}

				$usuario->id_cargo = $request->id_cargo['value'];
				$usuario->id_area = $request->id_area['value'];
				$usuario->save();

				$data = ['status' => true, 'message' => 'Usuario creado correctamente.', 'redirect' => route('usuarios.home')];
			}
			catch(\Exception $e){
				$data = ['status' => false, 'message' => 'Ocurrió un problema al intentar crear el usuario.'];
			}
		}

		return response()->json( $data );
	}

	public function updatePassword(Request $request){
		// PUT - Actualizamos la contraseña de un usuario
		$current = $request->password['current']['value'];
		$new = $request->password['new']['value'];
		$confirm = $request->password['confirm']['value'];
		$usuario = Usuarios::find($request->usuario);

		// El usuario no existe
		if( !$usuario ) return response()->json(['status' => false, 'message' => 'El usuario no existe.']);
		
		if( Auth::user()->id === $usuario ){
			// Se está intentando cambiar la misma contraseña del usuario logueado
			$hashedPassword = Auth::user()->password;
		}
		else{
			// Un usuario admin está intentando cambiar la contraseña
			$hashedPassword = $usuario->password;
		}

		if( !Hash::check($current, $hashedPassword) ){
			// La contraseña ingresada es correcta
			return response()->json(['status' => false, 'message' => 'La contraseña ingresada no es correcta.']);
		}

		if( $new !== $confirm ){
			// Las contraseñas no coinciden
			return response()->json(['status' => false, 'message' => 'Las contraseñas ingresadas no coinciden.']);
		}

		// El usuario existe
		try{
			$usuario->password = bcrypt($new);
			$usuario->save();
			$data = ['status' => true, 'message' => 'Contraseña actualizada correctamente.'];
		}
		catch(\Exception $e){
			$data = ['status' => false, 'message' => 'Ocurrió un problema al intentar actualizar la contraseña.'];
		}

		return response()->json($data);
	}

	public function updatePermisos(Request $request){
		$usuario = Usuarios::find( $request->id_usuario );
		$checked = [];

		foreach( $request->permisos as $permiso ){
			// Recorremos los permisos en busca de los checks
			if( $permiso['value'] ){
				array_push( $checked, $permiso['id'] );
			}
		}

		$usuario->permisos()->sync($checked);
		return response()->json( $checked );
	}
	public function updatePermisosNotificacion(Request $request){
		$usuario = Usuarios::find( $request->id_usuario );
		$checked = [];

		foreach( $request->permisos as $permiso ){
			// Recorremos los permisos en busca de los checks
			if( $permiso['value'] ){
				array_push( $checked, $permiso['id'] );
			}
		}

		$usuario->notificaciones()->sync($checked);
		return response()->json( $checked );
	}

	public function updateProyectos(Request $request){
		$usuario = Usuarios::find( $request->id_usuario );
		$checked = [];

		foreach( $request->proyectos as $proyecto ){
			// Recorremos los proyecto en busca de los checks
			if( $proyecto['value'] ){
				array_push( $checked, $proyecto['id'] );
			}
		}

		$usuario->proyectos()->sync($checked);
		return response()->json( $checked );
	}

	protected function checkUser($obj){
		// Verificamos si existe un usuario
		$user = Usuarios::where('usuario', $obj['usuario'])
		->orWhere('rut', $obj['rut'])
		->orWhere('email', $obj['email'])
		->first();

		return $user ? true : false;
	}

}
