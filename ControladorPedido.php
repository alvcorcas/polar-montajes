<?php	
	session_start();
	
	if (isset($_REQUEST["OID P"])){
		$pedido["OID_P"] = $_REQUEST["OID_P"];
		$pedido["FECHA"] = $_REQUEST["FECHA"];
		$pedido["PRECIO"] = $_REQUEST["PRECIO"];
		$pedido["PAGADO"] = $_REQUEST["PAGADO"];
		$pedido[" NOMBREEMPRESA"] = $_REQUEST["NOMBREEMPRESA"];
		$pedido["DNIOPERARIO"] = $_REQUEST["DNIOPERARIO"];
		
		$_SESSION["PEDIDO"] = $pedido;
	
	if (isset($_REQUEST["editar"])) Header("Location: Pedidos.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: ModificarCliente.php");
		else /* if (isset($_REQUEST["borrar"])) */ Header("Location: borrarCliente.php"); 
	}
	else 
		Header("Location: Pedidos.php");

?>

?>
