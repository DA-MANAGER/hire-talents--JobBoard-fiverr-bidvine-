<template>
	<div id="businesses-sidebar">
		<div class="navigation">
			<nav class="d-none d-md-block sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item btn-add-business">
							<router-link
								class="text-muted"
								:to="{ name: 'register-business' }"
								@click.native="hideBusinessesSidebar"
							>
								<span class="border-dashed">
									<i class="fas fa-plus"></i>
								</span>
								Add Business
							</router-link>
						</li>
					</ul>

					<h6
						class="sidebar-heading d-flex justify-content-between align-items-center mt-4 mb-1 text-muted"
					>
						<span class="text-uppercase">Recent Businesses</span>
					</h6>

					<ul
						class="nav flex-column mt-4"
						v-if="auth_user !== undefined"
					>
						<li
							class="nav-item"
							v-for="(business, index) in businesses_by_user_id(
								auth_user.id
							)"
							v-bind:key="index"
							v-bind:index="index"
						>
							<router-link
								:to="{
									name: 'single-business',
									params: { id: business.id },
								}"
								@click.native="hideBusinessesSidebar"
							>
								<span v-text="business.name"></span>
							</router-link>
						</li>
					</ul>
				</div>
			</nav>
		</div>

		<div class="background-blur" @click="hideBusinessesSidebar"></div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	computed: {
		...mapGetters("AuthStore", ["auth_user"]),

		...mapGetters("BusinessStore", ["businesses_by_user_id"]),
	},

	async created() {
		let user = this.auth_user;

		if (user === undefined) {
			user = await this.$store.dispatch("AuthStore/authUser");

			this.$store.dispatch("AuthStore/setAuthUser", user);
		}

		await this.$store.dispatch(
			"BusinessStore/fetchBusinessByUserId",
			user.id
		);
	},

	methods: {
		/**
		 * Hides the businesses sidebar from the screen.
		 *
		 * @returns void
		 */
		hideBusinessesSidebar() {
			this.$store.dispatch("OptionStore/toggleBusinessesSidebar", "hide");
		},
	},
};
</script>

<style lang="scss" scoped>
.btn-add-business {
	background-color: #0b0a12;

	span {
		border: 1px dashed;
		margin-right: 10px;
		padding: 5px 7px;
		border-radius: 3px;
	}
}

#businesses-sidebar {
	position: fixed;
	bottom: 0;
	left: 0;
	right: 0;
	top: 0;
	z-index: 99;

	.navigation {
		background-color: #0f0e18;
		box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11),
			0 1px 3px rgba(0, 0, 0, 0.08);
		height: 100vh;
		padding: 20px;
		position: relative;
		width: 260px;
		z-index: 100;

		.nav li {
			border-radius: 5px;

			a {
				display: block;
				padding: 10px;
			}
		}
	}
}
</style>
