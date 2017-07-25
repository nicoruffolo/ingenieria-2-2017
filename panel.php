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
//	if (isset($_SESSION['emi'])){
//		echo $_SESSION['emi'];
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
  <?php
     include ('conexion.php');
     $conexi=conectar();
     $aux="SELECT count(*) from usuario where rol = 1 and estado = 0";
     //echo($aux);exit();
     $query=mysqli_query($conexi,$aux);
     $r=mysqli_fetch_array($query);
     if ( isset($_SESSION['id'])){ ?>
     	   <h1 style="text-align: center;"> Menu de Administracion</h1></br>
           <a  href="indexadmin.php "> Salir del menu de administracion </a> </br> <?php } ?> </br>
           <a href="verificarg.php"> Verificar Ganancias </a> </br>
           <a href="rankin.php">    Ver Ranking de Usuarios </a> </br>
           <a href="catego.php">   Ver Categorias </a> </br>
           <a href="reputa.php">   Ver Reputaciones </a> </br>
           <a href="usuarios.php"> Ver Usuarios  </a> </br >
           <a href="agregaradmin.php"> Agregar Administrador  </a></br> <?php
           if ($r['count(*)'] > 1){ ?>
           	 <a href="eliminaradmin.php"> Eliminar Administracion </a>
       <?php } ?>


     </body>