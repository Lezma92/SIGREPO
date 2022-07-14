<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "Administrador" || $_SESSION["nivel"] == "Maestro") {
    $id_user = $_SESSION["id_user"];
    $nivel = $_SESSION["nivel"];
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Alumnos - Admin</title>

        <!-- Bootstrap core CSS-->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <!-- Custom styles for this template-->

        <link href="css/sb-admin.css" rel="stylesheet">

        <script src="../js/sweetalert2.all.js"></script>
        <script src="../alertas/alertas.js"></script>

    </head>

    <body id="page-top">

        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

            <a class="navbar-brand mr-1" href="index.php">Repositorio Digital | SigRep</a>

            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-fw"></i>
                    </a>
                </li>
            </ul>

        </nav>

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

                    <!-- Page Content -->
                    <h3>Administración de alumnos</h3>

                    <div class="card border-primary table-responsive">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i>
                            Lista de Alumnos
                            <button class="btn btn-danger btn-sm float-right "> <a href="espera.php" class="text-white">En espera</a> </button>



                        </div>


                        <div class="card-body overflow-auto">
                            <table class="table Tabla_alumnos" id="table_id" cellspacing="0">
                                <thead>
                                    <tr class="table-heads ">
                                        <th class="">
                                            Matricula
                                        </th>
                                        <th class="">
                                            Nombre(s)
                                        </th>
                                        <th class="">
                                            Apellidos
                                        </th>
                                        <th class="">
                                            Grupo
                                        </th>
                                        <th class="">
                                            Nivel
                                        </th>
                                        <th class="">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $resultado = vistas::listarAlumnos();
                                    //print_r($resultado);
                                    foreach ($resultado as $key => $value) {
                                    ?>
                                        <tr>

                                            <td class="">
                                                <?php echo ($value["matricula"]); ?>
                                            </td>
                                            <td class="">
                                                <?php echo ($value["nombre"]); ?>
                                            </td>
                                            <td class="">
                                                <?php echo ($value["apellidos"]); ?>
                                            </td>
                                            <td class="">
                                                <?php echo ($value["grupo"]); ?>
                                            </td>
                                            <td class="">
                                                <?php echo ($value["nivel_estudio"]); ?>
                                            </td>
                                            <td class="">
                                                <!--   <button type="button" class="btn-pq btn-primary">Modificar</button>
                        <button type="button" class="btn-pq btn-secondary bg-danger">Eliminar</button> -->
                                                <button class="btn btn-sm btn-primary modificarAlumno" <?php echo ("matricula = '" . $value["matricula"] . "'"); ?> data-toggle="modal" data-target="#actualizarAl">Modificar</button>
                                                <button class="btn btn-sm eliminarAlumno" <?php echo ("idDato = '" . $value["idDatos"] . "' idUser ='" . $value["idUsuario"] . "' idAlumno = '" . $value["idAlumno"] . "'") ?>style="background:#FF2930;color:#FFF;">Eliminar</button>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <?php include("../modules/actualizarAlumnos.php"); ?>

            <?php registrar::actualizarAlumnos(); ?>


        </div>


        </div>
        </div>

        </div>


        <!-- Sticky Footer -->
        <?php include("footer.php") ?>

        </div>
        <!-- /.content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">0 to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión
                        actual.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" href="logout.php">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div><?php registrar::actualizarAlumnos(); ?>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.js"></script>
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

    </body>

    </html>
<?php

} else {
    header('location:../modelo/logout.php');
}
?>