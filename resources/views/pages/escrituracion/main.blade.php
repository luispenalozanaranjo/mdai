@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="mb-30">
		<h1 class="heading-1 text-normal">{{ $title }}</h1>
	</div>

	@if( !empty($escrituracion) )
	<div class="row">
		@foreach($escrituracion as $item)
		<div class="col-4">
			<div class="box dashboard-box">
				<a href="{{ $item->route }}" class="d-block p-15">
					<div class="d-flex align-items-center">
						<div class="mr-30">
							<div class="circle-icon icon-md bg-grey">
								<span class="{{ $item->icon }}"></span>
							</div>
						</div>
						<div class="text-cont">
							<p class="f-20">{{ $item->name }}</p>
							

							<div class="btn-holder mt-20">
								<p class="text-link">
									Ver detalles
									<span class="fa fa-chevron-right ml-5"></span>
								</p>
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