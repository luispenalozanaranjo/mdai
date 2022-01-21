<template>
	<div v-cloak>
		<div class="content-block" v-if="fields">
			<form @submit.prevent="validateForm">
				<mdai-box :title="data.nodo.nodo.subactividad">
					<template slot="content">
						<mdai-errors-show :errors="errors"></mdai-errors-show>
						<mdai-errors-show :errors="errors2"></mdai-errors-show>
						<div class="row total align-items-center">
							<div class="col-4">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="fields.seleccion_nueva_unidad.value" :disabled="terminado || !permiso" @change="disableTermino">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-text="fields.seleccion_nueva_unidad.nombre"></span>
									</label>
								</div>
							</div>
							<div class="col-4">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="fields.generar_nueva_cotizacion.value" :disabled="terminado || !permiso" @change="disableTermino">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-text="fields.generar_nueva_cotizacion.nombre"></span>
									</label>
								</div>
							</div>
							<div class="col-4">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input"  v-model="fields.solicitar_pre_aprobacion_bancaria.value" :disabled="terminado || !permiso" @change="disableTermino">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-text="fields.solicitar_pre_aprobacion_bancaria.nombre"></span>
									</label>
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

										<button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" v-show="permiso" class="btn btn-primary">
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
						<mdai-btn-action class="btn btn-primary btn-action" text="Terminar actividad" v-model="action" @action="terminarActividad"></mdai-btn-action>
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
				permiso: false,
				terminar: false,
				modalTerminar: false,
				dataFields: [1, 44, 45,46],
				fields: null,
				errors: [],
				errors2: [],
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
					this.errors2 =[];

					// Validaciones personalizada
					if(this.$methods.checkNullEmpty(this.fields.seleccion_nueva_unidad.value) || this.$methods.checkNullEmpty(this.fields.generar_nueva_cotizacion.value) 
					|| this.$methods.checkNullEmpty(this.fields.solicitar_pre_aprobacion_bancaria.value)){
						this.errors2.push('Para terminar la actividad debe marcar todas las casillas')
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
				if( !this.$methods.checkNullEmpty(this.fields.seleccion_nueva_unidad.value) && 
					this.fields.seleccion_nueva_unidad.value ==1 && !this.$methods.checkNullEmpty(this.fields.generar_nueva_cotizacion.value) &&
					this.fields.generar_nueva_cotizacion.value == 1 && !this.$methods.checkNullEmpty(this.fields.observaciones.value)
					&& this.fields.solicitar_pre_aprobacion_bancaria.value == 1 && !this.$methods.checkNullEmpty(this.fields.solicitar_pre_aprobacion_bancaria.value)){
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
			this.getAlmacen();
			this.permiso = this.data.can_edit;
		}
	}
</script>