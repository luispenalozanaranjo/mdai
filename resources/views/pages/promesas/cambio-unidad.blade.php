@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1">{{ $title }}</h1>
			</div>
			<div class="col-12 col-sm-6 text-right">
				<div class="btn-holder">
					<a href="{{ route('detalle-promesa', $data->promesa->opp) }}" class="text-link">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver a la promesa
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