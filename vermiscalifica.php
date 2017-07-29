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
     <h1>  Calificaciones Obtenidas </h1>

    <?php 
     $aux= "SELECT * from postulantes inner join gauchada on postulantes.id_favor = gauchada.id where email = '$id' and calificacion is not null ";
   
    $dame = mysqli_query($conexi,$aux);
    $garron= mysqli_query($conexi,$aux);
 // $recorro= mysqli_fetch_array($dame);
    
    while ($i = mysqli_fetch_array($dame) ) {
    	if ($i > 0){
        
    		?> <div style="padding-left: 524px;"> <?php
    			?> <h3> titulo: </br> <?php echo   $i['titulo']; ?> </h3> 
            <p>  <?php if($i['foto'] == null){ ?>
                     <img width="360" src="imagenes/avatar.png"> <?php } 
                     else {
                      ?> <img width="360" src="mostrar.php?id=<?php echo $i ['id_favor'];?>"/>
                  <?php } ?>
                           
                    </p>
             <h4> Descripcion: </h4> <?php echo   $i['descripcion']; ?>  </br>
             <h4> Calificacion: </h4> <?php echo   $i['calificacion']; ?>  </br>
             <h4> Descripcion: </h4> <?php echo   $i['comentario']; ?>  
               	  
           </div>
	  <?php  }  ?>
  <?php } ?>

   <?php 
   $a=mysqli_fetch_array($garron);
   if ($a == 0){
   		?> <h3 style="padding-left: 524px;">  No recibiste calificaciones </h3> 
   <?php }
   ?>