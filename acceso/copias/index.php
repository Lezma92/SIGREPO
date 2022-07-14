<?php session_start(); ?>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../assets/images/logo2.png" type="image/x-icon">
    <title>Acceso al sistema|Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/miestilo.css">
    <script src="../js/valid.js"></script>
    <script src="../js/sweetalert2.all.js"></script>
</head>

<body id="back">
    <div class="wrapper">
        <div id="formContent">
            <form method="POST" name="formLogin" class="formLogin">
                <h1 class="h3 font-weight-normarl" style="color:#fff; margin-top: 5px;">INICIAR SESIÓN</h1>
                <!-- Icon -->
                <div class="fadeIn first" style="margin-bottom: 10px;">
                    <img src="../img/user2.png" id="icon" alt="User Icon" width="100" height="100" />
                </div>
                <label for="inputEmail" class="sr-only">Usuario</label>
                <input name="username" id="inputEmail" type="number" class="form-control" onkeypress="return soloNumeros(event);" placeholder="Usuario" required>
                <label for="inputPassword" class="sr-only">Contraseña</label>
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Contraseña" required>
                <input type="submit" class="fadeIn fourth" name="btnAcceso" value="Ingresar" style="margin-top: 20px;">
                <?php
                include("../modelo/inicio-sesion.php");
                login();
                ?>
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover btn text-white" data-toggle="modal" data-target="#exampleModalLabel">Registrate</a>
            </div>
        </div>
        <?php
        include('../modules/modal_registros.php');
        include("../modelo/registros.php");
        $r = registrar::insertAlumnos();
        if ($r == "Ok") {
            alertas::alertConfirmOk("Tu solicitud de registro se realizo exitosamente", "Notifica a tu administrador para que active tu usuario", "../acceso/", "success");
        }
        ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
</body>

</html>