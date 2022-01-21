@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	
	<div class="heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-6">
				<h1 class="heading-1 text-normal">{{ $title }}</h1>
				<p>{{ $total_proyectos }}</p>
			</div>
			<div class="col-6 text-right">
				@if( count($proyectos) > 0 )
				<a href="{{ route('reporteria.produccion.get', 0) }}" class="btn btn-primary btn-action">
					<span class="fa fa-download mr-4"></span>
					Exportar todo
				</a>
				@endif
			</div>
		</div>
	</div>

	@if( count($proyectos) > 0 )
	<div class="content-block">
		<mdai-table
			:head="['Código', 'Nombre', 'Dueño', 'Inmobiliaria', 'Programa', 'Etapas', 'Promesas', 'Acciones']"
			:body="{{ json_encode($proyectos) }}">
			<template slot-scope="{item}">
				<td v-text="item.codigo"></td>
				<td v-text="item.nombre"></td>
				<td v-text="item.dueno ? item.dueno : '-'"></td>
				<td v-text="item.inmobiliaria ? item.inmobiliaria : '-'"></td>
				<td v-text="item.programa ? item.programa : '-'"></td>
				<td v-text="item.etapas"></td>
				<td v-text="item.promesas"></td>
				<td>
					<div v-if="" class="row-actions">
						<a :href="route('reporteria.produccion.get', item.id)">
							<mdai-tooltip text="Descargar reporte" position="top">
								<span class="fa fa-download"></span>
							</mdai-tooltip>
						</a>
					</div>
				</td>
			</template>
		</mdai-table>
	</div>
	@endif

@endsection