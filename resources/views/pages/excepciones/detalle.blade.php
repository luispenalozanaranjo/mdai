@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="content-block heading-block">
		<div class="row total mini align-items-center">
			<div class="col-8">
				<div class="d-flex align-items-center">
					<h1 class="heading-1 mr-20">{{ $title }}</h1>
					<mdai-status id="{{ $excepcion->estado->id }}" estado="{{ $excepcion->estado->descripcion }}"></mdai-status>
				</div>
			</div>
			<div class="col-4 text-right">
				<a href="{{ route('nodo', ['opp' => $promesa->opp, 'idNodo' => $nodo->nodo->num_nodo] ) }}" class="btn btn-secondary btn-action">Volver a la actividad</a>
			</div>
		</div>
	</div>

	<mdai-resumen-excepcion :info="{{ json_encode($promesa) }}" :excepcion="{{ json_encode($excepcion) }}"></mdai-resumen-excepcion>
	<mdai-excepcion-flujo promesa="{{ $promesa->opp }}" :flujo="{{ json_encode($flujo) }}"></mdai-excepcion-flujo>
@endsection