<?php
require_once("../controlador/operaciones.php");

if (isset($_POST["id_archivo"])) {
	$id_archivo = $_POST["id_archivo"];
	try {
		$a = Operaciones::getUrlArch($id_archivo);
		unlink($a["ruta"]);
		$respuesta = Operaciones::eliminarArchivos($id_archivo);
		echo json_encode($respuesta);
	} catch (Exception $e) {
	}
} elseif (isset($_POST["idUser"]) && isset($_POST["idDato"])) {
	$respuesta = Operaciones::eliminarAdmin($_POST["idUser"], $_POST["idDato"]);
	echo (json_encode($respuesta));
} elseif (isset($_POST["id_datos_alumno"]) && isset($_POST["id_user_alumno"]) && isset($_POST["id_alumno"])) {
	$id_usuario = $_POST["id_user_alumno"];
	$id_alumno = $_POST["id_alumno"];
	$id_datos = $_POST["id_datos_alumno"];
	$respuesta = Operaciones::eliminarAlumnos($id_usuario, $id_alumno, $id_datos);
	if ($respuesta == "Ok") {
		echo (json_encode($respuesta));
	}
} elseif (isset($_POST["id_proyecto"]) && isset($_POST["matricula"]) && isset($_POST["nombreProyecto"])) {
	$raiz = $_POST["matricula"];
	$proyecto = $_POST["nombreProyecto"];
	$id_proyecto = $_POST["id_proyecto"];
	try {
		$variable = Operaciones::getInfoArchivos($id_proyecto);
		if (isset($variable)) {
			foreach ($variable as $key => $value) {
				unlink($value["ruta"]);
			}
		}
		$resp = Operaciones::eliminarTodosArchivos($id_proyecto);
		$res = Operaciones::eliminarProyectos($id_proyecto);
	} catch (Exception $e) {
	}
	$dir = "../proyectos/" . $raiz . "/" . $proyecto;
	rmdir($dir);
	echo json_encode($dir);
} elseif (isset($_POST["ver_equipos"])) {
	$alumnos = Operaciones::listarAlumnos();

	echo json_encode($alumnos);
}
