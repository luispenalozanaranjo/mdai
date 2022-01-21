<template>
	<div v-cloak>
		<div class="content-block" v-if="ready && representantes.length">
			<form @submit.prevent="submit">
				<mdai-box :title="data.nodo.nodo.subactividad">
					<template slot="content">
						<mdai-errors-show :errors="errors"></mdai-errors-show>

						<ul>
							<li>
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.firma_cliente.value" :disabled="terminado || !permiso"/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Firma cliente</span>
											</label> 
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.firma_cliente.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							
							<li v-if="fields.firma_cliente.value && !fields.instruccion_notarial_pago_egreso_CBR.value">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox ml-30">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.Instruccion_notarial_pago_en_notaria.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">{{fields.Instruccion_notarial_pago_en_notaria.nombre}} (Opcional)</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.Instruccion_notarial_pago_en_notaria.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							
							<li v-if="fields.firma_cliente.value && !fields.Instruccion_notarial_pago_en_notaria.value">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox ml-30">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.instruccion_notarial_pago_egreso_CBR.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">{{fields.instruccion_notarial_pago_egreso_CBR.nombre}} (Opcional)</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.instruccion_notarial_pago_egreso_CBR.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>

							<li>
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.representante1.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Representante 1</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.representante1.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li>
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.representante2.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Representante 2</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.representante2.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.firma_revision_abogado.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Firma revisión abogado banco alzante</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.firma_revision_abogado.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox ">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.firma_apoderado.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Firma apoderado banco alzante</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.firma_apoderado.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox ">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.envio_copia_fiscalia_banco.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Envío copia fiscalia a banco alzante</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.envio_copia_fiscalia_banco.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox ">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.firma_banco_alzante.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Firma banco alzante</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.firma_banco_alzante.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.tipo_credito =='Gestión Propia'|| data.promesa.tipo_credito =='Gestión MDAI'">
								<div class="row total mini align-items-center">
									<div class="col-6">
										<div class="input-cont checkbox ">
											<label>
												<input type="checkbox" class="fill-control-input" v-model="fields.firma_banco_cliente.value" :disabled="terminado || !permiso" />
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Firma banco cliente</span>
											</label>
										</div>
									</div>
									<div class="col-4">
										<mdai-input label="Observaciones" v-model="fields.firma_banco_cliente.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
						</ul>

						<div class="input-cont mt-32">
							<label class="label">Observaciones</label>
							<div class="cont">
								<textarea
									name="observaciones"
									v-model="fields.observaciones.value"
									:readonly="terminado || !permiso"
									required
								></textarea>
							</div>
						</div>
					</template>
					<template slot="action">
						<div class="btn-holder">
							<div class="row total mini align-items-center">
								<div class="order-1 order-sm-0 col-12 col-sm-6">
									<a :href="route('detalle-promesa', data.promesa.opp)" class="text-link">
										<span class="fa fa-chevron-left mr-4"></span>
										Volver atrás
									</a>
								</div>
								<div class="order-0 order-sm-1 col-12 col-sm-6">
									<div class="d-flex justify-content-sm-end flex-wrap">
										<div class="btn-holder d-flex justify-content-between justify-content-sm-end">
											<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="validateForm" v-show="permiso"></mdai-btn-action>

											<button type="button" :class="{disabled: !terminarEnable}" @click.prevent="openTerminar" class="btn btn-primary" v-if="permiso && !terminado">
												Terminar
											</button>
										</div>

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
						<a href="#" class="text-link" @click.prevent="modalTerminar = false">Cancelar</a>
					</div>
					<div class="col-6 text-right">
						<mdai-btn-action
							class="btn-primary btn-action"
							text="Terminar actividad"
							v-model="action"
							@action="terminarActividad"
						></mdai-btn-action>
					</div>
				</div>
			</div>
		</mdai-lightbox>
	</div>
</template>

