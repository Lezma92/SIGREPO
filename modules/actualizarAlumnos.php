<div class="modal fade" id="actualizarAl" tabindex="-1" role="dialog" aria-labelledby="actualizarAl" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
     <div class="modal-header" >
      <h5 class="modal-title " id="actualizarAl">Actualizacón de datos del alumno</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form name="form-registro" method="POST">

        <div class="form-group ">
          <label for="text-matricula">Matricula:</label>
          <input type="number" class="form-control" name="matricula" id="text-matricula" placeholder="Usuario de acceso"  required>
        </div>
        <div class="form-group ">
          <label for="inputState">Grado estudio:</label>
          <select name="nivel_estudio" id="inputState" class="form-control" required>
            <option value="" id="grado"></option>
            <option value="TSU">Técnico</option>
            <option value="ING">Ingeniería</option>

          </select>
        </div>



        <div class="form-group ">
          <label for="text-nombre">Nombre(s):</label>
          <input type="text" name="nombre" class="form-control txt-entrada" id="text-nombre"  required>
        </div>
        <div class="form-group ">
          <label for="text-apellidos">Apellidos:</label>
          <input type="text" class="form-control txt-entrada" name="apellidos" id="text-apellidos"  required>
        </div>
        <div class="form-row ">
          <div class="form-group col-md-6">
            <label for="grupo">Grupo: </label>
            <input type="text" class="form-control" placeholder="Ej: TI1-7,TI2-7,TI10-1,TI10-2,ITI1-1"  id="grupo" name="grupo"  style="text-transform:uppercase;" minlength="3" maxlength="8" required>
          </div>
          <div class="form-group ">
            <label for="text-pswrd">Contraseña:</label>
            <input type="password" class="form-control" name="pswrd" id="text-pswrd"  required>
          </div>
        </div>
        <input type="hidden" name="idDato" id="idDato" value="">
        <input type="hidden" name="idUser" id="idUser" value="">
        <input type="hidden" name="idAlumno" id="idAlumno" value="">
        <div class="d-flex justify-content-center">
          <input class="btn btn-primary btn-sm" type="submit" name="registrarAlumno" value="Actualizar">
        </div>
      </form>
    </div>
  </div>
</div>

</div>