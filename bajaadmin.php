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
   $id = $_GET['id'];
   $admin= $_SESSION['id'];
   $consulta="UPDATE usuario set estado = 1 where id_email = '$id'";
   $query=mysqli_query($conexi,$consulta);?>
   <h1 style="text-align: center;">Baja de administracion exitosa</h1></br></br> <?php
   if ($id == $admin){
   	session_destroy();?>
   	<a href="index.php">Aceptar</a> <?php
     }
     else { ?>
       <a href="panel.php">Volver al Menu de Administrador</a>
 <?php  }  ?>
 </body>
</html>

