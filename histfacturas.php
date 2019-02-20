<?php
	include("session.php");
	
	
	$id=$_SESSION["session_id"];
	
	echo "<h2>Historial de Facturas</h2>";
	
	
	$sql= "select invoiceid, invoicedate, total from invoice where customerid=$id order by invoicedate";
	$resultado = mysqli_query($db, $sql);

	
	if (mysqli_num_rows($resultado) > 0) {
		echo "<table border=1>";
		echo "<tr align='center'>";
			echo "<td>Numero de Factura</td>";
			echo "<td>Fecha Factura</td>";
			echo "<td>Total</td>";
		echo "</tr>";
		while ($fila = mysqli_fetch_assoc($resultado)) {
			echo "<tr>";
			echo "<td>".$fila['invoiceid']."</td>"; 
			echo "<td>".$fila['invoicedate']."</td>"; 
			echo "<td>".$fila['total']."</td>"; 
			echo "</tr>";
		}
	
	}
	
	echo "<input type='button' value='Atras' onclick='history.back()'><br>";
	echo "<br>";
	


	
?>