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
   $id=$_SESSION['id'];
   ?> 
  <h1>¿Esta seguro que quiere dejar de administrar a "Una Gauchada?"</h1></br></br>
  <a href="bajaadmin.php?id=<?php echo $id;?>"> Aceptar </a> 
  <a style="margin-left: 50px;" href="panel.php"> Cancelar </a>
  </body>
</html>  