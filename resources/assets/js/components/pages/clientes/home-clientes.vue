<template>
	<div>
		<div class="heading-block mb-24">
			<div class="row align-items-end">
				<div class="col-12 col-sm-6">
					<h1 class="heading-1 text-normal">Clientes</h1>
					<p>{{ $methods.showTotal(content.total, 'cliente', 'clientes') }}</p>
				</div>
				<div class="col-6 d-none">
					<div class="d-flex justify-content-end">
						<mdai-results-show name="clientes"></mdai-results-show>
					</div>
				</div>
			</div>
		</div>

		<div class="content-block" v-if="content.total > 0">
			<mdai-table
				:head="['RUT', 'Nombres', 'Apellidos', 'Ejecutivo', 'Acciones']"
				:body="content.data">
				<template slot-scope="{item}">
					<td>{{ item.rut_cliente | rut }}</td>
					<td>{{ item.primer_nombre | capitalize }} {{ (item.segundo_nombre) ? item.segundo_nombre : '' | capitalize }}</td>
					<td>{{ item.apellido_paterno | capitalize }} {{ (item.apellido_materno) ? item.apellido_materno : '' | capitalize }}</td>
					<td>{{ item.ejecutivo | capitalize }}</td>
					<td>
						<div class="row-actions">
							<a :href="route('clientes.detalles', item.rut_cliente)">
								<mdai-tooltip text="Ver detalles" position="top">
									<span class="fa fa-eye"></span>
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
			}" />
		</div>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				pages: [],
				content: null,
				maxVisibleButtons: 5,
				fields: {
					page: 1,
					show: 16
				}
			};
		},
		props: {
			data: { type: Object, required: true }
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
					url: route('clientes.all', this.fields)
				})
				.then(response => {
					this.content = response.data;
				})
				.catch(error => {
					console.error(error);
				})
				.finally(() => {
					setTimeout(() => {
						this.$store.commit('toggleAction');
					}, 100);
				});
			}
		},
		created: function(){
			this.content = this.data;
			EventBus.$on('changePage', page => 	this.getData(page));
			EventBus.$on('changeShow', show => this.changeShow(show));
		}
	}
</script>