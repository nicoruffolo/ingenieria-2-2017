<?php
session_start();
include("conexion.php");
$conexi=conectar();
$id = $_GET['id'];
$usuario = $_SESSION['id'];
$nuevo = "INSERT INTO `postulantes`(`email`,`id_favor`) VALUES ('$usuario', $id)";
$aux = mysqli_query($conexi,$nuevo);
$saldos = "SELECT  cant_postulantes FROM gauchada WHERE id= '" . $id . "' ";
$result = mysqli_query($conexi, $saldos);
$mostrar = mysqli_fetch_array($result);
$act=$mostrar['cant_postulantes'] + 1 ;
$modificar = "update gauchada set cant_postulantes=".$act." where id='$id'";
$result= mysqli_query($conexi, $modificar);
$cart="SELECT titulo from gauchada where id= '" . $id . "' ";
//echo ($cart); exit();	
$rop= mysqli_query($conexi,$cart);
$tum=mysqli_fetch_array($rop);			    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body> 
<div style="text-align:center;">
<h1>Postulacion exitosa<h1/><br/>
<div/>
<h4>Te has postulado a la gauchada: "<?php echo $tum['titulo'] ?>"</h4><br/>
<h4>Pronto recibiras un correo electronico con la desicion del publicante</h4><br/>
<div style="text-align:left;">
<a href="detallefavor.php?id=<?php echo $_GET['id'];?>"> Volver </a>
<div/>