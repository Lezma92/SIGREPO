<?php 
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Alumno") {
  $usuario = $_SESSION["id_user"];
  $nivel = $_SESSION["nivel"];
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
    <?php include("../modelo/registros.php"); ?>
    <?php $valor = vistas::getDatosAlumnos($usuario); ?>
    <section class="section-table cid-rHSjdQlM79" id="table1-i">
      <div class="container">
       <div class="mbr-section-subtitle  display-5 align-center mbr-light mbr-fonts-style">
        <img src="../img/user.png" style="height: 100px; width: 100px;">
      </div>
      <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
        Bienvenido <?php echo($valor["nombre"]." ".$valor["apellidos"]); ?>
      </h2>
      <h3 class="mbr-section-subtitle  display-5 align-center mbr-light mbr-fonts-style">
        Gestiona tu información, privacidad y seguridad para mejorar tu experiencia en Sigproti
      </h3>

    </div>

    <div class="container mt-5">
      <div class="container container-table">
       <div class="card ">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nombre:</label>
            <input type="text" id="txtNombre" name="txtNombre" disabled value="<?php echo($valor["nombre"]); ?>" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">Apellidos:</label>
            <input type="text"  id="txtapps" name="txtapps" disabled value="<?php echo($valor["apellidos"]); ?>" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">Grupo:</label>
            <input type="text" id="grupo" name="grupo" disabled value="<?php echo($valor["grupo"]); ?>" class="form-control" required>
          </div>
          <div class="form-group col-md-3">
            <label for="inputEmail4">Nivel de estudio:</label>
            <input type="text" id="nivel_estudio" name="nivel_estudio"  disabled value="<?php echo($valor["nivel_estudio"]); ?>" class="form-control" required>
          </div>
          <div class="form-group col-md-3">
            <label for="inputEmail4">Contraseña:</label>
            <input type="text" id="pass" name="pass" disabled value="<?php echo($valor["pswrd"]); ?>" class="form-control" required>
          </div>
        </div>

        <h3 class="mbr-section-subtitle  display-5 align-center mbr-light mbr-fonts-style">
          <button type="button"  data-toggle="modal"  data-target="#modal_password" class="btn btn-primary">Cambiar contraseña</button>
        </h3>
      </div>
      
    </div>
    <?php include("../modules/modal_contra.php"); ?>
  </div>
  <?php registrar::setPass(); ?>
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




<input name="animation" type="hidden">
</body>
</html>
<?php 

}else{
  header('location:../modelo/logout.php');
}
?>