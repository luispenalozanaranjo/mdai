@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<h1 class="heading-1 text-normal">{{ $title }}</h1>
	</div>

	@if( !empty($reportes) )
	<div class="row">
		@foreach($reportes as $reporte)
		<div class="col-12 col-sm-3">
			<div class="box dashboard-box">
				<a href="{{ $reporte->route }}" class="d-block p-16">
					<div class="d-flex align-items-center justify-content-center">
						<div class="text-center">
							<div class="d-flex align-items-center justify-content-center mb-16">
								<div class="circle-icon icon-md {{ $reporte->bg }}">
									<span class="{{ $reporte->icon }}"></span>
								</div>
							</div>
							<div class="text-cont">
								<h2 class="heading-3">{{ $reporte->name }}</h2>
								<div class="btn-holder mt-8">
									<p class="text-link">
										Ver detalles
										<span class="fa fa-chevron-right ml-4"></span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		@endforeach
	</div>
	@endif
@endsection