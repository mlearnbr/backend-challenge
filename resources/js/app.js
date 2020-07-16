require('./bootstrap');

import Vue from 'vue'
import router from './router';
import vuetify from './plugins/vuetify'
import App from './App.vue';

new Vue({
    vuetify,
    router,
    components: {
        App
    }
}).$mount('#app')
