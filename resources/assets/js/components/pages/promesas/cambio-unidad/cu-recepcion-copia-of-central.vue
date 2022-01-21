<template>
 <div v-cloak>
		<div class="content-block">
			<form @submit.prevent="submit">
				<mdai-box :title="data.nodo.subactividad">
					<template slot="content">
						<div class="row total align-items-center">
							
							<div class="col-6">
								<div class="input-cont">
									<label class="label">Observaciones</label>
									<div class="cont">
										<textarea></textarea>
									</div>
								</div>
							</div>
						</div>
					</template>
					<template slot="action">
						<div class="btn-holder">
							<div class="row total mini align-items-center">
								<div class="col-6">
									<a :href="route('detalle-promesa', data.promesa.opp)" class="text-link">
										<span class="fa fa-chevron-left mr-5"></span>
										Volver atrás
									</a>
								</div>
								<div class="col-6">
									<div class="text-right">
										<button type="submit" class="btn btn-secondary">
											Guardar
										</button>
										<button type="button" class="btn btn-primary">
											Terminar
										</button>
									</div>
								</div>
							</div>
						</div>
					</template>
				</mdai-box>
			</form>
		</div>
	</div>
</template>

<script>
export default {

    props: {
			data: { type: [Object], required: true }
		},
		created: function(){
			console.log(this.data);
		},
		methods: {
			submit: function(){
				console.log('submit');
			}
		}

}
</script>

<style>

</style>