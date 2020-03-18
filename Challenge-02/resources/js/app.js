import Vue from "vue";
import Vuetify from "vuetify";
import VueSweetalert2 from "vue-sweetalert2";
import app from "./components/app.vue";

Vue.use(VueSweetalert2);
Vue.use(Vuetify);

const appBase = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data() {
        return {
            teste: "Herick"
        };
    },
    components: { app },

    computed: {},
    methods: {},
    mounted: function() {}
});
