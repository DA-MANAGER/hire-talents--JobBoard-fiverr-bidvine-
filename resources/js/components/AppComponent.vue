<template>
	<div id="page"><router-view></router-view></div>
</template>

<script>
export default {
	async created() {
		/**
		 * ----------------------------------------------------------------
		 *  Lights On!
		 * ----------------------------------------------------------------
		 *
		 * Initialize the App by fetching all the default App Options
		 * and setting them into the application. So the application
		 * could adjust itself according to them.
		 *
		 */
		await this.$store.dispatch("OptionStore/fetchAppOptions");

		// Next, fetch and log in the authenticated user into the
		// application if any.
		const is_authenticated = this.$store.getters[
			"AuthStore/is_authenticated"
		];

		if (is_authenticated) {
			const user = await this.$store.dispatch("AuthStore/authUser");

			this.$store.dispatch("AuthStore/setAuthUser", user);

			await this.$store.dispatch(
				"BusinessStore/fetchBusinessByUserId",
				user.id
			);
		}
	},
};
</script>
