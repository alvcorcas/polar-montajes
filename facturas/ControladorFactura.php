<?php
session_start();

if (isset($_POST["IDFACTURA"])) {
	$factura["IDFACTURA"] = $_POST["IDFACTURA"];

	if (isset($_POST["editar"])) {
		$_SESSION['factura'] = $factura;
		Header("Location: consultaFacturas.php");
	} else if (isset($_POST["grabar"])) {
		$factura["PRECIOSINIVA"] = $_POST["PRECIOSINIVA"];
		$factura["IVA"] = $_POST["IVA"];
		$factura["PRECIOCONIVA"] = $_POST["PRECIOCONIVA"];
		$factura["TIPOPAGO"] = $_POST["TIPOPAGO"];
		$factura["FECHAVENCIMIENTO"] = $_POST["FECHAVENCIMIENTO"];
		$factura["FECHAEMISION"] = $_POST["FECHAEMISION"];
		$factura["PAGADA"] = $_POST["PAGADA"];
		$factura["DNIOPERARIO"] = $_POST["DNIOPERARIO"];
		$factura["DNICLIENTE"] = $_POST["DNICLIENTE"];
		$_SESSION["factura"] = $factura;
		Header("Location: modificarFactura.php");
	} else {
		$_SESSION["factura"] = $factura;
		Header("Location: facturaPagada.php");
	}
} else
	Header("Location: facturas.php");
?>

?>
