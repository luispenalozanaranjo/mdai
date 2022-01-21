<template>
	<div v-cloak>
		<div class="content-block" v-if="ready">
			<mdai-box :title="data.nodo.nodo.subactividad">
				<template slot="content">
					<mdai-errors-show :errors="errors"></mdai-errors-show>

					<div class="row total mini align-items-center">
						<div class="col-3">
							<div class="input-cont checkbox">
								<label>
									<input
										type="checkbox"
										class="fill-control-input"
										v-model="fields.contactar_cliente.value"
										:disabled="terminado || !permiso"
										@change.prevent="disableTermino"
									/>
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description" v-text="fields.contactar_cliente.nombre"></span>
								</label>
							</div>
						</div>
						<div class="col-3">
							<div class="input-cont checkbox">
								<label>
									<input
										type="checkbox"
										class="fill-control-input"
										v-model="fields.notificacion_constructura.value"
										:disabled="terminado || !permiso"
										@change.prevent="disableTermino"
									/>
									<span class="fill-control-indicator"></span>
									<span
										class="fill-control-description"
										v-text="fields.notificacion_constructura.nombre"
									></span>
								</label>
							</div>
						</div>
						<div class="col-3">
							<div class="input-cont checkbox">
								<label>
									<input
										type="checkbox"
										class="fill-control-input"
										v-model="fields.entrega_acta.value"
										:disabled="terminado || !permiso"
										@change.prevent="disableTermino"
									/>
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description" v-text="fields.entrega_acta.nombre"></span>
								</label>
							</div>
						</div>
						<div class="col-3">
							<mdai-select :label="fields.entrega_unidad.nombre" v-model="fields.entrega_unidad.value" :disabled="terminado || !permiso" @change.prevent="disableTermino" :data="['Entrega sin observaciones', 'Entregada con reparos', 'Disconforme']" />
						</div>
					</div>

					<ul class="mt-16">
						<li>
							<div class="row total mini align-items-center">
								<div class="col-3">
									<div class="input-cont checkbox">
										<label>
											<input
												type="checkbox"
												class="fill-control-input"
												v-model="fields.medidor_agua.value"
												:disabled="terminado || !permiso"
											/>
											<span class="fill-control-indicator"></span>
											<span class="fill-control-description">{{ fields.medidor_agua.nombre }}</span>
										</label>
									</div>
								</div>
								<div class="col-9">
									<mdai-input label="Observaciones" v-model="fields.medidor_agua.observaciones" :readonly="terminado || !permiso" />
								</div>
							</div>
						</li>

						<li>
							<div class="row total mini align-items-center">
								<div class="col-3">
									<div class="input-cont checkbox">
										<label>
											<input
												type="checkbox"
												class="fill-control-input"
												v-model="fields.medidor_electrico.value"
												:disabled="terminado || !permiso"
											/>
											<span class="fill-control-indicator"></span>
											<span class="fill-control-description">{{fields.medidor_electrico.nombre}}</span>
										</label>
									</div>
								</div>
								<div class="col-9">
									<mdai-input label="Observaciones" v-model="fields.medidor_electrico.observaciones" :readonly="terminado || !permiso" />
								</div>
							</div>
						</li>
						<li>
							<div class="row total mini align-items-center">
								<div class="col-3">
									<div class="input-cont checkbox">
										<label>
											<input
												type="checkbox"
												class="fill-control-input"
												v-model="fields.medidor_gas.value"
												:disabled="terminado || !permiso"
											/>
											<span class="fill-control-indicator"></span>
											<span
												class="fill-control-description"
											>{{fields.medidor_gas.nombre}} (Opcional)</span>
										</label>
									</div>
								</div>
								<div class="col-9">
									<mdai-input label="Observaciones" v-model="fields.medidor_gas.observaciones" :readonly="terminado || !permiso" />
								</div>
							</div>
						</li>
					</ul>

					<div class="input-cont mt-16">
						<label class="label">Observaciones</label>
						<div class="cont">
							<textarea name="observaciones" v-model="fields.observaciones.value" :readonly="terminado || !permiso" required></textarea>
						</div>
					</div>
				</template>
				<template slot="action">
					<div class="btn-holder">
						<div class="row total mini align-items-center">
							<div class="col-6">
								<a :href="route('entrega-unidad', data.promesa.opp)" class="text-link">
									<span class="fa fa-chevron-left mr-5"></span>
									Volver atrás
								</a>
							</div>
							<div class="col-6">
								<div class="text-right">
									<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="validateForm" v-show="permiso" />

									<button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" class="btn btn-primary" v-show="permiso">Terminar</button>

									<p class="f-12" v-if="terminado">
										<span class="fw-bold">
											{{ data.nodo.terminado.nombres }} {{ data.nodo.terminado.apellidos }}</span> terminó esta actividad el <span class="fw-bold">{{ data.nodo.salida_format }}
										</span>.
									</p>
								</div>
							</div>
						</div>
					</div>
				</template>
			</mdai-box>

			<mdai-lightbox v-model="modalTerminar" title="Terminar actividad">
				<p>¿Está seguro que desea terminar la actividad?</p>

				<div class="btn-holder">
					<div class="row total align-items-center">
						<div class="col-6">
							<a href="#" class="text-link" @click.prevent="modalTerminar = false">Cancelar</a>
						</div>
						<div class="col-6 text-right">
							<mdai-btn-action class="btn-primary btn-action" text="Terminar actividad" v-model="action" @action="terminarActividad" />
						</div>
					</div>
				</div>
			</mdai-lightbox>
		</div>
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
			dataFields: [1, 38, 39, 40, 149, 208, 209, 210],
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
	},
	methods: {
		getAlmacen: function () {
			// Obtenemos los campos requeridos
			this.$nodos.getAlmacen(this.dataFields, response => {
				this.fields = response;
				console.log('fields =>', this.fields);
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
			if( !this.submitAction ){
				this.submitAction = true;
				this.errors = [];
				let fields = [];

				// Validaciones personalizada
				Object.entries(this.fields).forEach(([key, content]) => {
					if( !this.$methods.checkNullEmpty(content.value) ){
						fields.push(content.nombre);
					}
				});

				// No hay errores, se guardan los datos
				if( fields.length > 0 ){
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

			this.$nodos.saveDetalles(data, response => {
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
					if (key == "medidor_gas") {
						console.log("el key es", key);
					} else {
						incomplete.push(content.nombre);
					}
				}

				if (
					content.slug !== "observaciones" &&
					content.slug != "medidor_gas" &&
					content.slug != "contactar_cliente" &&
					content.slug != "entrega_acta" &&
					content.slug != "entrega_unidad" &&
					content.slug != "notificacion_constructura"
				) {
					if (
						this.$methods.checkNullEmpty(content.observaciones) ||
						!content.observaciones
					) {
						incomplete.push(content.nombre);
					}
				}
			});

			if (incomplete.length === 0) {
				this.terminar = true;
			} else {
				this.terminar = false;
			}
		},
		disableTermino: function () {
			this.terminar = false;
		},
		terminarActividad: function () {
			// Método para terminar la actividad
			this.action = true;
			this.$nodos
				.terminarActividad(
					{ nodo: this.data.nodo, marca: this.data.promesa.marca },
					() => {
						// Callback al terminar la actividad
						window.location.replace(
							this.route("entrega-unidad", this.data.promesa.opp)
						);
					}
				)
				.finally(() => {
					setTimeout(() => {
						this.action = false;
					}, 1000);
				});
		},
	},
	created: function () {
		this.permiso = this.data.can_edit;
		this.getAlmacen();
	},
};
</script>