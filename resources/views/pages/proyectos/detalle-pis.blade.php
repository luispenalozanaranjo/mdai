@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<pre class="d-none">
		@php print_r($proyecto); @endphp
	</pre>

	<div class="heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-6">
				<h1 class="heading-1">{{ $title }}</h1>
				<p>{{ $total_etapas }}</p>
			</div>
			<div class="col-6 text-right">
				<a href="{{ route('proyectos-pis') }}" class="text-link">
					<span class="fa fa-chevron-left mr-4"></span>
					Volver atrás
				</a>
			</div>
		</div>
	</div>

	@if( count($etapas) > 0 )
	<div class="content-block">
		<mdai-table
			:head="['Nombre', 'Código', 'Promesas', 'Acciones']"
			:body="{{ json_encode($etapas) }}">
			<template slot-scope="{item}">
				<td v-text="item.nombre"></td>
				<td v-text="item.codigo"></td>
				<td v-text="item.promesas"></td>
				<td>
					<div class="row-actions">
						<a :href="route('pisetapas', {proyecto: {{ $proyecto->id }}, etapa: item.id})">
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