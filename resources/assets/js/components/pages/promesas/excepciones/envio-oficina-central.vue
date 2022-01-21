<template>
	<div v-cloak>
		<div class="content-block" v-if="ready">
			<form @submit.prevent="validateForm">
				<mdai-box :title="data.nodo.subactividad">
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
									<div class="radio">
										<input type="radio" id="en_oficina" value="Documentos en oficina central" v-model="fields.tipo_envio.value" :disabled="terminado || !permiso" @change="disableTermino">
										<label for="en_oficina">Documentos en oficina central</label>
									</div>
								</div>
							</div>
							<div class="col-6" v-if="fields.tipo_envio.value === 'Enviado'">
								<mdai-input :label="fields.chilexpress.nombre"  v-model="fields.chilexpress.value" :readonly="terminado || !permiso" />
							</div>
							<div class="col-12">
								<mdai-input :label="fields.observaciones.nombre"  v-model="fields.observaciones.value" :readonly="terminado || !permiso" />
							</div>
						</div>
					</template>
					<template slot="action">
						<div class="btn-holder">
							<div class="row total mini align-items-center">
								<div class="col-6">
									<a :href="route('excepcion', data.detalle.id_excepcion)" class="text-link">
										<span class="fa fa-chevron-left mr-5"></span>
										Volver atrás
									</a>
								</div>
								<div class="col-6">
									<div class="text-right">
										<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="validateForm" v-show="permiso"></mdai-btn-action>

										<button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" class="btn btn-primary" v-show="permiso">
											Terminar
										</button>

										<p class="f-12" v-if="terminado">
											<span class="fw-bold">{{ data.detalle.terminado.nombres }} {{ data.detalle.terminado.apellidos }}</span> terminó esta actividad el <span class="fw-bold">{{ data.detalle.salida_format }}</span>.
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
	export default{
		props: {
			data: { type: Object, required: true },
		},
		data: function(){
			return {
				permiso: false,
				ready: false,
				terminar: false,
				modalTerminar: false,
				dataFields: [1, 2, 3],
				fields: null,
				errors: [],
				action: false,
				submitAction: false
			};
		},
		computed: {
			terminado: function(){
				return ( this.data.detalle.id_estado === 13 ) ? true : false;
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
				this.$nodos.getDatosExcepcion(this.data.detalle)
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
					this.ready = true;
				});
			},
			validateForm: function(){
				// Validacion del formulario
				if( !this.submitAction ){
					this.submitAction = true;
					this.errors = [];
					let fields = [];

					// Validaciones personalizada
					Object.entries(this.fields).forEach(([key, content]) => {
						if( !this.$methods.checkNullEmpty(content.value) ){
							fields.push( content.nombre );
						}
					});

					// No hay errores, se guardan los datos
					if( fields.length > 0 ){
						this.submit();
					}
					else{
						this.submitAction = false;
						this.errors.push('Completa al menos un campo para guardar.');
					}
				}
			},
			submit: function(){
				// Método para guardar los datos
				let data = { id_ed: this.data.detalle.id, fields: this.fields };

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

				if( (!this.$methods.checkNullEmpty(this.fields.tipo_envio.value) && 
					this.fields.tipo_envio.value === 'Enviado' && !this.$methods.checkNullEmpty(this.fields.chilexpress.value) &&
					!this.$methods.checkNullEmpty(this.fields.observaciones.value)) ||
					(!this.$methods.checkNullEmpty(this.fields.tipo_envio.value) && 
					this.fields.tipo_envio.value === 'Retirado' &&
					!this.$methods.checkNullEmpty(this.fields.observaciones.value)) ||
					this.fields.tipo_envio.value === 'Documentos en oficina central' &&
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
				this.$nodos.terminarExcepcion({ excepcion: this.data.detalle, nodo: this.data.nodo }, () => {
					// Callback al terminar la actividad
					window.location.replace( this.route('excepcion', this.data.detalle.id_excepcion) );
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
			this.permiso = this.data.can_edit;
			this.getAlmacen();
		}
	}
</script>