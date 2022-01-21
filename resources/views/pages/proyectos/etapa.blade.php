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
			</div>
			<div class="col-6">
				<div class="btn-holder d-flex align-items-center justify-content-end">
					<a href="{{ route('proyecto', $proyecto->id) }}" class="text-link mr-32">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver atrás
					</a>
					<a href="{{ route('etapa.edit', ['proyecto' => $proyecto->id, 'etapa' => $etapa->id]) }}" class="btn btn-primary btn-action">Editar etapa</a>
				</div>
			</div>
		</div>
	</div>

	<div class="content-block">
		<mdai-box title="Configuración">
			<template slot="content">
				<div class="form">
					<div class="row total align-items-end">
						<div class="col">
							<div class="input-cont">
								<label class="label">Fecha de recepción</label>
								<p class="fw-semibold">{{ $etapa->fecha_recepcion ?? '-' }}</p>
							</div>
						</div>
						<div class="col">
							<div class="input-cont">
								<label class="label">Total vulnerables</label>
								<p class="fw-semibold">{{ $etapa->total_vulnerables ?? '-' }}</p>
							</div>
						</div>
						<div class="col">
							<div class="input-cont">
								<label class="label">Total unidades</label>
								<p class="fw-semibold">{{ $etapa->total_unidades ?? '-' }}</p>
							</div>
						</div>
						<div class="col">
							<div class="input-cont">
								<label class="label">Meses escrituración</label>
								<p class="fw-semibold">{{ $etapa->escrituracion_notificacion ?? '-' }}</p>
							</div>
						</div>
						<div class="col">
							<div class="input-cont">
								<label class="label">Ejecutivo</label>
								<p class="fw-semibold">{{ $etapa->usuarios->nombres ?? '-' }} {{ $etapa->usuarios->apellidos ?? '' }}</p>
							</div>
						</div>
					</div>
				</div>
			</template>
		</mdai-box>
	</div>

	@if( count($promesas) > 0 )
	<div class="content-block mt-32">
		<h3 class="heading-4">Promesas</h3>
		<p>{{ $total_promesas }}</p>

		<mdai-table
			class="mt-16"
			:head="['OPP', 'RUT', 'Nombre', 'Apellido', 'Proyecto', 'Etapa', 'Tipo', 'Ejecutivo', 'Estado', 'Workflow', 'Acciones']"
			:body="{{ json_encode($promesas) }}">
			<template slot-scope="{ item }">
				<td v-text="item.opp"></td>
				<td :text-content.prop="item.rut_cliente | rut"></td>
				<td :text-content.prop="item.primer_nombre | capitalize"></td>
				<td :text-content.prop="item.apellido_paterno | capitalize"></td>
				<td :text-content.prop="item.proyecto | capitalize"></td>
				<td :text-content.prop="item.etapa | capitalize"></td>
				<td v-text="item.marca"></td>
				<td v-text="item.ejecutivo"></td>
				<td>
					<mdai-status :id="item.estados.id" :estado="item.estados.descripcion"></mdai-status>
				</td>
				<td>
					<mdai-status
						v-if="item.estado === 'Promesada' || item.estado === 'Escriturada'"
						:id="item.workflow_estado ? 13 : 3"
						:estado="item.workflow_estado ? 'Terminado' : 'Pendiente'"
					></mdai-status>
					<mdai-status v-else id="2" estado="Desistida"></mdai-status>
				</td>
				<td>
					<div class="row-actions">
						<a :href="route('detalle-promesa', item.opp)" v-if="item.workflow">
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