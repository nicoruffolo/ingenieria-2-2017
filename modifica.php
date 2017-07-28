<?php
session_start();
include("conexion.php");
$conexi=conectar();
$idusuario = $_GET['id'];
$idgauchada=$_GET['valor'];
if(isset($_POST['cpo']) and (!empty($_POST['cpo']))){
	$cuerpo =$_POST['cpo'];
	 $modificar ="UPDATE  comentarios set cuerpo='$cuerpo' where id_comentario = '" . $_GET['id'] . "' ";
	

$result= mysqli_query($conexi, $modificar);
		header("location:detallefavor.php?id=$idgauchada");
		
}
		
else{
		header("location:index.php");
		}

?>

?>