<?php
session_start();

if (isset($_POST["IDFACTURA"])) {
	$_SESSION["factura"] = $_POST["IDFACTURA"];
	Header("Location: facturaPagada.php");

} else
	Header("Location: consultaFacturas.php");
?>

?>
