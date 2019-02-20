<?php	
	
	include("session.php");
	
	$cancion=$_REQUEST['canciones']; 
	$id=$_SESSION['session_id']; 

	echo "<form name='mi_formulario2' action='downmusic2.php' method='post'>";

	
	//CUANDO YA ESTA DEFINIDA
	if(isset($_COOKIE['carrito'.$id])){ 
		$datos = unserialize($_COOKIE['carrito'.$id]);
		array_push($datos, $cancion);
		//var_dump($datos);
		setcookie('carrito'.$id, serialize($datos), time() + 365 * 24 * 60 * 60);
		echo $cancion."<h3>Agregada al Carrito</h3>";
		echo "<br>"; 
		
	} 
	else{ //CUANDO NO ESTA DEFINIDA
		$arraycanciones=array($cancion); 
		setcookie('carrito'.$id, serialize($arraycanciones), time() + 365 * 24 * 60 * 60); 
		echo $cancion." Anadida al carrito";
	 } 

	
	//var_dump($datos);
	echo "<br>"; 
	echo "<input type='button' value='Agregar Cancion' onclick='history.back()'><br>";
	echo "<input type='submit' value='Finalizar Pedido'>";
	echo "</form>";
	


	
	
















?>