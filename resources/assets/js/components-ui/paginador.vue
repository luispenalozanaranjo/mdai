<template>
	<nav class="pagination">
		<p class="mb-12 f-12">
			Mostrando {{ config.per_page }} de {{ config.total }} resultados | Página {{ current_page }} de {{ last_page }}
		</p>
		<div class="nav-cont">
			<ul class="d-flex">
				<li class="page-item first" :class="{ disabled: current_page === 1 }">
					<button type="button" title="Primera página" @click.prevent="(current_page > 1) ? changePage(1) : false">
						<span class="fa fa-step-backward"></span>
					</button>
				</li>
				<li class="page-item prev" :class="{ disabled: current_page === 1 }">
					<button type="button" title="Página anterior" @click.prevent="(current_page > 1) ? changePage(current_page - 1) : false">
						<span class="fa fa-chevron-left"></span>
					</button>
				</li>
				<li class="page-item" :class="{active: current_page === pageNumber}" v-for="(pageNumber, index) in computedPages" :key="index">
					<button type="button" :title="'Página ' + pageNumber" @click.prevent="( current_page !== pageNumber ) ? changePage(pageNumber) : false">
						{{ pageNumber }}
					</button>
				</li>
				<li class="page-item next" :class="{ disabled: current_page === last_page }"> 
					<button type="button" title="Siguiente página" @click.prevent="(current_page < last_page) ? changePage(current_page + 1) : false">
						<span class="fa fa-chevron-right"></span>
					</button>
				</li>
				<li class="page-item last" :class="{ disabled: current_page === last_page }">
					<button type="button" title="Última página" @click.prevent="( current_page < last_page ) ? changePage(last_page) : false">
						<span class="fa fa-step-forward"></span>
					</button>
				</li>
			</ul>
		</div>
	</nav>
</template>

<script>
	export default{
		data: function(){
			return {
			};
		},
		props: {
			config: { type: Object, required: true }
		},
		methods: {
			changePage: function(page){
				EventBus.$emit('changePage', page);
			}
		},
		computed: {
			current_page: function(){
				return this.config.current_page;
			},
			last_page: function(){
				return this.config.last_page;
			},
			computedPages: function(){
				let prev = this.config.current_page - 1;
				let prevCheck = prev <= 1 ? 0 : prev;
				return this.pages.slice((this.config.current_page <= 3) ? prevCheck : this.config.current_page - 4, this.config.current_page + 3);
			},
			pages: function(){
				let pages = [];
				let numberOfPages = this.config.last_page;
				for (let index = 1; index <= numberOfPages; index++) {
					pages.push(index);
				}
				return pages;
			}
		}
	}
</script>

<style lang="scss" scoped>
.pagination{
	text-align:center;

	.nav-cont{
		text-align: center;
		overflow:hidden;
		display:inline-block;
		@include box;

		ul{
			li{
				border-right: 1px solid #eee;
				&:last-of-type{border-right:0;}

				&.active{
					button{
						color:$color-primary;
						cursor:default;
					}
				}

				&.disabled{
					button{
						color:#ddd;
						cursor: not-allowed;
					}
				}

				&:not(.disabled){
					button{
						&:hover{
							background:#f9f9f9;
						}
					}
				}

				button{
					width: 40px;
					display: block;
					font-size: 13px;
					color:#555;
					background:#fff;
					padding: 12px 5px;
					border:none;
					@include transition;
					cursor: pointer;
				}
			}
		}
	}
}
</style>