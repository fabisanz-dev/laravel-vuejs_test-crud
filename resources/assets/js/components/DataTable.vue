<template>
  <div>
    <simplert :useRadius="true"
              :useIcon="true"
               ref="simplert">
    </simplert>
      <div class="container">
        <agregarTarea  :tarea="rows" @tarea-agregada="mensajeCreacion" @tarea-actualizada="mensajeActualizacion"></agregarTarea>
          <VueGoodTable
                title="Demo Table"
                prevText="Anterior"
                nextText="Siguiente"
                :columns="columns"
                :rows="rows"
                :paginate="true"
                :lineNumbers="true"
                :responsive="true"
                styleClass="table table-bordered table-responsive">
              <div slot="table-row-after" slot-scope="props">
                  <td><button class="btn btn-primary" @click="editarTarea(props.row)">Editar</button></td>
                  <td><button class="btn btn-danger" @click="eliminar(props.row.id)">Eliminar</button></td>
              </div>
          </VueGoodTable>
      </div>
  </div>
</template>
 
<script>
import {VueGoodTable} from 'vue-good-table';
import axios from 'axios';
import agregarTarea from './AgregarTarea.vue';
import Simplert from 'vue2-simplert';
require('vue2-simplert/dist/simplert.common.css');

export default {
  mounted(){
      this.getPosts();
  },
  data(){
    return {
      columns: [
        {
          label: 'Titulo',
          field: 'titulo',
          filterable: true,
        },
        {
          label: 'Body',
          field: 'descripcion',
          filterable: true,
        },
        {
          label: 'Acciones'
        }
      ],
      rows: [
      ],
      editar: '',
      
    }
  },
  methods:{
       getPosts(){
                axios.get('/Tarea')
                .then( (response) => 
                {
                    this.rows = response.data;
                })
                .catch( (error) => 
                {
                    console.log(error.data);
                });
        },
      editarTarea(row){
        this.editar = true;
        this.bus.$emit('editarTarea', this.editar, row);
      },
      eliminar(id){
        /*uso las funciones del componente simple alert para mostrar mensaje de confirmacion
        primero seteo una variable let que guardara una funcion que devuelve la respesta de*/
        let confirmFn =() => {
              //uso de la lib:axios para realizar la peticion
                axios.delete('/Tarea/'+id)
                  .then((response) => {
                    let obj = {
                          title: 'Mensaje',
                          message: response.data.message,
                          type: 'success',
                          customCloseBtnText: 'Ok'
                      }
                      this.$refs.simplert.openSimplert(obj);
                      /*let indice = this.rows.indexOf(row);
                      this.rows.splice(indice, 1);*/
                      this.getPosts();
                  })
                  .catch((error) => {
                    if (error.response.status == 404)
                    {
                          let obj = {
                              title: 'Mensaje de Error',
                              message: 'No se encontro recurso',
                              type: 'error',
                              customCloseBtnText: 'Ok'
                          }
                          this.$refs.simplert.openSimplert(obj);
                     } 
                });
          };
          /*objeto para mostrar mensaje de alidacion, 
          contiene la propiedad: onConfirm, seteada con la variable: confirmFn  
          que confirma la peticion de la eliminacion*/
          let obj = {
              title: 'Mensaje de Confirmacion',
              message: 'esta seguro de que desea eliminar este recurso?',
              type: 'info',
              useConfirmBtn: true,
              onConfirm: confirmFn,
              customConfirmBtnText: 'Confirmar',
              customCloseBtnText: 'Cancelar',
              customConfirmBtnClass: 'btn btn-success',
              //customCloseBtnClass: 'btn-danger',
          };
          this.$refs.simplert.openSimplert(obj);

      },//metodo eliminar
    mensajeCreacion(){
          let obj = {
                title: 'Mensaje',
                message: 'Tarea Agregada',
                type: 'success',
                customCloseBtnText: 'Ok'
            }
          this.$refs.simplert.openSimplert(obj);
          this.getPosts();
    },
    mensajeActualizacion(){
      let obj = {
                title: 'Mensaje',
                message: 'Tarea Actualizada',
                type: 'success',
                customCloseBtnText: 'Ok'
            }
          this.$refs.simplert.openSimplert(obj);
          this.getPosts();
    }
  },
    components:
      {
        agregarTarea,  Simplert , VueGoodTable
      }
};


</script> 
