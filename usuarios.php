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
//	if (isset($_SESSION['emi'])){
//		echo $_SESSION['emi'];
//	}
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
	<a href="panel.php">Volver </a> </br>
	<h1>  Listado de usuarios </h1>
	<?php
		include ('conexion.php');
     	$conexi=conectar();
		$aux="SELECT * from usuario where estado = 0 and rol = 0";
		$dos=mysqli_query($conexi,$aux);
	    ?>  <table class="mover" border="1">

	           <thead>
	
		       <tr>
			      <td>Correo</td>
			      <td>Su perfil</td>
			      
		       </tr>

	          </thead> 
	          <tbody>
	  <?php


		while($i=mysqli_fetch_array($dos)){

			 ?>
					<tr>
			  			<td>	<?php echo $i['id_email'] ?>	 </td>		
			  		
			  			<td>  <a href="perfilusu.php?id=<?php echo $i['id_email']; ?>">Perfil usuario</a> </td>
			  		</tr>



			<?php } ?>
			</tbody>

			 </table>
