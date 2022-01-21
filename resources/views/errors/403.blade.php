@section('title', 'Error 403 - Prohibido')
@section('description', '')
@extends('layouts.error-layout')

@section('main-content')
	<div class="d-flex align-items-center justify-content-center h-100">
		<div class="text-center">
			<span class="f-64 fa fa-exclamation-circle text-normal"></span>
			<h1 class="heading-xlarge d-block text-normal mt-16 mb-4">Error 403</h1>
			@if( $exception->getMessage() )
				<p class="f-large">{{ $exception->getMessage() }}</p>
			@else
				<p class="f-large">No tienes permiso para acceder a este recurso.</p>
			@endif

			<div class="btn-holder mt-32">
				<a href="{{ route('dashboard') }}" class="btn btn-primary">Volver al Dashboard</a>
			</div>
		</div>
	</div>
@endsection