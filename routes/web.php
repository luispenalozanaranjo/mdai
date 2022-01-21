<?php

Route::get('/', function(){
	return redirect('login');
});

Route::get('/info', function(){
	return phpinfo();
});



// Login
Route::get('/login', 'loginController@mainView')->name('login');
Route::post('/login', 'loginController@authenticate');

Route::group(['middleware' => 'auth'], function(){
	Route::get('/logout', 'loginController@getLogout')->name('logout');

	// Dashboard
	Route::get('/dashboard', 'dashboardController@mainView')->name('dashboard');
	Route::get('/revisiones-pendientes', 'revisionesController@obtenerPendientes')->name('rev-pendientes');
	

	// Mantenedores
	Route::get('/mantenedores', 'mantenedorController@mainView')->name('mantenedores')->middleware('permiso:2000');
	
	// Proyectos
	Route::get('/proyectos', 'proyectosController@mainView')->name('proyectos');
	Route::get('/proyectos/{proyecto}/detalles', 'proyectosController@proyectoView')->name('proyecto');
	Route::get('/proyectos/{proyecto}/editar', 'proyectosController@proyectoEdit')->name('proyecto.edit');
	Route::get('/proyectos/{proyecto}/etapa/{etapa}', 'proyectosController@etapaView')->name('etapa');
	Route::get('/proyectos/{proyecto}/etapa/{etapa}/editar', 'proyectosController@etapaEdit')->name('etapa.edit');
	
	// Proyectos API
	Route::post('/proyectos/save', 'proyectosController@proyectoSave');
	Route::post('/etapa/save-config', 'proyectosController@etapaSaveConfig');
	Route::post('/etapa/save-pis', 'proyectosController@etapaSavePis');


	// Planilla
	Route::group(['middleware' => 'permiso:2001'], function(){
		Route::get('/cargar-planilla', 'planillaController@mainView')->name('cargar-planilla');
		Route::post('/cargar-planilla', 'planillaController@upload');
	});

	// Clientes
	Route::group(['middleware' => 'permiso:2004', 'prefix' => 'clientes', 'as' => 'clientes.'], function(){
		Route::get('/', 'clientesController@mainView')->name('home');
		Route::get('{rut_usuario}/detalles', 'clientesController@detalleView')->name('detalles');
		// Clientes API
		Route::get('/get-all', 'clientesController@getClientes')->name('all');
	});


	// Entidades Financieras
	Route::group(['middleware' => 'permiso:2003', 'prefix' => 'entidades-financieras', 'as' => 'entidades.'], function(){
		Route::get('/', 'entidadFinancieraController@mainView')->name('home');
		Route::get('agregar', 'entidadFinancieraController@entidadNueva')->name('new');
		Route::get('{id}/editar', 'entidadFinancieraController@entidadEdit')->name('editar');
		
		Route::get('get', 'entidadFinancieraController@getAll')->name('get');
		Route::post('create', 'entidadFinancieraController@create')->name('create');
		Route::put('{id}/update', 'entidadFinancieraController@update')->name('update');
		Route::delete('{id}/delete', 'entidadFinancieraController@delete')->name('delete');
	});

	
	// Promesas (no hace falta middleware)
	Route::get('/promesa/{opp}/detalle', 'promesasController@detalleView')->name('detalle-promesa');
	Route::post('/promesa/tipo-credito', 'promesasController@updateTipoCredito')->name('tipo.credito');
	Route::post('/promesa/aprobacion-comercial', 'promesasController@aprobacionComercial')->name('aprobacion.comercial');
	//Route::post('/promesa/cliente-desiste', 'promesasController@clienteDesiste')->name('cliente.desiste');
	Route::get('/promesa/{opp}/historial-contacto', 'bitacoraController@mainView')->name('bitacora');
	Route::get('/promesa/{opp}/cambio-unidad', 'promesasController@cambioUnidadView')->name('cambio-unidad');
	Route::get('/promesa/{opp}/desistimiento', 'promesasController@desistimientoView')->name('desistimiento');
	Route::get('/promesa/{opp}/documentos', 'promesasController@documentosView')->name('documentos');
	Route::get('/promesa/{opp}/documentos/subir', 'promesasController@documentosSubir')->name('documentos.subir');

	Route::post('/bitacora/agregar', 'bitacoraController@agregarHistorial')->name('bitacora.agregar');
	Route::get('/promesa/busqueda', 'promesasController@busquedaView')->name('buscar-promesa');
	Route::get('/get-promesas', 'promesasController@searchPromesas');

	// Datos/Almacen
	Route::get('/almacen/get', 'promesasController@getAlmacen')->name('almacen.get');
	Route::get('/almacen/datos/get', 'promesasController@getDatos')->name('datos_almacen.get');

	// Checklist
	Route::get('/promesa/{opp}/nodo/{idNodo}', 'promesasController@nodoView')->name('nodo');
	Route::get('/nodo/detalles', 'promesasController@getDetallesNodo')->name('datos.get');
	Route::post('/nodo/guardar-detalles', 'promesasController@guardarDetallesNodo')->name('datos.save');
	Route::post('/nodo/terminar', 'promesasController@terminarNodo')->name('nodo.terminar');
	Route::post('/form/guardar-respuestas', 'promesasController@guardarRespuestas')->name('respuestas.save');
	Route::post('/nodo/digitalizar', 'promesasController@digitalizar')->name('digitalizar');
	// Route::get('/form/preguntas', 'formulariosController@preguntasView');
	// Route::post('/form/preguntas/upload', 'formulariosController@preguntasUpload')->name('preguntas.upload');
	Route::post('/cambiar-estado-pregunta', 'excepcionesController@cambiarEstado')->name('cambiar-estado-pregunta');

	// Comsiones
	Route::get('/promesa/busqueda-comision', 'promesasController@busquedaComision')->name('buscar-comision');
	Route::get('/promesa/{opp}/comision/{idNodo}', 'promesasController@comision')->name('comision');
	Route::post('/guarda-comision', 'promesasController@guardarComision')->name('guardar-comision');

	// Reversa operacion
	Route::get('/promesa/busqueda-reversa', 'promesasController@busquedaReversa')->name('buscar-reversa');
	Route::get('/promesa/{opp}/reversa', 'promesasController@reversa')->name('reversa');
    Route::post('/reversar', 'promesasController@spReversa')->name('reversar');

	// Pre-reserva
	
	Route::get('/promesa/ver-prereserva', 'promesasController@preReserva')->name('ver-prereserva');
	Route::get('/promesa/{opp}/prereserva/{idNodo}', 'promesasController@listprereserva')->name('prereserva');
	Route::get('/promesa/{opp}/detalleprereserva', 'promesasController@detallePreReserva')->name('detalle-prereserva');


	// Notificaciones
	Route::group(['prefix' => 'notificaciones', 'as' => 'notificaciones.'], function(){
		Route::get('/', 'notificacionController@mainView')->name('home');
		Route::get('/get-all', 'notificacionController@getAll')->name('all');
	});

	Route::get('/get-representantes', 'userController@getRepresentantes');
	// Usuarios
	Route::group(['middleware' => 'permiso:2002', 'prefix' => 'usuarios', 'as' => 'usuarios.'], function(){
		// Middleware para admin
		Route::group(['middleware' => 'permiso:2002'], function(){
			Route::get('/', 'userController@mainView')->name('home');
			Route::get('{usuario}/detalle', 'userController@usuarioView')->name('detalles');
			Route::get('agregar', 'userController@usuarioNuevo')->name('agregar');
		});

		// Usuarios no admin
		Route::get('perfil', 'userController@perfilView')->name('perfil');
		
		// Usuarios API	
		Route::get('get-all', 'userController@getUsuarios')->name('all');


		// CRUD
		Route::put('update', 'userController@update')->name('update');
		Route::post('create', 'userController@create')->name('create');
		Route::put('update-password', 'userController@updatePassword')->name('update.password');

		Route::put('update-permisos', 'userController@updatePermisos')->name('update.permisos');
		Route::put('update-permisos-notificacion', 'userController@updatePermisosNotificacion')->name('update.permisos.notificacion');
		Route::put('update-proyectos', 'userController@updateProyectos')->name('update.proyectos');
		Route::put('update-accesos/usuarios/{id}', 'userController@updateAccesoUser');
	});

	// Pis Proyectos
	Route::group(['middleware' => 'permiso:2005'], function(){
		Route::get('/pis', 'proyectosController@homePis')->name('proyectos-pis');
		Route::get('/pis/proyectos/{proyecto}/detalles', 'proyectosController@proyectoPisView')->name('proyecto.pis');
		Route::get('/pis/proyectos/{proyecto}/etapa/{etapa}', 'proyectosController@etapaView2')->name('pisetapas');
		Route::post('/guardar-pis/{promesa}', 'proyectosController@guardarPisPromesa')->name('pis.guardar');
		Route::get('/get-pis/{promesa}', 'proyectosController@getPis')->name('pis.get');
		Route::post('/pis-porcentaje', 'proyectosController@pisPorentaje')->name('pis.porcentaje');
		Route::post('/get-almacen-proyecto','proyectosController@getAlmacenProyecto')->name('pis.porcentaje');
	});
	Route::get('/get-etapa/{proyecto}', 'promesasController@getEtapa')->name('get.etapa');

	// Escrituración
	Route::get('/escrituracion', 'escrituracionController@mainView')->name('escrituracion');
	Route::get('/entrega-unidad', 'escrituracionController@entregaUnidadView')->name('entrega-unidad-home');
	Route::post('/entrega-unidad/busqueda', 'escrituracionController@searchEntregaUnidad')->name('entrega.unidad.search');
	Route::get('/entrega-unidad/{opp}', 'escrituracionController@entregaUnidad')->name('entrega-unidad');

	//ruta notificacion a nodo 590
	Route::post('/nodo/notificacion-entrega-unidad', 'promesasController@notificacionEntregaUnidad')->name('nodo.notificacion.entrega');
	Route::post('/notificacion-580-581', 'promesasController@notificacion580')->name('notificacion-580-581');

	// Finanzas
	Route::group(['prefix' => 'finanzas', 'as' => 'finanzas.'], function(){
		Route::get('/', 'finanzasController@Mainview')->name('home');
		Route::post('almacen/get', 'finanzasController@getAlmacen')->name('almacen.get');
		Route::put('terminar-nodo', 'finanzasController@terminarNodo')->name('terminar.nodo');
		
		// Liquidación gastos operacionales
		Route::get('liquidacion-gastos-operacionales', 'finanzasController@busquedaLiquidacionView')->name('liquidacion.busqueda');
		Route::get('liquidacion-gastos-operacionales/{opp}', 'finanzasController@liquidacionGastosView')->name('liquidacion.gastos');
		Route::post('liquidacion-gastos-operacionales/{opp}/save', 'finanzasController@guardarDetallesFinanzas')->name('liquidacion.save');

		// Pago operacion
		Route::get('pago-operacion', 'finanzasController@busquedaPagoView')->name('pago.busqueda');
		Route::get('pago-operacion/{opp}', 'finanzasController@pagoOperacionView')->name('pago.operacion');

		Route::get('/detalle-workflow/finanzas/get/{opp}', 'finanzasController@getDetalleWorkflow');
		Route::get('/detalle-workflow/finanzas/get/{opp}/pago', 'finanzasController@getDetalleWorkflowPago');
	});
	// Route::get('/pis', 'proyectosController@pisView')->name('pis');
	// Route::get('/pis/{proyecto}/detalle', 'proyectosController@pisDetalleView')->name('pis.detalle');
	
	// Exportar PDF
	Route::get('/plantilla-pdf', 'proyectosController@plantillaView')->name('pdf');
	Route::get('/excel-pis/proyectos/{proyecto}/etapa/{etapa}', 'proyectosController@excelPis')->name('excel.pis');

	// Roles
	Route::get('/roles', 'proyectosController@roles')->name('rolesa');

	// Excepciones
	Route::get('/excepciones/datos', 'excepcionesController@getDatos')->name('excepcion.datos');
	Route::get('/excepciones/{id}', 'excepcionesController@excepcionView')->name('excepcion');
	Route::get('/excepciones/{id}/detalle/{detalle}', 'excepcionesController@excepcionDetalle')->name('excepcion.detalle');
	Route::post('/excepciones/crear', 'excepcionesController@crearExcepcion')->name('excepciones.create');
	Route::post('/excepciones/terminar', 'excepcionesController@terminarExcepcion')->name('excepcion.terminar');

	
	// Reporteria
	Route::group(['prefix' => 'reporteria', 'as' => 'reporteria.'], function(){
		Route::get('/', 'reporteriaController@mainView')->name('home');
		Route::get('produccion', 'reporteriaController@produccion')->name('produccion');
		Route::get('produccion/{idProyecto}/descarga', 'reporteriaController@getProduccion')->name('produccion.get');
	});

	// Checklist
	Route::group(['middleware' => 'permiso:2008', 'prefix' => 'checklists', 'as' => 'checklists.'], function(){
		Route::get('/', 'formulariosController@mainView')->name('home');
		// Route::get('agregar', 'formulariosController@checklistAgregar')->name('agregar');
		// Route::post('agregar', 'formulariosController@checklistSave')->name('agregar.post');
		Route::get('{id}/detalle', 'formulariosController@checklistView')->name('detalle');
		Route::get('{id}/editar', 'formulariosController@checklistEdit')->name('editar');
		Route::put('{id}/update', 'formulariosController@checklistUpdate')->name('detalle.update');

		// Checklist preguntas
		Route::get('{id}/preguntas/agregar', 'formulariosController@preguntaAgregar')->name('preguntas.agregar');
		Route::post('preguntas/add', 'formulariosController@preguntaAdd')->name('preguntas.agregar.post');
		Route::get('preguntas/{id}/editar', 'formulariosController@preguntaEditar')->name('preguntas.editar');
		Route::put('preguntas/{id}/update', 'formulariosController@preguntaUpdate')->name('preguntas.update');
		Route::delete('preguntas/{id}/disable', 'formulariosController@preguntaDisable')->name('preguntas.delete');
		Route::put('preguntas/{id}/enable', 'formulariosController@preguntaEnable')->name('preguntas.enable');
	});

	// Archivos
	Route::get('storage/{disk}/{year}/{month}/{filename}', function($disk, $year, $month, $filename){
		$fullPath = "$year/$month/$filename";
		$exists = Storage::disk($disk)->exists($fullPath);

		// El archivo no existe
		if( !$exists ) return abort(404, 'Archivo no encontrado.');

		// El archivo existe
		$file = Storage::disk($disk)->get($fullPath);
		$type = Storage::disk($disk)->mimeType($fullPath);
		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);
		return $response;
	});
});