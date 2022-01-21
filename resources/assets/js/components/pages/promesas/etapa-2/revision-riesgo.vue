<template>
	<div v-cloak>
		<form class="content-block" @submit.prevent="validateForm" v-if="fields && entidades && ready">
			<mdai-box :title="data.nodo.nodo.subactividad">
				<template slot="content">
					<mdai-errors-show :errors="errors"></mdai-errors-show>

					<div class="row total align-items-center">
						<div class="col-12" v-for="n in 6" :key="n">
							<div class="row total">
								<div class="col-4">
									<div class="input-cont select">
										<label class="label">Entidad {{n}}</label>
										<div class="cont">
											<select :disabled="terminado || !permiso" v-model="fields['entidad_' + n].value" @change.prevent="disableTermino">
												<option selected disabled>Seleccione</option>
												<option v-for="(entidad, index) in entidades" v-bind:key="index" :value="entidad.id">
													{{ entidad.nombre }}
												</option>
											</select>
											<span class="fa fa-chevron-down input-icon"></span>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="input-cont">
										<div class="cont">
											<label class="label">Fecha de envío</label>
											<input type="date" v-model="fields['entidad_' + n + '_fecha'].value" :disabled="terminado || !permiso">
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="input-cont select">
										<label class="label">Seleccione</label>
										<div class="cont">
											<select :disabled="terminado || !permiso" v-model="fields['entidad_' + n + '_estado'].value" @change.prevent="disableTermino">
												<option value="aprobada">Aprobada</option>
												<option value="rechazada">Rechazada</option>
												<option value="devuelta">Devuelta</option>
												<option value="en_evaluacion">En evaluación</option>
												<option value="no_aplica">N/A</option>
											</select>
											<span class="fa fa-chevron-down input-icon"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="my-30">
						<div class="row total">
							<div class="col">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="fields.credito_aprobado.value" :disabled="terminado || !permiso">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-text="fields.credito_aprobado.nombre"></span>
									</label>
								</div>
							</div>
							<div class="col">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="fields.en_formalizacion_credito.value" :disabled="terminado || !permiso">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-text="fields.en_formalizacion_credito.nombre"></span>
									</label>
								</div>
							</div>
							<div class="col">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="fields.set_credito_firmado.value" :disabled="terminado || !permiso">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-text="fields.set_credito_firmado.nombre"></span>
									</label>
								</div>
							</div>
							<div class="col">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="fields.cliente_listo_escriturar.value" :disabled="terminado || !permiso">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-text="fields.cliente_listo_escriturar.nombre"></span>
									</label>
								</div>
							</div>
							<div class="col">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="fields.pre_ode.value" :disabled="terminado || !permiso">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-text="fields.pre_ode.nombre"></span>
									</label>
								</div>
							</div>
						</div>
					</div>

					<div class="row total">
								<div class="col-4">
									<div class="input-cont select">
										<label class="label">Entidad Formalizadora</label>
										<div class="cont">
											<select :disabled="terminado || !permiso" v-model="fields.entidad_formalizadora.value" @change.prevent="disableTermino">
												<option selected disabled>Seleccione</option>
												<option v-for="(entidad, index) in entidades" v-bind:key="index" :value="entidad.id">
													{{ entidad.nombre }}
												</option>
											</select>
											<span class="fa fa-chevron-down input-icon"></span>
										</div>
									</div>
								</div>

					<div class="col-4">
                    <div class="input-cont">
					<label class="label">Monto aprobado</label>
                      <div class="cont">
                        <input
                          type="text"
                          v-model="fields.monto_aprobado.value"
                          :readonly="terminado || !permiso"
                        />
                      </div>
                    </div>
                  </div>
					</div>

					<div class="row total">
						<div class="col-12">
							<div class="input-cont">
								<label class="label">Observaciones</label>
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
								<a :href="route('detalle-promesa', data.promesa.opp)" class="text-link">
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
										<span class="fw-bold">{{ data.nodo.terminado.nombres }} {{ data.nodo.terminado.apellidos }}</span> terminó esta actividad el <span class="fw-bold">{{ data.nodo.salida_format }}</span>.
									</p>
								</div>
							</div>
						</div>
					</div>
				</template>
			</mdai-box>
		</form>

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
				dataFields: [1, 68, 69, 70, 71, 72, 73, 74, 75, 76, 168, 169, 170, 171, 172, 173, 174, 175, 176,177,178,179,180,181,214,215],
				fields: null,
				errors: [],
				action: false,
				submitAction: false,
				entidades: false
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
					this.getEntidades();
					
				});
			},
			getEntidades: function(){
				// Obtenemos las entidades financieras
				this.$http.get( route('entidades.get') )
				.then((response) => {
					var response = response.data;
					if( response ){
						this.entidades = response;
						
					}
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
						
						if( !this.$methods.checkNullEmpty(content.value)  ){

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
				let incomplete = [];
				let valores = [];

				Object.entries(this.fields).forEach(([key, content]) => {
					valores.push(content.value);

					if( this.$methods.checkNullEmpty(content.value) || !content.value ){
						if(!content.slug.startsWith('entidad')){	incomplete.push( content.nombre )};
						console.log(`ff ${incomplete}`);
					}
				});

				if( incomplete.length === 0 && valores.indexOf('aprobada') !== -1 ){
					this.terminar = true;
				}
				else{
					this.terminar = false;
				}
			},
			disableTermino: function(){
				this.terminar = false;
			},
			terminarActividad: function(){
				// Método para terminar la actividad
				this.action = true;
				this.$nodos.terminarActividad({nodo: this.data.nodo, marca: this.data.promesa.marca }, () => {
					// Callback al terminar la actividad
					window.location.replace( this.route('detalle-promesa', this.data.promesa.opp) );
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