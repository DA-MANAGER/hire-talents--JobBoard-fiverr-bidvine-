<template>
	<div>
		<header-component></header-component>

		<content-component>
			<div><h2>Page not found.</h2></div>
		</content-component>

		<footer-component></footer-component>
	</div>
</template>

<script>
import ContentComponent from "./../modules/ContentComponent.vue";
import FooterComponent from "./../modules/FooterComponent.vue";
import HeaderComponent from "./../modules/HeaderComponent.vue";

export default {
	components: {
		ContentComponent,
		FooterComponent,
		HeaderComponent,
	},
};
</script>
