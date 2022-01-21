<template>
	<div v-cloak>
		<div class="content-block" v-if="fields">
			<form @submit.prevent="validateForm">
				<mdai-box :title="data.nodo.nodo.subactividad">
					<template slot="content">
						<mdai-errors-show :errors="errors"></mdai-errors-show>

						<div class="row total mini">
							<div class="col-6">
								<div class="input-cont checklists">
									<label class="label">Selecciona</label>
									<div class="radio">
										<input id="enviado" type="radio" value="Enviado" v-model="fields.tipo_envio.value" :disabled="terminado || !permiso" @change="disableTermino">
										<label for="enviado">Enviado</label>
									</div>
									<div class="radio">
										<input id="retirado" type="radio" value="Retirado" v-model="fields.tipo_envio.value" :disabled="terminado || !permiso" @change="disableTermino">
										<label for="retirado">Retirado</label>
									</div>
								</div>
							</div>
							<div class="col-6" v-if="fields.tipo_envio.value === 'Enviado'">
								<div class="input-cont">
									<label class="label" v-text="fields.chilexpress.nombre"></label>
									<div class="cont">
										<input type="text" name="comprobante" v-model="fields.chilexpress.value" :readonly="terminado || !permiso">
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="input-cont">
									<label class="label" v-text="fields.observaciones.nombre"></label>
									<div class="cont">
										<textarea name="observaciones" v-model="fields.observaciones.value" :readonly="terminado || !permiso"></textarea>
									</div>
								</div>
							</div>
						</div>
					</template>
					<template slot="action">
						<div class="btn-holder">
							<div class="row total mini align-items-center">
								<div class="col-6">
									<a :href="route('cambio-unidad', data.promesa.opp)" class="text-link">
										<span class="fa fa-chevron-left mr-5"></span>
										Volver atrás
									</a>
								</div>
								<div class="col-6">
									<div class="text-right">
										<button type="submit" v-if="!terminado" class="btn btn-secondary" v-show="permiso">Guardar</button>
										<button type="button" v-if="terminar && !terminado" v-show="permiso" @click.prevent="modalTerminar = true" class="btn btn-primary">
											Terminar
										</button>
									</div>
								</div>
							</div>
						</div>
					</template>
				</mdai-box>
			</form>
		</div>

		<mdai-lightbox v-model="modalTerminar" title="Terminar actividad">
			<p>¿Está seguro que desea terminar la actividad?</p>

			<div class="btn-holder">
				<div class="row total align-items-center">
					<div class="col-6">
						<a href="#" class="text-link" @click.prevent="modalTerminar = false">
							Cancelar
						</a>
					</div>
					<div class="col-6 text-right">
						<mdai-btn-action class="btn-action" text="Terminar actividad" v-model="action" @action="terminarActividad"></mdai-btn-action>
					</div>
				</div>
			</div>
		</mdai-lightbox>
	</div>
</template>

<script>
	export default{
		props: {
			data: { type: Object, required: true }
		},
		data: function(){
			return {
				terminar: false,
				modalTerminar: false,
				dataFields: [1, 2, 3],
				fields: null,
				errors: [],
				action: false
			};
		},
		computed: {
			terminado: function(){
				return ( this.data.nodo.estado === 13 ) ? true : false;
			}
		},
		methods: {
			getAlmacen: function(){
				// Obtenemos los campos requeridos
				this.$nodos.getAlmacen(this.dataFields, (response) => {
					this.fields = response;
				});
			},
			getDetalles: function(){
				// Buscamos en la base de datos los campos guardados
				this.$nodos.getDetalles(this.data.nodo)
				.then((response) => {
					var response = response.data;
					var detalles = response.detalles;

					if( detalles ){
						// Hay campos guardados
						detalles.forEach((item, index) => {
							// Recorremos los datos
							if( !this.$methods.checkNullEmpty(item.valor) ){
								// Pasamos el valor del campo guardado al objeto
								this.fields[item.almacen.slug].value = item.valor;
							}
						});

						// Verificamos si podemos terminar
						this.checkTermino();
					}
				});
			},
			validateForm: function(){
				this.errors = [];

				// Validaciones personalizada
				if( this.$methods.checkNullEmpty(this.fields.tipo_envio.value) ){
					this.errors.push('El tipo de envio es requerido.');
				}
				if( this.fields.tipo_envio.value === 'Enviado' && this.$methods.checkNullEmpty(this.fields.chilexpress.value) ){
					this.errors.push('El Nº comprobante Chilexpress es requerido.');
				}
				if( this.$methods.checkNullEmpty(this.fields.observaciones.value) ){
					this.errors.push('Las observaciones son requeridas.');
				}

				// No hay errores, se guardan los datos
				if( this.errors.length === 0 ){
					this.submit();
				}
			},
			submit: function(){
				// Método para guardar los datos
				let data = { id_dw: this.data.nodo.id_dw, id_nd: this.data.nodo.id, fields: this.fields };

				this.$nodos.saveDetalles(data, (response) => {
					// Callback al guardar detalles
					setTimeout(() => {
						this.checkTermino();
					}, 1000);
				})
				.finally(() => {
					this.submitAction = false;
				});
			},
			checkTermino: function(){
				// Checkea si todo está correcto para terminar
				if( !this.$methods.checkNullEmpty(this.fields.tipo_envio.value) && 
					this.fields.tipo_envio.value === 'Enviado' && !this.$methods.checkNullEmpty(this.fields.chilexpress.value) &&
					!this.$methods.checkNullEmpty(this.fields.observaciones.value) ){
					this.terminar = true;
				}else{
					this.terminar = false;
				}
			},
			disableTermino: function(){
				this.terminar = false;
				this.fields.chilexpress.value = null;
			},
			terminarActividad: function(){
				// Método para terminar la actividad
				this.action = true;
				this.$nodos.terminarActividad({nodo: this.data.nodo, marca: this.data.promesa.marca}, () => {
					// Callback al terminar la actividad
					window.location.replace( this.route('cambio-unidad', this.data.promesa.opp) );
				})
				.finally(() => {
					setTimeout(() => {
						this.action = false;
					}, 1000);
				});
			}
		},
		created: function(){
			console.info('data =>', this.data);
			this.getDetalles();
		}
	}
</script>