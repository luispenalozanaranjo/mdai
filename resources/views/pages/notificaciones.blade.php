@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<h1 class="heading-1 text-normal">{{ $title }}</h1>
		<p>{{ $total_notificaciones }}</p>
	</div>

	<div class="box">
		<ul class="notificaciones-list">
			@foreach( $notificaciones as $notificacion )
			<li class="{{ ($notificacion->estado === 0) ? 'new' : '' }}">
				<a href="{{ $notificacion->url }}">
					<div class="row align-items-center justify-content-between">
						<div class="col-12 col-sm-6 d-flex align-items-center">
							<span class="fa fa-bell f-24 text-normal mr-16"></span>
							<p>
								<mark class="d-block">{{ $notificacion->titulo }}</mark>
								{{ $notificacion->detalle }}
							</p>
						</div>
						<div class="col-12 col-sm-6 text-right">
							<p class="f-12">{{ $notificacion->created_format }}</p>
						</div>
					</div>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
@endsection