<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

use App\EntidadFinanciera as EntidadFinanciera;

class entidadFinancieraController extends Controller{

	public function get( $idEntidad ){
		// Busca una entidad, si no encuentra devuelve la excepcion
		try {
			return EntidadFinanciera::findOrFail( $idEntidad );
		}
		catch(\Exception $e){
			return false;
		}
	}

	protected function hasPermission(){
		// Verificamos los permisos del usuario
		$permissions = auth()->user()->permisos->where('num_nodo', 2003)->first();
		$can_access = ( !empty($permissions) || auth()->user()->id === 1 ) ? true : false;
		return $can_access;
	}

	public function getAll(){
		// Obtenemos la lista de todas las entidades financieras
		$entidades = EntidadFinanciera::all();
		return ( !$entidades->isEmpty() ) ? $entidades : false;
	}

	public function mainView(Request $request){
		// GET - Vista principal de las entidades financieras
		$entidades = $this->getAll();
		return view('pages.entidades-financieras.index', [
			'title' => 'Entidades Financieras',
			'entidades' => $entidades,
			'total_entidades' => showTotal($entidades->count(), 'entidad', 'entidades')
		]);
	}

	public function entidadNueva(){
		// GET - Vista para crear una nueva entidad financiera
		return view('pages.entidades-financieras.create', [
			'title' => 'Nueva Entidad Financiera'
		]);
	}

	public function entidadEdit(Request $request, $id){
		// GET - Vista edición de una entidad financiera
		$entidad = $this->get($id);

		// La entidad no existe
		if( !$entidad ) return abort(404, 'No se encontró la Entidad Financiera solicitada.');

		// La entidad existe
		return view('pages.entidades-financieras.edit', [
			'title' => 'Detalle Entidad Financiera',
			'entidad' => $entidad
		]);
	}

	public function create(Request $request){
		// POST - Creamos una nueva entidad
		$entidad = new EntidadFinanciera();
		$fields = $request->all();
		
		foreach ($fields as $item => $value) {
			// Agregamos los parametros al objeto
			$entidad[$item] = $value;
		}

		try{
			// Intentamos crearla
			$entidad->save();
			$data = [
				'status' => 'success',
				'message' => 'Entidad financiera creada correctamente.',
				'redirect' => route('entidades.home')
			];
		}
		catch(\Exception $e){
			// No se pudo crear
			$data = [
				'status' => 'error',
				'message' => 'Hubo un problema al intentar crear la entidad financiera.',
				'trace' => $e
			];
		}

		// Retornamos la data
		return response()->json($data);
	}

	public function update(Request $request, $id){
		// PUT - Actualizamos la información de una entidad financiera
		$entidad = $this->get($id);
		$data = ['status' => 'error', 'message' => 'Hubo un problema al intentar actualizar la entidad financiera.'];

		// La Entidad no existe
		if( !$entidad ) return $data;

		foreach( $request->all() as $item => $value ){
			// Agregamos los parametros al objeto
			$entidad[$item] = $value;
		}

		try{
			$entidad->save();
			$data = [
				'status' => 'success',
				'message' => 'Entidad financiera actualizada correctamente.',
				'redirect' => route('entidades.home')
			];
		}
		catch(\Exception $e){
			$data['trace'] = $e;
		}

		// Devolvemos la data
		return response()->json($data);
	}

	public function delete(Request $request, $id){
		// DELETE - Eliminamos una entidad financiera
		$entidad = $this->get($id);
		$data = ['status' => 'error', 'message' => 'Hubo un problema al intentar eliminar la entidad financiera.'];

		// La entidad no existe
		if( !$entidad ) return false;

		try{
			$entidad->delete();
			$data = [
				'status' => 'success',
				'message' => 'Entidad financiera eliminada correctamente.',
				'redirect' => route('entidades.home')
			];
		}
		catch(\Exception $e){
			$data['trace'] = $e;
		}

		// Devolvemos la data
		return response()->json($data);
	}

}
