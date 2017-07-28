<?php 
    session_start();
    if ( empty($_SESSION['id'])){
       header("location:index.php?no=Inicie Sesion por favor"); }
    
     $idies = $_SESSION['id'];


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
    ?> <div> <a style="margin-right:1250px;margin-top: 12px; " href="perfil.php ">   Volver </a> </div> 
  <form style="text-align: center;" method="post" action="editarcontra.php"> 
    <label> ingrese contraseña actual </br>
    <input  title="ingrese la contrasea actual" type="password" name="vieja" required=""> </br>
    <label> ingrese la nueva contraseña </br>
    <input title="ingrese la contrasenia nueva" type="password" name="nueva" required=""> </br>
    <label> ingrese de nuevo la nueva contraseña </br>
    <input title="ingrese la contrasenia nueva nuevamente" type="password" name="dos" required=""> </br>
    <input type="submit" name="modificar"></button>
  </form>
  <?php if (isset($_GET['epa'])){
     echo ($_GET['epa']);
  } ?>
  <?php if (isset($_GET['para'])){
     echo ($_GET['para']);
  } ?>