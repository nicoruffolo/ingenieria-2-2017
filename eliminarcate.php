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
	include ('conexion.php');
    $conexi=conectar();
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
	<h1>¿Seguro que quieres eliminar la categoria "<?php echo $_GET['id'];?>"?</h1></br>
	<a href="eliminocate.php?id=<?php echo $_GET['id'];?>"> Aceptar </a> 
    <a style="margin-left: 50px;" href="catego.php"> Cancelar </a>

