<template>
	<div>
		<div class="content-block">
			<mdai-box title="Detalles" class="mb-32">
				<template slot="content">
					<div class="row total mini align-items-end">
						<div class="col-6 col-sm-2">
							<div class="input-cont">
								<label class="label">Vulnerable</label>
								<p class="fw-semibold">{{ porcentaje_vulnerables }}%</p>
							</div>
						</div>
						<div class="col-6 col-sm-2">
							<div class="input-cont">
								<label class="label">Total promesas</label>
								<p class="fw-semibold">{{ porcentaje_promesas }}%</p>
							</div>
						</div>
						<div class="col-6 col-sm">
							<div class="input-cont">
								<label class="label">PIS 1</label>
								<p class="fw-semibold">{{ etapa.pis_v_1 }} / {{ etapa.pis_t_1 }}</p>
							</div>
						</div>
						<div class="col-6 col-sm">
							<div class="input-cont">
								<label class="label">PIS 2</label>
								<p class="fw-semibold">{{ etapa.pis_v_2 }} / {{ etapa.pis_t_2 }}</p>
							</div>
						</div>
						<div class="col-6 col-sm">
							<div class="input-cont">
								<label class="label">PIS 3</label>
								<p class="fw-semibold">{{ etapa.pis_v_3 }} / {{ etapa.pis_t_3 }}</p>
							</div>
						</div>
						<div class="col-6 col-sm">
							<div class="input-cont">
								<label class="label">PIS 4</label>
								<p class="fw-semibold">{{ etapa.pis_v_4 }} / {{ etapa.pis_t_4 }}</p>
							</div>
						</div>
						<div class="col-6 col-sm">
							<div class="input-cont">
								<label class="label">PIS 5</label>
								<p class="fw-semibold">{{ etapa.pis_v_5 }} / {{ etapa.pis_t_5 }}</p>
							</div>
						</div>
					</div>
				</template>
			</mdai-box>

			<h3 class="heading-3">Promesas</h3>
			<p>{{ $methods.showTotal(promesas.length, 'promesa', 'promesas') }}</p>

			<mdai-table class="mt-16" :head="tableHead" :body="promesas">
				<template slot-scope="{item}">
					<td>{{ item.rut_cliente | rut }}</td>
					<td>{{ item.primer_nombre | capitalize }}</td>
					<td>{{ item.apellido_paterno | capitalize }}</td>
					<td>{{ item.marca }}</td>
					<td><span class="fa fa-check" v-if="item.marca !== 'Privado' && item.pis_1 == 1"></span></td>
					<td><span class="fa fa-check" v-if="item.marca !== 'Privado' && item.pis_2 == 1"></span></td>
					<td><span class="fa fa-check" v-if="item.marca !== 'Privado' && item.pis_3 == 1"></span></td>
					<td><span class="fa fa-check" v-if="item.marca !== 'Privado' && item.pis_4 == 1"></span></td>
					<td><span class="fa fa-check" v-if="item.marca !== 'Privado' && item.pis_5 == 1"></span></td>
					<td>
						<div class="row-actions">
							<a :href="route('detalle-promesa', item.opp)">
								<mdai-tooltip text="Ver detalles" position="top">
									<span class="fa fa-eye"></span>
								</mdai-tooltip>
							</a>
							<a v-if="item.marca !== 'Privado' && porcentaje_promesas" href="#" class="text-link" @click.prevent="openModal(item)">
								<mdai-tooltip text="Modificar PIS" v-if="porcentaje_promesas >= etapa.pis_t_1 && porcentaje_vulnerables >= etapa.pis_v_1" position="top">
									<span class="fa fa-percent"></span>
								</mdai-tooltip>
							</a>
						</div>
					</td>
				</template>
			</mdai-table>

			<mdai-lightbox v-model="modalExcepcion" title="Modificar PIS">
				<form @submit.prevent="validateForm">
					<div class="row total align-items-center">
						<div class="col-2">
							<div class="input-cont checkbox">
								<label class="label">PIS 1</label>
								<label>
									<input type="checkbox" class="fill-control-input" v-model="fields.pis_1" />
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description"></span>
								</label>
							</div>
						</div>
						<div class="col-2">
							<div class="input-cont checkbox">
								<label class="label">PIS 2</label>
								<label>
									<input type="checkbox" class="fill-control-input" v-model="fields.pis_2" />
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description"></span>
								</label>
							</div>
						</div>
						<div class="col-2">
							<div class="input-cont checkbox">
								<label class="label">PIS 3</label>
								<label>
									<input type="checkbox" class="fill-control-input" v-model="fields.pis_3" />
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description"></span>
								</label>
							</div>
						</div>
						<div class="col-2">
							<div class="input-cont checkbox">
								<label class="label">PIS 4</label>
								<label>
									<input type="checkbox" class="fill-control-input" v-model="fields.pis_4" />
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description"></span>
								</label>
							</div>
						</div>
						<div class="col-2">
							<div class="input-cont checkbox">
								<label class="label">PIS 5</label>
								<label>
									<input type="checkbox" class="fill-control-input" v-model="fields.pis_5" />
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description"></span>
								</label>
							</div>
						</div>
					</div>
					<div class="btn-holder">
						<div class="row total align-items-center">
							<div class="col-6">
								<a href="#" class="text-link" @click.prevent="closeModal">Cancelar</a>
							</div>
							<div class="col-6 text-right">
								<mdai-btn-action
									class="btn btn-primary btn-action"
									text="Agregar"
									v-model="submitAction"
									@action="validateForm"
								></mdai-btn-action>
							</div>
						</div>
					</div>
				</form>
			</mdai-lightbox>
		</div>
	</div>
