require('./bootstrap');

window.Vue = require('vue');

import Swal from 'sweetalert2';
import Loading from 'vue-loading-overlay';
import Vuetify from 'vuetify';
import datetime from 'vuejs-datetimepicker';
import {
    Circle10
} from 'vue-loading-spinner';
import 'vue-loading-overlay/dist/vue-loading.css';
import store from './store';

Vue.use(Vuetify);
Vue.use(datetime);
Vue.use(Circle10);
Vue.use(Loading);

window.Loading = Loading;
window.Swal = Swal;
window.datetime = datetime;

const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});

window.Toast = Toast;


// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('isurat', require('./components/isurat.vue').default);
Vue.component('soal', require('./components/quiz/soal').default);
Vue.component('mapel', require('./components/quiz/mapel').default);
Vue.component('pjj', require('./components/pjj/pjj').default);

/*====================== ini role buat admin ============================*/
Vue.component('spa', require('./components/admin/spa').default);
/*=======================================================================*/

/**========================= ini untuk vue js penilaian ===================*/
Vue.component('penilaian', require('./components/penilaian/index.vue').default);
Vue.component('utama1', require('./components/penilaian/test').default);
Vue.component('loading', require('./components/loading').default);
Vue.component('Circle10', require('./components/Circle10').default);
/**======================================================================== */

const app = new Vue({
    el: '#app',
    store
});
