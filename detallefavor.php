
 <?php 
    session_start();
    if ( empty($_SESSION['id'])){
       header("location:index.php?no=Inicie Sesion por favor"); }
    
     $idies = $_SESSION['id'];


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
</head>
<body> 
  <?php
     include ('conexion.php');
     $conexi=conectar();
     $id = $_GET['id'];
     $ides = $_SESSION['id'];
     $fecha=date("Y-m-d");
     //echo($fecha);exit();
 ?> <div> <a style="margin-right:1250px;margin-top: 12px; " href="index.php ">   Home </a> </div>
    <?php 
          $gauchada="SELECT * from gauchada   where id=" . $id;
          $garca="SELECT usuario from gauchada   where id=" . $id;
          $emily="SELECT usuario from gauchada   where id=" . $id;
          $alexis = "SELECT  * from postulantes where email = '$ides' and id_favor = $id";
          $postula = " SELECT * from postulantes where id_favor ='$id' and seleccion = 0 ";
          $xamp="SELECT count(*) from postulantes where id_favor ='$id'";
          $yahoo=mysqli_query($conexi,$xamp);
          $y=mysqli_fetch_array($yahoo);
          $cantidada=$y['count(*)'];
          //echo($alexis); echo($postula); exit();
     	$guardar=mysqli_query($conexi, $gauchada);
      $farlopa= mysqli_query($conexi,$garca);
      $rata = mysqli_query($conexi,$emily);
      $ren = mysqli_query($conexi,$alexis);
      $po = mysqli_query($conexi,$postula);
      $a = mysqli_fetch_array($rata);
      $e = mysqli_fetch_array($ren);
      $s= mysqli_fetch_array($po);
      //$s= mysqli_fetch_array($po);
      $direct="UPDATE gauchada set cant_postulantes = $cantidada  where id= '$id'";
      //echo($direct);exit();
      $alfin=mysqli_query($conexi,$direct);
      $tauro= mysqli_fetch_array($farlopa);
      $hola=$tauro['usuario'];
    ?>
       <?php
          while ($i = mysqli_fetch_array($guardar)) {
            ?>
            <div style="padding-left: 524px;"> <?php
               ?> <h3>  <?php echo   $i['titulo']; ?> </h3> <?php if(($idies != $a['usuario']) && ($s == 0 ) && ($e == 0)) {  ?> <a href="postularme.php?id=<?php echo $_GET['id']; ?>"> <div style="margin-top: -38px;margin-left: 300px; "> Postularme </div> </a> <?php } 
                    else { if(($e > 0 ) && ($idies != $a['usuario'])) { ?> <div style="margin-top: -38px;margin-left: 300px; "><h3> Ya te postulaste a esta gauchada</h3></div> <?php } else { if ($idies != $a['usuario']){?><div style="margin-top: -38px;margin-left: 300px; "><h3> Ya existe un postulante elegido para esta gauchada</h3></div> <?php }  } } ?> </br> 
                    <p>  
                    	<?php if($i['foto'] == null){ ?>
                     <img width="360" src="imagenes/avatar.png"> <?php } 
                     else {
                      ?> <img width="360" src="mostrar.php?id=<?php echo $i ['id'];?>"/> 
                  <?php } ?>  	
                    </p>
               	   <h4> Descripcion: </h4> <?php echo   $i['descripcion']; ?>  </br>
               	  <h4> Fecha de creacion: </h4> <?php echo   $i['fecha_creacion']; ?>  </br>
               	  <h4> Fecha limite: </h4> <?php echo   $i['fecha_vencimiento']; ?>  </br>
               	  <h4> Ciudad: </h4> <?php echo   $i['ciudad']; ?> </br>
               	  <h4> Categoria: </h4> <?php echo   $i['caterogia']; ?>  </br>
                  <h4> Cantidad de Postulantes: </h4> <?php echo   $y['count(*)']; ?> </br>
                  <?php if(($ides == $i['usuario']) and ($s > 0) ) { ?>
                     <h4> Postulante seleccionado : </h4>  <?php echo ($s['email']) ?>
                     <?php if(($s['calificacion'] == "") and ($i['estado'] == 0)) {
                   ?>  <a href="calificarusuario.php?id=<?php echo $_GET['id'];?>"> Calificar usuario </a>  <?php } else { if ($s['calificacion'] != "") {
                    ?> <h4> Calificacion: </h4> <?php echo $s['calificacion']; ?> </br>
                       <h4> Comentario: </h4> <?php echo $s['comentario']; ?> </br> <?php } 

                   } ?>

                  <?php } 
            ?>
               </div>
              <?php } ?>
              <?php 

                $var= "SELECT id_comentario,cuerpo,respuesta,id_nombre from comentarios where gauchada_id =" .$id." and  estado =0";
                //echo ($var);
                //exit();
                $resuvar=mysqli_query($conexi,$var); ?>
                <hr size="8px" color="black"/> <?php
                while ($a = mysqli_fetch_array($resuvar)) {
                 $coment=$a['id_comentario']; ?>
                 <?php  if (($a['id_nombre'] == $ides ) && ($a['respuesta'] == "")){ ?> 
                  <div style="padding-left: 524px;"> <?php
                  ?> <h3> Comentario: (de "<?php echo $a['id_nombre'] ?>") </h3> <?php echo $a['cuerpo'];?> <a   onclick="if(!confirm('seguro que deseas borrar  ?')) return false" href="eliminarcoment.php?id=<?php echo $coment?>&valor2=<?php echo $id?>">eliminar comentario </a> 
                  <a href="modificarcoment.php?id=<?php echo $coment?>&valor2=<?php echo $id?>"> modificar comentario </a> </br>
                     <h4> Respuesta: </h4> <?php if ($a['respuesta'] != "") { echo $a['respuesta']; } else { echo ("No hay respuesta para este comentario");}?> </br>
                  </div>
                <?php  } else {
                         ?> <div style="padding-left:524px; "> <h3>  Comentario: (de "<?php echo $a['id_nombre'] ?>") </h3> <?php echo $a['cuerpo'];?> 
                     <h4> Respuesta: </h4> <?php if (($a['respuesta'] == "") && ($hola != $ides)) { echo ("No hay respuesta para este comentario"); }
                     else { echo $a['respuesta']; }?> </br>  <?php
                     if (($a['respuesta'] == "") && ($hola == $ides)){ ?> <form action="respondercoment.php?id=<?php echo $coment;?>&valor3=<?php echo $id?>" method="post"><?php
                         $gauchada20="SELECT * from gauchada   where id=" . $id;
                          $chano=mysqli_query($conexi,$gauchada20);
                          $clavi=mysqli_fetch_array($chano);
                          if(($clavi['estado'] == 0) && ($clavi['fecha_vencimiento'] > $fecha)){ ?>
                        <input type="text" name="respuesta" required=""> 
                        <input type="submit" name="" value="responder"> <?php } ?>

                     </form> <?php } ?>  </div>
                 <?php  }  ?>


                  <hr size="8px" color="black"/>
                <?php } ?>

            <?php  //$i=mysqli_fetch_array($farlopa); 
                   if ($hola == $ides){
                          $gauchada23="SELECT * from gauchada   where id=" . $id;
                          $chan=mysqli_query($conexi,$gauchada23);
                          $clavo=mysqli_fetch_array($chan); 
                         if(($clavo['estado'] == 0) && ($clavo['fecha_vencimiento'] > $fecha)){ 
                      if ($s == 0){ 
                         $xampi="SELECT count(*) from postulantes where id_favor ='$id'";
                         $yaha=mysqli_query($conexi,$xampi);
                         $f=mysqli_fetch_array($yaha);
                         $cantidades=$f['count(*)'];
                         if ($cantidades == 0){ ?>
                        <a href="modificargauchada.php?id=<?php echo $_GET['id']; ?>"> modificar gauchada</a> </br> <?php } ?>
                        <a href="aceptacion.php?id=<?php echo $_GET['id'];  ?>"> Borrar gauchada </a>
                      <?php
                       $hello="SELECT * from postulantes where id_favor ='$id'";
                       $bye= mysqli_query($conexi,$hello);
                       $good= mysqli_fetch_array($bye);
                       if (($s == 0) && ($good > 0)){
                       ?>  <a href="selepostulante.php?id=<?php echo $_GET['id']; ?>"> Seleccionar postulante</a>
                           <a href="verpostulantes.php?id=<?php echo $_GET['id']; ?>"> Ver postulantes</a> 
                      <?php } ?>
                 <?php } ?>
                   <?php } ?>
                  <?php }
                       if ($hola != $ides){
                    ?>  <form name="dejarcomentario" method="POST" action="altadecomentario.php?id=<?php echo $_GET['id']; ?>">
               
                        <p>Comentario:</p> 
                        <textarea name="comentario" cols="70" rows="5" required="" placeholder="ingrese comentario" wrap="soft"></textarea> </br>
                        <input type="hidden" name="gauchada" value="<?php echo $_GET['id']; ?> ">
                        <input name="submit" type="submit" value="Comentar">
                     
                        </form>
                     
                     <?php } ?>

                   