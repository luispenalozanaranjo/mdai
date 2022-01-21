@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<pre class="d-none">
		@php print_r($proyecto); @endphp
	</pre>

	<mdai-proyectos-etapa-edit
		:etapa="{{ json_encode($etapa) }}"
		:proyecto="{{ json_encode($proyecto) }}"
		:regiones="{{ json_encode($regiones) }}"
		:ejecutivos="{{ json_encode($ejecutivos) }}"
	></mdai-proyectos-etapa-edit>
@endsection