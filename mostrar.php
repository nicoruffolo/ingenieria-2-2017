<?php 
 $conexion=mysqli_connect("localhost","root","","ingedos") or die("ingreso");
	$id=$_GET["id"];
	$sql="SELECT *
		  FROM  gauchada
		  WHERE id='".$id."'";
	$result= mysqli_query($conexion,$sql); //ejecuta la consulta 
	$row=mysqli_fetch_array($result);   //me devuelve cada fila 
	mysqli_close($conexion);
	header("Content-type: image/".$row['tipoFoto']."");
	echo  $row['foto'];
?>