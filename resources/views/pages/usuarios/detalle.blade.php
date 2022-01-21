@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1 text-normal">{{ $title }}</h1>
			</div>
			<div class="col-12 col-sm-6 d-flex justify-content-end">
				<a href="{{ route('usuarios.home') }}" class="text-link">
					<span class="fa fa-chevron-left mr-4"></span>
					Volver atrás
				</a>
			</div>
		</div>
	</div> 

	<mdai-usuario-detalle
		:usuario="{{ json_encode($usuario) }}"
		:users="{{ json_encode($usuarios) }}"
		:cargos="{{ json_encode($cargos)}}"
		:areas="{{ json_encode($areas) }}"
		:permisos="{{ json_encode($permisos) }}"
		:permisos_granted="{{ json_encode($permisos_granted) }}"
		:proyectos="{{ json_encode($proyectos) }}"
		:proyectos_granted="{{ json_encode($proyectos_granted) }}"
		:manage_permisos="{{ json_encode($manage_permisos) }}"
		:permiso_notificacion="{{ json_encode($permiso_notificacion) }}"
	></mdai-usuario-detalle>
@endsection