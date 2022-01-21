<template>
	<div>
		<div class="heading-block mb-24">
			<div class="row align-items-center">
				<div class="col-12 col-sm-6">
					<h1 class="heading-1">Detalle entidad financiera</h1>
				</div>
				<div class="col-12 col-sm-6 d-flex justify-content-end">
					<a :href="route('entidades.home')" class="text-link">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver atrás
					</a>
				</div>
			</div>
		</div>

		<form class="content-block" @submit.prevent="update">
			<mdai-box title="Información básica">
				<template slot="content">
					<div class="row total align-items-center">
						<div class="col-12 col-sm-3">
							<mdai-input v-model="fields.nombre" label="Nombre"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-select label="Tipo" v-model="fields.tipo" :data="tipos"></mdai-select>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-select label="Tipo" v-model="fields.estado" val="value" show="nombre" :data="estados"></mdai-select>
						</div>
					</div>
				</template>
				<template slot="action">
					<div class="btn-holder">
						<div class="row total mini align-items-center">
							<div class="col-6">
							   <button type="button" class="btn btn-secondary" @click.prevent="modal = true">Eliminar</button>
							</div>
							<div class="col-6 text-right">
								<mdai-btn-action class="btn-primary" :class="{'btn-disabled': !validForm}" text="Guardar cambios" v-model="updating" @action="update" />
							</div>
						</div>
					</div>
				</template>
			</mdai-box>
		</form>

		<mdai-lightbox v-model="modal" title="Eliminar Entidad financiera">
			<p>
				¿Está seguro que desea eliminar esta Entidad Financiera?
				<mark class="d-block">Esta acción no se puede deshacer.</mark>
			</p>
			
			<div class="btn-holder">
				<div class="row total align-items-center">
					<div class="col-12 col-sm-6">
						<a href="#" class="text-link" @click.prevent="modal = false">
							Cancelar
						</a>
					</div>
					<div class="col-12 col-sm-6 text-right">
						<mdai-btn-action class="btn-primary btn-action" text="Eliminar" v-model="deleting" @action="deleteEntidad" />
					</div>
				</div>
			</div>
		</mdai-lightbox>
	</div>
</template>

<script>
export default {
	props: {
		entidad: { type: [Object, Array], required: true }
	},
	data: function(){
		return {
			updating: false,
			deleting: false,
			tipos: ['Banco', 'Notaria', 'CBR', 'Serviu', 'Mutuaria', 'Otro'],
			estados: [
				{ nombre: 'Vigente', value: 1 },
				{ nombre: 'No vigente', value: 0 }
			],
			fields: {},
			modal: false
		};
	},
	computed: {
		validForm: function(){
			// Validamos los campos del formulario
			let required = ['nombre', 'tipo', 'estado'];
			let fields = [];

			Object.entries(this.fields).forEach(([key, value]) => {
				// Recorremos todos las keys del objeto fields
				if( required.includes(key) ){
					fields.push(this.$methods.isEmpty(this.fields[key]));
				}
			});
			// Verificamos y retornamos si todos los elementos son falsos
			return fields.every(item => item === false);
		}
	},
	methods: {
		update: function(){
			this.updating = true;
			this.$http({
				method: 'put',
				url: route('entidades.update', this.entidad.id),
				data: this.fields
			})
			.then(response => {
				this.$store.commit('enableToast', {
					text: response.data.message,
					type: response.data.status ? 'success' : 'error'
				});

				if( response.data.status ){
					setTimeout(() => {
						window.location.href = response.data.redirect;
					}, 1500);
				}
				else{
					this.updating = false;
				}
			});
		},
		deleteEntidad: function(){
			this.deleting = true;

			this.$http({
				method: 'delete',
				url: route('entidades.delete', this.entidad.id)
			})
			.then(response => {
				if( response.data.status ){
					setTimeout(() => {
						window.location.href = response.data.redirect;
					}, 1500);
				}
				else{
					this.deleting = false;
				}
			});
		}
	},
	created: function(){
		// Agregamos el objeto del prop a la data
		Object.entries(this.entidad).forEach(([key, value]) => {
			this.$set(this.fields, key, (value !== null ? value : ""));
		});
	}
}
</script>
