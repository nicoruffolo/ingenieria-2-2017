<?php
     include ('conexion.php');
     $conexi=conectar();
     $id = $_GET['id']; 
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
<h1 style="text-align: center;"> Tu respuesta fue exitosamente publicada</h1></br></br>
<a style="margin-right:1250px;margin-top: 12px; " href="detallefavor.php?id=<?php echo $_GET['id']; ?>"> Volver </a>