@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<h1 class="heading-1 text-normal">{{ $title }}</h1>
	</div>

	@if( !empty($finanzas) )
	<div class="row total mini">
		@foreach($finanzas as $finanza)
		<div class="col-12 col-sm-6 col-md-3">
			<div class="box dashboard-box">
				<a href="{{ $finanza->route }}" class="d-block p-16">
					<div class="d-flex align-items-center justify-content-center">
						<div>
							<div class="d-flex align-items-center justify-content-center mb-16">
								<div class="circle-icon icon-md {{ $finanza->bg }}">
									<span class="{{ $finanza->icon }}"></span>
								</div>
							</div>
							<div class="text-center text-cont">
								<h2 class="heading-3">{{ $finanza->name }}</h2>

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