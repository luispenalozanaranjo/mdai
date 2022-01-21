<template>
	<div>
		<div class="heading-block mb-24">
			<div class="row align-items-center">
				<div class="col-6">
					<h1 class="heading-1 text-normal">Usuarios</h1>
					<p>{{ $methods.showTotal(content.total, 'usuario', 'usuarios') }}</p>
				</div>
				<div class="col-6 text-right">
					<a :href="route('usuarios.agregar')" class="btn btn-primary btn-action">
						<span class="fa fa-plus mr-4"></span>
						Agregar Usuario
					</a>
				</div>
			</div>
		</div>

		<div class="content-block" v-if="content.total > 0">
			<div class="mb-15 d-none">
				<div class="row align-items-center justify-content-end">
					<div class="col-6">
						<div class="d-flex justify-content-end">
							<mdai-results-show name="usuarios" :total="content.total"></mdai-results-show>
						</div>
					</div>
				</div>
			</div>

			<mdai-table
				:head="['RUT', 'Nombres', 'Apellidos', 'Email', 'Representante Legal', 'Cargo', 'Área', 'Acciones']"
				:body="content.data">
				<template slot-scope="{item}">
					<td>{{ item.rut | rut }}</td>
					<td>{{ item.nombres }}</td>
					<td>{{ (item.apellidos) ? item.apellidos : '' }}</td>
					<td>{{ item.email }}</td>
					<td>
						<span v-if="item.representante_legal" :class="(item.representante_legal === 1 ) ? 'fa fa-check' : ''"></span>
					</td>
					<td>{{ item.cargo.nombre }}</td>
					<td>{{ item.area.nombre }}</td>
					<td>
						<div class="row-actions">
							<a :href="route('usuarios.detalles', item.usuario)">
								<mdai-tooltip text="Editar usuario" position="top">
									<span class="fa fa-edit"></span>
								</mdai-tooltip>
							</a>
						</div>
					</td>
				</template>
			</mdai-table>
		</div>

		<div class="content-block mt-32" v-if="content !== null && content.last_page > 1">
			<mdai-paginador :config="{
				total: content.total,
				per_page: content.per_page,
				current_page: content.current_page,
				last_page: content.last_page
			}">
			</mdai-paginador>
		</div>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				content: null,
				fields: {
					page: 1,
					show: 16
				}
			};
		},
		props: {
			usuarios: { type: Object, required: true }
		},
		methods: {
			changeShow: function(value){
				this.fields.show = value;
				this.getData(1);
			},
			getData: function(page){
				this.$store.commit('toggleAction');
				this.fields.page = page;

				this.$http({
					method: 'get',
					url: route('usuarios.all', this.fields)
				})
				.then(response => {
					this.content = response.data;
				})
				.catch(error => {
					console.log(error);
				})
				.finally(() => {
					setTimeout(() => {
						this.$store.commit('toggleAction');
					}, 100);
				});
			}
		},
		created: function(){
			this.content = this.usuarios;
			EventBus.$on('changePage', page => this.getData(page));
			EventBus.$on('changeShow', show => this.changeShow(show));
		}
	}
</script>