<?php 
include("../controlador/operaciones.php");


if (isset($_POST["idDato"]) && isset($_POST["idUser"])) {
	$respuesta = Operaciones::getDatosUser($_POST["idDato"],$_POST["idUser"]);
	echo json_encode($respuesta);
}
if (isset($_POST["id_matricuala"])) {
	$respuesta = Operaciones::getDatosAlumnos($_POST["id_matricuala"]);
	echo json_encode($respuesta);
	
}


?>