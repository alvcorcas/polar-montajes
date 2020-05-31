<?php
session_start();
require_once ("../gestionBD.php");

if(!isset($_SESSION['login']) or $_SESSION['perfil'] == "cliente")
	header("Location: ../index.php")
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
		<script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
		<title>Creación de una factura</title>
	</head>

	<body>
		<?php
		include_once ("../cabecera.php");
		?>

		<header>
			<h2>Creación de facturas</h2>
			<p>
				En primer lugar rellene el formulario de la izquierda y haga click en enviar factura. A continuación, añada tantas filas en la tabla como lineas tenga la factura y seleccione en enviar tras haberlas rellenado
			</p>
			<hr	 />
		</header>

		<br>
		<div style="display: flex">
			<!-- Formulario a rellenar con el contenido de la factura creada -->

			<form id="nuevaFactura" action="funcionCrearFactura.php" method="post">
				<label>ID de la factura: </label>
				<br>
				<br>
				<input type="text" id="idFactura" name="idFactura" placeholder="LLxxxx(2 mayús, 4 números)" pattern="[A-Z]{2}[0-9]{5}" required/>
				<br>
				<br>
				<label>Fecha de emision: </label>
				<br>
				<br>
				<input type="date" id="fechaEmision" name="fechaEmision" placeholder="dd/mm/aaaa" required/>
				<br>
				<br>
				<label>Fecha de vencimiento: </label>
				<br>
				<br>
				<input type="date" id="fechaVencimiento" name="fechaVencimiento" placeholder="dd/mm/aaaa" required/>
				<br>
				<br>
				<label>Tipo de Pago: </label>
				<br>
				<br>
				<input type="radio" id="transferenciaBancaria" name="tipoPago" value="Transferencia Bancaria" checked="true"/>
				<label>Transferencia Bancaria</label>
				<br>
				<br>
				<input type="radio" id="metalico" value="Metálico" name="tipoPago"/>
				<label>Metálico</label>
				<br>
				<br>
				<label>Total sin IVA:</label>
				<br>
				<br>
				<input type="text" id="precioSinIva"  name="precioSinIva" placeholder="Precio en euros" pattern="[0-9]+" required/>
				<br>
				<br>
				<label>DNI del cliente</label>
				<br>
				<br>
				<input id="dniCliente"  name="dniCliente" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" required>
				<br>
				<br>
				<input type="submit" id="facturacion" value="Enviar factura" onclick="enviarFactura()">
			</form>

			<table id="myTable" style="width:100%" >
				<tr>
					<th>Cantidad</th>
					<th>Descripcion</th>
					<th>Precio unidad</th>
					<th>ID del servicio que representa</th>
					<th>
					<button type="button" onclick="addRow()">
						Añadir fila
					</button></th>
					<th>
					<button type="button" onclick="deleteRow()">
						Eliminar fila
					</button></th>
				</tr>
			</table>
		</div>

		<button id="lineasFacturacion" onclick="enviarLineasFactura()" style="visibility: hidden">
			Insertar lineas de la factura
		</button>

		<p id="test">

		</p>

		<script>
			function enviarFactura() {
				$("#nuevaFactura").submit(function(e) {
					e.preventDefault();

					var form = $(this);
					var url = form.attr('action');

					$.ajax({
						type : "POST",
						url : url,
						data : form.serialize(), 
						success : function(data) {
							alert(data);
							if (data == "La factura se ha insertado correctamente, proceda a añadir filas y rellenarlas") {
								document.getElementById("facturacion").style.visibility = 'hidden';
								document.getElementById("lineasFacturacion").style.visibility = 'visible';
							}
						}
					});

				});

			}

			function addRow() {
				var table = document.getElementById("myTable");
				var row = table.insertRow();
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var i = table.rows.length - 1;
				cell1.innerHTML = '<input type="text" id="cantidad' + i + '" name="cantidad" pattern="[0-9]"/>';
				cell2.innerHTML = '<input type="text" id="descripcion' + i + '" name="descripcion"/>';
				cell3.innerHTML = '<input type="text" id="precioUnitario' + i + '" name="precioUnitario" pattern="[0-9]"/>';
				cell4.innerHTML = '<input type="text" id="oid_s' + i + '" name="OID_S" placeholder="Id numérico" pattern="[0-9]"/>';
			}

			function deleteRow() {
				var tabla = document.getElementById("myTable");
				var nFilas = tabla.rows.length;
				if (nFilas != 1)
					tabla.deleteRow(nFilas - 1);
			}

			function enviarLineasFactura() {
				var numeroFilas = document.getElementById("myTable").rows.length;
				if (numeroFilas > 1) {
					var i;
					for ( i = 1; i < numeroFilas; i++) {
						$.post("crearLineaFactura.php", {
							cantidad : $("#cantidad" + i).val(),
							descripcion : $("#descripcion" + i).val(),
							precioUnitario : $("#precioUnitario" + i).val(),
							precioTotal : $("#precioTotal" + i).val(),
							oid_s : $("#oid_s" + i).val(),
							fila : i
						}, function(data) {
							alert(data);
						});

					}
				}

			}
		</script>
<br />
		<br />
		<footer >
		<a> Universidad De Sevilla</a> <h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
	</footer>
	</body>
</html>