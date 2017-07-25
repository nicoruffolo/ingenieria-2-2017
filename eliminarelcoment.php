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
	include("conexion.php");
	$conexi=conectar();
	$idcoment=$_GET['id'];
	$dar="SELECT * from comentarios where id_comentario = $idcoment";
	$estrella=mysqli_query($conexi,$dar);
	$i=mysqli_fetch_array($estrella);	

?> <!DOCTYPE html>
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
	<a href="detallegaucha.php?id=<?php echo $i ['gauchada_id'];?>"> Volver</a> 

<?php 
	$aux="UPDATE comentarios set estado = 1 where id_comentario = '$idcoment'";
	$dos=mysqli_query($conexi,$aux);
?>	<div style="text-align:center;">
    <h1>El comentario ha sido eliminada correctamente<h1/><br/>
    <div/>	

