@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')

	<div class="heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1 text-normal">{{ $title }}</h1>
				<p>{{ $total_checklists }}</p>
			</div>
			<div class="col-6 text-right">
				<a href="#" class="btn btn-primary btn-action">
					<span class="fa fa-plus mr-4"></span>
					Nuevo checklist
				</a>
			</div>
		</div>
	</div>

	<mdai-table :head="['Nombre', 'Etapa', 'Nodo asociado', 'Total preguntas', 'Acciones']" :body="{{ json_encode($checklists) }}">
		<template slot-scope="{item}">
			<td v-text="item.tipo"></td>
			<td v-text="'Etapa ' + item.etapa"></td>
			<td>
				<span v-text="item.num_nodo ? item.num_nodo : '-'"></span>
				<span v-text="item.nodo ? ' - ' + item.nodo.actividad : ''"></span>
			</td>
			<td v-text="item.preguntas"></td>
			<td>
				<div class="row-actions" v-if="item.nodo">
					<a :href="route('checklists.detalle', item.id)">
						<mdai-tooltip text="Ver detalles" position="top">
							<span class="fa fa-eye"></span>
						</mdai-tooltip>
					</a>
					<a :href="route('checklists.editar', item.id)">
						<mdai-tooltip text="Editar checklist" position="top">
							<span class="fa fa-edit"></span>
						</mdai-tooltip>
					</a>
				</div>
			</td>
		</template>
	</mdai-table>
@endsection