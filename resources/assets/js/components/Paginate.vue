<template>
   <div class="container">
        <div>
            <button @click="listar()">clic aqui</button>
            <b>Lista de tareas: ordenacion por: Titulo</b>
               
            <ul class="list-group" v-for="item in tareas.data" :key="item.id">
                <li class="list-group-item"> {{ item.titulo }}</li>
            </ul>
        </div>
        <h2>Vue Pagination 2</h2>
              <p>Selected page: {{page}}</p>
                Total {{ tareas.total }}
            <pagination :records="Number(tareas.total)"  @paginate="setPage" :per-page="tareas.per_page"></pagination>
               {{ tareas.total }}
              {{ Number(tareas.total) }}
    </div>
</template>

<script>
import {Pagination} from 'vue-pagination-2';
import axios from 'axios';

export default {
  mounted() {
     this.obtenerTareas(); 
  },
  data(){
      return {      
          page: 1,
          tareas: '',
          busqueda_titulo: '',
      }
  },
  computed: {
  },
  methods:
   {
          setPage: function(page) {
            axios.get('http://localhost:8000/Tarea-Paginado?page='+page)
            .then( (response) => {
                this.tareas = response.data;
                this.page = page;
            });
          },

          obtenerTareas(){
              axios.get('/Tarea-Paginado')
                    .then( (response) => {
                        this.tareas = response.data;
                        console.log(this.tareas);
                    });   
          },

          listar(){
              this.obtenerTareas();
          }
    },
    components: 
            {
              Pagination
            }
}

</script>
