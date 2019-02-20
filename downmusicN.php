<?php	
	
	include("session.php");
	
	
	$id=$_SESSION['session_id']; 
	
	// if(isset($_COOKIE['carrito'.$id])){ 
		// setcookie("carrito".$id, "", time() - 3600);
	// }
	
	
	
	echo "<form name='mi_formulario' action='downmusic1.php' method='post'>";

	
	
	echo "<h1>DOWN MUSIC</h1>"; 

	$sql=" select name from track"; 
	$resultado= mysqli_query($db, $sql); 
	
	
	
	echo "<select name='canciones'>"; 
			if(mysqli_num_rows($resultado) > 0){
				while ($fila = mysqli_fetch_assoc($resultado)) {
					echo "<option>".$fila['name']."</option>";
				}
			}
	echo "</select>"; 
	echo "</br>";
	echo "</br>";
	
	

	echo "<input type='submit' value='Annadir Cancion' >";
	echo "<input type='reset' value='borrar'>";
	echo "<input type='button' value='Atras' onclick='history.back()'><br>";
	
	echo "</form>";
	
	
	























?>