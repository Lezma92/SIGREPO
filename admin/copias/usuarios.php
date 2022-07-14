<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Administrador" || $_SESSION["nivel"] == "Maestro") {
    $id_user = $_SESSION["id_user"];
    $nivel = $_SESSION["nivel"];

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

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


                    <p>Administración de usuarios</p>

                    <div class="card mb-3 border-primary ">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i>
                            Lista de Usuarios

                            <button class="btn btn-primary btn-sm float-right " type="button" data-toggle="modal" data-target="#modal_password" class="btn btn-primary">
                                Agregar usuario:
                            </button>

                            <?php registrar::agregarAdminMaes(); ?>
                        </div>



                    </div>
                    <?php include('../modules/modal-regisAdmins.php'); ?>
                    <div class="card-body">
                        <div class="table-wrapper">


                            <div class="container scroll">
                                <table class="table isSearch " id="table_id" cellspacing="0">
                                    <thead>
                                        <tr class="table-heads ">
                                            <th>
                                                Matricula
                                            </th>
                                            <th>
                                                Nombre
                                            </th>
                                            <th>
                                                Apellidos
                                            </th>
                                            <th>
                                                Nivel
                                            </th>
                                            <th>
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $resultado = vistas::listarUsuarios();
                                        //print_r($resultado);
                                        foreach ($resultado as $key => $value) {
                                        ?>
                                            <tr>

                                                <td>
                                                    <?php echo ($value["matricula"]); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($value["nombre"]); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($value["apellidos"]); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($value["nivel_user"]); ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info modificarUser" <?php echo ("idDato = '" . $value["idDatos"] . "' idUser ='" . $value["idUser"] . "'") ?> data-toggle="modal" data-target="#modalActualizar">Modificar</button>
                                                    <button class="btn btn-sm eliminarUser" <?php echo ("idDato = '" . $value["idDatos"] . "' idUser ='" . $value["idUser"] . "'") ?> style="background:#FF2930;color:#FFF;">Eliminar</button>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('../modules/modalUpdate.php'); ?>


            </section>
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
        </script>
        <script src="js/sb-admin.min.js"></script>
        <script src="../controlador/scripts.js"></script>

        <!-- Core plugin JavaScript-->

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
    </body>


    </html>


<?php

} else {
    header('location:../modelo/logout.php');
}
?>