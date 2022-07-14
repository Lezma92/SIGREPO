<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Alumno") {
  $usuario = $_SESSION["id_user"];
  $nivel = $_SESSION["nivel"];


  if (isset($_POST["explorar"])) {
    $_SESSION["idProyecto"] = $_POST["idProyecto"];
    $_SESSION["idRepositorio"] = $_POST["idRepositorio"];
    $_SESSION["nombre_proyecto"] = $_POST["nombre_proyecto"];
    $_SESSION["descripcion"] = $_POST["descripcion"];
    $_SESSION["matricula"] = $_POST["matricula"];
    $_SESSION["pagina"] = "Personal";
    header("location: archivos.php");
  }
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
              <a href="index.php">Mis Repositorios</a>
            </li>
            <li class="breadcrumb-item active">Historial</li>
          </ol>



          <div class="container">
            <h5>
              Mis repositorios
            </h5>
            <p>
              Todos tus proyectos en un solo lugar
            </p>
          </div>



          <div>

            <div class="card ">
              <div class="card-header">
                <h6>
                  Carpeta Raíz: <?php echo ($usuario . "/"); ?>
                </h6>
              </div>

              <div class="card-body">
                <div class="row">
                  <?php $resultado = vistas::getProyectos($usuario);
                  //print_r($resultado);
                  foreach ($resultado as $key => $value) {
                  ?>
                    <div class="card-group col-md-4">

                      <div class="card">
                        <img class="card-img-top" src="<?php echo ($value["icono"]); ?>" style="height: 180px;" alt="Card image cap">
                        <div class="card-body">
                          <h5>
                            Proyecto: <?php echo ($value["nombre_proyecto"]); ?>
                          </h5>
                          <p class="">
                            <?php if (strlen($value["descripcion"]) > 150) { ?>
                              <?php echo (substr($value["descripcion"], 0, 140) . "..."); ?>
                            <?php } else {  ?>
                              <?php echo ($value["descripcion"]); ?>
                            <?php } ?>
                          </p>
                          <h6>
                            Categoría: <?php echo ($value["categoria"]); ?>
                          </h6>


                        </div>
                        <div class="card-footer  d-flex justify-content-center">
                          <form method="POST">
                            <input type="hidden" name="idProyecto" value="<?php echo ($value["idProyecto"]); ?>">
                            <input type="hidden" name="idRepositorio" value="<?php echo ($value["idRepositorio"]); ?>">
                            <input type="hidden" name="nombre_proyecto" value="<?php echo ($value["nombre_proyecto"]); ?>">
                            <input type="hidden" name="matricula" value="<?php echo ($value["matricula"]); ?>">
                            <input type="hidden" name="descripcion" value="<?php echo ($value["descripcion"]); ?>">
                            <button type="submit" name="explorar" class="btn btn-primary">
                              Explorar
                            </button>
                          </form>
                        </div>



                      </div>



                    </div>
                  <?php } ?>
                </div>
              </div>

            </div>
          </div>


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