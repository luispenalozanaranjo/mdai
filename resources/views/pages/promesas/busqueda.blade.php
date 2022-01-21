@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<mdai-busqueda-promesa
		:estados="{{ json_encode($estados) }}"
		:proyectos="{{ json_encode($proyectos) }}"
		:marcas="{{ json_encode($marcas) }}"
		:ejecutivos="{{ json_encode($ejecutivos) }}"
		:etapas="{{ json_encode('') }}"
	></mdai-busqueda-promesa>
@endsection