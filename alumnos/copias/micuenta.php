<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Alumno") {
  $usuario = $_SESSION["id_user"];
  $nivel = $_SESSION["nivel"];
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
                    <a href="index.php">Mi cuenta</a>
                </li>
                <li class="breadcrumb-item active">Datos personales</li>
            </ol>
            <div class="card">

                <div class="card-body">
                    <?php $valor = vistas::getDatosAlumnos($usuario); ?>
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <img src="../img/user.png" style="height: 100px; width: 100px;">
                        </div>
                        <div class="text-aling-center">
                            <h4>
                                Bienvenido <?php echo ($valor["nombre"] . " " . $valor["apellidos"]); ?>
                            </h4>
                            <h6>
                                Gestiona tu información, privacidad y seguridad para mejorar tu experiencia en Sigproti
                            </h6>
                        </div>

                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Nombre:</label>
                                    <input type="text" id="txtNombre" name="txtNombre" disabled
                                        value="<?php echo ($valor["nombre"]); ?>" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Apellidos:</label>
                                    <input type="text" id="txtapps" name="txtapps" disabled
                                        value="<?php echo ($valor["apellidos"]); ?>" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Grupo:</label>
                                    <input type="text" id="grupo" name="grupo" disabled
                                        value="<?php echo ($valor["grupo"]); ?>" class="form-control" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Nivel de estudio:</label>
                                    <input type="text" id="nivel_estudio" name="nivel_estudio" disabled
                                        value="<?php echo ($valor["nivel_estudio"]); ?>" class="form-control" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Contraseña:</label>
                                    <input type="text" id="pass" name="pass" disabled
                                        value="<?php echo ($valor["pswrd"]); ?>" class="form-control" required>
                                </div>
                            </div>
                            <!-- <h3 class="">
                                <button type="button" data-toggle="modal" data-target="#modal_password"
                                    class="btn btn-primary">Cambiar contraseña</button>
                            </h3>   -->
                            <?php include("../modules/modal_contra.php"); ?>
                            <?php registrar::setPass(); ?>
                        </div>


                    </div>
                  

                   
                </div>
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