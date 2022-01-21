@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-content mb-24">
		<div class="row align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1 text-normal">{{ $title }}</h1>
			</div>
			<div class="col-12 col-sm-6 d-flex justify-content-end">
				<a href="{{ route('finanzas.home') }}" class="text-link">
					<span class="fa fa-chevron-left mr-4"></span>
					Volver atrás
				</a>
			</div>
		</div>
	</div>

	<mdai-liquidacion-gastos-op
		:entidades="{{ json_encode($entidades) }}"
		:nodo="{{ json_encode($nodo) }}"
		:promesa="{{ json_encode($promesa) }}"
		:permiso="{{ json_encode($can_edit) }}"
	></mdai-liquidacion-gastos-op>
@endsection