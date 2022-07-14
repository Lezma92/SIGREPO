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
    $_SESSION["pagina"] = "verTodos";
    header("location: archivos.php");
  }
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivos - Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="../admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- Custom styles for this template-->

    <link href="../admin/css/sb-admin.css" rel="stylesheet">

    <script src="../js/sweetalert2.all.js"></script>
    <script src="../alertas/alertas.js"></script>




  </head>

  <body id="page-top">

    <?php
    include("nav_bar.php");
    ?>

    <?php require_once("../alertas/alert.php"); ?>
    <?php include("../modelo/consultas.php"); ?>
    <?php include("../modelo/registros.php"); ?>


    <div id="wrapper">
      <?php


      include("slidebar.php");
      ?>
      <div class="container-fluid">

        <ol class="breadcrumb" style="margin-top: 10px">
          <li class="breadcrumb-item">
            <a href="index.php">Todos los repositorios</a>
          </li>
          <li class="breadcrumb-item active">Historial</li>
        </ol>
        <div class="card">
          <div class="card-header">
            <h5>
              Catálogo de proyectos de <?php echo ($_SESSION["grado_estudio"]); ?>
            </h5>
            <h6>
              Aquí encontrarás todos los proyectos de tus compañeros
            </h6>
          </div>

          <div class="card-body">

            <div class="row">
              <?php $resultado = vistas::getTdosProyectos();
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

  </body>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script src="../controlador/scripts.js"></script>

  <script src="js/sb-admin.min.js"></script>
  <script>
    var table = $('#table_id').DataTable({
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },
    });
    $(document).ready(function() {
      $('#table_id').DataTable();
    });
  </script>

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