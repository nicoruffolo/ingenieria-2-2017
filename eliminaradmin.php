<?php
	session_start();
	 if (isset($_SESSION['admin']) && $_SESSION['admin']==0) {

		$_SESSION['guarda'] = "no sos un administrador";
		header("location:index.php");
	}
	if (empty($_SESSION['id'])){
		$_SESSION['fede'] = "Imposible acceder a este sitio";
		header("location:index.php");
	}
	?>
	<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/mari.png">
    
	<meta name="viewport" content="">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="estilis.css">
</head>
<body>
   <a href="panel.php">Volver</a></br>
   <?php 
     include ('conexion.php');
     $conexi=conectar(); ?>
     <h1 style="text-align: center;"> Baja de un Administrador</h1></br></br>
     <h3>Puede optar por abandonar su administracion o bien eliminar a otro administrador que crea necesario:</h3></br></br>
     <div style="text-align:center;">
     <a href="meelimino.php"> Dar de baja mi propia Administracion </a></br></br>
     <a href="admineliminado.php"> Eliminar otro Administrador </a></br></br>
     <div/>
 </body>
</html>    
