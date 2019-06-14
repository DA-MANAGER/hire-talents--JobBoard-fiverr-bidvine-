import { BUSINESSES } from "./../routes/api";

const state = {
	businesses: [],
};

const mutations = {
	REGISTER_BUSINESS: (state, business) => {
		const index = state.businesses.findIndex(b => b.id === business.id);

		if (index !== -1) {
			Vue.set(state.businesses, index, business);
		} else {
			state.businesses.push(business);
		}
	},

	UPDATE_BUSINESS: (state, business) => {
		const index = state.businesses.findIndex(b => b.id === business.id);

		state.businesses[index] = business;
	},
};

const actions = {
	fetchBusiness: ({ commit }, business_id) => {
		return new Promise((resolve, reject) => {
			axios
				.get(BUSINESSES + "/" + business_id)
				.then(resp => {
					const business = resp.data.data;

					commit("REGISTER_BUSINESS", business);

					resolve(business);
				})
				.catch(err => reject(err));
		});
	},

	fetchBusinessByUserId: ({ commit }, user_id) => {
		return new Promise((resolve, reject) => {
			axios
				.get(BUSINESSES, {
					params: {
						user_id,
					},
				})
				.then(resp => {
					const businesses = resp.data.data;

					businesses.forEach(business => {
						commit("REGISTER_BUSINESS", business);
					});

					resolve(businesses);
				})
				.catch(err => reject(err));
		});
	},

	registerBusiness: ({ commit }, data) => {
		return new Promise((resolve, reject) => {
			axios
				.post(BUSINESSES, data)
				.then(resp => {
					const business = resp.data.data;

					commit("REGISTER_BUSINESS", business);

					resolve(business);
				})
				.catch(err => reject(err));
		});
	},

	updateBusiness({ commit }, props) {
		return new Promise((resolve, reject) => {
			axios
				.put(BUSINESSES + "/" + props.business_id, props.data)
				.then(resp => {
					const business = resp.data.data;

					commit("REGISTER_BUSINESS", business);

					resolve(business);
				})
				.catch(err => reject(err));
		});
	},
};

const getters = {
	businesses_by_user_id: state => user_id => {
		let businesses = [];

		state.businesses.forEach(business => {
			business.owners.forEach(owner => {
				if (owner.id === user_id) {
					businesses.push(business);
				}
			});
		});

		return businesses;
	},

	businesses: state => business_id => {
		let businesses = state.businesses;

		if (business_id !== undefined) {
			const index = businesses.findIndex(b => b.id === business_id);

			if (index === -1) {
				return {};
			}

			businesses = businesses[index];
		}

		return businesses;
	},
};

export default {
	namespaced: true,
	state,
	getters,
	actions,
	mutations,
};
