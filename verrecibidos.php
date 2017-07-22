<?php
 session_start();
 $id = $_SESSION['id'];
 include ('conexion.php');
             $conexi=conectar();
?>
<!DOCTYPE html>
<html>
<head>
	<title> Una Gauchada</title>
	<img src="imagenes/mari.png">
	<link href="estilis.css" rel="stylesheet">
	<script src="javaa.js"></script>
</head>
<body>
     <div style="text-align: left;">
     	<a href="perfil.php" > volver </a>
     </div>
     <h1>  Comentarios recibidos </h1>

     <?php 
     $aux= "SELECT DISTINCT cuerpo,respuesta,id_nombre,titulo from comentarios inner join gauchada on gauchada_id = gauchada.id inner join usuario on gauchada.usuario = '$id' and comentarios.estado = 0";
   //echo ($aux);exit();
     $dame = mysqli_query($conexi,$aux);
    $garron= mysqli_query($conexi,$aux);
 // $recorro= mysqli_fetch_array($dame);?>
    <hr size="8px" color="black"/> <?php
    while ($i = mysqli_fetch_array($dame) ) {
    	if ($i > 0){
        
    		?> <div style="padding-left: 524px;"> <?php
    			?> <h3> Comentario: de " <?php echo ($i['id_nombre']);?> "</br></br>   <?php echo  $i['cuerpo']; ?> </h3> 
                     
             <h4> Respuesta: </h4> <?php if($i['respuesta'] != "") {echo   $i['respuesta'];} else {echo ("No respondiste este comentario");}?> </br>
             <h4> Gauchada: </h4> <?php echo($i['titulo']); ?> </br>
               	  
           </div>
           <hr size="8px" color="black"/>
	  <?php  }  ?>
  <?php } ?>

   <?php 
   $a=mysqli_fetch_array($garron);
   if ($a == 0){
   		?> <h3 style="padding-left: 524px;">  No recibiste comentarios </h3> 
   <?php }
   ?>