<?php 
session_start();
include ('conexion.php');
$conexi=conectar();
$id = $_GET['id'];
$ides = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body>
<div> <a style="margin-right:1250px;margin-top: 12px; " href="detallefavor.php?id=<?php echo $_GET['id'];?>"> Volver </a> </div>
<h1>Usuarios postulados:</h1></br> <?php
$consulta= "SELECT email from postulantes where id_favor = $id";
//echo($consulta);exit();
$query=mysqli_query($conexi,$consulta);
while($i = mysqli_fetch_array($query)){
	echo($i['email']); ?> <a style="margin-right:1260px;margin-top: 12px; " href="visitarperfil.php?id=<?php echo $i['email'];?>&valor2=<?php echo $id?>"> Visitar Perfil </a> </br></br>

<?php } ?>

