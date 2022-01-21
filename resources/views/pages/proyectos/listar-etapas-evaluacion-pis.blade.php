@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')
	<pre class="d-none">
		@php print_r($etapas); @endphp	
	</pre>

	<div class="heading-block mb-30">
		<h1 class="heading-1 text-normal">Proyectos evaluación PIS</h1>
		<p> proyectos en total.</p>
	</div>

	@if( count($etapas) > 0 )
	<div class="content-block">
		<mdai-box>
			<template slot="content">
				<mdai-table
					:head="['Etapas', 'Fecha de recepcion', 'Promesas', 'Vulnerables','Total Unidades','Acciones']"
					:body="{{ json_encode($proyecto) }}">
					<template slot-scope="{item}">
						
						<td v-text="item.etapa"></td>
                        <td v-text="">01-10-2020</td>
						<td v-text="item.promesas"></td>
                        <td v-text="item"></td>
                        <td v-text=""> {{count($etapas)}}</td>
						<td>
							<div class="row-actions">
								<a :href="route('pis', item.id)">
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
	@endif
@endsection