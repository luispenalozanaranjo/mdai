<template>
	<div class="content-block">
		<form>
			<mdai-box title="Información básica">
				<template slot="content">
					<mdai-support class="mb-16" theme="error" v-if="response">
						<p>{{ response.message }}</p>
					</mdai-support>

					<div class="row total mini align-items-center">
						<div class="col-12 col-sm-3">
							<mdai-input v-model="fields.nombres.value" label="Nombres"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-input v-model="fields.apellidos.value" label="Apellidos"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-input v-model="fields.usuario.value" label="Nombre de usuario"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-input v-model="fields.rut.value" label="RUT"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-input v-model="fields.email.value" label="Email" type="email"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-select v-model="fields.id_cargo.value" label="Cargo" :data="cargos" show="nombre" val="id"></mdai-select>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-select v-model="fields.id_area.value" label="Área" :data="areas" show="nombre" val="id"></mdai-select>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-select v-model="fields.backup.value" label="Backup" :data="users" val="id">
								<template v-slot:option="{item}">
									{{ item.nombres }} {{item.apellidos }}
								</template>
							</mdai-select>
						</div>
						<div class="col-12 col-sm-3">
							<mdai-input v-model="fields.usuario_vivesoft.value" label="Usuario Vivesoft"></mdai-input>
						</div>
						<div class="col-12 col-sm-3">
							<div class="input-cont checkbox">
								<label>
									<input type="checkbox" class="fill-control-input" value="1" v-model="fields.representante_legal.value">
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description">Representante Legal</span>
								</label>
							</div>
						</div>
						<div class="col-12 col-sm-3">
							<div class="input-cont checkbox">
								<label>
									<input type="checkbox" class="fill-control-input" value="1" v-model="fields.excepcion.value">
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description">Puede excepcionar</span>
								</label>
							</div>
						</div>
					</div>
				</template>
				<template slot="action">
					<div class="btn-holder text-right">
						<mdai-btn-action class="btn-primary" :class="{'btn-disabled': !validForm}" text="Agregar" v-model="creating" @action="agregar" />
					</div>
				</template>
			</mdai-box>
		</form>
	</div>
</template>

<script>
	export default{
		props: {
			cargos: { type: Array, required: true },
			users: { type: Array, required: true },
			areas: { type: Array, required: true }
		},
		data: function(){
			return {
				creating: false,
				response: false,
				fields: {
					nombres: { value: null, required: true },
					apellidos: { value: null, required: true },
					usuario: { value: null, required: true },
					rut: { value: null, required: true },
					email: { value: null, required: true },
					id_cargo: { value: "", required: true },
					id_area: { value: "", required: true },
					backup: { value: "", required: true },
					representante_legal: { value: null },
					excepcion: { value: null },
					usuario_vivesoft: { value: null }
				}
			};
		},
		computed: {
			validForm: function(){
				let required = [];

				Object.entries(this.fields).forEach(([key, value]) => {
					// Recorremos todos las keys del objeto fields
					if( this.fields[key].required ){
						let value = this.$methods.isEmpty(this.fields[key].value);
						required.push(value);
					}
				});

				return required.every(item => item === false);
			}
		},
		methods: {
			agregar: function(){
				if( this.validForm ){
					this.creating = true;
					this.response = false;

					this.$http({
						method: 'post',
						url: route('usuarios.create'),
						data: this.fields
					})
					.then(response => {
						if( response.data.status ){	
							setTimeout(() => {
								window.location = response.data.redirect;
							}, 1500);
						}
						else{
							this.response = response.data;
							this.creating = false;
						}
					});
				}
			}
		}
	}
</script>