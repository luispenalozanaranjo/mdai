@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="mb-30">
		<h1 class="heading-1 text-normal">{{ $title }}</h1>
	</div>

	<mdai-carga-preguntas></mdai-carga-preguntas>
	</div>
@endsection