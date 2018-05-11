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
                <form @submit.prevent="crearTarea()">
                   <div class="form-group">
                      <label for="usr">Titulo:</label>
                      <input type="text" class="form-control" v-model="tituloTarea">
                    </div>
                    <div class="form-group">
                        <label for="comment">Descripcion:</label>
                        <textarea class="form-control" rows="5" v-model="descripcionTarea"></textarea>
                    </div> 
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            </div>

        </div>
        </div>