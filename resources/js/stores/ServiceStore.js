import { BUSINESSES, SERVICES, SERVICE_REQUESTS } from "./../routes/api";

const state = {
    business_services: [],
    services: [],
    service_requests: [],
    meta: {}
};

const mutations = {
    REGISTER_BUSINESS_SERVICE: (state, service) => {
        state.business_services.push(service);
    },

    REGISTER_SERVICE_REQUEST: (state, service_request) => {
        state.service_requests.push(service_request);
    },

    UNREGISTER_BUSINESS_SERVICE: (state, service) => {
        const index = state.business_services.findIndex(
            s => s.owner.id === service.owner.id && s.id === service.id
        );

        state.business_services.splice(index, 1);
    },

    SET_BUSINESS_SERVICES: (state, services) => {
        state.business_services = services;
    },

    SET_SERVICES: (state, services) => {
        state.services = services;
    },

    SET_SERVICES_META: (state, meta) => {
        state.meta = meta;
    }
};

const actions = {
    bidOnServiceRequest: ({ commit }, bid) => {
        // 
    },

    registerBusinessService: ({ commit }, service) => {
        return new Promise((resolve, reject) => {
            const route = BUSINESSES + "/" + service.owner.id + "/services";
            const data = { service_id: service.id };

            commit("REGISTER_BUSINESS_SERVICE", service);

            axios
                .post(route, data)
                .then(() => resolve())
                .catch(err => {
                    commit("UNREGISTER_BUSINESS_SERVICE", service);

                    reject(err);
                });
        });
    },

    registerServiceRequest: ({ commit }, service_request) => {
        return new Promise((resolve, reject) => {
            let form_data = new FormData();
            const data = _.cloneDeep(service_request);

            _.forOwn(data, (value, key) => {
                if (Array.isArray(value)) {
                    value.forEach((_value, index) => {
                        const _key = key + "[" + index + "]";

                        form_data.append(_key, _value);
                    });
                } else {
                    form_data.append(key, value);
                }
            });

            axios
                .post(SERVICE_REQUESTS, form_data, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(response => {
                    const service_request = response.data.data;

                    commit("REGISTER_SERVICE_REQUEST", service_request);
                    resolve(service_request);
                })
                .catch(err => reject(err));
        });
    },

    unregisterBusinessService: ({ commit }, service) => {
        return new Promise((resolve, reject) => {
            const route =
                BUSINESSES + "/" + service.owner.id + "/services/" + service.id;

            commit("UNREGISTER_BUSINESS_SERVICE", service);

            axios
                .delete(route)
                .then(() => resolve())
                .catch(err => {
                    commit("REGISTER_BUSINESS_SERVICE", service);

                    reject(err);
                });
        });
    },

    fetchBusinessServices: ({ commit }, business_id) => {
        return new Promise((resolve, reject) => {
            axios
                .get(BUSINESSES + "/" + business_id + "/services")
                .then(resp => {
                    const services = resp.data.data.map(service => {
                        return {
                            owner: {
                                id: business_id
                            },

                            ...service
                        };
                    });

                    commit("SET_BUSINESS_SERVICES", services);

                    resolve(services);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },

    fetchServiceRequestById: ({ commit }, service_request_id) => {
        return new Promise((resolve, reject) => {
            axios
                .get(SERVICE_REQUESTS + '/' + service_request_id)
                .then(resp => {
                    const service_request = resp.data.data;

                    commit("REGISTER_SERVICE_REQUEST", service_request);
                    resolve(service_request);
                })
                .catch(err => reject(err));
        });
    },

    fetchServices: ({ commit, getters }) => {
        return new Promise((resolve, reject) => {
            let meta = getters.services_meta;
            let services = getters.services;

            let route = SERVICES;

            if (
                meta.hasOwnProperty("current_page") &&
                meta.hasOwnProperty("last_page")
            ) {
                if (meta.current_page >= meta.last_page) {
                    return resolve();
                }

                route += "?page=" + (meta.current_page + 1);
            }

            axios
                .get(route)
                .then(resp => {
                    services = [...services, ...resp.data.data];

                    commit("SET_SERVICES", services);
                    commit("SET_SERVICES_META", resp.data.meta);

                    resolve();
                })
                .catch(err => {
                    reject(err);
                });
        });
    }
};

const getters = {
    business_service_exists: state => data => {
        return state.business_services.findIndex(
            s => s.owner.id === data.business_id && s.id === data.service.id
        );
    },

    business_services: state => business_id => {
        if (business_id !== undefined) {
            return state.business_services.filter(
                s => s.owner.id === business_id
            );
        }

        return state.business_services;
    },

    services: state => state.services,
    service_by_name: state => service_name =>
        state.services.find(service => service.name === service_name),
    service_request_by_id: state => service_request_id =>
        state.service_requests.find(
            service_request =>
                parseInt(service_request.id) === parseInt(service_request_id)
        ),
    services_meta: state => state.meta
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
