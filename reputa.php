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
		<?php 
		include ('conexion.php');
     	$conexi=conectar();

		$aux="SELECT * from reputacion where estado = 0 order by puntaje_inicial";
		$act="SELECT count(*) from reputacion where estado = 0";
		$dos=mysqli_query($conexi,$aux);
		$tres=mysqli_query($conexi,$act);
     	$a=mysqli_fetch_array($tres);
		?>
		<a href="panel.php">Volver </a> </br> 
		<h2>Listado De Reputaciones</h2>
		<a href="agregarreputa.php"> Agregar Reputacion</a>
		
	<div style="margin-left: 624px;">
	     <table class="mover" border="1">

	           <thead>
	
		       <tr>
			      <td>Nombre</td>
			      <td>Puntaje Minimo</td>
			      <td>Puntaje Maximo</td>
		       </tr>

	          </thead> 
	          <tbody>
	  <?php
	  $minimo="SELECT min(puntaje_inicial) from reputacion where estado = 0";
	  $query4=mysqli_query($conexi,$minimo);
	  $min=mysqli_fetch_array($query4);
	  $maximo="SELECT max(puntaje_inicial) from reputacion where estado = 0";
	  $query5=mysqli_query($conexi,$maximo);
	  $max=mysqli_fetch_array($query5);
	  $mini=$min['min(puntaje_inicial)'];
	  $maxi=$max['max(puntaje_inicial)'];
	  $hacer1="SELECT id_nombre from reputacion where estado = 0 and puntaje_inicial = $mini";
	  $query6=mysqli_query($conexi,$hacer1);
	  
	
		 while ($i=mysqli_fetch_array($dos)) {
			  ?> 
			  	<tr>
			  			<td>	<?php echo $i['id_nombre']; ?>	 </td>		
			  		
			  			<td> <?php echo $i['puntaje_inicial']; ?>  </td>

			  			<td> <?php if($i['puntaje_final'] != null){echo $i['puntaje_final'];} 
			  			else { if($i['extremo'] == 1){ if($min['min(puntaje_inicial)'] == $i['puntaje_inicial']){echo "-";} else {echo "+";} } else {echo "NULO";} } ?> </td>

			  			<td> <a href="modificarreputa.php?id=<?php echo $i['id_nombre'];?>"> Modificar reputacion</a>  </td>  <?php
			  			if ($a['count(*)'] > 1){ ?>
			  				<td> <a href="eliminarreputa.php?id=<?php echo $i['id_nombre'];?>"> Eliminar reputacion</a>  </td> 
			  		<?php } ?>


			  		</tr>

			  
		<?php } ?>
		</tbody>

	    </table>

 	</div>