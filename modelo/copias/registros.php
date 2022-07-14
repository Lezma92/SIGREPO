<?php 
require_once("../controlador/operaciones.php");
require_once("../alertas/alert.php");
class registrar{
	 static public function insertAlumnos(){
		if (isset($_POST["registrarAlumno"])) {
			$datos = array(
				'matricula' => $_POST["matricula"],
				'nombre' => $_POST["nombre"],
				'apps' => $_POST["apellidos"],
				'grupo' => $_POST["grupo"],
				'pswrd' => $_POST["pswrd"]
			);
			try {
				$r = Operaciones::setDtosPersonales($datos);
				$nom = $datos["nombre"]." ".$datos["apps"];
				$respuesta1 = Operaciones::registrarAlumno($nom,strtoupper($datos["grupo"]),$_POST["nivel_estudio"],$datos["pswrd"]);
				$respuesta2 = Operaciones::usuarioEspera($nom,"Espera");
				if ($respuesta2 == "Ok") {
					return "Ok";

				}
			} catch (Exception $e) {
				alertas::alertTipos("error",$e);
			}

		}
	}





	static public function agregarAdminMaes(){
		if (isset($_POST["btn_registrarAdmin"])) {
			$datos = array(
				'matricula' => $_POST["txtMatricula"],
				'nombre' => $_POST["txtNombre"],
				'apps' => $_POST["txtApp"],
				'nivel_usuario' => $_POST["nivel_usuario"],
				'pswrd' => $_POST["paswrd"]
			);
			$respuesta = Operaciones::setDtosPersonales($datos);
			if ($respuesta == "Ok") {
				$respuesta = Operaciones::insertarAdmin($datos);
				$nom = $datos["nombre"]." ".$datos["apps"];
				Operaciones::agregarAsesor($nom);
				if ($respuesta == "Ok") {
					alertas::alertBasic("Usuario registrado correctamente","");
				}
			}
		}
		
	}




	
	static public function agregarProyectos(){
		if (isset($_POST["btn-crear"])) {
			$img = Operaciones::subirIcono($_FILES["icono"]);
			$rut = "../proyectos/iconos_proyectos/".$img;
			$datos = array(
				'matricula' => $_POST["propietario"],
				'idAsesor' => $_POST["asesor"],
				'categoria' => $_POST["categoria"],
				'nombre_pro' => $_POST["txtNombre"],
				'descripcion' => $_POST["txtDescripcion"],
				'ruta' => $rut
			);
			$ruta  = "../proyectos/".$_POST["propietario"]."/".$_POST["txtNombre"];
			try {
				$respuesta = Operaciones::registrarProyecto($datos);
				if ($respuesta == "Ok") {
					Operaciones::crearRepositorio($ruta);
					alertas::alertBasic("repositorio creado correctamente","");
				}
			} catch (Exception $e) {
				alertas::alertTipos("error",$e);
			}
		}
		
	}
	static public function subirArchivos(){
		if (isset($_POST["subirArchivos"]) && isset($_FILES["archivos"])) {
			$ruta = "../proyectos/".$_SESSION["matricula"]."/".$_SESSION["nombre_proyecto"];
			$respuesta = Operaciones::copiarArchivos($_SESSION["idProyecto"],$_FILES["archivos"],$ruta);
			$dir = "../admin/verArchivos.php";
			if ($_SESSION["nivel"] == "Alumno") {
				$dir = "../alumnos/archivos.php";
			}
			if ($respuesta == "Ok") {
				echo('<script>Swal.fire({
					text: "Carga de archivos correctamente",
					type: "success",
					confirmButtonColor: "#d33",
					confirmButtonText: "Ok"
					}).then((result) => {
						if (result.value) {
							
						}
					})	</script>');
			}else{
				alertas::alertTipos("error","No fue posible realizar la carga de tus archivos, comunicate con tu administrador");
			}
		}
	}
	static public function setPass(){
		if (isset($_POST["btn_guardar"])) {
			$respuesta = Operaciones::cambiarContra($_POST["paswrd"],$_SESSION["id_user"]);
			if ($respuesta == "Ok") {
				echo('<script>Swal.fire({
					text: "La contraseña se modificó correctamente",
					type: "success",
					confirmButtonColor: "#d33",
					confirmButtonText: "Ok"
					}).then((result) => {
						if (result.value) {
							window.location.href = "../alumnos/micuenta.php";
						}
					})	</script>');
			}else{
				alertas::alertTipos("error","No fue posible realizar la siguiente operación, comunicate con tu administrador");
			}
		}
	}
	static public function cambiarDatosUsuarios(){
		if (isset($_POST["btn_registrarAdminUpdate"])) {
			try {
				$datos = array(
					'id_datos' => $_POST["idDato"],
					'id_user' => $_POST["idUser"],
					'matricula' => $_POST["txtMatriculaU"],
					'nombre' => $_POST["txtNombreU"],
					'app' => $_POST["txtAppU"],
					'nivel' => $_POST["nivel_usuarioU"],
					'pswrd' => $_POST["paswrdU"]
				);
				$respuesta = Operaciones::updateUsuarios($datos);
				if ($respuesta == "Ok") {
					echo('<script>Swal.fire({
					text: "Datos actualizados correctamente",
					type: "success",
					confirmButtonColor: "#d33",
					confirmButtonText: "Ok"
					}).then((result) => {
						if (result.value) {
							window.location.href = "../admin/usuarios.php";
						}
					})	</script>');
				}
			} catch (Exception $e) {
				print_r($e);
			}
		}

	}
	static public function actualizarAlumnos(){
		if (isset($_POST["registrarAlumno"])) {
			$datos = array(
				'id_datos' => $_POST["idDato"],
				'id_user' => $_POST["idUser"],
				'id_alumno' => $_POST["idAlumno"],
				'matricula' => $_POST["matricula"],
				'nombre' => $_POST["nombre"],
				'app' => $_POST["apellidos"],
				'grupo' => $_POST["grupo"],
				'nivel_estudio' => $_POST["nivel_estudio"],
				'pswrd' => $_POST["pswrd"],
				'nivel' => "Alumno"
			);
			$respuesta = Operaciones::updateAlumno($datos);
			if ($respuesta == "Ok") {
				echo('<script>Swal.fire({
					text: "Datos actualizados correctamente",
					type: "success",
					confirmButtonColor: "#d33",
					confirmButtonText: "Ok"
					}).then((result) => {
						if (result.value) {
							window.location.href = "../admin/alumnos.php";
						}
					})	</script>');
			}
		}
		
	}
	
}

?>