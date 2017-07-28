<?php 
 $conexion=mysqli_connect("localhost","root","","ingedos") or die("ingreso");
   session_start();
	$sql="SELECT foto,tipofoto
		  FROM  usuario
		  WHERE id_email='".$_SESSION['id']."'";
	$result= mysqli_query($conexion,$sql); //ejecuta la consulta 
	$row=mysqli_fetch_array($result);   //me devuelve cada fila 
	mysqli_close($conexion);
	header("Content-type: image/".$row['tipofoto']."");
	echo  $row['foto'];
?>