<?php
   include ("conexion.php");
            $conexi = conectar();
             if(isset($_POST['apellido']) and !empty($_POST['apellido']) and  isset($_POST['nombre']) and !empty($_POST['nombre']) and  isset($_POST['ciudad']) and !empty($_POST['ciudad'])  and  isset($_POST['pass']) and !empty($_POST['pass']) and  isset($_POST['numero']) and !empty($_POST['numero'])  and  isset($_POST['fech']) and !empty($_POST['fech']) and  isset($_POST['correo']) and !empty($_POST['correo'])  and   isset($_POST['tarjeta']) and !empty($_POST['tarjeta'])   ){
           // $test=mysqli_fetch_assoc(mysqli_query($conexi,"SELECT count(*) from usuario where id_email='".$_POST['correo']."'"));
           // exit(var_export($test));
              $apellido = $_POST['apellido'];
			  $nombre= $_POST['nombre'];
			  $ciudad= $_POST['ciudad'];
			  $clave= $_POST['pass'];
			  $numero= $_POST['numero'];
			  $fecha=$_POST['fech'];
			  $tarjeta= $_POST['tarjeta'];
			  $nombreuser= $_POST['correo']; //long del string
			 // $conjunto = strlen($apellido) * strlen($nombre) * strlen($ciudad) * strlen($clave) * strlen($nombreuser) * strlen($numero) *strlen($fecha) ;
			  $usuarios = "SELECT * FROM usuario WHERE id_email='" . $nombreuser . "'";
			 // $ok=false;
              $result = mysqli_query($conexi, $usuarios);
              $user=mysqli_fetch_array($result);
                if(sizeof($user)==0){ 
                	if (isset($_FILES["imagen"]) && !empty($_FILES["imagen"]) ){
                		$imagen=explode('/',$_FILES['imagen']['type']);
              			if ($imagen[0] == 'image'){
							$img = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
               				$tipo=$imagen[1];
               				  $usuarionue = "insert into usuario VALUES  ('$nombreuser', '$clave','$img','$tipo','$tarjeta','1','$fecha','$numero','','','$nombre','$apellido',0)";
               				  //exit($usuarionue);
						     $resultado = mysqli_query($conexi, $usuarionue);
						     header("location:index.php?msj=usuario creado satisfactoriamente");
						}
					}

						if(isset($_FILES['imagen'])) {
									
						  		 $usuarionue = "insert into usuario (id_email,clave,nrotarjeta,credito,fecha_nac,telefono,puntos,estado,nombre,apellido,calificaciones) values   ('$nombreuser', '$clave','$tarjeta','1','$fecha','$numero','','','$nombre','$apellido',0)";
						  		 	//exit($usuarionue);
								     $resultado = mysqli_query($conexi, $usuarionue);
								     //exit($resultado);
								    header("location:index.php?msj=Se ha registrado exitosamente");
								 }    

						  
				}
				else {
						    echo ("entro");	
							header("location:registro.php?repetido=Ya existe una cuenta con el email ingresado");
					}

			}
		
	  			 
?>   