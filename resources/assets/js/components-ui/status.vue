<template>
	<p class="mdai-status" :class="statusClass">{{ estado }}</p>
</template>

<script>
export default {
	props: {
		id: { type: [String, Number], required: true },
		estado: { type: String, required: true },
	},
	computed: {
		statusClass: function() {
			switch (this.id.toString()) {
				case "2":
				case "7":
					return "error";
				case "3":
					return "pending";
				case "4":
				case "8":
					return "process";
				case "13":
					return "success";
				case "14":
					return "escriturada";
			}
		},
	},
};
</script>

<style lang="scss" scoped>
	.mdai-status {
		color: #fff;
		display: inline-block;
		padding: 3px 12px;
		border-radius: 6px;
		font-size: 11px;
		text-transform: uppercase;
		text-align: center;
		min-width: 100px;

		&.error {
			background: $color-error;
		}
		&.success {
			background: $color-success;
		}
		&.pending {
			background: $color-pending;
		}
		&.process {
			background: $color-info;
		}
		&.escriturada {
			background: $color-blue;
		}
	}
</style>
