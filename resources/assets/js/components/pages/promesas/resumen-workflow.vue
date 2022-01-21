<template>
	<div class="mt-32" v-if="reverse">
		<div class="content-block mt-32" v-for="(etapa, index) in reverse" :key="index">
			<div class="" v-if="etapa.length">
				<h2 class="heading-5 mb-16" v-text="index"></h2>
				<mdai-table
					:head="['Estado inicio', 'Estado destino', 'Fecha entrada', 'Fecha término', 'Usuario término', 'Estado', 'Acciones']"
					:body="etapa"
				>
					<template slot-scope="{ item }">
						<td>{{ item.nodo.num_nodo }} - {{ item.nodo.subactividad }}</td>
						<td v-if="item.siguiente.num_nodo =='0'">Finalizado</td>
						<td v-else-if="promesamarca.marca == 'Privado' && item.siguiente.num_nodo =='471'">
							511 - Estado escrituración
						</td>
						<td v-else-if="promesamarca.marca == 'Vulnerable' && item.siguiente.num_nodo =='471'">
							500 - Confección de carpeta
						</td>
						<td v-else-if="promesamarca.marca == 'Medio' && item.siguiente.num_nodo =='471'">
							500 - Confección de carpeta
						</td>
						<td v-else-if="promesamarca.marca == 'Medio' && item.siguiente.num_nodo =='501'">
							510 - Nominación y Adjudicación
						</td>
						<td v-else-if="promesamarca.marca == 'Vulnerable' && item.siguiente.num_nodo =='501'">
							510 - Nominación y Adjudicación
						</td>
						<td v-else-if="promesamarca.marca == 'Vulnerable' && item.siguiente.num_nodo =='512'">
							520 - Orden para escriturar área legal
						</td>
						<td v-else-if="promesamarca.marca == 'Medio' && item.siguiente.num_nodo =='512' && promesamarca.tipo_credito == 'Contado'">
							520 - Orden para escriturar área legal
						</td>
						<td v-else-if="promesamarca.marca == 'Medio' && item.siguiente.num_nodo =='512' && promesamarca.tipo_credito == 'Gestión Propia'">521 - Orden para escriturar con banco cliente</td>
						<td v-else-if="promesamarca.marca == 'Medio' && item.siguiente.num_nodo =='512' && promesamarca.tipo_credito == 'Gestión MDAI' ">521 - Orden para escriturar con banco cliente</td>
						<td v-else-if="promesamarca.marca == 'Privado' && item.siguiente.num_nodo =='512' && promesamarca.tipo_credito == 'Contado' "
						>520 - Orden para escriturar área legal</td>
						<td v-else-if="promesamarca.marca == 'Privado' && item.siguiente.num_nodo =='512' && promesamarca.tipo_credito == 'Gestión Propia' "
						>521 - Orden para escriturar con banco cliente</td>
						<td v-else-if="promesamarca.marca == 'Privado' && item.siguiente.num_nodo =='512' && promesamarca.tipo_credito == 'Gestión MDAI' "
						>521 - Orden para escriturar con banco cliente</td>
						<td v-else-if="promesamarca.marca == 'Vulnerable' && item.siguiente.num_nodo =='571'"
						>580 - Egreso de carpeta del CBR</td>
						<td v-else-if="promesamarca.marca != 'Vulnerable' && promesamarca.tipo_credito =='Contado' && item.siguiente.num_nodo =='571'"
						>580 - Egreso de carpeta del CBR</td>
						<td v-else-if="promesamarca.marca != 'Vulnerable' && promesamarca.tipo_credito !='Contado' && item.siguiente.num_nodo =='571'"
						>581 - Egreso de carpeta del CBR</td>
						<td v-else>{{ (item.siguiente) ? item.siguiente.num_nodo +' - ' + item.siguiente.subactividad : '-'}}</td>
						<td>{{ item.created_at }}</td>
						<td>{{ (item.fecha_salida) ? item.fecha_salida : '-' }}</td>
						<td>
							<span v-if="item.terminado">{{ item.terminado.nombres }} {{ item.terminado.apellidos }}</span>
							<span v-else>-</span>
						</td>
						<td>
							<mdai-status
								v-if="nodosInactivos.indexOf(item.nodo.num_nodo) === -1"
								:id="item.estados.id"
								:estado="item.estados.descripcion"
							></mdai-status>
							<span v-else>-</span>
						</td>
						<td>
							<div class="row-actions" v-if="hasActions(item.nodo.num_nodo)">
								<a :href="route('nodo', { opp: promesa, idNodo: item.nodo.num_nodo })" class="f-16">
									<mdai-tooltip :text="(item.estados.id !== 13) ? 'Actualizar' : 'Revisar'" position="top">
										<span class="fa" :class="(item.estados.id !== 13) ? 'fa-edit' : 'fa-eye'"></span>
									</mdai-tooltip>
								</a>
							</div>
							<span v-else>-</span>
						</td>
					</template>
				</mdai-table>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			nodosInactivos: [172, 99, 999, 1000],
		};
	},
	props: {
		promesa: { type: Number, required: true },
		etapas: { type: [Object, Array], required: true },
		promesamarca: { type: [Array, Object], required: true },
	},
	computed: {
		reverse: function () {
			let newObj = {};
			let indexes = [];

			Object.entries(this.etapas).forEach(([key, values]) => {
				// Recorremos las etapas buscando el indice
				indexes.push(key);
			});

			let desc = indexes.sort(function (a, b) {
				// Ordenamos el indice de mayor a menor
				return b - a;
			});

			desc.forEach((item) => {
				// Recorremos el array y creamos el nuevo objeto
				newObj["Flujo " + item] = this.etapas[item];
			});

			return newObj;
		},
	},
	methods: {
		hasActions: function (num_nodo) {
			return this.nodosInactivos.indexOf(num_nodo) === -1 ? true : false;
		}
	},
	created: function(){
		//agregamos un nodo siguiente al 1000 para evitar error en if de la vista
		if (this.etapas["4"]) {
			this.etapas["4"].forEach((nodo) => {
				if (nodo.nodo.num_nodo == 1000) {
					nodo.siguiente = { num_nodo: 0 };
				}
			});
		}

		if( this.etapas["Entrega Unidad"] ){
			this.etapas["Entrega Unidad"].forEach((nodo) => {
				if (nodo.nodo.num_nodo == 591) {
					nodo.siguiente = { num_nodo: 0 };
				}
			});
		}
	},
};
</script>