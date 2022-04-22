import Vue from "vue";
import vuetify from './vuetify';
import ResultPage from './components/ResultPage';
import ScreeningForm from './components/ScreeningForm';

require('./bootstrap');

window.Vue = require('vue');
window.Vuetify = require('vuetify');
Vue.use(Vuetify)


Vue.component('screening-form', require('./components/ScreeningForm.vue').default);
Vue.component('result-page', require('./components/ResultPage').default);

const app = new Vue({
    el: '#app',
});
