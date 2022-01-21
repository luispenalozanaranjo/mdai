<template>
	<div v-cloak>
		<div class="content-block">
			<mdai-box title="Información básica">
				<template slot="content">
					<mdai-support class="mb-16" v-if="updateResponse" :theme="updateResponse.status ? 'success' : 'error'">
						<p>{{ updateResponse.message }}</p>
					</mdai-support>
					
					<div class="row total mini align-items-center">
						<div class="col-12 col-md-3">
							<mdai-input v-model="fields.nombres.value" label="Nombres" />
						</div>
						<div class="col-12 col-md-3">
							<mdai-input v-model="fields.apellidos.value" label="Apellidos" />
						</div>
						<div class="col-12 col-md-3">
							<mdai-input v-model="fields.usuario.value" label="Nombre de usuario" :readonly="true" />
						</div>
						<div class="col-12 col-md-3">
							<mdai-input v-model="fields.rut.value" label="RUT" />
						</div>
						<div class="col-12 col-md-3">
							<mdai-input v-model="fields.email.value" label="Email" type="email" />
						</div>
						<div class="col-12 col-md-3">
							<mdai-select v-model="fields.id_cargo.value" val="id" show="nombre" :data="cargos" label="Cargo" />
						</div>
						<div class="col-12 col-md-3">
							<mdai-select v-model="fields.id_area.value" val="id" show="nombre" :data="areas" label="Área" />
						</div>
						<div class="col-12 col-md-3">
							<mdai-select v-model="fields.backup.value" val="id" :data="users" label="Backup">
								<template v-slot:option="{item}">
									{{ item.nombres }} {{ item.apellidos }}
								</template>
							</mdai-select>
						</div>
						<div class="col-12 col-md-3">
							<mdai-input v-model="fields.usuario_vivesoft.value" label="Usuario Vivesoft" />
						</div>
						<div class="col-12 col-md-3">
							<div class="input-cont checkbox">
								<label>
									<input type="checkbox" class="fill-control-input" value="1" v-model="fields.representante_legal.value">
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description">Representante Legal</span>
								</label>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="input-cont checkbox">
								<label>
									<input type="checkbox" class="fill-control-input" value="1" v-model="fields.excepcion.value">
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description">Puede excepcionar</span>
								</label>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="input-cont checklists">
								<label class="label">Vacaciones</label>
								<div class="radio">
									<input id="vacon" type="radio" name="vacaciones" value="1" v-model="fields.vacaciones.value" @change="toggleVacaciones">
									<label for="vacon">Sí</label>
								</div>
								<div class="radio">
									<input id="vacoff" type="radio" name="vacaciones" value="0" v-model="fields.vacaciones.value" @change="toggleVacaciones">
									<label for="vacoff">No</label>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-3" v-if="vacaciones">
							<div class="input-cont">
								<div class="cont">
									<input type="text" name="vacaciones" v-model="fields.fecha_desde.value">
									<label class="label">Vacaciones desde</label>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-3" v-if="vacaciones">
							<div class="input-cont">
								<div class="cont">
									<input type="text" name="vacaciones" v-model="fields.fecha_hasta.value">
									<label class="label">Vacaciones Hasta</label>
								</div>
							</div>
						</div>
					</div>
				</template>
				<template slot="action">
					<div class="btn-holder text-right">
						<mdai-btn-action class="btn-primary" text="Actualizar" v-model="updating" @action="update" />
					</div>
				</template>
			</mdai-box>
		</div>

		<div class="content-block">
			<mdai-accordion title="Cambiar contraseña">
				<mdai-support class="mb-16" v-if="passwordResponse" :theme="passwordResponse.status ? 'success' : 'error'">
					<p>{{ passwordResponse.message }}</p>
				</mdai-support>

				<div class="row total mini">
					<div class="col-12 col-sm-3">
						<mdai-input type="password" v-model="password.current.value" label="Contraseña actual" />
					</div>
					<div class="col-12 col-sm-3">
						<mdai-input type="password" v-model="password.new.value" label="Nueva contraseña" />
					</div>
					<div class="col-12 col-sm-3">
						<mdai-input type="password" v-model="password.confirm.value" label="Confirmar nueva contraseña" />
					</div>
				</div>

				<div class="btn-holder text-right mt-16">
					<mdai-btn-action class="btn-secondary" text="Actualizar" v-model="updatingPassword" @action="changePassword" />
				</div>
			</mdai-accordion>
		</div>

		<div class="content-block" v-if="manage_permisos && permisos_list">
			<mdai-accordion title="Cambiar Permisos">
				<form class="form" @submit.prevent="updatePermisos">
					<div class="row total">
						<div class="col-12 col-sm-4 permisos_list" v-for="(permiso, index) in permisos_list" :key="index">
							<h4 class="heading-5 mb-16">
								{{ permiso['etapa'] }} 
							</h4>

							<div class="permiso-item" v-for="(nodo, permiso_index) in permiso['nodos']" :key="permiso_index">
								<div class="input-cont checkbox">
									<label>
										<span class="permiso-icon fa fa-eye"></span>
										<input type="checkbox" class="fill-control-input" :value="permissions[nodo['id']].value" :id="'input-' + nodo['num_nodo']" v-model="permissions[nodo['id']].value">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" v-if="permiso['etapa'] !== 'Otros'">
											<!-- {{ nodo.nodo['num_nodo'] + ' - ' + nodo.nodo['subactividad'] }} -->
										</span>
										<span class="fill-control-description" v-else>
											{{ nodo.nodo['num_nodo'] + ' - ' + nodo.nodo['actividad'] }}
										</span>
									</label>
									<label v-if="permiso['etapa'] !== 'Otros'">
										<span class="permiso-icon fa fa-bell"></span>
										<input type="checkbox" class="fill-control-input" :id="'input-notificacion' + nodo['num_nodo']" v-model="permissions_notificacion[nodo['id']].value">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description" >
											{{ nodo.nodo['num_nodo'] + ' - ' + nodo.nodo['subactividad']  }}
										</span>
									</label>
								</div>
							</div>
								<!-- aqui van los permisos -->
							<!-- <div class="input-cont checkbox col-6" v-for="(nodo, permiso_index) in permiso['nodos']" :key="permiso_index">
								<label>
									
									
									<input type="checkbox" class="fill-control-input" :id="'input-notificacion-' + nodo['num_nodo']" v-model="permissions[nodo['id']].value">
									<span class="fill-control-indicator"></span>
									<span class="fill-control-description" v-if="permiso['etapa'] !== 'Otros'">
										{{ nodo.nodo['num_nodo'] + ' - ' + nodo.nodo['subactividad'] }}
									</span>
									<span class="fill-control-description" v-else>
										{{ nodo.nodo['num_nodo'] + ' - ' + nodo.nodo['actividad'] }}
									</span>
								</label>
							</div> -->
						</div>
					</div>

					<div class="btn-holder text-right mt-16">
						<button type="submit" class="btn btn-secondary">
							Actualizar
						</button>
					</div>
				</form>
			</mdai-accordion>
		</div>

		<div class="content-block" v-if="proyectos_ready">
			<mdai-accordion title="Acceso por proyecto">
				<form class="form" @submit.prevent="updateAccesos">
					<div class="permisos_list">
						<div class="row total mini">
							<div class="col-12 col-sm-4" v-for="(proyecto, index) in proyectos" v-bind:key="index">
								<div class="input-cont checkbox">
									<label>
										<input type="checkbox" class="fill-control-input" v-model="proyectos_list[proyecto.id].value">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description">
											{{ proyecto.codigo }} - {{ proyecto.nombre | capitalize }}
										</span>
									</label>
								</div>
							</div>
						</div>
					</div>

					<div class="btn-holder text-right mt-16">
						<button type="submit" class="btn btn-secondary">
							Actualizar
						</button>
					</div>
				</form>
			</mdai-accordion>
		</div>
	</div>
