<template>
	<div v-cloak>
		<form class="content-block" @submit.prevent="validateForm" v-if="fields">
			<mdai-box :title="data.nodo.subactividad">
				<template slot="content">
					<mdai-errors-show :errors="errors"></mdai-errors-show>
					<div class="row total mini align-items-center">
						<div class="col-4">
							<div class="file-cont">
								<input type="file" id="cargar-planilla" name="planilla" @change="onFileChange" accept="application/pdf" :disabled="terminado">
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
						</div>
						<div class="col-12">
							<div class="input-cont">
								<label class="label" v-text="fields.observaciones.nombre"></label>
								<div class="cont">
									<textarea name="observaciones" v-model="fields.observaciones.value" :readonly="terminado"></textarea>
								</div>
							</div>
						</div>
					</div>
				</template>
				<template slot="action">
					<div class="btn-holder">
						<div class="row total mini align-items-center">
							<div class="col-6">
								<a :href="route('cambio-unidad', data.promesa.opp)" class="text-link">
									<span class="fa fa-chevron-left mr-5"></span>
									Volver atrás
								</a>
							</div>
							<div class="col-6">
								<div class="text-right">
									<button type="submit" v-if="!terminado" class="btn btn-secondary">
										Guardar
									</button>
									<button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" class="btn btn-primary">
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
						<mdai-btn-action class="btn-action" text="Terminar actividad" v-model="action" @action="terminarActividad"></mdai-btn-action>
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
				terminar: false,
				modalTerminar: false,
				file: null,
				hasFile: false,
				dataFields: [1],
				fields: null,
				errors: [],
				action: false
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
				console.log( e.target.files[0] );
				//this.readFile( e.target.files[0] );
				this.file = e.target.files[0];
			},
			getAlmacen: function(){
				// Obtenemos los campos requeridos
				this.$nodos.getAlmacen(this.dataFields, (response) => {
					this.fields = response;
				});
			},
			getDetalles: function(){
				// Buscamos en la base de datos los campos guardados
				this.$nodos.getDetalles({
					id_nodo: this.data.nodo.id_nodo,
					id_nodo_config: this.data.nodo.id_nodo_config
				})
				.then((response) => {
					var response = response.data;
					var detalles = response.detalles;
					var file = response.file;

					if( detalles ){
						// Hay campos guardados
						this.fields = detalles;
						this.hasFile = file;
						this.checkTermino();
					}
					else{
						// No hay campos guardados, creamos el objeto
						this.getAlmacen();
					}
				});
			},
			upload: function(){
				let _this = this;
				let formData = new FormData();
					formData.append('file', this.file);
					formData.append('id_dw', this.data.nodo.id_dw);
					formData.append('id_nodo', this.data.nodo.id_nodo);

				this.$nodos.digitalizar(formData)
				.then(function(response){
					if( response.data ){
						// Todo bien
						_this.hasFile = response.data;
						_this.checkTermino();
					}
				});
			},
			validateForm: function(){
				// Validacion del formulario
				this.errors = [];

				// Validaciones personalizadas
				if( this.$methods.checkNullEmpty(this.fields.observaciones.value) ){
					this.errors.push('Las observaciones son requeridas.');
				}
				if( this.$methods.checkNullEmpty(this.file) ){
					this.errors.push('Es necesario seleccionar un archivo');
				}

				// No hay errores, se guardan los datos
				if( this.errors.length === 0 ){
					this.submit();
				}
			},
			submit: function(){
				// Método para guardar los datos
				let data = { id_dw: this.data.nodo.id_dw, id_nodo: this.data.nodo.id_nodo, fields: this.fields };

				this.$nodos.saveDetalles(data, (response) => {
					// Callback al guardar detalles
					this.upload();
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
					window.location.replace( this.route('cambio-unidad', this.data.promesa.opp) );
				});
			}
		},
		created: function(){
			console.log('data =>', this.data);
			this.getDetalles();
		}
	}
</script>