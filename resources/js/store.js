import Vue from "vue";
import Vuex from "vuex";

import AuthStore from "./stores/AuthStore";
import BusinessStore from "./stores/BusinessStore";
import MediaStore from "./stores/MediaStore";
import OptionStore from "./stores/OptionStore";
import ServiceStore from "./stores/ServiceStore";

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
    modules: {
        AuthStore,
        BusinessStore,
        MediaStore,
        OptionStore,
        ServiceStore
    },

    strict: debug
});
