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
		<a href="panel.php">Volver </a> </br> 
<h1 style="text-align: center;">  Ranking de Usuarios  </h1></br>
<h3> A continuacion se presenta un listado de los usuarios con mayor puntaje:</h3>
	<?php 
	   include ('conexion.php');
       $conexi=conectar();
	   $aux="SELECT * from usuario  where estado = 0 and rol = 0  order by puntos DESC LIMIT 10";
	   $daux=mysqli_query($conexi,$aux);
	   $conta=0; ?>
	   <table class="mover" border="1">

	           <thead>
	
		       <tr>
			      <td>Puesto</td>
			      <td>Usuario</td>
			      <td>Puntos</td>
			      <td>Reputacion</td>
		       </tr>

	          </thead> 
	          <tbody>
	          <?php
	   while($i=mysqli_fetch_array($daux)){
	   		  $conta++;
                   $puntos=$i['puntos']; 
                   $consulta1="SELECT id_nombre from reputacion where puntaje_inicial = $puntos and estado = 0";
                   //echo($consulta1);exit();
                   $query1=mysqli_query($conexi,$consulta1);
                   $b=mysqli_fetch_array($query1);
                   if ($b > 0){
                    $repu=$b['id_nombre'];
                   } else {
                        $consulta2="SELECT id_nombre from reputacion where $puntos BETWEEN puntaje_inicial AND puntaje_final and estado = 0";
                        //echo($consulta2);exit();
                        $query2=mysqli_query($conexi,$consulta2);
                        $c=mysqli_fetch_array($query2);
                        if ($c > 0) {
                          $repu=$c['id_nombre'];
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
                            $repu=$e['id_nombre'];
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
                                $repu=$g['id_nombre'];
                              }
                           
                           }
                        

                        }
                   

                   }
	   		?> <tr>
			   <td><?php echo $conta;?></td>
			   <td><?php echo $i['id_email'];?></td>
			   <td><?php echo $i['puntos'];?></td>
			   <td><?php echo $repu;?></td>
		      </tr>
       <?php  } ?>
       </tbody>

  </table>