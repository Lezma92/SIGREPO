<?php
ob_start();
require_once("conexion.php");
require_once("../alertas/alert.php");
class Operaciones
{
	static public function getAcceso($user, $password)
	{
		$valor = Operaciones::validar($user, $password);
		if ($valor["nick"] == $user && $valor["pswrd"] == $password) {
			$_SESSION['id_user'] = $valor['nick'];
			$_SESSION['nivel'] = $valor['nivel_user'];
			if ($valor["nivel_user"] == "Administrador") {
				// header('location:../admin/index.php',true);
				echo("<script>window.location.href = '../admin/index.php';</script>");
			} elseif ($valor["nivel_user"] == "Maestro") {
				echo("<script>window.location.href = '../admin/index.php';</script>");
			} elseif ($valor["nivel_user"] == "Alumno") {
				$_SESSION["grado_estudio"] = $valor["nivel_estudio"];
				$_SESSION["grupo"] = $valor["grupo"];
				$_SESSION["idCarrera"] = $valor["id_carrera"];
				echo("<script>window.location.href = '../alumnos/index.php';</script>");
			}
			
		} else {
			alertas::alertTipos("error", "Usuario incorrecto");
		}
	}


	static public function validar($usu, $password)
	{
		$con = Conexion::getConexion()->prepare("CALL getUsers(:nick,:pass)");
		$con->bindParam(":nick", $usu, PDO::PARAM_INT);
		$con->bindParam(":pass", $password, PDO::PARAM_STR);
		if ($con->execute()) {
			return $con->fetch();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function setDtosPersonales($datos)
	{
		$con = Conexion::getConexion()->prepare("INSERT INTO datos_personales(matricula, nombre, apellidos,fecha) VALUES (:matricula, :nombre, :apps,CURDATE());");
		$con->bindParam(":matricula", $datos["matricula"], PDO::PARAM_INT);
		$con->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$con->bindParam(":apps", $datos["apps"], PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function registrarAlumno($nombre, $grupo,$id_carrera, $nivel_estudio, $pass)
	{
		$con = Conexion::getConexion()->prepare('INSERT INTO alumnos(id_datos_personales,id_carrera, grupo, nivel_estudio,pswrd) VALUES ((SELECT id FROM datos_personales WHERE concat(nombre," ",apellidos) = :nombre),:id_carrera, :grupo, :nivel_estudio,:pswrd);');

		$con->bindParam(":nombre", $nombre, PDO::PARAM_STR);
		$con->bindParam(":grupo", $grupo, PDO::PARAM_STR);
		$con->bindParam(":id_carrera", $id_carrera, PDO::PARAM_STR);
		$con->bindParam(":nivel_estudio", $nivel_estudio, PDO::PARAM_STR);
		$con->bindParam(":pswrd", $pass, PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function cambiarContra($contra, $nick)
	{
		$con = Conexion::getConexion()->prepare("UPDATE usuarios SET pswrd = :pswrd WHERE nick = :nick");
		$con->bindParam(":pswrd", $contra, PDO::PARAM_STR);
		$con->bindParam(":nick", $nick, PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function usuarioEspera($nombre, $estado)
	{
		$con = Conexion::getConexion()->prepare('INSERT INTO usuarios_espera(id_datos_personales,estado) VALUES ((SELECT id FROM datos_personales WHERE concat(nombre," ",apellidos) = :nombre),:estado);');
		$con->bindParam(":nombre", $nombre, PDO::PARAM_STR);
		$con->bindParam(":estado", $estado, PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function getAlumnosWait()
	{
		$con = Conexion::getConexion()->prepare("CALL mostrarEspera();");
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function activarAlumno($dtos)
	{
		$con = Conexion::getConexion()->prepare("CALL activarAlumno(:id_datos,:id_alumno,:id_espera,:matricula);");
		$con->bindParam(":id_datos", $dtos["id_datos"], PDO::PARAM_INT);
		$con->bindParam(":id_alumno", $dtos["id_alumno"], PDO::PARAM_INT);
		$con->bindParam(":id_espera", $dtos["id_espera"], PDO::PARAM_INT);
		$con->bindParam(":matricula", $dtos["matricula"], PDO::PARAM_INT);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function repPrincipal($name)
	{
		$ruta =  "../proyectos/$name";
		mkdir($ruta, 0777, true);
		Operaciones::infoRepositorioPrin($name, $ruta);
	}

	static public function infoRepositorioPrin($matricula, $ruta)
	{
		$con = Conexion::getConexion()->prepare("INSERT INTO repositorios(id_alumno, nombre, ruta) 
			VALUES ((SELECT  al.id FROM alumnos AS al INNER JOIN datos_personales AS dat_p ON al.id_datos_personales = dat_p.id WHERE dat_p.matricula = :nick),:nombre,:ruta);");

		$con->bindParam(":nick", $matricula, PDO::PARAM_INT);
		$con->bindParam(":nombre", $matricula, PDO::PARAM_STR);
		$con->bindParam(":ruta", $ruta, PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function getDatosAsesor()
	{
		$con = Conexion::getConexion()->prepare("SELECT * FROM vistaAsesores;");
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function getDatosAlumnos($matricula)
	{
		$con = Conexion::getConexion()->prepare("CALL getDatosAlumnos(:matricula);");
		$con->bindParam(":matricula", $matricula, PDO::PARAM_INT);
		if ($con->execute()) {
			return $con->fetch();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function registrarProyecto($datos)
	{
		$con = Conexion::getConexion()->prepare("CALL registrarProyecto(:matricula,:idAsesor,:categoria,:nombre_pro,:descripcion,:ruta);");
		$con->bindParam(":matricula", $datos["matricula"], PDO::PARAM_STR);
		$con->bindParam(":idAsesor", $datos["idAsesor"], PDO::PARAM_INT);
		$con->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$con->bindParam(":nombre_pro", $datos["nombre_pro"], PDO::PARAM_STR);
		$con->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$con->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}


	static public function crearRepositorio($ruta)
	{
		mkdir($ruta, 0777, true);
	}


	static public function verProyectos($matricula)
	{
		$con = Conexion::getConexion()->prepare("CALL verProyectos(:matricula);");
		$con->bindParam(":matricula", $matricula, PDO::PARAM_INT);
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}

	static public function resultadoTotal($nivel, $categoria = "")
	{
		$sql = "CALL verProyectosCategoria(:nivel);";
		if ($categoria != "") {
			$sql = "CALL resultadoTotal(:nivel,:categoria);";
		}
		$con = Conexion::getConexion()->prepare($sql);
		$con->bindParam(":nivel", $nivel, PDO::PARAM_STR);
		if ($categoria != "") {
			$con->bindParam(":categoria", $categoria, PDO::PARAM_STR);
		}
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}

	static public function verTodosProyectos($nivel, $categoria = "", $inicio = "", $fin = "",$idCarrera ="")
	{
		$sql = "CALL verProyectosCategoria(:nivel,:idCarrera);";
		if ($categoria != "") {
			$sql = "CALL verProyectosAdmin(:nivel,:categoria,:inicio,:final,:idCarrera);";
		}
		$con = Conexion::getConexion()->prepare($sql);
		$con->bindParam(":nivel", $nivel, PDO::PARAM_STR);
		$con->bindParam(":idCarrera", $idCarrera, PDO::PARAM_INT);
		if ($categoria != "") {
			$con->bindParam(":inicio", $inicio, PDO::PARAM_INT);
			$con->bindParam(":final", $fin, PDO::PARAM_INT);
			
		}
		if ($categoria != "") {
			$con->bindParam(":categoria", $categoria, PDO::PARAM_STR);
		}
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}

	static public function getCarreras()
	{
		$con = Conexion::getConexion()->prepare("SELECT * FROM carreras order by nombre ASC;");

		
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function verProyectsos($matricula, $nivel = "")
	{
		$sql = "CALL verProyectos(:matricula);";
		if ($nivel != "") {
			$sql = "CALL verProyectosAdmin(:matricula,$nivel);";
		}
		$con = Conexion::getConexion()->prepare($sql);
		$con->bindParam(":matricula", $matricula, PDO::PARAM_INT);
		if ($nivel != "") {
			$con->bindParam(":nivel", $nivel, PDO::PARAM_STR);
		}
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function subirIcono($file)
	{
		$hoy = date("d-m-Y-H.i.s");
		$img = $file["name"];
		list($nom, $tipo_dat) = explode(".", $img);
		$img = $hoy . "." . $tipo_dat;
		$archivo = $file["tmp_name"];
		$ruta = "../proyectos/iconos_proyectos/" . $img;
		move_uploaded_file($archivo, $ruta);
		return $img;
	}
	static public function infoArchivos($id_proyecto, $nombre, $tipo, $tama, $ruta)
	{
		$con = Conexion::getConexion()->prepare("CALL insertarArchivos(:id_proyecto,:nombre,:tipo,:tama,:ruta);");
		$con->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
		$con->bindParam(":nombre", $nombre, PDO::PARAM_STR);
		$con->bindParam(":tipo", $tipo, PDO::PARAM_STR);
		$con->bindParam(":tama", $tama, PDO::PARAM_STR);
		$con->bindParam(":ruta", $ruta, PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function copiarArchivos($id_proyecto, $file_post, $dir)
	{
		$file_count = count($file_post['name']);
		$ruta = "";
		try {
			for ($i = 0; $i < $file_count; $i++) {
				$ruta = $dir;
				$arc = $file_post["tmp_name"][$i];
				$img = $file_post["name"][$i];
				$tipo = $file_post["type"][$i];
				$size = $file_post["size"][$i];
				$ruta = $ruta . "/" . $img; //imagenes/nombre.jpg
				Operaciones::infoArchivos($id_proyecto, $img, $tipo, $size, $ruta);
				move_uploaded_file($arc, $ruta);
			}
		} catch (Exception $e) {
			return "Error";
		}
		return "Ok";
	}

	static public function listarAlumnos()
	{
		$sql = "SELECT al.id,d_p.matricula, d_p.nombre FROM alumnos AS al INNER JOIN
		datos_personales AS d_p ON al.id_datos_personales = d_p.id;";
		$con = Conexion::getConexion()->prepare($sql);
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}


	static public function verArchivos($id_proyecto, $nivel = "")
	{
		$sql = "CALL verArchivos(:id_proyecto)";
		if ($nivel == 1) {
			$sql = "CALL verArchivosAlumnos(:id_proyecto)";
		}
		$con = Conexion::getConexion()->prepare($sql);
		$con->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function getUrlArch($id, $opc = "")
	{
		$sql = "SELECT ruta FROM archivos WHERE id = :id";
		$con = Conexion::getConexion()->prepare($sql);
		$con->bindParam(":id", $id, PDO::PARAM_INT);
		if ($con->execute()) {
			return $con->fetch();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function eliminarArchivos($id)
	{
		$con = Conexion::getConexion()->prepare("DELETE FROM archivos WHERE id = :id");
		$con->bindParam(":id", $id, PDO::PARAM_INT);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}

	static public function getInfoArchivos($id)
	{
		$con = Conexion::getConexion()->prepare("SELECT ruta FROM archivos WHERE id_proyecto = :id");
		$con->bindParam(":id", $id, PDO::PARAM_INT);
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function eliminarTodosArchivos($id_proyecto)
	{
		$con = Conexion::getConexion()->prepare("DELETE FROM archivos WHERE id_proyecto = :id");
		$con->bindParam(":id", $id_proyecto, PDO::PARAM_INT);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function eliminarProyectos($id_proyecto)
	{
		$con = Conexion::getConexion()->prepare("DELETE FROM proyectos WHERE id = :id");
		$con->bindParam(":id", $id_proyecto, PDO::PARAM_INT);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function getUsuarios()
	{
		$con = Conexion::getConexion()->prepare("CALL verUsuarios();");
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function insertarAdmin($datos)
	{
		$nombre = $datos["nombre"] . " " . $datos["apps"];
		$con = Conexion::getConexion()->prepare("INSERT INTO usuarios (id_datos_personales,nick,pswrd,nivel_user) VALUES((SELECT id FROM datos_personales WHERE concat(nombre,' ',apellidos) = :nombre),:nick,:pswrd,:nivel_user)");
		$con->bindParam(":nombre", $nombre, PDO::PARAM_STR);
		$con->bindParam(":nick", $datos["matricula"], PDO::PARAM_INT);
		$con->bindParam(":pswrd", $datos["pswrd"], PDO::PARAM_STR);
		$con->bindParam(":nivel_user", $datos["nivel_usuario"], PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function agregarAsesor($nombre)
	{
		$con = Conexion::getConexion()->prepare("insert into asesores values(null,(SELECT id FROM datos_personales WHERE CONCAT(nombre,' ',apellidos) = :nombre));");
		$con->bindParam(":nombre", $nombre, PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function getDatosUser($id_datos, $id_user)
	{
		$con = Conexion::getConexion()->prepare("CALL datosUsuariosAdmin(:id_datos,:id_user);");
		$con->bindParam(":id_datos", $id_datos, PDO::PARAM_INT);
		$con->bindParam(":id_user", $id_user, PDO::PARAM_INT);
		if ($con->execute()) {
			return $con->fetch();
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function updateUsuarios($datos)
	{
		$con = Conexion::getConexion()->prepare("CALL updateDatosUser(:id_datos,:id_user,:matricula,:nombre,:app,:pass,:nivel);");
		$con->bindParam(":id_datos", $datos["id_datos"], PDO::PARAM_INT);
		$con->bindParam(":id_user", $datos["id_user"], PDO::PARAM_INT);
		$con->bindParam(":matricula", $datos["matricula"], PDO::PARAM_INT);
		$con->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$con->bindParam(":app", $datos["app"], PDO::PARAM_STR);
		$con->bindParam(":pass", $datos["pswrd"], PDO::PARAM_STR);
		$con->bindParam(":nivel", $datos["nivel"], PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function updateAlumno($datos)
	{
		$con = Conexion::getConexion()->prepare("CALL actualizarAlumno(:id_datos,:id_user,:id_alumno,:matricula,:nombre,:app,:grupo,:nivel_estudio,:pass,:nivel);");
		$con->bindParam(":id_datos", $datos["id_datos"], PDO::PARAM_INT);
		$con->bindParam(":id_user", $datos["id_user"], PDO::PARAM_INT);
		$con->bindParam(":id_alumno", $datos["id_alumno"], PDO::PARAM_INT);
		$con->bindParam(":matricula", $datos["matricula"], PDO::PARAM_INT);
		$con->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$con->bindParam(":app", $datos["app"], PDO::PARAM_STR);
		$con->bindParam(":grupo", $datos["grupo"], PDO::PARAM_STR);
		$con->bindParam(":nivel_estudio", $datos["nivel_estudio"], PDO::PARAM_STR);
		$con->bindParam(":pass", $datos["pswrd"], PDO::PARAM_STR);
		$con->bindParam(":nivel", $datos["nivel"], PDO::PARAM_STR);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function eliminarAdmin($id_user, $id_datos)
	{
		$con = Conexion::getConexion()->prepare("CALL eliminarUsuariosAd(:idUsu,:idDatos);");
		$con->bindParam(":idUsu", $id_user, PDO::PARAM_INT);
		$con->bindParam(":idDatos", $id_datos, PDO::PARAM_INT);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function eliminarAlumnos($id_usuario, $id_alumno, $id_datos)
	{
		$con = Conexion::getConexion()->prepare("CALL eliminarAlumnos(:idUsu,:id_alumno,:idDatos);");
		$con->bindParam(":idUsu", $id_user, PDO::PARAM_INT);
		$con->bindParam(":id_alumno", $id_alumno, PDO::PARAM_INT);
		$con->bindParam(":idDatos", $id_datos, PDO::PARAM_INT);
		if ($con->execute()) {
			return "Ok";
		} else {
			print_r($con->errorInfo());
		}
	}
	static public function verAlumnos()
	{
		$con = Conexion::getConexion()->prepare("CALL verAlumnos();");
		if ($con->execute()) {
			return $con->fetchAll();
		} else {
			print_r($con->errorInfo());
		}
	}
}
