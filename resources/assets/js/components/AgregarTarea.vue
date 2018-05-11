<template lang="html">
  <div>
      <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal"  :data-target="'#modalAdd'"> Agregar</button>
       <!-- Modal agregar -->
            <div id="modalAdd" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Agregar Tarea</h4>
                        </div>
                        <div class="modal-body">
                            <!-- formulario para crear y agregar -->
                            <form @submit.prevent="crearTarea()" method="POST">
                                <div :class="{ 'form-group': true, 'has-error': errors.titulo}">
                                    <label>Titulo:</label>
                                        <input type="text" class="form-control" v-model="tareaAdd.titulo">
                                    <span class="help-block" v-for="item in errors.titulo" :key="item.id">{{ item }}</span>
                                </div>

                                <div :class="{'form-group':true, 'has-error': errors.descripcion}">
                                    <label>Descripcion:</label>
                                    <textarea class="form-control" rows="5" v-model="tareaAdd.descripcion"></textarea>
                                    <span class="help-block" v-for="item in errors.descripcion" :key="item.id"> {{ item }}</span>
                                </div> 
                                <input type="submit" class="btn btn-primary" value="Guardar">
                            </form>
                             <!-- formulario para editar y actualizar -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div><!-- Modal content-->   
                </div>
            </div><!-- modal agregar -->

        <!-- modal edicion -->
         <div  id="modalEdit" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Editar Tarea</h4>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="actualizarTarea()"  method="POST">
                                <div :class="{ 'form-group': true, 'has-error': errors.titulo}">
                                    <label>Titulo:</label>
                                        <input type="text" class="form-control" v-model="tareaEdit.titulo">
                                    <span class="help-block" v-for="item in errors.titulo" :key="item.id">{{ item }}</span>
                                </div>

                                <div :class="{'form-group':true, 'has-error': errors.descripcion}">
                                    <label>Descripcion:</label>
                                    <textarea class="form-control" rows="5" v-model="tareaEdit.descripcion"></textarea>
                                    <span class="help-block" v-for="item in errors.descripcion" :key="item.id"> {{ item }}</span>
                                </div> 
                                <input type="submit" class="btn btn-primary" value="Guardar">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div><!-- Modal content-->   
                </div>
            </div><!-- modal editar -->
  </div>
</template>
 
<script>
  import axios from 'axios';

  export default {
        name: 'agregarTarea',
        props:['tarea'],
        data(){
            return {
                tareaAdd: {
                    titulo: '',
                    descripcion:''
                },
                errors: [],
                //edicionConfirmada: false,
                //objeto que se conecta con los datos recibidos en props por el comp.padre
                tareaEdit: {
                    id:'',
                    titulo: '',
                    descripcion: ''
                }
            }
        },
        mounted(){
            this.edicionTarea();
        },
        methods:
        {
            crearTarea()
            {
                var params = {'titulo': this.tareaAdd.titulo, 'descripcion': this.tareaAdd.descripcion};
                axios.post('/Tarea/', params)
                .then( 
                    response => 
                        {
                           // var creado = true;
                           // this.$emit('mje-tarea-agregada', creado);
                            this.tareaAdd.titulo = '',
                            this.tareaAdd.descripcion = '',
                                $('#modalAdd').modal('hide');
                                
                            this.$emit('tarea-agregada');
                            this.errors = '';
                        })
                .catch(
                     error =>
                     {
                        //http 422 solicitud bien formada pero con errores semanticos
                         if (error.response.status == 422) 
                        {
                            this.errors = error.response.data;                           
                        }
                    });
            },
            edicionTarea(){
                this.bus.$on('editarTarea', (edicion, data) => {
                    //this.edicionConfirmada = edicion;
                    this.errors = '';
                    if (edicion){
                /*data: parametro que recibe del evento como objeto
                ( row:{id: '...', titulo: '...', descripcion:'...', created_at:'...', updated_at:'...'}),
                solo ocupo las keys: id, titulo, descripcion*/
                        this.tareaEdit.id = data.id;
                        this.tareaEdit.titulo = data.titulo;
                        this.tareaEdit.descripcion = data.descripcion;
                        $('#modalEdit').modal('show');
                    }
                });
            },
            actualizarTarea(){
                var params = {'titulo': this.tareaEdit.titulo, 'descripcion': this.tareaEdit.descripcion };
                axios.put('/Tarea/'+this.tareaEdit.id, params)
                .then( (response)=>{
                    $('#modalEdit').modal('hide');
                        this.$emit('tarea-actualizada');
                        this.errors = '';
                })
                .catch( (error)=>{
                    if(error.response.status == 422)
                    {
                        this.errors = error.response.data;
                    }
                });
            }
        }
    }
</script> 
