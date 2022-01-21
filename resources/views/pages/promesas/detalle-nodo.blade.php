@section('title', "Promesa ". $data->promesa->opp ." - ". $data->nodo->nodo->actividad)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<div class="row total mini align-items-center">
			<div class="col-12 col-sm-8">
				<div class="d-flex align-items-center">
					<h1 class="heading-1 mr-20">{{ $data->nodo->nodo->actividad }}</h1>
					<mdai-status id="{{ $data->nodo->estados->id }}" estado="{{ $data->nodo->estados->descripcion }}"></mdai-status>
				</div>
			</div>
			<div class="col-12 col-sm-4 text-right">
				<a href="{{ route('bitacora', $data->promesa->opp ) }}" class="btn btn-secondary btn-action">Historial de contacto</a>
			</div>
		</div>
	</div>

	<mdai-resumen-cliente :info="{{ json_encode($data->promesa) }}"></mdai-resumen-cliente>

	<div class="content-block mt-24">
	@switch( $data->nodo->nodo->num_nodo )
		{{-- Cambio de Unidad --}}
		@case(115)
			{{-- Cambio de unidad--}}
			<mdai-cu-solicitud :data="{{ json_encode($data)}}"></mdai-cu-solicitud>
			@break
		@case(116)
			{{-- Cambio de unidad--}}
			<mdai-cu-aprobacion-comercial :data="{{ json_encode($data) }}"></mdai-cu-aprobacion-comercial>
			@break
		@case(117)
			{{-- Cambio de unidad--}}
			<mdai-cu-analisis-riesgo :data="{{ json_encode($data) }}"></mdai-cu-analisis-riesgo>
			@break
        @case(118)
			{{-- Cambio de unidad rechazo--}}
			<mdai-recepcion-of-central :data="{{ json_encode($data) }}"></mdai-recepcion-of-central>
			@break
		@case(119)
			{{-- Cambio de unidad--}}
			<mdai-recepcion-of-central :data="{{ json_encode($data) }}"></mdai-recepcion-of-central>
			@break
		@case(121)
			{{-- Cambio de unidad--}}
			<mdai-cu-firma-cliente :data="{{json_encode($data)}}"><mdai-cu-firma-cliente>
			@break
		@case(122)
			{{-- Envio Oficina central --}}
			<mdai-envio-of-central :data="{{ json_encode($data) }}"></mdai-envio-of-central>
			@break
		@case(123)
			{{-- Recepción Oficina central --}}
			<mdai-recepcion-of-central :data="{{ json_encode($data) }}"></mdai-recepcion-of-central>
			@break
		@case(124)
			{{-- Cambio de unidad--}}
			{{-- Firma gerencia --}}
			<mdai-firma-gerencia :data="{{ json_encode($data) }}"></mdai-firma-gerencia>
			@break
		@case(125)
			{{-- Cambio de unidad--}}
			<mdai-cu-modifica-stock :data="{{json_encode($data)}}"></mdai-cu-modifica-stock>
			@break
		@case(126)
			{{-- Cambio de unidad--}}
			{{-- Digitalizar --}}
			<mdai-digitalizar :data="{{ json_encode($data) }}"></mdai-digitalizar>
			@break
		@case(127)
			{{-- Cambio de unidad--}}
			<mdai-cu-entrega-doc-cliente :data="{{json_encode($data)}}"></mdai-cu-entrega-doc-cliente>
			@break
		
		{{-- Etapa 1 --}}
		@case(200)
			{{-- Envio Oficina central --}}
			<mdai-envio-of-central :data="{{ json_encode($data) }}"></mdai-envio-of-central>
			@break
		@case(210)
			{{-- Recepción Oficina central --}}
			<mdai-recepcion-of-central :data="{{ json_encode($data) }}"></mdai-recepcion-of-central>
			@break
		@case(211)
			{{-- Asignación Revisor --}}
			<mdai-asignacion-revisor :data="{{ json_encode($data) }}"></mdai-asignacion-revisor>
			@break
		@case(230)
		@case(240)
		@case(250)
		@case(251)
			{{-- Checklist --}}
			<mdai-checklist :data="{{ json_encode($data) }}"></mdai-checklist>
			@break
		@case(260)
		@case(261)
			{{-- Visado --}}
			<mdai-visado :data="{{ json_encode($data) }}"></mdai-visado>
			@break
		@case(270)
		@case(271)
			{{-- Firma gerencia --}}
			<mdai-firma-gerencia :data="{{ json_encode($data) }}"></mdai-firma-gerencia>
			@break
		@case(280)
		@case(281)
		@case(300)
		@case(301)
		@case(120)
			{{-- Digitalizar --}}
			<mdai-digitalizar :data="{{ json_encode($data) }}"></mdai-digitalizar>
			@break
			@case(290)
			<mdai-revision-abogado :data="{{ json_encode($data) }}"></mdai-revision-abogado>
			@break
		@case(291)
			<mdai-revision-notaria :data="{{ json_encode($data) }}"></mdai-revision-notaria>
			@break
		@case(310)
			{{-- Envio oficina de venta --}}
			<mdai-oficina-venta-envio :data="{{ json_encode($data) }}"></mdai-oficina-venta-envio>
			@break
		@case(320)
			{{-- Recepción oficina de venta --}}
			<mdai-oficina-venta-recepcion :data="{{ json_encode($data) }}"></mdai-oficina-venta-recepcion>
			@break
		@case(321)
			{{-- Envio correo a cliente --}}
			<mdai-envio-correo-cliente :data="{{ json_encode($data) }}"></mdai-envio-correo-cliente>
			@break
		

		{{-- Etapa 2 --}}
		@case(340)
		@case(350)
		@case(360)
		@case(370)
		@case(400)
		@case(410)
		@case(420)
		@case(430)
		@case(460)
			{{-- Vigenteo 1 --}}
			<mdai-checklist :data="{{ json_encode($data) }}"></mdai-checklist>
			@break
		@case(380)
		@case(381)
		@case(470)
			{{-- Digitalizar --}}
			<mdai-digitalizar :data="{{ json_encode($data) }}"></mdai-digitalizar>
			@break
		@case(390)
			<mdai-tipo-credito :data="{{ json_encode($data) }}"></mdai-tipo-credito>
			@break
		@case(440)
			<mdai-revision-riesgo :data="{{ json_encode($data) }}"></mdai-revision-riesgo>
			@break
		@case(450)
			<mdai-solicitud-info-banco :data="{{ json_encode($data) }}"></mdai-solicitud-info-banco>
			@break


		{{-- Etapa 4 --}}
		@case(500)
		@case(510)
			{{-- Confección carpeta / Nominación adjudicacion --}}
			<mdai-checklist :data="{{ json_encode($data) }}"></mdai-checklist>
			@break
		@case(511)
			{{-- Estado escrituración --}}
			<mdai-estado-escrituracion :data="{{ json_encode($data) }}"></mdai-estado-escrituracion>
			@break
		@case(520)
			{{-- Orden escrituracion --}}
			<mdai-orden-escrituracion :data="{{ json_encode($data) }}"></mdai-orden-escrituracion>
			@break
		@case(521)
			{{-- Orden escrituracion --}}
			<mdai-orden-escrituracion-banco :data="{{ json_encode($data) }}"></mdai-orden-escrituracion-banco>
			@break
		@case(530)
			{{-- Borrador escritura --}}
			<mdai-borrador-escritura :data="{{ json_encode($data) }}"></mdai-borrador-escritura>
			@break
		@case(540)
			{{-- Notificacion notaria --}}
			<mdai-notificacion-notaria :data="{{ json_encode($data) }}"></mdai-notificacion-notaria>
			@break
		@case(550)
			{{-- Comprobación de firma --}}
			<mdai-comprobacion-firma :data="{{ json_encode($data) }}"></mdai-comprobacion-firma>
			@break
		@case(560)
			{{-- Cierre de copias --}}
			<mdai-cierre-copias :data="{{ json_encode($data) }}"></mdai-cierre-copias>
			@break
		@case(570)
			{{-- Ingreso conservador bienes raices --}}
			<mdai-ingreso-cbr :data="{{ json_encode($data) }}"></mdai-ingreso-cbr>
			@break
		@case(580)
			{{-- Egreso conservador bienes raices --}}
			<mdai-egreso-cbr :data="{{ json_encode($data) }}"></mdai-egreso-cbr>
			@break
		@case(581)
			{{-- Egreso conservador bienes raices --}}
			<mdai-egreso-cbr-chip :data="{{ json_encode($data) }}"></mdai-egreso-cbr-chip>
			@break

		{{-- Entrega unidad --}}
		@case(590)
			<mdai-entrega-unidad :data="{{ json_encode($data) }}"></mdai-entrega-unidad>
			@break
		@case(591)
			<mdai-digitalizar :data="{{ json_encode($data) }}"></mdai-digitalizar>
			@break
			
		{{-- Excepciones--}}
		@case(101)
			{{-- Excepciones --}}
			<mdai-autorizacion-check-excep :data="{{ json_encode($data) }}"></mdai-autorizacion-check-excep>
			@break
		@case(102)
			{{-- Excepciones --}}
			<mdai-solicitud-doc-cli-excep :data="{{ json_encode($data) }}"></mdai-solicitud-doc-cli-excep>
			@break
		@case(103)
			{{-- Excepciones --}}
			<mdai-envio-of-central :data="{{ json_encode($data) }}"></mdai-envio-of-central>
			@break
		@case(104)
			{{-- Excepciones --}}
			<mdai-recepcion-of-central :data="{{ json_encode($data) }}"></mdai-recepcion-of-central>
			@break

		{{-- Desistimiento --}}
		@case(150)
			{{-- Solicitud desistimiento al cliente  --}}
			<mdai-de-solicitud-cliente :data="{{ json_encode($data) }}"></mdai-de-solicitud-cliente>			
			@break
		@case(151)
		@case(159)
			{{-- digitalizar  --}}
			<mdai-digitalizar :data="{{ json_encode($data) }}"></mdai-digitalizar>			
			@break
		@case(152)
			{{-- Contactar al cliente  --}}
			<mdai-de-contactar-cliente :data="{{ json_encode($data) }}"></mdai-de-contactar-cliente>			
			@break
		@case(154)
			{{--Aprobacion Desistimiento  --}}
			<mdai-de-aprobacion-desistimiento :data="{{ json_encode($data) }}"></mdai-aprobacion-desistimiento>
			@break
		@case(156)
		@case(157)
		@case(158)
			{{-- Desistimiento  --}}
			<mdai-recepcion-of-central :data="{{ json_encode($data) }}"></mdai-recepcion-of-central>
			@break
		@case(161)
			{{-- Envio copia oficina central 1  --}}
			<mdai-de-envio-copia-oficina-central :data="{{json_encode($data)}}"><mdai-de-envio-copia-oficina-central>
			@break
		@case(163)
			{{-- recepción documentación  --}}
			<mdai-de-recepcion-documentacion :data="{{ json_encode($data) }}"></mdai-de-recepcion-documentacion>			
			@break
		@case(160)
			{{-- Firma cliente  --}}
			<mdai-de-firma-cliente :data="{{ json_encode($data) }}"></mdai-de-firma-cliente>
			@break
		@case(162)
		@case(165)
		@case(167)	
			{{-- Notifiación 2  --}}
			<mdai-digitalizar :data="{{ json_encode($data) }}"></mdai-digitalizar>
			@break
		@case(164)
			{{-- Envio documentacion a cliente --}}
			<mdai-firma-gerencia :data="{{ json_encode($data) }}"></mdai-firma-gerencia>
			@break
		@case(166)
			{{-- Notifiación 1  --}}
			<mdai-de-notificacion-renuncia-devolucion :data="{{ json_encode($data) }}"></mdai-de-notificacion-renuncia-devolucion>
			@break
		@case(168)
			{{-- Revisión carpeta  --}}
			<mdai-de-revision-carpeta :data="{{ json_encode($data) }}"></mdai-de-revision-carpeta>
			@break
		@case(169)
			{{-- Revisión carpeta  --}}
			<mdai-de-devolucion-documentos :data="{{ json_encode($data) }}"></mdai-de-devolucion-documentos>
			@break
		@case(170)
			{{-- Revisión carpeta  --}}
			<mdai-oficina-venta-envio :data="{{ json_encode($data) }}"></mdai-oficina-venta-envio>
			@break
		@case(171)
			{{-- Revisión carpeta  --}}
			<mdai-de-entrega-documentacion :data="{{ json_encode($data) }}"></mdai-de-entrega-documentacion>
			@break
			

		@default
			<p>Ocurrió un problema al cargar la vista del nodo seleccionado.</p>
	@endswitch
	</div>
@endsection