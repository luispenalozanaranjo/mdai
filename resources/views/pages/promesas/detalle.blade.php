@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="content-block heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-12 col-sm-4">
				<div class="d-flex align-items-center">
					<h1 class="heading-1 mr-20">{{ $title }}</h1>
					<mdai-status id="{{ $data->promesa->estados->id }}" estado="{{ $data->promesa->estados->descripcion }}"/>
				</div>
			</div>
			<div class="col-12 col-sm-8">
				<div class="btn-holder d-sm-flex justify-content-sm-end">
					@if( $data->promesa->estado !== 'Desistida' || $data->workflow_estado )
					<a href="{{ route('desistimiento', $data->promesa->opp) }}" class="btn btn-secondary btn-action">
						<div class="d-flex align-items-center justify-content-center">
							<span class="fa fa-unlink f-14 mr-8"></span>
							Desistimiento
						</div>
					</a>
					<a href="{{ route('cambio-unidad', $data->promesa->opp) }}" class="btn btn-secondary btn-action">
						<div class="d-flex align-items-center justify-content-center">
							<span class="fa fa-exchange-alt f-14 mr-8"></span>
							Cambio de Unidad
						</div>
					</a>
					@endif
					<a href="{{ route('documentos', $data->promesa->opp) }}" class="btn btn-alt btn-action">
						<div class="d-flex align-items-center justify-content-center">
							<span class="fa fa-file-upload f-14 mr-8"></span>
							Documentos subidos
						</div>
					</a>
					<a href="{{ route('bitacora', $data->promesa->opp) }}" class="btn btn-alt btn-action">
						<div class="d-flex align-items-center justify-content-center">
							<span class="fa fa-file-alt f-14 mr-8"></span>
							Historial de contacto
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<mdai-resumen-cliente :info="{{ json_encode($data->promesa) }}"></mdai-resumen-cliente>
    
	<mdai-resumen-workflow
		:promesa="{{ $data->promesa->opp }}"
		:etapas="{{ json_encode($data->etapas) }}"
		:promesamarca="{{json_encode($data->promesa)}}"
	></mdai-resumen-workflow>

@endsection