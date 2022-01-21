@section('title', $title)
@section('description', '')
@extends('layouts.main-layout')

@section('main-content')


<div class="content-block">
		<mdai-box title="Vista previa">
        
			<template slot="content">
            <div class="row" style="margin-top: -20px; padding-bottom: 20px;">
				<div class="col-12 text-right">
					<a class="btn btn-primary"  >Guardar</a>
					
				</div>
			
			</div>
				<mdai-plantilla-pdf
					:head="['RUT', 'Nombre', 'Apellido', 'Tipo', 'pis1','pis2','pis3','pis4','pis5']"
					:body="{{ json_encode($promesas) }}">
					<template slot-scope="{item}">
						<td :text-content.prop="item.rut_cliente | rut" v-if="item.marca != 'Privado'"></td>
						<td :text-content.prop="item.primer_nombre | capitalize" v-if="item.marca != 'Privado'"></td>
						<td :text-content.prop="item.apellido_paterno | capitalize" v-if="item.marca != 'Privado'"></td>
						<td v-text="item.marca" v-if="item.marca != 'Privado'"></td>
						<td  v-if="item.marca != 'Privado'">
                        <span  class="fa fa-check"></span>
                        </td>
						<td v-text="" v-if="item.marca != 'Privado'">
                        <span  class="fa fa-check"></span>
                        </td>
						<td v-text="" v-if="item.marca != 'Privado'">
                        <span  class="fa fa-check"></span>
                        </td>
						<td v-text="" v-if="item.marca != 'Privado'">
                        <span  class="fa fa-check"></span>
                        </td>
						<td v-text="" v-if="item.marca != 'Privado'">
                        <span  class="fa fa-check"></span>
                        </td>
						
					
						
					</template>
				</mdai-plantilla-pdf>

			</template>
		</mdai-box>

	</div>

@endsection