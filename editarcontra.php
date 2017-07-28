<?php
session_start();
include("conexion.php");
$conexi=conectar();
$contra="SELECT clave from usuario where id_email = '" . $_SESSION['id'] . "' ";
$aca=mysqli_query($conexi,$contra);
$a=mysqli_fetch_array($aca);
if($a['clave'] != $_POST['vieja']){
	header("location:editarprivi.php?para= la contraseña ingresada es incorrecta");
}
//$idusuario = $_GET['id'];
else {if( (isset($_POST['nueva']) and (!empty($_POST['nueva']))) and  ((isset($_POST['dos'])) and (!empty($_POST['dos']))) ){
		$pass= $_POST['nueva'];
		$dos= $_POST['dos'];
	if ($pass == $dos){
			$aux="UPDATE usuario set clave='$pass' where id_email = '" . $_SESSION['id'] . "' ";
			$ok=mysqli_query($conexi,$aux);
			header("location:modificarcontraseña.php");
		}
		else {
			header("location:editarprivi.php?epa= las contraseñas no coinciden");
		}

 }
else {
 	header("location:perfil.php");
 }
}