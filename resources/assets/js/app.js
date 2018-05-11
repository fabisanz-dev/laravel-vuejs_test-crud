
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//eventBus = new Vue();// eventos para comunicacion en componentes
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import paginate from './components/Paginate.vue'
import dataTable from './components/DataTable.vue'


Vue.prototype.bus = new Vue();
Vue.filter();

Vue.component('example', require('./components/Example.vue'));
Vue.component('paginate', require('./components/Paginate.vue'));
Vue.component('datatable', require('./components/DataTable.vue'));
Vue.component('routes', require('./components/Routes.vue'));
//importamos el router que instalamos
import VueRouter from 'vue-router'

Vue.use(VueRouter); //cargamos la ruta en Vue para que este componente se utilice en los otros.

const routes = [ //definimos las rutas
 { path: '/Tarea-crud-Paginados', component: paginate, name: 'crud-paginacion' },
 { path: '/Tarea-crud-Datatable', component: dataTable }
 ];

const router = new VueRouter({
	routes, //le pasamos las rutas definidas
});


const app = new Vue({
    el: '#app',
    router,
    mounted(){
        axios.defaults.headers.common = {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRFToken": $('meta[name="csrf-token"]').attr('content')
          };
    },
    data:
    {
        text: 'Hola desde Vuejs',
        objeto:{
            item1:'',
            item2:''
        }
    }
});
