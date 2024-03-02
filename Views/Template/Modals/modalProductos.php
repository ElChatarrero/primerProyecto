<!-- Modal -->
<div class="modal fade" id="modalFormProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formProducto" name="formProducto">
                <input type="hidden" id="idProducto" name="idProducto" value="">
                <p class="text-primary">Los campos con  asterisco (<span class="required">*</span>) son obligatorios</p>
                <div class="form-group">
                  <label class="control-label">Nombre del producto <span class="required">*</span></label>
                  <input class="form-control" id="NombreProducto" name="NombreProducto" type="text" placeholder="Nombre del producto" value="" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción <span class="required">*</span></label>
                  <textarea class="form-control" id="DescripcionProducto" name="DescripcionProducto" rows="2" placeholder="Descripción del producto" value=""required=""></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Estado <span class="required">*</span></label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
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
<div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Producto</h5>
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
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Descripcion:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>Fecha del registro del producto:</td>
              <td id="celFechaRegistro"></td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>