@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1">{{ $title }}</h1>
			</div>
			<div class="col-12 col-sm-6">
				<div class="d-flex align-items-center justify-content-end">
					<a href="{{ route('proyecto.pis', $proyecto->id) }}" class="text-link mr-32">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver atrás
					</a>

					<a class="btn btn-action btn-primary" href="{{ route('excel.pis', ['proyecto' => $proyecto->id, 'etapa' => $etapa->id]) }}">
						Exportar a Excel
					</a>
				</div>
			</div>
		</div>
	</div>	

	@if( count($promesas) > 0 )
		<mdai-etapas
			:promesas="{{ json_encode($promesas) }}"
			:proyecto="{{ json_encode($proyecto) }}"
			:etapa="{{ json_encode($etapa) }}"
		></mdai-etapas>
	@endif
@endsection