import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { getValue } from '@/utils';
import { TOKEN } from '@/const';
import vuetify from './plugins/vuetify';
import '@babel/polyfill'
import 'roboto-fontface/css/roboto/roboto-fontface.css'
import '@mdi/font/css/materialdesignicons.css'
import "./components";

Vue.config.perfomance = true

new Vue({
  router,
  store,
  render: h => h(App),
  vuetify,
  async created() {
    const token = getValue(TOKEN);
    this.$store.commit('user/SET_TOKEN', token);
    await this.$store.dispatch('initClient', router);
    if ((!token || token === null) && this.$route.name !== 'Login') this.$router.push({ name: "Login" })
    else {
      await this.$store.dispatch('user/getUser');
    }
  }
}).$mount('#app')
