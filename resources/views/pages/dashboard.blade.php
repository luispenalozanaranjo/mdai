@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="mb-24">
		<h1 class="heading-1 text-normal">Dashboard</h1>
	</div>

	<div class="row">
		<div class="col-12 col-sm-3">
			<div class="box p-16 dashboard-box">
				<a href="{{ route('rev-pendientes') }}">
					<div class="d-flex justify-content-center mb-16">
						<div class="circle-icon icon-md bg-orange">
							<span class="fa fa-bell"></span>
						</div>
					</div>
					<div class="text-center text-cont">
						<p class="f-26 fw-semibold">{{ $revisiones }}</p>
						<p class="f-medium">
							@if( $revisiones === 1 ) revisión pendiente.
							@else Revisiones pendientes.
							@endif
						</p>

						<div class="btn-holder mt-16">
							<p class="text-link">
								Ver detalles
								<span class="fa fa-chevron-right ml-4"></span>
							</p>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
@endsection