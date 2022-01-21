@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="content-block heading-block">
		<div class="row total mini align-items-center">
			<div class="col-8">
				<div class="d-flex align-items-center">
					<h1 class="heading-1 mr-20">{{ $title }}</h1>
				</div>
			</div>
			<div class="col-4 text-right">
				<a href="{{ route('bitacora', $data->promesa->opp ) }}" class="btn btn-secondary btn-action">Historial de contacto</a>
			</div>
		</div>
	</div>

	<mdai-resumen-cliente :info="{{ json_encode($data->promesa) }}"></mdai-resumen-cliente>
	<mdai-subir-documentos :data="{{ json_encode($data) }}" :permiso="true"></mdai-subir-documentos>
@endsection