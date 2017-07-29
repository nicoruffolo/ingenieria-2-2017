<?php
session_start();
include ("conexion.php");
$conexion = conectar();
$id = $_GET['id'];
$query="SELECT titulo from gauchada where id=" . $id;
$ju= mysqli_query($conexion,$query);
$aux=mysqli_fetch_array($ju);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body>
<h1>Tu comentario fue publicado correctamente en la gauchada "<?php echo($aux['titulo']);?>"</h1></br></br>
<h3>El dueño de la gauchada podra responderte tu comentario</h3></br>
<a href="detallefavor.php?id=<?php echo $_GET['id']; ?>"> Volver</a>
