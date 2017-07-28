<?php
session_start();
include("conexion.php");
$conexi=conectar();
$idgaucha = $_GET['id'];
$idies = $_SESSION['id'];
$modificar = "UPDATE gauchada set estado = 1 where id = $idgaucha";
$okey = mysqli_query($conexi, $modificar);
//header("location:index.php");
$ro= "SELECT * from postulantes where id_favor = $idgaucha";
//echo($ro);exit();
$ju= mysqli_query($conexi,$ro);
$aux= mysqli_fetch_array($ju); ?>
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
<?php if($aux > 0){ ?>
	<div style="text-align:center;">
    <h1>Tu Gauchada ha sido eliminada correctamente<h1/><br/>
    <div/>
    <h3>Aun asi no podras recuperar tu credito ya que la misma tenia usuarios postulados</h3>
<?php } else { 
	$jar= "SELECT credito from usuario where id_email = '$idies'";
	$ult=mysqli_query($conexi,$jar);
	$plus=mysqli_fetch_array($ult);
	$credito= $plus['credito'] + 1;
	$var= "UPDATE usuario set credito = $credito where id_email = '$idies'";
	$poll= mysqli_query($conexi,$var);
?>	<div style="text-align:center;">
    <h1>Tu Gauchada ha sido eliminada correctamente<h1/><br/>
    <div/>
    <h3>Como la misma no tenia usuarios postulados, te hemos reenviado el credito a tu cuenta</h3> 
 <?php  
} ?>
</body>
</html>

