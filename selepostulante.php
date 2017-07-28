<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body> 
  <?php
     include ('conexion.php');
     $conexi=conectar();
     $id = $_GET['id']; 
     $nue = "SELECT email from postulantes where id_favor = $id ";
     //echo ($nue);
     $aux = mysqli_query ($conexi, $nue);

     ?>

       <?php if (isset($_POST['postu']) && !empty($_POST['postu'])){
                ?> <?php $elegido= $_POST['postu'];
                         $z="SELECT email from postulantes where id_favor = $id and email != '$elegido'";
                         $arg= mysqli_query($conexi, $z); $blu= mysqli_fetch_array($arg); ?>
                   <h1>Usted eligio como postulante al usuario: <?php echo ($_POST['postu']) ?> </h1> </br></br>
                   <h2>De esta manera rechaza las postulaciones de:</h2> </br>
                   <?php
                 if($blu > 0){
                   $sue="SELECT email from postulantes where id_favor = $id and email != '$elegido'";
                         $h= mysqli_query($conexi, $sue);  
                   while ( $b = mysqli_fetch_array($h)){
                        echo $b['email']; ?>  </br> <?php } ?>
                    <?php   } else {
                        echo ("No hay otros usuarios postulados a esta gauchada");
                          }  ?>
                    <h3>¿Seguro que quieres elegir a este usuario como postulante?</h3></br>
                    <a href="seleccion.php?valor1=<?php echo $elegido?>&valor2=<?php echo $id?>"> Aceptar </a> 
                    <a style="margin-left: 50px;" href="selepostulante.php?id=<?php echo $_GET['id'];?>"> Cancelar </a>  
                   <?php 
                 } 
                 else { 

                    ?>
                <div> <a style="margin-right:1250px;margin-top: 12px; " href="detallefavor.php?id=<?php echo $_GET['id']; ?>">   Home </a> </div>
                <h3>   Elija un gaucho de la siguiente lista: </h3>

                <form method="POST" action="selepostulante.php?id=<?php echo $_GET['id']; ?>">
                <select  name="postu" required="required">
                <option value="" > Seleccione... </option>
                 <?php        
                  while( $i = mysqli_fetch_array($aux)){
                        $seleccionado = "";
                        if (isset($_POST['postu']) && $_POST['postu'] == $i['email']  ){
                             $seleccionado = "selected"; }
                             ?> <option <?php echo $seleccionado ?> value=<?php echo $i['email'];?> > <?php echo  $i['email']; ?> </option>
                      <?php   } ?>
                      </select> 
                      </br></br>

                    <input type="submit" name="buscar" value="Elegir Postulante">


                </form> <?php
                }
                ?>




             