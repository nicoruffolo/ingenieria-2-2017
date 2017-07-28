<?php
	session_start();
	 if (isset($_SESSION['admin']) && $_SESSION['admin']==0) {

		$_SESSION['guarda'] = "no sos un administrador";
		header("location:index.php");
	}
	if (empty($_SESSION['id'])){
		$_SESSION['fede'] = "Imposible acceder a este sitio";
		header("location:index.php");
	}
	//if (isset($_SESSION['emi'])){
		//echo $_SESSION['emi'];
	//}
	include("conexion.php");
	$conexi=conectar();
	$id = $_GET['id'];
	$comentarios="UPDATE comentarios set estado = 1 where estado = 0 and gauchada_id = '$id'";
	$ruu=mysqli_query($conexi,$comentarios);
	$gauchada="UPDATE gauchada set estado = 2 where id = '$id'";
	$lagaucha=mysqli_query($conexi,$gauchada);
	header("location:exitoenbaja.php");
?>