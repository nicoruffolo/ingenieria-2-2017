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

include("conexion.php");
$conexi=conectar();
$id = $_GET['id'];
$modificar = "UPDATE usuario set estado = 1 where id_email  =  '$id'";
//echo ($modificar);
$okey = mysqli_query($conexi, $modificar);
$gauchadas="UPDATE gauchada set estado= 1 where usuario = '$id'";
//echo($gauchadas);
$hago=mysqli_query($conexi,$gauchadas);
$comentarios="UPDATE comentarios set estado= 1 where id_nombre=  '$id'";
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
header("location:chaucuentados.php");


?>