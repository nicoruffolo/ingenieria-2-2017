<?php
session_start();
include ("conexion.php");
$conexion = conectar();
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body>
<h1>Tu comentario fue eliminado correctamente</h1></br>
<a href="detallefavor.php?id=<?php echo $_GET['id']; ?>"> Volver</a>