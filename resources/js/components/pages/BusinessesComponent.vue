<template>
	<div>
		<header-component></header-component>

		<content-component>
			<div class="container"><!----></div>
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
			...mapGetters("OptionStore", ["display_businesses_sidebar"]),
		},
	};
</script>
