<template>
	<div v-cloak>
		<div class="content-block">
			<form @submit.prevent="validateForm">
				<mdai-box :title="data.nodo.nodo.subactividad">
					<template slot="content">
						<mdai-errors-show :errors="errors"></mdai-errors-show>
						<div class="row total mini">
							<div class="col-6">
								<div class="input-cont checklists">
									<label class="label">Seleccione</label>
									<div class="radio">
										<input v-model="tipo_credito" id="contado" name="tipo" type="radio" :disabled="terminado || !permiso" value="Contado" @change.prevent="disableTermino">
										<label for="contado">Contado</label>
									</div>
									<div class="radio">
										<input v-model="tipo_credito" id="propia" name="tipo" type="radio" :disabled="terminado || !permiso" value="Gestión Propia" @change.prevent="disableTermino">
										<label for="propia">Gestión Propia</label>
									</div>
									<div class="radio">
										<input v-model="tipo_credito" id="mdai" name="tipo" type="radio" :disabled="terminado || !permiso" value="Gestión MDAI" @change.prevent="disableTermino">
										<label for="mdai">Gestión MDAI</label>
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
										<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="validateForm"></mdai-btn-action>

										<button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" class="btn btn-primary">
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
			data: { type: Object, required: true }
		},
		data: function(){
			return {
				permiso: false,
				terminar: false,
				modalTerminar: false,
				tipo_credito: null,
				errors: [],
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
			validateForm: function(){
				// Validacion del formulario
				if( !this.submitAction ){
					this.submitAction = true;
					this.errors = [];

					if( this.$methods.checkNullEmpty(this.tipo_credito) ){
						this.errors.push('Selecciona tipo de crédito.');
					}

					// No hay errores, se guardan los datos
					if( this.errors.length === 0 ){
						this.submit();
					}else{
						this.submitAction = false;
					}
				}
			},
			submit: function(){
				// Método para guardar los datos
				let data = { opp: this.data.promesa.opp, tipo_credito: this.tipo_credito };
				this.$store.commit('toggleAction', true);
				this.$store.commit('addActionText', 'Guardando cambios...');

				this.$http.post( route('tipo.credito', data) )
				.then((response) => {
					var response = response.data;
					if( response ){
						// Todo bien
						this.$store.commit('enableToast', {
							text: 'Cambios guardados correctamente'
						});
					}else{
						this.$store.commit('enableToast', {
							text: 'Ocurrió un problema al intentar guardar los cambios',
							type: 'error'
						});
					}
				})
				.catch((errors) => {
					console.log(errors);
					this.$store.commit('enableToast', {
						text: 'Ocurrió un problema al intentar guardar los cambios',
						type: 'error'
					});
				})
				.finally(() => {
					setTimeout(() => {
						this.$store.commit('toggleAction', false);
						this.submitAction = false;
						this.checkTermino();
					}, 100);
				});
			},
			disableTermino: function(){
				this.terminar = false;
			},
			checkTermino: function(){
				// Checkea si todo está correcto para terminar
				if( !this.$methods.checkNullEmpty(this.tipo_credito) ){
					this.terminar = true;
				}else{
					this.terminar = false;
				}
			},
			terminarActividad: function(){
				// Método para terminar la actividad
				this.action = true;
				this.$nodos.terminarActividad({
					nodo: this.data.nodo,
					marca: this.data.promesa.marca,
					tipo_credito: this.tipo_credito
				}, (response) => {
					// Callback al terminar la actividad
					window.location.replace( this.route('detalle-promesa', this.data.promesa.opp) );
				});
			}
		},
		created: function(){
			console.info('data =>', this.data);
			this.permiso = this.data.can_edit;

			if( !this.$methods.checkNullEmpty(this.data.promesa.tipo_credito) ){
				this.tipo_credito = this.data.promesa.tipo_credito;
				this.checkTermino();
			}
		}
	}
</script>