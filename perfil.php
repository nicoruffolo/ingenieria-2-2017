<?php 
    session_start();
    if ( empty($_SESSION['id'])){
       header("location:index.php?no=Inicie Sesion por favor"); }
    
     $idies = $_SESSION['id'];
     //echo($idies);exit();


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
    ?> <div> <a style="margin-right:1250px;margin-top: 12px; " href="index.php ">   Home </a> </div> <?php
    ?> <div> <a style="margin-right:1250px;margin-top: 12px; " href="editarperfil.php ">   Editar Perfil </a> </div> 
       
     <div> <a   onclick="if(!confirm('seguro que deseas borrar  ?')) return false"    style="margin-right:1250px;margin-top: 12px; " href="bajaperfil.php "> Desactivar Cuenta </a> </div>
    <?php
    $conexi=mysqli_connect("localhost","root","","ingedos") or die("ingreso");
  	$usuarios = "SELECT * from usuario where id_email= '" . $_SESSION['id'] . "' and  estado =0 ";
    //echo($usuarios);exit();
    $result = mysqli_query($conexi, $usuarios);
    ?> <div style="text-align: center;"> <?php
                while ($i= mysqli_fetch_array($result)){
                	 if($i['foto'] == null ){
                     ?> <img width="360" src="imagenes/avatar.png"> <?php  
                    }  else {
                 ?>   <p>  
                    	<img width="360" src="<?php echo 'data:image/'.$i['tipofoto'].'; base64,'.base64_encode($i['foto']) ?>"/>
                    </p>
                 <?php  } ?>
                  	<h4> Usuario: </h4> <?php echo   $i['id_email'];   
              	 
              	  ?>	<h4> FechaNac: </h4> <?php echo   $i['fecha_nac']; 
              	  ?>	<h4> Credito: </h4> <?php echo   $i['credito']; 
              	  ?>	<h4> Telefono: </h4> <?php echo   $i['telefono']; 
              	  ?>	<h4> Nombre: </h4> <?php echo   $i['nombre']; 
              	  ?>	<h4> Apellido: </h4> <?php echo   $i['apellido']; 
                  ?> <h4>  Puntos: </h4> <?php echo $i['puntos']; ?>  </br> 

              	   <h4> Reputacion: </h4>
                   <?php
                   $puntos=$i['puntos']; 
                   $consulta1="SELECT id_nombre from reputacion where puntaje_inicial = $puntos and estado = 0";
                   //echo($consulta1);exit();
                   $query1=mysqli_query($conexi,$consulta1);
                   $b=mysqli_fetch_array($query1);
                   if ($b > 0){
                    echo $b['id_nombre'];
                   } else {
                        $consulta2="SELECT id_nombre from reputacion where $puntos BETWEEN puntaje_inicial AND puntaje_final and estado = 0";
                        //echo($consulta2);exit();
                        $query2=mysqli_query($conexi,$consulta2);
                        $c=mysqli_fetch_array($query2);
                        if ($c > 0) {
                          echo $c['id_nombre'];
                        }
                        else {
                           $consulta3="SELECT Min(puntaje_inicial) from reputacion where estado = 0";
                           //echo($consulta3);exit();
                           $query3=mysqli_query($conexi,$consulta3);
                           $d=mysqli_fetch_array($query3);
                           $puntaje=$d['Min(puntaje_inicial)'];
                           $consulta4="SELECT id_nombre from reputacion where puntaje_inicial = $puntaje and estado = 0";
                           //echo($consulta4);exit();
                           $query4=mysqli_query($conexi,$consulta4);
                           $e=mysqli_fetch_array($query4);
                           if ($puntos < $puntaje){
                            echo $e['id_nombre'];
                           } 
                           else {
                              $consulta5="SELECT Max(puntaje_inicial) from reputacion where estado = 0";
                              //echo($consulta5);exit();
                              $query5=mysqli_query($conexi,$consulta5);
                              $f=mysqli_fetch_array($query5);
                              $puntaje_max=$f['Max(puntaje_inicial)'];
                              $consulta6="SELECT id_nombre from reputacion where puntaje_inicial = $puntaje_max and estado = 0";
                              $query6=mysqli_query($conexi,$consulta6);
                              $g=mysqli_fetch_array($query6);
                              if ($puntos > $puntaje_max){
                                echo $g['id_nombre'];
                              }
                           
                           }
                        

                        }
                   

                   }
                  ?>  </br> 
              	</div>  
              <?php   } ?>
             <div> <a style="margin-right:1250px;margin-top: -34px; " href="vergauchadas.php ">   Ver mis gauchadas </a> </div>
             <div> <a style="margin-right:1250px;margin-top: 12px; " href="vermiscoment.php ">   Ver mis comentarios </a> </div>
             <div> <a style="margin-right:1250px;margin-top: 12px; " href="verrecibidos.php ">   Ver comentarios recibidos </a> </div>
             <div> <a style="margin-right:1250px;margin-top: 12px; " href="vermispostula.php ">   Ver mis postulaciones </a> </div>
             <div> <a style="margin-right:1250px;margin-top: 12px; " href="vermiscalifica.php">   Ver mis calificaciones </a> </div>