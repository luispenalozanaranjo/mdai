@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-30">
		<h1 class="heading-1 text-normal">Revisiones pendientes</h1>
		<p>
			@if( $total === 0 ) No tienes revisiones pendientes.
			@elseif( $total === 1 ) {{ $total }} revisión pendiente.
			@else {{ $total }} revisiones pendientes en total.
			@endif
		</p>
	</div>

	@if( $total > 0 )
		@foreach($revisiones as $revision)
			<div class="heading-block mb-30">
				<h2 class="heading-4 mb-15">{{ $revision->nombre }}</h2>

				<mdai-box>
					<template slot="content">
						<mdai-table :head="['OPP', 'RUT', 'Nombre', 'Apellido', 'Proyecto', 'Etapa', 'Tipo', 'Ejecutivo', 'Estado', 'Workflow', 'Acciones']" :body="{{ json_encode($revision->flujo) }}">
							<template slot-scope="{ item }">
								<td v-text="item.opp"></td>
								<td :text-content.prop="item.rut_cliente | rut"></td>
								<td :text-content.prop="item.primer_nombre | capitalize"></td>
								<td :text-content.prop="item.apellido_paterno | capitalize"></td>
								<td :text-content.prop="item.proyecto | capitalize"></td>
								<td :text-content.prop="item.etapa | capitalize"></td>
								<td v-text="item.marca"></td>
								<td v-text="item.ejecutivo"></td>
								<td><mdai-status :id="item.estados.id" :estado="item.estados.descripcion"></mdai-status></td>
								<td>
									<mdai-status v-if="item.estado === 'Promesada'" :id="(item.workflow_estado) ? 13 : 3" :estado="(item.workflow_estado) ? 'Terminado' : 'Pendiente'"></mdai-status>
								</td>
								<td>
									<div class="row-actions">
										<a :href="route('detalle-promesa', item.opp)">
											<mdai-tooltip text="Ver detalles" position="top">
												<span class="fa fa-eye"></span>
											</mdai-tooltip>
										</a>
									</div>
								</td>
							</template>
						</mdai-table>
					</template>
				</mdai-box>
			</div>
		@endforeach
	@endif
@endsection