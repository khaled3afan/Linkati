/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex, {mapActions, mapState} from 'vuex';
import VueClipboard from 'vue-clipboard2';
import Toasted from 'vue-toasted';
import store from './store/index';

Vue.use(VueClipboard);

Vue.use(Vuex);

Vue.use(Toasted, {
    position: 'top-center',
    duration: 1000
});

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

Vue.component('theme', require('./components/Theme.vue').default);

// Links
Vue.component('create-link', require('./components/CreateLink.vue').default);
Vue.component('edit-links', require('./components/profile/edit-links.vue').default);

// Profiles
Vue.component('create-profile', require('./components/profile/create.vue').default);
Vue.component('edit-profile', require('./components/profile/edit.vue').default);
Vue.component('customize-profile', require('./components/profile/customize.vue').default);
Vue.component('profile-card', require('./components/profile/show.vue').default);

Vue.component('edit-account', require('./components/EditAccount.vue').default);
Vue.component('change-password', require('./components/ChangePassword.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    computed: {
        ...mapState(['user', 'profile', 'env']),
    },
    data: {},
    created() {
        this.getUser();
        this.getProfile();
        this.getThemes();
        this.$store.commit('setEnv', window.Linkati.env);
    },
    methods: {
        copied: function (e) {
            this.$toasted.success('تم النسخ!');
        },
        ...mapActions([
            'getUser',
            'getProfile',
            'getThemes',
        ])
    },
    store: new Vuex.Store(store),
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    if (window.Paddle) {
        Paddle.Setup({vendor: 21507});

        // @https://developer.paddle.com/reference/paddle-js/parameters
        function openCheckout() {
            Paddle.Checkout.open({
                product: 587554,
                // title: 'الخطة الشهرية من لينكاتي',
                message: 'الخطة الشهرية من لينكاتي',
                country: 'TR',
                locale: window.Linkati.locale,
                email: window.Linkati.auth.email,
                passthrough: JSON.stringify({
                    user_id: window.Linkati.auth.id
                })
            });
        }

        $('#buy').click(openCheckout);
    }
});
