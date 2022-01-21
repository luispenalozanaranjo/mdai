<template>
	<div v-cloak>
		<div class="content-block" v-if="ready">
			<mdai-resumen-cliente :info="promesa"></mdai-resumen-cliente>

			<mdai-box title="Subsidio" class="content-block">
				<template slot="content">
					<div class="row total mini">
						<div class="col-6">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Valor final venta" v-model="promesa.precio_unidad_principal" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar valor final venta" v-model="fields.valor_venta.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase text-center f-12" :class="valor_valido.class">
											<span class="mr-4" :class="valor_valido.icon"></span>
											{{ valor_valido.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Subsidio" v-model="promesa.subsidio" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar subsidio" v-model="fields.subsidio.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="subsidio_valido.class">
											<span class="mr-4" :class="subsidio_valido.icon"></span>
											{{ subsidio_valido.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="row total mini align-items-center">
								<div class="col-12 col-sm-4">
									<mdai-input label="Crédito enlace" v-model="fields.credito_enlace.value" :number="true" :disabled="terminado || !permiso" />
								</div>
							</div>
						</div>
						<div class="w-100 hr hr-col hr-total my-16"></div>
						<div class="col-12">
							<p class="text-uppercase f-small">
								Total subsidio
								<span class="d-block f-large fw-bold">{{ total_subsidio }}</span>
							</p>
						</div>
					</div>
				</template>
			</mdai-box>

			<mdai-box title="Bono" class="content-block">
				<template slot="content">
					<div class="row total mini">
						<div class="col-6">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Bono captación" v-model="promesa['bono_captación']" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar bono captación" v-model="fields.bono_captacion.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_captacion.class">
											<span class="mr-4" :class="validar_captacion.icon"></span>
											{{ validar_captacion.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Bono integración" v-model="promesa['bono_integración']" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar bono integración" v-model="fields.bono_integracion.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_integracion.class">
											<span class="mr-4" :class="validar_integracion.icon"></span>
											{{ validar_integracion.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 hr hr-col hr-total my-16"></div>
						<div class="col-12">
							<p class="text-uppercase f-small">
								Total bonos
								<span class="d-block f-large fw-bold">{{ total_bono }}</span>
							</p>
						</div>
					</div>
				</template>
			</mdai-box>

			<mdai-box title="Cupones" class="content-block">
				<template slot="content">
					<div class="row total mini">
						<div class="col-6" v-if="promesa.cupon_unidad_principal !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Cupón unidad principal" v-model="promesa.cupon_unidad_principal" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Cupón unidad principal" v-model="fields.cupon_unidad_principal.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_cupon_principal.class">
											<span class="mr-4" :class="validar_cupon_principal.icon"></span>
											{{ validar_cupon_principal.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6" v-if="promesa.cupon_estacionamiento !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Cupón estacionamiento" v-model="promesa.cupon_estacionamiento" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Cupón estacionamiento" v-model="fields.cupon_estacionamiento.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_cupon_estacionamiento.class">
											<span class="mr-4" :class="validar_cupon_estacionamiento.icon"></span>
											{{ validar_cupon_estacionamiento.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6" v-if="promesa.cupon_bodega !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Cupón bodega" v-model="promesa.cupon_bodega" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Cupón bodega" v-model="fields.cupon_bodega.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_cupon_bodega.class">
											<span class="mr-4" :class="validar_cupon_bodega.icon"></span>
											{{ validar_cupon_bodega.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6" v-if="promesa.cupon_ahorro_previo !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Cupón ahorro previo" v-model="promesa.cupon_ahorro_previo" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Cupón ahorro previo" v-model="fields.cupon_ahorro_previo.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_cupon_ahorro.class">
											<span class="mr-4" :class="validar_cupon_ahorro.icon"></span>
											{{ validar_cupon_ahorro.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6" v-if="promesa.cupon_pago_contra_escritura !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Cupón pago contra escritura" v-model="promesa.cupon_pago_contra_escritura" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Cupón pago contra escritura" v-model="fields.cupon_pago_contra_escritura.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_cupon_pago.class">
											<span class="mr-4" :class="validar_cupon_pago.icon"></span>
											{{ validar_cupon_pago.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 hr hr-col hr-total my-16"></div>
						<div class="col-12">
							<p class="text-uppercase f-small">
								Total cupones
								<span class="d-block f-large fw-bold">{{total_cupones }}</span>
							</p>
						</div>
					</div>
				</template>
			</mdai-box>

			<mdai-box title="Otro valores" class="content-block">
				<template slot="content">
					<div class="row total mini">
						<div class="col-6" v-if="promesa.ahorro !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Ahorro" v-model="promesa.ahorro" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Ahorro" v-model="fields.ahorro.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_ahorro.class">
											<span class="mr-4" :class="validar_ahorro.icon"></span>
											{{ validar_ahorro.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6" v-if="promesa.escritura_pagada !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Pago contra escritura" v-model="promesa.escritura_pagada" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Pago contra escritura" v-model="fields.escritura_pagada.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_escritura.class">
											<span class="mr-4" :class="validar_escritura.icon"></span>
											{{ validar_escritura.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6" v-if="promesa.pago_contra_promesa !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Pago contra promesa" v-model="promesa.pago_contra_promesa" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Pago contra promesa" v-model="fields.pago_contra_promesa.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_pago.class">
											<span class="mr-4" :class="validar_pago.icon"></span>
											{{ validar_pago.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6" v-if="promesa.chip !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Crédito hipotecario" v-model="promesa.chip" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Crédito hipotecario" v-model="fields.chip.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_chip.class">
											<span class="mr-4" :class="validar_chip.icon"></span>
											{{ validar_chip.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6" v-if="promesa.pie !== null">
							<div class="input-compare">
								<div class="row total mini align-items-center">
									<div class="col-5">
										<mdai-input label="Pie" v-model="promesa.pie" :disabled="true" />
									</div>
									<div class="col-5">
										<mdai-input label="Validar Pie" v-model="fields.pie.value" :number="true" :disabled="terminado || !permiso" />
									</div>
									<div class="col-2">
										<p class="text-uppercase f-12 text-center" :class="validar_pie.class">
											<span class="mr-4" :class="validar_pie.icon"></span>
											{{ validar_pie.text }}
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 hr hr-col hr-total my-16"></div>
						<div class="col-12">
							<p class="text-uppercase f-small">
								Valor final
								<span class="d-block f-large fw-bold">{{ valor_final }}</span>
							</p>
						</div>
					</div>
				</template>
			</mdai-box>

			<mdai-box title="Otros" class="content-block">
				<template slot="content">
					<div class="row align-items-center total mini">
						<div class="col-12 col-sm-4">
							<mdai-input label="Monto pagado a MDA comprador" :number="true" :disabled="terminado || !permiso" />
						</div>
						<div class="col-12 col-sm-4">
							<mdai-input label="Monto pagado Crédito Hipotecario" :number="true" :disabled="terminado || !permiso" />
						</div>
						<div class="col-12 col-sm-4">
							<mdai-input label="Monto pagado entidad alzante" :number="true" :disabled="terminado || !permiso" />
						</div>
						<div class="col-12 col-sm-4">
							<mdai-input label="Diferencia por pagar banco alzante" :number="true" :disabled="terminado || !permiso" />
						</div>
						<div class="col-12 col-sm-4">
							<mdai-input label="Saldo a favor de MDA" :number="true" :disabled="terminado || !permiso" />
						</div>
						<div class="col-12">
							<div class="input-cont">
								<label class="label">Observaciones</label>
								<textarea v-model="fields.observaciones.value" :readonly="terminado || !permiso"></textarea>
							</div>
						</div>
					</div>
				</template>
				<template slot="action">
					<div class="btn-holder text-right">
						<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="save" v-show="permiso"></mdai-btn-action>

						<button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" class="btn btn-primary" v-show="permiso">
							Terminar
						</button>

						<p class="f-12" v-if="terminado">
							<span class="fw-bold">{{ nodo.terminado.nombres }} {{ nodo.terminado.apellidos }}</span> terminó esta actividad el <span class="fw-bold">{{ nodo.salida_format }}</span>.
						</p>
					</div>
				</template>
			</mdai-box>
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
		entidades: { type: Array, required: true },
		nodo: { type: Object, required: true },
		promesa: { type: Object, required: true },
		permiso: { type: Boolean, required: true },
	},
	data: function() {
		return {
			submitAction: false,
			ready: false,
			action: false,
			terminar: false,
			modalTerminar: false,
			dataFields: [1, 153, 154, 155, 156, 157, 158, 159, 160, 161, 162, 163, 164, 165, 166, 167],
			fields: {},
			validos: {
				valid: {
					icon: 'fa fa-check',
					class: 'text-success',
					text: 'Validado',
					status: true
				},
				invalid: {
					icon: 'fa fa-times',
					class: 'text-error',
					text: 'No validado',
					status: false
				}
			}
		};
	},
	computed: {
		valor_valido: function(){
			return this.esIgual(this.fields.valor_venta.value, this.promesa.precio_unidad_principal);
		},
		subsidio_valido: function(){
			return this.esIgual(this.fields.subsidio.value, this.promesa.subsidio);
		},
		validar_captacion: function(){
			return this.esIgual(this.fields.bono_captacion.value, this.promesa['bono_captación']);
		},
		validar_integracion: function(){
			return this.esIgual(this.fields.bono_integracion.value, this.promesa['bono_integración']);
		},
		validar_cupon_principal: function(){
			return this.esIgual(this.fields.cupon_unidad_principal.value, this.promesa.cupon_unidad_principal);
		},
		validar_cupon_estacionamiento: function(){
			return this.esIgual(this.fields.cupon_estacionamiento.value, this.promesa.cupon_estacionamiento);
		},
		validar_cupon_bodega: function(){
			return this.esIgual(this.fields.cupon_bodega.value, this.promesa.cupon_bodega);
		},
		validar_cupon_ahorro: function(){
			return this.esIgual(this.fields.cupon_ahorro_previo.value, this.promesa.cupon_ahorro_previo);
		},
		validar_cupon_pago: function(){
			return this.esIgual(this.fields.cupon_pago_contra_escritura.value, this.promesa.cupon_pago_contra_escritura);
		},
		validar_ahorro: function(){
			return this.esIgual(this.fields.ahorro.value, this.promesa.ahorro);
		},
		validar_escritura: function(){
			return this.esIgual(this.fields.escritura_pagada.value, this.promesa.escritura_pagada);
		},
		validar_pago: function(){
			return this.esIgual(this.fields.pago_contra_promesa.value, this.promesa.pago_contra_promesa);
		},
		validar_chip: function(){
			return this.esIgual(this.fields.chip.value, this.promesa.chip);
		},
		validar_pie: function(){
			return this.esIgual(this.fields.pie.value, this.promesa.pie);
		},
		total_subsidio: function(){
			return ( this.promesa.subsidio - this.fields.credito_enlace.value );
		},
		total_bono: function(){
			return ( this.promesa['bono_captación'] + this.promesa['bono_integración'] );
		},
		total_cupones: function(){
			return ( this.promesa.cupon_unidad_principal + this.promesa.cupon_estacionamiento + this.promesa.cupon_bodega + this.promesa.cupon_ahorro_previo + this.promesa.cupon_pago_contra_escritura );
		},
		valor_final: function(){
			return ( this.total_subsidio + this.total_bono + this.total_cupones );
		},
		terminado: function(){
			return this.nodo.estado === 13 ? true : false;
		}
	},
	methods: {
		esIgual: function(val1, val2){
			return ( parseInt(val1) === parseInt(val2) ) ? this.validos.valid : this.validos.invalid;
		},
		checkTermino: function(){
			// Checkea si todo está correcto para terminar
			let incomplete = [];

			Object.entries(this.fields).forEach(([key, content]) => {
				if( this.$methods.checkNullEmpty(content.value) || !content.value ){
					incomplete.push( content.nombre );
				}
			});

			if( incomplete.length === 0 ){
				this.terminar = true;
			}
			else{
				this.terminar = false;
			}
		},
		terminarActividad: function(){
			// Método para terminar la actividad
			this.action = true;
			this.$http({
				method: 'PUT',
				url: "/finanzas/terminar-nodo",
				data: { id_nodo: 99, id_dw: this.nodo.id_dw }
			})
			.then(response => {
				// Callback al terminar la actividad
				// window.location.replace( this.route('pago.operacion', {opp: this.promesa.opp}) );
				window.location.reload();
			});
		},
		getAlmacen: function(){
			this.$nodos.getAlmacen(this.dataFields, (response) => {
				this.fields = response;
				this.getDetalles();
			});
		},
		getDetalles: function(){
			// Buscamos en la base de datos los campos guardados
			this.$nodos.getDetalles({ id: this.nodo.id })
			.then(response => {
				var response = response.data;
				var detalles = response.detalles;

				if( detalles ){
					// Hay campos guardados
					detalles.forEach((item, index) => {
						// Recorremos los datos
						if( !this.$methods.checkNullEmpty(item.valor)){
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
		// obtenerDetalleWorkflow: function(){
		// 	// Obtenemos los campos requeridos
		// 	this.$http.get(`/detalle-workflow/finanzas/get/${this.promesa.opp}/pago`)
		// 	.then(response => {
		// 		this.id_dw = response.data.id_dw;
		// 		this.id_nd = response.data.id_nd;
		// 		this.getAlmacen();
		// 	});
		// },
		save: function(){
			this.submitAction = true;
			let data = { id_dw: this.nodo.id_dw, id_nd: this.nodo.id, fields: this.fields };
			this.$nodos.saveDetalles(data, (response) => {
				// Callback al guardar detalles
				setTimeout(() => {
					this.submitAction = false;
					this.checkTermino();
				}, 1000);
			});
		}
	},
	created: function() {
		// this.obtenerDetalleWorkflow();
		this.getAlmacen();
	}
}
</script>

<style lang="scss" scoped>
	.input-compare{
		padding: 8px;
		border: 1px solid #eee;
		border-radius: 8px;
		position: relative;
		overflow: hidden;
	}
</style>