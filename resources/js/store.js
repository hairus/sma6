import Vue from 'vue'
import Vuex from 'vuex'
import guru from './src/guru'
import admin from './src/admin'


Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        guru,
        admin
    }
})


export default store
