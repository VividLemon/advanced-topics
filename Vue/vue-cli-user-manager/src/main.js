import Vue from 'vue'
import App from './App.vue'
import router from './router'
import {RoleDataAccess as rda} from "@/api"
import Vuelidate from 'vuelidate'

Vue.config.productionTip = false
Vue.use(Vuelidate);

new Vue({
  data(){
    return{
        userRoles:[],
        currentUser:"",
        currentUserRoleId:0,
        currentUserId:0
    }
  },
  mounted(){
    rda.getAllRoles()
    .then(response => {
        this.userRoles = response.data
    })
    .catch(error => console.log(error))
  },
  router,
  render: h => h(App)
  }).$mount('#app')