</template>

<script>
export default {
	data: function() {
		return {
			tableHead: ['RUT', 'Nombre', 'Apellido', 'Tipo', 'PIS 1', 'PIS 2', 'PIS 3', 'PIS 4', 'PIS 5', 'Acciones'],
			submitAction: null,
			modalExcepcion: false,
			fields: {},
			pis_1: false,
			pis_2: false,
			pis_3: false,
			pis_4: false,
			pis_5: false,
			submitAction: false,
			promesaunit: null,
			porcentaje_promesas: null,
			porcentaje_vulnerables: null
		};
	},
	props: {
		promesas: { type: Array, required: true },
		proyecto: { type: Object, required: true },
		etapa: { type: Object, required: true }
	},
	created: function() {
		console.log(this.promesas);
		this.porcentajePis(this.promesas);
	},
	methods: {
		porcentajePis: function(){
			let cantidad_promesas = this.promesas.length;
			let promesas_vulnerables = [];
			// let vulnerablesConfiguracionPis = this.etapa.total_vulnerables;
			// let NumeroPromesasVulnerables;
			let cantidadvulnerablesporcentajeLocal;

			this.promesas.forEach((promesa, index) => {
				if( promesa.marca === "Vulnerable" ){
					promesas_vulnerables[index] = promesa;
				}
			});

			// promesas_vulnerables.forEach(function(promesa, index){
			// 	NumeroPromesasVulnerables++;	
			// });
			 
			if( this.etapa.total_unidades !== null ){
				cantidadvulnerablesporcentajeLocal = Math.trunc((promesas_vulnerables.length*100) / this.etapa.total_vulnerables);
				this.porcentaje_promesas = Math.trunc((cantidad_promesas * 100) / this.etapa.total_unidades);
				this.porcentaje_vulnerables = cantidadvulnerablesporcentajeLocal;
			}
		},
		openModal: function(value) {
			this.promesaunit = value;
			this.getDetalles(value);
			this.modalExcepcion = true;
		},
		closeModal: function() {
			this.modalExcepcion = false;
		},
		validateForm: function() {
			// Validacion del formulario
			if( !this.submitAction ){
				this.submitAction = true;
				this.errors = [];

				if (this.$methods.checkNullEmpty()) {
					//this.errors.push('Las observaciones son requeridas.');
				}

				// No hay errores, se guardan los datos
				if( this.errors.length === 0 ){
					this.guardarPis(this.promesaunit);
				}
				else {
					this.submitAction = false;
				}
			}
		},
		guardarPis: function(promesa) {
			this.$http.post("/guardar-pis/" + promesa.opp, {
				pis_1: this.fields.pis_1,
				pis_2: this.fields.pis_2,
				pis_3: this.fields.pis_3,
				pis_4: this.fields.pis_4,
				pis_5: this.fields.pis_5
			})
			.then(response => {
				if (response) {
					this.submitAction = false;
					this.promesaunit.pis_1 = response.data.pis_1;
					this.promesaunit.pis_2 = response.data.pis_2;
					this.promesaunit.pis_3 = response.data.pis_3;
					this.promesaunit.pis_4 = response.data.pis_4;
					this.promesaunit.pis_5 = response.data.pis_5;
					this.getDetalles(this.promesaunit);
				}
			});

			this.closeModal();
		},
		getDetalles: function(promesa){
			Object.entries(promesa).forEach(([key, value]) => {
				if( value !== 0 ){
					this.$set(this.fields, key, value);
				}
			});

			this.closeModal();
		},
		// actualizarDatos: function() {
		// 	this.fields.pis_1 = " ";
		// }
	}
};
</script>