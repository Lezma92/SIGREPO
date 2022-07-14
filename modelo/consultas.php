<?php
include("../controlador/operaciones.php");
class vistas
{
	static public function enEspera()
	{
		$respuesta = Operaciones::getAlumnosWait();
		return $respuesta;
	}
	static public function getAsesores()
	{
		$respuesta = Operaciones::getDatosAsesor();
		return $respuesta;
	}
	static public function getProyectos($matricula)
	{
		if (isset($matricula)) {
			$respuesta = Operaciones::verProyectos($matricula);
			return $respuesta;
		}
	}

	static public function resultadoTotal($grado = "", $categoria = "")
	{
		if ($_SESSION["nivel"] == "Alumno") {
			$respuesta = Operaciones::verTodosProyectos($_SESSION["grado_estudio"]);
		} elseif ($_SESSION["nivel"] == "Administrador" || $_SESSION["nivel"] == "Maestro") {
			$respuesta = Operaciones::resultadoTotal($grado, $categoria);
		}
		return $respuesta;
	}

	static public function listarCarreras()
	{
		$respuesta = Operaciones::getCarreras();
		return $respuesta;
	}

	static public function getTdosProyectos($grado = "", $categoria = "", $inicio = "", $fin = "",$idCarrera="")
	{
		if ($_SESSION["nivel"] == "Alumno") {
			
			$respuesta = Operaciones::verTodosProyectos($_SESSION["grado_estudio"],idCarrera: $_SESSION["idCarrera"]);
		} elseif ($_SESSION["nivel"] == "Administrador" || $_SESSION["nivel"] == "Maestro") {
			$respuesta = Operaciones::verTodosProyectos($grado, $categoria, $inicio, $fin,$idCarrera);
		}
		return $respuesta;
	}
	static public function getArchivos()
	{
		if ($_SESSION["pagina"] == "Personal") {
			$respuesta = Operaciones::verArchivos($_SESSION["idProyecto"]);
		} elseif ($_SESSION["pagina"] == "verTodos") {
			$respuesta = Operaciones::verArchivos($_SESSION["idProyecto"], 1);
		}
		return $respuesta;
	}
	static public function getDatosAlumnos($matricula)
	{
		$respuesta = Operaciones::getDatosAlumnos($matricula);
		return $respuesta;
	}
	static public function listarUsuarios()
	{
		$respuesta = Operaciones::getUsuarios();
		return $respuesta;
	}
	static public function listarAlumnos()
	{
		$respuesta = Operaciones::verAlumnos();
		return $respuesta;
	}
}