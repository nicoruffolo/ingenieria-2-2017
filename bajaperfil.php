<?php
session_start();
include("conexion.php");
$conexi=conectar();
$id = $_SESSION['id'];
$modificar = "UPDATE usuario set estado = 1 where id_email  = '" . $_SESSION['id'] . "' ";
//echo ($modificar);
$okey = mysqli_query($conexi, $modificar);
$gauchadas="UPDATE gauchada set estado= 1 where usuario ='" . $_SESSION['id'] . "' ";
//echo($gauchadas);
$hago=mysqli_query($conexi,$gauchadas);
$comentarios="UPDATE comentarios set estado= 1 where id_nombre= '" . $_SESSION['id'] . "' ";
//echo($comentarios);
$hacer=mysqli_query($conexi,$comentarios);
$borrar="DELETE FROM postulantes where email = '$id' and seleccion is null";
$hecho=mysqli_query($conexi,$borrar);
//echo($borrar);exit();
//$larga="SELECT gauchada.id from postulantes inner join gauchada on postulantes.id_favor = gauchada.id where email = '$id' and seleccion is null";
//echo($larga);exit();
//$basta=mysqli_query($conexi,$larga);
//while ($c = mysqli_fetch_array($basta)){
	//$s=$c['id'];
	//$consulta="SELECT cant_postulantes from gauchada where id = $s";
	//echo($consulta);exit();
	//$wromp=mysqli_query($conexi,$consulta);
	//$array=mysqli_fetch_array($wromp);
	//$cantidad=$array['cant_postulantes'] - 1;
	//$lind="UPDATE gauchada set cant_postulantes = $cantidad where id= $s";
	//echo($lind);exit();
	//$mod=mysqli_query($conexi,$lind); 
session_destroy();
header("location:chaucuenta.php");


?>