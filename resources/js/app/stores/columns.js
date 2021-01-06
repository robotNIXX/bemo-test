import Axios from 'axios'

const state = {
    columns: [],
};
const getters = {
    columns(state) {
        return state.columns
    }
};
const mutations = {
    SET_ALL_COLUMNS: (state, columns) => {
        state.columns = columns
    },
    ADD_THE_COLUMN: (state, payload) => {
        state.columns.push(payload)
    },
    ADD_THE_CARD: (state, payload) => {
        let columns = state.columns
        state.columns.forEach(function(item, index) {
            if (item.id == payload.column_id) {
                columns[index].cards.push(payload)
            }
        })
        state.columns = columns;
    }
};
const actions = {
    GET_ALL_COLUMNS: async function (context, payload) {
        let {data} = await Axios.get('/columns')
        context.commit('SET_ALL_COLUMNS', data)
    },
    CREATE_COLUMN: async function (context, column) {
        return new Promise(function (resolve, reject) {
            Axios.post('/columns', {column: column}).then(function(response) {
                context.commit('ADD_THE_COLUMN', response.data)
                resolve(response);
            }).catch(function(error) {
                reject(error);
            });
        });
    },
    APPEND_THE_CARD: function(context, card) {
        return new Promise(function (resolve, reject) {
            Axios.post('/cards', {card: card}).then(function(response) {
                context.commit('ADD_THE_CARD', response.data)
                resolve(response);
            }).catch(function(error) {
                reject(error);
            });
        });
    },
    MOVE_TO_WEIGHT: async function(context, payload) {
        let {data} = await Axios.post('/cards/' + payload.card.id, {weight: payload.weight})
        context.commit('SET_ALL_COLUMNS', data)
    },
    MOVE_TO_COLUMN: async function(context, payload) {
        let {data} = await Axios.post('/cards/' + payload.card.id, {column_id: payload.column.id})
        context.commit('SET_ALL_COLUMNS', data)
    }
};

export default {
    state,
    getters,
    mutations,
    actions
}
