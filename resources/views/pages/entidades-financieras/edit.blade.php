@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<mdai-entidades-detalle :entidad="{{ json_encode($entidad) }}"></mdai-entidades-detalle>
@endsection
