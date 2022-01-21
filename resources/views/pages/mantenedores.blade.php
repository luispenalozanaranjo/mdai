@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="mb-24">
		<h1 class="heading-1 text-normal">{{ $title }}</h1>
	</div>

	@if( !empty($mantenedores) )
		<div class="row mini total">
			@foreach($mantenedores as $mantenedor)
				@if( $mantenedor->permiso )
					<div class="col-12 col-sm-3">
						<div class="box dashboard-box h-100">
							<a href="{{ $mantenedor->route }}" class="d-block h-100 p-16">
								<div class="d-flex align-items-center justify-content-center h-100">
									<div>
										<div class="d-flex align-items-center justify-content-center mb-16">
											<div class="circle-icon icon-md {{ $mantenedor->bg }}">
												<span class="{{ $mantenedor->icon }}"></span>
											</div>
										</div>
										<div class="text-center text-cont">
											<h2 class="heading-3">{{ $mantenedor->name }}</h2>

											@if(($mantenedor->name !== 'Cargar planilla') AND ($mantenedor->name !== 'Comisiones') AND ($mantenedor->name !== 'Reversar OPP')  )
												<p>{{ $mantenedor->total }} en total.</p>
											@endif

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
				@endif
			@endforeach
		</div>
	@endif
@endsection