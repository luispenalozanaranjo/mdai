@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<div class="row total mini align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1">{{ $title }}</h1>
			</div>
			<div class="col-12 col-sm-6">
				<div class="btn-holder d-flex align-items-center justify-content-end">
					<a href="{{ route('detalle-promesa', $promesa->opp) }}" class="text-link mr-32">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver a la promesa
					</a>
					<a href="{{ route('documentos.subir', $promesa->opp) }}" class="btn btn-primary btn-action">
						Agregar documento
					</a>
				</div>
			</div>
		</div>
	</div>

	<mdai-resumen-cliente :info="{{ json_encode($promesa) }}"></mdai-resumen-cliente>

	<div class="content-block mt-32">
		<div class="heading-block mb-16">
			<h2 class="heading-3">Lista de documentos</h2>
			<p>{{ $total_documentos }}</p>
		</div>
		@if( $documentos )
		<div class="box">
			<ul class="notificaciones-list">
				@foreach( $documentos as $documento )
				<li>
					<a href="/storage/{{ $documento->ruta }}">
						<div class="row align-items-center">
							<div class="col-12 col-sm-6 d-flex align-items-center">
								<span class="fa fa-file-alt f-32 text-normal mr-16"></span>
								<div>
									<p><mark>{{ $documento->nombre_original }}</mark></p>
									<p class="f-12 mt-5">Subido el {{ $documento->created_format }} por <mark>{{ $documento->usuario->nombres }} {{ $documento->usuario->apellidos }}</mark>.</p>
								</div>
							</div>
							<div class="col-12 col-sm-6 text-right">
								@if( $documento->nodoDetalle->nodo->etapa !== 8 )
								<p class="fw-semibold">Etapa {{ $documento->nodoDetalle->nodo->etapa }} | {{ $documento->nodoDetalle->nodo->subactividad }}</p>
								@else
								<p class="fw-semibold">Módulo subida de documentos</p>
								<p class="f-small">{{ $documento->comentarios }}</p>
								@endif

								@if( $documento->pregunta )
								<p class="f-small">{{ $documento->pregunta->encabezado_pregunta }}</p>
								@endif
							</div>
						</div>
					</a>
				</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
@endsection