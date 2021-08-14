import Vue from 'vue';
import App from './App.vue';
import ViewResources from 'vue-resource';
import Route from "./routes";
;

Vue.use(ViewResources);
new Vue({
  el: '#app',
  render: h => h(App),
  router:Route
})
