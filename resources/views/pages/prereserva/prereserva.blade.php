@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<h1 class="heading-1 text-normal">Búsqueda De Pre-Reserva</h1>
	</div>

	<mdai-busqueda-prereserva
		:estados="{{ json_encode($estados) }}"
		:proyectos="{{ json_encode($proyectos) }}"
		:marcas="{{ json_encode($marcas) }}"
		:ejecutivos="{{ json_encode($ejecutivos) }}"
		:etapas="{{ json_encode('') }}"
	></mdai-busqueda-prereserva>
@endsection