@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<pre class="d-none">
		@php print_r($proyectos); @endphp	
	</pre>

	<div class="heading-block mb-24">
		<h1 class="heading-1 text-normal">Proyectos evaluación PIS</h1>
		<p>{{ count($proyectos) }} proyectos en total.</p>
	</div>

	@if( count($proyectos) > 0 )
	<div class="content-block">
		<mdai-table
			:head="['Nombre','Etapas','Acciones']"
			:body="{{ json_encode($proyectos) }}">
			<template slot-scope="{item}">
				<td v-text="item.nombre"></td>
				<td v-text="item.etapas"></td>
				
				<td>
					<div class="row-actions">
						<a :href="route('pis.detalle', item.id)">
							<mdai-tooltip text="Ver detalles" position="top">
								<span class="fa fa-eye"></span>
							</mdai-tooltip>
						</a>
					</div>
				</td>
			</template>
		</mdai-table>
	</div>
	@endif
@endsection