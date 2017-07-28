<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body> <?php
     include ('conexion.php');
     $conexi=conectar();
     $id = $_GET['id'];
     $a="SELECT titulo from gauchada where id =" .$id."";
     //echo($a);exit();
     $ult=mysqli_query($conexi,$a);
     $aux=mysqli_fetch_array($ult); ?>
     <h3>¿Seguro que quieres borrar la gauchada "<?php echo $aux['titulo'] ?>"?</h3></br>
     <a href="borrargauchada.php?id=<?php echo $_GET['id'];?>"> Aceptar </a> 
     <a style="margin-left: 50px;" href="detallefavor.php?id=<?php echo $_GET['id'];?>"> Cancelar </a>
</body>
</html>

