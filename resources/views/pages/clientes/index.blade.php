@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<mdai-clientes-home :data="{{ json_encode($clientes) }}">
	</mdai-clientes-home>
@endsection