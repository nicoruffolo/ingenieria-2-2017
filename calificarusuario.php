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
     //$id = $_GET['id'];
     //echo  ($_GET['id']);
?>

     <h1 style="padding-right: -24px; "> De acuerdo a los siguientes criterios califique al usuario:  </h1>

     <h2>  calificacion positiva : + 1  punto, +1 credito  </h2> </br>

     <h2>  calificacion negativa : - 2  puntos </h2> </br>

     <h2>  calificacion neutra : 0 puntos </h2> </br>

     <form action="calificar.php?id=<?php echo ($_GET['id']);?>" method="post">
     	<select  name="elegido" id="" required="required"> 
     	<option value="" > Seleccione... </option>
     	<option> positivo </option>
     	<option> negativo </option>
     	<option> neutro   </option>
     	</select> </br>
     	 Ingrese su comentario: <input type="text" name="coment" required=""> </br>
     	<input type="submit" name="" value="calificar" ></br></br>
          <a href="detallefavor.php?id=<?php echo ($_GET['id']);?>"> Cancelar </a>

     </form>
