<?php
session_start();

if (isset($_REQUEST["DNICLIENTE"])) {
	$cliente["DNICLIENTE"] = $_REQUEST["DNICLIENTE"];

	if (isset($_REQUEST["editar"])) {
		$_SESSION["CLIENTE"] = $cliente;
		Header("Location: ConsultaClientes.php");
	} else if (isset($_REQUEST["grabar"])) {
		$cliente["TELEFONO"] = $_REQUEST["TELEFONO"];
		$cliente["CORREO"] = $_REQUEST["CORREO"];
		$cliente["DIRECCION"] = $_REQUEST["DIRECCION"];
		$cliente["CODIGOPOSTAL"] = $_REQUEST["CODIGOPOSTAL"];
		$_SESSION["CLIENTE"] = $cliente;
		Header("Location: ModificarCliente.php");
	} else {
		$_SESSION["CLIENTE"] = $cliente;
		Header("Location: borrarCliente.php");
	}
} else
	Header("Location: ConsultaClientes.php");
?>

?>
