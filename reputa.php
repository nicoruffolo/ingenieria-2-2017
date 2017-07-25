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
		<?php 
		include ('conexion.php');
     	$conexi=conectar();

		$aux="SELECT * from reputacion where estado = 0 order by puntaje_inicial";
		$act="SELECT count(*) from reputacion where estado = 0";
		$dos=mysqli_query($conexi,$aux);
		$tres=mysqli_query($conexi,$act);
     	$a=mysqli_fetch_array($tres);
		?>
		<a href="panel.php">Volver </a> </br> 
		<h2>Listado De Reputaciones</h2>
		<a href="agregarreputa.php"> Agregar Reputaciones</a>
		
	<div style="margin-left: 624px;">	
		<?php while ($i=mysqli_fetch_array($dos)) {
			  ?> nombre: <?php echo $i['id_nombre']; ?>  <a href="modificarreputa.php"> Modificar reputacion</a> <?php if ($a['count(*)'] > 1){
        	?> <a href="eliminarreputa.php"> Eliminar Reputacion </a>  <?php } ?>  </br> 
			 puntaje inicial:    <?php 	echo $i['puntaje_inicial'];  ?> </br> </br>
		<?php } ?>
 	</div>