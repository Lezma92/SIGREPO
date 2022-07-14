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


			<div class="content-wrapper">
				<div class="container-fluid " style="margin-bottom: 85px;">
					<!-- Breadcrumbs-->
					<ol class="breadcrumb" style="margin-top: 10px">
						<li class="breadcrumb-item">
							<a href="index.php">Panel de Control</a>
						</li>
						<li class="breadcrumb-item active">Agregar proyectos</li>
					</ol>

					<div class="card  border-primary">
						<div class="card-header">
							<span><i class="far fa-folder-open"></i> Crear Repositorio</span>


						</div>

						<div class="card-body misael" style="padding: 8px;">

							<body>

								<?php include("../modelo/consultas.php"); ?>
								<?php include("../modelo/registros.php") ?>

								<div class="container">

									<h5 class="align-center">
										Un repositorio contiene todos los archivos del proyecto, incluido el historial de
										revisiones
									</h5>
								</div>

								<div class="container">

									<div class="card">
										<div class="card-header" style="margin-bottom: 15px;">
											<h5 class="align-left">
												Datos del repositorio: <?php echo ($id_user . "/"); ?>
											</h5>
										</div>
										<div class="card-body">
											<form method="POST" enctype="multipart/form-data">
												<div class="form-row">
													<div class="form-group col-md-4">
														<label for="inputState">Categoria:</label>
														<select id="inputState" name="categoria" class="form-control" required>
															<option selected disabled value="">
																<--seleccionar-->
															</option>
															<option value="Integradora">Integradora</option>
															<option value="Estadía">Estadías</option>
															<option value="Especial">Especial</option>
														</select>
													</div>
													<div class="form-group col-md-6">
														<?php $respuesta = vistas::getAsesores(); ?>
														<label for="inputState">Asesor:</label>
														<select id="inputState" class="form-control" name="asesor" required>
															<option selected disabled value="">
																<--seleccionar-->
															</option>
															<?php foreach ($respuesta as $key => $value) { ?>
																<option value="<?php echo ($value["idAsesor"]); ?>">
																	<?php echo ($value["matricula"] . ": " . $value["nombre"]); ?>
																</option>
															<?php } ?>

														</select>
													</div>
												</div>
												<div class="form-row">

													<div class="form-group col-md-4 autocomplete">
														<label for="propietario">Propietario</label>
														<input id="propietario" name="propietario" type="text" class="form-control" placeholder="Matricula" required>
													</div>
													<div class="form-group col-md-6">
														<label for="inputEmail4">Nombre del repositorio:</label>
														<input type="text" placeholder="Ej: Programación, Sistema Gestor de Pagos, etc..." name="txtNombre" class="form-control" required>
													</div>
													<div class="form-group col-md-10">
														<label for="inputEmail4">Descripción:</label>
														<input type="text" name="txtDescripcion" class="form-control" required>
													</div>
													<div class="form-group">
														<label for="icono">Icono del proyecto:</label>
														<input type="file" class="form-control" name="icono" id="icono" accept="image/png, .jpeg, .jpg" required>
													</div>
												</div>


												<button type="submit" name="btn-crear" class="btn btn-primary">Crear
													repositorio</button>
											</form>

										</div>
									</div>



								</div>
								<?php registrar::agregarProyectos(); ?>
						</div>
					</div>


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
	<script src="../controlador/busqueda_filtrada.js"></script>


	</html>
<?php

} else {
	header('location:../modelo/logout.php');
}
?>

<style>
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/*the container must be positioned relative:*/
	.autocomplete {
		position: relative;
		display: inline-block;
	}



	input[type=submit] {
		background-color: DodgerBlue;
		color: #fff;
		cursor: pointer;
	}

	.autocomplete-items {
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;
		border-top: none;
		z-index: 99;
		/*position the autocomplete items to be the same width as the container:*/
		top: 100%;
		left: 0;
		right: 0;
	}

	.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #fff;
		border-bottom: 1px solid #d4d4d4;
	}

	/*when hovering an item:*/
	.autocomplete-items div:hover {
		background-color: #e9e9e9;
	}

	/*when navigating through the items using the arrow keys:*/
	.autocomplete-active {
		background-color: DodgerBlue !important;
		color: #ffffff;
	}
</style>