<template>
	<div class="content-block" v-cloak>
		<mdai-box title="Subir documento">
			<template slot="content">
				<mdai-errors-show :errors="errors"></mdai-errors-show>
				
				<div class="row total mini align-items-center">
					<div class="col-10 col-sm-4">
						<div class="file-cont">
							<input type="file" id="cargar-planilla" name="planilla" @change="onFileChange" accept="application/pdf">
							<label for="cargar-planilla" class="d-block p-16" :class="{load: file}">
								<div class="d-flex align-items-center justify-content-center">
									<div class="mr-32">
										<span class="fa fa-upload f-24 text-normal"></span>
									</div>
									<div class="text-cont">
										<p class="fw-semibold">
											{{ !file ? 'Haz clic para buscar el archivo' : 'Archivo seleccionado' }}
										</p>
										<p>
											{{ file ? file.name : 'para subir el archivo a la promesa.' }}
										</p>
									</div>
								</div>
							</label>
						</div>
					</div>
					<div class="col-12">
						<div class="input-cont">
							<label class="label">Comentarios</label>
							<div class="cont">
								<textarea name="observaciones" v-model="comentarios"></textarea>
							</div>
						</div>
					</div>
				</div>
			</template>
			<template slot="action">
				<div class="btn-holder">
					<div class="row total mini align-items-center">
						<div class="col-6">
							<a :href="route('documentos', data.promesa.opp)" class="text-link">
								<span class="fa fa-chevron-left mr-4"></span>
								Volver atrás
							</a>
						</div>
						<div class="col-6">
							<div class="text-right">
								<mdai-btn-action class="btn-primary" text="Subir documento" v-model="submitAction" @action="validateForm" v-show="permiso" />
							</div>
						</div>
					</div>
				</div>
			</template>
		</mdai-box>
	</div>
</template>

<script>
export default {
	props: {
		data: { type: Object, required: true },
		permiso: { type: Boolean, required: true }
	},
	data: function() {
		return {
			terminar: false,
			modalTerminar: false,
			file: null,
			fields: null,
			errors: [],
			action: false,
			submitAction: false,
			comentarios: null
		};
	},
	methods: {
		onFileChange: function(e) {
			this.file = e.target.files[0];
		},
		upload: function() {
			this.$store.commit("toggleAction");
			let formData = new FormData();
			formData.append("file", this.file);
			formData.append("id_dw", this.data.workflow.detalles.id);
			formData.append("id_nd", this.data.nodo.id);
			formData.append("comentarios", this.comentarios);

			if( this.file.size < 19961664 ){
				this.$nodos.digitalizar(formData)
				.then(response => {
					var response = response.data.response;

					if( response.status ){
						// Todo bien
						this.$store.commit("enableToast", {
							text: "Documento subido correctamente",
						});
						// this.hasFile = response.data;
						this.checkTermino();
					}
					else {
						let message = response.message ? response.message : "Ocurrió un problema al intentar subir el documento";
						this.$store.commit("enableToast", {
							text: message,
							type: "error",
						});
						this.$store.commit("toggleAction");
						this.submitAction = false;
					}
				});
			}
			else {
				this.$store.commit("enableToast", {
					text: "Archivo excede limite de 20MB",
					type: "error"
				});

				this.$store.commit("toggleAction");
				this.submitAction = false;
			}
		},
		validateForm: function() {
			// Validacion del formulario
			if (!this.submitAction) {
				this.submitAction = true;
				this.errors = [];

				// Validaciones personalizadas
				if (this.$methods.checkNullEmpty(this.file)) {
					this.errors.push("Es necesario seleccionar un archivo");
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
		submit: function() {
			// Método para guardar los datos
			this.upload();
			// 	let data = {
			// 		id_dw: this.data.workflow.detalles.id,
			// 		id_nd: this.data.nodo.id
			// 	};

			// 	this.$nodos.saveDetallesSimple(data)
			// 	.then((response) => {
			// 		if( response.data === true ){
			// 			setTimeout(() => {
			// 				this.upload();
			// 			}, 500);
			// 		}
			// 		else{
			// 			this.$store.commit('toggleAction');
			// 			this.$store.commit('enableToast', {
			// 				text: 'Ocurrió un problema al intentar guardar los cambios',
			// 				type: 'error'
			// 			});
			// 		}
			// 	})
			// 	.finally(() => {
			// 		this.submitAction = false;
			// 	});
		},
		checkTermino: function() {
			window.location.replace(this.route("documentos", this.data.promesa.opp));
		}
	}
};
</script>
