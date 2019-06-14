import { BUSINESSES, OPTIONS } from "./../routes/api";
import Vue from "vue";

const state = {
	options: [],
};

const mutations = {
	UNREGISTER_OPTION: (state, option) => {
		let index;

		if (option.hasOwnProperty("owner")) {
			index = state.options.findIndex(
				_option =>
					_option.hasOwnProperty("owner") &&
					(_option.owner.id === option.owner.id &&
						_option.owner.type === option.owner.type) &&
					_option.key === option.key
			);
		} else {
			index = state.options.findIndex(
				_option =>
					_option.hasOwnProperty("owner") === false &&
					_option.key === option.key
			);
		}

		state.options.splice(index, 1);
	},

	REGISTER_OPTION: (state, option) => {
		let index;

		if (option.hasOwnProperty("owner")) {
			index = state.options.findIndex(
				_option =>
					_option.hasOwnProperty("owner") &&
					(_option.owner.id === option.owner.id &&
						_option.owner.type === option.owner.type) &&
					_option.key === option.key
			);
		} else {
			index = state.options.findIndex(
				_option =>
					_option.hasOwnProperty("owner") === false &&
					_option.key === option.key
			);
		}

		if (index !== -1) {
			Vue.set(state.options, index, option);
		} else {
			state.options.push(option);
		}
	},
};

const actions = {
	fetchAppOptions: ({ commit }) => {
		return new Promise((resolve, reject) => {
			axios
				.get(OPTIONS)
				.then(resp => {
					const options = resp.data.data;

					options.forEach(option => {
						commit("REGISTER_OPTION", option);
					});

					resolve(options);
				})
				.catch(err => {
					reject(err);
				});
		});
	},

	fetchBusinessOptions: ({ commit }, business_id) => {
		return new Promise((resolve, reject) => {
			axios
				.get(BUSINESSES + "/" + business_id + "/options")
				.then(resp => {
					const options = resp.data.data;

					options.forEach(option => {
						commit("REGISTER_OPTION", option);
					});

					resolve(options);
				})
				.catch(err => {
					reject(err);
				});
		});
	},

	registerAppOption: ({ commit }, option) => {
		commit("REGISTER_OPTION", option);
	},

	registerBusinessOption: ({ commit }, option) => {
		return new Promise((resolve, reject) => {
			commit("REGISTER_OPTION", option);

			axios
				.post(BUSINESSES + "/" + option.owner.id + "/options", option)
				.then(() => resolve())
				.catch(err => {
					commit("UNREGISTER_OPTION", option);

					reject(err);
				});
		});
	},

	toggleBusinessesSidebar({ dispatch }, state) {
		const option = {
			key: "display_businesses_sidebar",
			value: false,
		};

		if (state === "show") {
			option.value = true;
		}

		dispatch("registerAppOption", option);
	},

	unregisterAppOption: ({ commit }, option) => {
		commit("UNREGISTER_OPTION", option);
	},

	unregisterBusinessOption: ({ commit }, option) => {
		return new Promise((resolve, reject) => {
			commit("UNREGISTER_OPTION", option);

			axios
				.delete(BUSINESSES + "/" + option.owner.id + "/options", option)
				.then(() => resolve())
				.catch(err => {
					commit("REGISTER_OPTION", option);

					reject(err);
				});
		});
	},
};

const getters = {
	display_businesses_sidebar: state => {
		const index = state.options.findIndex(
			option =>
				option.hasOwnProperty("owner") === false &&
				option.key === "display_businesses_sidebar"
		);

		if (index === -1) {
			return false;
		}

		return state.options[index].value;
	},

	option_exists: state => option => {
		let index;

		if (option.hasOwnProperty("owner")) {
			index = state.options.findIndex(
				d =>
					d.owner.id === option.owner.id &&
					d.owner.type === option.owner.type &&
					d.key === option.key
			);
		} else {
			index = state.options.findIndex(
				d => d.hasOwnProperty("owner") === false && d.key === option.key
			);
		}

		return index;
	},

	options: state => option => {
		let options = state.options;

		if (option.hasOwnProperty("owner")) {
			if (option.owner === "app") {
				options = options.filter(
					_option => _option.hasOwnProperty("owner") === false
				);
			} else {
				options = options.filter(
					_option =>
						_option.hasOwnProperty("owner") &&
						(_option.owner.id === option.owner.id &&
							_option.owner.type === option.owner.type)
				);
			}
		}

		if (option.key !== undefined) {
			options = options.filter(_option => _option.key === option.key);
		}

		return options;
	},
};

export default {
	namespaced: true,
	state,
	getters,
	actions,
	mutations,
};
