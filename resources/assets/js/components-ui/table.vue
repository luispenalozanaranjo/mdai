<template>
	<div class="table" :class="[classController, headStyle]" v-if="head && body">
		<div class="table-content">
			<table>
				<thead v-if="head">
					<tr>
						<th v-for="(th, index) in head" :key="index" :class="typeof th === 'object' ? th.class : false">
							{{ typeof th === 'object' ? th.id : th }}
						</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(td, index) in body" :key="index">
						<slot :item="td" :index="index"></slot>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default{
		computed: {
			classController: function(){
				return{
					stripped: this.stripped,
					hover: this.hover
				}
			}
		},
		props: {
			head: { type: [Array, Boolean], default: false },
			body: { type: [Array, Boolean], default: false },
			headStyle: { type: String, default: '' },
			stripped: { type: Boolean, default: true },
			hover: { type:Boolean, default: false }
		}
	}
</script>

<style lang="scss" scoped>
.table{
	border-radius:6px;
	overflow: hidden;
	min-width:100%;
	@include box();

	.table-content{
		overflow: auto;
		table{
			width: 200%;

			@media screen and (min-width: $break-sm){
				width: 100%;
			}
		}
	}

	&.stripped{
		table{
			tbody{
				tr:nth-child(2n){
					td{background:#f9f9f9;}
				}
			}
		}
	}

	table{
		width:100%;
		background:#fff;

		thead{
			tr{
				th{
					background:#A3ACB8;
					font-size:13px;
					text-transform:uppercase;
					color: #fff;
					text-align: left;
					padding:16px;
					// border-bottom:1px solid #ddd;
					vertical-align: middle;
					font-family: 'Rubik', sans-serif;
				}
			}
		}
		tbody{
			tr{
				&:hover{
					td{
						background:#f5fafb !important;
					}
				}

				td{
					font-size: 14px;
					color: $color-text;
					text-align: left;
					padding: 10px 16px;
					border-bottom: 1px solid #eee;
					line-height: normal;
					max-width: 250px;
					vertical-align: middle;
					@include transition;

					.row-actions{
						> a{
							display: inline-block;
							vertical-align: middle;
							margin-right: 12px;
							&:last-of-type{margin-right:0;}
						}
					}
				}

				&:last-of-type{
					td{
						border-bottom:none;
						// padding-bottom:0;
					}
				}
			}
		}
	}
}
</style>