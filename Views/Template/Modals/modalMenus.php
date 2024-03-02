<!-- Modal -->
<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Menú del Dia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"); ?>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formMenu" name="formMenu">
                <input type ="hidden" id="idPersona" name = "idPersona" value ="<?= $_SESSION['userData']['idpersona']; ?>"> 
                <div class="form-group">
                  <label class="control-label" for="nombrePlato">Nombre del plato</label>
                  <input class="form-control" id="nombrePlato" name="nombrePlato" type="text" value="" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Día</label>
                  <input class="form-control" id="dia" name="dia" type="text" value="<?= $dias[date('w')]; ?>" required readonly onmousedown="return false">
                </div>
                <div class="form-group">
                  <label class="control-label" for="listTurno">Turno</label>
                  <select class="form-control"  id="listTurno" name="listTurno" required="">
                    <option value="1">Mañana</option>
                    <option value="2">Tarde</option>                    
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="listTipo">Tipo</label>
                  <select class="form-control"  id="listTipo" name="listTipo" required="">
                    <option value="1">Desayuno</option>
                    <option value="2">Almuerzo</option>                    
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