<?php
session_start();
include("conexion.php");
$conexi=conectar();
$idp = $_GET['id']; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body> 
<h1>Tu gauchada se ha modificado correctamente</h1></br>
<div> <a style="margin-right:1250px;margin-top: 12px; " href="detallefavor.php?id=<?php echo $idp ?>"> Volver </a> </div>