<template>
	<div class="checklist-page" v-cloak>
		<form @submit.prevent="validateForm" v-if="fields && checks && ready">
			<div class="content-block mt-32">
				<h3 class="heading-5 mb-16">Checklist</h3>

				<mdai-table class="checklist-table" :head="checklistHead" :body="checks">
					<template slot-scope="{item}">
						<td width="40px">{{ item.num_pregunta }}</td>
						<td>{{ item.encabezado_pregunta }}</td>
						<td v-if="salida"><mark class="salida" v-if="getSalida(item)">{{ getSalida(item) }}</mark></td>
						<td class="text-center">
							<div class="input-cont checklists">
								<div class="radio">
									<input :name="'check-' + item.id" :id="'checkon-' + item.id" type="radio" value="1" v-model="checklist['check-' + item.id].titular" @change="disableTermino(item.id, $event)" :disabled="terminado || !permiso || item.excepcion" />
									<label :for="'checkon-' + item.id">Sí</label>
								</div>
								<div class="radio">
									<input :name="'check-' + item.id" :id="'checkoff-' + item.id" type="radio" value="0" v-model="checklist['check-' + item.id].titular" @change="disableTermino(item.id, $event)" :disabled="terminado || !permiso || item.excepcion" />
									<label :for="'checkoff-' + item.id">No</label>
								</div>
								<div class="radio">
									<input :name="'check-' + item.id" :id="'checkna-' + item.id" type="radio" value="2" v-model="checklist['check-' + item.id].titular" @change="disableTermino(item.id, $event)" :disabled="terminado || !permiso || item.excepcion" />
									<label :for="'checkna-' + item.id">N/A</label>
								</div>
							</div>
						</td>
						<td class="text-center" v-if="data.promesa.marca !== 'Vulnerable' && !finanzas">
							<div class="input-cont checklists">
								<div class="radio">
									<input :name="'codeudoron-' + item.id" :id="'codeudoron-' + item.id" type="radio" value="1" v-model="checklist['check-' + item.id].codeudor" :disabled="terminado || !permiso" />
									<label :for="'codeudoron-' + item.id">Sí</label>
								</div>
								<div class="radio">
									<input :name="'codeudoron-' + item.id" :id="'codeudoroff-' + item.id" type="radio" value="0" v-model="checklist['check-' + item.id].codeudor" :disabled="terminado || !permiso" />
									<label :for="'codeudoroff-' + item.id">No</label>
								</div>
								<div class="radio">
									<input :name="'codeudoron-' + item.id" :id="'codeudorna-' + item.id" type="radio" value="2" v-model="checklist['check-' + item.id].codeudor" :disabled="terminado || !permiso" />
									<label :for="'codeudorna-' + item.id">N/A</label>
								</div>
							</div>
						</td>
						<td v-if="!finanzas">
							<span v-if="item.excepcion === null && terminado">-</span>
							<a href="#" class="text-link" @click.prevent="openExcepcion(item.id)" v-else-if="permiso && item.excepcion === null">
								Solicitar
								<span class="fa fa-chevron-right ml-5"></span>
							</a>
							<a :href="route('excepcion', item.excepcion.id)" class="text-link" v-else-if="item.excepcion">
								Ver detalles
								<span class="fa fa-chevron-right ml-5"></span>
							</a>
						</td>
						<td v-if="!finanzas">
							<div v-if="item.respuesta.subsanado">
								<div v-if="item.respuesta.subsanado != 'Sí.' " class="input-cont select mr-10">
									<label class="label">Subsanado</label>
									<div class="cont">
										<select :disabled="terminado" v-model="excepcion.usuario" required @change="cambiaEstado($event, item)">
											<option selected>{{ item.respuesta.subsanado }}</option>
											<option value="Sí">Sí.</option>
										</select>
										<span class="fa fa-chevron-down input-icon"></span>
									</div>
								</div>
								<div v-else>
									{{ item.respuesta.subsanado }}
								</div>
							</div>
							<div v-if="!item.respuesta.subsanado">
								-
							</div>
						</td>
						<td v-if="!finanzas">
							<span v-if="item.respuesta.subsanado">
								{{ item.respuesta.autoriza.nombres }}
								{{ item.respuesta.autoriza.apellidos }}
							</span>
							<span v-else> - </span>
						</td>
					</template>
				</mdai-table>
			</div>

			<mdai-box title="Información adicional" class="content-block mt-32">
				<template slot="content">
					<div class="row total mini">
						<div class="col-4" v-for="(input, index) in inputs" :key="index">
							<mdai-input :label="input.encabezado_pregunta" :type="input.tipo" :name="'input-' + input.id" v-model="checklist['input-' + input.id].valor" :readonly="terminado" :class="{active: input.tipo === 'date'}" />
						</div>
						<div class="w-100"></div>
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
								<a :href="route('detalle-promesa', data.promesa.opp)" class="text-link">
									<span class="fa fa-chevron-left mr-4"></span>
									Volver atrás
								</a>
							</div>
							<div class="col-6">
								<div class="text-right">
									<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="validateForm" v-show="permiso"></mdai-btn-action>

									<button type="button" @click.prevent="modalTerminar = true" v-if="checklistReady && !terminado" class="btn btn-primary" v-show="permiso">
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

		<mdai-lightbox v-model="modalTerminar" title="Comision OK">
			<p>¿Está seguro que desea marcar esta comision como OK?</p>

			<div class="btn-holder">
				<div class="row total align-items-center">
					<div class="col-12 col-sm-6">
						<a href="#" class="text-link" @click.prevent="modalTerminar = false">Cancelar</a>
					</div>
					<div class="col-12 col-sm-6 text-right">
						<mdai-btn-action class="btn-primary btn-action" text="Terminar" v-model="action" @action="terminarActividad"
						/>
					</div>
				</div>
			</div>
		</mdai-lightbox>

		<mdai-lightbox v-model="modalExcepcion" title="Excepción de documento" :close="false">
			<form @submit.prevent="crearExcepcion" v-if="!excepcionTerminada">
				<div class="row total align-items-center">
					<div class="col-12">
						<div class="input-cont select">
							<label class="label">Solicitar a</label>
							<div class="cont">
								<select :disabled="terminado" v-model="excepcion.usuario" required>
									<option selected disabled>Seleccione</option>
									<option v-for="(user, index) in data.excepcionadores" :key="index" :value="user.id">
										{{ user.nombres }} {{ user.apellidos }}
									</option>
								</select>
								<span class="fa fa-chevron-down input-icon"></span>
							</div>
						</div>
		  			</div>
					<div class="col-12">
						<div class="input-cont">
							<label class="label">Observaciones</label>
							<div class="cont">
								<input type="text" name="observaciones" maxlength="70" required v-model="excepcion.observaciones"/>
							</div>
						</div>
					</div>
				</div>
				<div class="btn-holder">
					<div class="row total align-items-center">
						<div class="col-12 col-sm-6">
							<a href="#" class="text-link" @click.prevent="closeExcepcion">Cancelar</a>
						</div>
						<div class="col-12 col-sm-6 text-right">
							<mdai-btn-action class="btn-primary btn-action" text="Solicitar" v-model="excepcionStatus" @action="crearExcepcion" />
						</div>
					</div>
				</div>
			</form>

			<div v-else-if="excepcionSuccess">
				<div class="text-center my-30">
					<span class="fa fa-check f-30 text-success"></span>
					<h3 class="heading-5 mt-15">Excepción solicitada correctamente</h3>
					<p>Se le informará al usuario sobre el requerimiento.</p>
				</div>

				<div class="btn-holder">
					<div class="row total align-items-center">
						<div class="col-12 col-sm-6">
							<a href="#" class="text-link" @click.prevent="closeExcepcion">Cerrar</a>
						</div>
						<div class="col-12 col-sm-6 text-right">
							<a :href="excepcionUrl" class="btn btn-primary btn-action">Ver detalles</a>
						</div>
					</div>
				</div>
			</div>

			<div v-else-if="!excepcionSuccess">
				<div class="text-center my-30">
					<span class="fa fa-times f-30 text-error"></span>
					<h3 class="heading-5 mt-15">Ocurrió un problema</h3>
					<p>Vuelve a intentarlo nuevamente.</p>
				</div>

				<div class="btn-holder">
					<div class="row total align-items-center justify-content-center">
						<div class="col-6 text-center">
							<a href="#" class="btn btn-primary btn-action" @click.prevent="closeExcepcion">Aceptar</a>
						</div>
					</div>
				</div>
			</div>
		</mdai-lightbox>
  	</div>
