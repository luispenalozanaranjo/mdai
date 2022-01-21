@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<pre class="d-none">
		@php print_r($proyecto); @endphp
	</pre>

	<mdai-proyectos-edit :proyecto="{{ json_encode($proyecto) }}"></mdai-proyectos-edit>
@endsection