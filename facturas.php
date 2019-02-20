<?php	


	echo "<form name='mi_formulario' action='facturas1.php' method='post'>";

	echo "<h1>Lista pedidos por Fechas </h1>"; 
	
	
	echo "Fecha Desde	<input type='date' name='fdesde' value='' size=6><br><br>";
	echo "Fecha Hasta 	<input type='date' name='fhasta' value='' size=6><br><br>"; 
	
	
	

	echo "<input type='submit' value='Mostrar'>";
	echo "<input type='reset' value='borrar'>";
	echo "<input type='button' value='Atras' onclick='history.back()'><br>";
	
	echo "</form>"

























?>