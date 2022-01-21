@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
    <div class="heading-block mb-24">
		<div class="row align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1">{{ $title }}</h1>
				<p>{{ $total_entidades }}</p>
			</div>
			<div class="col-12 col-sm-6 text-right">
				<a href="{{ route('entidades.new') }}" class="btn btn-primary btn-action">
					<span class="fa fa-plus mr-4"></span>
					Agregar entidad
				</a>
			</div>
		</div>
	</div>

	@if( count($entidades) > 0 )
	<div class="content-block">
		<mdai-table :head="['Nombre', 'Tipo', 'Estado', 'Acciones']" :body="{{ json_encode($entidades) }}">
			<template slot-scope="{item}">
				<td v-text="item.nombre"></td>
				<td v-text="item.tipo"></td>
				<td v-text="(item.estado === 1) ? 'Vigente' : 'No vigente'"></td>
				<td>
					<div class="row-actions">
						<a :href="route('entidades.editar', item.id)">
							<mdai-tooltip text="Editar entidad" position="top">
								<span class="fa fa-edit"></span>
							</mdai-tooltip>
						</a>
					</div>
				</td>
			</template>
		</mdai-table>
	</div>
	@endif
@endsection
