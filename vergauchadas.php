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
     <h1>  Tus gauchadas </h1>

    <?php 
     $fecha=date("Y-m-d");
     $aux= "SELECT * from gauchada where usuario = '$id'";
    // echo ($aux);exit()
    $dame = mysqli_query($conexi,$aux);
    $garron= mysqli_query($conexi,$aux);
 //  $recorro= mysqli_fetch_array($dame);
    
    while ($i = mysqli_fetch_array($dame) ) {
    	if ($i > 0){
        $ide=$i['id'];
        $consulta="SELECT count(*) from postulantes where id_favor = $ide and seleccion is not null";
        $consulta2="SELECT count(*) from postulantes where id_favor = $ide and calificacion is not null";
        $query10=mysqli_query($conexi,$consulta2);
        $query7=mysqli_query($conexi,$consulta);
        $w=mysqli_fetch_array($query7);
        $x=mysqli_fetch_array($query10);
        $contador=$w['count(*)'];
        $contador2=$x['count(*)'];
        if(($i['estado'] == 0) and ($i['fecha_vencimiento'] > $fecha) and ($contador == 0) and ($contador2 == 0)){$estado="activa";}
        if($i['estado'] == 1){$estado="eliminada";}
        if(($i['estado'] == 0) and ($i['fecha_vencimiento'] < $fecha) and ($contador == 0) and ($contador2 == 0)) {$estado="vencida";}
        if($i['estado'] == 2){$estado="eliminada por administrador";}
        if(($i['estado'] == 0) and ($i['fecha_vencimiento'] > $fecha) and ($contador != 0) and ($contador2 == 0)){$estado="En espera de calificacion";}
        if(($i['estado'] == 0) and ($i['fecha_vencimiento'] > $fecha) and ($contador != 0) and ($contador2 != 0)){$estado="Gauchada ya resuelta";}
    		?> <div style="padding-left: 524px;"> <?php
    			?> <h3>  <?php echo   $i['titulo']; ?> </h3> <h3> <div style="margin-top: -38px;margin-left: 300px; "> <?php echo($estado); ?> </div> </h3>
                  <p> <a href="detallefavor.php?id=<?php echo $i ['id']; ?>">Detalles</a></br> 
                    	<?php if($i['foto'] == null){ ?>
                     <img width="360" src="imagenes/avatar.png"> <?php } 
                     else {
                      ?> <img width="360" src="mostrar.php?id=<?php echo $i ['id'];?>"/> 
                  <?php } ?></br> 	
                    </p>
           </div>
	  <?php  }  ?>
  <?php } ?>

   <?php 
   $a=mysqli_fetch_array($garron);
   if ($a == 0){
   		?> <h3 style="padding-left: 524px;">  No hay gauchadas </h3> 
   <?php }
   ?>