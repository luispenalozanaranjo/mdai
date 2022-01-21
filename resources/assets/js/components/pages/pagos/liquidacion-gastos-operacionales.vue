<template>
<div v-cloak>
	<div class="content-block">
		<mdai-resumen-cliente :info="promesa"></mdai-resumen-cliente>
		
		<mdai-box class="mt-24" title="Liquidación de gastos operacionales" v-if="ready">
			<template slot="content">
				<div class="row total mini align-items-center">
					<div class="col-12 col-sm">
						<mdai-input label="Tasación" v-model="fields.tasacion.value" :readonly="terminado" :number="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Estudio de titulos" v-model="fields.titulos.value" :readonly="terminado" :number="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Gastos notariales" v-model="fields.notariales.value" :readonly="terminado" :number="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Escrituración" v-model="fields.escrituracion.value" :readonly="terminado" :number="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Conservador Bienes raices" v-model="fields.bienes_raices.value" :readonly="terminado" :number="true" />
					</div>
					<div class="w-100"></div>
					<div class="col-12 col-sm">
						<mdai-input label="Impuesto al credito" v-model="fields.impuesto_credito.value" :readonly="terminado" :number="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="IVA" v-model="fields.iva.value" :readonly="terminado" :number="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Gastos de administración" v-model="fields.administracion.value" :readonly="terminado" :number="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Seguros" v-model="fields.seguros.value" :readonly="terminado" :number="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Otros gastos varios" v-model="fields.gastos_varios.value" :readonly="terminado" :number="true" />
					</div>
					<div class="w-100 hr hr-total hr-col my-16"></div>
					<div class="col-12 col-sm">
						<mdai-input label="Diferencia por pagar" v-model="fields.diferencia_por_pagar.value" :readonly="terminado" />
					</div>
					<div class="col-12 col-sm">
						<mdai-select label="Entidad financiera" v-model="fields.entidades.value" :disabled="terminado" :data="entidades" val="nombre">
							<template v-slot:option="{item}">
								{{ item.nombre }}
							</template>
						</mdai-select>
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Gastos operacionales pactados UF" v-model="promesa.gops" :readonly="true" />
					</div>
					<div class="col-12 col-sm">
						<mdai-input label="Gastos operacionales pagados UF" v-model="promesa.gops_pagados" :readonly="true" />
					</div>
					<div class="col-12 col-sm d-flex justify-content-end">
						<p class="text-right">
							<span class="f-small d-block text-uppercase">Total gastos operacionales</span>
							<span class="f-large fw-bold">{{ total_gastos_op }}</span>
						</p>
					</div>
					<div class="w-100 hr hr-total hr-col my-16"></div>
					<div class="col-12">
						<div class="input-cont">
							<label class="label">Observaciones</label>
							<div class="cont">
								<textarea v-model="fields.observaciones.value" :readonly="terminado"></textarea>
							</div>
						</div>
					</div>
				</div>
			</template>
			<template slot="action">
				<div class="btn-holder text-right">
					<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="save" v-show="permiso" />

					<button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" class="btn btn-primary" v-show="permiso">Terminar</button>

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
			promesa: { type: Object, required: true },
			nodo: { type: Object, required: true },
			entidades: { type: Array, required: true },
			permiso: { type: Boolean, required: true }
		},
		data: function(){
			return {
				submitAction: false,
				terminar: false,
				modalTerminar: false,
				action: false,
				dataFields: [1, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94],
				fields: {
					tasacion: null,
					titulos: null,
					notariales: null,
					escrituracion: null,
					bienes_raices: null,
					impuesto_credito: null,
					iva: null,
					entidades: null,
					administracion: null,
					seguros: null,
					gastos_varios: null,
					diferencia_por_pagar: null,
					observaciones: null
				},
				ready: false
			};
		},
		computed: {
			terminado: function(){
				return ( this.nodo.estado === 13 ) ? true : false;
			},
			total_gastos_op: function(){
				// Sumamos todos los valores del array
				let tasacion = this.fields.tasacion.value || 0;
				let titulos = this.fields.titulos.value || 0;
				let notariales = this.fields.notariales.value || 0;
				let escrituracion = this.fields.escrituracion.value || 0;
				let bienes_raices = this.fields.bienes_raices.value || 0;
				let impuesto_credito = this.fields.impuesto_credito.value || 0;
				let iva = this.fields.iva.value || 0;
				let administracion = this.fields.administracion.value || 0;
				let seguros = this.fields.seguros.value || 0;
				let gastos_varios = this.fields.gastos_varios.value || 0;

				let valores = [tasacion, titulos, notariales, escrituracion, bienes_raices, impuesto_credito, iva, administracion, seguros, gastos_varios];

				let total = valores.reduce((a,b) => {
					return parseInt(a, 10) + parseInt(b, 10);
				}, 0);

				// let total = parseInt(this.fields.tasacion.value, 10) + parseInt(this.fields.titulos.value, 10) + parseInt(this.fields.notariales.value,10) + parseInt(this.fields.escrituracion.value,10) + parseInt(this.fields.bienes_raices.value,10) + parseInt(this.fields.impuesto_credito.value,10) + parseInt(this.fields.iva.value,10) + parseInt(this.fields.administracion.value,10) + parseInt(this.fields.seguros.value,10) + parseInt(this.fields.gastos_varios.value,10);

				return total > 0 ? total.toFixed(2) : 0;
			},
		},
		methods: {
			checkTermino: function(){
				// Checkea si todo está correcto para terminar
				if( (!this.$methods.checkNullEmpty(this.fields.tasacion.value) && !this.$methods.checkNullEmpty(this.fields.titulos.value)
				&& !this.$methods.checkNullEmpty(this.fields.notariales.value) && !this.$methods.checkNullEmpty(this.fields.escrituracion.value)
				&& !this.$methods.checkNullEmpty(this.fields.bienes_raices.value) && !this.$methods.checkNullEmpty(this.fields.impuesto_credito.value)
				&& !this.$methods.checkNullEmpty(this.fields.iva.value) && !this.$methods.checkNullEmpty(this.fields.entidades.value)
				&& !this.$methods.checkNullEmpty(this.fields.administracion.value) && !this.$methods.checkNullEmpty(this.fields.seguros.value)
				&& !this.$methods.checkNullEmpty(this.fields.gastos_varios.value) && !this.$methods.checkNullEmpty(this.fields.diferencia_por_pagar.value) && !this.$methods.checkNullEmpty(this.fields.observaciones.value))){
					this.terminar = true;
				}
				else{
					this.terminar = false;
				}
			},
			getAlmacen: function(){
				// Obtenemos los campos requeridos
				this.$nodos.getAlmacen(this.dataFields, (response) => {
					this.fields = response;
					this.getDetalles();
				});
			},
			getDetalles: function(){
				// Buscamos en la base de datos los campos guardados
				this.$nodos.getDetalles({id: this.nodo.id})
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

						this.checkTermino();
					}
					this.ready = true;
				});
			},
			// obtenerDetalleWorkflow: function(){
			// 	// Obtenemos los campos requeridos
			// 	this.$http.get("/detalle-workflow/finanzas/get/"+this.promesa.opp)
			// 	.then((response) => {
			// 		this.id_dw = response.data.id_dw;
			// 		this.id_nd = response.data.id_nd;
			// 		this.getAlmacen();
			// 	});
			// },
			save: function(){
				this.submitAction = true;

				let data = { id_dw: this.nodo.id_dw, id_nd: this.nodo.id, fields: this.fields };
 				this.$nodos.saveDetalles(data, response => {
					// Callback al guardar detalles
					setTimeout(() => {
						this.submitAction = false;
						this.checkTermino();
					}, 1000);
				});
			},
			terminarActividad: function(){
	  			// Método para terminar la actividad
				this.action = true;
				this.$http({
					method: "PUT",
					url: route("finanzas.terminar.nodo"),
					data: {id_nodo: this.nodo.id_nodo, id_dw: this.nodo.id_dw}
				})
				.then(response => {
		  			// Callback al terminar la actividad
					// window.location.replace( this.route('finanzas.liquidacion.busqueda', {opp: this.promesa.opp}) );
					window.location.reload();
				})
			}
		},
		created: function(){
			// this.obtenerDetalleWorkflow();
			this.getAlmacen();
		}
	}
</script>