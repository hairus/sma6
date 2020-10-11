import Axios from "axios";
const state = () => ({
    mapels:[],
    setKd:[],
    gurus:[],
    logpkpd:[]
});
const getters = {};
const actions = {
    GetMapel({commit}){
        Axios.get('/api/admin/AllMapel')
        .then(response => {
            commit('GETMAPELS', response.data)
        })
    },
    getSetKd({commit}, mapel_id){
        Axios.post('/api/admin/getSetkd', {
            mapel_id:mapel_id
        })
        .then(response => {
            commit('SETKD', response.data)
        })
    },
    DelSetKd({commit}, setKdId){
        Axios.post('/api/admin/DelSetkd', {
            set_kd_id : setKdId
        })
        .then(response => {
            console.log(response)
        })
    },
    getGurus({commit}){
        Axios.get('/api/admin/getGurus')
        .then(response => {
            commit("GETGURUS", response.data)
        })
    },
    logPkpd({commit}){
        Axios.get('/api/admin/logPkpd')
        .then(response => {
            commit('LOGPKPD', response.data)
        })
    }
};
const mutations = {
    GETMAPELS(state, payload){
        state.mapels = payload
    },
    SETKD(state, payload){
        state.setKd = payload
    },
    GETGURUS(state, payload){
        state.gurus = payload
    },
    LOGPKPD(state, payload){
        state.logpkpd = payload
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
