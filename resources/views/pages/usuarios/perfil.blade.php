@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="mb-24">
		<h1 class="heading-1 text-normal">Detalle usuario</h1>
	</div>

	<mdai-usuario-detalle
		:usuario="{{ json_encode($usuario) }}"
		:users="{{ json_encode($usuarios) }}"
		:cargos="{{ json_encode($cargos)}}"
		:areas="{{ json_encode($areas) }}"
	></mdai-usuario-detalle>
@endsection