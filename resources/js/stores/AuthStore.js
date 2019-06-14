import { OAUTH_TOKEN, AUTH_USER } from "./../routes/api";

const state = {
	token: localStorage.getItem("USER_ACCESS_TOKEN") || undefined,
	token_type: localStorage.getItem("USER_ACCESS_TOKEN_TYPE") || undefined,
	user: undefined,
};

const mutations = {
	AUTH_LOGOUT: state => {
		state.token = state.token_type = state.user = undefined;
	},

	AUTH_SUCCESS: (state, data) => {
		state.token = data.token;
		state.token_type = data.token_type;
	},

	SET_AUTH_USER: (state, user) => {
		state.user = user;
	},
};

const actions = {
	authLogout: ({ commit }) => {
		return new Promise(resolve => {
			localStorage.removeItem("USER_ACCESS_TOKEN");
			localStorage.removeItem("USER_ACCESS_TOKEN_TYPE");

			commit("AUTH_LOGOUT");

			resolve();
		});
	},

	authRequest: ({ commit, dispatch }, user) => {
		return new Promise((resolve, reject) => {
			const data = {
				client_id: process.env.MIX_CLIENT_ID,
				client_secret: process.env.MIX_CLIENT_SECRET,
				grant_type: "password",
				scope: "*",
				...user,
			};

			axios
				.post(OAUTH_TOKEN, data)
				.then(resp => {
					const token = resp.data.access_token;
					const token_type = resp.data.token_type;

					localStorage.setItem("USER_ACCESS_TOKEN", token);
					localStorage.setItem("USER_ACCESS_TOKEN_TYPE", token_type);

					commit("AUTH_SUCCESS", { token, token_type });

					resolve(resp);
				})
				.catch(err => {
					dispatch("authLogout").then(() => {
						reject(err);
					});
				});
		});
	},

	authUser: () => {
		return new Promise((resolve, reject) => {
			axios
				.get(AUTH_USER)
				.then(resp => resolve(resp.data))
				.catch(err => reject(err));
		});
	},

	setAuthUser: ({ commit }, user) => {
		commit("SET_AUTH_USER", user);
	},
};

const getters = {
	auth_user: state => state.user,
	is_authenticated: state => !!state.token && !!state.token_type,
	token: state => state.token,
	token_type: state => state.token_type,
};

export default {
	namespaced: true,
	state,
	getters,
	actions,
	mutations,
};
