<template>
	<div class="content-block">
		<mdai-accordion title="Resumen cliente/promesa" :active="active">
			<div class="form">
				<div class="row total mini align-items-end">
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">OPP</label>
							<p class="fw-semibold">{{ info.opp }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">RUT</label>
							<p class="fw-semibold">{{ info.rut_cliente | rut }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Nombres</label>
							<p class="fw-semibold">
								{{ info.primer_nombre | capitalize }}
								{{ (info.segundo_nombre) ? info.segundo_nombre : '' | capitalize }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Apellidos</label>
							<p class="fw-semibold">
								{{ info.apellido_paterno  | capitalize }}
								{{ (info.apellido_materno) ? info.apellido_materno : '' | capitalize }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Tipo</label>
							<p class="fw-semibold">{{ info.marca }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Ejecutivo</label>
							<p class="fw-semibold">{{ info.ejecutivo }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Unidad principal</label>
							<p class="fw-semibold">{{ ( info.lote ) ? info.lote : '-' }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Estacionamiento</label>
							<p class="fw-semibold">{{ ( info.estacionamiento ) ? info.estacionamiento : '-' }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Bodega</label>
							<p class="fw-semibold">{{ ( info.bodega) ? info.bodega : '-' }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Proyecto</label>
							<p class="fw-semibold">{{ info.proyectos.nombre }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Etapa</label>
							<p class="fw-semibold">{{ info.etapas.nombre }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Modelo</label>
							<p class="fw-semibold">{{ info.modelo }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2" v-if="info.marca === 'Vulnerable'">
						<div class="input-cont">
							<label class="label">Frente</label>
							<p class="fw-semibold">
								{{ ( info.frente ) ? info.frente : '-' }}
							</p>
						</div>
					</div>
					<div class="col-6 col-sm-2" v-if="info.marca === 'Vulnerable'">
						<div class="input-cont">
							<label class="label">Serviu</label>
							<p class="fw-semibold">{{ ( info.serviu ) ? info.serviu : '-' }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Fecha Promesa</label>
							<p class="fw-semibold">{{ info.fecha_promesa }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Precio Lista</label>
							<p class="fw-semibold">{{ info.precio_lista_opp }} UF</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Precio Final</label>
							<p class="fw-semibold">{{ info.precio_final_opp }} UF</p>
						</div>
					</div>
					<div class="col-6 col-sm-2">
						<div class="input-cont">
							<label class="label">Banco</label>
							<p class="fw-semibold">{{ (info.banco) ? info.banco : '-' | capitalize }}</p>
						</div>
					</div>
					<div class="col-6 col-sm-2" v-if="info.marca !== 'Vulnerable'">
						<div class="input-cont">
							<label class="label">Tipo de crédito</label>
							<p class="fw-semibold">{{ ( info.tipo_credito ) ? info.tipo_credito : '-' }}</p>
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
			active: { type: Boolean, default: true }
		}
	}
</script>