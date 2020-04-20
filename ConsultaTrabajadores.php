<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionUsuario.php");
	if (isset($_SESSION["Usuario"])){
		$libro = $_SESSION["Usuario"];
		unset($_SESSION["Usuario"]);
	}
	
	
	$conexion = crearConexionBD();
	$filas = consultarTodosLibros($conexion);
	cerrarConexionBD($conexion);
?>
