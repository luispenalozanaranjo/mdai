<template>
	<div>
		<div class="heading-block mb-24">
			<h1 class="heading-1 text-normal">Búsqueda promesa</h1>
		</div>

		<div class="content-block">
			<form class="form" ref="busqueda_form">
				<mdai-box title="Ingresa un parámetro de búsqueda">
					<template slot="content">
						<div class="row total mini align-items-end">
							<div class="col-4 col-sm-1">
								<mdai-input v-model="fields.opp" label="OPP" :number="true"></mdai-input>
							</div>
							<div class="col-8 col-sm-2">
								<mdai-input v-model="fields.rut" label="RUT"></mdai-input>
							</div>
							<div class="col-12 col-sm">
								<mdai-input v-model="fields.nombre" label="Nombre"></mdai-input>
							</div>
							<div class="col-12 col-sm">
								<mdai-input v-model="fields.apellido" label="Apellido"></mdai-input>
							</div>
							<div class="col-12 col-sm">
								<mdai-select label="Estado" v-model="fields.estado" :all="true" :data="estados"></mdai-select>
							</div>
							<div class="w-100"></div>
							<div class="col-12 col-sm">
								<mdai-select label="Tipo" v-model="fields.tipo" val="marca" show="marca" :data="marcas"></mdai-select>
							</div>
							<div class="col-12 col-sm">
								<mdai-select label="Proyecto" v-model="fields.proyecto" :all="true" val="id" :data="proyectosSort" @change="GetEtapaComboBox">
									<template v-slot:option="{item}">
										{{ item.nombre | capitalize }}
									</template>
								</mdai-select>
							</div>
							<div class="col-12 col-sm">
								<mdai-select label="Etapa" v-model="fields.etapa" :all="true" val="id" :data="etapasSort" :disabled="!etapas">
									<template v-slot:option="{item}">
										{{ item.nombre | capitalize }}
									</template>
								</mdai-select>
							</div>
							<div class="col-12 col-sm">
								<mdai-select label="Ejecutivo" v-model="fields.ejecutivo" :all="true" val="ejecutivo" :data="ejecutivosSort">
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
								<mdai-btn-action class="btn-primary" text="Buscar" v-model="doSearch" @action="search"></mdai-btn-action>
							</div>
						</div>
					</template>
				</mdai-box>
			</form>
		</div>

		<div class="content-block mt-32" v-if="results !== null">
			<div class="row align-items-end">
				<div class="col-12">
					<div class="heading-block mb-16" v-if="results !== null && results.total > 0">
						<h3 class="heading-3">Resultados de la búsqueda</h3>
						<p>{{ $methods.showTotal(results.total, 'promesa', 'promesas') }}</p>
					</div>
					<mdai-support theme="error" v-else>
						<h6 class="heading-4">Resultados de la búsqueda</h6>
						<p>No se encontraron resultados, revisa los parámetros ingresados.</p>
					</mdai-support>
				</div>
				<div class="col-6 d-none">
					<div class="d-flex justify-content-end">
						<mdai-results-show name="promesas"></mdai-results-show>
					</div>
				</div>
			</div>

			<mdai-table v-if="results.total > 0"
				:head="['OPP', 'RUT', 'Nombre', 'Apellido', 'Proyecto', 'Etapa', 'Tipo', 'Ejecutivo', 'Estado', 'Workflow', 'Acciones']"
				:body="results.data"
			>
				<template slot-scope="{ item }">
					<td>{{ item.opp }}</td>
					<td>{{ item.rut_cliente | rut }}</td>
					<td>{{ item.primer_nombre | capitalize }}</td>
					<td>{{ item.apellido_paterno | capitalize }}</td>
					<td>{{ item.proyecto | capitalize }}</td>
					<td>{{ item.etapa | capitalize }}</td>
					<td>{{ item.marca }}</td>
					<td>{{ item.ejecutivo }}</td>
					<td>
						<mdai-status :id="item.estados.id" :estado="item.estados.descripcion"></mdai-status>
					</td>
					<td>
						<mdai-status
							v-if="item.estado === 'Promesada' || item.estado === 'Escriturada'"
							:id="item.workflow_estado ? 13 : 3"
							:estado="item.workflow_estado ? 'Terminado' : 'Pendiente'"
						></mdai-status>
						<mdai-status v-else id="2" estado="Desistida"></mdai-status>
					</td>
					<td>
						<div class="row-actions">
							<a :href="route('detalle-promesa', item.opp)" v-if="item.workflow">
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
					last_page: results.last_page,
				}"
			>
			</mdai-paginador>
		</div>

		<div class="content-block d-none">
			<a href="#" class="text-link">
				<span class="fa fa-download mr-4"></span>
				Exportar datos
			</a>
		</div>
	</div>
</template>

<script>
export default {
	data: function() {
		return {
			doSearch: false,
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
				estado: "",
			},
			results: null,
			etapas: false,
		};
	},
	props: {
		proyectos: { type: [Array, Boolean], required: true },
		marcas: { type: [Array, Boolean], required: true },
		estados: { type: [Array, Boolean], required: true },
		ejecutivos: { type: [Array, Boolean], required: true },
	},
	methods: {
		search: function(){
			this.doSearch = true;
			this.getData(1);
		},
		changeShow: function(value) {
			this.fields.show = value;

			if( this.results ){
				this.getData(1);
			}
		},
		GetEtapaComboBox: function(value) {
			if( this.fields.proyecto ){
				this.$store.commit("toggleAction");
				this.$store.commit("addActionText", "Filtrando data...");

				this.$http.get(route("get.etapa", this.fields.proyecto))
				.then(response => {
					this.etapas = response.data;
				})
				.catch(error => {
					console.log(error);
				})
				.finally(() => {
					this.$store.commit("toggleAction");
				});
			}
			else {
				this.etapas = false;
			}
		},
		getData: function(page){
			this.fields.pagina = page;
			this.$store.commit("toggleAction");
			this.$store.commit("addActionText", "Filtrando data...");

			this.$http("/get-promesas" + this.$methods.toURL(this.fields))
			.then(response => {
				this.results = response.data;
			})
			.catch(error => {
				console.error(error);
			})
			.finally(() => {
				this.doSearch = false;
				this.$store.commit("toggleAction");
			});
		},
	},
	computed: {
		ejecutivosSort: function() {
			if( this.ejecutivos ){
				return this.$methods.arraySort(this.ejecutivos, "ejecutivo");
			}
		},
		proyectosSort: function() {
			if( this.proyectos ){
				return this.$methods.arraySort(this.proyectos);
			}
		},
		etapasSort: function() {
			if( this.etapas.length ){
				return this.$methods.arraySort(this.etapas, "etapa");
			}
		},
	},
	created: function() {
		EventBus.$on("changePage", (page) => {
			this.getData(page);
		});

		EventBus.$on("changeShow", (show) => {
			this.changeShow(show);
		});
	},
};
</script>
