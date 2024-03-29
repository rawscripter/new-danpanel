require("./bootstrap");

window.Vue = require("vue");

window.APP_URL = "https://danpanel.dk";
// window.APP_URL = "http://danpanel.tests";


window.CURRENCY = "dkk";

import VueCookies from "vue-cookies";

Vue.use(VueCookies);

let SocialSharing = require("vue-social-sharing");

Vue.use(SocialSharing);

import axios from "axios";
import VueSocialauth from "vue-social-auth";

import VueAxios from "vue-axios";

import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

Vue.use(VueAxios, axios);

window.User = User;
window.Alert = Notification;

Vue.use(VueSocialauth, {
    providers: {
        github: {
            clientId: "5defb7b174f112bb4314",
            redirectUri: `${APP_URL}/auth/github/callback` // Your client app URL
        }
    }
});

//importing classes
import User from "./Helpers/User";
import Notification from "./Helpers/Notification";

import {
    ServerTable
} from "vue-tables-2";
import VueSweetalert2 from "vue-sweetalert2";
import vueAwesomeCountdown from "vue-awesome-countdown";

import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

import CKEditor from "@ckeditor/ckeditor5-vue";
import Vuelidate from "vuelidate";

Vue.use(Vuelidate);
Vue.use(CKEditor);

Vue.use(ServerTable);
Vue.use(VueSweetalert2);
Vue.use(vueAwesomeCountdown, "vac");


Vue.component("Loading", Loading);


import InfiniteLoading from "vue-infinite-loading";
// Vue.component('', require('vue-infinite-loading'));
Vue.use(InfiniteLoading);
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';

Vue.use(VueToast, {
    position: 'top-right'
});

Vue.component(
    "app-admin-home",
    require("./components/Admin/AppHome.vue").default
);
Vue.component(
    "app-site-home",
    require("./components/Site/AppHomeForSite.vue").default
);


import router from "./Router/router";

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import store from "./store";




const app = new Vue({
    el: "#app",
    router,
    store: new Vuex.Store(store)
});
