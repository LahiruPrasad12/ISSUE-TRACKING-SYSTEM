import Vue from 'vue'
import App from './App.vue'
import ViewResources from 'vue-resource'
import VeeValidate from 'vee-validate'
import Route from "./routes";

// Vue.use(VeeValidate);
Vue.use(ViewResources);
new Vue({
  el: '#app',
  render: h => h(App),
  router:Route
})
