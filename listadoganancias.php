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
	
	include ('conexion.php');
    $conexi=conectar();
    $fecha1=$_POST['fech1'];
    $fecha2=$_POST['fech2'];
    if ($fecha1 > $fecha2){
    	header("location:verificarg.php?mal=Por favor asegurese que la fecha minima sea menor a la fecha maxima");
    }
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
		<a href="verificarg.php">Volver </a> </br> <?php
    if ($fecha1 == $fecha2){
    	$act="SELECT count(*) from compra where fecha = '$fecha1'";
    	$query2=mysqli_query($conexi,$act);
    	$b=mysqli_fetch_array($query2);
    	$aux="SELECT id_usuario,sum(monto),fecha from compra where fecha = '$fecha1' group by id_usuario,fecha order by fecha";
    	$rot="SELECT sum(monto) from compra where fecha = '$fecha1'";
    	$consulta=mysqli_query($conexi,$rot);
    	$creditos=mysqli_fetch_array($consulta); ?>
    	<h3>Compras realizadas en la fecha "<?php echo $fecha1;?>":</h3></br></br> <?php 
    	$query=mysqli_query($conexi,$aux);
    }
    else {
    	$act="SELECT count(*) from compra where fecha BETWEEN '$fecha1' AND '$fecha2'";
    	$query2=mysqli_query($conexi,$act);
    	$b=mysqli_fetch_array($query2);
    	$aux="SELECT id_usuario,sum(monto),fecha from compra where fecha BETWEEN '$fecha1' AND '$fecha2' group by id_usuario,fecha order by fecha";
    	$rot="SELECT sum(monto) from compra where fecha BETWEEN '$fecha1' AND '$fecha2'";
    	$consulta=mysqli_query($conexi,$rot);
    	$creditos=mysqli_fetch_array($consulta); ?>
    	<h3>Compras realizadas desde la fecha "<?php echo $fecha1;?>" hasta la fecha "<?php echo $fecha2;?>":</h3></br></br> <?php
    	$query=mysqli_query($conexi,$aux);
	}
	if ($b['count(*)'] == 0){ ?>
		<h3 style="padding-left: 524px;">  No se realizaron compras </h3></br></br> <?php
	}
	else { ?>
		<table class="mover" border="1">

	           <thead>
	
		       <tr>
			      <td>Usuario que realizo la compra</td>
			      <td>Cantidad de creditos comprados</td>
			      <td>Fecha</td>
			   </tr>

	           </thead> 
	           <tbody>
	           <?php
	    while($i=mysqli_fetch_array($query)){ ?>
	      <tr>
			   <td><?php echo $i['id_usuario'];?></td>
			   <td><?php echo $i['sum(monto)'];?></td>
			   <td><?php echo $i['fecha'];?></td>
		   </tr>
		<?php  } ?>
       </tbody>

       </table></br></br>
    <?php } ?>   
    <h3>En total se registro la compra de "<?php if($creditos['sum(monto)'] == null){echo "0";} else { echo $creditos['sum(monto)'];}?>" creditos</h3></br>
    <h3>Esta cantidad es equivalente a una suma de dinero de "$<?php echo (50*$creditos['sum(monto)']);?>"</h3>   
