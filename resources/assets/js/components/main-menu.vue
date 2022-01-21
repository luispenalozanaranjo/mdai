<template>
<div v-show="!isMobileViewport">
	<div class="main-menu" :class="{open: menuOpen}">
		<aside>
			<div class="menu-toggle" @click.prevent="toggleMenu">
				<span></span>
				<span></span>
				<span></span>
			</div>

			<a :href="route('dashboard')" class="d-inline-block main-logo">
				<figure>
					<img :src="logo" alt="Logo MDA">
				</figure>
			</a>

			<nav class="menu">
				<ul>
					<li v-for="(item, index) in newMenu" :key="index" :class="{ active: active(item.route) }">
						<a :href="item.route ? route(item.route) : '#'" @mouseover="newMenu[index].hover = true" @mouseleave="newMenu[index].hover = false">
							<span class="fa" :class="item.icon"></span>
							<transition name="fade">
								<span class="nav-text" v-show="menuOpen">{{ item.name }}</span>
							</transition>

							<transition name="fade">
								<span class="tooltip" v-if="menu[index].hover && !menuOpen" :class="{large: item.name.length > 15}">
									{{ item.name }}
								</span>
							</transition>
						</a>
					</li>
				</ul>
			</nav>
		</aside>
	</div>
	<transition name="fade">
		<div class="overlay" v-if="menuOpen" @click.prevent="menuOpen = false"></div>
	</transition>
</div>
</template>

<script>
	export default{
		data: function(){
			return {
				menuOpen: false,
				newMenu: this.menu
			};
		},
		props: {
			logo: { type: String, required: true },
			menu: { required: true }
		},
		methods: {
			active: function(route){
				let current = this.route().current();
				return ( current === route );
			},
			toggleMenu: function(){
				this.menuOpen = !this.menuOpen;
			}
		}
	}
</script>

<style scoped lang="scss">
.overlay{
	position:fixed;
	left:0;
	top:0;
	width:100%;
	height:100vh;
	background:rgba(0,0,0,.7);
	z-index: 10;
	backdrop-filter:blur(6px)
}

.main-menu{
	top:0;
	left:0;
	position:fixed;
	background:#313a46;
	height:100%;
	z-index:11;
	padding-top:90px;
	width: 62px;
	@include transition;

	&.open{
		width: 320px;

		aside{
			.main-logo{opacity:1;}
			.menu{
				ul{
					li{
						width:calc(100% - 16px);
					}
				}
			}
		}

		.menu-toggle{
			span{
				opacity: 1;
				transform: rotate(45deg) translate(-6px, -10px);

				&:nth-last-child(2){
					transform: rotate(-45deg) translate(-4px, 10px);
				}

				&:nth-last-child(3){
					opacity: 0;
					transform: rotate(0deg) scale(0.2, 0.2);
				}
			}
		}
	}

	.menu-toggle{
		display: inline-block;
		position: absolute;
		left: 18px;
		top: 22px;
		cursor:pointer;
		@include transition;

		&:hover{
			opacity: .6;
		}

		span{
			display: block;
			width: 26px;
			height: 3px;
			margin-bottom: 4px;
			position: relative;
			background: #fff;
			border-radius: 4px;
			z-index: 1;
			transform-origin: 4px 0px;
			transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
						background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
						opacity 0.55s ease;

			&:first-child{
				transform-origin: 0% 0%;
			}

			&:nth-last-child(2){
				transform-origin: 0% 100%;
			}
		}
	}

	aside{
		height:100%;
		@include transition;

		.main-logo{
			position:absolute;
			top:16px;
			left:88px;
			max-width:120px;
			opacity:0;
			@include transition;

			img{
				height:32px;
				width: auto;
			}
		}

		.menu{
			width:100%;
			ul{
				li{
					display:block;
					width:45px;
					margin:0 8px 8px;
					@include transition;

					&:last-of-type{
						margin-bottom:0;
					}

					&.active, &:hover{
						a{
							background:#262e36; 
							color:#fff;
						}
					}

					&:hover{
						.tooltip{opacity:1;}
					}

					a{
						padding:8px 6px;
						border-radius:6px;
						display:block;
						color:rgba(255,255,255,.4);
						font-size:14px;
						user-select: none;
						position:relative;
						@include transition;

						.nav-text{
							position: absolute;
							top: 0;
							bottom: 0;
							margin: auto;
							height: 16px;
							width: 200px;
							display: block;
							left: 48px;
						}

						.tooltip{
							position: absolute;
							left: 100%;
							z-index: 999;
							margin-left: 24px;
							cursor: pointer;
							background: #313a46;
							padding: 8px 12px;
							border-radius: 6px;
							display: block;
							top: 8px;
							font-size: 13px;
							color: #fff;
							// opacity: 0;
							@include transition;

							&.large{
								min-width:140px;
							}

							&:after{
								content: "";
								width: 0;
								height: 0;
								border-top: 6px solid transparent;
								border-bottom: 6px solid transparent;
								border-right: 6px solid #313a46;
								position: absolute;
								left: -6px;
							}
						}

						span.fa{
							width: 32px;
							height: 32px;
							display: inline-block;
							vertical-align: middle;
							font-size: 16px;
							padding: 7px 0;
							text-align: center;
							margin-right: 8px;
						}
					}
				}
			}
		}
	}
}
</style>
