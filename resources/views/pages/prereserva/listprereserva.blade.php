@section('title', $data->nodo->nodo->actividad)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="content-block heading-block mb-24">
		<div class="row total mini align-items-center">
			<div class="col-12 col-sm-8">
				<div class="d-flex align-items-center">
					<h1 class="heading-1 mr-20">{{ $data->nodo->nodo->actividad }} Pre-reserva </h1>
					<mdai-status id="{{ $data->nodo->estados->id }}" estado="{{ $data->nodo->estados->descripcion }}"></mdai-status>
				</div>
			</div>
			<div class="col-12 col-sm-4 text-right">
				<a href="{{ route('bitacora', $data->promesa->opp ) }}" class="btn btn-secondary btn-action">Historial de contacto</a>
			</div>
		</div>
	</div>

	<mdai-resumen-cliente-preventa :info="{{ json_encode($data->promesa) }}"></mdai-resumen-cliente-preventa>

	@switch( $data->nodo->nodo->num_nodo )
		@case(230)
		@case(240)
		@case(250)
			{{-- Checklist --}}
			<mdai-check-list-prereserva :data="{{ json_encode($data) }}"></mdai-check-list-prereserva>
			@break
		@default
			<p>Ocurrió un problema al cargar la vista del nodo seleccionado.</p>
	@endswitch
@endsection