</template>

<script>
export default {
	data: function () {
		return {
			permiso: false,
			modalTerminar: false,
			excepcion: {
				pregunta: null,
				usuario: null,
				observaciones: null,
			},
			excepcionUrl: null,
			excepcionTerminada: false,
			excepcionSuccess: null,
			modalExcepcion: false,
			inputs: [],
			checks: [],
			salida: false,
			dataFields: [1],
			fields: null,
			checklist: {},
			errors: [],
			checklistReady: false,
			action: false,
			submitAction: false,
			ready: false,
			excepcionStatus: false
		};
	},
	props: {
		data: { type: [Object], required: true },
	},
	computed: {
		checklistHead: function(){
			let checkFinanzas = this.finanzas ? 'Validación de montos' : 'Títular';
			let basicHead = ['Nº', 'Documentos'];

			// Agregamos un item vacio si es de salida
			if( this.salida ) basicHead.push('');
			basicHead.push({id: checkFinanzas, class: 'text-center'});
			if( this.data.promesa.marca !== 'Vulnerable' && !this.finanzas ) basicHead.push({id: 'Coudeudor', class: 'text-center'});

			if( !this.finanzas ){
				// No es un checklist de finanzas
				basicHead.push('Excepción', 'Subsanado', 'Autorizado por');
			}

			return basicHead;
		},
		finanzas: function () {
			// Verifica si es un check de finanzas, muestra solo ciertos campos
			return (
				this.data.nodo.nodo.num_nodo === 370 ||
				this.data.nodo.nodo.num_nodo === 460 ||
				this.data.nodo.nodo.num_nodo === 251
			);
		},
		terminado: function () {
			return false;
		}
	},
	methods: {
		cambiaEstado: function(event, check){
			if( event.target.value === "Sí" ){
				let editar = confirm("Está seguro de que desea cambiar el estado a Sí?");

				if( editar ){
					this.$nodos.cambiarEstadoPregunta({
						"check": check,
						"valor": event.target.value
					})
					.then( reponse => {
						setTimeout(()=>{
							location.reload();
						}, 5000);
					});
				}
			}
		},
		getAlmacen: function () {
			// Obtenemos los campos requeridos
			this.$nodos.getAlmacen(this.dataFields, (response) => {
				this.fields = response;
				this.getDetalles();
			});
		},
		getSalida: function(check){
			if( check.configuracion === "salida" ){
				// Muestra un dato
				let marca = check.marca_campo;
				let campos,
					result,
					finalValue,
					values = [];

				if( marca.startsWith("SUMA=") || marca.startsWith("RESTA=") || marca.startsWith("DIV=") || marca.startsWith("POR=") ){
					// Tiene una operación matemática
					let marca_split = marca.split("=");
					let operacion = marca_split[0];

					campos = marca_split[1].split(",");
					campos.forEach(attr => {
						let column = this.data.promesa[attr];
						values.push(column ? column : 0);
					});

					if (values.length) {
						if (operacion === "SUMA") {
							// Sumamos los valores finales
							finalValue = values.reduce((acc, val) => {
								return acc + val;
							});
						}
						else if (operacion === "RESTA") {
							// restamos los valores finales
							finalValue = values.reduce((acc, val) => {
								return acc - val;
							});
						}
						else if (operacion === "POR") {
							// sacamos el porcentaje
							if (values[1] === 0) {
								finalValue = 0;
							}
							else {
								finalValue = ((values[0] / values[1]) * 100).toFixed(2);
							}
						}
						else if (operacion === "DIV") {
							// dividimos los valores finales
							finalValue = values.reduce((acc, val) => {
								return acc / val;
							});
						}
					}
				}
				else {
					// Normal
					finalValue = this.data.promesa[marca];
				}

				let checkCampo = finalValue === 0 ? "0" : finalValue;
				if (checkCampo !== null && checkCampo !== undefined) {
					return checkCampo;
				} else {
					return false;
				}
			}
		},
		updatePregunta: function (id_pregunta, excepcion) {
			this.checks.forEach(item => {
				if (item.id === id_pregunta) {
					item.excepcion = excepcion;
					item.respuesta.titular = null;
					item.codeudor.titular = null;
				}
			});
		},
		openExcepcion: function(value){
			this.excepcion.pregunta = value;
			this.modalExcepcion = true;
		},
		closeExcepcion: function () {
			this.modalExcepcion = false;
			this.excepcionTerminada = false;
			this.excepcionSuccess = null;
		},
		crearExcepcion: function () {
			if( this.excepcion.usuario && this.excepcion.observaciones ){
				this.excepcionStatus = true;

				this.$nodos.crearExcepcion({
					id_pregunta: this.excepcion.pregunta,
					id_nd: this.data.nodo.id,
					id_usuario: this.excepcion.usuario,
					observaciones: this.excepcion.observaciones,
				})
				.then(response => {
					var response = response.data;

					setTimeout(() => {
						this.excepcionStatus = false;
						this.excepcionTerminada = true;

						if (response.status) {
							this.excepcionUrl = response.route;
							this.excepcionSuccess = true;
							this.updatePregunta(this.excepcion.pregunta, response.excepcion);
						}
						else {
							this.excepcionSuccess = false;
						}
					}, 500);
				});
			}
		},
		disableTermino: function (id, event) {
			this.checklistReady = false;
			this.checklist["check-" + id].active = event.target.value === "1" ? true : false;
		},
		checkTerminado: function () {
			let ready = true;

			Object.entries(this.checklist).forEach(([key, value]) => {
				if (value.type === "check") {
					// Validamos los checks
					if( !value.excepcion ){
						if ( value.titular === "0" || this.$methods.checkNullEmpty(value.titular)) {
							ready = false;
						}
					}
				}
				else {
					// es un input
					if( this.$methods.checkNullEmpty(value.valor) ){
						ready = false;
					}
				}
			});

			this.checklistReady = ready;
		},
		getDetalles: function(){
			// Buscamos en la base de datos los campos guardados
			this.$nodos.getDetalles(this.data.nodo)
			.then(response => {
				var response = response.data;
				var detalles = response.detalles;

				if (detalles) {
					// Hay campos guardados
					detalles.forEach(item => {
						// Recorremos los datos
						if (!this.$methods.checkNullEmpty(item.valor)) {
							// Pasamos el valor del campo guardado al objeto
							this.fields[item.almacen.slug].value = item.valor;
						}
					});

					// Verificamos si podemos terminar
					this.checkTerminado();
				}
				this.ready = true;
			});

			this.filtrarChecklist();
		},
		validateForm: function () {
			// Validacion del formulario
			if( !this.submitAction ){
				this.submitAction = true;
				this.errors = [];

				if( this.$methods.checkNullEmpty(this.fields.observaciones.value) ){
					this.errors.push("Las observaciones son requeridas.");
				}

				// No hay errores, se guardan los datos
				if (this.errors.length === 0) {
					this.submit();
				}
				else {
					this.submitAction = false;
				}
			}
		},
		filtrarChecklist: function () {
			if( this.data.checklist ){
				this.data.checklist.preguntas.forEach(item => {
					let nombre, type;
					let respuestas = item.respuesta && item.respuesta !== null;

					if( item.configuracion === "entrada" ){
						nombre = "input-";
						type = "input";
						this.inputs.push(item);
					}
					else {
						this.salida = true;
						nombre = "check-";
						type = "check";
						this.checks.push(item);
					}

					this.checklist[nombre + item.id] = {
						id_preg: item.id,
						id_dw: this.data.nodo.id_dw,
						valor: respuestas ? item.respuesta.valor : null,
						codeudor: respuestas ? item.respuesta.codeudor : null,
						excepcion: respuestas ? item.respuesta.excepcion : null,
						subsanado: respuestas ? item.respuesta.subsanado : null,
						autoriza_id: respuestas ? item.respuesta.autoriza_id : null,
						titular: respuestas ? item.respuesta.titular : null,
						active: respuestas && item.respuesta.titular === "1" ? true : false,
						type: type,
					};
				});

				this.checkTerminado();
			}
		},
		terminarActividad: function () {
			// Método para terminar la actividad
			this.action = true;
			this.$nodos.terminarComision({
				nodo: this.data.nodo.nodo.num_nodo,
				opp: this.data.promesa.opp,
				estado: "OK",
			}, () => {
				// Callback al terminar la actividad
				window.location.replace(this.route("buscar-comision"));
			})
			.finally(() => {
				setTimeout(() => {
					this.action = false;
				}, 1000);
			});
		},
		submit: function () {
			let data = {
				id_nd: this.data.nodo.id,
				checklist: this.checklist,
				fields: this.fields,
			};

			this.$nodos.saveRespuestas(data, () => {
				// Callback al guardar detalles
				setTimeout(() => {
					this.checkTerminado();
				}, 1000);
			})
			.finally(() => {
				this.submitAction = false;
			});
		},
	},
	created: function () {
		this.permiso = this.data.can_edit;
		this.getAlmacen();
	},
};
</script>

<style lang="scss" scoped>
.checklist-table{
	table{
		thead{
			tr{
				th{
					padding-left: 12px !important;
					padding-right: 12px !important;

					&:nth-child(4){
						text-align: center;
					}
				}
			}
		}
		tbody{
			tr{
				td{
					padding: 8px 12px !important;
					&:nth-child(2){
						width: 40%;
					}
				}
			}
		}
	}

	.salida{
		display: block;
		padding: 6px;
		border-radius: 6px;
		background: #a3acb8;
		text-align: center;
		color: #fff;
	}
	.input-cont{
		&.checklists{
			min-height: auto;

			.radio{
				margin-right: 12px;
			}
		}
	}
}
</style>
