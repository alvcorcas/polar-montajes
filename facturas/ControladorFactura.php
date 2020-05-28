<?php
session_start();

if (isset($_REQUEST["IDFACTURA"])) {
	$factura["IDFACTURA"] = $_REQUEST["IDFACTURA"];

	if (isset($_REQUEST["editar"])) {
		$_SESSION['FACTURA'] = $factura;
		Header("Location: consultaFacturas.php");
	} else if (isset($_REQUEST["grabar"])) {
		$factura["PRECIOSINIVA"] = $_REQUEST["PRECIOSINIVA"];
		$factura["IVA"] = $_REQUEST["IVA"];
		$factura["PRECIOCONIVA"] = $_REQUEST["PRECIOCONIVA"];
		$factura["TIPOPAGO"] = $_REQUEST["TIPOPAGO"];
		$factura["FECHAVENCIMIENTO"] = $_REQUEST["FECHAVENCIMIENTO"];
		$factura["FECHAEMISION"] = $_REQUEST["FECHAEMISION"];
		$factura["PAGADA"] = $_REQUEST["PAGADA"];
		$factura["DNIOPERARIO"] = $_REQUEST["DNIOPERARIO"];
		$factura["DNICLIENTE"] = $_REQUEST["DNICLIENTE"];
		$_SESSION["FACTURA"] = $factura;
		Header("Location: modificarFactura.php");
	} else {
		$_SESSION["FACTURA"] = $factura;
		Header("Location: facturaPagada.php");
	}
} else
	Header("Location: facturas.php");
?>

?>
