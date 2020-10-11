import axios from "axios"
const state = {
    catatan: '',
    edit: '',
    trx: ''
}
const getters = {}
const mutations = {
    GET_TOPIKS(state, payload) {
        state.catatan = payload
    },
    SHOW_ID(state, payload) {
        state.edit = payload
    },
    GET_TRX(state, payload) {
        state.trx = payload
    }
}
const actions = {
    getTopiks({
        commit
    }) {
        axios.get('/public/api/guru/topiks')
            .then(response => {
                commit('GET_TOPIKS', response.data)
            })
    },
    saveRem({
        commit
    }, form) {
        axios.post('/public/api/guru/saveRem', {
                topik: form.topik,
                desk: form.desk
            })
            .then(response => {

            })
    },
    editRem({
        commit
    }, id) {
        axios.put('/public/api/guru/editRem', {
                id: id
            })
            .then(response => {
                commit('SHOW_ID', response.data);
            })
    },
    updateRem({
        commit
    }, update) {
        axios.put('/public/api/guru/updateRem', {
                id: update.id,
                topik: update.topik,
                desk: update.desk
            })
            .then(res => {
                axios.get('/public/api/guru/topiks')
                    .then(response => {
                        commit('GET_TOPIKS', response.data)
                    })
            })
    },
    saveTrx({
        commit
    }, form) {
        axios.post('/public/api/guru/saveTrx', {
                id: form.myid,
                isi: form.isi
            })
            .then(resp => {
                axios.get('/public/api/guru/getTrx')
                    .then(response => {
                        commit('GET_TRX', response.data)
                    })
            })
    },
    getTrx({
        commit
    }) {
        axios.get('/public/api/guru/getTrx')
            .then(response => {
                commit('GET_TRX', response.data)
            })
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
