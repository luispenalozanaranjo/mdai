<template>
	<div v-cloak>
		<form class="content-block" @submit.prevent="validateForm" v-if="fields">
			<mdai-box :title="data.nodo.nodo.subactividad">
				<template slot="content">
					<mdai-errors-show :errors="errors"></mdai-errors-show>
					<div class="row total mini align-items-center">

                    <div class="col-6">
							<div class="input-cont select">
								<label class="label">Autorizado firma representante 1</label>
								<div class="cont">
									<select v-model="fields.representante1.value" :disabled="terminado || !permiso">
										<option selected disabled>Seleccione</option>
										<option v-for="(representante, index) in representantes" v-bind:key="index">
											{{ representante }}
										</option>
									</select>
									<span class="fa fa-chevron-down input-icon"></span>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="input-cont select">
								<label class="label">Autorizado firma representante 2</label>
								<div class="cont">
									<select v-model="fields.representante2.value" :disabled="terminado || !permiso">
										<option selected disabled>Seleccione</option>
										<option v-for="(representante, index) in representantes" v-bind:key="index">
											{{ representante }}
										</option>
									</select>
									<span class="fa fa-chevron-down input-icon"></span>
								</div>
							</div>
						</div>
						
						<div class="col-4">
							<div class="file-cont">
								<input type="file" id="cargar-planilla" name="planilla" @change="onFileChange" accept="application/pdf" :disabled="terminado || !permiso">
								<label for="cargar-planilla" class="btn full" :class="inputClassController">
									<span class="fa mr-5" :class="( file || terminado ) ? 'fa-check' : 'fa-file'"></span>
									<span v-if="file">{{ file.name }}</span>
									<span v-else-if="terminado">Archivo cargado</span>
									<span v-else>Seleccionar archivo</span>
								</label>
							</div>
						</div>
						<div class="col-2">
							<div v-if="hasFile">
								<a :href="'/storage/' + hasFile.ruta" download class="text-link">
									<span class="fa fa-eye mr-5"></span> Ver archivo cargado
								</a>
							</div>
						</div><div class="col-12">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="fields.de_notificar_finanzas_devolucion.value" :disabled="terminado || !permiso">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description">Notificar a finanzas (Solo si hay devolución</span>
									</label>
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
							<div class="col-6">
								<a :href="route('detalle-promesa', data.promesa.opp)" class="text-link">
									<span class="fa fa-chevron-left mr-5"></span>
									Volver atrás
								</a>
							</div>
							<div class="col-6">
								<div class="text-right">
									<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" v-model="submitAction" @action="validateForm" v-show="permiso"></mdai-btn-action>

									<button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" class="btn btn-primary" v-show="permiso">
										Terminar
									</button>
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
			data: { type: Object, required: true },
			permiso: { type: Boolean, required: true }
		},
		data: function(){
			return {
				terminar: false,
				modalTerminar: false,
				file: null,
				hasFile: false,
				dataFields: [1, 24, 25, 59],
				fields: null,
				errors: [],
				action: false,
				submitAction: false,
                representantes: ['David Felipe Hirsh Vainstein', 'Maria Cecilia Dominguez Bastian'],
			};
		},
		computed: {
			terminado: function(){
				return ( this.data.nodo.estado === 13 ) ? true : false;
			},
			inputClassController: function(){
				return {
					'btn-success': this.file,
					'btn-secondary': !this.file && !this.terminado,
					'btn-disabled': this.terminado
				}
			}
		},
		methods: {
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

					if( detalles ){
						// Hay campos guardados
						detalles.forEach((item, index) => {
							// Recorremos los datos
							if( !this.$methods.checkNullEmpty(item.valor) && item.valor != 0 ){
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
					formData.append('id_nodo', this.data.nodo.id_nodo);
				this.$nodos.digitalizar(formData)
				.then((response) => {
					if( response.data ){
						// Todo bien
						this.hasFile = response.data;
						this.checkTermino();
					}
				});
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
						this.errors.push('Es necesario seleccionar un archivo');
					}
                    if( this.fields.representante1.value === 'Seleccione' ){
						this.errors.push('Seleccione Representante 1.');
					}
					if( this.fields.representante2.value === 'Seleccione' ){
						this.errors.push('Seleccione Representante 2.');
					}
					if( this.fields.representante1.value !== 'Seleccione' && this.fields.representante2.value !== 'Seleccione' && this.fields.representante1.value === this.fields.representante2.value){
						this.errors.push('No pueden ser los mismos representantes.');
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
                // Checkea si todo está correcto para terminar
				if( !this.$methods.checkNullEmpty(this.fields.de_notificar_finanzas_devolucion.value) && 
                    this.fields.representante1.value !== "Seleccione" &&
					this.fields.representante2.value !== "Seleccione" && 
					!this.$methods.checkNullEmpty(this.fields.observaciones.value) ){
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
					window.location.replace( this.route('detalle-promesa', this.data.promesa.opp) );
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
			this.getAlmacen();
		}
	}
</script>