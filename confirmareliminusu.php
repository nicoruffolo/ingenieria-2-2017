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
<a href="perfilusu.php?id=<?php echo $_GET['id'];?>">Volver </a> </br>
 <h1>¿Seguro que quiere eliminar a este usuario?</h1>
   <?php
		include ('conexion.php');
     	$conexi=conectar(); ?> </br></br>
    <a href="eliminarusuadm.php?id=<?php echo $_GET['id'];?>"> Aceptar </a>
    <a style="margin-left: 50px;" href="perfilusu.php?id=<?php echo $_GET['id'];?>">Volver </a> </br> 	
