<!DOCTYPE html>
<html>
<head>
<script>
</script>
</head>
<body>
<?php

session_start();

echo $_SESSION['consulta'];

?>
<h1>A Web Page</h1>

</body>
</html>


var cantidad;
				var descripcion;
				var precioUnitario;
				var precioTotal;
				var oid_s;
				var numeroFilas = document.getElementById("myTable").rows.length;
				for (var i = 1; i < numeroFilas; i++) {
					cantidad = document.getElementById("cantidad" + i).value;
					descripcion = document.getElementById("descripcion" + i).value;
					precioUnitario = document.getElementById("precioUnitario" + i).value;
					precioTotal = document.getElementById("precioTotal" + i).value;
					oid_s = document.getElementById("oid_s" + i).value;
					alert("crearLineaFactura.php?cantidad=" + cantidad + "&descripcion=" + descripcion + "&precioUnitario=" + precioUnitario + "&precioTotal=" + precioTotal + "&oid_s=" + oid_s");
					// var xhttp;
					// xhttp = new XMLHttpRequest();
					// xhttp.open("GET", "crearLineaFactura.php?cantidad=" + cantidad + "&descripcion=" + descripcion + "&precioUnitario=" + precioUnitario + "&precioTotal=" + precioTotal + "&oid_s=" + oid_s, true);
					// xhttp.send();
				}
				
