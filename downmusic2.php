<?php	
	
	include("session.php");
	
	//ID USUARIO PARA LOS INSERT
	$id=$_SESSION['session_id']; 
	
	echo "<h2> PEDIDO REALIZADDO CORRECTAMENTE </h2>"; 
	
	echo "<h3> RESUMEN DEl PEDIDO </h3>"; 
	
		if(isset($_COOKIE['carrito'.$id])){ 
		$pedidoCanciones = unserialize($_COOKIE['carrito'.$id]);
		} 
	
	//var_dump($pedidoCanciones);
	


	
	
		//LLAMADA FUNCIONINSERT  INVOICE 
		
	//INVOICE TOTAL
	$total=resumenPedido($db, $pedidoCanciones); 	
	
	
	//INVOICE ID
	$invoiceid=maxinvoiceid($db); 
	
	//INVOICE DATE 
	$hoy=date("y-m-d"); 

	

	
	//LLAMADA 
	insertInvoice($db, $invoiceid, $id, $hoy, $total);
	

	
			//LLAMADA FUNCIONINSERT  INVOICELINE
		
	//INVOICELINEID
	$invoicelineid=maxinvoicelineid($db); 
	
	//INVOICE ID
		//lo sacamos en el insert de invoive $invoiceid
	
	//LLAMADA 
	insertInvoiceline($db, $invoicelineid, $invoiceid, $pedidoCanciones);
	

	
	
	
	//BORRO LA COOKIE	
	if(isset($_COOKIE['carrito'.$id])){ 
		setcookie("carrito".$id, "", time() - 3600);
		//echo "borrada";
	}
	
	
	
	
	
	
	//RESUMEN Y RETORNA EL TOTAL DEL PEDIDO	
	function resumenPedido($db, $pedidoCanciones){
		
		// if(isset($_COOKIE['carrito'.$id])){ 
		// $pedidoCanciones = unserialize($_COOKIE['carrito'.$id]);
		// } 
	
		$total=0;
		
		echo "<table border=1>";
			echo "<tr align='center'>";
				echo "<td>Cancion</td>";
				echo "<td>Precio</td>";
			echo "</tr>";

		foreach($pedidoCanciones as $nombre){
			$sql="select unitprice from track where name='$nombre'"; 
			$resultado = mysqli_query($db, $sql);

			if (mysqli_num_rows($resultado) > 0) {
				while ($fila = mysqli_fetch_assoc($resultado)){
					echo "<tr>";
					echo "<td>".$nombre."</td>"; 
					echo "<td>".$fila['unitprice']."</td>"; 
					echo "</tr>";
					$total+=$fila['unitprice'];
				}
			}
		}
		
		echo "<td>TOTAL</td>"; 
		echo "<td>".$total."</td>"; 
		echo "</table>";
		echo "<br>";
		
		return $total; 
	}
	
	
	
		//DATOS PARA INSRT INVOICEID
	
	//EL TOTAL LO SACAMOS DE LA FUNCION resumenPedido
	
	
	//MAX INVOICE ID
	function maxinvoiceid($db){
		
		$sql="select max(invoiceid) as ultfac from invoice"; 
		$resultado = mysqli_query($db, $sql);
		if (mysqli_num_rows($resultado) > 0) {
			while ($fila = mysqli_fetch_assoc($resultado)){
				$ultimafac=$fila['ultfac']+1; 
				}
			}
		
		return $ultimafac; 
	
	}
	

	
	
	
	
	//INSERT INVOICE FUNCION
	
	function insertInvoice($db, $invoiceid, $idCust, $fecha, $total){
		
		$sql="insert into invoice values($invoiceid, $idCust, '$fecha', NULL, NULL, NULL, NULL, NULL, '$total')"; 
		
		if(mysqli_query($db, $sql)){
			echo "insert INVOICE correcto <br>";
		} 
		else{
			echo "Error insert: " . mysqli_error($db);
		}
		
		
	} 
	
	
	
		//DATOS PARA INSERT INVOICELINE
	
	//MAXIMO INVOICELINEID
	function maxinvoicelineid($db){
		
		$sql="select max(invoicelineid) as ultli from invoiceline"; 
		$resultado = mysqli_query($db, $sql);
		if (mysqli_num_rows($resultado) > 0) {
			while ($fila = mysqli_fetch_assoc($resultado)){
				$ultimalin=$fila['ultli']+1; 
				}
			}
		return $ultimalin;
	
	
	}
	
	


	//INSERT INVOICELINE FUNCION
	
	function insertInvoiceline($db, $invoicelineid, $invoiceid, $pedidoCanciones){
		
		// if(isset($_COOKIE['carrito'.$id])){ 
		// $pedidoCanciones = unserialize($_COOKIE['carrito'.$id]);
		// } 
		
		foreach($pedidoCanciones as $nombre){
			$sql="select trackid, unitprice from track where name='$nombre'"; 
			$resultado = mysqli_query($db, $sql);
			if (mysqli_num_rows($resultado) > 0) {
				while ($fila = mysqli_fetch_assoc($resultado)){
					
					$trackid=$fila['trackid'];
					$precio=$fila['unitprice'];
					$sql2="insert into invoiceline values($invoicelineid, $invoiceid, $trackid, $precio, 1)"; 
					if(mysqli_query($db, $sql2)){
						echo "insert INVOICELINE correcto <br>";
					} 
					else{
						echo "Error insert: " . mysqli_error($db);
					}
				$invoicelineid+=1;
				}
			}
			$sql="select trackid from track where name='$nombre'"; 
			
		}

	} 
	
echo "<br>";
echo "<br>";

echo "<a href='welcome.php'>Inicio</a>"











?>