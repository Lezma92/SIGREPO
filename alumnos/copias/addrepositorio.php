<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Alumno") {
  $usuario = $_SESSION["id_user"];
  $nivel = $_SESSION["nivel"];
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel de Control - ConfiguroWeb</title>
    <!-- Bootstrap core CSS-->
    <link href="../admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="../admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="../admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="../js/sweetalert2.all.js"></script>
    <script src="../alertas/alertas.js"></script>
    <!-- Custom styles for this template-->
    <link href="../admin/css/sb-admin.css" rel="stylesheet">



  </head>


  <body id="page-top">
    <?php include("nav_bar.php"); ?>
    <?php include("../modelo/consultas.php"); ?>
    <?php include("../modelo/registros.php") ?>

    <div id="wrapper">
      <!------------------ Sidebar ------------------->
      <?php
      include("slidebar.php");
      ?>



      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Crear Repositorio</a>
            </li>
            <li class="breadcrumb-item active">Formulario</li>
          </ol>



          <div class="container">
            <h6>
              Crea un nuevo repositorio.
            </h6>
            <p>
              Un repositorio contiene todos los archivos del proyecto, incluido el historial de revisiones
            </p>
          </div>

          <div class="container">
            <div class="container container-table">
              <div>

                <div class="card ">
                  <div class="card-header">
                    <h3>
                      Datos del repositorio: <?php echo ($usuario . "/"); ?>
                    </h3>
                  </div>

                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputState">Categoria:</label>
                          <select id="inputState" name="categoria" class="form-control" required>
                            <option selected disabled value="">
                              <--seleccionar-->
                            </option>
                            <option value="Integradora">Integradora</option>
                            <option value="Estadía">Estadías</option>
                            <option value="Especial">Especial</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <?php $respuesta = vistas::getAsesores(); ?>
                          <label for="inputState">Asesor:</label>
                          <select id="inputState" class="form-control" name="asesor" required>
                            <option selected disabled value="">
                              <--seleccionar-->
                            </option>
                            <?php foreach ($respuesta as $key => $value) { ?>
                              <option value="<?php echo ($value["idAsesor"]); ?>"><?php echo ($value["matricula"] . ": " . $value["nombre"]); ?></option>
                            <?php } ?>

                          </select>
                        </div>
                      </div>
                      <div class="form-row">

                        <div class="form-group col-md-4">
                          <label for="inputState">Propietario</label>
                          <select id="inputState" class="form-control" name="propietario" required>
                            <option value="<?php echo ($usuario); ?>" selected><?php echo ($usuario); ?></option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Nombre del repositorio:</label>
                          <input type="text" placeholder="Ej: Programación, Sistema Gestor de Pagos, etc..." name="txtNombre" class="form-control" required>
                        </div>
                        <div class="form-group col-md-10">
                          <label for="inputEmail4">Descripción:</label>
                          <input type="text" name="txtDescripcion" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="icono">Icono del proyecto:</label>
                          <input type="file" class="form-control" name="icono" id="icono" accept="image/png, .jpeg, .jpg" required>
                        </div>
                      </div>


                      <button type="submit" name="btn-crear" class="btn btn-primary">Crear repositorio</button>
                    </form>
                  </div>

                </div>
              </div>

            </div>
          </div>
          <?php registrar::agregarProyectos(); ?>
        </div>
      </div>



    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <?php include("footer.php"); ?>

    </div>
    <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="../admin/vendor/jquery/jquery.min.js"></script>
    <script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../controlador/scripts.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../admin/js/sb-admin.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        refreshTableOrder();
      });

      function refreshTableOrder() {
        $("#tblBodyCurrentOrder").load("displayorder.php?cmd=display");
      }

      //refresh order current list every 3 secs
      setInterval(function() {
        refreshTableOrder();
      }, 3000);
    </script>


  </body>

  </html>
<?php

} else {
  header('location:../modelo/logout.php');
}
?>