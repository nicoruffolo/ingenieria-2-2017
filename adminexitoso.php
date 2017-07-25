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
	$id = $_GET['id'];
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
     $conexi=conectar(); ?>
     <a href="panel.php"> Volver </a>
     <h1>"<?php echo $id;?>" fue dado de alta en el sistema como administrador de forma exitosa</h1></br></br>
     <h3>Se le envio un correo a "<?php echo $id;?>" con una contraseña de seguridad para acceder como administrador a este sitio</h3>
</body>
</html>     