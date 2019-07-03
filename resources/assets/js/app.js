/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import Toasted from 'vue-toasted';

Vue.use(Toasted);
Vue.toasted.register('error', message => message, {
    position: 'bottom-right',
    duration: 1000
});

Vue.component('edit-profile', require('./components/profile/edit.vue').default);
Vue.component('edit-links', require('./components/profile/edit-links.vue').default);
Vue.component('profile-card', require('./components/profile/show.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vuex from 'vuex';

const store = new Vuex.Store({
    state: {
        profile: {}
    },
});

const app = new Vue({
    el: '#app',
    data: {
        profile: {}
    },
    mounted() {
        this.getProfile();
    },
    methods: {
        getProfile() {
            this.profile = window.Linkati.profile;
        }
    }
});
