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
    $id = $_GET['id'];
    $aux="UPDATE categoria set estado = 1 where nombre ='$id'";
    //echo($aux);
    $query=mysqli_query($conexi,$aux);
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
	<h1>La categoria fue eliminada correctamente:</h1></br>
	<a href="catego.php"> Volver </a>