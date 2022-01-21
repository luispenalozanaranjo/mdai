<template>
	<div class="user-profile">
		<div class="user-cont d-flex align-items-center justify-content-center" @click.prevent="toggleOpts">
			<div class="user-image mr-16 d-flex align-items-center justify-content-center" :class="getBackground">
				<!-- <img src="http://placehold.it/100x100" alt="Usuario"> -->
				<span v-text="getIniciales"></span>
			</div>
			<div class="user-info">
				<p class="fw-semibold">
					{{ user.nombre_corto }}
					<span class="fa fa-caret-down ml-8"></span>
				</p>
				<span>{{ user.cargo }}</span>
			</div>
		</div>

		<transition name="fade">
			<div class="profile-opts" v-if="active">
				<div class="profile-opts-cont">
					<h5>Menú de usuario</h5>
					<ul>
						<li><a :href="route('usuarios.perfil')"><h6>Datos personales</h6></a></li>
						<li><a :href="route('logout')"><h6>Cerrar sesión</h6></a></li>
					</ul>
				</div>
			</div>
		</transition>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				active: false
			};
		},
		props: {
			user: { type: Object, required: true }
		},
		computed: {
			getBackground: function(){
				let backgrounds = ['bg-orange', 'bg-cyan', 'bg-green', 'bg-purple', 'bg-yellow', 'bg-dark-blue'];
				let index = this.getHash(this.getIniciales);
				return backgrounds[index] !== undefined ? backgrounds[index] : backgrounds[0];
			},
			getIniciales: function(){
				let first = this.user.nombre.charAt(0);
				let second = ( this.user.apellido ) ? this.user.apellido.charAt(0) : '';
				return first+second;
			}
		},
		methods: {
			toggleOpts: function(){
				this.active = !this.active;
			},
			getHash: function(input){
				let hash = 0, len = input.length;

				for( let i = 0; i < len; i++ ){
					hash = ((hash << 5) - hash) + input.charCodeAt(i);
					hash |= 0;
				}

				let string = hash.toString();
				if( string.length === 2 ) return parseInt(string.charAt(1));
				if( string.length === 4 ) return parseInt(string.charAt(2));
				return hash;
			}
		}
	}
</script>

<style lang="scss" scoped>
	.user-profile{
		padding-left: 24px;

		.user-cont{
			position:relative;
			&:after{
				content:"";
				height: 60%;
				position:absolute;
				left:-16px;
				top:50%;
				bottom:50%;
				margin:auto;
				border-left:1px solid #eee;
			}

			.user-image{
				width:38px;
				height:38px;
				position:relative;
				overflow: hidden;
				border-radius:100%;
				// background:#f5f5f5;

				span{
					font-size:14px;
					color:#fff;
				}

				img{
					position:absolute;
					left:-50%;
					right:-50%;
					top:-50%;
					bottom:-50%;
					margin:auto;
					min-width:100%;
				}
			}

			.user-info{
				p{line-height:12px;}
				span{
					color:#aaa;
					font-size:11px;
				}
			}
		}
	}

	.user-cont{
		position:relative;
		cursor:pointer;
	}

	.profile-opts{
		position: absolute;
		width: 250px;
		right: 15px;
		z-index:99;
		margin-top: 32px;

		&:after{
			content:"";
			width: 0; 
			height: 0; 
			border-left: 10px solid transparent;
			border-right: 10px solid transparent;
			border-bottom: 10px solid #fff;
			display: block;
			position: absolute;
			right: 18px;
			top: -10px;
		}

		&-cont{
			background: #fff;
			box-shadow: 0px 4px 10px 4px rgba(0, 0, 0, .08);
			border-radius: 4px;
			overflow:hidden;

			h5{
				padding: 12px;
				font-size: 12px;
				text-transform: uppercase;
				color:#999;
			}

			ul{
				li{
					border-bottom:1px solid #eee;

					a{
						padding:12px 20px 12px 12px;
						font-size: 14px;
						color: #555;
						display:block;
						@include transition;
						position:relative;

						&:hover{
							background:#f9f9f9;
						}
					}

					&:last-of-type{border-bottom:0;}
				}
			}
		}
	}
</style>