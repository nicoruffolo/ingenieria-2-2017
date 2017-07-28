<?php
session_start();
//$mensaje[1]= "Ya existe una cuenta de usuario con ese email";
//$error=1;
include("conexion.php");
$conexi=conectar();
$id=$_SESSION['id'];
//$idusuario = $_GET['id'];
if( (isset($_POST['nombre']) and (!empty($_POST['nombre']))) and  ((isset($_POST['tel'])) and (!empty($_POST['tel'])))     and  ((isset($_POST['usu'])) and (!empty($_POST['usu'])))  and  (isset($_POST['apellido'])) and (!empty($_POST['apellido'])) ) {
             //echo("hola");
              $nombre = $_POST['nombre'];
			  $tele= $_POST['tel'];
			  $usuario= $_POST['usu'];
			  $apellido= $_POST['apellido'];
			 // $contra=$_POST['pass'];
           $usuarios="SELECT count(*) from usuario where id_email= '$nombre' and id_email != '$id'";
           //echo($usuarios);exit();
           $result=mysqli_query($conexi,$usuarios);
           $user=mysqli_fetch_array($result);
           $a=$user['count(*)'];
           if(($id != $nombre) && ($a == 1)){
           	   //echo("hola");
           	  header("location:editarperfil.php?no=Ya existe una cuenta de usuario con ese email");
           	   //exit();
           } else {
		    $modificar = "UPDATE  usuario set id_email='$nombre',telefono = '$tele',nombre= '$usuario',apellido = '$apellido'  where id_email = '" . $_SESSION['id'] . "' ";
	      if (isset($_FILES["foto"]) && !empty($_FILES["foto"])){
	 			//echo ("sadad"); exit();
			$imagen=explode('/',$_FILES['foto']['type']);
             if ($imagen[0] == 'image'){
				$img = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
               	$tipo=$imagen[1];
				$query= "UPDATE  usuario set id_email='$nombre',foto='$img',tipofoto='$tipo',telefono = '$tele',nombre= '$usuario',apellido = '$apellido'  where id_email = '" . $_SESSION['id'] . "' ";
				
                  $resultado = mysqli_query($conexi,$query);
                  $_SESSION['id'] = $nombre;
		   		}			
			}
		$result= mysqli_query($conexi, $modificar);
		$_SESSION['id'] = $nombre;
		header("location:modificarcontraseña.php");
		}
	}	
else{
		//header("location:perfil.php");
		}

?>