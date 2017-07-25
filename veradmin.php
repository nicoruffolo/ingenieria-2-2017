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
	$id=$_SESSION['id'];
	//echo($id);exit();
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
   <a href="indexadmin.php">Atras</a></br> 
  <?php 
     include ('conexion.php');
     $conexi=conectar();
     $consulta="SELECT id_email from usuario where estado = 0 and rol = 1";
     //echo($consulta);
     $query=mysqli_query($conexi,$consulta);?>
     <h1 style="text-align:center;">Estos son los administradores del sistema:</h1></br></br> <?php
     while ($i = mysqli_fetch_array($query)){
     		if ($i['id_email'] == $id){ ?>
     			<h3><?php echo $i['id_email'];?> (Usted)</h3> </br></br>
     	<?php } else { ?>
     			<h3><?php echo $i['id_email'];?></h3> </br></br>
     <?php	}  ?>



 <?php } ?>

</body>
</html>



