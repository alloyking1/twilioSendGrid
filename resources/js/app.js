require("./bootstrap");

import Vue from "vue";

import App from "./components/App.vue";
// import router from "./router.js";
// import store from "./store";

const app = new Vue({
    el: "#app",
    components: { App },
});
