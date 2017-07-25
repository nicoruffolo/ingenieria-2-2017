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
	//if (isset($_SESSION['emi'])){
		//echo $_SESSION['emi'];
	//}
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
     if (isset($_SESSION['id']))  { ?>
           <a style="margin-left: 1250px;" href="cerrarsesion.php "> Cerrar sesion </a> </br>  
           <h1 style="">  Bienvenido Administrador! </h1>
           <?php echo ($_SESSION['id']); ?> </br></br>
           <a href="veradmin.php">Ver Todos los administradores</a>
           <a style="margin-left:470px; " href="panel.php"> Ir al menu de administracion</a></br></br>
     <?php }
     $consulta="SELECT * from gauchada";
     $query=mysqli_query($conexi,$consulta); ?>
     <div class="mover">

         <h2 style="margin-top: 50px;margin-left: 78px;">Todas las Gauchadas:</h2> </br>
       </div> <?php
       while ($i = mysqli_fetch_array($query)) { ?>
       		<div style="padding-left: 524px;"> <?php 
               ?> <h3> <?php echo $i['titulo']; ?> </h3> </br>
               <p>
               	  <a href="detallegaucha.php?id=<?php echo $i ['id']; ?>">Ver Detalladamente</a><br>
               	  <?php if($i['foto'] == null){ ?>
                     <img width="360" src="imagenes/avatar.png"> <?php } 
                     else {
                      ?> <img width="360" src="mostrar.php?id=<?php echo $i ['id'];?>"/>
                    </a> 
                  <?php } ?>          
              </p>
            </div>
      <?php } ?>      


