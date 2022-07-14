<div class="modal fade" id="exampleModalLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
     <div class="modal-header" style="background: #191B32;" >
      <h5 class="modal-title text-white" id="exampleModalLabel">Formulario de registro</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" style="background: linear-gradient(#191B32,#2C3278);">
      <form name="form-registro" method="POST">
 
          <div class="form-group text-white">
            <label for="text-matricula">Matricula:</label>
            <input type="number" class="form-control" name="matricula" id="text-matricula" placeholder="Usuario de acceso"  required>
          </div>
          <div class="form-group text-white">
            <label for="inputState">Grado estudio:</label>
            <select name="nivel_estudio" id="inputState" class="form-control" required>
              <option selected disabled><--seleccionar--></option>
              <option value="TSU">Técnico</option>
              <option value="ING">Ingeniería</option>

            </select>
          </div>

          <div class="form-group text-white">
            <label for="inputCarrera">Carrera:</label>
            <select name="id_carrera" id="inputCarrera" class="form-control" required>
              <option selected disabled><--seleccionar--></option>
              <option value="1">Procesos Alimentarios  </option>
              <option value="6">Metal Mecánica</option>
              <option value="2">Mantenimiento Industrial</option>
              <option value="7">Logística Internacional</option>
              <option value="8">Gestión y Desarrollo Turístico</option>
              <option value="5">Gestión del Capital Humano</option>
              <option value="9">Gastronomía</option>
              <option value="4">Energías Renovables</option>
              <option value="3">Desarrollo y Gestión de Software</option>

            </select>
          </div>



        <div class="form-group text-white">
          <label for="text-nombre">Nombre(s):</label>
          <input type="text" name="nombre" class="form-control txt-entrada" id="text-nombre"  required>
        </div>
        <div class="form-group text-white">
          <label for="text-apellidos">Apellidos:</label>
          <input type="text" class="form-control txt-entrada" name="apellidos" id="text-apellidos"  required>
        </div>
        <div class="form-row text-white">
          <div class="form-group col-md-6">
            <label for="inputCity">Grupo: </label>
            <input type="text" class="form-control" placeholder="Ej: TI1-7,TI2-7,TI10-1,TI10-2,ITI1-1"  id="inputCity" name="grupo"  style="text-transform:uppercase;" minlength="3" maxlength="8" required>
          </div>
          <div class="form-group text-white">
            <label for="text-pswrd">Contraseña:</label>
            <input type="password" class="form-control" name="pswrd" id="text-pswrd"  required>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <input class="btn btn-primary btn-sm" type="submit" name="registrarAlumno" value="Registrar">
        </div>
      </form>
    </div>
    <div class="modal-footer" style="background: #191B32;">
    </div>
  </div>
</div>
</div>