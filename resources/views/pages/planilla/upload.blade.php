@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<h1 class="heading-1">Cargar planilla</h1>
	</div>

	<mdai-carga-planilla></mdai-carga-planilla>
@endsection