@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<div class="row total align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1 text-normal">{{ $title }}</h1>
			</div>
			<div class="col-12 col-sm-6 d-flex justify-content-end">
				<a href="{{ route('finanzas.pago.busqueda') }}" class="text-link">
					<span class="fa fa-chevron-left mr-4"></span>
					Volver atrás
				</a>
			</div>
		</div>
	</div>

	<mdai-pago-operacion
		:entidades="{{ json_encode($entidades) }}"
		:nodo="{{ json_encode($nodo) }}"
		:promesa="{{ json_encode($promesa) }}"
		:permiso="{{ json_encode($can_edit) }}"
	/>
@endsection