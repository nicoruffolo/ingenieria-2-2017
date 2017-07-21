<?php 
    session_start();
    if (empty($_SESSION['id'])){
      {
      header("location:index.php?no=Inicie Sesion por favor"); }
    } ?>
<!DOCTYPE html>
<html>
<head>
	<title> Una Gauchada</title>
	<img src="imagenes/mari.png">
	<link href="estilis.css" rel="stylesheet">
	<script src="javaa.js"></script>
</head>
<body>
<div style="text-align: left;">
<a href="index.php" > volver </a>
</div>
<div style="text-align:center;">
<h1>Su compra se ha realizado exitosamente<h1/><br/>
<div/>

