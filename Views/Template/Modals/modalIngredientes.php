<!-- Modal -->
<div class="modal fade" id="modalIngredientes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Ingredientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formIngredientes" name="formIngredientes">
                <input type ="hidden" id="menuId" name = "menuId" value ="">
                <div class="form-group">
                  <label class="control-label" for="listProducto">Producto</label>
                  <select class="form-control" data-live-search="true" id="listProducto" name="listProducto" required=""></select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="cantidad">Cantidad necesaria</label>
                  <input class="form-control" id="cantidad" name="cantidad" type="text" value="" required >
                </div>
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalViewDetalles" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Información del Menú</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID:</td>
              <td id="celId"></td>
            </tr>
            <tr>
              <td>Nombre del producto:</td>
              <td id="celProducto"></td>
            </tr>
            <tr>
              <td>Cantidad:</td>
              <td id="celCantidad"></td>
            </tr>
            <!--<tr>
              <td>Estado:</td>
              <td id="celEstado"></td>
            </tr>-->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>