@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1 text-normal">Agregar usuario</h1>
			</div>
			<div class="col-12 col-sm-6 d-flex justify-content-end">
				<a href="{{ route('usuarios.home') }}" class="text-link">
					<span class="fa fa-chevron-left mr-4"></span>
					Volver atrás
				</a>
			</div>
		</div>
	</div>

	<mdai-usuarios-agregar
		:areas="{{ json_encode($areas) }}"
		:users="{{ json_encode($usuarios) }}"
		:cargos="{{ json_encode($cargos) }}"
	/>
@endsection