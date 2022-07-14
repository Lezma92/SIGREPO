<?php 
require_once("../controlador/operaciones.php");

function login(){
	if(isset($_POST['btnAcceso'])) {
		$adminuser = $_POST['username'];
		$password = $_POST['password'];
		Operaciones::getAcceso($adminuser,$password);
	}
}

?>