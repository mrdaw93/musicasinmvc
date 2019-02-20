<?php	

	include("session.php"); 
	
	$id=$_SESSION["session_id"]; 
	$desde=$_REQUEST["fdesde"]; 
	$hasta=$_REQUEST["fhasta"]; 
	
	
	// Definicion funcion error_function
	function errores ($error_level,$error_message){
		 echo "<b> ERROR Codigo error: </b> $error_level  - <b> Mensaje: $error_message </b><br>";
		 echo "Finalizando script <br>";
		 die();  
	}
	set_error_handler("errores");

	
	
	//Error para el campo cliente vacio 
	if($desde==null){
		trigger_error("Fecha desde no puede estar vacia");
	}
	
	
	
	
	
	echo "<h2>Historial de Facturas por Fecha</h2>";
	
	
	if($desde!=null & $hasta!=null){
		
		
		$sql="select invoiceid, invoicedate, total from invoice 
				where invoicedate between '$desde' and '$hasta' and customerid=$id";

		$resultado= mysqli_query($db, $sql); 	
		
		
		
		

		$resultado= mysqli_query($db, $sql); 
		
		
		if(mysqli_num_rows($resultado) > 0){
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
		
	}
	
	
	
	if($desde!=null && $hasta==null){
		
		
		$sql="select invoiceid, invoicedate, total from invoice 
				where invoicedate between '$desde' and now() and customerid=$id";

		$resultado= mysqli_query($db, $sql); 	
		
		
		
		

		$resultado= mysqli_query($db, $sql); 
		
		
		if(mysqli_num_rows($resultado) > 0){
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
		
	}
	
	echo "<input type='button' value='Atras' onclick='history.back()'><br>";
	echo "<br>";

	
	

	















?>