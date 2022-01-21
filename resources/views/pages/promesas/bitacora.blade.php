@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<mdai-bitacora :data="{{ json_encode($data) }}"></mdai-bitacora>
@endsection