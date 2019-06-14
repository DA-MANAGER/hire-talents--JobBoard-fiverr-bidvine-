/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import AppComponent from "./components/AppComponent";
import router from "./router";
import store from "./store";

router.beforeEach((to, _from, next) => {
	const is_authenticated = store.getters["AuthStore/is_authenticated"];

	if (to.matched.some(record => record.meta.requiresAuth)) {
		// These routes are strictly accessible to only logged in users.
		// If the user is not authenticated then we'll redirect the user
		// to the login page to authenticate themselves with a
		// Redirect URL which could later be used to forward them to the
		// page they were trying to access earlier once they are logged in.
		if (!is_authenticated) {
			next({
				name: "login",
				query: { redirect: to.fullPath },
			});
		}
	} else if (to.matched.some(record => record.meta.forbidsAuth)) {
		// These routes are strictly forbidden from the logged in users.
		// The authenticated users trying to access these routes should be
		// redirected to some valuable page such as Home.
		if (is_authenticated) {
			next({
				name: "home",
			});
		}
	}

	next();
});

/**
 * We'll attach an Authorization token to every request we send to the
 * server. So the server could recognize the Authenticated user and
 * could perform actions on belhaf of that user.
 */
window.axios.interceptors.request.use(
	config => {
		const token = store.getters["AuthStore/token"],
			token_type = store.getters["AuthStore/token_type"];

		if (token !== undefined && token_type !== undefined) {
			config.headers.Authorization = `${token_type} ${token}`;
		}

		return config;
	},
	error => {
		return Promise.reject(error);
	}
);

/**
 * For every response we receive from the server should be checked for if
 * the server requires the user to be authenticated to perform the certain
 * action and if "Yes" and the user is not authenticated in the
 * application we'll simply redirect the user to login the application
 * before they could proceeding for that action once again.
 */
window.axios.interceptors.response.use(undefined, err => {
	return new Promise(() => {
		err = err.response || err;

		if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
			// To double confirm the logging out of the user we can simply
			// remove the access token of the user from the application so
			// they could generate a new for them.
			store.dispatch("AuthStore/authLogout");
			router.push({ name: "login" });
		}

		throw err;
	});
});

/**
 * Next, register any global properties to make them accessible to all the
 * components in the application.
 */

Vue.prototype.$appName = process.env.MIX_APP_NAME;
Vue.prototype.$_ = window._;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("app", AppComponent);

const app = new Vue({
	router,
	store,
}).$mount("#app");
