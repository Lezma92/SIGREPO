<!-- Modal -->
<div class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Nueva contraseña:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="formContra" name="formContra">
          <div class="form-group">
            <label for="paswrd">Contraseña:</label>
            <input type="password" id="paswrd" name="paswrd" class="form-control" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button form="formContra" type="submit" name="btn_guardar" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>