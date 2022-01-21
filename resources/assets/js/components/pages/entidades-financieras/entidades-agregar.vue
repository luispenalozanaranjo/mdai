<template>
	<div>
		<div class="heading-block mb-24">
			<div class="row align-items-center">
				<div class="col-12 col-sm-6">
					<h1 class="heading-1">Nueva entidad financiera</h1>
				</div>
				<div class="col-12 col-sm-6 d-flex justify-content-end">
					<a :href="route('entidades.home')" class="text-link">
						<span class="fa fa-chevron-left mr-4"></span>
						Volver atrás
					</a>
				</div>
			</div>
		</div>

		<div class="content-block">
			<mdai-box title="Información básica">
				<template slot="content">
					<div class="row total align-items-center">
						<div class="col-12 col-sm-3">
							<mdai-input v-model="fields.nombre" label="Nombre"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-select v-model="fields.tipo" label="Tipo" :data="tipos"></mdai-select>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-select v-model="fields.estado" label="Estado" val="value" show="nombre" :data="estados"></mdai-select>
						</div>
					</div>
				</template>
				<template slot="action">
					<div class="btn-holder text-right">
						<mdai-btn-action class="btn-primary" :class="{'btn-disabled': !validForm}" text="Agregar entidad" v-model="creating" @action="create" />
					</div>
				</template>
			</mdai-box>
		</div>
	</div>
</template>

<script>
export default {
	data: function(){
		return {
			creating: false,
			tipos: ['Banco', 'Notaria', 'CBR', 'Serviu', 'Mutuaria', 'Otro'],
			estados: [
				{ nombre: 'Vigente', value: 1 },
				{ nombre: 'No vigente', value: 0 }
			],
			fields: {
				nombre: null,
				tipo: "",
				estado: ""
			}
		};
	},
	computed: {
		validForm: function(){
			// Validamos los campos del formulario
			let required = [];
			Object.entries(this.fields).forEach(([key, value]) => {
				// Recorremos todos las keys del objeto fields
				required.push(this.$methods.isEmpty(this.fields[key]));
			});
			// Verificamos y retornamos si todos los elementos son falsos
			return required.every(item => item === false);
		}
	},
	methods: {
		create: function(){
			this.creating = true;

			this.$http({
				method: 'post',
				url: route('entidades.create'),
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
					this.creating = false;
				}
			});
		}
	}
}
</script>
