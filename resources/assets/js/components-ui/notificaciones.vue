<template>
	<div v-cloak>
		<div class="notifications-holder" ref="notifications">
			<div class="notifications">
				<span class="fa fa-bell icon" @click.prevent="toggleNotifications" ref="icon"></span>
				<div class="count d-flex align-items-center justify-content-center" v-if="news && news.length">
					<span>{{ news.length > 99 ? '99+' : news.length }}</span>
				</div>
			</div>
			<transition name="fade">
				<div class="notifications-list" v-if="active">
					<div class="notifications-list-cont">

						<div class="notifications-head">
							<h5 v-if="news.length">Notificaciones no leídas ({{ news.length }})</h5>
							<h5 v-else>Notificaciones ({{ notifications.length }})</h5>
						</div>

						<div class="notificacion-cont" v-if="news && news.length">
							<ul>
								<li v-for="(item, index) in showNew" :key="index" class="new">
									<a :href="item.url" v-if="index < 4">
										<h6 class="notification-title">{{ item.titulo}}</h6>
										<p>{{ item.detalle }}</p>
										<span class="new" v-if="item.estado === 0"></span>
									</a>
								</li>
							</ul>
						</div>

						<div class="notificacion-cont" v-if="notifications && notifications.length">
							<ul>
								<li v-for="(item, index) in showNotifications" :key="index">
									<a :href="item.url">
										<h6 class="notification-title">{{ item.titulo}}</h6>
										<p>{{ item.detalle }}</p>
									</a>
								</li>
							</ul>
						</div>

						<a :href="route('notificaciones.home')" class="show-all" v-if="news.length > 4 || notifications.length > 4">
							Ver todas
						</a>
						<p v-if="!news.length && !notifications.length">No tienes notificaciones.</p>
					</div>
				</div>
			</transition>
		</div>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				active: false,
				notifications: null,
				news: null
			};
		},
		props: {
			user: { type: [Array, Object], required: true }
		},
		computed: {
			showNotifications: function(){
				// Retornamos la lista reducida de notificaciones
				return (this.notifications && this.notifications.length > 4 ) ? this.notifications.slice(0, 5) : this.notifications;
			},
			showNew: function(){
				// Retornamos la lista reducida de notificaciones
				return ( this.news && this.news.length > 4 ) ? this.news.slice(0, 4) : this.news;
			}
		},
		methods: {
			toggleNotifications: function(){
				this.active = !this.active;
			},
			getNotifications: function(cb = () => {}){
				this.$http.get( route('notificaciones.all', {idUsuario: this.user.id}) )
				.then(response => {
					var response = response.data;
					if( response ){
						let news = response.filter(item => {
							// Filtramos las notificaciones sin leer
							return item.estado === 0;
						});
						this.news = news;

						let read = response.filter(item => {
							// Filtramos las notificaciones leidas
							return item.estado === 1;
						});
						this.notifications = read;
					}
				});
			},
			checkClose: function(event){
				var parents = this.$methods.getParents( event.target);
				var holder = false;

				parents.forEach((item) => {
					if( item == this.$refs.notifications ){
						holder = true;
					}
				});

				if( !holder ){
					this.active = false;
				}
			}
		},
		created: function(){
			this.getNotifications();
		},
		mounted: function(){
			window.addEventListener('click', this.checkClose);
		}
	}
</script>

<style lang="scss" scoped>
@import './resources/assets/sass/mixins.scss';
@import './resources/assets/sass/variables.scss';

.notifications-holder{
	position:relative;

	.notifications{
		position:relative;

		.icon{
			font-size:30px;
			color: #999;
			cursor:pointer;
			@include transition;

			&:hover{
				color:#777;
			}
		}

		.count{
			width: 24px;
			height: 24px;
			display: block;
			text-align: center;
			font-size: 11px;
			color:#fff;
			background:#D94F5C;
			border-radius: 100%;
			top: -4px;
			position: absolute;
			right: -16px;
		}
	}

	.notifications-list{
		position: absolute;
		width: 300px;
		right: -16px;
		z-index:99;
		margin-top: 26px;

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
			border-radius: 5px;
			overflow:hidden;

			.notifications-head{
				padding: 10px;

				h5{
					font-size: 12px;
					text-transform: uppercase;
					color:#999;
				}
				p{font-size:10px;text-transform: uppercase;}
			}

			.show-all{
				display: block;
				text-align: center;
				padding: 10px;
				text-transform: uppercase;
				font-size: 11px;
				border-top: 1px solid #eee;
				color: #555;
				@include transition;

				&:hover{
					color:$color-primary;
				}
			}

			$padding: 10px 40px 10px 10px;
			> p{padding:$padding;}

			ul{
				li{
					border-bottom:1px solid #eee;

					&.new{
						a{ background:#f3f8fd;
							&:hover{
								background:#f3f8fd;
							}
						}
					}

					a{
						padding:$padding;
						display:block;
						@include transition();
						position:relative;

						&:hover{
							background:#f9f9f9;
						}

						h6{
							font-size:14px;
							display:block;
							margin-bottom:5px;
							color:#555;
						}
						p{
							font-size:12px;
							color:#888;
						}
						.new{
							width:5px;
							height:5px;
							background:red;
							border-radius:100%;
							right:20px;
							top:0;
							bottom:0;
							margin:auto;
							display:block;
							position:absolute;
						}
					}

					&:last-of-type{border-bottom:0;}
				}
			}
		}
	}
}
</style>