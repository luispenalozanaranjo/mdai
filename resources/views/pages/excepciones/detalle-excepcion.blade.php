@section('title', $data->nodo->actividad)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="content-block heading-block">
		<div class="row total mini align-items-center">
			<div class="col-8">
				<div class="d-flex align-items-center">
					<h1 class="heading-1 mr-20">{{ $data->nodo->actividad }}</h1>
					<mdai-status id="{{ $data->detalle->estados->id }}" estado="{{ $data->detalle->estados->descripcion }}"></mdai-status>
				</div>
			</div>
			<div class="col-4 text-right">
				<a href="{{ route('excepcion', $data->detalle->id_excepcion) }}" class="btn btn-secondary btn-action">Volver a la excepción</a>
			</div>
		</div>
	</div>

	<mdai-resumen-excepcion :info="{{ json_encode($data->promesa) }}" :excepcion="{{ json_encode($data->detalle['excepcion']) }}"></mdai-resumen-excepcion>

	@switch( $data->nodo->num_nodo )
		@case(101)
			<mdai-autorizacion-check-excep :data="{{ json_encode($data) }}"></mdai-autorizacion-check-excep>
			@break
		@case(102)
			<mdai-solicitud-doc-cli-excep :data="{{ json_encode($data) }}"></mdai-solicitud-doc-cli-excep>
			@break
		@case(103)
			<mdai-envio-of-central-excep :data="{{ json_encode($data) }}"></mdai-envio-of-central-excep>
			@break
		@case(104)
			<mdai-recepcion-of-central-excep :data="{{ json_encode($data) }}"></mdai-recepcion-of-central-excep>
			@break
		@default
			<p>Ocurrió un problema al cargar la vista del nodo seleccionado.</p>
	@endswitch
@endsection
