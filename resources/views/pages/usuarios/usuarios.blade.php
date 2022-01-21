@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<pre class="d-none">
		@php print_r($usuarios); @endphp
	</pre>

	<mdai-usuarios :usuarios="{{ json_encode($usuarios)}}"></mdai-usuarios>
@endsection