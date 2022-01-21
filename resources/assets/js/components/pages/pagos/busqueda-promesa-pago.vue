<template>
	<div>
		<div class="content-block">
			<form class="form" ref="busqueda_form">
				<mdai-box title="Ingresa un parámetro de búsqueda">
					<template slot="content">
						<div class="row total mini align-items-end">
							<div class="col-12 col-sm-1">
								<mdai-input v-model="fields.opp" label="OPP" :number="true"></mdai-input>
							</div>
							<div class="col-12 col-sm-2">
								<mdai-input v-model="fields.rut" label="RUT"></mdai-input>
							</div>
							<div class="col-12 col-sm">
								<mdai-input v-model="fields.nombre" label="Nombre"></mdai-input>
							</div>
							<div class="col-12 col-sm">
								<mdai-input v-model="fields.apellido" label="Apellido"></mdai-input>
							</div>
							<div class="col-12 col-sm">
								<mdai-select v-model="fields.estado" label="Estado" :data="estados"></mdai-select>
							</div>
							<div class="w-100"></div>
							<div class="col-12 col-sm">
								<mdai-select v-model="fields.tipo" label="Tipo" :data="marcas" val="marca" show="marca"></mdai-select>
							</div>
							<div class="col-12 col-sm">
								<mdai-select v-model="fields.proyecto" label="Proyecto" :data="proyectosSort" val="id" @change="GetEtapaComboBox">
									<template v-slot:option="{item}">
										{{ item.nombre | capitalize }}
									</template>
								</mdai-select>
							</div>
							<div class="col-12 col-sm">
								<mdai-select v-model="fields.etapa" label="Etapa" :data="etapasSort" val="id" :disabled="!etapas">
									<template v-slot:option="{item}">
										{{ item.nombre | capitalize }}
									</template>
								</mdai-select>
							</div>
							<div class="col-12 col-sm">
								<mdai-select v-model="fields.ejecutivo" label="Ejecutivo" :data="ejecutivosSort" val="ejecutivo">
									<template v-slot:option="{item}">
										{{ item.ejecutivo | capitalize }}
									</template>
								</mdai-select>
							</div>
						</div>
					</template>
					<template slot="action">
						<div class="btn-holder text-right">
							<div class="input-cont">
								<button type="submit" class="btn btn-primary" @click.prevent="getData(1)">Buscar</button>
							</div>
						</div>
					</template>
				</mdai-box>
			</form>
		</div>

		<div class="content-block mt-32" v-if="results !== null">
			<div class="heading-block mb-20">
				<div class="row align-items-end">
					<div class="col-12">
						<h3 class="heading-3">Resultados de la búsqueda</h3>
						<p>{{ $methods.showTotal(results.total, 'promesa', 'promesas') }}</p>
					</div>
					<div class="col-6 d-none">
						<div class="d-flex justify-content-end">
							<mdai-results-show name="promesas"></mdai-results-show>
						</div>
					</div>
				</div>
			</div>

			<mdai-table v-if="results.data.length" :head="['OPP', 'RUT', 'Nombre', 'Apellido', 'Proyecto', 'Etapa', 'Tipo', 'Ejecutivo', 'Estado', 'Pago', 'Acciones']" :body="results.data">
				<template slot-scope="{ item }">
					<td>{{ item.opp }}</td>
					<td>{{ item.rut_cliente | rut }}</td>
					<td>{{ item.primer_nombre | capitalize }}</td>
					<td>{{ item.apellido_paterno | capitalize }}</td>
					<td>{{ item.proyecto | capitalize }}</td>
					<td>{{ item.etapa | capitalize }}</td>
					<td>{{ item.marca }}</td>
					<td>{{ item.ejecutivo }}</td>
					<td><mdai-status :id="item.estados.id" :estado="item.estados.descripcion"></mdai-status></td>
					<td>
						<mdai-status
							v-if="item.workflow_estado === 3"
							:id="item.workflow_estado"
							:estado="'Pendiente'"
						></mdai-status>
						<mdai-status v-else-if="item.workflow_estado === 13" :id="item.workflow_estado" :estado="'Pagado'"></mdai-status>
					</td>
					<td>
						<div class="row-actions">
							<a :href="route('finanzas.pago.operacion', item.opp)">
								<mdai-tooltip text="Ver detalles" position="top">
									<span class="fa fa-eye"></span>
								</mdai-tooltip>
							</a>
						</div>
					</td>
				</template>
			</mdai-table>
		</div>

		<div class="content-block mt-32" v-if="results !== null && results.last_page > 1">
			<mdai-paginador
				:config="{
				total: results.total,
				per_page: results.per_page,
				current_page: results.current_page,
				last_page: results.last_page
			}"
			></mdai-paginador>
		</div>

		<div class="content-block d-none">
			<a href="#" class="text-link">
				<span class="fa fa-download mr-5"></span>
				Exportar datos
			</a>
		</div>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				fields: {
					opp: "",
					rut: "",
					nombre: "",
					apellido: "",
					proyecto: "",
					etapa: "",
					tipo: "",
					lote: "",
					ejecutivo: "",
					pagina: 1,
					show: 16,
					estado: ""
				},
				results: null,
				etapas: false,	
			};
		},
		props: {
			proyectos: {type: [Array, Boolean], required: true },
			marcas: {type: [Array, Boolean], required: true },
			estados: {type: [Array, Boolean], required: true },
			ejecutivos: {type: [Array, Boolean], required: true },
			// nodos: {type: [Array], required: true }
		},
		methods: {
			changeShow: function(value){
				this.fields.show = value;
				if( this.results ){
					this.getData(1);				 
				}
			},
			GetEtapaComboBox: function(){
				if( this.fields.proyecto ){
					this.$store.commit('toggleAction');
					this.$store.commit('addActionText', 'Filtrando data...');
					
					this.$http.get( route('get.etapa', this.fields.proyecto) )
					.then( (response) => {
						var response = response.data;
						this.etapas = response;
					})
					.catch( (error) => {
						console.log(error);
					})
					.finally(() => {
						this.$store.commit('toggleAction');
					});
				}
				else{
					this.etapas = false;
				}
			},
			getData: function(page){
				this.fields.pagina = page;
				this.$store.commit('toggleAction');
				this.$store.commit('addActionText', 'Filtrando data...');

				this.$http('/get-promesas' + this.$methods.toURL(this.fields))
				.then( (response) => {
					this.results = response.data;
					// for(let i = 0; i < this.results.data.length; i++){
					// 	for(let j = 0; j < this.nodos.length; j++){
					// 		if( this.results.data[i].opp == this.nodos[j].opp ){
					// 			this.results.data[i].workflow_estado = this.nodos[j].estado;
					// 		}
					// 	}
					// }				 
				})
				.catch( error => {
					console.log(error);
				})
				.finally( () => {
					this.$store.commit('toggleAction');
				});						 
			}
		},
		computed: {
			ejecutivosSort: function(){
				if( this.ejecutivos ){
					return this.$methods.arraySort( this.ejecutivos, 'ejecutivo' );
				}
			},
			proyectosSort: function(){
				if( this.proyectos ){
					return this.$methods.arraySort( this.proyectos );
				}
			},
			etapasSort: function(){
				if( this.etapas.length ){
					return this.$methods.arraySort( this.etapas, 'etapa' );
				}
			},
		},
		created: function(){
			EventBus.$on('changePage', page => 	this.getData(page));
			EventBus.$on('changeShow', show => this.changeShow(show));
		}
	}
</script>