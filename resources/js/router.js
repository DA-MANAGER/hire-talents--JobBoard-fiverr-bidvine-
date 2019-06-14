import Vue from "vue";
import VueRouter from "vue-router";

import Routes from "./routes/web";

Vue.use(VueRouter);

export default new VueRouter({
	mode: "history",
	base: __dirname,
	routes: Routes,
});
