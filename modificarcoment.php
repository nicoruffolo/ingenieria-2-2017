
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/mari.png">
    
	<meta name="viewport" content="">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="estilis.css">
</head>
<body> 
 <?php
     include ('conexion.php');
    ?><div> <a style="margin-right:1250px;margin-top: 12px; " href="index.php ">   Home </a> </div> <?php

     $conexi=conectar();
        $idgauchada= $_GET['valor2'];
		$id= $_GET['id'];
		$var= "SELECT cuerpo from comentarios where id_comentario=".$id." ";
		$dame = mysqli_query($conexi,$var);
		$i = mysqli_fetch_array($dame);
		?>
<h1 style="text-align: center;">Modifique su comentario</h1></br></br>		
<form action="modifica.php?id=<?php echo $_GET['id'];?>&valor=<?php echo $idgauchada?>" method="post" style="text-align: center;" >
 comentario:	<input type="text" name="cpo" value="<?php echo ($i['cuerpo']);?>" required=" "> </br>
 <input type="submit" name="" value="modificar">

</form>