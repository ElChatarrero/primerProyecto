<!-- Modal -->
<div class="modal fade" id="modalFormInventario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Ingreso de productos al inventario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formInventario" name="formInventario">
                <p class="text-primary">Los campos con  asterisco (<span class="required">*</span>) son obligatorios</p>
                <div class="form-group">
                  <label class="control-label">Nombre del producto <span class="required">*</span></label>
                  <select class="form-control" data-live-search="true" id="listProducto" name="listProducto" required=""></select>
                </div>
                <div class="form-group">
                  <label class="control-label">Fecha de Ingreso </label>
                  <input [type="date"] class="form-control" id="fechaIngreso" name="fechaIngreso" value="<?php echo date("d-m-Y");?>" readonly onmousedown="return false" required="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="cantidad">Cantidad<span class="required">*</span></label>
                  <input class="form-control" id="cantidad" name="cantidad" type="text" value="" required onkeypress="return controlTag(event);">
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