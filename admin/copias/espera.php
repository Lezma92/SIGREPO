<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Administrador" || $_SESSION["nivel"] == "Maestro") {
  $id_user = $_SESSION["id_user"];
  $nivel = $_SESSION["nivel"];
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">


    <!-- Custom styles for this template-->

    <link href="css/sb-admin.css" rel="stylesheet">

    <script src="../js/sweetalert2.all.js"></script>
    <script src="../alertas/alertas.js"></script>




  </head>

  <body id="page-top">

    <?php
    include("nav_bar.php");
    ?>
    <div id="wrapper">
      <!------------------ Sidebar ------------------->
      <?php
      include("slidebar.php");
      ?>

      <div id="content-wrapper">
        <?php require_once("../alertas/alert.php"); ?>
        <?php include("../modelo/consultas.php"); ?>
        <?php include("../modelo/registros.php"); ?>
        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>


          <p>Lista de alumnos que están en espera de activación</p>

          <div class="card mb-3 border-primary ">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Lista de Usuarios
              <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModalLabel">Nuevo Alumno(a)</button>

              <?php registrar::agregarAdminMaes(); ?>
            </div>

            <div class="card-body">
              <div class="card-body pad table-responsive">

                <table id="myTable" class="table table-bordered">
                  <tr>
                    <td>#</td>
                    <td>Matricula</td>
                    <td>Nombre(s)</td>
                    <td>Apellidos</td>
                    <td>Nivel</td>
                    <td>Acción</td>
                  </tr>
                  <tbody>
                    <?php $resultado = vistas::enEspera();
                    //print_r($resultado);
                    foreach ($resultado as $key => $value) {
                    ?>
                      <tr>

                        <td>
                          <?php echo ($key + 1); ?>
                        </td>
                        <td>
                          <?php echo ($value["matricula"]); ?>
                        </td>
                        <td>
                          <?php echo ($value["nombre"]); ?>
                        </td>
                        <td>
                          <?php echo ($value["grupo"]); ?>
                        </td>
                        <td>
                          <?php echo ($value["nivel_estudio"]); ?>
                        </td>
                        <td>
                          <button type="button" onclick="activarAlumno(<?php echo ($value["matricula"]); ?>,<?php echo ($value["idDatos"]); ?>,<?php echo ($value["id_alumno"]); ?>,<?php echo ($value["id_espera"]); ?>);" class="btn-pq btn-primary">Activar</button>
                          <!--  <button type="button" class="btn-pq btn-secondary bg-danger">Eliminar</button> -->
                        </td>

                      </tr>
                    <?php } ?>
                  </tbody>

                </table>
              </div>


            </div>
          </div>

        </div>

        <?php include('../modules/modal_registros.php');
        $r = registrar::insertAlumnos();
        if ($r == "Ok") {
          //($titulo,$mensaje,$ruta,$tipo)
          alertas::alertConfirmOk("Tu solicitud de registro se realizo exitosamente", "Notifica a tu administrador para que active tu usuario", "../admin/espera.php", "success");
          # code...
        }
        ?>
        <!-- Sticky Footer -->
        <?php include("footer.php");?>

      </div>
      <!-- /.content-wrapper -->

    </div>


  </body>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../controlador/scripts.js"></script>

  <script src="js/sb-admin.min.js"></script>

  <?php include('../modules/modal_registros.php');

  $r = registrar::insertAlumnos();
  if ($r == "Ok") {
    //($titulo,$mensaje,$ruta,$tipo)
    alertas::alertConfirmOk("Tu solicitud de registro se realizo exitosamente", "Notifica a tu administrador para que active tu usuario", "../admin/espera.php", "success");
    # code...
  }
  ?>

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




  </html>
<?php

} else {
  header('location:../modelo/logout.php');
}
?>