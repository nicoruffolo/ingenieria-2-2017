<?php 
    session_start();
    $idies = $_SESSION['id'];
             include ('conexion.php');
             $conexi=conectar();
             if(isset($_POST['coment']) and !empty($_POST['coment']) and  isset($_POST['elegido']) and !empty($_POST['elegido']) ){
             		$elegido= $_POST['elegido'];
             		$coment= $_POST['coment'];
             		$al="SELECT * from postulantes where id_favor  = '" . $_GET['id'] . "' and seleccion = 0 ";
             		$aux= mysqli_query($conexi,$al);
             		$dame=mysqli_fetch_array($aux);
             		$general= "UPDATE  postulantes set calificacion = '$elegido'  where id_favor  = '" . $_GET['id'] . "' and seleccion = 0 ";
             		$gena= "UPDATE  postulantes set comentario = '$coment'  where id_favor  = '" . $_GET['id'] . "' and seleccion = 0  ";
             		$usu= "SELECT puntos,credito from  usuario where id_email = '$dame[email]'";
             		$resu=mysqli_query($conexi,$usu);
             		$res = mysqli_fetch_array($resu);
             		$query1=mysqli_query($conexi,$general);
             		$query2= mysqli_query($conexi,$gena);
             		$tre="SELECT DISTINCT  gauchada.id from postulantes inner join gauchada on id_favor = gauchada.id inner join usuario on gauchada.usuario = '" . $_SESSION['id']. "'where calificacion is null and seleccion is not null ";
             		$tri=mysqli_query($conexi,$tre);
             		$dar= mysqli_fetch_array($tri);
             		if (sizeof($dar) == 0){
             			$ne= "UPDATE usuario set calificaciones = 0 where id_email = '" . $_SESSION['id'] . "' ";
           				$x= mysqli_query($conexi,$ne);
             			}
	             		if ($elegido == "positivo"){
	             			$punto= $res['puntos'] + 1;
	             			$credito = $res['credito'] + 1;
	             			$r= "UPDATE  usuario set puntos = $punto where id_email = '$dame[email]' ";
	             			$ex=mysqli_query($conexi,$r);
	             			$w= "UPDATE  usuario set credito = $credito where id_email =  '$dame[email]' ";
	             			$xe=mysqli_query($conexi,$w);
	             			//header("location:index.php");

	             		}
	             	   if ($elegido == "negativo") {
	             	   	   $punto= $res['puntos'] - 2;
	             		   //$credito = $res['credito'] - 1;
	             			$r= "UPDATE  usuario set puntos = $punto where id_email = '$dame[email]' ";
	             			$ex=mysqli_query($conexi,$r);
	             			//$w= "UPDATE  usuario set credito = $credito where id_email =  '$dame[email]' ";
	             			//$xe=mysqli_query($conexi,$w);
	             			//header("location:index.php");
	             	   }
                     ?>  <!DOCTYPE html>
                         <html>
                         <head>
                         <meta charset="utf-8">
                         <title>Una Gauchada</title>
                         <img src="imagenes/gauchada.png">
                         </head>
                         <body>  
                         <div style="text-align:center;">
                         <h1>Usuario <?php echo $dame['email'];?> calificado correctamente <h1/><br/>
                         <div/>
                         Tu calificacion a este usuario es: <br/>
                         <?php echo $elegido ?><br/>
                         <div style="text-align:left;">
	                     <a href="detallefavor.php?id=<?php echo $_GET['id'];?>"> Volver </a>
                         <div/>
              <?php   }

?>