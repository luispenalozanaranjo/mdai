<template>
	<div class="container h-100">
		<div class="row align-items-center justify-content-center h-100">
			<div class="col-12 col-sm-5">
				<div class="box p-32">
					<figure class="w-35 full center">
						<img src="/images/logo-mda.png" alt="Logo MDA">
					</figure>
					
					<div class="text-center my-32">
						<h1 class="heading-2 text-normal mb-4">Workflow Hipotecario</h1>
						<p>Ingresa tus datos para ingresar a la plataforma.</p>
					</div>

					<form class="form" id="login-form" @submit.prevent="login">
						<div class="input-cont" :class="{active: fields.usuario}">
							<span class="fa fa-user icon d-flex align-items-center justify-content-center"></span>
							<input type="text" name="username" required v-model="fields.usuario">
							<label class="label">Nombre de usuario</label>
						</div>
						<div class="input-cont" :class="{active: fields.password}">
							<span class="fa fa-lock icon d-flex align-items-center justify-content-center"></span>
							<input type="password" name="password" required v-model="fields.password">
							<label class="label">Contraseña</label>
						</div>
						<div class="input-cont">
							<mdai-btn-action class="btn-primary full" text="Ingresar" v-model="doLogin" @action="login"></mdai-btn-action>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				doLogin: false,
				fields: {
					usuario: null,
					password: null
				}
			};
		},
		methods: {
			login: function(){
				console.log('wa');
				if( !this.doLogin ){
					// Si la accion es false continuamos
					this.doLogin = true;

					this.$http.post('/login', this.fields)
					.then(response =>{
						const data = response.data;

						if( data.login ){
							window.location.href = this.route(data.route);
						}
						else{
							this.doLogin = false;
							this.$store.commit('enableToast', {
								text: data.msg,
								type: 'error'
							});
						}
					});
				}
			}
		}
	}
</script>

<style lang="scss" scoped>
#login-form{
	.input-cont{
		.icon{
			position: absolute;
			left: 16px;
			top: 0;
			color:#aaa;
			bottom: 0;
			margin: auto;
			height: 24px;
			font-size: 17px;
			display: block;
			border-right: solid 1px #aaa;
			padding-right: 16px;
		}

		input{
			padding-left: 60px;

			~ .label{
				left:60px;
			}
		}
	}	
}
</style>