<template>
   <div>
        <h2>{{ msg }}</h2>
        <!--etiqueta para desplegar el componente asociado a la ruta-->
        <router-link :to="{ name:'crud-paginacion' }">Crud con paginacion</router-link>
        <router-link to="/Tarea-crud-Datatable">Crud Datatable</router-link>
        <hr><br>
        <router-view></router-view>
   </div>
</template>
<script>
import VueGoodTable from 'vue-good-table';
    export default {
        data(){
            return{
                msg: 'Rutas de cada componente'
            }
        }
    }
</script>
