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
    $claro=mysqli_query($conexi,$gruya);
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
  <h2>Enviamos un correo electronico a "<?php echo $user ?>" para informarle que lo elegiste como postulante</h2></br> <?php
  } else {   ?>
   <h2>Enviamos un correo electronico a "<?php echo $user ?>" para confirmarle que lo elegiste como postulante</h2></br></br>
   <h3>Tambien enviamos un correo electronico informando el rechazo a los usuarios:</h3></br>
   <?php while ($c = mysqli_fetch_array($claro)){
           echo($c['email']); ?> </br>
           <?php } ?>    
    <?php } ?> 
   <a href="detallefavor.php?id=<?php echo $_GET['valor2'];?>"> Volver </a>

