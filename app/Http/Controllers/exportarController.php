<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Data as Promesas;
use App\Dato as Datos;
use App\Formulario;
use App\Respuesta as Respuestas;
use App\Workflow;
use App\workflowDetalle;
use App\Nodo as Nodos;
use App\nodoDetalle as nodosDetalle;
use App\Documento;
use App\Proyecto as Proyectos;
use App\Etapa as Etapas;
use App\Usuario as Usuarios;
use App\Almacen as Almacen;

class exportarController extends Controller{

	public function exportaPdfView(){
		return view('exportar.pdf', [
			'title' => 'Exportar PIS',
		]);
	}

}