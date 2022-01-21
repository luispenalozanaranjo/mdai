<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Formulario as Formulario;
use App\Pregunta as Pregunta;
use App\Nodo as Nodo;
use App\workflowEtapas as workflowEtapas;

class formulariosController extends Controller{

	public function formulario($id){
		// Busca un formulario, si no lo encuentra devuelve la excepcion
		try {
			$formulario = Formulario::findOrFail($id);

			if( $formulario->num_nodo ){
				$formulario->nodo = Nodo::where('num_nodo', $formulario->num_nodo)->select('actividad', 'subactividad')->first();
				$formulario->preguntas = Pregunta::where('id_form', $formulario->id)->withTrashed()->get();
			}

			return $formulario;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function mainView(){
		// GET - Vista principal de los checklist
		$permissions = auth()->user()->permisos->where('num_nodo', 2003)->first();
		$can_access = ( !empty($permissions) || auth()->user()->id === 1 ) ? true : false;

		// No tiene permisos, abortamos
		if( !$can_access ) return abort(403);

		// Obtenemos todos los checklist
		$checklists = Formulario::all();
		
		foreach($checklists as $checklist){
			// Los recorremos y agregamos la info del nodo
			$nodo = Nodo::where('num_nodo', $checklist->num_nodo)->select('actividad', 'subactividad')->first();
			$preguntas = Pregunta::where('id_form', $checklist->id)->count();
			if( $nodo ) $checklist->nodo = $nodo;
			$checklist->preguntas = $preguntas;
		}
		
		// Devolvemos la vista
		return view('pages.formularios.home', [
			'title' => 'Checklists',
			'total_checklists' => showTotal(Formulario::count(), 'checklist', 'checklists'),
			'checklists' => $checklists
		]);
	}

	public function checklistView(Request $request){
		// GET - Mostramos el detalle de un checklist y preguntas
		$checklist = $this->formulario($request->id);

		// El checklist no existe
		if( !$checklist ) return abort(404);

		// Agregamos el detalle del nodo
		$nodo = Nodo::where('num_nodo', $checklist->num_nodo)->select('actividad', 'subactividad')->first();

		// Retornamos la data
		return view('pages.formularios.detalle', [
			'title' => "Checklist $checklist->tipo",
			'nodo' => $nodo,
			'checklist' => $checklist
		]);
	}

	public function checklistEdit(Request $request){
		// GET - Página de edición de un checklist
		$checklist = Formulario::findOrFail($request->id);

		// El checklist no existe
		if( !$checklist ) return abort(404);

		// Agregamos el detalle del nodo
		$nodo = Nodo::where('num_nodo', $checklist->num_nodo)->select('actividad', 'subactividad')->first();
		$checklist->nodo = $nodo;

		// Obtenemos la lista de etapas del workflow
		$workflowEtapas = workflowEtapas::get();

		foreach($workflowEtapas as $etapa){
			// Obtenemos la lista de nodos
			$etapa->nodos = Nodo::where('etapa', $etapa->id)->select('id', 'num_nodo', 'actividad', 'subactividad')->get();
		}

		// Retornamos la data
		return view('pages.formularios.editar', [
			'title' => "Edición Checklist $checklist->tipo",
			'etapas' => $workflowEtapas,
			'checklist' => $checklist
		]);
	}

	public function checklistUpdate(Request $request){
		// PUT - Actualizamos la información de un checklist
		$checklist = Formulario::findOrFail($request->id);
		$data = (object)['status' => false, 'message' => 'Hubo un problema al intentar actualizar el checklist.'];

		if( $checklist ){
			// Actualizamos el checklist
			$checklist->tipo = $request->tipo;
			$checklist->etapa = $request->etapa;
			$checklist->num_nodo = $request->num_nodo;
			$checklist->save();

			$data = (object)[
				'status' => true,
				'redirect' => route('checklists.detalle', $checklist->id),
				'message' => 'Checklist actualizado correctamente, serás redireccionado al detalle del checklist en unos momentos.'
			];
		}

		// Retornamos la data
		return response()->json( $data );
	}

	public function preguntaEditar(Request $request, $id){
		// GET - Página de edición de una pregunta
		$pregunta = Pregunta::find($id);
		
		// El checklist o la pregunta no existen
		if( !$pregunta ) return abort(404, 'La pregunta no existe.');

		// Agregamos el detalle del nodo
		$checklist = Formulario::find($pregunta->id_form);
		if( $checklist ){
			$nodo = Nodo::where('num_nodo', $checklist->num_nodo)->select('actividad', 'subactividad')->first();
			$checklist->nodo = $nodo;
		}

		return view('pages.formularios.preguntas.editar', [
			'title' => "Edición pregunta",
			'checklist' => $checklist,
			'pregunta' => $pregunta
		]);
	}

	public function preguntaUpdate(Request $request, $id){
		// PUT - Guardamos los cambios de una pregunta
		$pregunta = Pregunta::find($id);
		$error = ['status' => false, 'message' => 'Hubo un problema al intentar actualizar la pregunta.'];

		// La pregunta no existe
		if( !$pregunta ) return response()->json($error);

		try{
			// Intentamos guardar los campos
			$pregunta->encabezado_pregunta = $request->fields['encabezado_pregunta'];
			$pregunta->marca_campo = $request->fields['marca_campo'];
			$pregunta->configuracion = $request->fields['configuracion'];
			$pregunta->tipo = $request->fields['tipo'];
			$pregunta->requerido = $request->fields['requerido'];
			$pregunta->save();

			// Devolvemos el mensaje
			return response()->json([
				'status' => true,
				'message' => 'Pregunta actualizada correctamente, serás redireccionado al detalle del checklist en unos momentos.',
				'redirect' => route('checklists.detalle', $pregunta->id_form)
			]);
		}
		catch(\Exception $e){
			$error['trace'] = $e;
			return response()->json($error);
		}
	}

	public function preguntaDisable(Request $request, $id){
		// DELETE - Ocultamos una pregunta
		$pregunta = Pregunta::findOrFail($id);
		$data = ['status' => false, 'message' => 'Hubo un problema al intentar ocultar la pregunta.'];

		if( $pregunta ){
			// La pregunta existe, aplicamos soft delete
			$pregunta->delete();
			$data = ['status' => true, 'message' => 'Pregunta deshabilitada correctamente.'];
		}

		// Retornamos la data
		return response()->json($data);
	}

	public function preguntaEnable(Request $request, $id){
		// PUT - Habilitamos una pregunta
		$pregunta = Pregunta::withTrashed()->findOrFail($id);
		$data = ['status' => false, 'message' => 'Hubo un problema al intentar habilitar la pregunta.'];

		if( $pregunta ){
			// La pregunta existe, la restauramos
			$pregunta->restore();
			$data = ['status' => true, 'message' => 'Pregunta habilitada correctamente.'];	
		}

		// Devolvemos la data
		return response()->json($data);
	}

	public function preguntaAgregar(Request $request, $id){
		// GET - Pagína para agregar una pregunta
		$checklist = Formulario::find($id);

		// El checklist no existe
		if( !$checklist ) return abort(404);

		// Agregamos el detalle del nodo
		$nodo = Nodo::where('num_nodo', $checklist->num_nodo)->select('actividad', 'subactividad')->first();
		$checklist->nodo = $nodo;

		// El checklist existe, retornamos la vista y la data
		return view('pages.formularios.preguntas.agregar', [
			'title' => "Agregar pregunta",
			'checklist' => $checklist
		]);
	}

	public function preguntaAdd(Request $request){
		// POST - Creación de una pregunta
		$pregunta = new Pregunta();
		$num_pregunta_max = Pregunta::where('id_form', $request->id_form)->max('num_pregunta');
		
		foreach($request->all() as $key => $field){
			// Recorremos todo lo que nos llega del POST y
			// lo agregamos como campo en el modelo
			$pregunta[$key] = $field;
		}

		try{
			// Agregamos el correlativo del num_pregunta y guardamos
			$pregunta->num_pregunta = intval($num_pregunta_max) + 1;
			$pregunta->save();

			$data = [
				'status' => true,
				'message' => 'Pregunta agregada correctamente, serás redireccionado al detalle del checklist en unos momentos.',
				'redirect' => route('checklists.detalle', $request->id_form)
			];
		}
		catch(\Exception $e){
			// Hubo un problema al agregar la pregunta
			$data = ['status' => false, 'message' => 'Hubo un problema al intentar agregar la pregunta.'];	
		}

		// Devolvemos la data
		return response()->json($data);
	}
	
	// public function preguntasView(Request $request){
	// 	return view('pages.formularios.preguntas', [
	// 		'title' => 'Subir preguntas'
	// 	]);
	// }

	// public function preguntasUpload(Request $request){
	// 	foreach( $request->preguntas as $pregunta ){
	// 		Pregunta::create($pregunta);
	// 	}
	// 	// return response()->json($request);
	// }

}