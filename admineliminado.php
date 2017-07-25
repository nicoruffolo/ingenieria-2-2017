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
<a style="margin-left: 50px;" href="panel.php"> Cancelar </a>
<?php
   include ('conexion.php');
   $conexi=conectar();
   $id=$_SESSION['id'];
   $consulta="SELECT id_email from usuario where estado = 0 and rol = 1 and id_email != '$id'";
   $query=mysqli_query($conexi,$consulta);
   ?>
   <h1 style="text-align: center;">Elija el Administrador que desea dar de baja</h1></br></br>
   <h3>Lista de los demas administradores:</h3></br></br>
   <?php
   while ($i = mysqli_fetch_array($query)) {
   	   echo $i['id_email']; ?> <a href="bajaadmin.php?id=<?php echo $i['id_email'];?>">Eliminar</a></br></br>


<?php  } ?>
</body>
</html>