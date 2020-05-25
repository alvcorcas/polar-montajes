<?php	
	session_start();
	
	if (isset($_REQUEST["IDFACTURA"])){
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
	
	if (isset($_REQUEST["editar"])) Header("Location: Facturas.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: ModificarCliente.php");
		else /* if (isset($_REQUEST["borrar"])) */ Header("Location: borrarCliente.php"); 
	}
	else 
		Header("Location: Facturas.php");

?>

?>
