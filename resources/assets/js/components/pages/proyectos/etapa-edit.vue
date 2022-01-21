<template>
	<div v-cloak>
		<div class="heading-block mb-24">
			<div class="row align-items-center">
				<div class="col-12 col-sm-6">
					<h1 class="heading-1">{{ proyecto.nombre }} - {{ etapa.nombre }} ({{ etapa.codigo }})</h1>
				</div>
				<div class="col-12 col-sm-6 text-right">
					<a :href="route('etapa', {proyecto: etapa.id_proyecto, etapa: etapa.id})" class="text-link">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver atrás
					</a>
				</div>
			</div>
		</div>
		
		<div class="content-block">
			<mdai-box title="Asignación proyecto / Vigenteo">
				<template slot="content">
					<div class="row total align-items-end">
						<!-- <div class="col-3">
							<div class="input-cont select">
								<label class="label">Ejecutivo asignado</label>
								<div class="cont">
									<select v-model="fields.id_usuario" required>
										<option selected disabled value="">Selecciona</option>
										<option v-for="(ejecutivo, index) in ejecutivos" :key="index" :value="ejecutivo.id_usuario">
											{{ ejecutivo.nombres }} {{ ejecutivo.apellidos }}
										</option>
									</select>
									<span class="fa fa-chevron-down input-icon"></span>
								</div>
							</div>
						</div> -->
						<!-- <div class="col-3">
							<div class="input-cont select">
								<label class="label">Región</label>
								<div class="cont">
									<select v-model="fields.id_region" required>
										<option selected disabled value="">Selecciona</option>
										<option v-for="(region, index) in regiones" :key="index" :value="region.id">
											{{ region.nombre }}
										</option>
									</select>
									<span class="fa fa-chevron-down input-icon"></span>
								</div>
							</div>
						</div> -->
						<div class="col-12 col-sm-3">
							<mdai-input label="Fecha de recepción final" class="active" type="date" v-model="fields.fecha_recepcion"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-select label="Meses escrituración" v-model="fields.escrituracion_notificacion" :data="meses"></mdai-select>
						</div>
					</div>
				</template>
				<template slot="action">
					<div class="btn-holder">
						<div class="row total mini align-items-end justify-content-end">
							<div class="col-6 text-right">
								<mdai-btn-action :class="{disabled: !asignacionValid}" class="btn-primary" text="Guardar" v-model="saving" @action="save"></mdai-btn-action>
							</div>
						</div>
					</div>
				</template>
			</mdai-box>
		</div>

		<div class="content-block">
			<form @submit.prevent="savePis">
				<mdai-box title="Configuración PIS">
					<template slot="content">
						<div class="row total">
							<div class="col-12 col-sm-3">
								<div class="mb-20" v-for="(n, index) in total_pis" :key="index">
									<h3 class="heading-5 mb-8">% PIS {{n}}</h3>
									<div class="row total mini align-items-center">
										<div class="col-6 col-sm-6">
											<mdai-input label="% Vulnerable" v-model="fields['pis_v_' + n]" max="2" :number="true"></mdai-input>
										</div>
										<div class="col-6 col-sm-6">
											<mdai-input label="% Total promesas" v-model="fields['pis_t_' + n]" max="2" :number="true"></mdai-input>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-4 offset-md-1">
								<h3 class="heading-5 mb-8">Totales</h3>
								<div class="row total mini">
									<div class="col-12 col-sm-6">
										<mdai-input label="Total vulnerables" v-model="fields.total_vulnerables" :number="true"></mdai-input>
									</div>
									<div class="col-12 col-sm-6">
										<mdai-input label="Total unidades" v-model="fields.total_unidades" :number="true"></mdai-input>
									</div>
								</div>
							</div>
						</div>
					</template>
					<template slot="action">
						<div class="btn-holder">
							<div class="row total mini align-items-end justify-content-end">
								<div class="col-6 text-right">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</div>
						</div>
					</template>
				</mdai-box>
			</form>
		</div>

	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				saving: false,
				total_pis: 5,
				meses: ['2', '3', '4', '5'],
				fields: {}
			}
		},
		props: {
			etapa: { type: [Object, Array], required: true },
			proyecto: { type: [Object, Array], required: true },
			regiones: { type: [Object, Array], required: true },
			ejecutivos: { type: [Object, Array], required: true },
		},
		computed: {
			asignacionValid: function(){
				// Validacion del primer form
				return !this.$methods.checkNullEmpty(this.fields.fecha_recepcion) &&
				!this.$methods.checkNullEmpty(this.fields.escrituracion_notificacion);
			}
		},
		methods: {
			save: function(){
				if( this.asignacionValid && !this.saving ){
					this.$store.commit('toggleAction');
					this.$store.commit('addActionText', 'Guardando cambios...');
					this.saving = true;

					this.$http.post('/etapa/save-config', {etapa: this.etapa.id, fields: {
						// Mandamos solo los dos fields necesarios (antes this.fields)
						fecha_recepcion: this.fields.fecha_recepcion,
						escrituracion_notificacion: this.fields.escrituracion_notificacion
					}})
					.then(response => {
						var response = response.data;
						
						// Mostramos el toast de acuerdo a la respuesta
						this.$store.commit('enableToast', {
							type: response.status ? 'success' : 'error',
							text: response.message
						});

						// Habilitamos el boton
						this.saving = false;
					})
					.finally(() => {
						// Eliminamos el loading
						this.$store.commit('toggleAction');
					});
				}
			},
			getDetalles: function(){
				// Obtenemos los valores desde el prop y los disponibilizamos en el data
				Object.entries(this.etapa).forEach(([key, value]) => {
					this.$set(this.fields, key, (value) ? value : "");
				});
			},
			porcentajes: function(){
				// Si los campos están vacíos, seteamos valores por defecto
				if( this.$methods.checkNullEmpty(this.fields.pis_v_1) ) this.fields.pis_v_1 = 80;
				if( this.$methods.checkNullEmpty(this.fields.pis_v_2) ) this.fields.pis_v_2 = 90;
				if( this.$methods.checkNullEmpty(this.fields.pis_v_3) ) this.fields.pis_v_3 = 90;
				if( this.$methods.checkNullEmpty(this.fields.pis_v_4) ) this.fields.pis_v_4 = 90;
				if( this.$methods.checkNullEmpty(this.fields.pis_v_5) ) this.fields.pis_v_5 = 90;
				if( this.$methods.checkNullEmpty(this.fields.pis_t_1) ) this.fields.pis_t_1 = 60;
				if( this.$methods.checkNullEmpty(this.fields.pis_t_2) ) this.fields.pis_t_2 = 60;
				if( this.$methods.checkNullEmpty(this.fields.pis_t_3) ) this.fields.pis_t_3 = 60;
				if( this.$methods.checkNullEmpty(this.fields.pis_t_4) ) this.fields.pis_t_4 = 80;
				if( this.$methods.checkNullEmpty(this.fields.pis_t_5) ) this.fields.pis_t_5 = 80;
			},
			savePis: function(){
				this.porcentajes();

				this.$store.commit('toggleAction');
				this.$store.commit('addActionText', 'Guardando cambios...');

				this.$http.post('/etapa/save-pis', {etapa: this.etapa.id, fields: this.fields})
				.then(response => {
					if( response.data ){
						// Todo bien
						this.$store.commit('enableToast', {
							text: 'Cambios guardados correctamente'
						});
					}
					else{
						// Hay algo mal
						this.$store.commit('enableToast', {
							text: 'Ocurrió un problema al intentar guardar los cambios',
							type: 'error'
						});
					}
				})
				.finally(() => {
					this.$store.commit('toggleAction');
				});
			}
		},
		created: function(){
			this.getDetalles();
			this.porcentajes();
		}
	}
</script>