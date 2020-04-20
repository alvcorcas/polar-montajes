<?php	
	session_start();
	
	if (isset($_REQUEST["DNICLIENTE"])){
		$cliente["DNICLIENTE"] = $_REQUEST["DNICLIENTE"];
		$cliente["NOMBRE"] = $_REQUEST["NOMBRE"];
		$cliente["APELLIDOS"] = $_REQUEST["APELLIDOS"];
		$cliente["TELEFONO"] = $_REQUEST["TELEFONO"];
		$cliente["CORREO"] = $_REQUEST["CORREO"];
		$cliente["DIRECCION"] = $_REQUEST["DIRECCION"];
		$cliente["CODIGOPOSTAL"] = $_REQUEST["CODIGOPOSTAL"];
		
		$_SESSION["CLIENTE"] = $cliente;
	
	}
	else 
		Header("Location: ConsultaClientes.php");

?>
