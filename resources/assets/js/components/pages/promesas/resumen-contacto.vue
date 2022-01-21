<template>
	<div class="content-block">
		<mdai-accordion title="Resumen contacto" :active="active">
			<div class="form">
				<div class="row total align-items-end">
					<div class="col-1">
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
								{{ info.primer_nombre | capitalize }} {{ (info.segundo_nombre) ? info.segundo_nombre : '' | capitalize }}
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
					<div class="col-3">
						<div class="input-cont">
							<label class="label">Email</label>
							<p class="fw-semibold">{{ info.email }}</p>
						</div>
					</div>
					<div class="col-2">
						<div class="input-cont">
							<label class="label">Teléfono</label>
							<p class="fw-semibold">{{ info.telefonos }}</p>
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