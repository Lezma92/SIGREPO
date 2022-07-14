<?php

session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Administrador" || $_SESSION["nivel"] == "Maestro") {
  $id_user = $_SESSION["id_user"];
  $nivel = $_SESSION["nivel"];

  $categoria = $_GET["cat"];
  if (isset($_POST["explorar"])) {
    $_SESSION["idProyecto"] = $_POST["idProyecto"];
    $_SESSION["idRepositorio"] = $_POST["idRepositorio"];
    $_SESSION["nombre_proyecto"] = $_POST["nombre_proyecto"];
    $_SESSION["descripcion"] = $_POST["descripcion"];
    $_SESSION["matricula"] = $_POST["matricula"];
    $_SESSION["pagina"] = "Personal";
    header("location: verArchivos.php");
  }
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especiales - Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
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

      <div class="container-fluid " style="margin-bottom: 85px;">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb" style="margin-top: 10px">
          <li class="breadcrumb-item">
            <a href="index.php">Panel de Control</a>
          </li>
          <li class="breadcrumb-item active">Proyectos especiales</li>
        </ol>

        <!-- Page Content -->
        <h4>Administración de proyectos de <?php echo ($_GET["cat"]); ?></h4>
        <hr>
        <!-- <p></p> -->

        <div class="card-title">
          <div>
            <div class="form-row" id="opciones">
              <div class="form-group col-md-4">
                <label for="inputState">Seleccione el grado que desea ver</label>
                <select id="inputState" class="form-control categoria" onchange="">
                  <option selected disabled>seleccionar</option>

                  <option value="TSU">Tecnico Superior</option>
                  <option value="ING">Ingenieria</option>
                </select>
              </div>
            </div>
          </div>

        </div>

        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Proyectos registrados
          <button class="btn btn-primary btn-sm float-right"><a href="agregar_rep.php?cat=<?php echo ($_GET["cat"]); ?>" class="text-white bold"><i class="fas fa-folder-plus"></i> Agregar Repositorio</a></button>


        </div>

        <div class="card-body misael" style="padding: 8px;">

          <?php include("../modelo/consultas.php"); ?>

          <?php
          $res = vistas::resultadoTotal($categoria, "Especiales");
          $articulosxpagina = 6;
          $totalResult = count($res);
          $totalPaginas = ceil($totalResult / 6);
          $mostrarPag = ($_GET["pag"] - 1) * $articulosxpagina;
          $verResultados = vistas::getTdosProyectos($categoria, "Especiales", $mostrarPag, $articulosxpagina);


          ?>
          <div class="row">



            <?php
            foreach ($verResultados as $key => $value) {
            ?>
              <div class="card-group col-md-4">
                <div class="card">
                  <img class="card-img-top" src="<?php echo ($value["icono"]); ?>" style="height: 180px;" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo ($value["nombre_proyecto"]); ?></h5>
                    <p class="card-text">
                      <strong><?php echo ($value["nombreAlumno"]); ?></strong><br>
                      <strong><?php echo ("Grupo: " . $value["grupo"]); ?></strong><br>

                      <?php if (strlen($value["descripcion"]) > 150) { ?>
                        <?php echo (substr($value["descripcion"], 0, 80) . "..."); ?>
                      <?php } else {  ?>
                        <?php echo ($value["descripcion"]); ?>
                      <?php } ?>
                    </p>
                    <p class="card-text"><small class="text-muted">

                        <form method="POST">
                          <input type="hidden" name="idProyecto" value="<?php echo ($value["idProyecto"]); ?>">
                          <input type="hidden" name="idRepositorio" value="<?php echo ($value["idRepositorio"]); ?>">
                          <input type="hidden" name="nombre_proyecto" value="<?php echo ($value["nombre_proyecto"]); ?>">
                          <input type="hidden" name="matricula" value="<?php echo ($value["matricula"]); ?>">
                          <input type="hidden" name="descripcion" value="<?php echo ($value["descripcion"]); ?>">
                          <button type="submit" name="explorar" class="btn btn-primary">
                            Explorar
                          </button>
                          <?php if ($_SESSION["nivel"] == "Administrador") { ?>
                            <button type="button" name="eliminar" onclick="eliminarRepositorios(<?php echo ($value["idProyecto"]); ?>,<?php echo ($value["matricula"]); ?>,'<?php echo ($value["nombre_proyecto"]); ?>',3,'<?php echo ($_GET["cat"]); ?>',<?php echo ($_GET["pag"]); ?>);" id="eliminar" class="btn  bg-danger">
                              Eliminar
                            </button>
                          <?php } ?>
                        </form>
                      </small></p>
                  </div>
                </div>
              </div>



            <?php } ?>
          </div>



        </div>




        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item <?php echo ($_GET["pag"] <= $totalPaginas ? "disabled" : "")
                                  ?> ">
              <a class="page-link" href="especiales.php?cat=<?php echo ($_GET["cat"]); ?>&pag=<?php echo ($_GET["pag"] - 1); ?>">Anterior</a>
            </li>

            <?php
            for ($i = 0; $i < $totalPaginas; $i++) { ?>

              <li class="page-item <?php echo ($_GET["pag"] == $i + 1 ? "active" : ""); ?>">
                <a class="page-link " href="especiales.php?cat=<?php echo ($_GET["cat"]); ?>&pag=<?php echo ($i + 1); ?>"><?php echo ($i + 1) ?></a>
              </li>
            <?php            }              ?>

            <li class="page-item <?php echo ($_GET["pag"] >= $totalPaginas ? "disabled" : "") ?> "><a class="page-link" href="especiales.php?cat=<?php echo ($_GET["cat"]); ?>&pag=<?php echo ($_GET["pag"] + 1); ?>">Siguiente</a>
            </li>
          </ul>
        </nav>

      </div>

    </div>



    <!-- Sticky Footer -->
    <?php include("footer.php"); ?>

    </div>
    <!-- /.content-wrapper -->

    </div>

  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../controlador/scripts.js"></script>
  <script src="js/sb-admin.min.js"></script>


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