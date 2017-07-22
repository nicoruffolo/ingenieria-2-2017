<?php 
session_start();
include ('conexion.php');
$conexi=conectar();
$id = $_GET['id'];
$ides = $_GET['valor2'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body>
<div> <a style="margin-right:1250px;margin-top: 12px; " href="verpostulantes.php?id=<?php echo $_GET['valor2'];?>"> Atras </a> </div> <?php
$consulta="SELECT * from usuario where id_email = '$id'";
//echo($consulta);exit();
$query=mysqli_query($conexi,$consulta);
?><div style="text-align: center;"> <?php
while ($i= mysqli_fetch_array($query)){
                	 if($i['foto'] == null ){
                     ?> <img width="360" src="imagenes/avatar.png"> <?php  
                    }  else {
                 ?>   <p>  
                    	<img width="360" src="<?php echo 'data:image/'.$i['tipofoto'].'; base64,'.base64_encode($i['foto']) ?>"/>
                    </p>
                 <?php  } ?>
                 <h4> Usuario: </h4> <?php echo   $i['id_email']; 
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
                           $consulta3="SELECT MIN(puntaje_inicial) from reputacion where estado = 0";
                           //echo($consulta3);exit();
                           $query3=mysqli_query($conexi,$consulta3);
                           $d=mysqli_fetch_array($query3);
                           $puntaje=$d['MIN(puntaje_inicial)'];
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
<?php  } ?>
<div> <a style="margin-right:1250px;margin-top: 12px; " href="visitarcalificaciones.php?idi=<?php echo($_GET['id']);?>&valor3=<?php echo $ides?>">Ver Calificaciones del usuario </a> </div>