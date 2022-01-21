<template>
	<div v-cloak>
		<div class="content-block" v-if="ready">
			<form @submit.prevent="validateForm">
				<mdai-box :title="data.nodo.nodo.subactividad">
					<template slot="content">
						<mdai-errors-show :errors="errors"></mdai-errors-show>
						<div class="row total mini align-items-end">
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
									<a :href="redirect" class="text-link">
										<span class="fa fa-chevron-left mr-5"></span>
										Volver atrás
									</a>
								</div>
								<div class="col-6">
									<div class="text-right">
										<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="validateForm" v-show="permiso"></mdai-btn-action>

										<button type="button" :class="{disabled: !terminarEnable}" @click.prevent="openTerminar" class="btn btn-primary" v-if="permiso && !terminado">
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
				ready: false,
				terminar: false,
				modalTerminar: false,
				dataFields: [1],
				fields: null,
				errors: [],
				action: false,
				submitAction: false
			};
		},
		computed: {
			redirect: function(){
				switch(this.data.nodo.nodo.num_nodo){
					case 123:
						return this.route('cambio-unidad', this.data.promesa.opp);
						break;
					case 156:
					case 157:
					case 158:
						return this.route('desistimiento', this.data.promesa.opp);
						break;
					default:
						return this.route('detalle-promesa', this.data.promesa.opp);
						break;
				}
			},
			terminarEnable: function(){
				// Verificamos que se pueda terminar el nodo
				return (this.terminar && !this.terminado);
			},
			terminado: function(){
				// El nodo está terminado
				return ( this.data.nodo.estado === 13 ) ? true : false;
			}
		},
		methods: {
			openTerminar: function(){
				// Abrimos la modal para terminar
				if( this.terminarEnable ) this.modalTerminar = true;
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
				this.$nodos.getDetalles(this.data.nodo)
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
						if( !this.$methods.checkNullEmpty(content.value) ){
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
				if( !this.$methods.checkNullEmpty(this.fields.observaciones.value) ){
					this.terminar = true;
				}else{
					this.terminar = false;
				}
			},
			terminarActividad: function(){
				// Método para terminar la actividad
				this.action = true;
				this.$nodos.terminarActividad({nodo: this.data.nodo, marca: this.data.promesa.marca}, () => {
					// Callback al terminar la actividad
					window.location.replace(this.redirect);
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