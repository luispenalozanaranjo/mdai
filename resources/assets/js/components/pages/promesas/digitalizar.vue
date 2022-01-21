<template>
	<div v-cloak>
		<form class="content-block" @submit.prevent="validateForm" v-if="fields">
			<mdai-box :title="data.nodo.nodo.subactividad">
				<template slot="content">
					<mdai-errors-show :errors="errors"></mdai-errors-show>
					<div class="row total mini align-items-center">
						<div class="col-10 col-sm-4">
							<div class="file-cont">
								<input type="file" id="cargar-planilla" name="planilla" @change="onFileChange" accept="application/pdf" :disabled="terminado || !permiso">
								<label for="cargar-planilla" class="d-block p-16" :class="{load: file, disabled: terminado}">
									<div class="d-flex align-items-center justify-content-center">
										<div class="mr-32">
											<span class="fa fa-upload f-24 text-normal"></span>
										</div>
										<div class="text-cont">
											<p class="fw-semibold">
												{{ !terminado && !file ? 'Haz clic para buscar el archivo' : 'Archivo seleccionado' }}
											</p>
											<p>
												{{ file ? file.name : 'para subir el archivo al nodo.' }}
											</p>
										</div>
									</div>
								</label>
							</div>
						</div>
						<div class="col-2 col-sm-8">
							<div v-if="hasFile">
								<a :href="'/storage/' + hasFile.ruta" download class="text-link">
									<span class="fa fa-eye mr-4"></span> Ver archivo cargado
								</a>
							</div>
						</div>
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
				file: null,
				hasFile: false,
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
					case 120:
					case 126:
						return this.route('cambio-unidad', this.data.promesa.opp);
						break;
					case 151:
					case 159:
					case 162:
					case 165:
					case 167:
						return this.route('desistimiento', this.data.promesa.opp);
						break;
					case 591:
						return this.route('entrega-unidad', this.data.promesa.opp);
						break;
					default:
						return this.route('detalle-promesa', this.data.promesa.opp);
						break;
				}
			},
			terminado: function(){
				return ( this.data.nodo.estado === 13 ) ? true : false;
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
			onFileChange: function(e){
				this.file = e.target.files[0];
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
					var file = response.file;

					if( file ){
						// Tiene archivo
						this.hasFile = file;
					}

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
				});
			},
			upload: function(){
				let formData = new FormData();
					formData.append('file', this.file);
					formData.append('id_dw', this.data.nodo.id_dw);
					formData.append('id_nd', this.data.nodo.id);

				this.$nodos.digitalizar(formData)
				.then((response) => {
					this.$store.commit('toggleAction');
					
					if( response.data ){
						// Todo bien
						this.$store.commit('enableToast', { text: 'Cambios guardados correctamente' });
						this.hasFile = response.data;
						this.checkTermino();
					}
					else{
						this.$store.commit('enableToast', {
							text: 'Ocurrió un problema al intentar guardar los cambios',
							type: 'error'
						});
					}
				})
			},
			validateForm: function(){
				// Validacion del formulario
				if( !this.submitAction ){
					this.submitAction = true;
					this.errors = [];

					// Validaciones personalizadas
					if( this.$methods.checkNullEmpty(this.fields.observaciones.value) ){
						this.errors.push('Las observaciones son requeridas.');
					}
					if( this.$methods.checkNullEmpty(this.file) ){
						this.errors.push('Es necesario seleccionar un archivo.');
					}
					// No hay errores, se guardan los datos
					if( this.errors.length === 0 ){
						this.submit();
					}
					else{
						this.submitAction = false;
					}
				}
			},
			submit: function(){
				// Método para guardar los datos
				let data = { id_dw: this.data.nodo.id_dw, id_nd: this.data.nodo.id, fields: this.fields };

				this.$nodos.saveDetallesSimple(data)
				.then((response) => {
					if( response.data === true ){
						setTimeout(() => {
							this.upload();
						}, 500);
					}
					else{
						this.$store.commit('toggleAction');
						this.$store.commit('enableToast', {
							text: 'Ocurrió un problema al intentar guardar los cambios',
							type: 'error'
						});
					}
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
				this.$nodos.terminarActividad({nodo: this.data.nodo, marca: this.data.promesa.marca}, (response) => {
					// Callback al terminar la actividad
					window.location.replace(this.redirect);
				});
			}
		},
		created: function(){
			this.permiso = this.data.can_edit;
			this.getAlmacen();
		}
	}
</script>