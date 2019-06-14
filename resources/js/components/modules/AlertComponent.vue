<template>
	<div v-bind:class="error_class" role="alert">
		<p class="card-text" v-html="error.message"></p>
	</div>
</template>

<script>
export default {
	computed: {
		error_class() {
			return "alert alert-" + this.error.type;
		},
	},

	props: {
		error: {
			default() {
				return { message: "", type: "success" };
			},
			type: Object,
			validator(value) {
				return (
					["danger", "success", "warning"].indexOf(value.type) !== -1
				);
			},
		},
	},
};
</script>
