<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
//use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
//use Caffeinated\Shinobi\Models\Role;
//use Caffeinated\Shinobi\Models\Permissions;
use App\Permisos;
use Auth;

class Usuario extends Model implements AuthenticatableContract{
	use Authenticatable;
	use Notifiable;
	//use HasRolesAndPermissions;

	protected $table = 'usuarios';
	protected $fillable = [ 'usuario', 'nombres', 'apellidos', 'rut', 'backup', 'email', 'vacaciones', 'fecha_desde', 'fecha_hasta', 'id_cargo', 'id_area', 'usuario_vivesoft'];

	public function getInfo(){
		// Objeto con la info del usuario logueado
		$info = new \stdClass;

		$nombre_expl = explode(' ', $this->nombres);
		$apellido_expl = explode(' ', $this->apellidos);

		$conectores = ['Del', 'de la'];
		$conector_found = searchInArray($conectores, $apellido_expl);

		$apellido_corto = [];
		$i = 0;

		while($conector_found){
			$index = array_search($conector_found[0], $apellido_expl);
			
			if( $i <= ($index + 1) ){
				array_push($apellido_corto, $apellido_expl[$i]);
				$i++;
			}
			else break;
		}

		$nombre_corto = count($nombre_expl) > 1 ? $nombre_expl[0] : $this->nombres;

		$info->nombre = $this->nombres;
		$info->apellido = $this->apellidos;
		$info->nombre_corto = $nombre_corto .' ' . (count($apellido_corto) > 1 && $conector_found ? implode(' ', $apellido_corto) : $apellido_expl[0]);
		$info->email = $this->email;
		$info->cargo = $this->cargo->nombre;
		$info->area = $this->area->nombre;
		$info->id = $this->id;
		$info->usuario = $this->usuario;
		return $info;
	}

	public function is_admin(){
		return ( $this->id === 1 );
	}

	public function getUsersCargo($idCargo){
		return $this->where('id_cargo', $idCargo)
		->select('id', 'nombres', 'apellidos', 'email')
		->get();
	}

	public function getExcepcionadores(){
		$usuarios = $this::where('excepcion', 1)
		->orWhere('id', 1)
		->select('id', 'nombres', 'apellidos')->get();
		return ( $usuarios ) ? $usuarios : false;
	}

	public function cargo(){
		// Relacion usuario/cargo
		return $this->belongsTo('App\Cargo', 'id_cargo');
	}

	public function area(){
		// Relacion usuario/area
		return $this->belongsTo('App\Area', 'id_area');
	}

	// public function tienePermiso($permiso) {
	// 	if( auth()->user()->id  === 1 ) return true;
	// 	$permisoObtenido = auth()->user()->permission->where('slug', $permiso)->first();
	// 	return ( !empty($permisoObtenido) ) ? true : false;
	// }

	// public function denegado($permiso) {
	// 	$permisoObtenido = auth()->user()->proyecto->where('id', $permiso)->first();
	// 	return ( !empty($tienePermiso) ) ? true : false;
	// }

	public function permisos(){
		return $this->belongsToMany('App\Permisos', 'permisos_usuarios', 'id_usuario', 'id_permiso');
	}
	public function notificaciones(){
		return $this->belongsToMany('App\Permisos', 'notificaciones_usuarios', 'id_usuario', 'id_permiso');
	}
	
	public function proyectos(){
		//return $this->belongsToMany('App\Proyecto', 'proyecto_usuario')->withPivot('usuario_id', 'proyecto_id');
		// return $this->belongsToMany('App\Proyecto', 'proyecto_usuario')->withPivot('usuario_id', 'proyecto_id')->where('proyecto_usuario.usuario_id','!=', 1);
		return $this->belongsToMany('App\Proyecto', 'proyectos_usuarios', 'id_usuario', 'id_proyecto');
	}
	
	public function NoProyecto(){
		return $this->belongsToMany('App\Proyecto', 'proyecto_usuarios')->wherePivot('usuario_id', '<>', 1);
	}

	//protected $with =['permission'];
}
