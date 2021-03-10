require('./bootstrap');
window.$ = require("jquery");

window.Vue = require('vue').default;
import { initialize } from "./helper/general";
import common from "./helper/comon";
import VueRouter from "vue-router";
import Swal from "sweetalert2";
import Vuex from "vuex";
import storeData from "./store";
import { routes } from "./routes";
import VueProgressBar from "vue-progressbar";
import { Form, HasError, AlertError } from "vform";
import Paginate from "vuejs-paginate";


const store = new Vuex.Store(storeData);



const router = new VueRouter({
    routes,
    mode: "history"
});
initialize(store, router);

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

Vue.use(VueRouter);
Vue.use(VueProgressBar, options);
window.Form = Form;
Vue.mixin(common);
window.Swal = Swal;
window.Toast = Toast;
const options = {
    color: "#bffaf3",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300
    },
    autoRevert: true,
    location: "top",
    inverse: false
};
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('main-app', require('./components/Homepage/App.vue').default);
Vue.component('admin-app', require('./components/Admin/HomeAdmin.vue').default);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("paginate", Paginate);


const app = new Vue({
    el: '#app',
    router,
    store,
});