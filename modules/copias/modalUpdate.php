<!-- Modal -->
<div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Actualización de datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="formUpdate" name="formUpdate">
          <div class="form-group">
            <label for="txtMatriculaU">Matricula:</label>
            <input type="number" id="txtMatriculaU" name="txtMatriculaU" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="txtNombreU">Nombre:</label>
            <input type="text" id="txtNombreU" name="txtNombreU" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="txtAppU">Apellidos:</label>
            <input type="text" id="txtAppU" name="txtAppU" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nivel_usuarioU">Nivel de usuario:</label>
            <select name="nivel_usuarioU" id="nivel_usuarioU" class="form-control" required>
              <option value="" id="tipoU"></option>
              <option value="Administrador">Administrador</option>
              <option value="Maestro">Maestro</option>
            </select>
          </div>
          <div class="form-group">
            <label for="paswrdU">Contraseña:</label>
            <input type="password" id="paswrdU" name="paswrdU" class="form-control" required>
          </div>
          <input type="hidden" name="idDato" id="idDato" value="">
          <input type="hidden" name="idUser" id="idUser" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button form="formUpdate" type="submit" name="btn_registrarAdminUpdate" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
  <?php registrar::cambiarDatosUsuarios(); ?>
</div>