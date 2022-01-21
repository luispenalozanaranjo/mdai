<template>
	<div>
		<div class="heading-block mb-24">
			<h1 class="heading-1 text-normal">Búsqueda De operaciones para reversar</h1>
		</div>

		<div class="content-block">
			<form class="form" ref="busqueda_form">
				<mdai-box title="Ingresa un parametro de búsqueda">
					<template slot="content">
						<div class="row total mini align-items-end">
							<div class="col-2">
								<mdai-input v-model="promesa.opp" label="OPP" />
							</div>
							<div class="col">
								<mdai-input v-model="fields.nodo_mostrar" label="Estado Actual" :disabled="true" />
							</div>
							<div class="col">
								<mdai-select label="Estado a reversar" v-model="fields.nodoAReversar" :data="reverse" val="num_nodo">
									<template v-slot:option="{item}">
										{{ item.num_nodo  }} - {{ item.nombre}}
									</template>
								</mdai-select>
							</div>
						</div>
					</template>
					<template slot="action">
						<div class="btn-holder text-right">
							<div class="input-cont">
								<button type="submit" class="btn btn-primary" @click.prevent="reversaopp()">
									Reversar
								</button>
							</div>
						</div>
					</template>
				</mdai-box>
			</form>
		</div>

		<div class="content-block" v-if="results !== null">
			<div class="heading-block mb-20">
				<div class="row align-items-end">
					<div class="col-6">
						<h3 class="heading-3">Resultados de la búsqueda</h3>
						<p v-if="results !== null && results.total > 0">
							{{ results.total }}
							{{ results.total > 1 ? "registros encontrados" : "registro encontrado" }}.
						</p>
						<p v-else>Sin resultados.</p>
					</div>
					<div class="col-6" v-if="results !== null && results.total > 0 && results.total > fields.show">
						<div class="d-flex justify-content-end">
							<mdai-results-show name="promesas"></mdai-results-show>
						</div>
					</div>
				</div>
			</div>

			<mdai-box v-if="results.total > 0">
				<template slot="content">
					<mdai-table :head="['OPP', 'RUT', 'Nombre', 'Apellido', 'Proyecto', 'Etapa', 'Tipo', 'Ejecutivo', 'Estado', 'Workflow', 'Acciones']" :body="results.data">
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
								<mdai-status :id="item.estados.id" :estado="item.estados.descripcion" />
							</td>
							<td>
								<mdai-status v-if="item.estado === 'Promesada'" :id="item.workflow_estado ? 13 : 3" :estado="item.workflow_estado ? 'Terminado' : 'Pendiente'" />
								<mdai-status v-else id="2" estado="Desistida" />
							</td>
							<td>
								<div class="row-actions">
									<a :href="route('reversa', {opp: item.opp})" v-if="item.workflow">
										<mdai-tooltip text="Ver detalles" position="top">
											<span class="fa fa-eye"></span>
										</mdai-tooltip>
									</a>
								</div>
							</td>
						</template>
					</mdai-table>
				</template>
			</mdai-box>
		</div>

		<div class="content-block" v-if="results !== null && results.last_page > 1">
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
				<span class="fa fa-download mr-5"></span>
				Exportar datos
			</a>
		</div>
	</div>
</template>

<script>
import Axios from "axios";

export default {
	data: function(){
		return {
			fields: {
				opp: "",
				nodoAReversar: "",
				nodo_actual: "",
				nodo_mostrar:""

			},
			results: null,
			
			nodosInactivos: [{nombre:"Fin de proceso",num_nodo:172},{ nombre:"Fin de proceso",num_nodo:99}, {nombre:"Fin de proceso",num_nodo:999}, {nombre:"Fin de proceso",num_nodo:1000}],
		};
	},
	props: {
		promesa: { type: Object, required: true },
		etapas: { type: [Object, Array], required: true }
	},
	computed:{
		reverse: function () {
			let newObj = {};
			let indexes = [];
			let array= [];

			Object.entries(this.etapas).forEach(([key, values]) => {
				// Recorremos las etapas buscando el indice
				indexes.push(key);
			});

			// Ordenamos el indice de mayor a menor
			let desc = indexes.sort((a, b) => b - a);

			desc.forEach(item => {
				// Recorremos el array y creamos el nuevo objeto
				this.etapas[item].forEach( item2 => {
					array.push({
						num_nodo: item2.nodo.num_nodo,
						nombre: item2.nodo.subactividad
					});
				}
				);
				this.etapas[item].forEach( item2 => {
					this.nodosInactivos.forEach(inactivo => {
						if( inactivo.num_nodo == item2.nodo.num_nodo ){
							array.forEach((elemento1, index) => {
								if( elemento1.num_nodo == inactivo.num_nodo ){
									array.splice(index, 1);
								}
							});						 
						}				 
					});	 
				});
			});
			if( array.length > 1) {
				this.fields.nodo_actual = array[0].num_nodo;
				this.fields.nodo_mostrar = `${array[0].num_nodo} - ${array[0].nombre}`;
				array.shift();
			}
			else if( array.length == 1 ){
				this.fields.nodo_actual = array[0];
				this.fields.nodo_mostrar = `${array[0].num_nodo} - ${array[0].nombre}`;
			}
			return array;
		}
	},
	methods: {
		reversaopp: function(){
			if( this.fields.nodo_actual && this.fields.nodoAReversar ){
				Axios({
					url: route("reversar"),
					method: "post",
					data: {opp:this.promesa.opp,nodo_actual: this.fields.nodo_actual, reversar: this.fields.nodoAReversar},
				})
				.then(response =>{
					alert("Operación reversada con éxito");
					console.log("listo");
					window.location.replace(this.route("buscar-reversa"));
				});
			}
			else{
				alert("Debe seleccionar Un nodo")
			}
		}
	},
	created: function(){
		EventBus.$on("changePage", page => this.getData(page));
		EventBus.$on("changeShow", show => this.changeShow(show));
	}
};
</script>