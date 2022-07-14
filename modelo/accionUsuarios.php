<?php 
include("../controlador/operaciones.php");
if (isset($_POST["activarAlumno"])) {
	$datos = array(
		'id_datos' => $_POST["id_datos"],
		'id_alumno' => $_POST["id_alumno"],
		'id_espera' => $_POST["id_espera"],
		'matricula' => $_POST["matricula"]
	);
	$res = Operaciones::activarAlumno($datos);

	if ($res == "Ok") {
		Operaciones::repPrincipal($datos["matricula"]);
		echo json_encode("OkLezma");
	}
}


?>