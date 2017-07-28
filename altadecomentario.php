<?php
session_start();
include ("conexion.php");
            $conexion = conectar();
            $id = $_GET['id'];
                 if( !empty($_POST['comentario'])  and !empty($_POST['gauchada']) ){
	          
	         
			 $comentario= $_POST['comentario'];

			  $gauchada = $_POST['gauchada'];	

			  


			$coment = "INSERT INTO comentarios (id_comentario,estado,respuesta,cuerpo,id_nombre,gauchada_id) values ('','0','','$comentario','$_SESSION[id]','$gauchada')";
		//	var_dump($coment);die;
			      $resultado = mysqli_query($conexion, $coment);
		//			     die();
					   
					     header("location:comentpublicado.php?id=$id");

		}
	  			 else {
    				echo ("faltan campos");
    			}











?>