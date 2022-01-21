<template>
	<div v-if="reverse">
		<div class="content-block" v-for="(etapa, index) in reverse" :key="index">
			<mdai-box :title="index">
				<template slot="content">
					<div class="table">
						<table>
							<thead>
								<tr>
									<th>Estado inicio</th>
									<th>Estado destino</th>
									<th>Fecha entrada</th>
									<th>Fecha término</th>
									<th>Usuario término</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(item, i) in etapa" :key="i">
									<td>{{ item.nodo.num_nodo }} - {{ item.nodo.subactividad }}</td>
									<td>{{ (item.siguiente) ? item.siguiente.num_nodo  +' - ' + item.siguiente.subactividad : '-'}}</td>
									<td>{{ item.created_at }}</td>
									<td>{{ (item.fecha_salida) ? item.fecha_salida : '-' }}</td>
									<td>
										<span v-if="item.terminado">
											{{ item.terminado.nombres }} {{ item.terminado.apellidos }}
										</span>
										<span v-else>-</span>
									</td>
									<td>
										<mdai-status :id="item.estados.id" :estado="item.estados.descripcion"></mdai-status>
									</td>
									<td>
										<div class="row-actions">
											<a :href="route('excepcion.detalle', { id: item.id_excepcion, detalle: item.id })" class="f-16">
												<mdai-tooltip :text="(item.estados.id !== 13) ? 'Actualizar' : 'Revisar'" position="top">
													<span class="fa" :class="(item.estados.id !== 13) ? 'fa-edit' : 'fa-eye' "></span>
												</mdai-tooltip>
											</a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</template>
			</mdai-box>
		</div>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
			};
		},
		props: {
			promesa: { type: String, required: true },
			flujo: { type: [Object, Array], required: true }
		},
		computed: {
			reverse: function(){
				let newObj = {};
				let indexes = [];

				Object.entries(this.flujo).forEach(([key, values]) => {
					// Recorremos las etapas buscando el indice
					indexes.push(key);
				});

				let desc = indexes.sort(function(a,b){
					// Ordenamos el indice de mayor a menor
					return b - a;
				});

				desc.forEach((item) => {
					// Recorremos el array y creamos el nuevo objeto
					newObj['Flujo ' + item] = this.flujo[item];
				});

				return newObj;
			}
		},
		created: function(){
			console.log('promesa =>', this.promesa);
			console.log('flujo =>', this.flujo);
		}
	}
</script>