<script>
export default {
	props: {
		data: { type: [Object], required: true },
	},
	data: function () {
		return {
			permiso: false,
			ready: false,
			terminar: false,
			modalTerminar: false,
			dataFields: [1, 24, 25, 187, 211,212],
			fields: null,
			errors: [],
			action: false,
			submitAction: false,
			representantes: [],
			valorFirma: null,
		};
	},
	computed: {
		terminado: function () {
			return this.data.nodo.estado === 13 ? true : false;
		},
		terminarEnable: function(){
			// Verificamos que se pueda terminar el nodo
			return (this.terminar && !this.terminado);
		},
	},
	methods: {
		openTerminar: function(){
			// Abrimos la modal para terminar
			if( this.terminarEnable ) this.modalTerminar = true;
		},
		getAlmacen: function () {
			// Obtenemos los campos requeridos
			this.$nodos.getAlmacen(this.dataFields, (response) => {
				this.fields = response;
				this.getDetalles();

				this.$nodos.getDatos({
					fields: [24, 25],
					opp: this.data.promesa.opp,
					num_nodo: [270, 271],
				})
				.then((response) => {
					var response = response.data;
					this.representantes = response;
					console.log(this.representantes);
				});
			});
		},
		getDetalles: function () {
			// Buscamos en la base de datos los campos guardados
			this.$nodos.getDetalles(this.data.nodo).then((response) => {
				var response = response.data;
				var detalles = response.detalles;

				if (detalles) {
					// Hay campos guardados
					detalles.forEach((item, index) => {
						// Recorremos los datos
						if (!this.$methods.checkNullEmpty(item.valor) && item.valor != 0) {
							// Pasamos el valor del campo guardado al objeto
							this.fields[item.almacen.slug].value = item.valor;
						}
						if (!this.$methods.checkNullEmpty(item.observaciones)) {
							// Pasamos el valor del campo guardado al objeto
							this.fields[item.almacen.slug].observaciones = item.observaciones;
						}
					});

					// Verificamos si podemos terminar
					this.checkTermino();
				}

				this.ready = true;
			});
		},
		validateForm: function () {
			// Validacion del formulario
			if (!this.submitAction) {
				this.submitAction = true;
				this.errors = [];
				let fields = [];

				// Validaciones personalizada
				Object.entries(this.fields).forEach(([key, content]) => {
					if (!this.$methods.checkNullEmpty(content.value)) {
						fields.push(content.nombre);
					}
				});

				// No hay errores, se guardan los datos
				if (fields.length > 0) {
					this.submit();
				} else {
					this.submitAction = false;
					this.errors.push("Completa al menos un campo para guardar.");
				}
			}
		},
		submit: function () {
			// Método para guardar los datos
			let data = {
				id_dw: this.data.nodo.id_dw,
				id_nd: this.data.nodo.id,
				fields: this.fields,
			};

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
		checkTermino: function () {
			// Checkea si todo está correcto para terminar
			let incomplete = [];

			Object.entries(this.fields).forEach(([key, content]) => {
				if( this.$methods.checkNullEmpty(content.value) || !content.value ){
					if (key == "instruccion_notarial_pago_egreso_CBR" || key == "Instruccion_notarial_pago_en_notaria") {
					} else {
						incomplete.push(content.nombre);
					}
				}

				if( content.slug == "firma_cliente" ){
					this.valorFirma = content.value;
				}

				if( content.slug !== "observaciones" &&  content.slug !== "instruccion_notarial_pago_egreso_CBR" && content.slug != "Instruccion_notarial_pago_en_notaria" ){
					if( this.$methods.checkNullEmpty(content.observaciones) || !content.observaciones ){
						incomplete.push(content.nombre);
					}
				}
			});

			if( this.valorFirma == 1 && !this.fields.instruccion_notarial_pago_egreso_CBR.value  && this.data.nodo.estado != 13 ){
				this.enviaNotificacion();
			}
			else if( this.valorFirma == 1 && this.fields.instruccion_notarial_pago_egreso_CBR.value  && this.data.nodo.estado != 13 ){
				this.enviaNotificacion();
			}

			this.terminar = (incomplete.length === 0);
		},
		terminarActividad: function () {
			// Método para terminar la actividad
			this.action = true;
			this.$nodos.terminarActividad({ nodo: this.data.nodo, marca: this.data.promesa.marca }, () => {
				// Callback al terminar la actividad
				window.location.replace(
					this.route("detalle-promesa", this.data.promesa.opp)
				);
			})
			.finally(() => {
				setTimeout(() => {
					this.action = false;
				}, 1000);
			});
		},
		enviaNotificacion: function () {
			let valor;
			let id_check;

			Object.entries(this.fields).forEach(([key, content]) => {
				if( content.slug == "firma_cliente" ){
					valor = content.value;
					id_check = content.id;
				}
			});

			if (valor) {
				if( this.fields.instruccion_notarial_pago_egreso_CBR.value ){
					this.$nodos.notificacionNotaria({
						nodo: this.data.nodo,
						marca: this.data.promesa.marca,
						valor: valor,
						id_check: id_check,
						estado: "Pendiente"
					});
				}
				else{
					this.$nodos.notificacionNotaria({
						nodo: this.data.nodo,
						marca: this.data.promesa.marca,
						valor: valor,
						id_check: id_check,
					});
				}
			 
			}
		},
	},
	created: function () {
		if( this.data.promesa.marca == "Vulnerable" ){
			this.dataFields.push(27, 29);
		}
		else {
			this.dataFields.push(188, 189);

			if( this.data.promesa.tipo_credito !== "Contado" ){
				this.dataFields.push(190);
			}
		}
		this.permiso = this.data.can_edit;
		this.getAlmacen();
	},
};
</script>