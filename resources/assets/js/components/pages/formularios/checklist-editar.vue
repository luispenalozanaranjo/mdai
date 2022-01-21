<template>
	<mdai-box class="content-block" title="Detalles">
		<template slot="content">
			<div class="row total mini align-items-center">
				<div class="col-12" v-if="response">
					<mdai-support :theme="response.status ? 'success' : 'error'">
						<p>{{ response.message }}</p>
					</mdai-support>
				</div>
				<div class="col-12 col-sm">
					<mdai-input v-model="fields.tipo" label="Nombre"></mdai-input>
				</div>
				<div class="col-12 col-sm">
					<mdai-select label="Etapa" v-model="fields.etapa" val="id" show="nombre" :data="etapas" @change="getNodos(true)"></mdai-select>
				</div>
				<div class="col-12 col-sm">
					<mdai-select label="Número nodo" v-model="fields.num_nodo" val="num_nodo" :data="nodos">
						<template v-slot:option="{item}">
							{{ item.num_nodo }} - {{ item.actividad }} - {{ item.subactividad }}
						</template>
					</mdai-select>
				</div>
			</div>
		</template>
		<template slot="action">
			<div class="btn-holder text-right">
				<mdai-btn-action class="btn-primary" :class="{'btn-disabled': !validForm}" text="Agregar" v-model="saving" @action="editar"></mdai-btn-action>
			</div>
		</template>
	</mdai-box>
</template>

<script>
	export default{
		props: {
			checklist: { type: Object, required: true },
			etapas: { type: Array, required: true }
		},
		data: function(){
			return {
				saving: false,
				nodos: [],
				fields: {},
				response: null
			};
		},
		computed: {
			validForm: function(){
				let required = [],
					fields = ['etapa', 'num_nodo', 'tipo'];

				Object.entries(this.fields).forEach(([key, value]) => {
					// Recorremos todos las keys del objeto fields
					if( fields.includes(key) ){
						let item_val = this.$methods.isEmpty(this.fields[key]);
						required.push(item_val);
					}
				});
				// Verificamos y retornamos si todos los elementos son falsos
				return required.every(item => item === false);
			}
		},
		methods: {
			getNodos: function(disableSelect = false){
				if( disableSelect ) this.fields.num_nodo = '';
				let filtered = this.etapas.filter(item => item.id === parseInt(this.fields.etapa));
				if( filtered ) this.nodos = filtered[0].nodos;
			},
			editar: function(){
				if( this.validForm && !this.saving ){
					this.saving = true;
					this.$store.commit('toggleAction');
					this.$store.commit('addActionText', 'Guardando cambios...');

					this.$http({
						method: 'put',
						url: route('checklists.detalle.update', this.checklist.id),
						data: this.fields
					})
					.then(response => {
						this.response = response.data;

						setTimeout(() => {
							if( this.response.status ){
								setTimeout(() => {
									window.location.href = this.response.redirect;
								}, 1000);
							}

							this.saving = false;
							this.$store.commit('toggleAction');
						}, 500);
					});
				}
			}
		},
        created: function(){
            Object.entries(this.checklist).forEach(([key, value]) => {
                // Recorremos todos las keys del objeto fields
                this.$set(this.fields, key, value);
            });

			this.getNodos();
        }
	}
</script>