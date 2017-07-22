<?php 
session_start();
include ('conexion.php');
$conexi=conectar();
$id = $_GET['idi'];
$ides = $_GET['valor3'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body>
<div> <a style="margin-right:1250px;margin-top: 12px; " href="visitarperfil.php?id=<?php echo $_GET['idi'];?>&valor2=<?php echo $ides?>"> Atras </a> </div>
<h1>Calificaciones que obtuvo el usuario "<?php echo($id);?>"</h1>
 <?php
$consulta="SELECT * from postulantes where email = '$id' and calificacion is not null";
//echo($consulta);exit();
$query=mysqli_query($conexi,$consulta); ?>
<hr size="8px" color="black"/> <?php
while ($i = mysqli_fetch_array($query)){
	if ($i > 0){ ?>
		<div style="padding-left: 524px;"> <?php
    			?> <h2> Calificacion: </br></br> <?php echo   $i['calificacion']; ?> </h2> 
                  
               	   <h2> Comentario: </br></br> <?php echo $i['comentario']; ?> </h2>
           </div>
           <hr size="8px" color="black"/>
	<?php  } ?>
<?php   }  ?>
<?php
   $otro=mysqli_query($conexi,$consulta); 
   $a=mysqli_fetch_array($otro);
   if ($a == 0){
   		?> <h3 style="padding-left: 524px;"> Este usuario no recibio ninguna calificacion </h3>
    <?php }
   ?>		