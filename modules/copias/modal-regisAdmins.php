<!-- Modal -->
<div class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Formulario de registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="formContra" name="formContra">
          <div class="form-group">
            <label for="txtMatricula">Matricula:</label>
            <input type="number" id="txtMatricula" name="txtMatricula" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" id="txtNombre" name="txtNombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="txtApp">Apellidos:</label>
            <input type="text" id="txtApp" name="txtApp" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="inputState">Nivel de usuario:</label>
            <select name="nivel_usuario" id="inputState" class="form-control" required>
              <option selected disabled><--seleccionar--></option>
              <option value="Administrador">Administrador</option>
              <option value="Maestro">Maestro</option>
            </select>
          </div>
          <div class="form-group">
            <label for="paswrd">Contraseña:</label>
            <input type="password" id="paswrd" name="paswrd" class="form-control" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button form="formContra" type="submit" name="btn_registrarAdmin" class="btn btn-primary">Registrar</button>
      </div>
    </div>
  </div>
</div>