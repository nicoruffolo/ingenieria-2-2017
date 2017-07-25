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
	//if (isset($_SESSION['emi'])){
		//echo $_SESSION['emi'];
	//}
	?>
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
	<a href="indexadmin.php"> Volver</a> 
  <?php 
     include ('conexion.php');
     $conexi=conectar();
     $id=$_GET['id'];
     $gauchada="SELECT * from gauchada where id= $id";
     $bolsa="SELECT * from comentarios where gauchada_id= $id";
     $das=mysqli_query($conexi,$gauchada);
     $vitamina=mysqli_query($conexi,$bolsa);
     $postula = " SELECT * from postulantes where id_favor ='$id' and seleccion = 0 ";
     $po=mysqli_query($conexi,$postula);
     $s=mysqli_fetch_array($po);
     $xamp="SELECT count(*) from postulantes where id_favor ='$id'";
     $yahoo=mysqli_query($conexi,$xamp);
     $y=mysqli_fetch_array($yahoo);
     $cantidada=$y['count(*)'];
     while ($i=mysqli_fetch_array($das) ){ ?>
     	<div style="padding-left: 524px;">
       <h4> Titulo </h4> <?php echo   $i['titulo']; ?>  </br> <?php 
       if($i['foto'] == null){ 
       	             ?>
                     <img width="360" src="imagenes/avatar.png"> <?php } 
                     else {
                      ?> <img width="360" src="mostrar.php?id=<?php echo $i ['id'];?>"/>   </br>
                  <?php } ?>  	
                    </p>
                     <h4> Gauchada hecha por: </h4> <?php echo   $i['usuario']; ?>  </br>
               	   <h4> Descripcion: </h4> <?php echo   $i['descripcion']; ?>  </br>
               	  <h4> Fecha de creacion: </h4> <?php echo   $i['fecha_creacion']; ?>  </br>
               	  <h4> Fecha limite: </h4> <?php echo   $i['fecha_vencimiento']; ?>  </br>
               	  <h4> Ciudad: </h4> <?php echo   $i['ciudad']; ?> </br>
               	  <h4> Categoria: </h4> <?php echo   $i['caterogia']; ?>  </br>
                  <h4> Cantidad de Postulantes: </h4> <?php echo   $y['count(*)']; ?> </br></br>
                  <?php if ($s > 0) { ?>
                     <h4> Postulante seleccionado : </h4>  <?php echo ($s['email']) ?>
                     <?php if ($s['calificacion'] != "") {
                    ?> <h4> Calificacion: </h4> <?php echo $s['calificacion']; ?> </br>
                       <h4> Comentario: </h4> <?php echo $s['comentario']; ?> </br></br> <?php } }?>
                         
                      

                </div>
            <?php   } ?>
             <hr size="8px" color="black"/> <?php
                while ($cantina=mysqli_fetch_array($vitamina)){
             		?> <div style="margin-left: 524px;">
             			<?php echo $cantina['id_nombre']; ?>: </br> 
                       <h4>Cuerpo:	<?php 	echo	$cantina['cuerpo']; if ($cantina['estado'] == 0){ ?> <a href="eliminarelcoment.php?id=<?php echo $cantina['id_comentario'];?>"> eliminar</a> <?php }  else { ?> <h4 style="margin-left: 504px ">  <?php echo "                 comentario eliminado"; ?> </h4> <?php  } ?> </h4> </br> 
                       	</h4> Respuesta: <?php 	echo 	$cantina['respuesta']; ?> </h4></br>
                     </div>
                     <hr size="8px" color="black"/>
                     <?php  	 } ?>

                       	
          </br> </br>  <a href="eliminarlagaucha.php?id=<?php echo $id; ?>"> Eliminar La Gauchada</a>