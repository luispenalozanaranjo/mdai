<template>
	<div v-cloak>
		<div class="content-block" v-if="fields">
			<form @submit.prevent="validateForm">
				<mdai-box :title="data.nodo.nodo.subactividad">
					<template slot="content">
						<mdai-errors-show :errors="errors"></mdai-errors-show>
						<div class="row total align-items-center">
							<div class="col-6">
								<div class="input-cont checklists">
									<label class="label">Aprobación</label>
									<div class="radio">
										<input id="si1" type="radio" name="enviado" value="mayor valor" v-model="fields.cambio_unidad_tipo.value" :disabled="terminado || !permiso" @change="disableTermino">
										<label for="si1">Mayor valor</label>
									</div>
									<div class="radio">
										<input id="no1" type="radio" name="enviado" value="menor o igual valor" v-model="fields.cambio_unidad_tipo.value" :disabled="terminado || !permiso" @change="disableTermino">
										<label for="no1">Menor o igual valor</label>
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
										<mdai-btn-action v-if="!terminado" v-show="permiso" class="btn-secondary" text="Guardar" v-model="submitAction" @action="validateForm"></mdai-btn-action>

										<button type="button" v-if="terminar && !terminado" v-show="permiso" @click.prevent="modalTerminar = true" class="btn btn-primary">
											Terminar
										</button>

										<p class="f-12" v-if="terminado">
											<span class="fw-bold">{{ data.nodo.terminado.nombres }} {{ data.nodo.terminado.apellidos }}</span> terminó esta actividad el <span class="fw-bold">{{ data.nodo.salida_format }}</span>.
										</p>
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
						<mdai-btn-action class="btn-primary btn-action" text="Terminar actividad" v-model="action" @action="terminarActividad"></mdai-btn-action>
					</div>
				</div>
			</div>
		</mdai-lightbox>
	</div>
</template>

<script>
	export default{	props: {
			data: { type: Object, required: true }
		},
		data: function(){
			return {
				permiso: false,
				terminar: false,
				modalTerminar: false,
				dataFields: [1, 47],
				fields: null,
				errors: [],
				action: false,
				submitAction: false
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
					this.getDetalles();
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
							if( !this.$methods.checkNullEmpty(item.valor) && item.valor != 0 ){
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
				// Validacion del formulario
				if( !this.submitAction ){
					this.submitAction = true;
					this.errors = [];

					// Validaciones personalizadas
					if( this.$methods.checkNullEmpty(this.fields.cambio_unidad_tipo.value ) ){
						this.errors.push('Seleccione valor mayor o menor.');
					}
				
					if( this.$methods.checkNullEmpty(this.fields.observaciones.value) ){
						this.errors.push('Las observaciones son requeridas.');
					}

					// No hay errores, se guardan los datos
					if( this.errors.length === 0 ){
						this.submit();
					}
					else{
						this.submitAction = false;
					}
				}
			},
			submit: function(){
				// Método para guardar los datos
				let data = { id_dw: this.data.nodo.id_dw, id_nd: this.data.nodo.id, fields: this.fields, opp: this.data.promesa.opp, cambio_unidad_tipo: this.fields.cambio_unidad_tipo.value };

				this.$store.commit('toggleAction', true);
				this.$store.commit('addActionText', 'Guardando cambios...');

				this.$http.post( route('aprobacion.comercial'), data )
				.then((response) => {
					var response = response.data;
					if( response ){
						// Todo bien
						this.$store.commit('enableToast', {
							text: 'Cambios guardados correctamente'
						});
					}else{
						this.$store.commit('enableToast', {
							text: 'Ocurrió un problema al intentar guardar los cambios',
							type: 'error'
						});
					}
				})
				.catch((errors) => {
					console.log(errors);
					this.$store.commit('enableToast', {
						text: 'Ocurrió un problema al intentar guardar los cambios',
						type: 'error'
					});
				})
				.finally(() => {
					setTimeout(() => {
						this.$store.commit('toggleAction', false);
						this.submitAction = false;
						this.checkTermino();
					}, 100);
				});
			},
			checkTermino: function(){
				// Checkea si todo está correcto para terminar
				if( 
					(!this.$methods.checkNullEmpty(this.fields.cambio_unidad_tipo.value) && this.fields.cambio_unidad_tipo.value === "menor o igual valor" && 
					!this.$methods.checkNullEmpty(this.fields.observaciones.value)) || (!this.$methods.checkNullEmpty(this.fields.cambio_unidad_tipo.value) && this.fields.cambio_unidad_tipo.value === "mayor valor" && 
					!this.$methods.checkNullEmpty(this.fields.observaciones.value))  ){
					this.terminar = true;
				}else{
					this.terminar = false;
				}
			},
			disableTermino: function(){
				this.terminar = false;
			},
			terminarActividad: function(){
				// Método para terminar la actividad
				this.action = true;
				this.$nodos.terminarActividad({nodo: this.data.nodo, marca: this.data.promesa.marca, cambio_unidad_tipo: this.fields.cambio_unidad_tipo.value}, () => {
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
			this.getAlmacen();
			this.permiso = this.data.can_edit;
		}
	}
</script>