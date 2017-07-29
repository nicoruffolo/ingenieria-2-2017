<?php 
    session_start();
    include('conexion.php');
    $conexi=conectar();
    $login= $_SESSION['id'];
  	$user=$_GET['valor1'];
  	$id= $_GET['valor2'];
  	//echo ($user); //echo($id);
  	$consulta="UPDATE postulantes set seleccion = 0 where id_favor  =  $id  and email = '$user'";
  	//echo $consulta; exit();
  	$andar= mysqli_query($conexi, $consulta);
  	$other= "SELECT calificaciones from usuario where id_email = '$login'";
  	//echo($other); exit();
  	$wor= mysqli_query($conexi, $other);
  	$guardo= mysqli_fetch_array($wor);
  	if ($guardo['calificaciones'] == 0){
  		$li= "UPDATE usuario set calificaciones = 1 where id_email = '" . $_SESSION['id'] . "' ";
  		//echo($li);exit();
  		$up=mysqli_query($conexi, $li);
  	}
    $query="SELECT count(*) from postulantes where id_favor = $id";
    //echo($query);exit();
    $pl1=mysqli_query($conexi,$query);
    $aux=mysqli_fetch_array($pl1);
    $gruya="SELECT email from postulantes where id_favor = $id and email != '$user'";
    //echo($gruya);exit();
    $elver= "SELECT * from usuario where id_email='$login'";
    $yayo= "SELECT * from usuario where id_email = '$user'";
    $claro=mysqli_query($conexi,$gruya);
    $oscuro= mysqli_query($conexi,$elver);
    $ana=mysqli_query($conexi,$yayo);
    $khalifa=mysqli_fetch_array($oscuro);
    $ratajkowsky=mysqli_fetch_array($ana);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body> 
<h1>Postulante seleccionado exitosamente</h1> </br> <?php 
if ($aux['count(*)'] == 1) { ?>
  <h2>Enviamos un correo electronico  para informarle que lo elegiste como postulante a  "<?php echo $user; ?>" con tus datos:</br> nombre y apellido: <?php echo  $khalifa['nombre']; echo $khalifa['apellido'];?>" y telefono: <?php echo $khalifa['telefono']; ?>   </h2></br>
    <h2>Has recibido un correo electronico con los datos de tu postulante elegido:<br>
    nombre y apellido:<?php echo  $ratajkowsky['nombre']; echo $ratajkowsky['apellido'];?> y telefono: <?php echo $ratajkowsky['telefono'];?> </h2>
   <?php
  } else {   ?>
   <h2>Enviamos un correo electronico  para informarle que lo elegiste como postulante a  "<?php echo $user; ?> con tus datos:</br> nombre y apellido: <?php echo  $khalifa['nombre']; echo $khalifa['apellido'];?> " y telefono: <?php echo $khalifa['telefono']; ?> </h2></br></br>
   <h2>Has recibido un correo electronico con los datos de tu postulante elegido:<br>
    nombre y apellido:<?php echo  $ratajkowsky['nombre']; echo $ratajkowsky['apellido'];?> y telefono: <?php echo $ratajkowsky['telefono'];?> </h2>
   <h3>Tambien enviamos un correo electronico informando el rechazo a los usuarios:</h3></br>
   <?php while ($c = mysqli_fetch_array($claro)){
           echo($c['email']); ?> </br>
           <?php } ?>    
    <?php } ?> 
   <a href="detallefavor.php?id=<?php echo $_GET['valor2'];?>"> Volver </a>

