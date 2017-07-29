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
	//if (isset($_SESSION['emi'])){
		//echo $_SESSION['emi'];
	//}
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
  <?php 
     include ('conexion.php');
     $conexi=conectar();
     $id=$_GET['id'];
     ?>
     <h1>¿Seguro que quiere eliminar la reputacion "<?php echo $id;?>"?</h1></br></br>
     <a href="bajareputa.php?id=<?php echo $id;?>"> Aceptar </a> 
     <a style="margin-left: 50px;" href="reputa.php"> Cancelar </a>
