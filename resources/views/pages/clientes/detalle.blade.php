@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<div class="heading-block mb-24">
		<div class="row total mini align-items-center">
			<div class="col-12 col-sm-6">
				<h1 class="heading-1">Detalle cliente</h1>
			</div>
			<div class="col-12 col-sm-6 text-right">
				<a href="{{ route('clientes.home') }}" class="text-link">
					<span class="fa fa-chevron-left mr-4"></span>
					Volver atrás
				</a>
			</div>
		</div>
	</div>

	<div class="content-block">
		<mdai-box title="Información personal">
			<template slot="content">
				<form class="form">
					<div class="row total mini align-items-end">
						<div class="col-12 col-sm-2">
							<div class="input-cont">
								<label class="label">RUT</label>
								<p class="fw-semibold">{{ parseRUT($usuario->rut_cliente) }}</p>
							</div>
						</div>
						<div class="col-12 col-sm-4">
							<div class="input-cont">
								<label class="label">Nombres</label>
								<p class="fw-semibold">
									{{ capitalize($usuario->primer_nombre) }} {{ capitalize($usuario->segundo_nombre) }}
								</p>
							</div>
						</div>
						<div class="col-12 col-sm-3">
							<div class="input-cont">
								<label class="label">Apellidos</label>
								<p class="fw-semibold">
									{{ capitalize($usuario->apellido_paterno) }} {{ capitalize($usuario->apellido_materno) }}
								</p>
							</div>
						</div>
						<div class="col-12 col-sm-3">
							<div class="input-cont">
								<label class="label">Estado civil</label>
								<p class="fw-semibold">{{ ($usuario->estado_civil) ? $usuario->estado_civil : '-' }}</p>
							</div>
						</div>
						<div class="col-12 col-sm-2">
							<div class="input-cont">
								<label class="label">Comuna</label>
								<p class="fw-semibold">{{ capitalize($usuario->comuna_cliente) }}</p>
							</div>
						</div>
						
						<div class="col-12 col-sm-4">
							<div class="input-cont">
								<label class="label">Email</label>
								<p class="fw-semibold">{{ strtolower($usuario->email) }}</p>
							</div>
						</div>
						<div class="col-12 col-sm-3">
							<div class="input-cont">
								<label class="label">Teléfono</label>
								<p class="fw-semibold">{{ $usuario->telefonos }}</p>
							</div>
						</div>
						<div class="col-12 col-sm-3">
							<div class="input-cont">
								<label class="label">Ejecutivo</label>
								<p class="fw-semibold">{{ $usuario->ejecutivo }}</p>
							</div>
						</div>
					</div>
				</form>
			</template>
		</mdai-box>
	</div>

	<div class="content-block mt-32">
		<div class="mb-16">
			<h2 class="heading-4">Unidades</h2>
			<p>{{ showTotal(count($unidades), 'unidad', 'unidades') }}</p>
		</div>

		<mdai-table :head="['OPP', 'Fecha promesa', 'Proyecto', 'Etapa', 'Tipo', 'Modelo', 'Producto', 'Frente', 'Serviu', 'Precio venta', 'Acciones']" :body="{{ json_encode($unidades) }}">
			<template slot-scope="{item}">
				<td v-text="item.opp"></td>
				<td v-text="item.fecha_promesa"></td>
				<td v-text="item.proyectos.nombre"></td>
				<td v-text="item.etapas.nombre"></td>
				<td v-text="item.marca"></td>
				<td v-text="item.modelo"></td>
				<td v-text="item.lote"></td>
				<td v-text="item.frente ? item.frente : '-'"></td>
				<td v-text="item.serviu ? item.serviu : '-'"></td>
				<td v-text="item.precio_unidad_principal"></td>
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
	</div> 
@endsection