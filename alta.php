<?php
   include ("conexion.php");
   session_start();
   $idies = $_SESSION['id'];

           $conexion=mysqli_connect("localhost","root","","ingedos") or die("ingreso");
           $consulta= "SELECT credito,calificaciones from usuario where id_email = '$idies'";
           $resultado = mysqli_query($conexion,$consulta);
           if(isset($_POST['titulo']) && !empty($_POST['titulo']) &&  isset($_POST['descri']) && !empty($_POST['descri']) &&  isset($_POST['fech']) && !empty($_POST['fech'])   &&  isset($_POST['ciudad']) &&  !empty($_POST['ciudad']) && isset($_POST['categoria']) ){
           	  $imagen=explode('/',$_FILES['foto']['type']);
              if ($imagen[0] == 'image'){// addslashes(file_get_contents($_FILES['imagen']['type']));
               //   $_fileType = $_FILES['$file']['type'];
                              //este es el tipo de archivo
                //echo("entro");
                $img = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
               $tipo=$imagen[1];
               //$hoy2= date_format($hoy,"d-m-Y");
              }
             
              $ciudad= $_POST['ciudad'];
           		$titulo = $_POST['titulo'];
           		$fechalim = $_POST['fech'];
           		$descri = $_POST['descri'];
           		$categoria = $_POST['categoria'];
              $i =mysqli_fetch_array($resultado);
              //echo("entro en la ejecucion");
            //  if((time()-(60*60*24))>strtotime($fechalim)){
              //  echo("entro al if");
                //header("location:publicarfavor.php?errorseis=La fecha limite ingresada es antigua");
             // }
              //echo ($i);
              if ($i['credito'] >= 1 && $i['calificaciones'] == 0){
		            if (isset($_FILES["foto"]) && !empty($_FILES["foto"]) ){
                  $query="insert into gauchada VALUES ('','$titulo','$descri','',NOW(),'$fechalim','$img','$tipo','$ciudad','$categoria','','$idies')";
                  $resultado = mysqli_query($conexion,$query);
                //if($resultado){
                     $act=$i['credito'] - 1;
                 $modificar = "update usuario set credito=".$act. " where id_email='$idies'";
                // exit($modificar);
                 $result= mysqli_query($conexion, $modificar);
                header("location:publicacion.php");
               }
              
              else {
                  header("location:publicacion.php");
              }
		   
       }
   }
//mysqli_close($conexion);
?>

    			