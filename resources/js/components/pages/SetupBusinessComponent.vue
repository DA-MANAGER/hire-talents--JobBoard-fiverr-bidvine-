<template>
	<div>
		<header-component></header-component>

		<content-component>
			<div class="container-fluid">
				<router-view
					v-on:business-registered="businessRegistered"
					v-on:business-description-updated="$router.push(nextRoute);"
					v-on:business-services-updated="$router.push(nextRoute);"
					v-on:business-localization-updated="
						$router.push(nextRoute);
					"
					v-on:business-avatar-updated="$router.push(nextRoute);"
					v-on:business-account-confirmation-updated="
						$router.push(nextRoute);
					"
					v-on:business-profile-updated="$router.push(nextRoute);"
				></router-view>
			</div>
		</content-component>

		<footer-component></footer-component>

		<businesses-sidebar-component
			v-if="display_businesses_sidebar"
		></businesses-sidebar-component>
	</div>
</template>

<script>
import { mapGetters } from "vuex";

import BusinessesSidebarComponent from "./../modules/BusinessesSidebarComponent.vue";
import ContentComponent from "./../modules/ContentComponent.vue";
import FooterComponent from "./../modules/FooterComponent.vue";
import HeaderComponent from "./../modules/HeaderComponent.vue";

export default {
	components: {
		BusinessesSidebarComponent,
		ContentComponent,
		FooterComponent,
		HeaderComponent,
	},

	computed: {
		routes() {
			/**
			 * Cache the route so the whole process doesn't need to
			 * perform all over again when the routes property is
			 * accessed.
			 */
			if (this.routes_cache === undefined) {
				this.routes_cache = this.$router.options.routes.find(
					route => route.name === "setup-business"
				);
			}

			return this.routes_cache.children;
		},

		currentRouteIndex() {
			return this.routes.findIndex(
				route => route.name === this.$route.name
			);
		},

		nextRoute() {
			/**
			 * We'll redirect the user to the home page of the
			 * business once all the steps are completed and the
			 * business has been setup.
			 */
			const route = {
				name: "single-business",
			};

			const total_routes = this.routes.length;
			const next_route_index = this.currentRouteIndex + 1;

			if (total_routes > next_route_index) {
				route.name = this.routes[next_route_index].name;
				route.query = this.$route.query;
			} else {
				const business_id = parseInt(this.$route.query.business_id);

				route.params = {
					id: business_id,
				};
			}

			return route;
		},

		prevRoute() {
			const route = {
				name: this.$routes[0].name,
				query: this.$route.query,
			};

			if (this.currentRouteIndex > 0) {
				const prev_route_index = this.currentRouteIndex - 1;

				route.name = this.routes[prev_route_index].name;
			}

			return route;
		},

		...mapGetters("OptionStore", ["display_businesses_sidebar"]),
	},

	data() {
		return {
			routes_cache: undefined,
		};
	},

	methods: {
		/**
		 * Performs the action right after the business is registered.
		 *
		 * @returns void
		 */
		businessRegistered(business) {
			const business_id = business.id;
			const route = this.nextRoute;

			route.query = { business_id };

			this.$router.push(route);
		},
	},
};
</script>
