<template>
	<div>
		<div class="heading-block mb-24">
			<div class="row total mini align-items-center">
				<div class="col-12 col-sm-6">
					<h1 class="heading-1 text-normal">Historial de contacto</h1>
				</div>
				<div class="col-12 col-sm-6">
					<div class="btn-holder d-flex align-items-center justify-content-end">
						<a :href="route('detalle-promesa', data.promesa.opp)" class="text-link mr-32">
							<span class="fa fa-chevron-left mr-4"></span>
							Volver a la promesa
						</a>
						<a href="#" class="btn btn-primary btn-action" @click.prevent="modalAgregar = true">Agregar</a>
					</div>
				</div>
			</div>
		</div>

		<mdai-resumen-contacto :info="data.promesa"></mdai-resumen-contacto>

		<div class="content-block mt-32">
			<div class="heading-block">
				<h3 class="heading-3">Historial</h3>
				<p>{{ $methods.showTotal(checkHistorial.length, 'registro', 'registros') }}</p>
			</div>
			<mdai-box v-if="checkHistorial.length">
				<template slot="content">
					<mdai-table
						:head="['Fecha de contacto', 'Fecha recepción documento', 'Observaciones', 'Acción']"
						:body="checkHistorial">
						<template slot-scope="{ item }">
							<td>{{ item.created_at }}</td>
							<td>{{ item.fec_recepcion_doc }}</td>
							<td>{{ item.observaciones }}</td>
							<td>{{ item.accion }}</td>
						</template>
					</mdai-table>
				</template>
			</mdai-box>
		</div>

		<mdai-lightbox v-model="modalAgregar" title="Agregar historial">
			<form @submit.prevent="validateForm">
				<mdai-errors-show :errors="errors"></mdai-errors-show>
				<div class="row total mini">
					<div class="col-12">
						<div class="input-cont checklists">
							<label class="label">Selecciona</label>
							<div class="radio">
								<input id="llamada" type="radio" value="Llamada teléfonica" v-model="fields.tipo_contacto">
								<label for="llamada">Llamada teléfonica</label>
							</div>
							<div class="radio">
								<input id="email" type="radio" value="Email" v-model="fields.tipo_contacto">
								<label for="email">Email</label>
							</div>
							<div class="radio">
								<input id="whatsapp" type="radio" value="WhatsApp" v-model="fields.tipo_contacto">
								<label for="whatsapp">WhatsApp</label>
							</div>
							<div class="radio">
								<input id="facebook" type="radio" value="Facebook" v-model="fields.tipo_contacto">
								<label for="facebook">Facebook</label>
							</div>
						</div>
					</div>
					<div class="col-12">
						<mdai-input class="active" v-model="fields.recepcion_documento" label="Fecha recepción documento" type="date"></mdai-input>
					</div>
					<div class="col-12">
						<mdai-input v-model="fields.observaciones" label="Observaciones" max="70"></mdai-input>
					</div>
				</div>

				<div class="btn-holder">
					<div class="row total align-items-center">
						<div class="col-6">
							<a href="#" class="text-link" @click.prevent="modalAgregar = false">
								Cancelar
							</a>
						</div>
						<div class="col-6 text-right">
							<mdai-btn-action class="btn-primary btn-action" :class="{disabled: !historialValid}" text="Agregar" v-model="submitAction" @action="validateForm"></mdai-btn-action>
						</div>
					</div>
				</div>
			</form>
		</mdai-lightbox>
	</div>
</template>

<script>
	export default{
		props: {
			data: { type: [Array, Object], required: true }
		},
		data: function(){
			return {
				modalAgregar: false,
				submitAction: false,
				errors: [],
				historial: [],
				fields: {
					observaciones: null,
					tipo_contacto: null,
					recepcion_documento: null
				}
			};
		},
		computed: {
			checkHistorial: function(){
				return ( this.$methods.checkNullEmpty(this.historial) ) ? this.data.historial : this.historial;
			},
			historialValid: function(){
				return !this.$methods.isEmpty(this.fields.recepcion_documento) && !this.$methods.isEmpty(this.fields.tipo_contacto) && !this.$methods.isEmpty(this.fields.observaciones);
			}
		},
		methods: {
			validateForm: function(){
				// Validacion del formulario
				if( !this.submitAction ){
					this.submitAction = true;
					this.errors = [];

					// Validaciones personalizadas
					if( this.$methods.checkNullEmpty(this.fields.tipo_contacto) ){
						this.errors.push('Selecciona un tipo de contacto');
					}
					if( this.$methods.checkNullEmpty(this.fields.observaciones) ){
						this.errors.push('Las observaciones son requeridas.');
					}

					// No hay errores, se guardan los datos
					if( this.errors.length === 0 ){
						this.agregar();
					}else{
						this.submitAction = false;
					}
				}
			},
			agregar: function(){
				let data = {opp: this.data.promesa.opp, fields: this.fields};

				this.$http.post(route('bitacora.agregar', data))
				.then((response) => {
					var response = response.data;

					if( response ){
						this.modalAgregar = false;
						this.submitAction = false;
						this.historial = response;

						Object.entries(this.fields).forEach(([key, value]) => {
							this.fields[key] = null;
						});
					}
				})
			}
		}
	}
</script>