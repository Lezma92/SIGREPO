<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Administrador" || $_SESSION["nivel"] == "Maestro") {
  $id_user = $_SESSION["id_user"];
  $nivel = $_SESSION["nivel"];

  $tipo_r = $_GET["t"];

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
          <?php
          $titulo = "";
          if ($tipo_r == "integradora") {
            $titulo = "Programas Educativos, Integradora";
            echo("<li class='breadcrumb-item active'>Proyectos de integradora</li>");
          }elseif($tipo_r == "estadias"){
            $titulo = "Programas Educativos, Estadias";
            echo("<li class='breadcrumb-item active'>Proyectos de estadia</li>");
          }elseif($tipo_r == "especiales"){
            $titulo = "Programas Educativos, Especiales";
            echo("<li class='breadcrumb-item active'>Proyectos especiales</li>");
          }
          
          ?>
          
        </ol>

        <!-- Page Content -->
        <h4><?php echo($titulo);?></h4>
        <hr>




        <div class="card">
          <div class="card-header">
            <i class="fas fa-chart-area"> </i>

            <div class="card-title">
              <div>
                <div class="form-row" id="opciones">
                  <div class="form-group col-md-4">
                    <label for="inputState">Seleccione el grado que desea ver</label>
                    <select id="inputState" class="form-control categoria">
                      <option selected disabled>seleccionar</option>

                      <option value="TSU">Tecnico Superior</option>
                      <option value="ING">Ingenieria</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>
          </div>


          <div class="card-body misael" style="padding: 8px;">

            <?php include("../modelo/consultas.php"); ?>

            <?php
            $res = vistas::listarCarreras();


            ?>
            <div class="row">



              <?php
              $grupos = "";
              foreach ($res as $key => $value) {
                $grupos = $grupos . "-" . $value["id"];
              ?>
                <div class="card-group col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title text-center">
                        <?php 
                        $dirurl ="";
                        if ($tipo_r == "integradora") {
                          $dirurl = "integradora.php?cat=ING&pag=1&carrera=" . $value["id"];
                        }elseif($tipo_r == "estadias"){
                          $dirurl = "estadias.php?cat=ING&pag=1&carrera=" . $value["id"];
                        }elseif($tipo_r == "especiales"){
                          $dirurl = "especiales.php?cat=ING&pag=1&carrera=" . $value["id"];
                        } ?>
                        <a id="href_carrera<?php echo ($value["id"]); ?>" class="nav-link" href=<?php echo ($dirurl); ?>>
                        <img class="card-img-top" src="<?php echo ($value["logo"]);?>" style="height: 100px;" alt="Card image cap">
                        </a>
                      </h5>
                      <p class="card-text">
                      </p>
                    </div>
                  </div>
                </div>


              <?php } ?>
              <input type="hidden" value="<?php echo ($grupos); ?>" id="id_grupos">
            </div>
          </div>

        </div>

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