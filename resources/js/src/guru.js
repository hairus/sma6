import Axios from "axios";

const state = () => ({
    kelas: [],
    materisDay: [],
    report: ''

});
const getters = {};
const mutations = {
    KELAS(state, payload) {
        state.kelas = payload
    },
    MATERIS(state, payload) {
        state.materisDay = payload
    },
    REPORT(state, payload) {
        state.report = payload
    }
};
const actions = {
    kelas({
        commit,
        state
    }) {
        return new Promise((resolve, reject) => {
            Axios.get('/guru/asdfasfasf')
                .then((response) => {
                    commit('MATERIS', response.data)
                    resolve(response.data)
                })
                .catch((response) => {
                    console.log(response)
                })
        })
    },
    report({
        commit
    }, id) {
        Axios.post('/guru/aklioasfm', {
                id: id
            })
            .then(response => {
                commit('REPORT', response.data)
            })
    },
    login({
        commit
    }) {
        Axios.post('/api/details')
            .then(response => {
                const token = response.data.access_token;
                localStorage.setItem("access_token", "Bearer " + token);
                console.log('sukses memasukkan token')
            })
    },
    test(commit) {
        Axios.post('/api/asdfasfasf', {}, {
                headers: {
                    Authorization: localStorage.getItem("access_token"),
                },
            })
            .then(response => {
                console.log(response)
            })
    }
};


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
