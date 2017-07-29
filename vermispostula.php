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
     <h1>  Gauchadas a las que te postulastes </h1>

    <?php 
     $aux= "SELECT gauchada.titulo,gauchada.descripcion,gauchada.foto,gauchada.tipoFoto,id_favor from postulantes inner join gauchada on postulantes.id_favor = gauchada.id where email = '$id' and gauchada.estado = 0 and gauchada.fecha_vencimiento > NOW()";
  // echo ($aux);exit();
    $dame = mysqli_query($conexi,$aux);
    $garron= mysqli_query($conexi,$aux);
 //  $recorro= mysqli_fetch_array($dame);
    
    while ($i = mysqli_fetch_array($dame) ) {
    	if ($i > 0){
        
    		?> <div style="padding-left: 524px;"> <?php
    			?> <h3> titulo: </br> <?php echo   $i['titulo']; ?> </h3> 
            <p>  
                      <?php if($i['foto'] == null){ ?>
                     <img width="360" src="imagenes/avatar.png"> <?php } 
                     else {

                      ?> <img width="360" src="mostrar.php?id=<?php echo $i ['id_favor'];?>"/>
                  <?php } ?>      
                    </p>

                  
               	   <h4> Descripcion: </h4> <?php echo   $i['descripcion']; ?>  </br>
               	  
           </div>
	  <?php  }  ?>
  <?php } ?>

   <?php 
   $a=mysqli_fetch_array($garron);
   if ($a == 0){
   		?> <h3 style="padding-left: 524px;">  No te postulastes a ninguna gauchada </h3> 
   <?php }
   ?>