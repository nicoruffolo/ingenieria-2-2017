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
	//	echo $_SESSION['emi'];
//	}
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
		<a href="panel.php">Volver </a> </br> 
		<h1>Categorias:</h1>
		<a style="margin-left: 604px;" href="agregarcate.php"> Agregar Nueva Categoria</a>
  <?php
     include ('conexion.php');
     $conexi=conectar();
     $aux= "SELECT * FROM categoria where estado = 0";
     $dos=mysqli_query($conexi,$aux);
     $act="SELECT count(*) from categoria where estado = 0";
     $tres=mysqli_query($conexi,$act);
     $a=mysqli_fetch_array($tres);
     while ($i=mysqli_fetch_array($dos)) {
        ?> <h4> Categoria: <?php echo ($i['nombre']); ?> </h4> <a href="modificarcate.php?id=<?php echo $i['nombre']; ?>"> modificar categoria</a>
        <?php if ($a['count(*)'] > 1){
        	?> <a href="eliminarcate.php?id=<?php echo $i['nombre'];?>"> eliminar categoria</a> <?php 
        } ?>
<?php  } ?> 
