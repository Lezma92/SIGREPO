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
  <html  lang="es">
  <head>
    <!-- Site made with Mobirise Website Builder v4.11.5, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.11.5, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="../assets/images/logo2.png" type="image/x-icon">
    <meta name="description" content="sigproti.com.mx">

    <title>Registrar usuarios</title>
    <link rel="stylesheet" href="../assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../assets/tether/tether.min.css">
    <link rel="stylesheet" href="../assets/animatecss/animate.min.css">
    <link rel="stylesheet" href="../assets/datatables/data-tables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/dropdown/css/style.css">
    <link rel="stylesheet" href="../assets/theme/css/style.css">
    <link rel="preload" as="style" href="../assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="../assets/mobirise/css/mbr-additional.css" type="text/css">
      <script src="../js/sweetalert2.all.js" ></script>
    <script src="../alertas/alertas.js" ></script>



  </head>
  <body>
    <?php include("../modules/menu-alumnos.php"); ?>
    <?php include("../modelo/consultas.php"); ?>
    <section class="section-table cid-rHSjdQlM79" id="table1-i">
      <div class="container">
        <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
          Catálogo de proyectos de <?php echo($_SESSION["grado_estudio"]); ?>
        </h2>
        <h3 class="mbr-section-subtitle  display-5 align-center mbr-light mbr-fonts-style">
          Aquí encontrarás todos los proyectos de tus compañeros
        </h3>
      </div>
      <div class="card-body">
        <div class="table-wrapper">
          <div class="container">
            <div class="row search">
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <div class="dataTables_filter">
                  <label class="searchInfo mbr-fonts-style display-7">Search:</label>
                  <input class="form-control input-sm" disabled="">
                </div>
              </div>
            </div>
          </div>

          <div class="container scroll">
           <div class="row">
            <?php $resultado = vistas::getTdosProyectos(); 
            //print_r($resultado);
            foreach ($resultado as $key => $value) {
              ?>
              <div class="col-xs-12 col-md-6 col-lg-3" style="margin-top: 15px;">
               <div class="card-img">
                <img src="<?php echo($value["icono"]); ?>" alt="Mobirise" style="height: 180px;width: 200px">
              </div>
              <div class="card-header" style="height: 255px">
                <h2 class="mbr-element-title  align-left mbr-fonts-style pb-2 display-7">
                  Propietario: <?php echo($value["nombreAlumno"]); ?>
                </h2>
                <h2 class="mbr-element-title  align-left mbr-fonts-style pb-2 display-7">
                  Grupo: <?php echo($value["grupo"]); ?>
                </h2>
                <h2 class="mbr-element-title  align-left mbr-fonts-style pb-2 display-7">
                  Proyecto: <?php echo($value["nombre_proyecto"]); ?>
                </h2>
                <p class="mbr-section-text  align-justify mbr-fonts-style display-7">
                  <?php if (strlen($value["descripcion"]) > 150) {?>
                    <?php echo(substr($value["descripcion"], 0,80)."..."); ?>
                  <?php }else{  ?>
                    <?php echo($value["descripcion"]); ?>
                  <?php } ?>
                </p>
                <h2 class="mbr-element-title  align-left mbr-fonts-style pb-2 display-7">
                  Categoría: <?php echo($value["categoria"]); ?>
                </h2>
              </div>
              <div class="card-footer">
                <div class="mbr-section-btn text-center">
                  <form method="POST">
                    <input type="hidden" name="idProyecto" value="<?php echo($value["idProyecto"]); ?>">
                    <input type="hidden" name="idRepositorio" value="<?php echo($value["idRepositorio"]); ?>">
                    <input type="hidden" name="nombre_proyecto" value="<?php echo($value["nombre_proyecto"]); ?>">
                    <input type="hidden" name="matricula" value="<?php echo($value["matricula"]); ?>">
                    <input type="hidden" name="descripcion" value="<?php echo($value["descripcion"]); ?>">
                    <button type="submit" name="explorar" class="btn btn-primary" style="border-radius: 28px">
                      Explorar 
                    </button>
                  </form>
                </div>
              </div>

            </div>
          <?php } ?>
        </div>

      </tbody>
    </table>
  </div>
  <div class="container table-info-container">
    <div class="row info">
      <div class="col-md-6">
        <div class="dataTables_info mbr-fonts-style display-7">
          <span class="infoBefore">Resultados</span>
          <span class="inactive infoRows"></span>
          <span class="infoAfter"></span>
          <span class="infoFilteredBefore">(filtered from</span>
          <span class="inactive infoRows"></span>
          <span class="infoFilteredAfter"> total entries)</span>
        </div>
      </div>
      <div class="col-md-6"></div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</section>

<script src="../assets/web/assets/jquery/jquery.min.js"></script>
<script src="../assets/popper/popper.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/tether/tether.min.js"></script>
<script src="../assets/smoothscroll/smooth-scroll.js"></script>
<script src="../assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="../assets/viewportchecker/jquery.viewportchecker.js"></script>
<script src="../assets/datatables/jquery.data-tables.min.js"></script>
<script src="../assets/datatables/data-tables.bootstrap4.min.js"></script>
<script src="../assets/dropdown/js/nav-dropdown.js"></script>
<script src="../assets/dropdown/js/navbar-dropdown.js"></script>
<script src="../assets/theme/js/script.js"></script>


<input name="animation" type="hidden">
</body>
</html>
<?php 

}else{
  header('location:../modelo/logout.php');
}
?>