</template>

<script>
	export default{
		props: {
			usuario: { type: Object, required: true },
			users: { type: Array, required: true },
			cargos: { type: Array, required: true },
			areas: { type: Array, required: true },
			permisos: { type: Array, required: false },
			permisos_granted: { type: Array, required: false },
			proyectos: { type: Array, required: false },
			proyectos_granted: { type: Array, required: false },
			manage_permisos: { type: Boolean, required: false },
			permiso_notificacion: { type: Array, required: false }
		},
		data: function(){
			return {
				test: null,
				updating: false,
				updatingPassword: false,
				updateResponse: false,
				passwordResponse: false,
				vacaciones: false,
				fields: {},
				permisos_list: null,
				permissions: {},
				permissions_notificacion: {},
				proyectos_list: {},
				proyectos_ready: false,
				permissions_copy:{},
				password: {
					current: {value: null},
					new: {value: null},
					confirm: {value: null}
				}
			};
		},
		methods: {
			toggleVacaciones: function(e){
				// Alternamos el estado de las vacaciones
				this.vacaciones = ( e.target.value === "1" ) ? true : false;
			},
			update: function(){
				// Submit del formulario del perfil
				this.updating = true;
				this.updateResponse = false;

				this.$http({
					method: 'put',
					url: route('usuarios.update'),
					data: this.fields
				})
				.then(response => {
					// Verificamos la respuesta
					setTimeout(() => {
						this.updateResponse = response.data;
						this.updating = false;
					}, 1500);
				});
			},
			updatePermisos: function(){
				this.$store.commit('toggleAction');
				this.$store.commit('addActionText', 'Guardando cambios...');
				 
				this.$http.post( route('usuarios.update.permisos'), { id_usuario: this.usuario.id, permisos: this.permissions })
				.then(response => {
					if( response.data ){
						this.$store.commit('enableToast', {
							text: 'Cambios guardados correctamente',
							type: 'success'
						});
					}
					else{
						this.$store.commit('enableToast', {
							text: 'Ocurrió un problema',
							type: 'error'
						});
					}
				})
				.finally(() => {
					this.$store.commit('toggleAction');
				});
				this.updatePermisosNotificacion();
			},
			updatePermisosNotificacion: function(){
				this.$store.commit('toggleAction');
				this.$store.commit('addActionText', 'Guardando cambios...');
				 
				this.$http.post( route('usuarios.update.permisos.notificacion'), { id_usuario: this.usuario.id, permisos: this.permissions_notificacion })
				.then(response => {
					if( response.data ){
						this.$store.commit('enableToast', {
							text: 'Cambios guardados correctamente',
							type: 'success'
						});
					}
					else{
						this.$store.commit('enableToast', {
							text: 'Ocurrió un problema',
							type: 'error'
						});
					}
				})
				.finally(() => {
					this.$store.commit('toggleAction');
				});
			},
			updateAccesos: function(){
				this.$store.commit('toggleAction');
				this.$store.commit('addActionText', 'Guardando cambios...');
				 
				this.$http.post( route('usuarios.update.proyectos'), { id_usuario: this.usuario.id, proyectos: this.proyectos_list })
				.then(response => {
					var response = response.data;
					if( response ){
						this.$store.commit('enableToast', {
							text: 'Cambios guardados correctamente',
							type: 'success'
						});
					}
					else{
						this.$store.commit('enableToast', {
							text: 'Ocurrió un problema',
							type: 'error'
						});
					}
				})
				.finally(() => {
					this.$store.commit('toggleAction');
					console.log('finally');
				});
			},
			changePassword: function(){
				this.updatingPassword = true;
				this.passwordResponse = false;

				this.$http({
					method: 'put',
					url: route('usuarios.update.password'),
					data: { password: this.password, usuario: this.usuario.id }
				})
				.then(response => {
					setTimeout(() => {
						this.passwordResponse = response.data;
						this.updatingPassword = false;

						if( response.data.status ){
							// Contraseña cambiada
							Object.entries( this.password ).forEach(([key, value]) => {
								this.password[key].value = null;
							});
						}
					}, 1500);
				});
			}
		},
		created: function(){
			// Rellenamos la variable fields del data con el objeto de info del usuario
			Object.entries(this.usuario).forEach(([key, value]) => {
				let valor = null;
				if( key === 'backup' ) valor = value ? value : '';
				else if( key === 'cargo' || key === 'area' ) valor = value.nombre;
				else valor = valor = value;
				// Disponibilizamos el valor
				this.$set(this.fields, key, {value: valor});
			});
			
			// Preparamos los permisos
			if( this.manage_permisos ){
				let etapas = {};
				this.permisos.forEach(item => {
					// Creamos el objecto con los nodos
					let etapa = item.nodo.info_etapa.nombre;
					etapas[etapa] = {
						etapa: etapa,
						nodos: []
					};
				});

				this.permisos.forEach((item) => {
					// Agregamos el nodo a su etapa correspondiente
					let etapa = item.nodo.info_etapa.nombre;
					etapas[etapa].nodos.push(item);
					etapas[etapa].nodos.id_permiso = item.id;
                      
					// Creamos el objeto con los v-model
					this.permissions[item.id] = {
						id: item.id,
						value: false
					};
					this.permissions_notificacion[item.id] = {
						id: item.id,
						value: false
					};
				});

				// Recorremos los permisos otorgados y rellenamos
				this.permisos_granted.forEach((item) => {
					this.permissions[item.id].value = true;
				});
				this.permiso_notificacion.forEach((item) => {
					this.permissions_notificacion[item.id].value = true;
				});

				this.permisos_list = etapas;

				this.proyectos.forEach((item, index) => {
					this.proyectos_list[item.id] = {
						id: item.id,
						value: false
					};

					if( index === this.proyectos.length -1 ){
						this.proyectos_ready = true;
					}
				});

				this.proyectos_granted.forEach((item) => {
					this.proyectos_list[item.id].value = true;
				});
			}
		}
	}
</script>

<style lang="scss">
	.permisos_list{
		.permiso-icon{
			font-size:14px;
			margin-right:4px;
			color:#999;
		}

		.permiso-item{
			margin-bottom:4px;
			&:last-of-type{margin-bottom:0;}
			.input-cont.checkbox{display:inline-block}
		}
	}
</style>