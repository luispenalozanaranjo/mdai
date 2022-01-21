<template>
	<div v-cloak>
		<div class="content-block" v-if="ready">
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
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.egreso_cbr_ok.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Egreso CBR OK</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.egreso_cbr_ok.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.entrega_escritura_mdai.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Entrega escritura MDA</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.entrega_escritura_mdai.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.presentacion_cobro_serviu.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Presentación de cobro Serviu</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.presentacion_cobro_serviu.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.pago_serviu.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Pago serviu</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.pago_serviu.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>

							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.carpeta_ahorro_completa.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Carpeta ahorro completa</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.carpeta_ahorro_completa.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.presentacion_cobro_ahorro.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Presentación de cobro ahorro</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.presentacion_cobro_ahorro.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>

							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.pago_ahorro.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Pago ahorro</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.pago_ahorro.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>

							<li v-if="data.promesa.marca =='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.entrega_escritura.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Entrega escritura cliente</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.entrega_escritura.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.copias_compraventa.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Copias compraventa OK</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.copias_compraventa.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.carpeta_serviu_completa.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Carpeta serviu completa</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.carpeta_serviu_completa.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.ingreso_serviu_ok.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Ingreso a serviu OK</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.ingreso_serviu_ok.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>

							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.pago_serviu_ok.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Pago serviu OK</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.pago_serviu_ok.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.carpeta_ahorro_completa.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Carpeta ahorro completa</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.carpeta_ahorro_completa.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>

							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.ingreso_ahorro_ok.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Ingreso a ahorro OK</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.ingreso_ahorro_ok.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>

							<li v-if="data.promesa.marca !== 'Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.pago_ahorro_ok.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Pago ahorro OK</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.pago_ahorro_ok.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>

							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.pago_chip_ok.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Pago CHIP OK</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.pago_chip_ok.observaciones" :readonly="terminado || !permiso"></mdai-input>
									</div>
								</div>
							</li>
							<li v-if="data.promesa.marca !='Vulnerable'">
								<div class="row total mini align-items-center">
									<div class="col-12 col-sm-4">
										<div class="input-cont checkbox">
											<label>
												<input
													type="checkbox"
													class="fill-control-input"
													v-model="fields.pago_vale_notaria_ok.value"
													:disabled="terminado || !permiso"
												/>
												<span class="fill-control-indicator"></span>
												<span class="fill-control-description">Pagos vale vista notaria OK</span>
											</label>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<mdai-input label="Observaciones" v-model="fields.pago_vale_notaria_ok.observaciones" :readonly="terminado || !permiso"></mdai-input>
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
			dataFields: [1, 193, 194],
			fields: null,
			errors: [],
			action: false,
			submitAction: false,
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
				}
				else {
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
				if (this.$methods.checkNullEmpty(content.value) || !content.value) {
					incomplete.push(content.nombre);
				}

				if( content.slug !== "observaciones" ){
					if( this.$methods.checkNullEmpty(content.observaciones) || !content.observaciones ){
						incomplete.push(content.nombre);
					}
				}
			});

			this.terminar = (incomplete.length === 0);
		},
		terminarActividad: function () {
			// Método para terminar la actividad
			this.action = true;

			this.$nodos.terminarActividad({ nodo: this.data.nodo, marca: this.data.promesa.marca }, () => {
				if (this.data.estado_notificacion == "Pendiente") {
					this.$nodos.notificacion580({
						nodo: this.data.nodo,
						marca: this.data.promesa.marca,
					})
					.then(response => {
						setTimeout(() => {
						}, 5000);
					});
				}
						
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
	},
	created: function () {
		if( this.data.promesa.marca === "Vulnerable" ){
			this.dataFields.push(35, 36, 195, 196, 197, 198);
		}
		else {
			this.dataFields.push(199, 200, 201, 202, 203, 204, 205, 206);
		}

		this.permiso = this.data.can_edit;
		this.getAlmacen();					
	},
};
</script>