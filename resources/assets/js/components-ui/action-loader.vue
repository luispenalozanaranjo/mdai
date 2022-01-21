<template>
	<div class="action-loader">
		<div class="d-flex h-100 justify-content-center align-items-center">
			<div class="cont">
				<div class="sk-chase">
					<div class="sk-chase-dot"></div>
					<div class="sk-chase-dot"></div>
					<div class="sk-chase-dot"></div>
					<div class="sk-chase-dot"></div>
					<div class="sk-chase-dot"></div>
					<div class="sk-chase-dot"></div>
				</div>
				<p v-if="text !== null" v-text="text"></p>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		props: {
			text: { type: String, default: null }
		}
	}
</script>

<style lang="scss" scoped>
	.action-loader{
		position: fixed;
		left: 0;
		top: 0;
		height: 100%;
		background: rgba(0,0,0,.8);
		width: 100%;
		z-index: 999;

		.cont{
			.sk-chase {
				width: 40px;
				height: 40px;
				display:block;
				margin:auto;
				animation: sk-chase 2.5s infinite linear both;

				.sk-chase-dot {
					width: 100%;
					height: 100%;
					position: absolute;
					left: 0;
					top: 0; 
					animation: sk-chase-dot 2.0s infinite ease-in-out both;

					&:nth-child(1) { animation-delay: -1.1s; }
					&:nth-child(2) { animation-delay: -1.0s; }
					&:nth-child(3) { animation-delay: -0.9s; }
					&:nth-child(4) { animation-delay: -0.8s; }
					&:nth-child(5) { animation-delay: -0.7s; }
					&:nth-child(6) { animation-delay: -0.6s; }
					&:nth-child(1):before { animation-delay: -1.1s; }
					&:nth-child(2):before { animation-delay: -1.0s; }
					&:nth-child(3):before { animation-delay: -0.9s; }
					&:nth-child(4):before { animation-delay: -0.8s; }
					&:nth-child(5):before { animation-delay: -0.7s; }
					&:nth-child(6):before { animation-delay: -0.6s; }

					&:before{
						content: '';
						display: block;
						width: 25%;
						height: 25%;
						background-color: #fff;
						border-radius: 100%;
						animation: sk-chase-dot-before 2.0s infinite ease-in-out both; 
					}
				}
			}

			p{
				display:block;
				color:#fff;
				margin-top:15px;
			}
		}
	}

	@keyframes sk-chase {
		100% { transform: rotate(360deg); } 
	}

	@keyframes sk-chase-dot {
		80%, 100% { transform: rotate(360deg); } 
	}

	@keyframes sk-chase-dot-before {
		50% {
			transform: scale(0.4); 
		} 100%, 0% {
			transform: scale(1.0); 
		} 
	}
</style>