<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Alumno" && isset($_SESSION["idProyecto"])) {
  $usuario = $_SESSION["id_user"];
  $nivel = $_SESSION["nivel"];
  $pagina = $_SESSION["pagina"];

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
            <a href="index.php">Panel de Control</a>
          </li>
          <li class="breadcrumb-item active">Proyectos de integradora</li>
          <li class="breadcrumb-item active"><?php echo ($_SESSION["nombre_proyecto"]); ?></li>
        </ol>
        <div class="card">
          <div class="card-header">
            <?php if ($pagina == "Personal") { ?>
              <h6>
                Subir archivos a su repositorio: <?php echo ($_SESSION["nombre_proyecto"]); ?>
              </h6>

            <?php } ?>
       
                <h6>
                  <?php echo ($_SESSION["matricula"] . "/" . $_SESSION["nombre_proyecto"]); ?><br>

                </h6>
                <h5>
                  Descripción: <?php echo ($_SESSION["descripcion"]); ?>
                </h5>
                <?php if ($pagina == "Personal") { ?>
                  <form method="post" enctype="multipart/form-data">
                    <div class="form-group">

                      <input id="archivos" class="form-control" accept="image/png, .jpeg, .jpg, image/gif,.pdf,.zip,.sql,.doc, .docx,.txt" type="file" name="archivos[]" multiple required>
                      <button type="submit" name="subirArchivos" class="btn btn-primary btn-sm">Subir archivos</button>
                    </div>
                  </form>
                <?php } ?>

                <?php registrar::subirArchivos(); ?>
          </div>
        </div>
        <div class="card-body">

          <table class="table isSearch" id="table_id">
            <thead>
              <tr class="table-heads ">
                <th class="head-item  display-7">
                  Archivos
                </th>
                <th class="head-item  display-7">
                  Tamaño
                </th>
                <th class="head-item  display-7">
                  Fecha
                </th>
                <th class="head-item  display-7">
                  Hora
                </th>
                <th class="head-item  display-7">
                  Acción
                </th>
              </tr>
            </thead>

            <tbody>
              <?php $resultado = vistas::getArchivos();
              //print_r($resultado);
              foreach ($resultado as $key => $value) {
              ?>
                <tr>
                  <td class="body-item  display-7">
                    <a href="<?php echo ($value["ruta"]); ?>" target="_blank">
                      <?php echo ($value["nombre"]); ?>
                    </a>
                  </td>
                  <td class="body-item  display-7">
                    <?php echo ($value["tama"] . "kB"); ?>
                  </td>
                  <td class="body-item  display-7">
                    <?php echo ($value["fecha"]); ?>
                  </td>
                  <td class="body-item  display-7">
                    <?php echo ($value["hora"]); ?>
                  </td>
                  <td class="body-item  display-7">
                    <a href="<?php echo ($value["ruta"]); ?>" class="btn btn-nvo btn-warning" download>Descargar</a>
                    <?php if ($_SESSION["nivel"] == "Administrador") { ?>
                      <button type="button" <?php echo ("id_archivo = '" . $value["idArchivo"] . "'") ?> class="btn btn-nvo bg-danger btn_eliminar">Eliminar</button>
                    <?php } ?>
                  </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>

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