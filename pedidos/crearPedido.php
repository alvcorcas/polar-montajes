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
		<title>Creación de una pedido</title>
	</head>

	<body>
		<?php
		include_once ("../cabecera.php");
		?>

		<header>
			<h2>Creación de pedidos</h2>
			<p>
				En primer lugar rellene el formulario de la izquierda y haga click en enviar pedido. A continuación, añada tantas filas en la tabla como lineas tenga su pedido y seleccione en enviar tras haberlas rellenado
			</p>
			<hr	 />
		</header>

		<br>
		<div style="display: flex">
			<!-- Formulario a rellenar con el contenido de la pedido creada -->
			<form id="nuevoPedido" action="funcionCrearPedido.php" method="post">
				<label>Fecha de pedido: </label>
				<br>
				<br>
				<input type="date" id="fecha" name="fecha" placeholder="dd/mm/aaaa" required/>
				<br>
				<br>
				<label>Precio:</label>
				<br>
				<br>
				<input type="text" id="precio" name="precio" placeholder="Precio en euros" pattern="[0-9]+" required/>
				<br>
				<br>
				<label>Nombre de la empresa:</label>
				<br>
				<br>
				<input id="nombreEmpresa" name="nombreEmpresa" type="text" required>
				<br>
				<br>
				<input type="submit" id="pedir" value="Enviar pedido" onclick="enviarPedido()">
			</form>

			<table id="myTable" style="width:100%" >
				<tr>
					<th>Cantidad</th>
					<th>Precio total</th>
					<th>ID del producto que representa</th>
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

		<button id="lineasPedido" onclick="enviarLineasPedido()" style="visibility: hidden">
			Insertar lineas del pedido
		</button>

		<p id="test"></p>

		<script>
			function enviarPedido() {
					$("#nuevoPedido").submit(function(e) {

						e.preventDefault();

						var form = $(this);
						var url = form.attr('action');

						$.ajax({
							type : "POST",
							url : url,
							data : form.serialize(), 
							success : function(data) {
								alert(data);
								if(data == "El pedido se ha insertado correctamente, proceda a añadir filas y rellenarlas"){
									document.getElementById("pedir").style.visibility = "hidden";
									document.getElementById("lineasPedido").style.visibility = "visible";
									
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
				var i = table.rows.length - 1;
				cell1.innerHTML = '<input type="text" id="cantidad' + i + '" name="cantidad" pattern="[0-9]"/>';
				cell2.innerHTML = '<input type="text" id="precioTotal' + i + '" name="precioTotal"/>';
				cell3.innerHTML = '<input type="text" id="oid_prod' + i + '" name="oid_prod" pattern="[0-9]"/>';

			}

			function deleteRow() {
				var tabla = document.getElementById("myTable");
				var nFilas = tabla.rows.length;
				if (nFilas != 1)
					tabla.deleteRow(nFilas - 1);
			}

			function enviarLineasPedido() {
				var numeroFilas = document.getElementById("myTable").rows.length;
				if (numeroFilas > 1) {
					var i;
					for ( i = 1; i < numeroFilas; i++) {
						$.post("crearLineaPedido.php", {
							cantidad : $("#cantidad" + i).val(),
							precioTotal : $("#precioTotal" + i).val(),
							oid_prod : $("#oid_prod" + i).val(),
							fila : i
						}, function(data) {
							alert(data);

						});
					}

				}
			}
		</script>

	</body>
</html>