<?php
   include('session.php');
   
  // echo  $_SESSION["login_user"];
  
  
	$usn=$_SESSION['login_user'];

	$pwd=$_SESSION['pwd']; 
	
	// echo $un; 
	// echo "<br>"; 
	// echo $pwd; 
	
	$sql= "select customerid from customer where email='$usn' and lastname='$pwd'";


	$resultado = mysqli_query($db, $sql);
	
	if (mysqli_num_rows($resultado) > 0) {
		while ($fila = mysqli_fetch_assoc($resultado)) {
		$_SESSION['session_id']= $fila['customerid']; 
		}
	}
	
	
	//echo $_SESSION['session_id']; 
	
	
  
  
?>
<html">
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Bienvenido <?php echo $login_session; ?></h1> 
	  
	  
	  <nav class="dropdownmenu">
   <ol>
    <li><a href="#">Pedidos</a></li>    
		<ul><a href="downmusicN.php">Nuevo Pedido</a></ul>
		<ul><a href="downmusic.php">Continuar Pedido</a></ul>
    <li><a href="histfacturas.php">Consultar Facturas</a></li>    
    <li><a href="facturas.php">Consultar Facturas por Fecha</a></li>    
  </ol>
  
</nav>
	  
	  
	  
      <h2><a href = "logout.php">Cerrar Sesion</a></h2>
   </body>
   
</html>