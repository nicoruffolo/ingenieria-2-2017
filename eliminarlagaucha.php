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
	$gauchada="SELECT gauchada_id from  comentarios where id_comentario = '$id' ";
	$comentarios="UPDATE comentarios set estado= 1 where id_comentario=  '$id'";
	$hacer=mysqli_query($conexi,$comentarios);
	$query=mysqli_query($conexi,$gauchada);
	$gauchi=mysqli_fetch_array($query);	
	$dame= $gauchi['gauchada_id'];
	$gauchadas ="UPDATE gauchada set estado= 1 where id ='$dame'";
	$sii= mysqli_query($conexi,$gauchadas);
	header("location:indexadmin.php");
?>