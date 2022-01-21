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
				<h1 class="heading-1">Proyecto {{ $proyecto->nombre }}</h1>
			</div>
			<div class="col-6">
				<div class="btn-holder d-flex align-items-center justify-content-end">
					<a href="{{ route('proyectos') }}" class="text-link mr-32">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver atrás
					</a>

					<a href="{{ route('proyecto.edit', $proyecto->id)}}" class="btn btn-primary btn-action">
						Editar proyecto
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="content-block">
		<mdai-accordion title="Resumen proyecto" :active="true">
			<div class="form">
				<div class="row total mini align-items-end">
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Código</label>
							<p class="fw-semibold">
								{{ $proyecto->codigo }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Dueño</label>
							<p class="fw-semibold">
								{{ $proyecto->dueno ? $proyecto->dueno : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Dirección</label>
							<p class="fw-semibold">
								{{ $proyecto->direccion ? $proyecto->direccion : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Comuna</label>
							<p class="fw-semibold">
								{{ $proyecto->comuna ? $proyecto->comuna : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Región</label>
							<p class="fw-semibold">
								{{ $proyecto->region  ? $proyecto->region  : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Inmobiliaria</label>
							<p class="fw-semibold">
								{{ $proyecto->inmobiliaria ? $proyecto->inmobiliaria : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">RUT Inmobiliaria</label>
							<p class="fw-semibold">
								{{ $proyecto->rut_inmobiliaria ? $proyecto->rut_inmobiliaria : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Estado</label>
							<p class="fw-semibold">
								{{ $proyecto->estado ? $proyecto->estado : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Programa</label>
							<p class="fw-semibold">
								{{ $proyecto->programa ? $proyecto->programa : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Tipologías</label>
							<p class="fw-semibold">
								{{ $proyecto->tipologias   ? $proyecto->tipologias   : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Viviendas totales</label>
							<p class="fw-semibold">
								{{ $proyecto->viviendas_totales ? $proyecto->viviendas_totales : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Tipo documento de venta</label>
							<p class="fw-semibold">
								{{ $proyecto->tipo_documento_venta ? $proyecto->tipo_documento_venta : '-' }}
							</p>
						</div>
					</div>
				</div>
			</div>
		</mdai-accordion>
	</div>

	@if( count($etapas) > 0 )
	<div class="content-block mt-32">
		<h1 class="heading-3">Etapas</h1>
		<p>{{ showTotal(count($etapas), 'etapa', 'etapas') }}</p>

		<mdai-table
			class="mt-16"
			:head="['Código', 'Nombre', 'Total promesas', 'Acciones']"
			:body="{{ json_encode($etapas) }}">
			<template slot-scope="{item}">
				<td v-text="item.codigo"></td>
				<td v-text="item.nombre"></td>
				<td v-text="item.promesas"></td>
				<td>
					<div class="row-actions">
						<a :href="route('etapa', {proyecto: item.id_proyecto, etapa: item.id})">
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