 <!-- Modal-->
 <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@{{ modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" v-model="color">
                    <small v-if="errors.hasOwnProperty('name')">@{{ errors['color'][0] }}</small>
                </div>

                <div class="form-group">
                    <label for="name">Seleccionar color</label>
                    <input type="color" class="form-control" id="name" v-model="hex">
                    <small v-if="errors.hasOwnProperty('hex')">@{{ errors['hex'][0] }}</small>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold"  @click="store()" v-if="action == 'create'">Crear</button>
                <button type="button" class="btn btn-primary font-weight-bold"  @click="update()" v-if="action == 'edit'">Actualizar</button>
            </div>
        </div>
    </div>
</div>