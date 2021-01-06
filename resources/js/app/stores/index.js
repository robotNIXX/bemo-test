import Vuex from 'vuex'
import Vue from 'vue'
// import Axios from 'axios'

import columns from "./columns";
// import cards from "./cards";

Vue.use(Vuex)
const store = new Vuex.Store({
    modules: {
        columns: columns,
        // cards: cards
    }
});

export default store;
