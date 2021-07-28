require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import moment from 'moment'
import VueConfirmDialog from 'vue-confirm-dialog'
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor  );
// Vue.use(VueTailwindPicker)

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

Vue.use(VueConfirmDialog)
Vue.component('vue-confirm-dialog', VueConfirmDialog.default)
var numeral = require("numeral");

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const app = document.getElementById('app');

Vue.component('HeaderPage', require('./components/Header.vue').default);

Vue.filter("fCur", function (value) {
    return numeral(value).format("0,0"); 
});

Vue.filter('DateTimeHuman', function(value){
    // moment.locale('id');
    return moment(value).fromNow()
})

Vue.filter('fDateD2M3', function(value){
    // moment.locale('id');
    return moment(value).format('DD MMM')
})

Vue.filter('fDateD2M3Y2', function(value){
    // moment.locale('id');
    return moment(value).format('DD MMM YY')
})

Vue.filter('fDateD2M3Y4', function(value){
    // moment.locale('id');
    return moment(value).format('DD MMM YYYY')
})

Vue.component('pagination', require('laravel-vue-pagination'));

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
