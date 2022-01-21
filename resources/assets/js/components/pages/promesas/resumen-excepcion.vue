<template>
	<div class="content-block">
		<mdai-accordion title="Resumen promesa/excepción" :active="active">
			<div class="form">
				<div class="row total align-items-end">
					<div class="col-2">
						<div class="input-cont">
							<label class="label">OPP</label>
							<p class="fw-semibold">{{ info.opp }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">RUT</label>
							<p class="fw-semibold">{{ info.rut_cliente | rut }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Nombres</label>
							<p class="fw-semibold">
								{{ info.primer_nombre | capitalize }}
								{{ (info.segundo_nombre) ? info.segundo_nombre : '' | capitalize }}
							</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Apellidos</label>
							<p class="fw-semibold">
								{{ info.apellido_paterno  | capitalize }}
								{{ (info.apellido_materno) ? info.apellido_materno : '' | capitalize }}
							</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Tipo</label>
							<p class="fw-semibold">{{ info.marca }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Ejecutivo</label>
							<p class="fw-semibold">{{ info.ejecutivo }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Proyecto</label>
							<p class="fw-semibold">{{ info.proyectos.nombre }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Etapa</label>
							<p class="fw-semibold">{{ info.etapas.nombre }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Modelo</label>
							<p class="fw-semibold">{{ info.modelo }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Fecha Promesa</label>
							<p class="fw-semibold">{{ info.fecha_promesa }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Precio Final</label>
							<p class="fw-semibold">{{ info.precio_final_opp }} UF</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Banco</label>
							<p class="fw-semibold">{{ (info.banco) ? info.banco : '-' | capitalize }}</p>
						</div>
					</div>
					<div class="col-2" v-if="info.marca !== 'Vulnerable'">
						<div class="input-cont">
							<label class="label">Tipo de crédito</label>
							<p class="fw-semibold">{{ ( info.tipo_credito ) ? info.tipo_credito : '-' }}</p>
						</div>
					</div>
				</div>

				<hr class="my-30">
				<div class="row total align-items-end">
					<div class="col-7">
						<div class="input-cont">
							<label class="label">Documento</label>
							<p class="fw-semibold">{{ excepcion.pregunta.encabezado_pregunta }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Fecha de solicitud</label>
							<p class="fw-semibold">{{ excepcion.created_at }}</p>
						</div>
					</div>
					<div class="col-3">
						<div class="input-cont">
							<label class="label">Solicitado a</label>
							<p class="fw-semibold">{{ excepcion.usuario.nombres }} {{ excepcion.usuario.apellidos }}</p>
						</div>
					</div>
					<div class="col-7">
						<div class="input-cont">
							<label class="label">Observaciones</label>
							<p class="fw-semibold">{{ excepcion.observaciones }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Nodo</label>
							<p class="fw-semibold">{{ excepcion.nodo.nodo.num_nodo }} - {{ excepcion.nodo.nodo.subactividad }} </p>
						</div>
					</div>
				</div>
			</div>
		</mdai-accordion>
	</div>
</template>

<script>
	export default{
		props: {
			info: { type: [Array, Object], required: true },
			excepcion: { type: [Array, Object], required: true },
			active: { type: Boolean, default: true }
		},
		created: function(){
			console.log('excepcion =>', this.excepcion)
		}
	}
</script>