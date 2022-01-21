<template>
	<div v-cloak>
		<div class="heading-block mb-24">
			<div class="row align-items-center">
				<div class="col-12 col-sm-6">
					<h1 class="heading-1">Proyecto {{ proyecto.nombre }}</h1>
				</div>
				<div class="col-12 col-sm-6 text-right">
					 <a :href="route('proyecto', {proyecto: proyecto.id})" class="text-link">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver atrás
					</a>
				</div>
			</div>
		</div>

		<div class="content-block">
			<form>
				<mdai-box title="Detalles">
					<template slot="content">
						<transition name="fade">
							<mdai-support class="mb-16" :theme="response.status ? 'success' : 'error'" v-if="!saving && done" :key="response.status">
								<p v-text="response.message"></p>
							</mdai-support>
						</transition>

						<div class="row total mini align-items-center">
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.nombre" label="Nombre" :readonly="true"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.codigo" label="Código"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.dueno" label="Dueño"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.direccion" label="Dirección"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.comuna" label="Comuna"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.region" label="Región"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.inmobiliaria" label="Inmobiliaria"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.rut_inmobiliaria" label="RUT Inmobiliaria"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.estado" label="Estado"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-select v-model="fields.programa" label="Programa" :data="['Privado', 'Subsidio (D19-DS1)']"></mdai-select>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-select v-model="fields.tipo_documento_venta" label="Tipo documento de venta" :data="['Promesa', 'Carta oferta']"></mdai-select>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.tipologias" label="Tipologías"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.viviendas_totales" label="Viviendas totales" :number="true" max="4"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.unidades_vulnerables" label="Unidades vulnerables" :number="true" max="4"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.unidades_medios" label="Unidades medios" :number="true" max="4"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-select v-model="fields.ggoo" label="GGOO" :data="optionsBool" show="show" val="value"></mdai-select>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-select v-model="fields.fondo_inicial" label="Fondo inicial" :data="optionsBool" show="show" val="value"></mdai-select>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-select v-model="fields.reserva" label="Reserva" :data="optionsBool" show="show" val="value"></mdai-select>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-select v-model="fields.checklist" label="Checklist" :data="optionsBool" show="show" val="value"></mdai-select>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-select v-model="fields.checklist_postulacion" label="Checklist postulación" :data="optionsBool" show="show" val="value"></mdai-select>
							</div>
						</div>
					</template>
					<template slot="action">
						<div class="row total mini align-items-center justify-content-end">
							<div class="col-6">
							   
							</div>
							<div class="col-6">
								<div class="btn-holder text-right">
									<mdai-btn-action class="btn-primary" text="Guardar cambios" v-model="saving" @action="save"></mdai-btn-action>
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
				done: false,
				response: null,
				optionsBool: [{value: '1', show: 'Si'}, {value: '2', show: 'No'}],
				fields: {}
			}
		},
		props: {
			proyecto: { type: [Object, Array], required: true }
		},
		computed: {
		},
		methods: {
			save: function(){
				this.$store.commit('toggleAction');
				this.$store.commit('addActionText', 'Guardando cambios...');
				this.saving = true;
				this.done = false;

				this.$http.post('/proyectos/save', {proyecto: this.proyecto.id, fields: this.fields})
				.then(response => {
					console.log(response);
					setTimeout(() => {
						this.response = response.data;
						this.saving = false;
						this.done = true;
						this.$store.commit('toggleAction');
					}, 500);
					
					// if( response.data ){
					// 	// Todo bien
					// 	this.$store.commit('enableToast', {
					// 		text: 'Cambios guardados correctamente'
					// 	});
					// }
					// else{
					// 	// Hay algo mal
					// 	this.$store.commit('enableToast', {
					// 		text: 'Ocurrió un problema al intentar guardar los cambios',
					// 		type: 'error'
					// 	});
					// }
				})
				.finally(() => {
				});
			},
			getDetalles: function(){
				Object.entries(this.proyecto).forEach(([key, value]) => {
					this.$set(this.fields, key, (value ? value : ''));
				});
			},
		},
		created: function(){
			console.log('proyecto =>', this.proyecto);
			this.getDetalles();
		}
	}
</script>