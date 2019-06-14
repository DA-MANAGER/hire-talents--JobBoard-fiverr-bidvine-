import { MEDIA } from "../routes/api";

const state = {
    media_list: []
};

const mutations = {
    REGISTER_MEDIA: (state, media) => {
        const index = state.media_list.findIndex(
            _media => _media.id === media.id
        );

        if (index !== -1) {
            Vue.set(state.media, index, media);
        } else {
            state.media_list.push(media);
        }
    }
};

const actions = {
    fetchMedia: ({ commit }, owner) => {
        return new Promise((resolve, reject) => {
            axios
                .get(MEDIA, {
                    params: {
                        ...owner
                    }
                })
                .then(resp => {
                    const media_list = resp.data.data;

                    media_list.forEach(media => {
                        commit("REGISTER_MEDIA", media);
                    });

                    resolve(media_list);
                })
                .catch(err => reject(err));
        });
    },

    registerMedia: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            axios
                .post(MEDIA, data, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(resp => {
                    const media = resp.data.data;

                    commit("REGISTER_MEDIA", media);
                    resolve(media);
                })
                .catch(err => reject(err));
        });
    }
};

const getters = {
    media_list: state => owner => {
        return state.media_list.filter(
            media =>
                media.owner.id === owner.id && media.owner.type === owner.type
        );
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
